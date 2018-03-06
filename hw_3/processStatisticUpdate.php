<?php
// create short variable names
// $name       = trim(preg_replace("/\t|\R/",' ',$_POST['name']));
$time       = trim(preg_replace("/\t|\R/",' ',$_POST['time']));
$points     = (int) trim(preg_replace("/\t|\R/",' ',$_POST['points']));
$assists    = (int) trim(preg_replace("/\t|\R/",' ',$_POST['assists']));
$rebounds   = (int) trim(preg_replace("/\t|\R/",' ',$_POST['rebounds']));
$player     = (int) trim(preg_replace("/\t|\R/",' ',$_POST['name_ID']));

$document_root = $_SERVER['DOCUMENT_ROOT'];

require_once('PlayerStatistic.php');

$newStat = new PlayerStatistic($time, $points, $assists, $rebounds);

if( ! empty($name) )
{
  file_put_contents("$document_root/data/statistics.txt", $newStat->toTSV()."\n", FILE_APPEND | LOCK_EX);
}

@$db = new mysqli('localhost', 'thomas', 'me123', 'CPSC_431_HW3');

if (mysqli_connect_errno()) {
  echo "<p>Error: Could not connects to database.<br/>
        Please try again later.</p>";
  exit;
}

list($playing_time_min, $playing_time_sec) = explode(":", $time);
// $name = $newStat->name();
// list($last_name, $first_name) = explode(",", $name);
// echo "$last_name".', '."$first_name";
//
// $query = "SELECT ID FROM TeamRoster WHERE Name_First = ? AND Name_Last = ?";
// $stmt = $db->prepare($query);
// $stmt->bind_param('ss', $first_name, $last_name);
// $stmt->execute();
// $stmt->store_result();
// $stmt->bind_result($player);
//
// while ($stmt->fetch()) {
//   echo "$player";
// }

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
