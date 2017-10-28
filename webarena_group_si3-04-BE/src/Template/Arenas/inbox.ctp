<?php

$fighterCoId = 1;

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Inbox</title>
        <?php echo $this->Html->css('inbox'); ?>
    </head>

    <body>
        <div class="mainContainer">
            <h2>INBOX</h2>
            <div class="boxDialog">
                <div class="messagesBox">

                    <?php
                    for($i=0; $i<$nbMessages; $i++) {

                        if($messagesArray[$i]["fighter_id_from"] == $fighterCoId){
                            echo "<div class='messageBubbleDivMine'>";
                                echo "<div class='messageBubbleMine'>";
                                    echo $messagesArray[$i]["message"];
                                echo "</div>";
                            echo "</div>";
                        }
                        else {
                            echo "<div class='messageBubbleDiv'>";
                                echo "<div class='messageBubble'>";
                                    echo $messagesArray[$i]["message"];
                                echo "</div>";
                            echo "</div>";
                        }
                    }
                    ?>

                </div>
                <div class="writeBox">

                    <?php
                    echo $this->Form->create('Message', ['class'=>'coco']);
                    echo $this->Form->input('message',['id'=>'messageInput', 'label'=>false]);
                    echo $this->Form->input('fighterCo', ['type' => 'hidden', 'value' => $fighterCoId]);
                    echo $this->Form->input('fighterTo', ['type' => 'hidden', 'value' => 2]);
                    echo $this->Form->submit(__('SEND'));
                    echo $this->Form->end();
                    ?>

                </div>
            </div>
        </div>
    </body>
</html>
