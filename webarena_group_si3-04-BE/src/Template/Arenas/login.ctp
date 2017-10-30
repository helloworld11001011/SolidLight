<h2>Login</h2>

<?php

if(isset($goodToGo))
    echo $goodToGo;
echo " ";
?>;

<?php echo $this->Form->create('Login');?>
<fieldset>
    <legend><?php echo __('Login'); ?></legend>
    <?php echo $this->Form->input('emailLogin');
    echo $this->Form->input('passwordLogin');
    ?>
</fieldset>
<?= $this->Form->button(__('Submit')) ?>

<?= $this->Form->end() ?>

<button onclick="location.href='fighter'" type="button">Go to Fighter</button>

<button onclick="location.href='sign_up'" type="button">SIGN UP</button>

</br>

