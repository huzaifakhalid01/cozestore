<?php
session_start();
// session_unset();
$server = "mysql:host=localhost;dbname=9b";
$username = "root";
$password = "";
$pdo = new PDO($server,$username,$password);

?>