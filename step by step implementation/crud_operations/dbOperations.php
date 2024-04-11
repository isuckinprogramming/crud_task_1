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

/**
 * The function will handle the error in case something goes wrong with the 
 * mysql query and makes debugging easier. No actual code is executed to handle 
 * the error just returning details about the error.
 * @param mysqli $conn
 * @param mixed $sql
 * @return array
 */
function executeQueryHandleError( mysqli $conn, $sql)  {
  
  $result = $conn->query($sql);
  return ($result) ? 
  [ 
    "status" => true,
    "result" => $result,
    "mysqlQuery" => $sql
  ]
   : 
  [
    "status" => false,
    "errorNo" => $conn->errno,
    "errorMessage" => $conn->error,
    "mysqlQuery" => $sql
  ];
}

// I think I should put the single database connection to be used for all the query