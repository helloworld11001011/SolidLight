<?php
// echo "<h2>Sight</h2>"

// refs to the style.css file in webroot/css/
echo $this->Html->css('sight');

// Initialises a matrix of the size of the board
for($i=0; $i<$y; $i++){
    for($j=0; $j<$x; $j++){
        $matrix[$i][$j] = 0;
    }
} 

// Gets the coordinates from the fighterList
for($i=0; $i<$fighterCount; $i++){
    $matrix[$fighterList[$i]->coordinate_y][$fighterList[$i]->coordinate_x] = 1;
}

echo "<div id='maindiv'><div id='matdiv'><table class='mat'>"; 
// for every row
for($i=0; $i<$y; $i++){
    echo "<tr>";
    // for every column
    for($j=0; $j<$x; $j++){
        echo "<td>"; 
        // get image from webroot/img/
        if($matrix[$i][$j] == 1){
            echo $this->Html->image('red_square.png', ['alt' => 'square_img']);
        }else{
            echo $this->Html->image('green_square.png', ['alt' => 'square_img']);
        }

        echo "</td>";
    }
    echo "</tr>";
} 
echo "</table></div>";

echo "<div id='navdiv'><table class='nav'><tr><td></td><td>";
echo $this->Form->postButton('UP', null, [ "data" => ["direction" => "up", "id" => 1]]);
echo "</td><td></td></tr><tr><td>";
echo $this->Form->postButton('LEFT', null, [ "data" => ["direction" => "left", "id" => 1]]);
echo "</td><td></td><td>";
echo $this->Form->postButton('RIGHT', null, [ "data" => ["direction" => "right", "id" => 1]]);
echo "</td></tr><tr><td></td><td>";
echo $this->Form->postButton('DOWN', null, [ "data" => ["direction" => "down", "id" => 1]]);
echo "</td><td></td></tr></table></div></div>";


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