<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Index</title>
        <?php echo $this->Html->css('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css') ?>
        <?php echo $this->Html->script(['https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js']) ?>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#leaderboard-table').DataTable();
            });
        </script>
    </head>

    <body>
        <div class="main-container">

            <div class="title presentation-pane">
                <h1>Welcome to SolidLight</h1>
                <div class="left-box">
                    <h3>Fight the world!</h3>
                    <p>Join your friends in glorious and bloody arena fights. In the SolidLight Arena, you may form alliances, but in the end, there is only one winner!</p>
                </div>

                <div class="right-box">
                    <h3>Become a legend</h3>
                    <p>Fight. Overcome. Achieve greatness. Become a true arena legend by defeating all your opponents - top the scoreboards! Gain experience by fighting and, more importantly, winning. Be careful however - the stronger you grow, the higher the fall...</p>
                </div>

                <div class="center-box">
                    <h3>Taunt friend like foe</h3>
                    <p>Use our instant messaging system to easily taunt your opponent before, during or after the battle. Watch out - you're at his mercy if he is declared the winner!</p>
                </div>
            </div>
            <!-- End of presentation pane -->

            <div class="leaderboards">
                <h3>Top Fighters</h3>
                <?php
    echo "<table class='cake-table' id='leaderboard-table'>";
        echo "<thead><tr>
                <th>Fighter Name</th>
                <th>Fighter Level</th>
                <th>Current Health</th>
                <th>Position (X/Y)</th>
                <th>Sight Skill</th>
                <th>Strength Skill</th>
                <th>Health Skill</th>
                </tr></thead><tbody>";
        for ($i=0; $i < $fighterCount; $i++) {
            echo "<tr>";
            echo "<td>";
            echo $fighterList[$i]->name;
            echo "</td>";
            echo "<td>";
            echo $fighterList[$i]->level;
            echo "</td>";
            echo "<td>";
            echo $fighterList[$i]->current_health;
            echo "</td>";
            echo "<td>";
            echo "(";
            echo $fighterList[$i]->coordinate_x;
            echo ",";
            echo $fighterList[$i]->coordinate_y;
            echo ")";
            echo "</td>";
            echo "<td>";
            echo $fighterList[$i]->skill_sight;
            echo "</td>";
            echo "<td>";
            echo $fighterList[$i]->skill_strength;
            echo "</td>";
            echo "<td>";
            echo $fighterList[$i]->skill_health;
            echo "</td>";
            echo "</tr>";
        }
        echo "</tbody></table>";
                ?>
            </div>
            <!-- End of leaderboards div -->

        </div>
        <!-- End of main container -->

        <navigation>
            <h5>Navigation</h5>
            <ul>
                <li> <?php echo $this->Html->link("Index", ["controller"=>"Arenas", "action"=>"index"]); ?> </li>
                <li> <?php echo $this->Html->link("Login", ["controller"=>"Arenas", "action"=>"login"]); ?> </li>
                <li> <?php echo $this->Html->link("Fighter", ["controller"=>"Arenas", "action"=>"fighter"]); ?> </li>
                <li> <?php echo $this->Html->link("Sight", ["controller"=>"Arenas", "action"=>"sight"]); ?> </li>
                <li> <?php echo $this->Html->link("Diary", ["controller"=>"Arenas", "action"=>"diary"]); ?> </li>
            </ul>
        </navigation>
    </body>
</html>
