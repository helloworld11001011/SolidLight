<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class GuildsTable extends Table {
    function getGuildList () {
        $Query = $this->find('all');
        $guildList = $Query->toArray();
        return $guildList;
    }
}

?>
