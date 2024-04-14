<?php
require_once('dbOperations.php');
require_once('response.php');

$conn = getHRDBConnection();

function addEntry() 
{
  if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
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

  $tableName = DataBaseOperations::convert_to_mysqli_safe_string($_POST['table_name']);
  $columns = DataBaseOperations::convert_to_mysqli_safe_string( $columns);
  $values = DataBaseOperations::convert_to_mysqli_safe_string( $values);

  $sqlQuery = sprintf($mysql_insert_template, $tableName, $columns, $values);
  $result = DataBaseOperations::execute_and_return_error_msg($sqlQuery);

  $response = ($result['status']) ?
  [
    "status" => "success"
  ] :
  [
    "errorMessage" => "Error Number: " . $result['errorNo'] . '\n' . $result['errorMessage'] . '\n' . $result['mysqlQuery'],
    "status" => "error"
  ];
  
  echo json_encode($response);
}

$addEntryConditions = $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['operation']) && $_POST['operation'] === "add_entry";
if ($addEntryConditions) {
  addEntry();
}

// I think I should put the validations here before adding an entry
// Like I can skip the log-in process then proceed to add_entry
// aside from creating an add entry, content and user validation should be important 