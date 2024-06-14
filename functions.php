<?php

require 'db.php';

function emptyField($fname,$lname,$email,$pwd){
    $result;
    if(empty($fname) || empty($lname) || empty($email) || empty($pwd)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function invalidUsername($fname){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $fname)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function invalidInput($field){
    $result;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $field)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function invalidEmail($email){
    $result;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}


function pwdMatch($pwd, $pwd2){
    $result;
    if($pwd !== $pwd2){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}


function userExists($dbc, $email){
    $sql = "SELECT * FROM users WHERE u_email = ?;";
    $prepare = mysqli_stmt_init($dbc);
   if(!mysqli_stmt_prepare($prepare, $sql)){
    header('location: register.php?error=failconnect');
    exit();
   }
   mysqli_stmt_bind_param($prepare, 's', $email);
   mysqli_stmt_execute($prepare);

   $resultData = mysqli_stmt_get_result($prepare);

   if($row = mysqli_fetch_assoc($resultData)){
   return $row;
  
   }else{
    $result = false;
    return $result;
   }
   mysqli_stmt_close($prepare);
}


function createUser($dbc, $fname,$lname,$email,$pwd){
    $urole=1;
    $sql = "INSERT INTO users(u_fname,u_lname,u_role,u_email,u_password)
    VALUES (?,?,?,?,?);";
    $prepare = mysqli_stmt_init($dbc);
   if(!mysqli_stmt_prepare($prepare, $sql)){
    header('location: register.php?error=failconnect');
    exit();
   }

   $hashedpwd=password_hash($pwd, PASSWORD_DEFAULT);

   mysqli_stmt_bind_param($prepare, 'ssiss', $fname,$lname,$urole,$email,$hashedpwd);
   mysqli_stmt_execute($prepare);

   mysqli_stmt_close($prepare);
   header('location: index.php?error=none');
   exit();
}


function editUser($dbc, $fname,$lname,$email,$pic,$pwd){
    $urole=1;
    $sql = "INSERT INTO users(u_fname,u_lname,u_role,u_email,u_password,u_pic)
    VALUES (?,?,?,?,?,?);";
    $prepare = mysqli_stmt_init($dbc);
   if(!mysqli_stmt_prepare($prepare, $sql)){
    header('location: register.php?error=failconnect');
    exit();
   }

   $hashedpwd=password_hash($pwd, PASSWORD_DEFAULT);

   mysqli_stmt_bind_param($prepare, 'ssisss', $fname,$lname,$urole,$email,$hashedpwd,$pic);
   mysqli_stmt_execute($prepare);

   mysqli_stmt_close($prepare);
   header('location: index.php?error=none');
   exit();
}



function emptyFieldLogin($username,$password) {
    $result;
    if(empty($username)|| empty($password)){
        $result = true;
    } else{
        $result = false;
    }
    return $result;
}

function loginUser($dbc, $email,$password){
    $user_exists = userExists($dbc, $email);

    if($user_exists === false){
        header("location: login.php?error=wronglogin");
        exit();
    }

    $pwdHashed = $user_exists['u_password'];

    $checkPwd = password_verify($password, $pwdHashed);

    if($checkPwd === false){
        header("location: login.php?error=loginbad");
        exit();
    }else if($checkPwd === true){
        session_start();
        $_SESSION['userid'] = $user_exists['u_id'];
        $_SESSION['userfname'] = $user_exists['u_fname'];
        $_SESSION['userpic'] = $user_exists['u_pic'];
        header("location: index.php");
        exit();
    }
}