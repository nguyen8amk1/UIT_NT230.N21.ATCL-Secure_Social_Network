<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: auth.php");
    die();
}

require_once "./db.php";

$last_transfer = 0;

function _preCheck($from, $to, $amount)
{
    global $conn;

    $result = $conn->execute_query("SELECT balance FROM users WHERE username=?", [$from]);
    if (!$result) {
        die("Failed to retrieve sender balance!");
    }

    $row = $result->fetch_assoc();
    if (empty($row)) {
        die("Sender not found!");
    }

    $fromBalance = $row['balance'];

    if ($fromBalance < $amount) {
        die("Insufficient balance!");
    }

    return $fromBalance;
}

function _postCheck($from, $to, $amount)
{
    global $conn;

    $result = $conn->execute_query("SELECT balance FROM users WHERE username=?", [$from]);
    if (!$result) {
        die("Failed to retrieve sender balance!");
    }

    $row = $result->fetch_assoc();
    if (empty($row)) {
        die("Sender not found!");
    }

    $toBalance = $row['balance'] + $amount;

    if ($toBalance > 1e20) {
        die("Receiver can not receive more money");
    }

    return $toBalance;
}


function _botCheck($from, $to)
{
    global $last_transfer;

    $now = time();
    if ($now - $last_transfer < 2) {
        die("Bot detected");
    }
    $last_transfer = $now;
}

function _updateBalance($username, $amount)
{
    global $conn;

    $result = $conn->execute_query("UPDATE users SET balance=? WHERE username=?", [$amount, $username]);
    if (!$result) {
        die("Failed to update balance!");
    }
}

function _taxApply($from, $to, $amount)
{
    $taxPercent = 25;
    $taxAmount = $amount * $taxPercent / 100;
    return intval($taxAmount);
}

function _update($from, $to, $amount)
{
    if (empty($from) || empty($to)) {
        return;
    }

    _botCheck($from, $to);
    $fromBalanceBeforeTransfer = _preCheck($from, $to, $amount);

    $amountAfterTax = $amount - _taxApply($from, $to, $amount);
    $toBalance = _postCheck($from, $to, $amountAfterTax);

    _updateBalance($from, $fromBalanceBeforeTransfer - $amount);
    _updateBalance($to, $toBalance);
}

if (isset($_POST['recipient']) && isset($_POST['amount'])) {
    $recipient = $_POST['recipient'];
    $amount = $_POST['amount'];

    if (!is_string($recipient)) {
        die("Invalid recipient!");
    }

    $amount = intval($amount);
    if ($amount <= 0) {
        die("Invalid amount!");
    }

    $username = $_SESSION['username'];

    _update($username, $recipient, $amount);

    echo "Transfer successfully!";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Transfer Money</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
    background-color: #f2f2f2;
  }
  .container {
    margin-top: 20px;
  }
</style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
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
          <li class="nav-item active">
            <a class="nav-link" href="transfer.php">Transfer</a>
          </li>
          <li class="nav-item">
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
          <div class="card-header bg-primary text-white">
            <h3 class="card-title">Transfer Money</h3>
          </div>
          <div class="card-body">
            <form action="transfer.php" method="POST">
              <div class="form-group">
                <label for="recipient">Recipient:</label>
                <input type="text" id="recipient" name="recipient" class="form-control" placeholder="Recipient's Username" required>
              </div>
              <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" id="amount" name="amount" class="form-control" placeholder="Amount" min="0" required>
              </div>
              <button type="submit" class="btn btn-primary">Transfer</button>
            </form>
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
