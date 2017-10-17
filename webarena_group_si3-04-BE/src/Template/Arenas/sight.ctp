<h2>Sight</h2>

<?php 

echo "<style>

table, tr, td {
   border: 1px solid black;
   padding: 0rem 0rem;
   border-collapse: collapse;
}

table {
  width: 1050px;
  margin: auto;
  border-spacing: 0px;
  padding: 0px;
}

td {
  width: 70px;
  position: relative;
  padding: 0px; 
  margin: 0px;
}

img {
    display: block;
    height: 70px;
    width: 70px;
    margin: 0px;
    padding: 0px;
}


/*

.cell_1_1:before{
    background-color: red;
    content: 'o';
}
*/

</style>";

echo "<table cellspacing='0' cellpadding='0'>"; 
for($i=0; $i<$y; $i++){
    echo "<tr>";
    for($j=0; $j<$x; $j++){
        echo "<td>"; 
        echo "<img src='http://moziru.com/images/square-clipart-colored-4.png' alt=''>";
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