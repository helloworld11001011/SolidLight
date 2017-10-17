<h2>Sight</h2>

<!-- table>.row*15>.col*10{fuck} -->

<?php 

echo "<style>
table, tr, td {
   border: 1px solid black;
}

table {
  width: 50%;
  margin: auto;
}
td {
  width: 6.666%;
  position: relative;
}
td:after {
  content: '';
  display: block;
  margin-top: 100%;
}
td .content {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background: none;
  text-align:center
}

.cell_1_1:before{
    background-color: red;
    content: 'o';
}

.cell_2_6:before{ 

    background-color: #5BC8F7;
    content:'h';
    color: red;
}

</style>";

echo "<table>";
for($i=0; $i<$y; $i++){
    echo "<tr>";
    for($j=0; $j<$x; $j++){
        echo "<td><div class=\"content cell_".$i."_".$j." \" > ";
        echo "";
        echo "</div>";
        echo "";
        echo"</td>";
    }
} 
echo "</table>";

echo " content cell_".$x."_".$y;

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