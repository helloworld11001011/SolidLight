<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class EventsTable extends Table {
    //Gets the total amount of dead fighters
    //TODO: get them with a date in order to build
    function getDeadFighters () {
        $deadFighterCount = $this->find('all', array(
            'conditions' => array('Fighters.current_health = -1')
        ))->count();
        pr($deadFighterCount);
    }
}
 ?>
