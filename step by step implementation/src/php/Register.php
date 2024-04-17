<?php

include_once ('./crud_operations/dbOperations.php');
include_once ('./crud_operations/table_data.php');

/**
 * Receive POST request from the client  
 * 
 * Retrieve data from the database about the related selection elements needing data for option values and display
 * 
 * package data to associative array
 * 
 * return data to the client as encoded json 
 * 
 * @return void
 */

function send_data_to_register_page()
{
  global $table_with_foreign_data;
  
  $employeesForeignDataSQL = $table_with_foreign_data['employees'];
  $responseData = [];  
  foreach($employeesForeignDataSQL as $foreignColumn => $mysqlQuery){

    $resultSetData = DataBaseOperations::execute_and_return_error_msg($mysqlQuery);
    $responseData[$foreignColumn] = package_result_set_to_array($resultSetData);
  }
  
  echo json_encode($responseData) ;
}

function package_result_set_to_array($resultSetdata)
{
  $data = mysqli_fetch_assoc($resultSetdata['result']);
  $responseArray = [];
  while ($data != null) {

    $responseArray[] = [ "display" => $data['display_column'],"value" => $data['value_column'] ];
    $data = mysqli_fetch_assoc($resultSetdata['result']);
  }

  return $responseArray;
}

if (isset($_POST['operation']) ) {

  if ($_POST['operation'] === "register_user") {

    include_once('./crud_operations/add_entry.php');
    
    $entryData = $_POST['register_user_data'];
    $entryData["employee_id"] = rand(1,10000);

    $response = addEntry( $entryData,$_POST['table_name']);

    echo json_encode($response);
  }
} else {
  send_data_to_register_page();
}