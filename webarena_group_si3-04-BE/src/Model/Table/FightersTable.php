<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class FightersTable extends Table
{
  //Displaying all the fighters owned by a player
  //TODO: select fighters with 'where id = ' clause for query
  function getFighterList () {
    $fighterList = $this -> find('all') -> order(["Fighters.player_id" => "Desc"]);
    $fighterListArray = $fighterList -> toArray();
    foreach ($fighterListArray as $fighterElement) {
      pr($fighterElement);
    }
  }

  //For the player's fighter information
  function getFighterId () {
    $fighter_id = $this->find('all')->first();
    return $fighter_id["id"];
  }

  function getFighterName () {
    $fighter_name = $this -> find('all')->first();
    return $fighter_name["name"];
  }

  function getCoordX () {
    $coord_x = $this->find('all')->first();
    return $coord_x["coordinate_x"];
  }

  function getCoordY () {
    $fighter = $this->find('all')->first();
    return $fighter["coordinate_y"];
  }

  function getLvl () {
    $lvl = $this->find('all')->first();
    return $lvl["level"];
  }

  function getXP () {
    $XP = $this->find('all')->first();
    return $XP["xp"];
  }

  function getSightSkill () {
    $Sight = $this->find('all')->first();
    return $Sight["skill_sight"];
  }

  function getStrengthSkill () {
    $Strength = $this->find('all')->first();
    return $Strength["skill_strength"];
  }

  function getHealthSkill () {
    $Health= $this->find('all')->first();
    return $Health["skill_health"];
  }

  function getCurrentHealth () {
    $current_health= $this->find('all')->first();
    return $current_health["current_health"];
  }

  function getNextAction () {
    $next_action = $this -> find('all')->first();
    return $next_action["next_action_time"];
  }

  //For the player board
  function getX(){
    return 15;
  }

  function getY(){
    return 10;
  }
}
?>
