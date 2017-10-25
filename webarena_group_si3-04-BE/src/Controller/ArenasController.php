<?php
namespace App\Controller;
use App\Controller\AppController;
/**
* Personal Controller
* User personal interface
*
*/
class ArenasController  extends AppController
{
    public function inbox() {
        $this -> loadModel('Messages');

        if($this->request->is('post'))
        {
            $this->Messages->addANewMessage($this->request->getData());
        }

        $messages = $this->Messages->find('all');
        $messagesArray = $messages->toArray();
        $nbMessages = count($messagesArray);
        $this->set('messagesArray', $messagesArray);
        $this->set('nbMessages', $nbMessages);
    }

    public function hallOfFame () {
        $this->loadModel('Fighters');
        $this->loadModel('Events');

        $this -> set('fighterDistribution', $this->Fighters->getFighterDistribution());
        $this -> set('deadFighterCount', $this->Events->getDeadFighters());
    }

    public function index () {
        $this -> loadModel('Fighters');

        //Retrieving every fighter currently in the game (for leaderboards)
        $this -> set('fighterList', $this -> Fighters -> getFighterList());
        $this -> set('fighterCount', $this -> Fighters -> find('all') -> count());
        $this -> set('fighterTableWidth', $this -> Fighters -> getFighterTableWidth());
    }

    public function login ()
    {
        $this -> loadModel('Players');
        $newPlayer = $this->request->getData();
        $session = $this->request->session();

        $goodToGo = 0;
        $emailInDB = 0;
        $playerLogin  = 0;
        $players = $this->Players->find('all');
        $playersArray = $players->toArray();

        if($this->request->is('post'))
        {
            if($newPlayer['emailLogin']) {
                for ($i=0; $i<count($playersArray); $i++) {
                    if($playersArray[$i]['email'] == $newPlayer['emailLogin'] && $playersArray[$i]['password'] == $newPlayer['passwordLogin']) {
                        $goodToGo = 1;
                        $playerLogin = $newPlayer['emailLogin'];
                        $session->write('playerEmailLogin', $playerLogin);
                        $playerEmailLogin = $session->read('playerEmailLogin');
                        pr($playerEmailLogin);
                    }
                }
            }

            if ($goodToGo == 1) {
                $goodToGo = 'Good to go';
            }
            else {
                $goodToGo = 'Not good to go';
            }
            if($playerLogin) {
                $this->set('playerLogin', $playerLogin);
            }

            $this->set('goodToGo', $goodToGo);

            if ($newPlayer['email'] && $newPlayer['password']) {
                for ($i=0; $i<count($playersArray); $i++) {
                    if($playersArray[$i]['email'] == $newPlayer['email']) {
                        $emailInDB = 1;
                    }
                }
                if($emailInDB != 1) {
                    $this->Players->addANewPlayer($this->request->getData());
                }
                if ($emailInDB == 1) {
                    $emailInDB = 'Your player is already in DB';
                }
                else {
                    $emailInDB = 'Your player is saved';
                }
                $this->set('emailInDB', $emailInDB);
            }
        }
    }

    public function fighter ()
    {
        $this -> loadModel('Fighters');

        //Retrieving the fighter list (for displaying a player's fighters)
        //TODO: get list based on current player ID
        $this -> set('playerFighterList', $this -> Fighters -> getPlayerFighterList());

        //Finding the amount of fighters available to the player and the amount of columns we want for the player fighter table
        //TODO: get condition on player ID
        $this -> set('playerFighterCount', $this -> Fighters -> find('all') -> count());
        $this -> set('fighterTableWidth', $this -> Fighters -> getFighterTableWidth());

        //Retrieving individual compopnents
        $this -> set('fighter_id', $this -> Fighters -> getFighterId());
        $this -> set('fighter_name', $this -> Fighters -> getFighterName());
        $this -> set('coord_x', $this -> Fighters -> getCoordX());
        $this -> set('coord_y', $this -> Fighters -> getCoordY());
        $this -> set('lvl', $this -> Fighters -> getLvl());
        $this -> set('XP', $this -> Fighters -> getXP());
        $this -> set('sight_skill', $this -> Fighters -> getSkillSight());
        $this -> set('strength_skill', $this -> Fighters -> getSkillStrength());
        $this -> set('health_skill', $this -> Fighters -> getSkillHealth());
        $this -> set('current_health', $this -> Fighters -> getCurrentHealth());

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

    public function sight()
    {
        $this -> loadModel('Fighters');
        $this -> set('x', $this->Fighters->getX());
        $this -> set('y', $this->Fighters->getY());
        
        

        // Call the move function
        if($this->request->is("post")) {
            $this->Fighters->move($this->request->getData());
        }
        $currentFighterId= 1; /// For testing only, has to be replaced
        $this -> set('currentFighter', $this->Fighters->getFighterById($currentFighterId));

        //Retrieving every fighter currently in the game (for positions)
        $this -> set('fighterList', $this -> Fighters -> getFighterList());
        $this -> set('fighterCount', $this -> Fighters -> find('all') -> count());
    }

    public function diary()
    {

    }

   /*
    * Cours du prof pour les formulaires, verifie que les info envoyez son bien en POST pour ensuite les traiter
    *
    public function profile()
    {

        $this->loadModel("Player");

         if($this->request->is("post")) {

            $this->request->getData("email");
            ...

        }

        $player = $this->gett(42);
        $this->set("player", $player);


    }
    */

}
