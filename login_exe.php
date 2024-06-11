<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $email= $_POST['uemail'];
    $password=$_POST['pwd'];
    
    require_once 'db.php';
    require_once 'functions.php';

    if(emptyFieldLogin($email,$password) !== false){
        header("location: login.php?error=emptyinput");
        exit();
    }

    loginUser($dbc,$email,$password);

} else {
    header("Location: login.php");
    exit();
}