<h2>Fighter</h2>


The best fighter is <?php echo $bestFighter; ?>
  
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