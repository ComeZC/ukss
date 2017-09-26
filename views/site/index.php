<?php

/* @var $this yii\web\View */

$this->title = 'My Dashboard';
$targetColor = ['aqua', 'red', 'green', 'yellow'];
?>

<div class="row">
    <div class="col-md-6 col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Sale Product Distribution</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <canvas id="pieChart" style="height:250px"></canvas>
            </div>
            <!-- /.box-body -->
        </div>

        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Area Quarter Data</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body chart-responsive">
                <div class="chart" id="revenue-chart" style="height: 300px;"></div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-6 col-xs-12">
        <div class="box box-danger">
            <div class="box-header with-border">
                <h3 class="box-title">Target Completion</h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <?php
                $targetData = [
                    ['sale_num' => 80, 'target_num' => 100, 'target_name' => 'Red September Go! - Liverpool'],
                    ['sale_num' => 30, 'target_num' => 100, 'target_name' => 'Red September Go! - Cambrige'],
                    ['sale_num' => 50, 'target_num' => 100, 'target_name' => 'September - Cambridge'],
                    ['sale_num' => 40, 'target_num' => 100, 'target_name' => 'September - Liverpool'],
                    ['sale_num' => 90, 'target_num' => 100, 'target_name' => 'September - Test'],
                    ['sale_num' => 110, 'target_num' => 100, 'target_name' => 'August - Area1'],
                    ['sale_num' => 180, 'target_num' => 100, 'target_name' => 'August - Area2'],
                    ['sale_num' => 130, 'target_num' => 100, 'target_name' => 'August - Area3'],
                    ['sale_num' => 90, 'target_num' => 100, 'target_name' => 'August - Area4'],
                    ['sale_num' => 70, 'target_num' => 100, 'target_name' => 'August - Area5'],
                ];
                foreach($targetData as $k => $target) :
                    $processPercent = $target['sale_num'] / $target['target_num'] * 100;
                    $processPercent = $processPercent < 0 ? 0 : $processPercent;
                    $processPercent = $processPercent > 100 ? 100 : $processPercent;
                    $color = $targetColor[($k%4)];
                    ?>
                    <div class="progress-group">
                        <span class="progress-text"><?=$target['target_name']?></span>
                        <span class="progress-number"><b><?=$target['sale_num']?></b>/<?=$target['target_num']?></span>

                        <div class="progress sm">
                            <div class="progress-bar progress-bar-<?=$color?>" style="width: <?=$processPercent?>%"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
        var pieChart       = new Chart(pieChartCanvas);
        var PieData        = <?=json_encode($saleData)?>;
        var pieOptions     = {
            //Boolean - Whether we should show a stroke on each segment
            segmentShowStroke    : true,
            //String - The colour of each segment stroke
            segmentStrokeColor   : '#fff',
            //Number - The width of each segment stroke
            segmentStrokeWidth   : 2,
            //Number - The percentage of the chart that we cut out of the middle
            percentageInnerCutout: 50, // This is 0 for Pie charts
            //Number - Amount of animation steps
            animationSteps       : 100,
            //String - Animation easing effect
            animationEasing      : 'easeOutBounce',
            //Boolean - Whether we animate the rotation of the Doughnut
            animateRotate        : true,
            //Boolean - Whether we animate scaling the Doughnut from the centre
            animateScale         : false,
            //Boolean - whether to make the chart responsive to window resizing
            responsive           : true,
            // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio  : true,
            //String - A legend template
            legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
        }
        //Create pie or douhnut chart
        // You can switch between pie and douhnut using the method below.
        pieChart.Doughnut(PieData, pieOptions);

        // AREA CHART
        var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            data: [
                {y: '2015 Q1', item1: 2666, item2: 2666},
                {y: '2015 Q2', item1: 2778, item2: 2294},
                {y: '2015 Q3', item1: 4912, item2: 1969},
                {y: '2015 Q4', item1: 3767, item2: 3597},
                {y: '2016 Q1', item1: 6810, item2: 1914},
                {y: '2016 Q2', item1: 5670, item2: 4293},
                {y: '2016 Q3', item1: 4820, item2: 3795},
                {y: '2016 Q4', item1: 15073, item2: 5967},
                {y: '2017 Q1', item1: 10687, item2: 4460},
                {y: '2017 Q2', item1: 8432, item2: 5713}
            ],
            xkey: 'y',
            ykeys: ['item1', 'item2'],
            labels: ['Cambrige', 'Liverpool'],
            lineColors: ['#a0d0e0', '#3c8dbc'],
            hideHover: 'auto'
        });

        /*var MONTHS = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var color = Chart.helpers.color;
        var horizontalBarChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: 'Dataset 1',
                backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
                borderColor: window.chartColors.red,
                borderWidth: 1,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ]
            }, {
                label: 'Dataset 2',
                backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
                borderColor: window.chartColors.blue,
                data: [
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor(),
                    randomScalingFactor()
                ]
            }]

        };
        var ctx = $('#barHorizon').getContext("2d");
        var horizontalBar = new Chart(ctx, {
            type: 'horizontalBar',
            data: horizontalBarChartData,
            options: {
                // Elements options apply to all of the options unless overridden in a dataset
                // In this case, we are setting the border of each horizontal bar to be 2px wide
                elements: {
                    rectangle: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
                legend: {
                    position: 'right',
                },
                title: {
                    display: true,
                    text: 'Chart.js Horizontal Bar Chart'
                }
            }
        });*/

        /*var bar = new Chart(document.getElementById("barHorizon"), {
            "type": "horizontalBar",
            "data": {
                "labels": ["January", "February", "March", "April", "May", "June", "July"],
                "datasets": [{
                    "label": "My First Dataset",
                    "data": [65, 59, 80, 81, 56, 55, 40],
                    "fill": false,
                    "backgroundColor": ["rgba(255, 99, 132, 0.2)", "rgba(255, 159, 64, 0.2)", "rgba(255, 205, 86, 0.2)", "rgba(75, 192, 192, 0.2)", "rgba(54, 162, 235, 0.2)", "rgba(153, 102, 255, 0.2)", "rgba(201, 203, 207, 0.2)"],
                    "borderColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"],
                    "borderWidth": 1
                }]
            },
            "options": {
                "scales": {
                    "xAxes": [{
                        "ticks": {
                            "beginAtZero": true
                        }
                    }]
                }
            }
        });*/
    });
</script>