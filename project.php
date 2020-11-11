<?php
session_start();
include 'dbcon.php';
$projectid = $_GET['projectid'];
$username = $_SESSION['username'];

if(!(isset($_SESSION["login"]) && $_SESSION["login"] == "OK")) {
    header("Location: login.html");
    exit;
}


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
                <?php echo "<a href='subject.php?subject=".$subject. "&year=" .$year. "'><li>" .$subject. "</li></a>" ?>
                <a href="login.html"><li><?php echo $username;?></li></a>
                <a href="logout.php"><li><img src="images/avatar.svg" alt=""></li></a>
            </ul>
        </div>
    </div>
    <h2><?php echo $row['topic']; ?></h2>
  </body>
</html>
