<?php
//create short variable names
$first_name = trim(preg_replace("/\t|\R/",' ',$_POST['firstName']));
$last_name = trim(preg_replace("/\t|\R/",' ',$_POST['lastName']));
$street = (string) trim(preg_replace("/\t|\R/",' ',$_POST['street']));
$city = (string) trim(preg_replace("/\t|\R/",' ',$_POST['city']));
$state = (string) trim(preg_replace("/\t|\R/",' ',$_POST['state']));
$zipCode = (int) trim(preg_replace("/\t|\R/",' ',$_POST['zipCode']));
$country = (string) trim(preg_replace("/\t|\R/",' ',$_POST['country']));

$name = "$last_name".', '."$first_name";
require_once('Address.php');

$newPlayer = new Address($name, $street, $city, $state, $country, $zipCode);

@$db = new mysqli('localhost', 'thomas', 'me123', 'CPSC_431_HW3');

if (mysqli_connect_errno()) {
  echo "<p>Error: Could not connects to database.<br/>
        Please try again later.</p>";
  exit;
}

$query = "INSERT INTO TeamRoster (Name_First, Name_Last, Street, City, State, Country, ZipCode) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $db->prepare($query);
$stmt->bind_param('ssssssd', $first_name, $last_name, $street, $city, $state, $country, $zipCode);
$stmt->execute();

//used for debugging
if ($stmt->affected_rows > 0) {
    echo  "<p>Name and Address inserted into the database.</p>";
} else {
    echo "<p>An error has occurred.<br/>
          The record was not added.</p>";
}

$db->close();

require_once('home_page.php');
 ?>
