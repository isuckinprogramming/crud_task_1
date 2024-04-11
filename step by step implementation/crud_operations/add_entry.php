<?php
require_once('dbOperations.php');
require_once('response.php');

$conn = getHRDBConnection();

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
  $regPattern = '/,(?=[^,]*$)/';
  
  $columns = preg_replace( $regPattern, "", $columns);
  $values = preg_replace( $regPattern, "",$values);

  

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

// I think I should put the validations here before adding an entry
// Like I can skip the log-in process then proceed to add_entry
// aside from creating an add entry, content and user validation should be important 