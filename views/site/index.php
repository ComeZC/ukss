<?php

/* @var $this yii\web\View */

$this->title = 'My Dashboard';
$targetColor = ['aqua', 'red', 'green', 'yellow'];
?>

<div class="row">
    <div class="col-md-6 col-xs-12">
        <p class="text-center">
            <strong>Target Completion</strong>
        </p>
        <?php
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
    <div class="col-md-6 col-xs-12">
        <!-- DONUT CHART -->
        <div class="box box-danger">
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
        <!-- /.box -->
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
        pieChart.Doughnut(PieData, pieOptions)
    });
</script>