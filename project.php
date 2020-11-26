<?php
session_start();
include 'dbcon.php';
$projectid = $_GET['projectid'];
// if (isset($_SESSION['username'])) {
//     $username = $_SESSION['username'];
// }
error_reporting(E_ALL & ~E_NOTICE);
$username = $_SESSION['username'];

$sql = "SELECT * FROM Projects WHERE projectid LIKE $projectid";
$result = mysqli_query($conn, $sql);
if (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
}
$row = mysqli_fetch_array($result);
$count = mysqli_num_rows($result);
$_SESSION['row_count'] = $count;

$subject = $row['Subject'];
$year = $row['year'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo "Project" .$projectid; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="base.css">
    <link rel="stylesheet" href="project.css">
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
                <a href="dashboard.php"><li>Projects</li></a>
                <?php echo "<a href='subject.php?subject=".$subject. "&year=" .$year. "'><li>" .$subject. "</li></a>" ?>
                <?php if((isset($_SESSION["login"]) && $_SESSION["login"] == "OK")) {
                        echo "<a href='profile.php'><li>". $username. "</li></a>";
                        echo "<a href='logout.php'><li>Logout</li></a>";
                    
                    }
                ?>
            </ul>
        </div>
    </div>
    <div class="proj_parent">
      <div class="proj">
        <div class="title">
          <h1><?php echo $row['topic'];?></h1>
        </div>
        <div class="image">
          <?php echo "<img class='project_image'src='" .$row['image']. "' alt='project_image'>" ?>
        </div>
        <div class="description">
          <p><?php echo nl2br($row['description']); ?></p>
        </div>
        <?php if($row['code'] != "") {
            echo "<div class='code'>
            <h3>Code</h3>
            <pre>
                <code>" .$row['code']. "</code>
            </pre>
        </div>";
        }
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
