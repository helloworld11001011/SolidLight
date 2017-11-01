<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Index</title>
        <?php echo $this->Html->css(['index.css']) ?>
        <?php echo $this->Html->script(['jquery.min.js', 'datatables.js']) ?>
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
            <div class="black-background">
                <div class="neon-effect">
                    <span id="intro-text">ENTER</span><br>
                    <span class="flickering">S</span><span class="flickering" id="offset">O</span><span class="flickering">LID LIGHT ARENA</span>
                </div>
            </div>

            <div class="title presentation-pane">
                <div class="left-box">
                    <p class="h3-class">Fight the world!</p>
                    <p>Join your friends in glorious and bloody arena fights. In the SolidLight Arena, you may form alliances, but in the end, there is only one winner!</p>
                </div>

                <div class="center-box">
                    <p class="h3-class">Taunt friend like foe</p>
                    <p>Use our instant messaging system to easily taunt your opponent before, during or after the battle. Watch out - you're at his mercy if he is declared the winner!</p>
                </div>

                <div class="right-box">
                    <p class="h3-class">Become a legend</p>
                    <p>Fight. Overcome. Achieve greatness. Become a true arena legend by defeating all your opponents - top the scoreboards! Gain experience by fighting and, more importantly, winning. Be careful however - the stronger you grow, the higher the fall...</p>
                </div>
            </div>
            <!-- End of presentation pane -->

            <div class="buttons-div">
                <div class="link-button"><?php echo $this->Html->link("LOGIN", ["controller"=>"Arenas", "action"=>"login"]); ?></div>
                <div class="link-button"><?php echo $this->Html->link("SIGN UP", ["controller"=>"Arenas", "action"=>"sign_up"]); ?></div>
            </div>

            <div class="leaderboards">
                <div class="avatar-slider">
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
                    <p class="h3-class">Leaderboard</p>
                </div>
                <div class="leaderboard-table-div">
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
                        echo "( ";
                        echo $fighterList[$i]->coordinate_x;
                        echo ",";
                        echo $fighterList[$i]->coordinate_y;
                        echo " )";
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
