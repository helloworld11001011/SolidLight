<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class EventsTable extends Table {

    //Gets the total amount of dead fighters
    //TODO: get them with a date in order to build timeline of deaths in hall of fame
    function getDeadFighters() {
        $Query = $this->find();
        $month = $Query->func()->month([
            'date' => 'identifier'
        ]);
        // pr($month);
        $Query->select([
                    'month' => $month,
                    'count' => $Query->func()->count('*')
                ])
                ->where(['name LIKE "Death %"'])
                ->group('MONTH(Events.date)');

        $Array = $Query->toArray();

        //Converting the CakePHP Object Array into a regular array
        for ($i=0; $i < 12; $i++) {
            $deadFightersArray[$i][0] = 0;
            $deadFightersArray[$i][1] = 0;
        }
        for ($i=0; $i < $Query->count(); $i++) {
            $deadFightersArray[$Array[$i]->month-1][0] = $Array[$i]->month;
            $deadFightersArray[$Array[$i]->month-1][1] = $Array[$i]->count;
        }
        pr($deadFightersArray);
        return $deadFightersArray;
    }

    function getCreatedFighters () {
        $Query = $this->find();
        $month = $Query->func()->month([
            'date' => 'identifier'
        ]);
        $Query->select([
                    'month' => $month,
                    'count' => $Query->func()->count('*')
                ])
                ->where(['name LIKE "%entered%"'])
                ->group('MONTH(Events.date)');

        $Array = $Query->toArray();

        //Converting the CakePHP Object Array into a regular array
        for ($i=0; $i < 12; $i++) {
            $createdFightersArray[$i][0] = 0;
            $createdFightersArray[$i][1] = 0;
        }
        for ($i=0; $i < $Query->count(); $i++) {
            $createdFightersArray[$Array[$i]->month-1][0] = $Array[$i]->month;
            $createdFightersArray[$Array[$i]->month-1][1] = $Array[$i]->count;
        }
        pr($createdFightersArray);
        return $createdFightersArray;
    }

    function getDeadFightersAmount() {
        $deadFighterCountAmount = $this->find('all', array(
                    'conditions' => array('name like "Death %"')
                ))->count();
        return $deadFighterCountAmount;
    }

    function addNewFightEvent($success, $attack, $defense) {

        $eventTable = TableRegistry::get('events');
        $event = $eventTable->newEntity();

        $message="";

        if ($success["success"] == 1) {

            $event->name = "Death of " . $defense['name'] . " by " . $attack['name'] . " ! ";
            $event->date = Time::now();
            $event->coordinate_x = $defense["coordinate_x"];
            $event->coordinate_y = $defense["coordinate_y"];
            $message.= "<br>";
            $message.= "event kill";
        } else if ($success["success"] == 2) {


            $event->name = $attack['name'] . " acttaks " . $defense['name'] . " but he survived ! ";
            $event->date = Time::now();
            $event->coordinate_x = $defense["coordinate_x"];
            $event->coordinate_y = $defense["coordinate_y"];
            $message.= "<br>";
            $message.= "event no kill";
        } else if ($success["success"] == 3) {

            $event->name = $attack['name'] . " acttaks " . $defense['name'] . " but misses him ! ";
            $event->date = Time::now();
            $event->coordinate_x = $defense["coordinate_x"];
            $event->coordinate_y = $defense["coordinate_y"];
            $message.= "<br>";
            $message.= "event block ";
        }
        $eventTable->save($event);

        //$success["message"].= $message;
        return $success;
    }

    function addNewPlayerEvent($newfighter) {

        $eventTable = TableRegistry::get('events');
        $event = $eventTable->newEntity();

        $event->name = $newfighter['name'] . " entered the arena ! ";
        $event->date = Time::now();
        $event->coordinate_x = $newfighter["coordinate_x"];
        $event->coordinate_y = $newfighter["coordinate_y"];

        $eventTable->save($event);
    }

    function addNewScreamEvent($fighterChosen, $arg) {

        $eventTable = TableRegistry::get('events');
        $event = $eventTable->newEntity();

        $event->name = $fighterChosen . " screams " . $arg;
        $event->date = Time::now();
        $event->coordinate_x = 0;
        $event->coordinate_y = 0;

        $eventTable->save($event);
    }


    function getEventsList () {
        $Query = $this->find('all')->order(['date' => 'DESC']);
        $eventsList = $Query->toArray();
        return $eventsList;
    }
}

?>
