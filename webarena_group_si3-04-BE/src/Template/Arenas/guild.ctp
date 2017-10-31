<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Guilds</title>
        <?php echo $this->Html->css('guild'); ?>
        <?php echo $this->Html->css('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css') ?>
        <?php echo $this->Html->script(['https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js']) ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#guilds-table').DataTable();
                $('#guilds-tables').DataTable();
            });
        </script>
    </head>

    <body>
        <div id='mainDiv'>

            <div id='mainDivOwnGuild'>
                <div id='coverPic'></div>
                <?php
                    if(isset($guildName)) {
                        ?>
                        <div id='guildName'>
                            <h3>
                                <?php
                                echo $guildName;
                                echo " (Level ";
                                for ($i=0; $i < $guildCount; $i++) {
                                    if ($guildName == $guildCountTable[$i][0]) {
                                        echo $guildCountTable[$i][3];
                                    }
                                }
                                echo ")"; ?>
                            </h3>
                        </div>
                        <?php
                    }
                    else {
                        ?>
                        <div id='guildName'>
                            <h3>You have no Guild</h3>
                        </div>
                        <?php
                    }
                    ?>
                    <div id='guildFighters'>
                        <?php
                        if(isset($guildFighters)) {
                            echo '<div id="guild-list">';

                            echo "<table class='cake-table' id='guilds-table'>";
                            echo "<thead><tr>
                            <th>Fighter Name</th>
                            <th>Fighter Level</th>
                            </tr></thead><tbody>";
                            for ($i=0; $i < count($guildFighters); $i++) {
                                echo "<tr>";
                                echo "<td>";
                                echo $guildFighters[$i]['name'];
                                echo "</td>";
                                echo "<td>";
                                echo $guildFighters[$i]['level'];
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody></table>";
                        }
                    ?>
                </div>
            </div>

            <div id='guildListDiv'>
                <h3>Guilds</h3>
                <?php
                if($fighterIsChosen) {
                    echo '<div id="guild-list">';

                        echo "<table class='cake-table' id='guilds-tables'>";
                        echo "<thead><tr>
                        <th>Guild Name</th>
                        <th>Number of Fighters</th>
                        <th>Guild Level</th>
                        </tr></thead><tbody>";
                        for ($i=0; $i < $guildCount; $i++) {
                            echo "<tr>";
                            echo "<td>";
                            echo $guildCountTable[$i][0];
                            echo "</td>";
                            echo "<td>";
                            echo $guildCountTable[$i][2];
                            echo "</td>";
                            echo "<td>";
                            echo $guildCountTable[$i][3];
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody></table>";
                        ?>
                    </div>
            </div>

            <div id='guildListDiv'>
                <h3>Create your guild</h3>
                <?php
                if(isset($guildNameInDb))
                    echo $guildNameInDb;
                ?>
                <?php echo $this->Form->create('Create guild');?>
                <?php echo $this->Form->input('name');?>

                <?= $this->Form->button(__('Submit')) ?>
                <?= $this->Form->end() ?>
            </div>

            <div id='guildListDiv'>
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
            </div>
        </div>
    </body>
</html>
