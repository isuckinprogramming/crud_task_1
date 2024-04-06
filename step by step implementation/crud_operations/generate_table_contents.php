<?php
include_once "dbOperations.php";

$tableObject = [];

function generate_body_content($table_data_raw) {
  
  if(session_status() == PHP_SESSION_NONE)  {
    session_start();
  }

  $table_row_template = "<tr>
            <td>
              <a 
                href=\"#\" 
                data-id=\"to be filled\" 
                data-first_name=\"to be filled\" 
                data-last_name=\"to be filled\" 
                data-email=\"to be filled\" 
                class=\"btn btn-warning btn-sm btnEdit\">
                EDIT
              </a>
              <a href=\"#\" class=\"btn btn-danger btn-sm\" id=\"btnDelete\" data-id=\"to be filled\">
                DELETE
              </a>
            </td>
            %s
          </tr>";
  $table_data_template = "<td>%s</td>\n";

  $table_Body_HTML = "";
  $row_table_data = "";
  
  while ($row = $table_data_raw->fetch_row()) { 

    foreach($row as $table_data){
      $row_table_data .= sprintf($table_data_template, $table_data);
    }

    $table_Body_HTML .= sprintf($table_row_template, $row_table_data);
    $row_table_data = "";
  
  }

  return $table_Body_HTML;
}

function generate_column_headers($column_headers) {
  
  if(session_status() == PHP_SESSION_NONE)  {
    session_start();
  }

  $header_row_template= "\n<tr>
    <th>\n
    </th>\n
    %s
  </tr>\n";

  $header_data_template = "    
    <th>\n
      %s\n
    </th>\n";

  $allColumnHeaders = "";
  $headers = [];
  foreach ($column_headers as $header) {
    $allColumnHeaders .= sprintf($header_data_template, $header->name);
    $headers[] = $header->name;
  }

  return sprintf($header_row_template, $allColumnHeaders);
}

function generate_table($tableName){

  if ($tableName === "") { return; }
  
  $conn = getHRDBConnection();
  $tableName = mysqli_real_escape_string($conn, $tableName);

  if ($tableName == "") { return; }

  $sql = "SELECT * FROM $tableName;";
  $result = executeQueryHandleError($conn, $sql);

  if (!$result["status"]) {
    // Debugging purposes only to display the error msgs
    echo $result;
    return;
  }
  $column_headers = $result["result"]->fetch_fields();

  $headerHTML = generate_column_headers($column_headers);

  $bodyHTML = generate_body_content($result["result"]);

  global $tableObject;
  $tableObject = [ "header" => $headerHTML, "body" => $bodyHTML];
}

