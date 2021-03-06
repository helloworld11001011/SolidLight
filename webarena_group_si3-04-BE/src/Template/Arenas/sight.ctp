<?php
// refs to the css and js files in webroot
echo $this->Html->css('sight.css');


if($fighterIsChosen) {

    // Initialises a matrix of the size of the board
    for($i=0; $i<$matY; $i++){
        for($j=0; $j<$matX; $j++){
            $matrix[$i][$j] = 0;
        }
    }

    // Gets the coordinates from the fighterList
    for($i=0; $i<$fighterCount; $i++){
        $matrix[$fighterList[$i]->coordinate_y][$fighterList[$i]->coordinate_x] = $fighterList[$i]->id;
    }

    echo "<div id='maindiv'>\n<div id='matdiv'>\n<table class='mat'>\n";
    // for every row
    for($i=0; $i<$matY; $i++){
        echo "<tr>\n";
        // for every column
        for($j=0; $j<$matX; $j++){
            // Boolean, true if the current case is too far to be seen
            $isTooFar= abs($currentFighter[0]->coordinate_y - $i) + abs($currentFighter[0]->coordinate_x - $j) > $currentFighter[0]->skill_sight;

            // Creates the opening <td> tag and sets the title to the info
            echo getFighterInfo($matrix[$i][$j], $isTooFar, $fighterList, $fighterCount);

            // Don't show the cases that are futher away than the sight skill of the fighter
            if($isTooFar){
                echo $this->Html->image('rust.PNG', ['alt' => 'square_img']);
            }else{
                // Show the case that is curently being targeted except if there is a fighter on it
                if($i == $targetedCase["y"] && $j == $targetedCase["x"] && !$matrix[$i][$j]){
                    echo $this->Html->image('green_square_target.png', ['alt' => 'square_img']);
                }else{
                    // Show the fighter if there is one there
                    if($matrix[$i][$j]){
                        $pic= strval($matrix[$i][$j]).'.PNG';
                        echo $this->Html->image($pic, ['alt' => 'square_img']);
                    }else{
                        echo $this->Html->image('green_square.PNG', ['alt' => 'square_img']);
                    }
                }
            }
            echo "</td>\n";
        }
        echo "</tr>\n";
    }
    echo "</table>\n</div>\n";
    echo "<div id='navdiv'> <table class='nav'> \n<tr> \n<td> </td> \n<td>";
    echo $this->Form->postButton('UP', null, [ "data" => [ "direction" => "up", "id" => $currentFighter[0]->id, "attack" => "no"]]);
    echo "</td>\n<td></td>\n</tr>\n<tr>\n<td>";
    echo $this->Form->postButton('LEFT', null, [ "data" => [ "direction" => "left", "id" => $currentFighter[0]->id, "attack" => "no"]]);
    echo "</td>\n<td></td>\n<td>";
    echo $this->Form->postButton('RIGHT', null, [ "data" => [ "direction" => "right", "id" => $currentFighter[0]->id, "attack" => "no"]]);
    echo "</td>\n</tr>\n<tr>\n<td></td>\n<td>";
    echo $this->Form->postButton('DOWN', null, [ "data" => [ "direction" => "down", "id" => $currentFighter[0]->id, "attack" => "no"]]);
    echo "</td>\n<td></td>\n</tr>\n</table>\n";
    ?>
    <div id='attackBtnDiv'>
    <?php
    echo $this->Form->postButton('ATTACK', null, [ 'class'=>'attack-btn', "data" => [ "direction" => "null", "id" => $currentFighter[0]->id, "attack" => "yes", "targetedCase" =>["x" => $targetedCase["x"], "y" => $targetedCase["y"] ]]]);
    ?>
    </div>
    <div id='surDivInfo'>
    <?php
    echo "\n<div id='info'>";
    ?>
    <p id='message'>
    <?php
    echo $message;
    ?>
    </p>
    <?php
    echo "\n</div></div></div></div>";

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





function getFighterInfo($id, $isTooFar, $fighterList, $fighterCount){
    if($isTooFar) {
        $s= "<td title=\"Doesn't look like anything to me...\">";
    }else {
        $s= "<td title=\"Nothing there, no worries.\">";

        for($i=0; $i<$fighterCount; $i++){
            if($fighterList[$i]->id == $id){

                $s= "<td title='".strval($fighterList[$i]->name)."\nLevel: ".strval($fighterList[$i]->level)."\nStrength: ".strval($fighterList[$i]->skill_strength)."\nHealth: ". strval($fighterList[$i]->current_health)."\nSight: ".strval($fighterList[$i]->skill_sight)."\nGuild id: ".strval($fighterList[$i]->guild_id)." '>";
            }
        }
    }

    return $s;
}

echo $this->Html->script('http://code.jquery.com/jquery.min.js');
echo $this->Html->script('sightScript');

?>



