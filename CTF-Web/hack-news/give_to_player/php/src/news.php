<?php
  require_once "import.php";
  session_start();
  if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) 
  {
      header('Location: /');
      die();
  }

  require_once "db.php";

  $newsQuery = "SELECT name, content FROM news";
  $newsQuery .= $_SESSION['username'] !== 'adm1n' ? '' : ' WHERE private = 0';

  $newsResult = mysqli_query($connection, $newsQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hacker News</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container">
    <h2 class="text-center mt-4 mb-4">Hacker news</h2>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Content</th>
        </tr>
      </thead>
      <tbody>
            <?php
                while ($row = mysqli_fetch_assoc($newsResult)) 
                {
                    echo "<tr>";
                    echo "<th scope=\"row\">" . $row['name'] . "</th>";
                    echo "<td>" . $row['content'] . "</td>";
                    echo "</tr>";
                }
            ?>
      </tbody>
    </table>
  </div>
</body>
</html>
