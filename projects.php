<?php
session_start();
include 'dbcon.php';

if(!(isset($_SESSION["login"]) && $_SESSION["login"] == "OK")) {
    header("Location: login.html");
    exit;
}


$username = $_SESSION['username'];
$sql = "SELECT * FROM Projects ORDER BY upload_time DESC";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="projects.css">
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
                <!-- <a href="projects.html"><li>Projects</li></a> -->
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
            echo "<table class='table'>";
            echo "<thead class='thead-primary'>";
              echo "<tr class='text-center'>";
                echo "<th>Topic</th>";
                echo "<th>Contributor</th>";
                echo "<th>Date</th>";
              echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while($row = mysqli_fetch_array($result)){
                // echo "<h1>" .$row['topic']. " by user ".$row['UserName']." posted on ".$row['upload_time']."</h1>";
                echo "<tr>";
                echo "<td>" .$row['topic']. "</td>";
                echo "<td>" .$row['UserName']. "</td>";
                echo "<td>" .$row['upload_time']. "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            ?>
        </div>
    </div>
    <div class="years_container">
            <div class="years">
                <button class="year_button" onclick="location.href='fe.php'">First Year</button>
                <button class="year_button" onclick="location.href='se.php'">Second Year</button>
                <button class="year_button" onclick="location.href='te.php'">Third Year</button>
            </div>
        </div>
        <div class="activity_container">
            <div class="view"><img src="images/view.svg" alt=""></div>
            <div class="upload"><img src="images/upload.svg" alt=""></div>
            <div class="download"><img src="images/download.svg" alt=""></div>
        </div>
    </div>
</body>
</html>
