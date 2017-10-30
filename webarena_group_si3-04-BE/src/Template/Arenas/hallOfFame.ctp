<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Hall Of Fame</title>
        <?php
        echo $this->Html->css('hallOfFame');
        echo $this->Html->css('jquery.jqplot.min.css');
        echo $this->Html->script(['jquery.min.js', 'jquery.jqplot.min.js', 'jqplot.pieRenderer.js', 'jqplot.dateAxisRenderer.js', 'jqplot.logAxisRenderer.js', 'jqplot.canvasTextRenderer.js', 'jqplot.canvasAxisTickRenderer.js', 'jqplot.highlighter.js', 'jqplot.barRenderer.js', 'jqplot.categoryAxisRenderer.js', 'jqplot.pointLabels.js', 'jqplot.DonutRenderer.js', 'https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js']);
        ?>
    </head>

    <body>

        <h1>
            Hall of Fame
        </h1>
        <div class="main-container">
            <div id="chart.js">
                <canvas id="levels-chart"></canvas>
            </div>
            <div id="death-count-chart">

            </div>
            <div id="chart.js">
                <canvas id="averag-skills-chart"></canvas>
            </div>
            <div id="chart.js">
                <canvas id="top-guilds-chart"></canvas>
            </div>
        </div>
        <script type="text/javascript">

            $(document).ready(function () {
                var ctx = document.getElementById("averag-skills-chart").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ["Sight Skill", "Strength Skill", "Health Skill"],
                        datasets: [{
                            data: [
                                <?php echo round($averageSkills[0]->avg_sight, 2); ?>, <?php echo round($averageSkills[0]->avg_strength, 2); ?>, <?php echo round($averageSkills[0]->avg_health, 2); ?>
                            ],
                            backgroundColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        legend: {
                            display: false
                        },
                        scales: {
                            xAxes: [{
                                gridLines: {
                                    display: false
                                }
                            }],
                            yAxes: [{
                                gridLines: {
                                    display: false
                                },
                                ticks: {
                                    beginAtZero:true
                                }
                            }]
                        }
                    }
                });
            });

            $(document).ready(function(){
                //TODO: VERIFY NULL VALUES
                var ctx = document.getElementById("levels-chart").getContext('2d');
                data = {
                    datasets: [{
                        data: [
                            <?php echo $fighterDistribution[0]; ?>, <?php echo $fighterDistribution[1]; ?>,<?php echo $fighterDistribution[2]; ?>, <?php echo $fighterDistribution[3]; ?>, <?php echo $fighterDistribution[4]; ?>, <?php echo $fighterDistribution[5]; ?>
                        ],
                        backgroundColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                        '>10',
                        '8 - 10',
                        '6 - 8',
                        '4 - 6',
                        '2 - 4',
                        'Newbie (<2)'
                        ]
                };
                var myDoughnutChart = new Chart(ctx, {
                    type: 'pie',
                    data: data,
                });
            });

            $(document).ready(function () {
                var s1 = [
                    [<?php echo $deadFighterDistribution[0][0]; ?>, <?php echo $deadFighterDistribution[0][1]; ?>], [<?php echo $deadFighterDistribution[1][0]; ?>, <?php echo $deadFighterDistribution[1][1]; ?>], [<?php echo $deadFighterDistribution[2][0]; ?>, <?php echo $deadFighterDistribution[2][1]; ?>], [<?php echo $deadFighterDistribution[3][0]; ?>, <?php echo $deadFighterDistribution[3][1]; ?>], [<?php echo $deadFighterDistribution[4][0]; ?>, <?php echo $deadFighterDistribution[4][1]; ?>], [<?php echo $deadFighterDistribution[5][0]; ?>, <?php echo $deadFighterDistribution[5][1]; ?>], [<?php echo $deadFighterDistribution[6][0]; ?>, <?php echo $deadFighterDistribution[6][1]; ?>], [<?php echo $deadFighterDistribution[7][0]; ?>, <?php echo $deadFighterDistribution[7][1]; ?>], [<?php echo $deadFighterDistribution[8][0]; ?>, <?php echo $deadFighterDistribution[8][1]; ?>], [<?php echo $deadFighterDistribution[9][0]; ?>, <?php echo $deadFighterDistribution[9][1]; ?>], [<?php echo $deadFighterDistribution[10][0]; ?>, <?php echo $deadFighterDistribution[10][1]; ?>], [<?php echo $deadFighterDistribution[11][0]; ?>, <?php echo $deadFighterDistribution[11][1]; ?>]
                ];

                var s2 = [
                    [<?php echo $createdFighterDistribution[0][0]; ?>, <?php echo $createdFighterDistribution[0][1]; ?>], [<?php echo $createdFighterDistribution[1][0]; ?>, <?php echo $createdFighterDistribution[1][1]; ?>], [<?php echo $createdFighterDistribution[2][0]; ?>, <?php echo $createdFighterDistribution[2][1]; ?>], [<?php echo $createdFighterDistribution[3][0]; ?>, <?php echo $createdFighterDistribution[3][1]; ?>], [<?php echo $createdFighterDistribution[4][0]; ?>, <?php echo $createdFighterDistribution[4][1]; ?>], [<?php echo $createdFighterDistribution[5][0]; ?>, <?php echo $createdFighterDistribution[5][1]; ?>], [<?php echo $createdFighterDistribution[6][0]; ?>, <?php echo $createdFighterDistribution[6][1]; ?>], [<?php echo $createdFighterDistribution[7][0]; ?>, <?php echo $createdFighterDistribution[7][1]; ?>], [<?php echo $createdFighterDistribution[8][0]; ?>, <?php echo $createdFighterDistribution[8][1]; ?>], [<?php echo $createdFighterDistribution[9][0]; ?>, <?php echo $createdFighterDistribution[9][1]; ?>], [<?php echo $createdFighterDistribution[10][0]; ?>, <?php echo $createdFighterDistribution[10][1]; ?>], [<?php echo $createdFighterDistribution[11][0]; ?>, <?php echo $createdFighterDistribution[11][1]; ?>]
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
                        showTooltip: true
                    },
                    series:[
                        {
                            pointLabels: {
                                show: true
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
                                barWidth: 25,
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
                        tickInterval: 1,
                        tickOptions: {
                            formatString: '%d'
                        }
                    },
                    axes: {
                        // These options will set up the x axis like a category axis.
                        xaxis: {
                            min: 1,
                            max: 12,
                            tickInterval: 1,
                            drawMajorGridlines: false,
                            drawMinorGridlines: false,
                            drawMajorTickMarks: true,
                            rendererOptions: {
                                // tickInset: 0,
                                forceTickAt0: false
                            }
                        },
                        yaxis: {
                            min: 0,
                            tickInterval: 1,
                            drawMajorGridlines: false,
                            drawMinorGridlines: false,
                            drawMajorTickMarks: false,
                            tickOptions: {
                                // formatString: "%d dead"
                            },
                            rendererOptions: {
                                tickInset: 0,
                                forceTickAt0: false
                            }
                        },
                        y2axis: {
                            min: 0,
                            tickInterval: 1,
                            drawMajorGridlines: false,
                            drawMinorGridlines: false,
                            drawMajorTickMarks: false,
                            tickOptions: {
                                // formatString: "%d created"
                            },
                            rendererOptions: {
                                // align the ticks on the y2 axis with the y axis.
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

            $(document).ready(function(){
                $.jqplot.config.enablePlugins = true;
                var s1 = [<?php echo $averageSkills[0]->avg_sight; ?>, <?php echo $averageSkills[0]->avg_strength; ?>, <?php echo $averageSkills[0]->avg_health; ?>];
                var ticks = ['Sight Skill', 'Strength Skill', 'Health Skill'];

                plot1 = $.jqplot('averag-skills-chart', [s1], {
                    // Only animate if we're not using excanvas (not in IE 7 or IE 8)..
                    animate: !$.jqplot.use_excanvas,
                    seriesDefaults:{
                        renderer:$.jqplot.BarRenderer,
                        pointLabels: {
                            show: true,
                            formatString: '%#.1f'
                        }
                    },
                    axes: {
                        xaxis: {
                            renderer: $.jqplot.CategoryAxisRenderer,
                            ticks: ticks,
                            drawMajorGridlines: false,
                            drawMinorGridlines: false,
                            drawMajorTickMarks: false,
                        },
                        yaxis: {
                            drawMajorGridlines: false,
                            drawMinorGridlines: false,
                            drawMajorTickMarks: false,
                        }
                    },
                    highlighter: { show: false }
                });
            });

            $(document).ready(function(){
                //TODO: VERIFY NULL VALUES
                var ctx = document.getElementById("top-guilds-chart").getContext('2d');
                data = {
                    datasets: [{
                        data: [
                            <?php echo $guildCountTable[0][0]; ?>, <?php echo $guildCountTable[1][0]; ?>, <?php echo $guildCountTable[2][0]; ?>, <?php echo $guildCountTable[3][0]; ?>
                        ],
                        backgroundColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                        ],
                        borderWidth: 1
                    }],

                    // These labels appear in the legend and in the tooltips when hovering different arcs
                    labels: [
                        <?php echo "'"; echo $guildCountTable[0][1]; echo "'"; ?>,
                        <?php echo "'"; echo $guildCountTable[1][1]; echo "'"; ?>,
                        <?php echo "'"; echo $guildCountTable[2][1]; echo "'"; ?>,
                        <?php echo "'"; echo $guildCountTable[3][1]; echo "'"; ?>
                    ]
                };
                var myDoughnutChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: data,
                });
            });
        </script>
    </body>
</html>
