<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Hall Of Fame</title>
        <?php
        echo $this->Html->css('hallOfFame');
        echo $this->Html->css('jquery.jqplot.min.css');
        echo $this->Html->script(['jquery.min.js', 'jquery.jqplot.min.js', 'jqplot.pieRenderer.js', 'jqplot.dateAxisRenderer.js', 'jqplot.logAxisRenderer.js', 'jqplot.canvasTextRenderer.js', 'jqplot.canvasAxisTickRenderer.js', 'jqplot.highlighter.js']);
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

            $(document).ready(function () {
                var s1 = [
                    [<?php echo $deadFighterDistribution[0][0]; ?>, <?php echo $deadFighterDistribution[0][1]; ?>], [<?php echo $deadFighterDistribution[1][0]; ?>, <?php echo $deadFighterDistribution[1][1]; ?>], [<?php echo $deadFighterDistribution[2][0]; ?>, <?php echo $deadFighterDistribution[2][1]; ?>], [<?php echo $deadFighterDistribution[3][0]; ?>, <?php echo $deadFighterDistribution[3][1]; ?>], [<?php echo $deadFighterDistribution[4][0]; ?>, <?php echo $deadFighterDistribution[4][1]; ?>], [<?php echo $deadFighterDistribution[5][0]; ?>, <?php echo $deadFighterDistribution[5][1]; ?>], [<?php echo $deadFighterDistribution[6][0]; ?>, <?php echo $deadFighterDistribution[6][1]; ?>], [<?php echo $deadFighterDistribution[7][0]; ?>, <?php echo $deadFighterDistribution[7][1]; ?>], [<?php echo $deadFighterDistribution[8][0]; ?>, <?php echo $deadFighterDistribution[8][1]; ?>], [<?php echo $deadFighterDistribution[9][0]; ?>, <?php echo $deadFighterDistribution[9][1]; ?>], [<?php echo $deadFighterDistribution[10][0]; ?>, <?php echo $deadFighterDistribution[10][1]; ?>], [<?php echo $deadFighterDistribution[11][0]; ?>, <?php echo $deadFighterDistribution[11][1]; ?>]
                ];

                var s2 = [
                    [<?php echo $deadFighterDistribution[0][0]; ?>, <?php echo $deadFighterDistribution[0][1]; ?>], [<?php echo $deadFighterDistribution[1][0]; ?>, <?php echo $deadFighterDistribution[1][1]; ?>], [<?php echo $deadFighterDistribution[2][0]; ?>, <?php echo $deadFighterDistribution[2][1]; ?>], [<?php echo $deadFighterDistribution[3][0]; ?>, <?php echo $deadFighterDistribution[3][1]; ?>], [<?php echo $deadFighterDistribution[4][0]; ?>, <?php echo $deadFighterDistribution[4][1]; ?>], [<?php echo $deadFighterDistribution[5][0]; ?>, <?php echo $deadFighterDistribution[5][1]; ?>], [<?php echo $deadFighterDistribution[6][0]; ?>, <?php echo $deadFighterDistribution[6][1]; ?>], [<?php echo $deadFighterDistribution[7][0]; ?>, <?php echo $deadFighterDistribution[7][1]; ?>], [<?php echo $deadFighterDistribution[8][0]; ?>, <?php echo $deadFighterDistribution[8][1]; ?>], [<?php echo $deadFighterDistribution[9][0]; ?>, <?php echo $deadFighterDistribution[9][1]; ?>], [<?php echo $deadFighterDistribution[10][0]; ?>, <?php echo $deadFighterDistribution[10][1]; ?>], [<?php echo $deadFighterDistribution[11][0]; ?>, <?php echo $deadFighterDistribution[11][1]; ?>]
                ];

                plot1 = $.jqplot("death-count-chart", [s2, s1], {
                    // Turns on animatino for all series in this plot.
                    animate: true,
                    // Will animate plot on calls to plot1.replot({resetAxes:true})
                    animateReplot: true,
                    cursor: {
                        show: true,
                        zoom: false,
                        looseZoom: false,
                        showTooltip: false
                    },
                    series:[
                        {
                            pointLabels: {
                                show: false
                            },
                            renderer: $.jqplot.BarRenderer,
                            yaxis: 'y2axis',
                            showHighlight: true,
                            rendererOptions: {
                                // Speed up the animation a little bit.
                                // This is a number of milliseconds.
                                // Default for bar series is 3000.
                                animation: {
                                    speed: 2500
                                },
                                barWidth: 15,
                                barPadding: -15,
                                barMargin: 0,
                                highlightMouseOver: false
                            }
                        },
                        {
                            rendererOptions: {
                                // speed up the animation a little bit.
                                // This is a number of milliseconds.
                                // Default for a line series is 2500.
                                animation: {
                                    speed: 2000
                                }
                            }
                        }
                    ],
                    axesDefaults: {
                        pad: 1.1
                    },
                    axes: {
                        // These options will set up the x axis like a category axis.
                        xaxis: {
                            tickInterval: 1,
                            drawMajorGridlines: true,
                            drawMinorGridlines: true,
                            drawMajorTickMarks: true,
                            rendererOptions: {
                                tickInset: 0,
                                forceTickAt0: false
                            }
                        },
                        yaxis: {
                            tickInterval: 1,
                            tickOptions: {
                                formatString: "%'d dead"
                            },
                            rendererOptions: {
                                tickInset: 0,
                                forceTickAt0: false
                            }
                        },
                        y2axis: {
                            tickInterval: 1,
                            tickOptions: {
                                formatString: "%'d dead"
                            },
                            rendererOptions: {
                                // align the ticks on the y2 axis with the y axis.
                                alignTicks: true,
                                tickInset: 0,
                                forceTickAt0: false
                            }
                        }
                    },
                    highlighter: {
                        show: true,
                        showLabel: true,
                        tooltipAxes: 'y',
                        sizeAdjust: 7.5 , tooltipLocation : 'ne'
                    }
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
            <div id="death-count-chart">

            </div>
        </div>
    </body>
</html>
