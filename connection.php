<?php

// Open Connection 
$hostname = "localhost";
$username = "root";
$password = "";
$database = "login_sys";
$port = 3306;

$conn = mysqli_connect($hostname,$username,$password,$database,$port);

// Check connection 
if (!$conn){
   die("connection Faild:" . mysqli_connect_error());
}
//echo "Connected successfully";