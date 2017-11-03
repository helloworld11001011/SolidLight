<html>
    <head>
        <title> Fighter </title>
        <meta charset="UTF-8">
        <!-- cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css -->
        <!-- TODO: get datatables working -->
        <?php echo $this->Html->css('fighter'); ?>
        <?php echo $this->Html->script(['https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js']) ?>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#fighters-table').DataTable({
                    'order': [[1, 'DESC']]
                });
            });
        </script>
    </head>

    <body>
        <div class="main-container">
            <div class="black-background">
                <div class="neon-effect">
                    <span class="flickering">FIGH</span><span class="flickering" id="offset">TE</span><span class="flickering">R</span>
                </div>
            </div>
            <div class="presentation-pane">
                <div class="top-row">
                    <p class="subtitle-text"><?php echo $chosenFighterName; ?></p>
                    <?php echo $this->Html->image($avatarId, array('class' => 'avatar-picture')); ?>
                </div>
                <div class="table-row">
                    <?php
                    if($playerIsLogin) {
                        echo "<table class='cake-table' id='fighters-table'>";
                        echo "<thead><tr>
                        <th>Fighter Name</th>
                        <th>Fighter Level</th>
                        <th>Fighter XP</th>
                        <th>Current Health</th>
                        <th>Position (X/Y)</th>
                        <th>Sight Skill</th>
                        <th>Strength Skill</th>
                        <th>Health Skill</th>
                        </tr></thead>";
                        for ($i=0; $i < count($playerFighterList); $i++) {
                            echo "<tr>";
                            echo "<td>";
                            echo $playerFighterList[$i]->name;
                            echo "</td>";
                            echo "<td>";
                            echo $playerFighterList[$i]->level;
                            echo "</td>";
                            echo "<td>";
                            echo $playerFighterList[$i]->xp;
                            echo "</td>";
                            echo "<td>";
                            echo $playerFighterList[$i]->current_health;
                            echo "</td>";
                            echo "<td>";
                            echo "(";
                            echo $playerFighterList[$i]->coordinate_x;
                            echo ",";
                            echo $playerFighterList[$i]->coordinate_y;
                            echo ")";
                            echo "</td>";
                            echo "<td>";
                            echo $playerFighterList[$i]->skill_sight;
                            echo "</td>";
                            echo "<td>";
                            echo $playerFighterList[$i]->skill_strength;
                            echo "</td>";
                            echo "<td>";
                            echo $playerFighterList[$i]->skill_health;
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    ?>
                </div>
            </div>

            <div class="bottom-row">
                <div class="h3-class">Choose your fighter</div>

                <?php
                        $playerFighterListName = [];
                        for($i=0; $i < count($playerFighterList); $i++) {
                            array_push($playerFighterListName, $playerFighterList[$i]->name);
                        }

                        echo $this->Form->create('ChooseFighter');
                        echo $this->Form->select(
                            'fighterChosen',
                            $playerFighterListName,
                            ['empty' => '(Select fighter)', 'class'=>'fighter-selector']
                        );
                        echo $this->Form->submit(__('Select'), ['class'=>'submit-btn']);
                ?>

                <div class="h3-class second-title">Create your fighter</div>
                <?php
                        if(isset($nameInDb))
                            echo $nameInDb;
                ?>
                <div class="create-fighter">
                    <?php echo $this->Form->create('Create fighter');?>
                    <fieldset>
                        <legend><?php echo __('Create fighter'); ?></legend>
                        <?php echo $this->Form->input('name');
                        echo '<div class="form-selector-column">';
                        echo "<div class='left-column'>";
                            echo '<div class="left-column-title">Class</div>';
                            echo $this->Form->radio('Class', ['Decker (basic)', 'Rigger (+1 sight)','Goliath (+2 health)', 'Street Samuraï (+1 strength)']);
                            echo $this->Form->input('imgNum', ['type' => 'hidden', 'id' => 'imgNum']);
                        ?></div>

                <div class="avatar-slider">
                    <?php echo '<div class="avatar-selector">Avatar'; ?>
                    <?php echo $this->Html->image('A1.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A2.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A3.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A4.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A5.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A6.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A7.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A8.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A9.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A10.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A11.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A12.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A13.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A14.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A15.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A16.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A17.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A18.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A19.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A20.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A21.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A22.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A23.png', array('class' => 'mySlides')); ?>
                    <?php echo $this->Html->image('A24.png', array('class' => 'mySlides')); ?>
                    </div>
                    <div class="avatar-buttons-div">
                        <?php echo "<button type='button' onclick='carousel( -1 )'><--</button>"; ?>
                        <?php echo "<button type='button' onclick='carousel( 1 )'>--></button>"; ?>
                    </div>

                </div>
                </div>
                <div class="submit-btn-row">
                    <?= $this->Form->button(__('Submit'), ['class'=>'submit-btn']) ?>
                    <?= $this->Form->end() ?>
                </div>
                </fieldset>
                </div>

                <div class="level-up-fighter" id="level-up-fighter">
                    <div class="h3-class">Level up</div>
                    <?php echo $this->Form->create('level up fighter');?>
                    <fieldset>
                        <?php
                        echo '<div class="level-up-title">Upgrade</div>';
                        //trouver un moyen de ne pas afficher 'nothing'
                        echo $this->Form->radio('Upgrade', [ ' + 1 Strength ', ' + 1 Sight', ' + 3 Health']);
                        ?>
                    </fieldset>
                    <?= $this->Form->button(__('Submit'), ['class'=>'submit-btn']) ?>
                    <?= $this->Form->end() ?>
                </div>


                <?php
                    }

                    else {
                        echo "YOU ARE NOT CONNECTED ";
                ?>
                <button onclick="location.href = 'login'" type="button">LOGIN</button>
                <?php
                    }
                ?>
            </div>
        </div>

        <script type="text/javascript">

            $(document).ready(function () {

                if(<?php echo $levelUpPossible; ?> == 0){

                    document.getElementById('level-up-fighter').style.display="none";

                } else {

                    document.getElementById('cannot-level-up-fighter').style.display="none";

                }

            });

        </script>

        <script>
            carousel(0);
            function carousel( dir ) {

                var i;
                if ( typeof myIndex == 'undefined' ) {
                    myIndex = 1;
                }

                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = "none";
                }

                myIndex += dir;

                if (myIndex > x.length) {myIndex = 1}
                if (myIndex < 1) {myIndex = 24}
                x[myIndex-1].style.display = "block";
                $("#imgNum").attr('value', myIndex);
                $("#avatarID").text(myIndex);
            }

        </script>




    </body>
</html>
