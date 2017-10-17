<html>
  <head>
          <title> Fighter </title>
          <meta charset="UTF-8">
  </head>

  <body>
    <h1>Your Fighters</h1>

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
        </tr>";
        for ($i=0; $i < $playerFighterCount; $i++) {
          echo "<tr>";
          echo "<td>";
          echo $fighterList[$i]->name;
          echo "</td>";
          echo "<td>";
          echo $fighterList[$i]->level;
          echo "</td>";
          echo "<td>";
          echo $fighterList[$i]->xp;
          echo "</td>";
          echo "<td>";
          echo $fighterList[$i]->current_health;
          echo "</td>";
          echo "<td>";
          echo "(";
          echo $fighterList[$i]->coordinate_x;
          echo ",";
          echo $fighterList[$i]->coordinate_y;
          echo ")";
          echo "</td>";
          echo "<td>";
          echo $fighterList[$i]->skill_sight;
          echo "</td>";
          echo "<td>";
          echo $fighterList[$i]->skill_strength;
          echo "</td>";
          echo "<td>";
          echo $fighterList[$i]->skill_health;
          echo "</td>";
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
  </body>
</html>
