<!DOCTYPE HTML>
<html>
        <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                <meta http-equiv="refresh" content="10">
                <title>pi-Weather Terminal</title>

                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
                <script type="text/javascript">
<?php
        try{
                $dbh = new PDO('sqlite:/var/www/myLogger.db');
                foreach($dbh->query('SELECT * FROM myTemp') as $row)
                {
                        $result_Temperature[] = $row['Temperature'];
                        $result_Time[] = $row['Time'];
                }
           }
        catch(PDOException $e) {
                echo $e->getMessage();
           }
?>

$(function () {
        $('#container').highcharts({
            title: {
                text: 'Temperatures',
                x: -20 //center
            },
            subtitle: {
                text: 'From given temperature data',
                x: -20
            },
            xAxis: {
                categories: [<?php echo join($result_Time, ',') ?>],
                title: { 
                    enabled: true,
                    text: 'Time in Hours',
                }
            },
            yAxis: {
                title: {
                    text: 'Temperature (°C)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                valueSuffix: '°C'
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            chart: {
                type: 'area',
                marginLeft: 50
            },
            plotOptions: {
                series: {
                        color: '#FECD67',
                        marker: {
                     fillColor: 'red',
                     lineWidth: 2,
                     lineColor: 'grey'
                    }
                }
            },
            series: [{
                name: 'Temperature by Time',
                data: [<?php echo join($result_Temperature, ',') ?>],
                color: '#FFBD00'
            }]
        });
    });

                </script>
        </head>
        <body>
<h1><font = "papyrus" color = "ivory"><i>pi</i>-Temperature Terminal</font><br></h1>
<style type = "text/css">
        h1{text-align: center;font-size: 600%;background-color: grey;}
        .names{font-size: xx-large}</style>
<body background="tempImage.jpg">
div id="container" style="min-width: 200px; width: 1100px; height: 500px; margin: 0; float:right; auto">
<script src="../../js/highcharts.js"></script>
<script src="../../js/modules/exporting.js"></script>
</div>
<div style="float:left;">
<?php

        try{
                $dbh = new PDO('sqlite:/var/www/myLogger.db');
                print "<table>";
                print "<table border=1 bgcolor=grey bordercolor=brown style=color:ivory>";
                print "<tr><th>Time</th><th>Temperature</th></tr>";
                foreach($dbh->query('SELECT * FROM myTemp') as $row)
                {
                        print("<tr>");
                        print("<td align=center>". $row['Time'] ."</td>");
                        print("<td align=center>". $row['Temperature'] ."</td>");
                        print("</tr>");
                }
        print"</table>";
        $dbh = NULL;
        }
        catch(PDOException $e) {
                echo $e->getMessage();
           }


?>
</div>
        </body>
</html>

