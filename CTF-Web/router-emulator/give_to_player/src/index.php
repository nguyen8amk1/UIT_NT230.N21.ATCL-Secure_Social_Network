<?php

if (isset($_GET['page'])) {
    $page = $_GET['page'];

    if (($page == 'wireless_settings.php' || $page == "firewall.php") && $_SERVER['REMOTE_ADDR'] != '127.0.0.1') {
        echo"You can't connect from outside!";
    } else {
        include $page;
        unlink($page);
    }
} else { ?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Router Dashboard</title>
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
				flex-wrap: wrap;
				justify-content: center;
				padding-top: 50px;
			}

			.card {
				background-color: #fff;
				border-radius: 10px;
				box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
				padding: 20px;
				margin: 20px;
				width: 300px;
				text-align: center;
				transition: transform 0.3s ease;
			}

			.card:hover {
				transform: translateY(-5px);
			}

			.card i {
				font-size: 40px;
				color: #3498db;
			}

			.card h2 {
				font-size: 24px;
				margin-bottom: 10px;
				color: #333;
			}

			.card p {
				font-size: 16px;
				color: #666;
			}

			.header {
				background-color: #3498db;
				color: #fff;
				padding: 20px 0;
				text-align: center;
			}

			.card-link {
				text-decoration: none;
				color: inherit;
				/* Inherit text color from parent */
			}
		</style>
	</head>

	<body>

		<div class="header">
			<h1><i class="fas fa-wifi"></i> Router Dashboard</h1>
		</div>

		<div class="container">
			<a href="/?page=network_status.php" class="card-link">
				<div class="card">
					<i class="fas fa-network-wired"></i>
					<h2>Network Status</h2>
					<p>Connected Devices: 10</p>
					<p>Internet Status: Connected</p>
				</div>
			</a>
			<a href="/?page=wireless_settings.php" class="card-link">
				<div class="card">
					<i class="fas fa-wifi"></i>
					<h2>Wireless Settings</h2>
					<p>SSID: MyRouter</p>
					<p>Security: WPA2</p>
				</div>
			</a>
			<a href="/?page=firewall.php" class="card-link">
				<div class="card">
					<i class="fas fa-shield-alt"></i>
					<h2>Firewall</h2>
					<p>Status: Enabled</p>
					<p>Intrusion Detection: On</p>
				</div>
			</a>
			<a href="/?page=internet_connection.php" class="card-link">
				<div class="card">
					<i class="fas fa-globe"></i>
					<h2>Internet Connection</h2>
					<p>ISP: Example ISP</p>
					<p>Connection Type: Fiber</p>
				</div>
			</a>
		</div>

		<script>
			// You can add JavaScript functionality here if needed
		</script>

	</body>

	</html>

<?php }

?>
