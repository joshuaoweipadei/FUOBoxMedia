<?php
/* Database connection settings */
$ServerName = 'localhost';
$username = 'root';
$password = 'oweipadei333coding';
$dbName = 'accounts';

$conn = mysqli_connect($ServerName, $username, $password, $dbName) or die(mysqli_error($conn));
