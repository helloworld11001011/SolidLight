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
        $this->set('myname', "Eliott Segard");
        $this -> set('bestFighter', $this -> Fighters -> getBestFighter());
    }

    public function login()
    {

    }

    public function fighter()
    {
        $this -> loadModel('Fighters');
        $query = $this -> Fighters -> find('all');
        foreach ($query as $row) {
          //Executing each line of the query
        }
        $this -> set('fighterQuery', $this -> Fighters -> getFighterList());
        $this -> set('bestFighter', $this -> Fighters -> getBestFighter());
    }

    public function sight()
    {

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
