<?php
include './../../crud_operations/dbOperations.php';

function log_in_trial() {

  $user_email = DataBaseOperations::convert_to_mysqli_safe_string($_POST['user_email']);
  $user_password = DataBaseOperations::convert_to_mysqli_safe_string($_POST['user_password']);

  $sql = "SELECT count(password) AS check_result FROM employees WHERE email LIKE '$user_email' AND password LIKE '$user_password';";

  $query_result = DataBaseOperations::execute_and_return_error_msg($sql);

  if (!$query_result["status"]) {
    // Query failed, must add an error message to be returned to the user
    return;
  }

  if(!$query_result["result"]) {
    // Case where result is empty
    return;
  }

  
  $is_user_inside_database = mysqli_fetch_assoc($query_result["result"]);
  $is_user_valid = $is_user_inside_database["check_result"] == 1 && $is_user_inside_database != false;
  
  if ($is_user_valid) {
  
    $_SESSION["is_login_verified"] = true;
    
    // Using an absolute reference is kind of shit. Causes a lot of problems 
    $response = [ 
      "login_status" => $_SESSION["is_login_verified"],
      
      // Should be changed, an absolute link should not be used for page navigation.
      // "next_page" => "http://localhost/it26l/lim/crud_task_1/step%20by%20step%20implementation/src/html/TableView.html"
    ];

    echo json_encode($response);
  } else {
  
    $_SESSION["is_login_verified"] = false;
    $response = json_encode($_SESSION["is_login_verified"]);
    echo $response;
  }
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  log_in_trial();
}
