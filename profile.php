<?php
session_start();
include 'dbcon.php';

if(!(isset($_SESSION["login"]) && $_SESSION["login"] == "OK")) {
    header("Location: login.html");
    exit;
}

$username = $_SESSION['username'];
$sql = "SELECT * FROM Projects WHERE UserName LIKE '$username' ORDER BY upload_time DESC";
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
    <title><?php echo "Profile - ". $username; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="profile.css">
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
                <a href="login.html"><li><?php echo $username;?></li></a>
                <a href="logout.php"><li><img src="images/avatar.svg" alt=""></li></a>
            </ul>
        </div>
    </div>
    <div class="parent_cont">
      <div class="profile_container">
        <div class="background_container">
          <?php echo "<img src='background_img/" .$username. ".jpg'>";?>
        </div>
        <div class="profile_img_container">
          <?php echo "<img src='profile_img/" .$username. ".jpg'>";?>
        </div>
        <div class="bio_container">
          <h3>Hello I am Faizan</h3>
        </div>
      </div>
      <div class="project_cont">
        <?php
        echo "<table>";
        echo "<thead>";
          echo "<tr>";
            echo "<th>Topic</th>";
            echo "<th>Contributor</th>";
            echo "<th>Date</th>";
          echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
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
        echo "</tbody>";
        echo "</table>";
        ?>
      </div>
    </div>
  </body>
</html>
