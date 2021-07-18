<?php 

$server = '127.0.0.1:3307 ';
$user = 'root';
$password = 'root';
$db_name = 'test';

$link = mysqli_connect($server, $user, $password, $db_name) or die(mysqli_error($link));
mysqli_query($link, "SET NAMES 'utf8");



?>