<?php
require_once('dbOperations.php');
require_once('response.php');

$conn = getHRDBConnection();

function addEmployee() {

  global $conn;
  session_start();

  $response = new Response();

  $fname = mysqli_real_escape_string($conn,$_POST['lname']);
  $response->setValidity('fName', !($fname == "") );

  $lname = mysqli_real_escape_string($conn,$_POST['fname']);
  $response->setValidity('lName', !($lname == ""));

  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $response->setValidity('email', !($email == ""));

  if($response->isAnyFieldInvalid()){ return; }

  $sql = "INSERT INTO employees(first_name,last_name,email) VALUES('$fname','$lname','$email');";
  $result = $conn->query($sql);

  // Debugging purposes
  if (!$result) {
    $response->errorMessage .= $conn->connect_errno . '\n' . $conn->error . '\n' .$sql;  
    $response->status = "error";
  }
  $response->status = "success";
  
  echo json_encode($response);
}

addEmployee();
