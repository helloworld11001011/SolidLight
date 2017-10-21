<h2>Sight</h2>

<?php 

// refs to the style.css file in webroot/css/
echo $this->Html->css('style');

echo "<table cellspacing='0' cellpadding='0'>"; 
// for every row
for($i=0; $i<$y; $i++){
    echo "<tr>";
    // for every column
    for($j=0; $j<$x; $j++){
        echo "<td>"; 
        // get image from webroot/img/
        echo $this->Html->image('square.png', ['alt' => 'square_img']);
        echo "</td>";
    }
    echo "</tr>";
} 
echo "</table>";

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