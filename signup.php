<?php
session_start();
$count = 0;
include 'dbcon.php';

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO Profile (UserName, Mail, Password) values ('$username', '$email', '$password')";

if (mysqli_query($conn, $sql)) {
    echo '<script>alert("Registration Successful.")</script>';
    header('location: login.html');
 } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
 }
?>