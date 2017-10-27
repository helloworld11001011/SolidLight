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
        for ($i=0; $i < $Query->count(); $i++) {
            $deadFightersArray[$i][0] = $Array[$i]->month;
            $deadFightersArray[$i][1] = $Array[$i]->count;
        }
        return $deadFightersArray;
    }

    function getDeadFightersAmount () {
        $deadFighterCountAmount = $this->find('all', array(
            'conditions' => array('name like "Death %"')
        ))->count();
        pr($deadFighterCountAmount);
        return $deadFighterCountAmount;
    }

    function addNewEvent($arg) {

        $eventTable = TableRegistry::get('events');
        $event = $eventTable->newEntity();

        echo "ok";

        if ($arg == 1) {

            $event->name = "Bobby attaque Paul et le tue";
            $event->date = Time::now();
            $event->coordinate_x = 1;
            $event->coordinate_y = 1;

        } else if ($arg == 2) {

            $event->name = "Bobby attaque Paul et le touche";
            $event->date = Time::now();
            $event->coordinate_x = 1;
            $event->coordinate_y = 1;

        } else if ($arg == 3) {

            $event = "Bobby attaque Paul et le rate";
            $event->date = Time::now();
            $event->coordinate_x = 1;
            $event->coordinate_y = 1;
        }

        echo "<br>";
        echo " evenement: Bobby attaque Paul et le touche --> créé";

        //$eventTable->save($event);
    }

}

?>
