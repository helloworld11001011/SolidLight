<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class FightersTable extends Table
{
  function getBestFighter () {
    $bestFighter = $this->find('all')->order(["Fighters.level" => "DESC"])->first();
    return $bestFighter["name"];
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
