<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Filesystem\Folder;
use Cake\Filesystem\File;

class FightersTable extends Table {

    //Displaying all the fighters owned by a player
    //Get all fighters currently existing (for the scoreboard)
    function getFighterList() {
        $fighterList = $this->find('all', array(
            'order' => 'Fighters.level DESC'
        ));
        $fighterListArray = $fighterList->toArray();
        return $fighterListArray;
    }

    function getFighterDistribution() {
        $fighterDistribution = [
            $this->find('all', array(
                'conditions' => array('Fighters.level > 20')
            ))->count(),
            $this->find('all', array(
                'conditions' => array('Fighters.level BETWEEN 15.1 AND 20')
            ))->count(),
            $this->find('all', array(
                'conditions' => array('Fighters.level BETWEEN 10.1 AND 15')
            ))->count(),
            $this->find('all', array(
                'conditions' => array('Fighters.level BETWEEN 0 AND 10')
            ))->count()
        ];
        return $fighterDistribution;
    }

    //TODO: select fighters with 'where id = ' clause for query
    function getPlayerFighterList($playerIdLogin) {
        $fighterList = $this->find('all', array(
            'order' => 'Fighters.level DESC'
        ));
        $fighterListArray = $fighterList->toArray();
        $playerFighterListArray = [];
        for ($i = 0; $i < count($fighterListArray); $i++) {
            if ($fighterListArray[$i]['player_id'] == $playerIdLogin) {
                array_push($playerFighterListArray, $fighterListArray[$i]);
            }
        }

        return $playerFighterListArray;
    }

    function getOtherFightersList($playerIdLogin) {
        $fighterList = $this->find('all', array(
            'order' => 'Fighters.level DESC'
        ));
        $fighterListArray = $fighterList->toArray();
        $otherFighterListArray = [];
        for ($i = 0; $i < count($fighterListArray); $i++) {
            if ($fighterListArray[$i]['player_id'] != $playerIdLogin) {
                array_push($otherFighterListArray, $fighterListArray[$i]);
            }
        }

        return $otherFighterListArray;
    }

    // The game board's dimensions
    function getMatrixX() {
        // width
        return 15;
    }

    function getMatrixY() {
        // height
        return 10;
    }

    //fonction qui fait se battre 2 fighter avec les modif (dans la base de données) qui vont avec
    function fight($attack, $defense) {
        $defenseId = $defense['id'];
        $random = rand(0, 20);
        $success = array("success" => 0, "message" => "");
        $success["message"].= $attack['name']." attacks ".$defense['name']." with a total attack of ".$attack['skill_strength']."<br>";

        $fighterTable = TableRegistry::get('fighters');
        $defender = $fighterTable->get($defenseId);

        if ($random > (10 + $defense['level'] - $attack['level'])) {


            $success["message"].= "The attack succeeded ! <br>";

            if($this->checkGuildBonus($defense, $attack)){
                $newHealth = $defense['current_health'] - ( $attack['skill_strength'] + $this->checkGuildBonus($defense, $attack) );
            }else{
                $newHealth = $defense['current_health'] - $attack['skill_strength'];
            }

            if ($newHealth <= 0) {
                $success["success"] = 1;

                //changes the current health of defender in db
                $defender->current_health = $newHealth;
                $fighterTable->save($defender);

                $success["message"].= $defense['name']." is dead :'( ; ";
            } else if ($newHealth != 0) {

                $success["message"].= $defense['name']." did not die ! ";

                $success["success"] = 2;

                $defender->current_health = $newHealth;
                $fighterTable->save($defender);
            }

            return $success;
        } else {
            $success["success"] = 3;

            $success["message"].= $defense['name'];
            $success["message"].= " blocked the attack ! ";

            return $success;
        }
    }

    function xp($case, $attack, $defense) {

        $attackId = $attack['id'];
        $currentxp = $attack['xp'];

        $fighterTable = TableRegistry::get('fighters');
        $attackant = $fighterTable->get($attackId);

        $message="";

        //xp if the defense is killed
        if ($case == 1) {

            $killXp = $currentxp + $defense['level'] + 1;
            $message.= strval($killXp - $currentxp) . " xp won ! ";
            //$level = $attack['level'];

            /*  while ($killXp > 4) {

              $killXp = $killXp - 4;
              $level = $level + 1;
              echo 'Level up !';
              }

              if ($killXp == 4) {

              $killXp = 0;
              $level = $level + 1;
              echo 'Level up !';
              } */
        } else if ($case == 2) {

            $killXp = ($currentxp) + 1;
            $message.=  strval($killXp - $currentxp) . 'xp won';
        } else if ($case == 3) {

            $killXp = $currentxp;
            $message.=  strval($killXp - $currentxp) . 'xp won';
        }

        $attackant->xp = $killXp;
        $fighterTable->save($attackant);

        return $message;
    }

    function deleteFighter($defense) {

        /*
          $fighterList = $this->find('all');
          $fighterListArray = $fighterList->toArray();

          $defense = $fighterListArray[1];
         */
        $defenseId = $defense['id'];

        $fighterTable = TableRegistry::get('fighters');
        $defender = $fighterTable->get($defenseId);

        $fighterTable->delete($defender);
    }

    function totalFight($success, $attack, $defense) {
        switch ($success["success"]) {

            case 1:
                $success["message"].= $this->xp(1, $attack, $defense);
                //$this->Events->addNewEvent(1);
                $this->deleteFighter($defense);
                return $success;
                break;

            case 2:
                $success["message"].= $this->xp(2, $attack, $defense);
                //$this->Events->addNewEvent(2);
                return $success;
                break;

            case 3:
                $success["message"].= $this->xp(3, $attack, $defense);
                //$this->Events->addNewEvent(3);
                return $success;
                break;
        }
    }

    function addANewFighter($arg, $playerIdLogin) {
        //Allows the player to create his fighter
        //TODO: get the fighter to automatically start level 1, with all skills at 1 and health at maximum (10?)
        //TODO: X and Y position must be decided when the fighter joins the arena
        $fighterData = $arg;
        $fighterTable = TableRegistry::get('fighters');
        $fighter = $fighterTable->newEntity();
        $fighter->name = $fighterData['name'];
        $fighter->player_id = $playerIdLogin;

        $fighters = $this->find('all');
        $fightersArray = $fighters->toArray();

        $restart = 1;

        while ($restart == 1) {

            $randX = rand(0, 14);
            $randY = rand(0, 9);
            $restart = 0;

            for ($i = 0; $i < count($fightersArray); $i++) {
                if (($fightersArray[$i]['coordinate_x'] == $randX) && ($fightersArray[$i]['coordinate_y'] == $randY)) {
                    $restart = 1;
                }
            }
        }

        $fighter->coordinate_x = $randX;
        $fighter->coordinate_y = $randY;
        $fighter->level = '1';
        $fighter->xp = '0';

        if ($fighterData['Class'] == 0) {
            $fighter->skill_sight = '2';
            $fighter->skill_strength = '1';
            $fighter->skill_health = '5';
            $fighter->current_health = '5';
        }

        if ($fighterData['Class'] == 1) {
            $fighter->skill_sight = '3';
            $fighter->skill_strength = '1';
            $fighter->skill_health = '5';
            $fighter->current_health = '5';
        }

        if ($fighterData['Class'] == 2) {
            $fighter->skill_sight = '2';
            $fighter->skill_strength = '1';
            $fighter->skill_health = '7';
            $fighter->current_health = '7';
        }

        if ($fighterData['Class'] == 3) {
            $fighter->skill_sight = '2';
            $fighter->skill_strength = '2';
            $fighter->skill_health = '5';
            $fighter->current_health = '5';
        }


        $fighterTable->save($fighter);
        $imgId= rand(1, 24);
        if( $fighterData["imgNum"] != ""){
            $imgId= $fighterData["imgNum"];
        }
        
        $file = new File('img/A'. $imgId .'.PNG'); // change here

        $file->copy('img/'.$fighter->id.'.PNG', true);
    }

    function move($data) {

        $f = $this->get($data["id"]);
        switch ($data["direction"]) {
            case "up":
                if (!$this->getCase($f->coordinate_x, $f->coordinate_y - 1) && $f->coordinate_y > 0) {
                    $f->coordinate_y = $f->coordinate_y - 1;
                    $this->save($f);
                }
                break;
            case "down":

                if (!$this->getCase($f->coordinate_x, $f->coordinate_y + 1) && $f->coordinate_y < $this->getMatrixY() - 1) {

                    $f->coordinate_y = $f->coordinate_y + 1;
                    $this->save($f);
                }
                break;
            case "right":

                if (!$this->getCase($f->coordinate_x + 1, $f->coordinate_y) && $f->coordinate_x < $this->getMatrixX() - 1) {

                    $f->coordinate_x = $f->coordinate_x + 1;
                    $this->save($f);
                }

                break;
            case "left":
                if (!$this->getCase($f->coordinate_x - 1, $f->coordinate_y) && $f->coordinate_x > 0) {
                    $f->coordinate_x = $f->coordinate_x - 1;
                    $this->save($f);
                }
                break;
            case "none":
                break;
            default :
                pr("Direction is invalid in move()");
        }
    }

    function getCase($x, $y) {

        $case = $this->find("all", ["conditions" => ["Fighters.coordinate_x" => $x,
                                                     "Fighters.coordinate_y" => $y]]);
        return $case->toArray();
    }

    function getFighterById($id) {
        $fighter = $this->find("all", ["conditions" => ["Fighters.id" => $id]]);
        return $fighter->toArray();
    }

    function getFighterByName($name) {

        $fighter = $this->find("all", ["conditions" => ["Fighters.name" => $name]]);
        return $fighter->toArray();
    }

    function getTargetedCase($direction, $currentFighter) {

        switch ($direction["direction"]) {
            case "up":
                $targetedCase = array("y" => $currentFighter[0]->coordinate_y - 1, "x" => $currentFighter[0]->coordinate_x);
                break;
            case "right":
                $targetedCase = array("y" => $currentFighter[0]->coordinate_y, "x" => $currentFighter[0]->coordinate_x + 1);
                break;
            case "down":
                $targetedCase = array("y" => $currentFighter[0]->coordinate_y + 1, "x" => $currentFighter[0]->coordinate_x);
                break;
            case "left":
                $targetedCase = array("y" => $currentFighter[0]->coordinate_y, "x" => $currentFighter[0]->coordinate_x - 1);
                break;
            case "null":
                $targetedCase = $direction["targetedCase"];
                break;
            default:
                pr("Invalid data in getTargetedCase()");
        }
        return $targetedCase;
    }

    function getAverageForSkills() {
        $Query = $this->find();
        $Query->select([
            'avg_sight' => $Query->func()->avg('skill_sight'),
            'avg_strength' => $Query->func()->avg('skill_strength'),
            'avg_health' => $Query->func()->avg('skill_health')
        ]);
        $averageSkills = $Query->toArray();
        return $averageSkills;
    }

    function getFightersPerTopGuilds() {
        $Query = $this->find();
        $Query->select([
            'members' => $Query->func()->count('*'),
            'guild_id' => 'Fighters.guild_id'
        ])
            ->limit('4')
            ->where(['not' => ['Fighters.guild_id' => 'null']])
            ->group('guild_id')
            ->order(['members' => 'DESC']);
        $fightersPerTopGuildArray = $Query->toArray();
        for ($i = 0; $i < 4; $i++) {
            $fightersPerTopGuild[$i] = $fightersPerTopGuildArray[$i]->members;
        }
        return $fightersPerTopGuild;
    }

    function getLeveledUpList() {
        $Query = $this->find();
        $Query->select(['name', 'xp'])->where(['xp >=' => '4']);
        $leveledUpList = $Query->toArray();
        return $leveledUpList;
    }

    function joinGuild($guild, $selectedFighter) {
        $fighterId = $selectedFighter;

        $fighterTable = TableRegistry::get('fighters');
        $guildFighter = $fighterTable->get($fighterId);

        $guildFighter->guild_id = $guild["id"];

        $fighterTable->save($guildFighter);
    }

    function levelUp($arg, $fighterChosen) {

        $fighterData = $arg;

        $fighterTable = TableRegistry::get('fighters');

        $fighter = $fighterTable->get($fighterChosen['id']);
        
           
            if ($fighterData == 0) {
                $fighter->skill_strength = $fighter['skill_strength'] + 1;
                $fighter->xp = $fighter['xp'] - 4;
                $fighter->level = $fighter['level'] + 1;
            }

            if ($fighterData == 1) {
                $fighter->skill_sight = $fighter['skill_sight'] + 1;
                $fighter->xp = $fighter['xp'] - 4;
                $fighter->level = $fighter['level'] + 1;
            }

            if ($fighterData == 2) {
                $fighter->skill_health = $fighter['skill_health'] + 3;
                $fighter->current_health = $fighter['skill_health'];
                $fighter->xp = $fighter['xp'] - 4;
                $fighter->level = $fighter['level'] + 1;
            }

            $fighterTable->save($fighter);
        }

    function checkGuildBonus($defense, $attack){

        $fighterList= $this->getFighterList();
        $x= $defense["coordinate_x"];
        $y= $defense["coordinate_y"];
        $guild= $attack["guild_id"];
        $bonus= -1;

        if($this->getCase($x  , $y-1)){
            if( $this->getCase($x  , $y-1)[0]->guild_id == $guild){ $bonus++; }
        }
        if($this->getCase($x+1, $y  )){
            if( $this->getCase($x+1, $y  )[0]->guild_id == $guild){ $bonus++; }
        }
        if($this->getCase($x  , $y+1)){
            if( $this->getCase($x  , $y+1)[0]->guild_id == $guild){ $bonus++; }
        }
        if($this->getCase($x-1, $y  )){
            if( $this->getCase($x-1, $y  )[0]->guild_id == $guild){ $bonus++; }
        }

        return $bonus;
    }

}


?>
