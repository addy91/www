<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<?php
  include("dbconnect.php");
?>

<html>
  <head>
    <title>Temperaturen erfassen</title>
    <meta http-equiv="expires" content="0">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta http-equiv="refresh" content="60; URL=http://192.168.10.200/raspi.php">
  </head>

<body>

<!--<script language="javascript" type="text/javascript">
      window.setTimeout('location.href=location.href',60000);
</script> -->

  <?php

  $tabelle = "temp"; //hier kannst du den tabellenname festlegen

  $dbname="dataLogger";        // Name der Datenban
  $dbhost="localhost";         // Adresse des Datenbankservers, meist localhost
  $dbuser="karl";              // Ihr MySQL Benutzername
  $dbpass="2fast4y";           // Ihr MySQL Passwort

  $db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
  if(mysqli_connect_errno())
  {
     echo("Kein Connect zur Datenbank moeglich.<br>".mysqli_connect_error());
     exit();
  }


//$datum = date("Ymd");
//$zeit = date("His");
//$sensor[$count] = $matches[1];

$abfrage = mysqli_query($db, "SELECT * FROM $tabelle ORDER BY idx DESC LIMIT 1");
while ($row = mysqli_fetch_object($abfrage))
{
        $idx  = $row->idx;
	$date = $row->date;
	$time = $row->time;
	$pos  = $row->pos;
	$temp = $row->temp;
	$rem  = $row->rem;
}

$temp = number_format($temp, 1, ',', '  ');
echo $idx,  ",   ";
echo $date, ",   ";
echo $time, ",   ";
echo $pos,  ",   ";
echo $temp, " &deg;C <br>";
//echo $rem, "<br>";

$abfrage = mysqli_query($db, "SELECT * FROM $tabelle ORDER BY idx DESC LIMIT 2");
while ($row = mysqli_fetch_object($abfrage))
{
        $idx  = $row->idx;
        $date = $row->date;
        $time = $row->time;
        $pos  = $row->pos;
        $temp = $row->temp;
        $rem  = $row->rem;
}

$temp = number_format($temp, 1, ',', '  ');
echo $idx,  ",   ";
echo $date, ",   ";
echo $time, ",   ";
echo $pos,  ",   ";
echo $temp, " &deg;C <br>";
//echo $rem, "<br>";







/*
query = "INSERT INTO $tabellenname (`datum`,`zeit`,`sensor_id`,`sensor`) VALUES ('$datum','$zeit','$sensor_id[$count]','$sensor[$count]')";
if(mysql_query($query);
{
  echo "Eintrag ".$datum." ".$zeit." ".$sensor_id[$count]." ".$sensor[$count]." erfolgreich <br>";
}
else
{
  echo "Eintrag ".$datum." ".$zeit." ".$sensor_id[$count]." ".$sensor[$count]." Fehler! <br>";
}
*/
//ausgaben zur fehlersuche
/*
echo "datum ".$datum."<br>";
echo "zeit ".$zeit."<br>";
echo "datei sensor_id ".$daten_sensor_id."<br>";
echo "anzahl_sensoren ".$anzahl_sensoren."<br>";
echo "sensor_id_".$count." ".$sensor_id[$count]."<br>";
echo "thermometer_sensor_path ".$thermometer_sensor_path."<br>";
print "ausgabe der files w1_slave ".$thermometerReadings."<br>";
echo "count ".$count."<br>"
*/

mysql_close($db);

?>

</body>
</html>
