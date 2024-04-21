<?php

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    die();
}

require_once "./db.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    if (!is_string($username) || empty($username)) {
        die("Invalid username!");
    }

    $password = $_POST['password'];
    if (!is_string($password) || empty($password)) {
        die("Invalid password!");
    }

    if (isset($_POST['confirm_password'])) {
        $confirm_password = $_POST['confirm_password'];

        if (!is_string($confirm_password) || empty($confirm_password)) {
            die("Invalid confirm password!");
        }

        if ($confirm_password !== $password) {
            die("Password and confirm password does not match!");
        }

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $result = $conn->execute_query("INSERT INTO users VALUES (?, ?, ?)", [$username, $hashed_password, 1]);
        if (!$result) {
            die("Username already exists!");
        }

        $_SESSION['username'] = $username;
        header("Location: index.php");

        die("Registration successful!");
    } else {
        $result = $conn->execute_query("SELECT password FROM users WHERE username=?", [$username]);
        if (!$result) {
            die("Failed to retrieve username");
        }

        $row = $result->fetch_assoc();
        if (empty($row)) {
            die("User does not exist!");
        }

        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            die("Login successfully!");
        }

        die("Wrong password!");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container input[type="text"],
        .form-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .form-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .form-container input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .form-container .switch {
            text-align: center;
            margin-top: 10px;
        }

        .form-container .switch a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

    </style>
</head>
<body>

<div class="form-container" id="login-form">
    <h2>Login</h2>
    <form action="auth.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>
    <div class="switch">
        <p>Don't have an account? <a href="#" onclick="toggleForm('register')">Register</a></p>
    </div>
</div>

<div class="form-container" id="register-form" style="display: none;">
    <h2>Register</h2>
    <form action="auth.php" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <input type="submit" value="Register">
    </form>
    <div class="switch">
        <p>Already have an account? <a href="#" onclick="toggleForm('login')">Login</a></p>
    </div>
</div>

<script>
    function toggleForm(formName) {
        var loginForm = document.getElementById('login-form');
        var registerForm = document.getElementById('register-form');

        if (formName === 'register') {
            loginForm.style.display = 'none';
            registerForm.style.display = 'block';
        } else {
            loginForm.style.display = 'block';
            registerForm.style.display = 'none';
        }
    }
</script>

</body>
</html>
