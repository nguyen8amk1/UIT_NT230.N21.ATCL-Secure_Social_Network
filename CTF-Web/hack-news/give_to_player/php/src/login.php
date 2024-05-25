<?php
    require_once "import.php";
    session_start();
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) 
    {
        header('Location: /news.php');
        die();
    }

    require_once "db.php";

    do
    {
        if (!isset($_POST['username']) || !isset($_POST['password'])) break;

        $username = $_POST['username'];
        $password = $_POST['password'];

        $re = "/insert|delete|alter|select|where|from|on|union|order|by|\"|'|group|limit|<|>|=|&|\||true|false|not|and|or|%|like|in/mi";
        if (preg_match($re, $username)) break;
        if (preg_match($re, $password)) break;

        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($connection, $query);  
        if (mysqli_num_rows($result) !== 1) break;
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = mysqli_fetch_assoc($result)['username'];
        
        header('Location: news.php');
        die();
    }
    while (false);
    header('Location: /');
    die();
?>