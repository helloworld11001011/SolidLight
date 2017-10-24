<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Hall Of Fame</title>
        <?php
        echo $this->Html->css('hallOfFame');
        echo $this->Html->css('jquery.jqplot.min.css');
        echo $this->Html->script(['jquery.min.js', 'jquery.jqplot.min.js', "jqplot.pieRenderer.js"]);
        ?>
        <script type="text/javascript">
        $(document).ready(function(){
                var data = [
                        ['>10', <?php echo $fighterDistribution[0]; ?>],['8 - 10', <?php  echo $fighterDistribution[1]; ?>], ['6 - 8', <?php  echo $fighterDistribution[2]; ?>],
                        ['4 - 6', <?php echo $fighterDistribution[3] ?>],['2 - 4', <?php  echo $fighterDistribution[4]; ?>], ['Newbie (<2)', <?php  echo $fighterDistribution[5]; ?>]
                    ];

                var plot1 = jQuery.jqplot ('levels-chart', [data],
                {
                  seriesDefaults: {
                    // Make this a pie chart.
                    renderer: jQuery.jqplot.PieRenderer,
                    rendererOptions: {
                      // Put data labels on the pie slices.
                      // By default, labels show the percentage of the slice.
                      showDataLabels: true
                    }
                  },
                  legend: { show:true, location: 'e' }
                });
            });
        </script>
    </head>

    <body>

        <h1>
            Hall of Fame
        </h1>
        <div class="main-container">
            <div id="levels-chart">

            </div>
        </div>

    </body>
</html>
