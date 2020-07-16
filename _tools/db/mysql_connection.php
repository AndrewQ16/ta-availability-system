<?php
$host = "tethys.cse.buffalo.edu";
$user = "sachalma";
$password = "50236680";
$database = "cse442_542_2020_summer_teame_db";
$port = 3306;

$conn = new mysqli($host, $user, $password, $database, $port);

if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: " . $conn->connect_error;
    exit();
}
?>