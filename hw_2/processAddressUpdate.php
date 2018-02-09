<?php

//create short variable names
$first_name = preg_replace("/\t|\R/",' ',$_POST['firstName']);
$last_name = preg_replace("/\t|\R/",' ',$_POST['lastName']);
$street = preg_replace("/\t|\R/",' ',$_POST['street']);
$city = (string) $_POST['city'];
$state = (string) $_POST['state'];
$zipCode = (int) $_POST['zipCode'];
$document_root = $_SERVER['DOCUMENT_ROOT'];

$name = "$last_name".', '."$first_name";
require('Address.php');

$newPlayer = new Address($name, $street, $city, $state, $zipCode);

if (!empty($name))
{
  file_put_contents("$document_root/data/teamRoster.txt", $newPlayer->toTSV()."\n", FILE_APPEND | LOCK_EX);
}

require('home_page.php');
 ?>
