<html>
  <head>
          <title> Fighter </title>
          <meta charset="UTF-8">
  </head>

  <body>
    <h1>Fighter</h1>
    <?php echo $fighterList[1]->name ?>
    <!-- <ul>
      <li>Fighter: <?php echo $fighter_name ?></li>
      <li>Level: <?php echo $lvl ?></li>
      <li>Coordinates: <?php echo $coord_x ?>, <?php echo $coord_y ?></li>
      <li>Health: <?php echo $current_health ?></li>
      <li>Sight skill: <?php echo $sight_skill ?></li>
      <li>Strength skill: <?php echo $strength_skill ?></li>
      <li>Health_skill: <?php echo $health_skill ?></li>
      <li>Next action: <?php echo $next_action ?></li>
    </ul> -->

    <?php
      echo "<table class = 'fighters-table'>";
        echo "<tr>
        <th>Fighter Name</th>
        <th>Fighter Level</th>
        <th>Fighter XP</th>
        <th>Current Health</th>
        <th>Position (X/Y)</th>
        <th>Sight Skill</th>
        <th>Strength Skill</th>
        <th>Health Skill</th>
        <th>Next Action</th>
        </tr>";
        for ($i=0; $i < $playerFighterCount; $i++) {
          echo "<tr>";
          for ($j=0; $j < $fighterTableWidth; $j++) {
            echo "<td>";
            echo $fighterList[$i][$j];
            echo "</td>";
          }
          "</tr>";
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
  </body>
</html>
