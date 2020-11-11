<?php
session_start();
include 'dbcon.php';

if(!(isset($_SESSION["login"]) && $_SESSION["login"] == "OK")) {
    header("Location: login.html");
    exit;
}


$username = $_SESSION['username'];
$subject = $_GET['subject'];
$year = $_GET['year'];

$sql = "SELECT * FROM Projects WHERE projectid IN (SELECT $subject FROM $year)";
// $sql = "SELECT TOP 10 projectid FROM Projects ORDER BY upload_time DESC";
// $sql = "SELECT projectid FROM (SELECT TOP 10 projectid FROM Projects ORDER BY upload_time DESC) SQ ORDER BY upload_time ASC";
$result = mysqli_query($conn, $sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
$count = mysqli_num_rows($result);
$_SESSION['row_count'] = $count;

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo $subject ?></title>
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="dashboard.css">
    <link rel="stylesheet" href="subject.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="header">
        <div class="inner_header">
            <div class="logo_container">
              <a href="projects.php">
                <img src="images/Logo.svg" alt="ProjectStack">
              </a>
            </div>
            <ul class="navigation">
                <a href="dashboard.php"><li>Projects</li></a>
                <a href="login.html"><li><?php echo $username;?></li></a>
                <a href="logout.php"><li><img src="images/avatar.svg" alt=""></li></a>
            </ul>
        </div>
    </div>
    <div class="home">
    <div class="recent_proj">
        <div class="browse">
            <h2>Browse the recent projects</h2>
        </div>
    <div class="recent">
        <?php
        echo "<table>";
        echo "<th>";
          echo "<tr>";
            echo "<th>Topic</th>";
            echo "<th>Contributor</th>";
            echo "<th>Date</th>";
          echo "</tr>";
        echo "</th>";
        while($row = mysqli_fetch_array($result)){
            $time = $row['upload_time'];
            $temptime = strtotime($time);
            $finaltime = date("d/m/y g:i A", $temptime);
            echo "<tr>";
            echo "<td><a class='varlink' href='project.php?projectid=" .$row['projectid'] . "'>" .$row['topic']. "</a></td>";
            echo "<td>" .$row['UserName']. "</td>";
            echo "<td>" .$finaltime. "</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<a href='upload.php?subject=" .$subject. "&year=" .$year. "'>Upload</a>";
        ?>
      </div>
    </div>
  </body>
</html>
