<?php
session_start();
session_destroy();
// $_SESSION["login"] = "";
$_SESSION = [];
header('Location: login.html');
?>