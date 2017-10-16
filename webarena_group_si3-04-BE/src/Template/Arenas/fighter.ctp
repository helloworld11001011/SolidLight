
<head>
        <title> Fighter </title>
        <meta charset="UTF-8">
</head>

<body>
    <article>

    <h1>Fighter</h1>

    <ul>
                    <li>  Name:  <?php echo $bestFighter; ?> </li>
                    <li>  Id: <?php echo $id; ?> </li>
                    <li>  Position: x = <?php echo $PosX; ?>, y = <?php echo $PosY; ?>  </li>
                    <li>  Lvl: <?php echo $LVL; ?> </li>
                    <li>  Xp: <?php echo $Xp; ?></li>
                    <li>  Sight: <?php echo $Sight; ?></li>
                    <li>  Strenght: <?php echo $Strength; ?></li>
                    <li>  Health: <?php echo $Health; ?></li>
                    <li>  Current Health: <?php echo $CHealth; ?></li>
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
