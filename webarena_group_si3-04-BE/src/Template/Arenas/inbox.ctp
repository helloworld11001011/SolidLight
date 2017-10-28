<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Inbox</title>
        <?php echo $this->Html->css('inbox'); ?>
    </head>

    <body>
        <?php
        if($fighterIsChosen) {
            ?>
            <div class="mainContainer">
                <h2>INBOX</h2>
                <div class='maxiContainer'>
                <div id='fightersContainer'>
                    <?php
                    if(isset($otherFightersList)) {
                        for($i=0; $i<count($otherFightersList); $i++) {
                            if($otherFightersList[$i]['id'] == $fighterFrom) {
                            ?>
                                <div id='fighterChosenDiv'>
                                    <?php
                                    $pic= strval($otherFightersList[$i]['id']) .'.png';
                                    echo $this->Html->image($pic);
                                    echo $otherFightersList[$i]['name'];
                                    echo $this->Form->postButton('', null, [ "class"=>"btnTalk", "data" => [ "fighterWithId" => $otherFightersList[$i]['id']]]);
                                    ?>
                                </div>
                            <?php
                            }
                            else {
                                ?>
                                    <div id='fighterDiv'>
                                        <?php
                                        $pic= strval($otherFightersList[$i]['id']) .'.png';
                                        echo $this->Html->image($pic);
                                        echo $otherFightersList[$i]['name'];
                                        echo $this->Form->postButton('', null, [ "class"=>"btnTalk", "data" => [ "fighterWithId" => $otherFightersList[$i]['id']]]);
                                        ?>
                                    </div>
                                <?php
                            }
                        }
                    }
                    ?>
                </div>
                <div class="boxDialog">
                    <div class="messagesBox">

                        <?php
                        if(isset($messagesArray)) {
                            for($i=0; $i<count($messagesArray); $i++) {

                                if($messagesArray[$i]["fighter_id_from"] == $fighterChosenId){
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
                        }
                        ?>

                    </div>
                    <div class="writeBox">

                        <?php
                        echo $this->Form->create('Message', ['class'=>'coco']);
                        echo $this->Form->input('message',['id'=>'messageInput', 'label'=>false]);
                        echo $this->Form->input('fighterCo', ['type' => 'hidden', 'value' => $fighterChosenId]);
                        echo $this->Form->input('fighterTo', ['type' => 'hidden', 'value' => $fighterFrom]);
                        echo $this->Form->submit(__('SEND'));
                        echo $this->Form->end();
                        ?>

                    </div>
                </div>
            </div>
            <?php
        }
        else {
            if($playerIsLogin) {
                echo "YOU DID NOT CHOOSE YOUR FIGHTER MOTHERFUCKER";
                ?>
                <button onclick="location.href='fighter'" type="button">FIGHTER</button>
                <?php
            }
            else {
                echo "YOU ARE NOT CONNECTED MOTHERFUCKER";
                ?>
                <button onclick="location.href='login'" type="button">LOGIN</button>
                <?php
            }
        }

        ?>
    </body>
</html>
