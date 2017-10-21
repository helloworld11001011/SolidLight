<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class FightersTable extends Table
{
  //Displaying all the fighters owned by a player

  //Get all fighters currently existing (for the scoreboard)
  function getFighterList () {
    $fighterList = $this -> find('all');
    $fighterListArray = $fighterList -> toArray();
    return $fighterListArray;
  }

  //TODO: select fighters with 'where id = ' clause for query
  function getPlayerFighterList () {
    $playerFighterList = $this -> find('all');
    $playerFighterListArray = $playerFighterList -> toArray();
    // pr($fighterListArray);
    return $playerFighterListArray;
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

  // The game board's dimensions
  function getX(){
    // width
    return 15;
  }
  function getY(){
    // height
    return 10;
  }
function fight($arg1, $arg2) {

        $attack = $arg1;
        $defense = $arg2;
        $random = rand(0, 20);
        $succes = 0;
        $currentxp = $attack->getXP();

        if ($random > (10 + $defense['lvl'] - $attack['lvl'])) {
            $succes = 1;
        }

        if ($succes) {
            if ($defense->getCurrentHealth() == 0) {
                $attack->set($currentxp + $defense->getLvl(), $this->Recipe->findById('xp'));
            } else {
                $attack->set($currentxp + 1, $this->Recipe->findById('xp'));
            }
        }

        function getFightersPos() {
            $allFighters = $this->find('all', array());
        }

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
    $fighter->coordinate_x = '0';
    $fighter->coordinate_y = '0';
    $fighter->level = '1';
    $fighter->xp = '0';
    
    if ($fighterData['Class'] == 0) {
         $fighter->skill_sight = '1';
         $fighter->skill_strength = '2';
         $fighter->skill_health = '2';
         $fighter->current_health = '2';
    
    }
    
    if ($fighterData['Class'] == 1) {
         $fighter->skill_sight = '2';
         $fighter->skill_strength = '1';
         $fighter->skill_health = '2';
         $fighter->current_health = '2';
    
    }
    
    if ($fighterData['Class'] == 2) {
         $fighter->skill_sight = '1';
         $fighter->skill_strength = '1';
         $fighter->skill_health = '1';
         $fighter->current_health = '3';
    
    }
    

    $fighterTable->save($fighter);
  }

  function getFightersPos(){
  /*    $allFighters = $this -> find('all');
      $allFightersPos = $allFighters -> toArray();
      pr($allFightersPos);
      
      $tab[][]= $allFightersPos["coordinate_"]
      return $allFightersPos;*/
  }
}
?>
