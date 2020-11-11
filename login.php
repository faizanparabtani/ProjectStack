<?php
session_start();
$count = 0;
include 'dbcon.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM Profile WHERE UserName = '$username' AND Password = '$password'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$count = mysqli_num_rows($result);

if ($count == 1) {
	echo '<script>alert("Login Successful")</script>';
	if ($_SERVER['REQUEST_METHOD'] == 'POST'){
				$_SESSION["login"] = "OK";
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['username'] = $row['UserName'];
        if($_SESSION['username']){
            header('location: dashboard.php');
        }
    }
}else
{
	echo '<script>alert("Login Unsuccessful")</script>';
	header('location: login.html');
}
?>
