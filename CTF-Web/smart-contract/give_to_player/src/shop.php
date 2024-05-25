<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: auth.php");
    die();
}

require_once "./db.php";

$username = $_SESSION['username'];

if (isset($_POST['name'])) {
    $name = $_POST['name'];
    if (!is_string($name) || empty($name)) {
        die("Invalid item name");
    }

    $result = $conn->execute_query("SELECT content, price FROM items WHERE name=?", [$name]);
    if (!$result) {
        die("Failed to retrieve item!");
    }

    $row = $result->fetch_assoc();
    if (empty($row)) {
        die("Item not found!");
    }

    $content = $row['content'];
    $price = $row['price'];

    $result = $conn->execute_query("SELECT balance FROM users WHERE username=?", [$username]);
    if (!$result) {
        die("Failed to retrieve balance!");
    }

    $row = $result->fetch_assoc();
    $balance = $row['balance'];

    if ($balance < $price) {
        die("Insufficient balance!");
    }

    $result = $conn->execute_query("UPDATE users SET balance=? WHERE username=?", [$balance - $price, $username]);
    if (!$result) {
        die("Failed to update balance!");
    }

    echo $content;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Shop</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
    background-color: #f2f2f2;
  }
  .navbar {
    background-color: #007bff; /* Original blue */
  }
  .navbar .navbar-brand,
  .navbar .nav-link {
    color: #fff; /* Original white */
  }
  .container {
    margin-top: 20px;
  }
  .card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  .card-header {
    background-color: #007bff; /* Original blue */
    border-radius: 15px 15px 0 0;
  }
  .card-title {
    color: #fff; /* Original white */
  }
  .btn-primary {
    background-color: #007bff; /* Original blue */
    border: none;
    border-radius: 10px;
  }
  .btn-primary:hover {
    background-color: #0056b3; /* Original blue - hover */
  }
</style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Money Transfer App</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="transfer.php">Transfer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="shop.php">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Flag</h5>
          </div>
          <div class="card-body">
            <p class="card-text">Red flag.</p>
            <p class="card-text">Price: $18446744073709551616</p>
            <form action="shop.php" method="POST">
              <input type="hidden" name="name" value="Flag">
              <button type="submit" class="btn btn-primary">Buy Now</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Chopper</h5>
          </div>
          <div class="card-body">
            <p class="card-text">Monke D. Choppẻ.</p>
            <p class="card-text">Price: $1</p>
            <form action="shop.php" method="POST">
              <input type="hidden" name="name" value="Chopper">
              <button type="submit" class="btn btn-primary">Buy Now</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title">Tony Buoi Sang</h5>
          </div>
          <div class="card-body">
            <p class="card-text">A mysterious and buoi sang item.</p>
            <p class="card-text">Price: $6969</p>
            <form action="shop.php" method="POST">
              <input type="hidden" name="name" value="Tony Buoi Sang">
              <button type="submit" class="btn btn-primary">Buy Now</button>
            </form>
          </div>
        </div>
      </div>
      <!-- Add more items here -->
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
