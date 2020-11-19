<?php
session_start();
$count = 0;
include 'dbcon.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$sql = "SELECT * FROM Profile WHERE UserName = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$count = mysqli_num_rows($result);
if ($count == 1) {
   header('location: signup.html');
}
else
{
	$sql1 = "INSERT INTO Profile (UserName, Mail, Password) values ('$username', '$email', '$password')";

   if (mysqli_query($conn, $sql1)) {
    echo '<script>alert("Registration Successful.")</script>';
    header('location: login.html');
} else {
    echo "Error: " . $sql1 . "<br>" . mysqli_error($conn);
 }	
}


?>