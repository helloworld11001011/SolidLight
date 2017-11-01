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
                <div class="h3-class"> Choose your fighter </div>

                    <?php
                    $playerFighterListName = [];
                    for($i=0; $i < count($playerFighterList); $i++) {
                        array_push($playerFighterListName, $playerFighterList[$i]->name);
                    }

                    echo $this->Form->create('ChooseFighter');
                    echo $this->Form->select(
                        'fighterChosen',
                        $playerFighterListName,
                        ['empty' => '(choisissez)']
                    );
                    echo $this->Form->submit(__('CHOOSE'));
                    ?>

                <h2> Create fighter </h2>
                    <?php
                    if(isset($nameInDb))
                        echo $nameInDb;
                    ?>
                <div class="create fighter">
                        <?php echo $this->Form->create('Create fighter');?>
                    <fieldset>
                        <legend><?php echo __('Create fighter'); ?></legend>
                            <?php echo $this->Form->input('name');
                            echo 'Class';
                            echo $this->Form->radio('Class', ['Classic', 'Archer','Giant', 'Destructor']);
                            echo 'Avatar';
                            echo $this->Form->input('imgNum');
                            ?>
                    </fieldset>
                </div>

                    <?= $this->Form->button(__('Submit')) ?>
                    <?= $this->Form->end() ?>


                <div class="level-up-fighter" id="level-up-fighter">
                    <h2> Level up Fighter </h2>
                        <?php echo $this->Form->create('level up fighter');?>
                    <fieldset>
                        <legend><?php echo __('Level up Fighter'); ?></legend>
                            <?php
                            echo 'Upgrade';
                            //trouver un moyen de ne pas afficher 'nothing'
                            echo $this->Form->radio('Upgrade', [ ' + 1 Strength ', ' + 1 Sight', ' + 3 Health']);
                            ?>
                    </fieldset>
                     <?= $this->Form->button(__('Submit')) ?>
                    <?= $this->Form->end() ?>
                </div>


                <div class="cannot-level-up-fighter" id="cannot-level-up-fighter">
                    <h2> The chosen fighter cannot level up</h2>
                    <h3> To level up your fighter, you have to gain 4xp, see you in the arena ! </h3>
                </div>






                    <?php
                }

                else {
                echo "YOU ARE NOT CONNECTED MOTHERFUCKER";
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



    </body>
</html>
