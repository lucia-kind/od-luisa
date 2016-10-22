<?php
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("467536_2_1", $con);

$result = mysql_query("SELECT hundename, id FROM hunde ORDER BY RAND() LIMIT 20;");

while($row = mysql_fetch_array($result))
  {
  echo "<div class='result'>".$row['hundename']."</div>";
  }

mysql_close($con);
?>