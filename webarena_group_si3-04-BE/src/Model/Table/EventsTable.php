<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

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
}


 ?>
