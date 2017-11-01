<?php

namespace App\Controller;

use App\Controller\AppController;

/**
 * Personal Controller
 * User personal interface
 *
 */
class ArenasController extends AppController {

    public function inbox() {
        $session = $this->request->session();

        if ($session->check('fighterChosenId')) {

            $this->loadModel('Messages');
            $this->loadModel('Fighters');

            $dataSent = $this->request->getData();

            if (isset($dataSent['fighterWithId'])) {
                $session->write('fighterFrom', $dataSent['fighterWithId']);
            }

            if ($session->check('fighterFrom')) {
                $fighterFrom = $session->read('fighterFrom');
            } else {
                $fighterFrom = -1;
            }

            if ($this->request->is('post') && $session->check('fighterFrom')) {
                $this->Messages->addANewMessage($this->request->getData());
            }

            $otherFightersList = $this->Fighters->getOtherFightersList($session->read('playerIdLogin'));
            $this->set('otherFightersList', $otherFightersList);


            $messages = $this->Messages->find('all');
            $messagesArray = $messages->toArray();
            $goodMessages = [];
            for ($i = 0; $i < count($messagesArray); $i++) {
                if (($messagesArray[$i]['fighter_id_from'] == $fighterFrom && $messagesArray[$i]['fighter_id'] == $session->read('fighterChosenId')) || ($messagesArray[$i]['fighter_id_from'] == $session->read('fighterChosenId') && $messagesArray[$i]['fighter_id'] == $fighterFrom)) {
                    array_push($goodMessages, $messagesArray[$i]);
                }
            }

            $this->set('fighterIsChosen', 1);
            $this->set('fighterFrom', $fighterFrom);
            $this->set('fighterChosenId', $session->read('fighterChosenId'));
            $this->set('fighterChosenName', $session->read('fighterChosenName'));
            $this->set('messagesArray', $goodMessages);
        } else {
            if ($session->check('playerEmailLogin')) {
                $this->set('playerIsLogin', 1);
            } else {
                $this->set('playerIsLogin', 0);
            }
            $this->set('fighterIsChosen', 0);
        }
    }

    public function hallOfFame() {
        $this->loadModel('Fighters');
        $this->loadModel('Events');
        $this->loadModel('Guilds');

        $this->set('fighterDistribution', $this->Fighters->getFighterDistribution());
        $this->set('deadFighterDistribution', $this->Events->getDeadFighters());
        $this->set('createdFighterDistribution', $this->Events->getCreatedFighters());
        $this->set('deadFighterCount', $this->Events->getDeadFightersAmount());
        $this->set('averageSkills', $this->Fighters->getAverageForSkills());

        $Query = $this->Fighters->find();
        $Query->select([
            'guild_id',
            'members' => $Query->func()->count('*')
        ])
        ->where(['not' => ['guild_id' => 'null']])
        ->group(['guild_id'])
        ->order(['members' => 'DESC']);
        $QueryArray = $Query->toArray();

        for ($i=0; $i < 4; $i++) {
            $guildCountTable[$i][0] = $QueryArray[$i]->members;
            for ($j=0; $j < $this->Guilds->find('all')->count(); $j++) {
                if ($QueryArray[$i]->guild_id == $this->Guilds->find('all')->toArray()[$j]->id) {
                    $guildName = strval($this->Guilds->find('all')->toArray()[$j]->name);
                    $guildCountTable[$i][1] = $guildName;
                }
            }
        }
        $this->set('guildCountTable', $guildCountTable);
    }

    public function index() {
        $this->loadModel('Fighters');

//Retrieving every fighter currently in the game (for leaderboards)
        $this->set('fighterList', $this->Fighters->getFighterList());
        $this->set('fighterCount', $this->Fighters->find('all')->count());
// $this->set('fighterTableWidth', $this->Fighters->getFighterTableWidth());
    }

    public function login() {
        $this->loadModel('Players');
        $data = $this->request->getData();
        $session = $this->request->session();

        $session->write('fighterChosenName', null);
        $session->write('fighterChosenId', null);
        $session->write('fighterChosenGuild', null);

        $goodToGo = 0;
        $playerLogin = 0;
        $players = $this->Players->find('all');
        $playersArray = $players->toArray();

        if ($this->request->is('post')) {
            if (isset($data['emailLogin']) && isset($data['password'])) {
                for ($i = 0; $i < count($playersArray); $i++) {
                    if ($playersArray[$i]['email'] == $data['emailLogin'] && password_verify($data['password'], $playersArray[$i]['password'])) {
                        $goodToGo = 1;
                        $playerLogin = $data['emailLogin'];
                        $session->write('playerEmailLogin', $playerLogin);
                        $session->write('playerIdLogin', $playersArray[$i]['id']);
                        $playerEmailLogin = $session->read('playerEmailLogin');
                    }
                }
            }

            if ($goodToGo == 1) {
                $goodToGo = 'You are ready to play';
            } else {
                $session->write('playerEmailLogin', null);
                $playerEmailLogin = $session->read('playerEmailLogin');
                $goodToGo = 'Bad user identification';
            }

            $this->set('goodToGo', $goodToGo);
        }
    }

    public function signUp() {

        $this->loadModel('Players');
        $data = $this->request->getData();
        $emailInDB = 0;


        if ($this->request->is('post')) {
            if (isset($data['email']) && isset($data['password'])) {
                $players = $this->Players->find('all');
                $playersArray = $players->toArray();
                for ($i = 0; $i < count($playersArray); $i++) {
                    if ($playersArray[$i]['email'] == $data['email']) {
                            $emailInDB = 1;
                    }
                }
                if($emailInDB == 0) {
                    $this->Players->addANewPlayer($data);
                    $this->set('emailInDB', 'Your player is saved');
                }
                else {
                    $this->set('emailInDB', 'Your player is already in Database');
                }
            }
        }
    }

    public function fighter() {
        $this->loadModel('Fighters');
        $this->loadModel('Events');

        //Retrieving the fighter list (for displaying a player's fighters)
        //TODO: get list based on current player ID
        $session = $this->request->session();
        if ($session->check('playerEmailLogin')) {
            $playerIdLogin = $session->read('playerIdLogin');

            $newFighter = $this->request->getData();

            $nameInDb = 0;  //Variable testing if fighter name already exists
            $LevelUpPossible = 0; //to check afterwards if your fighter can level up
            $fighters = $this->Fighters->find('all');
            $fightersArray = $fighters->toArray();

            if (isset($newFighter['name'])) {  //What is being tested?
                if($newFighter['name'] != '') {
                    for ($i = 0; $i < count($fightersArray); $i++) {
                        if ($fightersArray[$i]['name'] == $newFighter['name']) {

                            $nameInDb = 1;
                        }
                    }
                    if ($nameInDb != 1) {
                        $this->Fighters->addANewFighter($this->request->getData(), $playerIdLogin);
                        $fighterEvent = $this->Fighters->getFighterByName($newFighter['name'])[0];
                        $this->Events->addNewPlayerEvent($fighterEvent);
                    }
                    if ($nameInDb == 1) {
                        $nameInDb = 'A fighter of this name already exists';
                    } else {
                        $nameInDb = 'Your fighter has been created!';
                    }
                    $this->set('nameInDb', $nameInDb);
                }
            }

            $this->set('playerIsLogin', 1);
            $playerFighterList = $this->Fighters->getPlayerFighterList($playerIdLogin);
            $this->set('playerFighterList', $playerFighterList);
            
            
            if( isset( $newFighter['fighterChosen'] ) ){    // check that the CHOOSE btn is pushed (i think)
                if( $newFighter['fighterChosen'] != "" ) {  // Check that it's not the default value of the select form
                    $fighterChosen = $playerFighterList[$newFighter['fighterChosen']];
                    $session->write('fighterChosenName', $fighterChosen['name']);
                    $session->write('fighterChosenId', $fighterChosen['id']);
                    $session->write('fighterChosenGuild', $fighterChosen['guild_id']);

                }
            }

            $currentFighterId = $session->read("fighterChosenId");
            $fighterChosen = $this->Fighters->getFighterById($currentFighterId);

            if(($session->check('fighterChosenId') && ($fighterChosen[0]->xp >= 4))){

                $this->set('levelUpPossible', 1);
                $data = $this->request->getData();

                if($data != 0){
                    $this->Fighters->levelUp($data, $fighterChosen[0]);
                }

                } else {

                    $this->set('levelUpPossible', 0);
                }



        } else {
            $this->set('playerIsLogin', 0);
        }

        $this->set('leveledUpList', $this->Fighters->getLeveledUpList());

        $session = $this->request->session();
        $currentFighterId = $session->read("fighterChosenId");
        $avatarId = strval($currentFighterId) . '.PNG';
        if($this->Fighters->find('all')->where(['id =' => $avatarId])->toArray()){
            $chosenFighterName = $this->Fighters->find('all')->where(['id =' => $avatarId])->toArray()[0]->name;
        }else { $chosenFighterName = "Chose or create a fighter";}
        
        $this->set('avatarId', $avatarId);
        $this->set('chosenFighterName', $chosenFighterName);
    }

    public function sight() {

        $this->loadModel('Events');
        //session
        $session = $this->request->session();


        if ($session->check('playerEmailLogin') && $session->check('fighterChosenId') ) {
            $this->set('playerIsLogin', 1);
            $this->set('fighterIsChosen', 1);
            $playerIdLogin = $session->read('playerIdLogin');

        // Default for the initial aparition and whenever you reload the page
        $data["direction"] = "right";

        // Load model and set the matrix's size
        $this->loadModel('Fighters');
        $this->set('matX', $this->Fighters->getMatrixX());
        $this->set('matY', $this->Fighters->getMatrixY());
        $this->set('fighterCount', $this->Fighters->find('all')->count());
        $this->set('message', "Nothing of interest happened.");

        // For testing only, has to be replaced
        $currentFighterId = $session->read("fighterChosenId");

        // Call the move function
        if ($this->request->is("post")) {
            $data = $this->request->getData();

            // If this is not an attack
            if ($data["attack"] == "no") {
                // Then move()
                $this->Fighters->move($data);
            } else { // Else, if this is an attack, fight()
                // Get the targeted case from the sight data
                $targetedCase = $data["targetedCase"];

                // Call the fight() function with the contenders as parameters if the targeted case is in fact a fighter
                if ($this->Fighters->getCase($targetedCase["x"], $targetedCase["y"])) {
                    $attack = $this->Fighters->getFighterById($currentFighterId)[0];
                    $defense = $this->Fighters->getCase($targetedCase["x"], $targetedCase["y"])[0];
                    $message= $this->Events->addNewFightEvent($this->Fighters->totalFight($this->Fighters->fight($attack, $defense), $attack, $defense), $attack, $defense);
                    $this->set('message', $message["message"]);
                }
            }
        }

        // Get the current fighter after it's position has been updated by move()
        $currentFighter = $this->Fighters->getFighterById($currentFighterId);

        // Get the case that is being targeted and send it to the view for displaying
        $targetedCase = $this->Fighters->getTargetedCase($data, $currentFighter);
        $this->set('targetedCase', $targetedCase);

        // Send the current fighter to the view for displaying the war fog
        $this->set('currentFighter', $currentFighter);


        //Retrieving every fighter currently in the game (for positions)
        $this->set('fighterList', $this->Fighters->getFighterList());
        $this->set('fighterCount', $this->Fighters->find('all')->count());
    }
    else {
         if ($session->check('playerEmailLogin')) {
            $this->set('playerIsLogin', 1);
         }
         else {
             $this->set('playerIsLogin', 0);
         }
         
         if ($session->check('fighterChosenId') ) {
             $this->set('fighterIsChosen', 1);
         } else {
             $this->set('fighterIsChosen', 0);
         }
        }
    }
    
 

    public function diary() {


        $this->loadModel('Events');
        $this->loadModel('Fighters');

        $session = $this->request->session();

        $fighterChosen = $session->read("fighterChosenName");
        $screamMessage = $this->request->getData();
        if(isset($screamMessage['message']))
        $this->Events->addNewScreamEvent($fighterChosen, $screamMessage['message']);


        $this->set('eventsList', $this->Events->getEventsList());
        $this->set('eventsCount', $this->Events->find('all')->count());
    }

    public function guild() {
        $this->loadModel('Guilds');
        $this->loadModel('Fighters');
        $session = $this->request->session();

        if ($session->check('fighterChosenId')) {
            $playerIdLogin = $session->read('playerIdLogin');
            $data = $this->request->getData();

            $guildNameInDb = 0;  //Variable testing if fighter name already exists
            $guild = $this->Guilds->find('all');
            $guildArray = $guild->toArray();

            if (isset($data['name'])) {  //What is being tested?
                for ($i = 0; $i < count($guildArray); $i++) {
                    if ($guildArray[$i]['name'] == $data['name']) {

                        $guildNameInDb = 1;
                    }
                }
                if ($guildNameInDb != 1) {
                    $this->Guilds->addANewGuild($data);
                }
                if ($guildNameInDb == 1) {
                    $guildNameInDb = 'A guild of this name already exists';
                } else {
                    $guildNameInDb = 'Your guild has been created!';
                }
                $this->set('guildNameInDb', $guildNameInDb);
            }

            $guildList = $this->Guilds->getGuildList();

            $this->set('fighterIsChosen', 1);
            if (isset($data['guildChosenForFighter'])) {
                $fighterChosen = $session->read('fighterChosenId');
                $guildChosen =  $guildList[$data['guildChosenForFighter']];
                $session->write('fighterChosenGuild', $guildChosen);
                $this->Fighters->joinGuild($guildChosen, $fighterChosen);
            }

            if($session->check('fighterChosenGuild')) {
                $allFightersArray = [];
                $allFightersArray = $this->Fighters->find('all')->toArray();
                $guildFighters = [];
                for($i=0; $i<count($allFightersArray); $i++) {
                    if($allFightersArray[$i]['guild_id'] == $session->read('fighterChosenGuild')['id']) {
                        array_push($guildFighters, $allFightersArray[$i]);
                    }
                }
                $this->set('guildFighters', $guildFighters);

                if(isset($guildList)) {
                    for($i=0; $i<count($guildList); $i++) {
                        if($guildList[$i]['id'] == $session->read('fighterChosenGuild')['id']) {
                            $guildName = $guildList[$i]['name'];
                        }
                    }
                    if(isset($guildName)) {
                       $this->set('guildName', $guildName);
                    }
                }
            }

            $this->set('guildList', $guildList);

            $this->set('guildCount', $this->Guilds->find('all')->count());
            //Function that counts how many fighters there are per guild AND shows all guilds (even when there are no fighters. Much harder to do than the idea suggests...)
            //Ideally, put function in GuildsTable, but impossible to link Guilds and Fighters to make the associated tables query
            $fighterPerGuildCounter = 0;
            $guildLevel = 0;
            for ($i = 0; $i < $this->Guilds->find('all')->count(); $i++) {
                $guildCountTable[$i][0] = $this->Guilds->find('all')->toArray()[$i]->name;
                $guildCountTable[$i][1] = $this->Guilds->find('all')->toArray()[$i]->id;
                for ($j = 0; $j < $this->Fighters->find('all')->count(); $j++) {
                    if ($this->Fighters->find('all')->toArray()[$j]->guild_id == $this->Guilds->find('all')->toArray()[$i]->id) {
                        $fighterPerGuildCounter++;
                        $guildLevel += $this->Fighters->find('all')->toArray()[$j]->level;
                    }
                    $guildCountTable[$i][2] = $fighterPerGuildCounter;
                    $guildCountTable[$i][3] = $guildLevel;
                }
                $fighterPerGuildCounter = 0;
                $guildLevel = 0;
            }
            if(isset($guildCountTable)) {
                $this->set('guildCountTable', $guildCountTable);
            }
        }
        //fighter not chosen
        else {
            if ($session->check('playerEmailLogin')) {
                $this->set('playerIsLogin', 1);
            } else {
                $this->set('playerIsLogin', 0);
            }
            $this->set('fighterIsChosen', 0);
        }
    }

}

?>
