<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>easy chart</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>

<!-- ตั้งค่า -->
<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        //ชื่อกราฟ
         chart: {

                type: 'bar'
            },
        title: {
            text: 'ทดสอบกราฟแบบง่ายๆ ',
            x: -20 //center
        },
        subtitle: {
            text: 'http://www.highcharts.com/',
            x: -20
        },
        //แนวนอน
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        //ชื่อข้อมูลแนวตั้ง
        yAxis: {
            title: {
                text: 'จำนวนเงิน (ล้านบาท)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'บาท'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
        //     name: 'Tokyo',
        //     data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        // }, {
            name: '2015',
            data: [
            <?php  //วนซ้ำข้อมูล 1-12 
                for ($i = 0; $i < 12; $i++) {
                    if($i>0){
                        echo ',';
                    }
                    echo $i*100; //ข้อมูลตัวเลข
                }
            ?>
            
            ]
        }, 
        {
            name: '2016',
            data: [<?php 
                for ($i = 0; $i < 12; $i++) {
                    if($i>0){
                        echo ',';
                    }
                    echo $i*80; //ข้อมูลตัวเลข
                }
            ?>]
        }, 
        {
            name: '2017',
            data: [ <?php 
                for ($i = 0; $i < 12; $i++) {
                    if($i>0){
                        echo ',';
                    }
                    echo $i*50;//ข้อมูลตัวเลข
                }
            ?>]
        }]
    });
});
</script>

</head>
<body>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>


</body>
</html>