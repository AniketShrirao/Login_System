<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "login_system";

$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);

if (!$conn) {
  die("Connection Failed: ".mysqli_connect_error()); 
}