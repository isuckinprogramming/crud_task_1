<?php
include_once "dbOperations.php";

$currentTableGenerated = [
  "header" => "",
  "body" => ""
];

function generate_body_content($table_data_raw) {


  $table_row_template = "<tr>
            <td>
              <button
                data-primary-key=\"%s\"
                class=\"btn btn-warning btn-sm btnEdit\"
                type=\"button\">
                EDIT
              </button>
              <button 
                class=\"btn btn-danger btn-sm btnDelete\" 
                type=\"button\"
                data-primary-key=\"%s\">
                DELETE
              </button>
            </td>
            %s
          </tr>";
  $table_data_template = "<td>%s</td>\n";

  $table_Body_HTML = "";
  $row_table_data = "";

  $filtered_row_data = [];
  $all_filtered_row_data = [];
  while ($row = $table_data_raw->fetch_row()) { 

    foreach($row as $table_data){
      $row_table_data .= sprintf($table_data_template, $table_data);
      $filtered_row_data[] = $table_data;
    }

    $table_Body_HTML .= sprintf($table_row_template, $row[0],$row[0], $row_table_data);
    $all_filtered_row_data[$row[0]] = $filtered_row_data; 

    $row_table_data = "";
    $filtered_row_data = [];
  }

  return [
    'body'=>$table_Body_HTML,
    'filtered_data'=>$all_filtered_row_data
  ];
}
function generate_column_headers($column_headers) {
  
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
  $all_header_names = [];  
  $i = 0;

  foreach ($column_headers as $header) {
    $name = $header->name;
    $allColumnHeaders .= sprintf($header_data_template, $name);
    $all_header_names[$i] = $name;
    $i += 1;
  }

  return [
    'head' => sprintf($header_row_template, $allColumnHeaders),
    'filtered_data' => $all_header_names
  ];
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

  global $currentTableGenerated;
  
  if(session_status() == PHP_SESSION_NONE ){
    session_start();
  }

  $resultHeader = generate_column_headers($column_headers);
  $_SESSION['filtered_header_data'] = $resultHeader['filtered_data'];
  $currentTableGenerated['header'] = $resultHeader['head'];

  $resultBody = generate_body_content($result["result"]);
  $_SESSION['filtered_body_data'] = $resultBody['filtered_data'];
  $currentTableGenerated['body'] = $resultBody['body'];
}

generate_table("employees");

