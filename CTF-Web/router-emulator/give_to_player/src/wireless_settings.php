<?php

require "./utils.php";

function handle_change_password($password, $key, $file_path)
{
    if (!empty($password)) {
        $hashed_passwd = generate_md5_hash($password);
        $encrypted_passwd = encrypt_password($password, $hashed_passwd, $key);
        $success = write_password_to_file($encrypted_passwd, $file_path);
        return $success;
    }
    return false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $file_path = "./passwd";
    if (handle_change_password($password, $key, $file_path)) {
        echo "Password changed successfully!";
    } else {
        echo "Failed to change password. Please try again later.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Wireless Settings</title>
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

		.header {
			background-color: #3498db;
			color: #fff;
			padding: 20px 0;
			text-align: center;
		}

		.form-group {
			margin-bottom: 20px;
		}

		.form-group label {
			font-weight: bold;
		}

		.form-group input {
			width: 100%;
			padding: 10px;
			font-size: 16px;
			border: 1px solid #ccc;
			border-radius: 5px;
		}

		.button {
			display: inline-block;
			padding: 10px 20px;
			background-color: #3498db;
			color: #fff;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 16px;
			transition: background-color 0.3s ease;
		}

		.button:hover {
			background-color: #2980b9;
		}
	</style>
</head>

<body>

	<div class="header">
		<h1><i class="fas fa-wifi"></i> Wireless Settings</h1>
	</div>

	<div class="container">
		<div class="card">
			<i class="fas fa-wifi"></i>
			<h2>Wireless Network Settings</h2>
			<p><strong>SSID:</strong> MyRouter</p>
			<p><strong>Security:</strong> WPA2</p>
			<form action="/?page=wireless_settings.php" method="POST" id="passwordForm">
				<div class="form-group">
					<label for="password">New Password:</label>
					<input type="password" id="password" name="password" required>
				</div>
				<button type="submit" class="button">Change Password</button>
			</form>
			<p><strong>Channel:</strong> Auto</p>
			<p><strong>Mode:</strong> 802.11ac</p>
			<p><strong>MAC Filtering:</strong> Enabled</p>
			<p><strong>Guest Network:</strong> Disabled</p>
		</div>
	</div>

	<script>
	</script>

</body>

</html>
