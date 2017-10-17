<?php
namespace App\Model\Table;

use Cake\ORM\Table;

class FightersTable extends Table
{
  //Displaying all the fighters owned by a player
  //TODO: select fighters with 'where id = ' clause for query
  function getFighterList () {
    $fighterList = $this -> find('all', array (
      'fields' => array (
        'fighters.name',
        'fighters.level',
        'fighters.xp',
        'fighters.current_health',
        'fighters.coordinate_x',
        'fighters.coordinate_y',
        'fighters.skill_sight',
        'fighters.skill_strength',
        'fighters.skill_health',
        'fighters.next_action_time'
      )
    ));
    // $fighterList = $this -> find('all');
    $fighterListArray = $fighterList -> toArray();
    pr($fighterList);
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
    
    function getFightersPos(){
        $allFighters = $this -> find('all', array());
        
    }


    
}
?>
