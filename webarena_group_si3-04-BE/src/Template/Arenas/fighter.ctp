<html>
  <head>
          <title> Fighter </title>
          <meta charset="UTF-8">
  </head>

  <body>
    <article>
      <h1>Fighter</h1>
      <?php echo $fighterList ?>
      <ul>
        <li>Fighter: <?php echo $fighter_name ?></li>
        <li>Level: <?php echo $lvl ?></li>
        <li>Coordinates: <?php echo $coord_x ?>, <?php echo $coord_y ?></li>
        <li>Health: <?php echo $current_health ?></li>
        <li>Sight skill: <?php echo $sight_skill ?></li>
        <li>Strength skill: <?php echo $strength_skill ?></li>
        <li>Health_skill: <?php echo $health_skill ?></li>
        <li>Next action: <?php echo $next_action ?></li>
      </ul>

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
    </article>
  </body>
</html>
