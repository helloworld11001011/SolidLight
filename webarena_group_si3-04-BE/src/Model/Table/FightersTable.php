<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class FightersTable extends Table
{
    function test(){
        return "Ok";
    }

    function getBestFighter(){

        $bestFighter = $this->find('all')->where(["Fighters.player_id" => "b33"])->first();
        return $bestFighter["name"];
    }

     function getId(){

        $id = $this->find('all')->where(["Fighters.player_id" => "b33"])->first();
        return $id["id"];
    }

    function getPosX(){

        $PosX = $this->find('all')->where(["Fighters.player_id" => "b33"])->first();
        return $PosX["coordinate_x"];
    }

    function getPosY(){

        $PosY = $this->find('all')->where(["Fighters.player_id" => "b33"])->first();
        return $PosY["coordinate_y"];
    }

    function getLvl(){

        $LVL = $this->find('all')->where(["Fighters.player_id" => "b33"])->first();
        return $LVL["level"];
    }

    function getXp(){

        $Xp = $this->find('all')->where(["Fighters.player_id" => "b33"])->first();
        return $Xp["xp"];
    }

    function getSight(){

        $Sight = $this->find('all')->where(["Fighters.player_id" => "b33"])->first();
        return $Sight["skill_sight"];
    }

     function getStrength(){

        $Strength = $this->find('all')->where(["Fighters.player_id" => "b33"])->first();
        return $Strength["skill_strength"];
    }

     function getHealth(){

        $Health= $this->find('all')->where(["Fighters.player_id" => "b33"])->first();
        return $Health["skill_health"];
    }

    function getCHealth(){

        $CHealth= $this->find('all')->where(["Fighters.player_id" => "b33"])->first();
        return $CHealth["current_health"];
    }

  function getFighterList () {
    $fighterQuery = $this -> find('all') -> order(["Fighters.level" => "Desc"]);
    pr($fighterQuery);
    return $fighterList;
  }

  function createFighter () {

  }

  function getX(){
      return 15;
  }
  function getY(){
      return 10;
  }
}
