<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class PlayersTable extends Table
{

    function getMyPlayers(){

        $myPlayers = $this->find('all');
        return $myPlayers;
    }
    function addANewPlayer($arg) {
        $playerData = $arg;
        $playersTable = TableRegistry::get('players');
        $players = $playersTable->newEntity();

        $players->email = $playerData['email'];
        $players->password = password_hash($playerData['password'], PASSWORD_DEFAULT);


        $playersTable->save($players);
    }
}
