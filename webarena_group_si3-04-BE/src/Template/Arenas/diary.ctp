<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Diary</title>
        <?php echo $this->Html->css(['diary.css']) ?>
        <?php echo $this->Html->script(['https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"', 'https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js']) ?>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#events-table').DataTable();
            });
        </script>
    </head>
    <body>
        <div class="main-container">
            <div class="black-background">
                <div class="neon-effect">
                    <span class="flickering">FIG</span><span class="flickering" id="offset">HT DI</span><span class="flickering">ARY</span>
                </div>
            </div>
            <div class="leaderboards">
                <?php
                echo "<table class='cake-table' id='events-table'>";
                echo "<thead><tr>
                    <th>Event</th>
                    <th>Date</th>
                    <th>Position (X/Y)</th>
                    </tr></thead><tbody>";
                    for ($i=0; $i < $eventsCount; $i++) {
                        echo "<tr>";
                        echo "<td>";
                        echo $eventsList[$i]->name;
                        echo "</td>";
                        echo "<td>";
                        echo $eventsList[$i]->date;
                        echo "</td>";
                        echo "<td>";
                        echo "( ";
                        echo $eventsList[$i]->coordinate_x;
                        echo ",";
                        echo $eventsList[$i]->coordinate_y;
                        echo " )";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody></table>";
                ?>
                </div>
                <!-- End of events table div -->
            <div class="scream-div">
                <div id='canScream' >
                    <?php echo $this->Form->create('scream action');?>
                    <div class="h3-class">Shout a message!</div>
                    <?php echo $this->Form->input('message');
                    ?>
                    <div id='submitDiv'>
                        <?= $this->Form->button(__('Submit')) ?>
                    </div>
                    <?= $this->Form->end() ?>
                </div>

                <div id="cannotScream">
                    <div class='h3-class'> You need to choose a fighter to scream a message ! </div>
                </div>
            </div>
        </div>


        <script type="text/javascript">

            $(document).ready(function () {

                if(<?php echo $canScream; ?> == 0){

                    document.getElementById('canScream').style.display="none";

                } else {

                    document.getElementById('cannotScream').style.display="none";

                }

            });

        </script>


    </body>
</html>
