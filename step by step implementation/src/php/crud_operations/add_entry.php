<?php
require_once('dbOperations.php');
require_once('response.php');

function addEntry( $add_entry_data, $table_name) 
{
  if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
    return;
  }

  $values = "";
  $columns = "";
  $template = "%s, ";

  $columnCount = 0;
  // $post_data = $_POST['post_data'];
  
  foreach ($add_entry_data as $key => $value) {
    $columnCount += 1;

    $columns .= sprintf($template, DataBaseOperations::convert_to_mysqli_safe_string($key));
    $values .= sprintf($template, "'". DataBaseOperations::convert_to_mysqli_safe_string($value) ."'" );
  }
  $regPattern = '/,(?=[^,]*$)/';
  
  $columns = preg_replace( $regPattern, "", $columns);
  $values = preg_replace( $regPattern, "",$values);

  
  $mysql_insert_template = " INSERT INTO %s ( %s ) VALUES ( %s ); ";

  $tableName = DataBaseOperations::convert_to_mysqli_safe_string($table_name);
  
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
  
  return $response;
}

$addEntryConditions = $_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['operation']) && $_POST['operation'] === "add_entry";
if ($addEntryConditions) {


  $tableName = $_POST['post_data']['table_name'];
  $entryData = $_POST['post_data']['data'];
  
  if ($tableName == "employees") {

    $entryData["employee_id"] = rand(1,10000);
  }

  $response = addEntry($entryData, $tableName );
  
  echo json_encode($response);
}

// I think I should put the validations here before adding an entry
// Like I can skip the log-in process then proceed to add_entry
// aside from creating an add entry, content and user validation should be important 