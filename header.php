<?php
require 'db.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <header class="d-flex justify-space-between">
    <h1><?= $_SERVER['REQUEST_URI']?></h1>
    <nav>
        <ul>
            <li>
            <a href="./">Home</a>
                <a href="./products.php">Products</a>
                <a href="./create.php">Create</a>
                <a href="./register.php">Register</a>
                <a href="./login.php">Login</a>
                <a href="./profile.php">Profile</a>
                <a href="./logout.php">Logout</a>
                <?php if(isset($_SESSION["userid"])){
                    echo "signed";
                }
                ?>
            </li>
        </ul>
    </nav>
</header>

    <div class="container">
   
   
    