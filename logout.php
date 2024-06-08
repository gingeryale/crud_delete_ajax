<?php

session_start();
session_unset();
sesson_destroy();

header("location: index.php");
exit();