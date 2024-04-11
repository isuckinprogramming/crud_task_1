<?php
require_once('dbOperations.php');
require_once('response.php');

$conn = getHRDBConnection();

if( !$_SERVER['REQUEST_METHOD'] == 'POST' ) {
  return;
}

$sqlQuery = "DELETE FROM " . $_POST['table_name'] . " WHERE " . $_POST['delete_column'] . "='".$_POST['delete_column_value']."';";


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

// Yeahh there should be validation here before deleting an entry

