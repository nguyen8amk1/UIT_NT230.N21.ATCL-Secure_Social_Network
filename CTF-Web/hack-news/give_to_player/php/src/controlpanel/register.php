<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password']))
    {
        
        $username = $_POST['username'];
        $password = $_POST['password'];

        $re = "/insert|delete|alter|select|where|from|on|union|order|by|\"|'|group|limit|<|>|=|&|\||true|false|not|and|or|%|like|in/mi";
        if (preg_match($re, $username)) die();
        if (preg_match($re, $password)) die();

        $registerQuery = "INSERT INTO users (username, password) VALUES (\"$username\", \"{$password}\")";
        $registerQuery = mysqli_query($connection, $registerQuery);
        die();
    }
?>