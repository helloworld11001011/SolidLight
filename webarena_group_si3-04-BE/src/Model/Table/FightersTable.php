<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

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
                'conditions' => array('Fighters.level >= 10')
            ))->count(),
            $this->find('all', array(
                'conditions' => array('Fighters.level BETWEEN 8.1 AND 10')
            ))->count(),
            $this->find('all', array(
                'conditions' => array('Fighters.level BETWEEN 6.1 AND 8')
            ))->count(),
            $this->find('all', array(
                'conditions' => array('Fighters.level BETWEEN 4.1 AND 6')
            ))->count(),
            $this->find('all', array(
                'conditions' => array('Fighters.level BETWEEN 2.1 AND 4')
            ))->count(),
            $this->find('all', array(
                'conditions' => array('Fighters.level BETWEEN 0 AND 2')
            ))->count()
        ];
        return $fighterDistribution;
    }

    //TODO: select fighters with 'where id = ' clause for query
    function getPlayerFighterList($playerIdLogin) {
        $playerFighterList = $this->find('all', array(
            'order' => 'Fighters.level DESC'
        ));
        $fighterListArray = $playerFighterList->toArray();
        $playerFighterListArray = [];
        for ($i=0; $i<count($fighterListArray); $i++) {
            //pr($fighterListArray[$i]['player_id']);
            if($fighterListArray[$i]['player_id'] == $playerIdLogin) {
                array_push($playerFighterListArray, $fighterListArray[$i]);
            }
        }

        return $playerFighterListArray;
    }

    function getFighterTableWidth() {
        return 9;
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
    function fight() {

        $fighterList = $this->find('all');
        $fighterListArray = $fighterList->toArray();

        $attack = $fighterListArray[0];
        $defense = $fighterListArray[1];
        $defenseId = $defense['id'];
        $random = rand(0, 20);
        $success = 0;

        echo $attack['name'];
        echo " attacks ";
        echo $defense['name'];
        echo " with a total attack of ";
        echo $attack['skill_strength'];
        echo "<br>";

        $fighterTable = TableRegistry::get('fighters');
        $defender = $fighterTable->get($defenseId);

        if ($random > (10 + $defense['level'] - $attack['level'])) {


            echo "The attack succeeded ! ";
            echo "<br>";

            $newHealth = $defense['current_health'] - $attack['skill_strength'];

            if ($newHealth == 0) {

                $success = 1;

//changes the current health of defender in db
                $defender->current_health = $newHealth;
                $fighterTable->save($defender);

                echo $defense['name'];
                echo " is dead :'( ; ";
            } else if ($newHealth != 0) {

                echo $defense['name'];
                echo " did not die ! ";

                $success = 2;

                $defender->current_health = $newHealth;
                $fighterTable->save($defender);
            }

            return $success;
        } else {

            $success = 3;

            echo $defense['name'];
            echo " blocked the attack ! ";

            return $success;
        }
    }

    function xp($arg) {

        $fighterList = $this->find('all');
        $fighterListArray = $fighterList->toArray();

        $attack = $fighterListArray[0];
        $defense = $fighterListArray[1];
        $attackId = $attack['id'];
        $currentxp = $attack['xp'];

        $fighterTable = TableRegistry::get('fighters');
        $attackant = $fighterTable->get($attackId);


//xp if the defense is killed
        if ($arg == 1) {



            $killXp = $currentxp + $defense['level'] + 1;
            $level = $attack['level'];


            while ($killXp > 4) {

                $killXp = $killXp - 4;
                $level = $level + 1;
                echo 'Level up !';
            }

            if ($killXp == 4) {

                $killXp = 0;
                $level = $level + 1;
                echo 'Level up !';
            }
        } else if ($arg == 2) {

            $killXp = ($currentxp) + 1;
            $level = $attack['level'];

            if ($killXp == 4) {

                $killXp = 0;
                $level = $level + 1;
                echo 'Level up !';
            }
        } else if ($arg == 3) {

            $killXp = $currentxp;
            $level = $attack['level'];
            echo 'no xp won';
        }

        $attackant->xp = $killXp;
        $attackant->level = $level;
        $fighterTable->save($attackant);
    }

    function deleteFighter() {

        $fighterList = $this->find('all');
        $fighterListArray = $fighterList->toArray();

        $defense = $fighterListArray[1];
        $defenseId = $defense['id'];

        $fighterTable = TableRegistry::get('fighters');
        $defender = $fighterTable->get($defenseId);

        $fighterTable->delete($defender);


    }

    //Allows the player to create his fighter
    //TODO: get the fighter to automatically start level 1, with all skills at 1 and health at maximum (10?)
    //TODO: X and Y position must be decided when the fighter joins the arena
    function addANewFighter($arg, $playerIdLogin) {
        $fighterData = $arg;
        $fighterTable = TableRegistry::get('fighters');
        $fighter = $fighterTable->newEntity();
        $fighter->name = $fighterData['name'];
        $fighter->player_id = $playerIdLogin;
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

                if(!$this->getCase($f->coordinate_x, $f->coordinate_y+1) && $f->coordinate_y < $this->getMatrixY()-1 ){

                    $f->coordinate_y = $f->coordinate_y + 1;
                    $this->save($f);
                }
                break;
            case "right":

                if(!$this->getCase($f->coordinate_x+1, $f->coordinate_y) && $f->coordinate_x < $this->getMatrixX()-1 ){

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


    function getTargetedCase($direction, $currentFighter){
        
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

}

?>
