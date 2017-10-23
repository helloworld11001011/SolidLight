<?php

session_start();

$_SESSION['figtherCoId'] = 1;

$fighterCoId = $_SESSION['figtherCoId'];

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
                    <div class="messageType">
                        <input id="messageInput" type="text" name="message" />
                    </div>
                    <div class="sendBtnDiv">
                        <button id="btnSend">SEND</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
