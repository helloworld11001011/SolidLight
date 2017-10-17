<h2>Login</h2>
<<<<<<< HEAD

<form action="">
    <input type="text" placeholder="Username">
    <input type="password" placeholder="Password">
</form>
=======
>>>>>>> julien/login

<?php
    if($goodToGo)
    echo $goodToGo;
    echo " ";
    if($emailInDB)
    echo $emailInDB;
?>;

<div class="users form">
    <?php echo $this->Form->create('SignUp');?>
        <fieldset>
            <legend><?php echo __('Sign up'); ?></legend>
            <?php echo $this->Form->input('email');
            echo $this->Form->input('password');
        ?>
        </fieldset>
        <fieldset>
            <legend><?php echo __('Login'); ?></legend>
            <?php echo $this->Form->input('emailLogin');
            echo $this->Form->input('passwordLogin');
        ?>
        </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
    </br>
</div>

<!-- <div class="users form">
    <?php echo $this->Form->create('Login');?>
        <fieldset>
            <legend><?php echo __('Login'); ?></legend>
            <?php echo $this->Form->input('emailLogin');
            echo $this->Form->input('passwordLogin');
        ?>
        </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div> -->

<!-- <navigation>
        <h5>Navigation</h5>
        <ul>
            <li> <?php echo $this->Html->link("Index", ["controller"=>"Arenas", "action"=>"index"]); ?> </li>
            <li> <?php echo $this->Html->link("Login", ["controller"=>"Arenas", "action"=>"login"]); ?> </li>
            <li> <?php echo $this->Html->link("Fighter", ["controller"=>"Arenas", "action"=>"fighter"]); ?> </li>
            <li> <?php echo $this->Html->link("Sight", ["controller"=>"Arenas", "action"=>"sight"]); ?> </li>
            <li> <?php echo $this->Html->link("Diary", ["controller"=>"Arenas", "action"=>"diary"]); ?> </li>
        </ul>
</navigation> -->
