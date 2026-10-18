<?php

$url = "localhost";
$password="";
$username="partener4i";
$database = "my_partener4i";
$conn= new mysqli($url,$username,$password,$database);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

?>