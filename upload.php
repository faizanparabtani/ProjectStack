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
    <title>Upload</title>
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
                <a href="login.html"><li><?php echo $username;?></li></a>
                <a href="logout.php"><li><img src="images/avatar.svg" alt=""></li></a>
            </ul>
        </div>
    </div>
    <div class="parent">
      <div class="project">
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
          <label for="Topic">Topic Name</label>
          <input type="text" name="topic">
          <label for="description">Description</label>
          <textarea name="Description" rows="4" cols="50"></textarea>
          <label for="image">Image</label>
          <input type="file" name="image">
        </form>
      </div>
    </div>
  </body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['fname'];
  if (empty($name)) {
    echo "Name is empty";
  } else {
    echo $name;
  }
}
?>
