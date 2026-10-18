<?php

$url = "localhost";
$password="";
$username="mindflow";
$database = "my_mindflow";
$conn= new mysqli($url,$username,$password,$database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>
