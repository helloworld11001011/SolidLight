<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <?php echo $this->Html->css('login'); ?>
    </head>

    <body>
        <div id='mainDiv'>

            <div id='loginDiv'>

                <?php
                echo $this->Form->create('Login');?>
                <h2>Login</h2>
                <?php echo $this->Form->input('emailLogin');
                echo $this->Form->input('password');
                ?>
                <div id='submitDiv'>
                    <?= $this->Form->button(__('SUBMIT')) ?>
                </div>
                <?= $this->Form->end() ?>

                <div id='textDiv'>
                    <?php
                    if(isset($goodToGo)) {
                                    ?><p><?php echo $goodToGo; ?></p>
                                    <?php
                        if($goodToGo == 'You are ready to play') {
                                    ?><button id='btn' onclick="location.href='fighter'" type="button">Go to Fighter</button><?php
                        }
                    }
                    ?>
                </div>
            </div>

            <div id='signUpBtn'>
                <p id='textSubscribe'>Sign up now to Solid Light Arena!</p>
                <button onclick="location.href='sign_up'" type="button">SIGN UP</button>
            </div>

            </br>
        </div>
    </body>
</html>
