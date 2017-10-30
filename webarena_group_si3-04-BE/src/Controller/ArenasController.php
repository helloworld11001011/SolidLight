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

        $goodToGo = 0;
        $playerLogin = 0;
        $players = $this->Players->find('all');
        $playersArray = $players->toArray();

        if ($this->request->is('post')) {
            if (isset($data['emailLogin']) && isset($data['password'])) {
                for ($i = 0; $i < count($playersArray); $i++) {
                    if ($playersArray[$i]['email'] == $data['emailLogin'] && $playersArray[$i]['password'] == $data['password']) {
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
            if (isset($newFighter['fighterChosen'])) {
                $fighterChosen = $playerFighterList[$newFighter['fighterChosen']];
                $session->write('fighterChosenName', $fighterChosen['name']);
                $session->write('fighterChosenId', $fighterChosen['id']);

                if($fighterChosen['xp'] >= 4){

                   $LevelUpPossible = 1;
                   $this->Fighters->levelUp($this->request->getData(), $fighterChosen);

                } else {

                    echo ' You cannot level up this fighter, not enough xp ';

                }
            }


        } else {
            $this->set('playerIsLogin', 0);
        }

        $this->set('leveledUpList', $this->Fighters->getLeveledUpList());
    }

    public function sight() {

        $this->loadModel('Events');
//session
        $session = $this->request->session();


// Default for the initial aparition and whenever you reload the page
        $data["direction"] = "right";

// Load model and set the matrix's size
        $this->loadModel('Fighters');
        $this->set('matX', $this->Fighters->getMatrixX());
        $this->set('matY', $this->Fighters->getMatrixY());

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

    public function diary() {
        $this->loadModel('Events');

        $this->set('eventsList', $this->Events->getEventsList());
        $this->set('eventsCount', $this->Events->find('all')->count());
    }

    public function guild() {
        $this->loadModel('Guilds');
        $this->loadModel('Fighters');


        $session = $this->request->session();
        if ($session->check('playerEmailLogin')) {
            $playerIdLogin = $session->read('playerIdLogin');
            $this->set('playerFighterList', $this->Fighters->getPlayerFighterList($playerIdLogin));
            $this->set('guildList', $this->Guilds->getGuildList());

            $this->set('guildCount', $this->Guilds->find('all')->count());
            //Function that counts how many fighters there are per guild AND shows all guilds (even when there are no fighters. Much harder to do than the idea suggests...)
            //Ideally, put function in GuildsTable, but impossible to link Guilds and Fighters to make the associated tables query
            $fighterPerGuildCounter = 0;
            for ($i = 0; $i < $this->Guilds->find('all')->count(); $i++) {
                $guildCountTable[$i][0] = $this->Guilds->find('all')->toArray()[$i]->name;
                $guildCountTable[$i][1] = $this->Guilds->find('all')->toArray()[$i]->id;
                for ($j = 0; $j < $this->Fighters->find('all')->count(); $j++) {
                    if ($this->Fighters->find('all')->toArray()[$j]->guild_id == $this->Guilds->find('all')->toArray()[$i]->id) {
                        $fighterPerGuildCounter++;
                    }
                    $guildCountTable[$i][2] = $fighterPerGuildCounter;
                }
                $fighterPerGuildCounter = 0;
            }
            $this->set('guildCountTable', $guildCountTable);

            $newGuild = $this->request->getData();

            $guildNameInDb = 0;  //Variable testing if fighter name already exists
            $guild = $this->Guilds->find('all');
            $guildArray = $guild->toArray();

            if (isset($newGuild['name'])) {  //What is being tested?
                for ($i = 0; $i < count($guildArray); $i++) {
                    if ($guildArray[$i]['name'] == $newGuild['name']) {

                        $guildNameInDb = 1;
                    }
                }
                if ($guildNameInDb != 1) {
                    $this->Guilds->addANewGuild($this->request->getData());
                    //$fighterEvent = $this->Fighters->getFighterByName($newFighter['name'])[0];
                    //$this->Events->addNewPlayerEvent($fighterEvent);
                }
                if ($guildNameInDb == 1) {
                    $guildNameInDb = 'A guild of this name already exists';
                } else {
                    $guildNameInDb = 'Your guild has been created!';
                }
                $this->set('guildNameInDb', $guildNameInDb);
            }


            $data = $this->request->getData();

            $playerFighterList = $this->Fighters->getPlayerFighterList($playerIdLogin);
            $this->set('playerFighterList', $playerFighterList);

            $guildList = $this->Guilds->getGuildList();
            $this->set('guildList', $guildList);

            if (isset($data['fighterChosenForGuild']) && isset ($data['guildChosenForFighter'] )) {
                $fighterChosen = $playerFighterList[$data['fighterChosenForGuild']];
                $guildChosen =  $guildList[$data['guildChosenForFighter']];

                $this->Fighters->joinGuild($guildChosen, $fighterChosen);
            }


        }
    }

}

?>
