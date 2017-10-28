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

        <div id="guild-list">
            <?php
            echo "<table class='cake-table' id='guilds-table'>";
            echo "<thead><tr>
            <th>Guild Name</th>
            </tr></thead><tbody>";
            for ($i=0; $i < $guildCount; $i++) {
                echo "<tr>";
                echo "<td>";
                echo $guildList[$i]->name;
                echo "</td>";
                // if ($guildList[$i]->guild_id) {
                //     # code...
                // }
                echo "</tr>";
            }
            echo "</tbody></table>";
            ?>
        </div>

        <div id="guild-members">

        </div>
    </body>
</html>
