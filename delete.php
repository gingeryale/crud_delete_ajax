<?php

require 'db.php';

if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["id"])){
    
    $param_id = htmlspecialchars($_POST["id"]);

    $prepare = mysqli_prepare($dbc, "DELETE FROM products WHERE p_id=?");

    mysqli_stmt_bind_param($prepare, 'i', $param_id);


    mysqli_stmt_execute($prepare);

    header("Location: products.php");
}
