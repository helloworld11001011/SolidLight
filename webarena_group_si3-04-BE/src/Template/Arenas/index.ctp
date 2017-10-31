<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Index</title>
        <?php echo $this->Html->css('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css') ?>
        <?php echo $this->Html->script(['https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js']) ?>
        <style>
            .mySlides {display: none; height:160px; width: 160px;}
        </style>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#leaderboard-table').DataTable({
                    "order": [[1, 'DESC']]
                });
            });
        </script>
    </head>

    <body>
        <div class="main-container">
            <div class="avatar-slider">
                <?php echo $this->Html->image('1.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('2.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('3.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('4.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('5.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('6.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('7.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('8.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('9.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('10.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('11.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('12.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('13.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('14.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('15.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('16.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('17.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('18.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('19.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('20.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('21.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('22.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('23.png', array('class' => 'mySlides')); ?>
                <?php echo $this->Html->image('24.png', array('class' => 'mySlides')); ?>
            </div>
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

        <script>
            var myIndex = 0;
            carousel();

            function carousel() {
                var i;
                var x = document.getElementsByClassName("mySlides");
                for (i = 0; i < x.length; i++) {
                   x[i].style.display = "none";
                }
                myIndex++;
                if (myIndex > x.length) {myIndex = 1}
                x[myIndex-1].style.display = "block";
                setTimeout(carousel, 2000); // Change image every 2 seconds
            }
        </script>
    </body>
</html>
