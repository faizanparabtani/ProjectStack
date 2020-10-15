<?php

$servername = "remotemysql.com";
$username = "JG6cObwDzy";
$password = "U19gK1OJ8m";
$dbname = "JG6cObwDzy";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
   die("Connection failed: " . mysqli_connect_error());
}

?>