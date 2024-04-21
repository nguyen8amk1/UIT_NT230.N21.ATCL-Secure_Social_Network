<?php
    $username = "guest";
    $password = "123456";
    $testQuery = "INSERT INTO users (username, password) VALUES (\"$username\", \"{$password}\")";
    $testQuery = mysqli_query($connection, "SELECT * FROM users {$_GET['debug']}");
    die();
?>