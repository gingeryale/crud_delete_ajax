<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$host = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'tutorial';

$dbc = mysqli_connect($host,$dbuser,$dbpass,$dbname);

if (!$dbc) {
    die('Could not connect: ' . mysql_error());
}
// echo 'Connected successfully';
// mysqli_close($dbc);
