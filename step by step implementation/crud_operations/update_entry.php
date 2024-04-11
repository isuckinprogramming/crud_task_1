<?php
require_once('dbOperations.php');
require_once('response.php');

$conn = getHRDBConnection();

if( !$_SERVER['REQUEST_METHOD'] == 'POST' ) {
  return;
}


$update_values = "";

$columnCount = 0;
$data = $_POST['data'];

foreach ($data as $key => $value) {
  $update_values .= $key . "='". $value . "',";
}

$regPattern = '/,(?=[^,]*$)/';
$update_values = preg_replace( $regPattern, "",$update_values);


$sqlQuery = "UPDATE " . $_POST['table_name'] . " SET " . $update_values . " WHERE " . $_POST['update_column'] . "='".$_POST['update_column_value']."';";



// if (session_status() == PHP_SESSION_NONE) { session_start(); }

// if(!isset($_SESSION['hr_db_conn'])){
//   $_SESSION['hr_db_conn'] = getHRDBConnection();
// }
//   $_SESSION['hr_db_conn'] = getHRDBConnection();

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