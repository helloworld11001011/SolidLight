<h2>Login</h2>

<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

// On s'amuse à créer quelques variables de session dans $_SESSION

if(isset($playerLogin)) {
    $_SESSION['playerLogin'] = $playerLogin;
}
else {
    $_SESSION['playerLogin'] = 0;
}

if(isset($goodToGo))
    echo $goodToGo;
echo " ";
if(isset($emailInDB))
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
    <button onclick="location.href='sight'" type="button">Go to Sight</button>
    <?= $this->Form->end() ?>
    </br>
</div>
