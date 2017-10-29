<?php
// refs to the css and js files in webroot
echo $this->Html->css('sight');
echo $this->Html->script('http://code.jquery.com/jquery.min.js');
echo $this->Html->script('sightScript');


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
        
        // Call js function hoverOver when the mouse hovers over the case
        // This also creates the opening <td> tag 
        echo getFighterInfo($matrix[$i][$j], $isTooFar, $fighterList, $fighterCount);
        
        // Don't show the cases that are futher away than the sight skill of the fighter
        if($isTooFar){
            echo $this->Html->image('fog_square.png', ['alt' => 'square_img']);
        }else{
            // Show the case that is curently being targeted except if there is a fighter on it
            if($i == $targetedCase["y"] && $j == $targetedCase["x"] && !$matrix[$i][$j]){
                echo $this->Html->image('red_square.png', ['alt' => 'square_img']);
            }else{
                // Show the fighter if there is one there
                if($matrix[$i][$j]){
                    $pic= strval($matrix[$i][$j]) .'.png';
                    echo $this->Html->image($pic, ['alt' => 'square_img']);
                }else{
                    echo $this->Html->image('green_square.png', ['alt' => 'square_img']);
                }
            }
        }
        echo "</td>\n";
    }
    echo "</tr>\n";
}
echo "</table>\n</div>\n";

echo "<div id='navdiv'> <table class='nav'> <tr> <td> </td> <td>";
echo $this->Form->postButton('UP', null, [ "data" => [ "direction" => "up", "id" => $currentFighter[0]->id, "attack" => "no"]]);
echo "</td><td></td></tr><tr><td>";
echo $this->Form->postButton('LEFT', null, [ "data" => [ "direction" => "left", "id" => $currentFighter[0]->id, "attack" => "no"]]);
echo "</td><td></td><td>";
echo $this->Form->postButton('RIGHT', null, [ "data" => [ "direction" => "right", "id" => $currentFighter[0]->id, "attack" => "no"]]);
echo "</td></tr><tr><td></td><td>";
echo $this->Form->postButton('DOWN', null, [ "data" => [ "direction" => "down", "id" => $currentFighter[0]->id, "attack" => "no"]]);
echo "</td><td></td></tr></table>";
echo $this->Form->postButton('ATTACK', null, [ 'class'=>'attack-btn', "data" => [ "direction" => "null", "id" => $currentFighter[0]->id, "attack" => "yes", "targetedCase" =>["x" => $targetedCase["x"], "y" => $targetedCase["y"] ]]]);
echo "<div id='info'>Hover info</div> </div></div>";

function getFighterInfo($id, $isTooFar, $fighterList, $fighterCount){
    if(!$isTooFar) $isTooFar= 0;
    
    //$s= "<td onmouseover='hoverOver(0, " . strval($isTooFar) . ", -1, -1, -1, -1)'>";
    $s= "<td title=\"Doesn't look like anything to me...\">";
    
    for($i=0; $i<$fighterCount; $i++){
        if($fighterList[$i]->id == $id){
            
            $name= $fighterList[$i]->name;
            if($name == ""){
                $name = "Fantome";
            }
            
            $s= "<td title='$name\nLevel: ".strval($fighterList[$i]->level)."\nStrength: ".strval($fighterList[$i]->skill_strength)."\nHealth: ". strval($fighterList[$i]->skill_health)."'>";
            
            //onmouseover=\"hoverOver(" . strval($id) . ", " . strval($isTooFar). ", '" . $name . "', " . strval($fighterList[$i]->level) . ", " . strval($fighterList[$i]->skill_strength). ", " . strval($fighterList[$i]->skill_health) . ")\">" ;
        }
    }
    return $s;
}

?>




<navigation>
    <h5>Navigation</h5>
    <ul>
        <li> <?php echo $this->Html->link("Index", ["controller"=>"Arenas", "action"=>"index"]); ?> </li>
        <li> <?php echo $this->Html->link("Login", ["controller"=>"Arenas", "action"=>"login"]); ?> </li>
        <li> <?php echo $this->Html->link("Fighter", ["controller"=>"Arenas", "action"=>"fighter"]); ?> </li>
        <li> <?php echo $this->Html->link("Sight", ["controller"=>"Arenas", "action"=>"sight"]); ?> </li>
        <li> <?php echo $this->Html->link("Diary", ["controller"=>"Arenas", "action"=>"diary"]); ?> </li>
    </ul>
</navigation>
