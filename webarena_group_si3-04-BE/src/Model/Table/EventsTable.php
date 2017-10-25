<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class EventsTable extends Table {
    
    //Gets the total amount of dead fighters
    //TODO: get them with a date in order to build timeline of deaths in hall of fame
    function getDeadFighters () {
        $deadFighterQuery = $this->find('all', array(
            'conditions' => array('Events.name LIKE "Death of %"')
        ));
        $deadFighterCount = $deadFighterQuery->count();
        pr($deadFighterCount);
    }
}


 ?>
