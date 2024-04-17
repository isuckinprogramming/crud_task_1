<?php
include_once "dbOperations.php";
include_once("table_data.php");

function create_options_element($value,$display)
{
  $option_template = '<option value="%s">%s</option>';
  return sprintf( $option_template, $value, $display);
}
function generate_add_entry_details($tableName) 
{

  if(session_status() == PHP_SESSION_NONE){
    session_start();
  }

  if (!isset($_SESSION['table_with_foreign_data'])) {
    // terminate function, might cause an error, data about tables with foreign data must be available before function execution 
    return;
  }


  $column_with_sqlquery = $_SESSION['table_with_foreign_data'][$tableName];

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
      $options_html_form .= create_options_element($row_entry["value_column"],$row_entry["display_column"]);
      $row_entry = mysqli_fetch_assoc($result['result']); 
    }
    $response[$key] = $options_html_form; 
  }

  return $response;
}

function generate_table_row(string $primary_key_id, array $table_row_data, string $primary_value)
{
  $table_row_template = "<tr>
            <td>
              <button
                data-primary-key=\"$primary_key_id\"
                data-primary-value=\"%s\"
                class=\"btn btn-warning btn-sm btnEdit\"
                type=\"button\" >
                EDIT
              </button>
              <button 
                class=\"btn btn-danger btn-sm btnDelete\" 
                type=\"button\"
                data-primary-key=\"$primary_key_id\"
                data-primary-value=\"%s\" >
                DELETE
              </button>
            </td>
            %s
          </tr>";
  $table_data_template = "<td>%s</td>\n";

  $row_table_data_html = "";
  foreach($table_row_data as $table_data){
    $row_table_data_html .= sprintf($table_data_template, $table_data);
  }

  return sprintf($table_row_template,$primary_value,$primary_value ,$row_table_data_html );
}

function generate_body_content( mysqli_result $table_data_raw, string $primary_key_id) 
{

  $table_Body_HTML = "";
  while ($row = $table_data_raw->fetch_row()) { 
    $table_Body_HTML .= generate_table_row($primary_key_id, $row , $row[0] );
  }

  return [
    'body'=>$table_Body_HTML,
  ];
}


function generate_column_headers($column_headers)
{

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

function generate_table($tableName)
{

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
  $primary_key = $column_headers[0]->name;

  
  $resultHeader = generate_column_headers($column_headers);
  
  $resultBody = generate_body_content($result["result"], $primary_key);

  
  $is_foreign_data_necessary = array_key_exists($tableName, $_SESSION['table_with_foreign_data']);
  $columnOptionsForForeignData = $is_foreign_data_necessary ? generate_add_entry_details($tableName) : "";

  return [
    "table_name" => $tableName,
    "table_header" => $resultHeader['head'], 
    "table_body" => $resultBody['body'],
    "table_column_headers" => $resultHeader['filtered_data'],
    "columns_options_for_foreign_data" => $columnOptionsForForeignData
  ];
}


if (isset($_POST['input-table-name']) && $_SERVER['REQUEST_METHOD'] == 'POST') 
{
  $tableData = generate_table($_POST['input-table-name']);
    $response = json_encode($tableData);
  echo $response;
}



