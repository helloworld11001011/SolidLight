<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Diary</title>
        <?php echo $this->Html->css('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css') ?>
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

            <div class="leaderboards">
                <h2>Events</h2>
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
                        echo "(";
                        echo $eventsList[$i]->coordinate_x;
                        echo ",";
                        echo $eventsList[$i]->coordinate_y;
                        echo ")";
                        echo "</td>";
                        echo "</tr>";
                    }
                echo "</tbody></table>";
                ?>
                </div>
                <!-- End of events table div -->

        </div>
        
       
        <div class='main-container'id='canScream' >
             <div class="leaderboards">
        <div class="mainDiv">
            <div class="loginDiv">
             
                <?php echo $this->Form->create('scream action');?>
                <h2> Scream action </h2>
                <?php echo __('scream action'); ?>
                    <?php echo $this->Form->input('message');
                    ?>
                <div id='submitDiv'>
                <?= $this->Form->button(__('Submit')) ?>
                </div>
            <?= $this->Form->end() ?>
            </div>
        </div>
        </div>
        </div>
        
        <div class="cannot-scream" id="cannotScream">
                    <h2> You need to choose a fighter to scream a message ! </h2>
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
