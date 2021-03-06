<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\TableRegistry;

class MessagesTable extends Table
{
    function addANewMessage($arg) {
        $messageData = $arg;
        $messagesTable = TableRegistry::get('messages');
        $messages = $messagesTable->newEntity();
        if(isset($messageData['message'])) {
            if($messageData['message'] != '') {
                $messages->fighter_id_from = $messageData['fighterCo'];
                $messages->fighter_id = $messageData['fighterTo'];
                $messages->message = $messageData['message'];
                $messagesTable->save($messages);
            }
        }
    }
}
