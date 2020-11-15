<?php
session_start();
include 'dbcon.php';

if(!(isset($_SESSION["login"]) && $_SESSION["login"] == "OK")) {
    header("Location: login.html");
    exit;
}
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./base.css">
    <title>Third Year</title>
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
                <a href="projects.html"><li>Projects</li></a>
                <a href="login.html"><li><?php echo $username;?></li></a>
                <a href="#"><li><img src="images/avatar.svg" alt=""></li></a>
            </ul>
        </div>
    </div>



<p id="rcorners3" align="center"></p>
<p id="ayetext" align="center">Te.</p>
<p id="ayeyear">Third Year</p>
<p id="ayesub" >Boost your pointer this year by refering to these projects made in previous years.</p>
<p id="ayesub1" >Everything you need to build a functional project for all your subjects</p><br>
<p id="ayenoofsub" align="center"></p>
<p id="ayenoofsubtext" align="center">3 subjects</p>


<p id="ayesem1box"></p>
<p id="ayesem1">Semester 5</p>
<p id="ayesem2box"></p>
<p id="ayesem2">Semester 6</p>

                <a href="subject.php?subject=IP&year=TE" id="dbms"><li>Internet Programming</li></a>
                <a href="subject.php?subject=IOT&year=TE" id="iot"><li>Internet of Things(IoT)</li></a>
<a href="subject.php?subject=WN&year=TE" id="py"><li>Wireless Networks</li></a>


<img src="images/svte.svg" id="svg">

<footer>

    </footer>
</body>
</html>
