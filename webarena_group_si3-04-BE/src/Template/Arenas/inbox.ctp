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
                <div class="black-background">
                    <div class="neon-effect">
                        <span class="flickering">I</span><span class="flickering" id="offset">N</span><span id='normal'>BOX</span>
                    </div>
                </div>
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
                                    echo $this->Form->postButton($otherFightersList[$i]['name'], null, [ "class"=>"btnTalk", "data" => [ "fighterWithId" => $otherFightersList[$i]['id']]]);
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
                                        echo $this->Form->postButton($otherFightersList[$i]['name'], null, [ "class"=>"btnTalk", "data" => [ "fighterWithId" => $otherFightersList[$i]['id']]]);
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
                                            ?>
                                            <p class='msgText'>
                                            <?php
                                                echo $messagesArray[$i]["message"];
                                            ?>
                                            </p>
                                            <?php
                                        echo "</div>";
                                    echo "</div>";
                                }
                                else {
                                    echo "<div class='messageBubbleDiv'>";
                                        echo "<div class='messageBubble'>";
                                            ?>
                                            <p class='msgText'>
                                            <?php
                                                echo $messagesArray[$i]["message"];
                                            ?>
                                            </p>
                                            <?php
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
                ?>
                <div class='errorDiv'>
                    <p class='errorMsg'>
                    <?php
                        echo "YOU NEED TO CHOOSE A FIGHTER TO ACCESS THIS PAGE";
                    ?>
                    </p>
                    <button class='errorBtn' onclick="location.href='fighter'" type="button">FIGHTER</button>
                </div>
                <?php
            }
            else {
                ?>
                <div class='errorDiv'>
                    <p class='errorMsg'>
                    <?php
                        echo "YOU NEED TO BE LOGGED IN TO ACCESS THIS PAGE";
                    ?>
                    </p>
                    <button class='errorBtn' onclick="location.href='login'" type="button">LOGIN</button>
                </div>
                <?php
            }
        }

        ?>
    </body>
</html>
