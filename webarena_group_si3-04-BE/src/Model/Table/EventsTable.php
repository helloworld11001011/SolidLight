<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\I18n\Time;

class EventsTable extends Table {

    //Gets the total amount of dead fighters
    //TODO: get them with a date in order to build timeline of deaths in hall of fame
    function getDeadFighters () {
        $Query = $this->find('all');
        $Query
            ->select([
                'Events.date',
                'count' => $Query->func()->count('*')
            ])
            ->where(['Events.name LIKE "Death %"'])
            ->group('MONTH(Events.date)');
        $Array = $Query->toArray();
        return $Array;
    }
    
     function addNewEvent() {

        $eventTable = TableRegistry::get('events');
        $event = $eventTable->newEntity();
        
        //ajoute un truc au champs 'name' selon le data reçu
        $event->name = "Bobby attaque Paul et le touche";
        $event->date = Time::now();
        $event->coordinate_x = 1;
        $event->coordinate_y = 1;
        
        echo " evenement: Bobby attaque Paul et le touche --> créé";

        $eventTable->save($event);
    }
}


 ?>
