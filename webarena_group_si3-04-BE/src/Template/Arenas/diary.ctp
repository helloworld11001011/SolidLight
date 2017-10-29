<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Diary</title>
        <?php echo $this->Html->css('https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css') ?>
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
                <h1>Events</h1>
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
