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
    public function index () {}

    public function login ()
    {
        $this -> loadModel('Players');
        $newPlayer = $this->request->getData();
        $goodToGo = 0;
        $emailInDB = 0;
        $playerLogin  = 0;
        $players = $this->Players->find('all');
        $playersArray = $players->toArray();
        //pr($newPlayer);die();
        if($newPlayer['emailLogin']) {
            //pr($players->toArray());die();
            for ($i=0; $i<count($playersArray); $i++) {
                if($playersArray[$i]['email'] == $newPlayer['emailLogin'] && $playersArray[$i]['password'] == $newPlayer['passwordLogin']) {
                    $goodToGo = 1;
                    $playerLogin = $newPlayer['emailLogin'];
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

        //if($playerLogin) {

        //}

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

    public function fighter ()
    {
        $this -> loadModel('Fighters');

        //Retrieving the fighter list (for displaying a player's fighters)
        $this -> set('fighterList', $this -> Fighters -> getFighterList());
        //Finding the amount of fighters available to the player
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
        $this -> set('next_action', $this -> Fighters -> getNextAction());
    }

    public function sight()
    {
        $this -> loadModel('Fighters');
        $this -> set('x', $this->Fighters->getX());
        $this -> set('y', $this->Fighters->getY());
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
