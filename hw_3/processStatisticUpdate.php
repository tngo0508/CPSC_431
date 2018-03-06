<?php
// create short variable names
$time       = trim(preg_replace("/\t|\R/",' ',$_POST['time']));
$points     = (int) trim(preg_replace("/\t|\R/",' ',$_POST['points']));
$assists    = (int) trim(preg_replace("/\t|\R/",' ',$_POST['assists']));
$rebounds   = (int) trim(preg_replace("/\t|\R/",' ',$_POST['rebounds']));
$player     = (int) trim(preg_replace("/\t|\R/",' ',$_POST['name_ID']));

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

$db->close();

require_once('home_page.php');
?>
