<h2>Inbox</h2>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Inbox</title>
        <?php echo $this->Html->css('inbox'); ?>
    </head>

    <body>
        <div class="mainContainer">
            <div class="boxDialog">
                <div class="messagesBox">

                    <?php
                    for($i=0; $i<$nbMessages; $i++) {
                        echo "<div class='messageBubbleDiv'>";
                            echo "<div class='messageBubble'>";
                                echo $messagesArray[$i]["message"];
                            echo "</div>";
                        echo "</div>";
                    }
                    ?>

                </div>
                <div class="writeBox">
                    <div class="messageType">

                    </div>
                    <div class="sendBtnDiv">

                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
