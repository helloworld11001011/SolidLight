<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class FightersTable extends Table
{
  //Displaying all the fighters owned by a player
  //TODO: select fighters with 'where id = ' clause for query
  function getFighterList () {
    $fighterList = $this -> find('all');
    $fighterListArray = $fighterList -> toArray();
    // pr($fighterListArray);
    return $fighterListArray;
  }

  function getFighterTableWidth () {
    return 9;
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

  function getSkillSight () {
    $Sight = $this->find('all')->first();
    return $Sight["skill_sight"];
  }

  function getSkillStrength () {
    $Strength = $this->find('all')->first();
    return $Strength["skill_strength"];
  }

  function getSkillHealth () {
    $Health= $this->find('all')->first();
    return $Health["skill_health"];
  }

  function getCurrentHealth () {
    $current_health= $this->find('all')->first();
    return $current_health["current_health"];
  }

  //For the player board
  function getX(){
    return 15;
  }

  function getY(){
    return 10;
  }

  //Allows the player to create his fighter
  //TODO: get the fighter to automatically start level 1, with all skills at 1 and health at maximum (10?)
  //TODO: X and Y position must be decided when the fighter joins the arena
  function addANewFighter($arg) {
    $fighterData = $arg;
    $fighterTable = TableRegistry::get('fighters');
    $fighter = $fighterTable->newEntity();

    $fighter->name = $fighterData['name'];
    $fighter->player_id = 'b33';  //
    $fighter->coordinate_x = $fighterData['Coordinate_X'];
    $fighter->coordinate_y = $fighterData['Coordinate_Y'];
    $fighter->level = $fighterData['level'];
    $fighter->xp = $fighterData['xp'];
    $fighter->skill_sight = $fighterData['skill_sight'];
    $fighter->skill_strength = $fighterData['skill_strength'];
    $fighter->skill_health = $fighterData['skill_health'];
    $fighter->current_health = $fighterData['current_health'];

    $fighterTable->save($fighter);
  }

  function getFightersPos(){
      $allFighters = $this -> find('all', array());
  }
}
?>
