<?php
// Create connection
  $conn = mysqli_connect ( "localhost", "root", "", "empcon" );
  
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  //echo "Connected successfully";
  
?>