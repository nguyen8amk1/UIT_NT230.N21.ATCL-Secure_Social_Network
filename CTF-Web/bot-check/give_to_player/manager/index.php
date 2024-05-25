<?php

require_once "./db.php";

if (isset($_POST['username']) && isset($_POST['upgrade'])) {
    $username = $_POST['username'];
    if (!is_string($username) || empty($username)) {
        die("Invalid username!");
    }

    $result = $conn->execute_query("UPDATE users SET premium=1 WHERE username=?", [$username]);
    if (!$result) {
        die("Failed to upgrade user!");
    }

    if (!$conn->affected_rows) {
        die("User not found or already upgraded!");
    }

    echo "Upgrade successfully!";
}
