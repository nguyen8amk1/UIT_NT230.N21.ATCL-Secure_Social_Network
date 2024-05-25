<?php
    require_once "import.php";
    session_start();
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true || $_SESSION['username'] !== '4dm1n') 
    {
        header('Location: /');
        die();
    }

    require_once "db.php";
?>

<?php
    echo "<h1>This site is under construction</h1>";
    header("Location: /news.php");
    
    require_once "controlpanel/admin.php";
    require_once "controlpanel/register.php";
    require_once "controlpanel/debug.php";
?>

<?php
    // Footer
    echo "See you later!!!";
?>