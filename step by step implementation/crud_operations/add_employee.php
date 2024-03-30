<?php
require_once('dbOperations.php');
require_once('response.php');

$conn = getHRDBConnection();


function addEmployee() {

  global $conn;
  session_start();

  $response = new Response();

  $fname = mysqli_real_escape_string($conn,$_POST['fname']);
  if($fname===""){
    $response->isFNameValid = true;
    $response->errorMessage .= "The FName is blank. Blank string is invalid\n";
  }
  $lname = mysqli_real_escape_string($conn,$_POST['lname']);
  if($lname===""){
    $response->isLNameValid = true;
    $response->errorMessage .= "The LName is blank. Blank string is invalid\n";
  }

  $email = mysqli_real_escape_string($conn,$_POST['email']);
  if($email===""){
    $response->isEmailValid = true;
    $response->errorMessage .= "The Email is blank. Blank string is invalid\n";
  }

  if($response->isAnyFieldInvalid()){
    // terminate function 
    return;    
  }
  $sql = "INSERT INTO employees(first_name,last_name,email) VALUES('$fname','$lname','$email')";
  $response->status = $conn->query($sql)? "success":"error";
  echo json_encode($response);
}
