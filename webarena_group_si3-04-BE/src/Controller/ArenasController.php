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

        if($session->check('fighterChosenId')) {

            $this->loadModel('Messages');
            $this->loadModel('Fighters');

            if ($this->request->is('post')) {
                $this->Messages->addANewMessage($this->request->getData());
            }

            $otherFightersList = $this->Fighters->getOtherFightersList($session->read('playerIdLogin'));
            $this->set('otherFightersList', $otherFightersList);

            $messages = $this->Messages->find('all');
            $messagesArray = $messages->toArray();
            $nbMessages = count($messagesArray);

            $this->set('fighterIsChosen', 1);
            $this->set('fighterChosenId', $session->read('fighterChosenId'));
            $this->set('fighterChosenName', $session->read('fighterChosenName'));
            $this->set('messagesArray', $messagesArray);
            $this->set('nbMessages', $nbMessages);
        }
        else {
            if($session->check('playerEmailLogin')) {
                $this->set('playerIsLogin', 1);
            }
            else {
                $this->set('playerIsLogin', 0);
            }
            $this->set('fighterIsChosen', 0);
        }
    }

    public function hallOfFame() {
        $this->loadModel('Fighters');
        $this->loadModel('Events');

        $this->set('fighterDistribution', $this->Fighters->getFighterDistribution());
        $this->set('deadFighterDistribution', $this->Events->getDeadFighters());
        $this->set('deadFighterCount', $this->Events->getDeadFightersAmount());
        $this->set('averageSkills', $this->Fighters->getAverageForSkills());
    }

    public function index() {
        $this->loadModel('Fighters');

        //Retrieving every fighter currently in the game (for leaderboards)
        $this->set('fighterList', $this->Fighters->getFighterList());
        $this->set('fighterCount', $this->Fighters->find('all')->count());
        $this->set('fighterTableWidth', $this->Fighters->getFighterTableWidth());
    }

    public function login() {
        $this->loadModel('Players');
        $newPlayer = $this->request->getData();
        $session = $this->request->session();

        $goodToGo = 0;
        $emailInDB = 0;
        $playerLogin = 0;
        $players = $this->Players->find('all');
        $playersArray = $players->toArray();

        if ($this->request->is('post')) {
            if ($newPlayer['emailLogin']) {
                for ($i = 0; $i < count($playersArray); $i++) {
                    if ($playersArray[$i]['email'] == $newPlayer['emailLogin'] && $playersArray[$i]['password'] == $newPlayer['passwordLogin']) {
                        $goodToGo = 1;
                        $playerLogin = $newPlayer['emailLogin'];
                        $session->write('playerEmailLogin', $playerLogin);
                        $session->write('playerIdLogin', $playersArray[$i]['id']);
                        $playerEmailLogin = $session->read('playerEmailLogin');
                        pr($playerEmailLogin);
                    }
                }
            }

            if ($goodToGo == 1) {
                $goodToGo = 'Good to go';
            } else {
                $session->write('playerEmailLogin', null);
                $playerEmailLogin = $session->read('playerEmailLogin');
                pr($playerEmailLogin);
                $goodToGo = 'Not good to go';
            }

            $this->set('goodToGo', $goodToGo);

            if ($newPlayer['email'] && $newPlayer['password']) {
                for ($i = 0; $i < count($playersArray); $i++) {
                    if ($playersArray[$i]['email'] == $newPlayer['email']) {
                        $emailInDB = 1;
                    }
                }
                if ($emailInDB != 1) {
                    $this->Players->addANewPlayer($this->request->getData());
                }
                if ($emailInDB == 1) {
                    $emailInDB = 'Your player is already in DB';
                } else {
                    $emailInDB = 'Your player is saved';
                }
                $this->set('emailInDB', $emailInDB);
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

            $newFighter = $this->request->getData();  //getData()?

            $nameInDb = 0;  //Variable testing if fighter name already exists
            $fighters = $this->Fighters->find('all');
            $fightersArray = $fighters->toArray();

            if (isset($newFighter['name'])) {  //What is being tested?
                for ($i = 0; $i < count($fightersArray); $i++) {
                    if ($fightersArray[$i]['name'] == $newFighter['name']) {
                        $nameInDb = 1;
                    }
                }
                if ($nameInDb != 1) {
                    $this->Fighters->addANewFighter($this->request->getData(), $playerIdLogin);
                }
                if ($nameInDb == 1) {
                    $nameInDb = 'A fighter of this name already exists';
                } else {
                    $nameInDb = 'Your fighter has been created!';
                }
                $this->set('nameInDb', $nameInDb);
            }

            $this->set('playerIsLogin', 1);
            $playerFighterList = $this->Fighters->getPlayerFighterList($playerIdLogin);
            $this->set('playerFighterList', $playerFighterList);

            if (isset($newFighter['fighterChosen'])) {
                $fighterChosen = $playerFighterList[$newFighter['fighterChosen']];
                $session->write('fighterChosenName', $fighterChosen['name']);
                $session->write('fighterChosenId', $fighterChosen['id']);
                pr($session->read('fighterChosenName'));
            }
        } else {
            $this->set('playerIsLogin', 0);
        }
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
                $attack = $this->Fighters->getFighterById($currentFighterId)[0];
                $defense = $this->Fighters->getCase($targetedCase["x"], $targetedCase["y"])[0];
                // Call the fight() function with the contenders as parameters if the targeted case si in fact a fighter
                if ($this->Fighters->getCase($targetedCase["x"], $targetedCase["y"]))
                    $this->Events->addNewEvent($this->Fighters->totalFight($this->Fighters->fight($attack, $defense), $attack, $defense), $attack, $defense);
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

        $this->Events->addNewEvent();
    }

}
