<?php
function generate_select_all_query($table_name, $value_column, $display_column){
  return "SELECT $value_column AS value_column, $display_column AS display_column FROM $table_name;";
}

$every_employees_entry = generate_select_all_query("employees", "employee_id", "CONCAT(first_name,' ', last_name)");
$every_regions_entry = generate_select_all_query("regions", "region_id","region_name");
$every_departments_entry = generate_select_all_query("departments", "department_id","department_name");

$table_with_foreign_data = [
  "locations" => [
    "country_id" => generate_select_all_query("countries", "country_id", "CONCAT( country_name,' : ', country_id)") 
    ],
  "countries" => [
    "region_id" => $every_regions_entry
  ],
  "employees" => [
    "manager_id" => $every_employees_entry,
    "department_id" => $every_departments_entry
  ],
  "job_history" => [
    "job_id" => generate_select_all_query("jobs","job_id","job_title" ),
    "manager_id" => $every_employees_entry,
    "employee_id" => $every_employees_entry,
    "department_id" => $every_departments_entry
  ],
  "departments" => [
    "manager_id" => $every_employees_entry,
    "location_id" => generate_select_all_query("locations", "location_id"," CONCAT( country_id,', ', state_province,', ', city,', ', street_address )")
  ]
];

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

$_SESSION['table_with_foreign_data'] = $table_with_foreign_data;


