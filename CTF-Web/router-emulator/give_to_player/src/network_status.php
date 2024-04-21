<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Network Status</title>
<style>
/* CSS Styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f5f5f5;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    background-color: #fff;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
}

.header {
    background-color: #3498db;
    color: #fff;
    padding: 20px;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}

.content {
    padding: 20px;
}

</style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1>Network Status</h1>
    </div>
    <div class="content">
        <h2>Connected Devices</h2>
        <p>Total Devices: 10</p>
        <ul>
            <li>Device 1</li>
            <li>Device 2</li>
            <li>Device 3</li>
            <li>Device 4</li>
            <li>Device 5</li>
            <li>Device 6</li>
            <li>Device 7</li>
            <li>Device 8</li>
            <li>Device 9</li>
            <li>Device 10</li>
        </ul>
        <h2>Internet Status</h2>
        <p>Status: Connected</p>
        <p>Connection Type: Wired</p>
		<p>IP Address: <?php echo $_SERVER['SERVER_ADDR']; ?></p>
        <p>Subnet Mask: 255.255.255.0</p>
        <p>Gateway: 192.168.1.254</p>
    </div>
</div>

</body>
</html>

