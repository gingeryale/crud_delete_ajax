<?php

require 'db.php';

$parsed_url = $_SERVER['REQUEST_URI'];
$path = parse_url($parsed_url, PHP_URL_PATH);
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <header class="navbar navbar-expand-lg bd-navbar sticky-top">
   
   
<nav class="container-xxl bd-gutter flex-wrap flex-lg-nowrap">
        <ul class="list-inline d-flex w-100 justify-content-between p-3 bd-blue-900">
           
        <li class='list-inline-item'><a href="./">Home</a></li>
        <li class='list-inline-item'><a href="./products.php">Products</a></li>
                <?php if(isset($_SESSION["userid"])){
                     echo "<li class='list-inline-item'><a href='./create.php'>Create</a></li>";
                     echo " ";
                     echo "<li class='list-inline-item'><a href='./profile.php'>Profile</a></li>";
                     echo " ";
                     echo "<span class='d-flex ms-auto'>";
                     echo "<li class='list-inline-item'><h2 class='d-inline-flex mb-3 px-2 py-1 fw-semibold text-success-emphasis bg-success-subtle border border-success-subtle rounded-2'>hello ".$_SESSION['userfname']."</h2></li>";
                     echo " ";
                     echo "<li class='list-inline-item'><a href='./logout.php'>Logout</a></li>";
                      echo "</span>";
                    
                }
                if(!isset($_SESSION["userid"])){
                    echo "<span class='d-flex ms-auto'>";
                    echo "<li class='list-inline-item'>User Space: <a href='./register.php'>Register</a></li>";
                    echo "&nbsp;";
                    echo "<li class='list-inline-item'><a href='./login.php'>Login</a></li>";
                    echo "</span>";
                }
                ?>
            
        </ul>
    </nav>
</header>

    <div class="container">
    <h1><?= $path?></h1>
   
    