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
        for ($i = 0; $i < $Query->count(); $i++) {
            $deadFightersArray[$i][0] = $Array[$i]->month;
            $deadFightersArray[$i][1] = $Array[$i]->count;
        }
        return $deadFightersArray;
    }

    function getDeadFightersAmount() {
        $deadFighterCountAmount = $this->find('all', array(
                    'conditions' => array('name like "Death %"')
                ))->count();
        return $deadFighterCountAmount;
    }

    function addNewFightEvent($arg, $attack, $defense) {

        $eventTable = TableRegistry::get('events');
        $event = $eventTable->newEntity();


        if ($arg == 1) {

            $event->name = "Death of " . $defense['name'] . " by " . $attack['name'] . " ! ";
            $event->date = Time::now();
            $event->coordinate_x = $defense["coordinate_x"];
            $event->coordinate_y = $defense["coordinate_y"];
            echo "<br>";
            echo "event kill";
        } else if ($arg == 2) {


            $event->name = $attack['name'] . " acttaks " . $defense['name'] . " but he survived ! ";
            $event->date = Time::now();
            $event->coordinate_x = $defense["coordinate_x"];
            $event->coordinate_y = $defense["coordinate_y"];
            echo "<br>";
            echo "event no kill";
        } else if ($arg == 3) {

            $event->name = $attack['name'] . " acttaks " . $defense['name'] . " but misses him ! ";
            $event->date = Time::now();
            $event->coordinate_x = $defense["coordinate_x"];
            $event->coordinate_y = $defense["coordinate_y"];
            echo "<br>";
            echo "event block ";
        }
        $eventTable->save($event);
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

}

?>
