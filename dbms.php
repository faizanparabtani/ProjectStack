<?php
include 'dbcon.php';
$sql = "SELECT * FROM Projects WHERE Subject IN ('DBMS')";
$result = mysqli_query($conn, $sql);
$count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DBMS</title>
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="projects.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet"> 
</head>
<body>
<div class="header">
        <div class="inner_header">
            <div class="logo_container">
                <img src="images/Logo.svg" alt="ProjectStack">
            </div>
            <ul class="navigation">
                <a href="projects.html"><li>Projects</li></a>
                <a href="login.html"><li><?php echo $_SESSION['username'];?></li></a>
                <a href="logout.php"><li><img src="images/avatar.svg" alt=""></li></a>
            </ul>
        </div>
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
</body>
</html>