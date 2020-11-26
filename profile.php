<?php
session_start();
include 'dbcon.php';

if(!(isset($_SESSION["login"]) && $_SESSION["login"] == "OK")) {
    header("Location: login.html");
    exit;
}

$user = $_SESSION['username'];
$username = $_GET['username'];
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
              <a href="dashboard.php">
                <img src="images/Logo.svg" alt="ProjectStack">
              </a>
            </div>
            <ul class="navigation">
                <?php if((isset($_SESSION["login"]) && $_SESSION["login"] == "OK")) {
                        echo "<a href='profile.php'><li>". $user. "</li></a>";
                        echo "<a href='logout.php'><li>Logout</li></a>";
                    
                    }
                ?>
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
          <h3>Hello I am <?php echo $username;?></h3>
        </div>
      </div>
      <?php if($count > 0){
        echo "
          <div class='browse'>
            <h3>Browse their Projects</h3>
          </div>
        ";
      }
      ?>
      <div class="project_cont">
        <?php
        echo "<table>";
        echo "<th>";
          echo "<tr>";
            echo "<th>Topic</th>";
            echo "<th>Date</th>";
          echo "</tr>";
        echo "</th>";
        echo "<tbody>";
        while($row = mysqli_fetch_array($result)){
            $time = $row['upload_time'];
            $temptime = strtotime($time);
            $finaltime = date("d/m/y g:i A", $temptime);
            echo "<tr>";
            echo "<td><a class='varlink' href='project.php?projectid=" .$row['projectid'] . "'>" .$row['topic']. "</a></td>";
            echo "<td>" .$finaltime. "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        ?>
      </div>
    </div>
    <footer class="footer">
        <div class="footer_logo">
            <img src="images/Logo.svg">
        </div>
        <div>
            <h3>Read more about<br>our mission</h3>
            <a href="about.html"><h4>About Us</h4></a>
        </div>
        <div>
            <h3>Legal</h3>
            <h4>T&C</h4>
            <h4>Policies</h4>
        </div>
        <div class="social_links">
            <h3>Social</h3>
            <h4>Twitter</h4>
            <h4>Instagram</h4>
            <h4>Facebook</h4>
        </div>
    </footer>
  </body>
</html>
