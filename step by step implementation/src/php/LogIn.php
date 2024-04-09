<?php
include './../../crud_operations/dbOperations.php';

function log_in_trial() {

  $conn = getHRDBConnection();
  $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
  $user_password = mysqli_real_escape_string($conn, $_POST['user_password']);

  $sql = "SELECT count(password) AS check_result FROM employees WHERE email LIKE '$user_email' AND password LIKE '$user_password';";

  $query_result = executeQueryHandleError($conn, $sql);


  if ($query_result["status"]) {

    if ($query_result["result"]) {

      $is_user_inside_database = mysqli_fetch_assoc($query_result["result"]);
      
      if ($is_user_inside_database["check_result"] == 1 && $is_user_inside_database != false) {
     
        $_SESSION["is_login_verified"] = true;
        
        $response = [ 
          "login_status" => $_SESSION["is_login_verified"],
          "next_page" => "http://localhost/it26l/lim/crud_task_1/step%20by%20step%20implementation/src/php/TableView.html"
        ];
        
        echo json_encode($response);

      } else {
     
        $_SESSION["is_login_verified"] = false;
        $response = json_encode($_SESSION["is_login_verified"]);
        
        echo $response;
      }
    }
  }

}

if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  log_in_trial();
}
