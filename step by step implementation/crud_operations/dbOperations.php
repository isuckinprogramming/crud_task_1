<?php
function getHRDBConnection() {
  // Create connection
  $conn = new mysqli("localhost","root", "", "hr1");

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  //echo "Database Connected successfully";
  return $conn;
}  