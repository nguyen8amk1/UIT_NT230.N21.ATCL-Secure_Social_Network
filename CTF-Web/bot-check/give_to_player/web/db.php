<?php

$host = "db";
$username = "root";
$password = "123456";
$db = "dbz";

$driver = new mysqli_driver();
$driver->report_mode = MYSQLI_REPORT_OFF;

$conn = new mysqli($host, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// echo "Connected successfully";
