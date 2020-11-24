<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();
include 'dbcon.php';

if(!(isset($_SESSION["login"]) && $_SESSION["login"] == "OK")) {
    header("Location: login.html");
    exit;
}


$username = $_SESSION['username'];
$subject = $_SESSION['subject_sess'];
$year = $_SESSION['year_sess'];



$topic = $_POST['topic'];
$description = $_POST['description'];
$code = $_POST['code'];
$tc = $_POST['tc'];





if ($tc == "Agree") {
  if ($topic != "" || $description != "") {
    if ($_FILES["image"]["error"] > 0){
       echo "<font size = '5'><font color=\"#e31919\">Error: NO CHOSEN FILE <br />";
       echo"<p><font size = '5'><font color=\"#e31919\">INSERT TO DATABASE FAILED";
     }
    else{
     move_uploaded_file($_FILES["image"]["tmp_name"],"useruploads/" . $_FILES["image"]["name"]);
     echo"<font size = '5'><font color=\"#0CF44A\">SAVED<br>";

     $file="useruploads/".$_FILES["image"]["name"];
     // INSERT INTO `Projects` (`projectid`, `UserName`, `Subject`, `year`, `topic`, `description`, `image`, `upload_time`) VALUES (NULL, 'faizan123', 'DBMS', 'SE', 'Hello', 'Test', 'useruploads/dbms.jpg', CURRENT_TIMESTAMP);
     $sql = "INSERT INTO Projects (projectid, UserName, Subject, year, topic, description, code, image, upload_time) values (NULL, '$username', '$subject', '$year', '$topic', '$description', '$code', '$file', CURRENT_TIMESTAMP)";
     $result = mysqli_query($conn, $sql);
     if (!$result) {
         printf("Error: %s\n", mysqli_error($conn));
         exit();
     }
     else{
      header('location: dashboard.php');
     }
    }
  }
  else {
    die('Description field is empty');
  }
}
else {
  header('location: upload.html?subject=$subject&year=$year');
}
?>
