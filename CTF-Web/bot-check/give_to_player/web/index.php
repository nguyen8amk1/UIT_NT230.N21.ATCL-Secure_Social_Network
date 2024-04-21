<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: auth.php");
    die();
}

require_once "./db.php";


if (isset($_GET['flag'])) {
    $username = $_SESSION['username'];

    $result = $conn->execute_query("SELECT premium FROM users WHERE username=?", [$username]);
    if (!$result) {
        die("Failed to retrieve user!");
    }

    $row = $result->fetch_assoc();
    if (empty($row)) {
        die("User not found!");
    }

    $premium = $row['premium'];

    if ($premium) {
        echo file_get_contents("/flag.txt");
    } else {
        echo "You are not premium user!";
    }
}

if (isset($_POST['url'])) {
    $url = $_POST['url'];
    if (!is_string($url) || empty($url)) {
        die("Invalid URL!");
    }

    $ch = curl_init("http://bot?url=" . urlencode($url));
    curl_exec($ch);
    curl_close($ch);

    echo "\nURL reported!";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">My Website</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/?flag">Flag</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h2>Input URL to Report</h2>
    <form action="/" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="url" placeholder="Enter URL">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
