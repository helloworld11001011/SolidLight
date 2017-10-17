<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Index</title>
    </head>
    <body>
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

        <div class="main-container">
          <div class="title presentation-pane">
            <h1>Welcome to SolidLight</h1>
            <p></p>

            <div class="left-box">
              <h3>Fight the world!</h3>
              <p>Join your friends in glorious and bloody arena fights. In the SolidLight Arena, you may form alliances, but in the end, there is only one winner!</p>
            </div>

            <div class="right-box">
              <h3>Become a legend</h3>
              <p>Fight. Overcome. Achieve greatness. Become a true arena legend by defeating all your opponents - top the scoreboards! Gain experience by fighting and, more importantly, winning. Be careful however - the stronger you grow, the higher the fall...</p>
            </div>

            <div class="center-box">
              <h3>Taunt your friends</h3>
              <p>Use our instant messaging system to easily taunt your opponent before, during or after the battle. Watch out though, you're at his mercy if he is declared the winner!</p>
            </div>
        </div>
      </div>
    </body>
</html>
