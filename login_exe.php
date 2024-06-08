<?php

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $username= $_POST['uemail'];
    $password=$_POST['upassword'];
    
    require_once 'db.php';
    require_once 'functions.php';

    if(emptyFieldLogin($username,$password) !== false){
        header("location: login.php?error=emptyinput");
        exit();
    }

    loginUser($dbc,$username,$password);

} else {
    header("Location: login.php");
    exit();
}