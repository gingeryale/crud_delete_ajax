<?php

require 'db.php';

$url = $_SERVER['REQUEST_URI'];
$path = parse_url($url, PHP_URL_PATH);
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon.ico" type="image/ico">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <header class="navbar navbar-expand-lg bd-navbar sticky-top">
   
   
<nav class="navbar sticky-top navbar-dark bg-success-subtle container-xxl bd-gutter flex-wrap flex-lg-nowrap ps-2 pe-2">
        <ul class="list-inline d-flex w-100 justify-content-between align-items-center p-1 bd-blue-900">
           
        <li class='list-inline-item'><a href="./">Home</a></li>
        <li class='list-inline-item'><a href="./products.php">Products</a></li>
                <?php if(isset($_SESSION["userid"])){
                    $userId = htmlspecialchars($_SESSION["userid"]);
                    $result = mysqli_query($dbc, "SELECT * FROM users where u_id=$userId");
                    $row = mysqli_fetch_assoc($result);
                     echo "<li class='list-inline-item'><a href='./create.php'>Create</a></li>";
                     echo " ";
                     echo "<li class='list-inline-item'><a href='./profile.php'>Profile</a></li>";
                     echo " ";
                     echo "<span class='d-flex ms-auto'>";
                     echo "<li class='list-inline-item'><h3 class='d-inline-flex px-2 py-1 fw-semibold text-success-emphasis bg-light-subtle border border-success-subtle rounded-2'>Hi ".$_SESSION['userfname']."</h3>
                     <img src='uploads/".$row['u_pic']."' alt='profile pic' style='width:40px;height:40px;' class='rounded'/>";
                     
                     echo "</li>";
                     echo " ";
                     echo "<li class='list-inline-item'><a href='./logout.php'>Logout</a></li>";
                      echo "</span>";
                    
                }
                if(!isset($_SESSION["userid"])){
                    echo "<span class='d-flex ms-auto'>";
                    echo "<li class='list-inline-item'><a href='./register.php'>Register</a></li>";
                    echo "/&nbsp;";
                    echo "<li class='list-inline-item'><a href='./login.php'>Login</a></li>";
                    echo "</span>";
                }
                ?>
            
        </ul>
    </nav>
</header>

    <div class="container">
    <h1><?= $path?></h1>
   
    