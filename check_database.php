
<html>
<body>
<?php
try
{
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
</body>
</html>



