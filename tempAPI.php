<!DOCTYPE HTML PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtm11/DTD/xhtm11-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtm11\">

<head>

                <meta http-equiv="content-type" content="text/html; charset=utf-8">
                <title>
                pi-Weather Terminal
                </title>

                <script type=\"text/javascript\" src="https://www.google.com/jsapi"></script>
                <script type="text/javascript">
                google.load("visualization", "1", {packages: ["corechart"]});

<?php
        try{
                $db = new PDO('sqlite:/var/www/myLogger.db');
                foreach($db->query('select * from myTemp') as $row)
                {
                        $result_Temperature[] = $row['Temperature'];
                        $result_Time[] = $row['Time'];
                }
        }
        catch(PDOException $e)
        {
                echo $e->getMessage();
        }
?>
        function drawChart()
        {
                var data = google.visualization.arrayToDataTable(['$result_Time','$result_Temperature']);
                var graph = new google.visualization.LineChart(document.getElementById('chart_div'));
                graph.draw(data, {
                        curveType: "function",
                        title: 'Temperature(C) by Time',
                        vAxis: {title: 'Temperature', minValue: 0},
                        hAxis: {title: 'Time'}
                        });
        }
        google.setOnLoadCallback(drawChart);
      </script>
    </head>
    <body>
        <style="font-family: Arial;border: 0 none;"></style>
     <div id="chart_div" style="width: 900px; height: 500px;"></div>
<center>
<?php

        try{
                $db = new PDO('sqlite:/var/www/myLogger.db');
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $result = $db->query('SELECT * FROM myTemp');
                print "<table>";
                print "<table border=1>";
                print "<tr><th>Time</th><th>Temperature</th></tr>";
                foreach($result as $row)
                {
                        print "<tr>";
                        print "<td>".$row['Time']."</td>";
                        print "<td>".$row['Temperature']."</td>";
                        print "</tr>";
                }
                print "</table>";
                $db = NULL;
        }
        catch(PDOException $e)
        {
                 print 'Exception:'.$e->getMessage();
        }

?>
</center>
</body>
</html>

