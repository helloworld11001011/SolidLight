<?php

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class GuildsTable extends Table {

    function addANewGuild($arg) {

        $guildData = $arg;
        $guildTable = TableRegistry::get('guilds');
        $guild = $guildTable->newEntity();
        $guild->name = $guildData['name'];

        $guildTable->save($guild);
        
    }
    
    function getGuildList() {
        $guildList = $this->find('all', array(
            'order' => 'Guilds.id DESC'
        ));
        $guildListArray = $guildList->toArray();
        return $guildListArray;
    }
}

?>
