<?php
// create short variable names
// $name       = trim(preg_replace("/\t|\R/",' ',$_POST['name']));
$time       = trim(preg_replace("/\t|\R/",' ',$_POST['time']));
$points     = (int) trim(preg_replace("/\t|\R/",' ',$_POST['points']));
$assists    = (int) trim(preg_replace("/\t|\R/",' ',$_POST['assists']));
$rebounds   = (int) trim(preg_replace("/\t|\R/",' ',$_POST['rebounds']));
$player     = (int) trim(preg_replace("/\t|\R/",' ',$_POST['name_ID']));

// $document_root = $_SERVER['DOCUMENT_ROOT'];

require_once('PlayerStatistic.php');

$newStat = new PlayerStatistic($time, $points, $assists, $rebounds);

@$db = new mysqli('localhost', 'thomas', 'me123', 'CPSC_431_HW3');

if (mysqli_connect_errno()) {
  echo "<p>Error: Could not connects to database.<br/>
        Please try again later.</p>";
  exit;
}

if (strpos($time, ":") !== false) {
  list($playing_time_min, $playing_time_sec) = explode(":", $time);
}
else {
  $playing_time_min = $time;
  $playing_time_sec = 0;
}

$query = "INSERT INTO Statistics (Player, PlayingTimeMin, PlayingTimeSec, Points, Assists, Rebounds) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $db->prepare($query);
$stmt->bind_param('dddddd', $player, $playing_time_min, $playing_time_sec, $points, $assists, $rebounds);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo  "<p>A new statistics record was inserted into the database.</p>";
} else {
    echo "<p>An error has occurred.<br/>
          The record was not added.</p>";
}

$db->close();

require_once('home_page.php');
?>
