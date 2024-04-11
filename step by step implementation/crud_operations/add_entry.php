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

// addEmployee();

function addEntry() 
{
  if( !$_SERVER['REQUEST_METHOD'] == 'POST' ) {
    return;
  }

  $values = "";
  $columns = "";
  $template = "%s, ";

  $columnCount = 0;
  $data = $_POST['data'];
  foreach ($data as $key => $value) {

    $columnCount += 1;

    $columns .= sprintf($template, $key);
    $values .= sprintf($template, "'". $value ."'" );
  }

  if( $columnCount == 1 || $columnCount > 2 ){
    $regPattern = '/,(?=[^,]*$)/';
    
    $columns = preg_replace( $regPattern, "", $columns);
    $values = preg_replace( $regPattern, "",$values);
  }
  

  $mysql_insert_template = " INSERT INTO %s ( %s ) VALUES ( %s ); ";
  $sqlQuery = sprintf($mysql_insert_template, $_POST['table_name'], $columns, $values);

  $conn = getHRDBConnection();
  $result = $conn->query($sqlQuery);

  $response = ($result) ?
  [
    "status" => "success"
  ] :
  [
    "errorMessage" => "Error Number: " . $conn->connect_errno . '\n' . $conn->error . '\n' . $sqlQuery,
    "status" => "error"
  ];
  
  echo json_encode($response);
}

addEntry();
