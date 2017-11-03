<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Inbox</title>
        <?php echo $this->Html->css('login'); ?>
    </head>

    <body>
        <div id='mainDiv'>

            <div id='loginDiv'>
                <?php echo $this->Form->create('SignUp');?>
                <h2>Sign Up</h2>
                <?php echo $this->Form->input('email');
                echo $this->Form->input('password');
                ?>
                <div id='submitDiv'>
                    <?= $this->Form->button(__('Submit')) ?>
                </div>
                <?= $this->Form->end() ?>

                <div id='textDiv'>
                    <?php
    if              (isset($emailInDB)) {
                    ?><p><?php echo $emailInDB; ?></p>
                    <?php
                    }
                    ?>
                </div>
            </div>

            <div id='signUpBtn'>
                <p id='textSubscribe'>Already Signed Up ? Log In and start playing!</p>
                <button onclick="location.href='login'" type="button">LOGIN</button>
            </div>

        </div>
    </body>
</html>
