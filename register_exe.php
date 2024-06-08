<?php

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['submit']) ){
   
    require 'functions.php';

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $email = $_POST['uemail'];
    $role = 1;
    $pwd = $_POST['pwd'];

    if(emptyField($fname,$lname,$email,$pwd) !== false){
        header("location: register.php?error=emptyinput");
        exit();
    }

    if(invalidEmail($email) !== false){
        header("location: register.php?error=invalidemail");
        exit();
    }

    if(userExists($dbc, $email) !== false){
        header("location: register.php?error=emailexists");
        exit();
    }

    createUser($dbc, $fname,$lname,$email,$pwd);

} else{
    header("Location: register.php");
}