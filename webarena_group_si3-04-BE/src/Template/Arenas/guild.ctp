<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Guilds</title>
        <?php echo $this->Html->css('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css') ?>
        <?php echo $this->Html->script(['https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js']) ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#guilds-table').DataTable();
            });
        </script>
    </head>

    <body>

        <h1>Guilds</h1>

         <?php
         if($fighterIsChosen) {
            echo '<div id="guild-list">';

                echo "<table class='cake-table' id='guilds-table'>";
                echo "<thead><tr>
                <th>Guild Name</th>
                <th>Guild ID</th>
                <th>Number of Fighters</th>
                </tr></thead><tbody>";
                for ($i=0; $i < $guildCount; $i++) {
                    echo "<tr>";
                    echo "<td>";
                    echo $guildCountTable[$i][0];
                    echo "</td>";
                    echo "<td>";
                    echo $guildCountTable[$i][1];
                    echo "</td>";
                    echo "<td>";
                    echo $guildCountTable[$i][2];
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody></table>";
                ?>
            </div>

            <div id="guild-members">

            </div>

            <h2> Create your guild ! </h2>
                <?php
                if(isset($guildNameInDb))
                    echo $guildNameInDb;
                ?>
            <div class="create fighter">
                    <?php echo $this->Form->create('Create guild');?>
                <fieldset>
                    <legend><?php echo __('Create guild'); ?></legend>
                        <?php echo $this->Form->input('name');
                        echo 'Class';
                        ?>
                </fieldset>
            </div>

                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            <?php


            ?>

            <h2> Make your fighter join a guild </h2>
            <h3> Choose a guild </h3>

                <?php
                $guildListName = [];
                for($i=0; $i < count($guildList); $i++) {
                    array_push($guildListName, $guildList[$i]->name);
                }

                echo $this->Form->create('Choose guild');
                echo $this->Form->select(
                    'guildChosenForFighter',
                    $guildListName,
                    ['empty' => '(choisissez)']
                );
                echo $this->Form->button(__('Submit'));
                echo $this->Form->end();
         }
        else {
            if($playerIsLogin) {
                echo "YOU DID NOT CHOOSE YOUR FIGHTER MOTHERFUCKER";
                ?>
                <button onclick="location.href='fighter'" type="button">FIGHTER</button>
                <?php
            }
            else {
                echo "YOU ARE NOT CONNECTED MOTHERFUCKER";
                ?>
                <button onclick="location.href='login'" type="button">LOGIN</button>
                <?php
            }
        }
        ?>

    </body>
</html>
