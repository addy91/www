<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
 "http://www.w3.org/TR/html4/strict.dtd">
 
<?php include("dbconnect.php"); ?> 

<html> 
<head>
<title>dataLogger</title>
<meta name="description" content="dataLogger">
<meta http-equiv="content-Type" content="text/html; charset=ISO-8859-1">
<meta http-equiv="language" content="de">
<meta name="robots" content="noindex,nofollow">
<meta name="rating" content="General">
<meta name="author" content="Karl" >
<meta name="publisher" content="Karl Andreä¤">
<meta name="copyright" content="Karl Andreä¤">
<!--
<meta http-equiv="refresh" content="60; URL=http://192.168.10.200/index.php">
-->
<link rel="shortcut icon" href="./src/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" href="./css/screen.css" type="text/css">
<link rel="stylesheet" href="./etc/smart.css" type="text/css">
</head>


<body id="body">
<script language="javascript" type="text/javascript">
      window.setTimeout('location.href=location.href',60000);
</script>

<?php include ("content.php"); ?>
<?php include ("footer.php"); ?>

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
	$pos1  = $row->pos;
	$temp = $row->temp;
	$rem  = $row->rem;
}


$temp1 = number_format($temp, 1, ',', '  ');
//echo $idx,  ",   ";
//echo $date, ",   ";
//echo $time, ",   ";
//echo $pos,  ",   ";
//echo $temp, " &deg;C <br>";
//echo $rem, "<br>";


$abfrage = mysqli_query($db, "SELECT * FROM $tabelle ORDER BY idx DESC LIMIT 2");
while ($row = mysqli_fetch_object($abfrage))
{
        $idx  = $row->idx;
        $date = $row->date;
        $time = $row->time;
        $pos2  = $row->pos;
        $temp = $row->temp;
        $rem  = $row->rem;
}
$zerlegt = explode("-",$date);
$date = $zerlegt[2].".".$zerlegt[1].".".$zerlegt[0];

$temp2 = number_format($temp, 1, ',', '  ');

//echo $idx,  ",   ";
//echo $date, ",   ";
//echo $time, ",   ";
//echo $pos,  ",   ";
//echo $temp, " &deg;C <br>";

//mysql_close($db);

?>


<div id="info" align="center">

<table width="780px" border="1" cellspacing="0" cellpadding="0">
  <tr>
      <td class="td2"><?php echo $date; ?></td>
      <td class="td2"><?php echo $time; ?></td>
  </tr>
  <tr>
      <td class="td2"><?php echo $pos1; ?></td>
      <td class="td2"><?php echo $pos2; ?></td>
  </tr>
   <tr>
      <td class="td3"><b><?php echo $temp1; ?> &deg;C</b></td>
      <td class="td3"><b><?php echo $temp2; ?> &deg;C</b></td>
  </tr>

</table>
</div>

<?php mysql_close($db); ?>


</body>
</html>

