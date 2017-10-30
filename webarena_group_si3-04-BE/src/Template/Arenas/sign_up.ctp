<h2>Sign Up</h2>

<?php echo $this->Form->create('SignUp');?>
<fieldset>
    <legend><?php echo __('Sign up'); ?></legend>
    <?php echo $this->Form->input('email');
    echo $this->Form->input('password');
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>
<?= $this->Form->end() ?>

<?php
if(isset($emailInDB))
    echo $emailInDB;
?>
</br>
<button onclick="location.href='login'" type="button">LOGIN</button>
