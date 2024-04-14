<?php
require_once('dbOperations.php');

$conn = getHRDBConnection();

if( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
  return;
}

$tableName = DataBaseOperations::convert_to_mysqli_safe_string($_POST['table_name']);
$deleteColumn = DataBaseOperations::convert_to_mysqli_safe_string($_POST['delete_column']);
$deleteColumnValue = DataBaseOperations::convert_to_mysqli_safe_string($_POST['delete_column_value']);


$sqlQuery = "DELETE FROM ". $tableName . " WHERE " . $deleteColumn . "='" . $deleteColumnValue ."';"; 
$result = DataBaseOperations::execute_and_return_error_msg($sqlQuery);

$response = ($result) ?
[
  "status" => "success"
] :
[
  "errorMessage" => "Error Number: " . $conn->connect_errno . '\n' . $conn->error . '\n' . $sqlQuery,
  "status" => "error"
];

echo json_encode($response);

// Yeahh there should be validation here before deleting an entry

