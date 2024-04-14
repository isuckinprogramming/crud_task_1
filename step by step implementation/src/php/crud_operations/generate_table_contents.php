<?php
include_once "dbOperations.php";
include_once("table_data.php");

function generate_add_entry_details($tableName) {

  if(session_status() == PHP_SESSION_NONE){
    session_start();
  }

  if (!isset($_SESSION['table_with_foreign_data'])) {
    // terminate function, might cause an error
    return;
  }


  $column_with_sqlquery = $_SESSION['table_with_foreign_data'][$tableName];

  $option_template = '<option value="%s">%s</option>';
  $response = [];

  foreach( $column_with_sqlquery as $key => $value ){

    $result = DataBaseOperations::execute_and_return_error_msg($value);
    
    if(!$result['status']){
      // terminate because of error in mysql query
      return;
    }

    $options_html_form = "";
    $row_entry = mysqli_fetch_assoc($result['result']); 
    
    while( $row_entry != null ){
      $options_html_form .= sprintf($option_template, $row_entry["value_column"],$row_entry["display_column"]);
      $row_entry = mysqli_fetch_assoc($result['result']); 
    }
    $response[$key] = $options_html_form; 
  }

  return $response;
}

function generate_body_content($table_data_raw, $primary_key_id) {
  $table_row_template = "<tr>
            <td>
              <button
                data-primary-key=\"$primary_key_id\"
                data-primary-value=\"%s\"
                class=\"btn btn-warning btn-sm btnEdit\"
                type=\"button\"
                >
                EDIT
              </button>
              <button 
                class=\"btn btn-danger btn-sm btnDelete\" 
                type=\"button\"
                data-primary-key=\"$primary_key_id\"
                data-primary-value=\"%s\"
                >
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

  if(session_status() == PHP_SESSION_NONE ){
    session_start();
  }
  
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
  $resultHeader = generate_column_headers($column_headers);
  $resultBody = generate_body_content($result["result"], $column_headers[0]->name);
  
  $columnOptionsForForeignData = 
  array_key_exists($tableName,$_SESSION['table_with_foreign_data']) && isset($_SESSION['table_with_foreign_data']) ? 
  generate_add_entry_details($tableName) :
  [""] ;

  return [
    "table_name" => $tableName,
    "table_header" => $resultHeader['head'], 
    "table_body" => $resultBody['body'],
    "table_column_headers" => $resultHeader['filtered_data'],
    "columns_options_for_foreign_data" => $columnOptionsForForeignData
  ];
}


if (isset($_POST['input-table-name']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
  $tableData = generate_table($_POST['input-table-name']);
  echo json_encode($tableData);
}



