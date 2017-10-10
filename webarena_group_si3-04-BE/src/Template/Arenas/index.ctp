<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Index</title>
    </head>
    <body>
       <h2>Index</h2>
        Willkommen in webarena, my name is <?php echo $myname;?> and the best fighter is <?php echo $bestFighter; ?>.
        
        
 <!-- Pour faire un lien : <\?php echo $this->Html->link("Click Me", ["Controller"=>"Arenas"]) >      -->
        
        
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

