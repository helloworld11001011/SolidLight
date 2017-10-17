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
    public function index()
    {
        $this -> loadModel('Fighters');
        $this->set('myname', "Julien Elkhiati");
        $this -> set('bestFighter', $this -> Fighters -> getBestFighter());
    }

    public function login()
    {
        $this -> loadModel('Players');
        $newPlayer = $this->request->getData();
        $goodToGo = 0;
        $emailInDB = 0;
        $players = $this->Players->find('all');
        $playersArray = $players->toArray();
        //pr($newPlayer);die();
        if($newPlayer['emailLogin']) {
            //pr($players->toArray());die();
            for ($i=0; $i<count($playersArray); $i++) {
                if($playersArray[$i]['email'] == $newPlayer['emailLogin'] && $playersArray[$i]['password'] == $newPlayer['passwordLogin']) {
                    $goodToGo = 1;
                }
            }
        }
        //$this->set('newPlayer', $newPlayer);
        //$this->set('players', $players['email']);
        if ($goodToGo == 1) {
            $goodToGo = 'Good to go';
        }
        else {
            $goodToGo = 'Not good to go';
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

    public function fighter()
    {
        $this -> loadModel('Fighters');
        $query = $this -> Fighters -> find('all');
        foreach ($query as $row) {
          //Executing each line of the query
        }
        $this -> set('fighterList', $this -> Fighters -> getFighterList());
        $this -> set('bestFighter', $this -> Fighters -> getBestFighter());
        $this -> set('id', $this -> Fighters -> getId() );
        $this -> set('PosX', $this -> Fighters -> getPosX() );
        $this -> set('PosY', $this -> Fighters -> getPosY() );
        $this -> set('LVL', $this -> Fighters -> getlvl() );
        $this -> set('Xp', $this -> Fighters -> getXp() );
        $this -> set('Sight', $this -> Fighters -> getSight() );
        $this -> set('Strength', $this -> Fighters -> getStrength() );
        $this -> set('Health', $this -> Fighters -> getHealth() );
        $this -> set('CHealth', $this -> Fighters -> getCHealth() );
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
