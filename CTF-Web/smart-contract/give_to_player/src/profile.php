<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: auth.php");
    die();
}

require_once "./db.php";

$username = $_SESSION['username'];

$result = $conn->execute_query("SELECT balance FROM users WHERE username=?", [$username]);
if (!$result) {
    die("Failed to retrieve balance!");
}

$row = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Profile</title>
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
  .form-control {
    border-radius: 10px;
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
          <li class="nav-item active">
            <a class="nav-link" href="profile.php">Profile</a>
          </li>
          <li class="nav-item">
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
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card mt-4">
          <div class="card-header">
            <h3 class="card-title">User Profile</h3>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="username">Username:</label>
			  <input type="text" id="username" class="form-control" value="<?php echo $username; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="balance">Current Balance:</label>
			  <input type="text" id="balance" class="form-control" value="$<?php echo $row['balance']; ?>" readonly>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
