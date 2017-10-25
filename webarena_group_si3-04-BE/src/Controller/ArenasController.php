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
        $this->loadModel('Messages');

        if ($this->request->is('post')) {
            $this->Messages->addANewMessage($this->request->getData());
        }

        $messages = $this->Messages->find('all');
        $messagesArray = $messages->toArray();
        $nbMessages = count($messagesArray);
        $this->set('messagesArray', $messagesArray);
        $this->set('nbMessages', $nbMessages);
    }

    public function hallOfFame() {
        $this->loadModel('Fighters');
        $this->loadModel('Events');

        $this->set('fighterDistribution', $this->Fighters->getFighterDistribution());
        $this->set('deadFighterCount', $this->Events->getDeadFighters());
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
            }
            else {
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
        if($session->check('playerEmailLogin')) {
            $playerIdLogin = $session->read('playerIdLogin');
            pr($playerIdLogin);

            $this->set('playerIsLogin', 1);
            $this -> set('playerFighterList', $this -> Fighters -> getPlayerFighterList($playerIdLogin));

            //Finding the amount of fighters available to the player and the amount of columns we want for the player fighter table
            //TODO: get condition on player ID
            $this -> set('fighterTableWidth', $this -> Fighters -> getFighterTableWidth());

            $newFighter = $this->request->getData();  //getData()?
            $nameInDb = 0;  //Variable testing if fighter name already exists
            $fighters = $this->Fighters->find('all');
            $fightersArray = $fighters->toArray();

            if ($newFighter['name']) {  //What is being tested?
            for ($i=0; $i<count($fightersArray); $i++) {
                if($fightersArray[$i]['name'] == $newFighter['name']) {
                    $nameInDb = 1;
                }
            }
            if($nameInDb != 1) {
                $this->Fighters->addANewFighter($this->request->getData());
            }
            if ($nameInDb == 1) {
                $nameInDb = 'A fighter of this name already exists';
            } else {
                $nameInDb = 'Your fighter has been created!';
            }
            $this->set('nameInDb', $nameInDb);
            }


            $this->Fighters->fight();

        }

        else {
            $this->set('playerIsLogin', 0);
        }


        switch ($this->Fighters->fight()) {

            case 1:
                $this->Fighters->xp(1);
                $this->Events->addNewEvent(1);
                $this->Fighters->deleteFighter();

                break;

            case 2:
                $this->Fighters->xp(2);
                $this->Events->addNewEvent(2);
                break;

            case 3:
                $this->Fighters->xp(3);
                $this->Events->addNewEvent(3);
                break;
        }
    }

    public function sight()
    {
        $direction["direction"] = "up"; // For the initial aparition and whenever you reload the page
        $this -> loadModel('Fighters');
        $this -> set('matX', $this->Fighters->getMatrixX());
        $this -> set('matY', $this->Fighters->getMatrixY());

        $currentFighterId= 1; /// For testing only, has to be replaced


        // Call the move function
        if($this->request->is("post")) {
            $direction = $this->request->getData();
            $this->Fighters->move($direction);
        }

        $targetedCase= $this->Fighters->getTargetedCase($direction, $this->Fighters->getFighterById($currentFighterId));
        $this -> set('targetedCase', $targetedCase);


        $this -> set('currentFighter', $this->Fighters->getFighterById($currentFighterId));


        //Retrieving every fighter currently in the game (for positions)
        $this->set('fighterList', $this->Fighters->getFighterList());
        $this->set('fighterCount', $this->Fighters->find('all')->count());
    }

    public function diary() {

        $this->loadModel('Events');

        $this->Events->addNewEvent();
    }
}
