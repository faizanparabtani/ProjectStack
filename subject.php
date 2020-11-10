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
    <title></title>
    <link rel="stylesheet" href="projects.css">
  </head>
  <body>
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
  </body>
</html>
