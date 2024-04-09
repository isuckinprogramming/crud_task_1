import './../../bootstrap/js/bootstrap.bundle.min.js';
import './../../sweetalert/sweetalert2.all.min.js';
import './../../datatables/datatables.min.js';
// Jquery will be imported first by html file

$('#table1').DataTable();
let currentTableInView = {};

function showAlert(icon, title, content){
    Swal.fire({
      icon: icon,
      title: title,
      text: content,
      confirmButtonText: 'CONTINUE',
      allowEscapeKey: false,
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) { 
        if(icon=='success') 
        location.reload(true); //reload the page
      }
      }
    );
}

function createFormLabelAndInput(name, type = "text"){
  return`<label for="input-${name}" id="lbl-input-${name}">${name}</label> <br>
  <input name="input-${name}" type="${type}" id="input-${name}" class="form-control"> <br>`;
}

function generateLabelAndInput(columnHeaders){

  const allHTMLOutput = columnHeaders.reduce(
      ( acc, curr, index) =>{
          acc += createFormLabelAndInput(curr, index);
          return acc;
      }, 
      ""
  );

  return allHTMLOutput;
}
function generateAddEntryModal(columnHeaders, columnWithForeignData) { 
  
  let htmlContentOfModal = "";
  for (let column of columnHeaders) {

    if (columnWithForeignData.hasOwnProperty(column)) { 
      htmlContentOfModal += `<label for="input-${column}"> ${column}</label><br><select name="input-${column}" id="input-${column}">${columnWithForeignData[column]}</select><br>`;
    } else  {
      htmlContentOfModal += `<label for="input-${column}" id="lbl-input-${column}">${column}</label> <br>
      <input name="input-${column}" type="text" id="input-${column}" class="form-control"> <br>`;
    }
  }
  $('#container-for-input-label').html( htmlContentOfModal);
}

const generateTable = () => { 
  const tableName = $('#input-table-name').val();
  $.ajax(
    {
      type: "POST",
      url: "./../../crud_operations/generate_table_contents.php",
      data: {
        "input-table-name": tableName,
      },
      dataType: 'JSON',
      success: function (response) {
        
        console.log(response);

        $('#display-table-name').html(response.table_name);

        $('#display-table-head').html(response.table_header);
        $('#display-table-body').html(response.table_body);
        
        $('#display-table-entry-title').html(response.table_name);
        $('#btnAdd').text(" + ADD " + response.table_name);

        generateAddEntryModal(
          response.table_column_headers,
          response.columns_options_for_foreign_data
        );
      },
      error: function( xhr, status, error ){ 

        console.log("XHR: " + xhr, "STATUS: " + status, "ERROR : " + error);
      } 
    }
  );
}
const addEmployee = () => {
    const fname = $('#txtFname').val();
    const lname =  $('#txtLname').val();
    const email =  $('#txtEmail').val();

    let isThereError = false;
    let emptyErrorMsg = "Please enter ";
    //check if empty
    if(fname===""){
      isThereError = true;
      emptyErrorMsg += ' firstname ';
    }
    if(lname===""){
      isThereError = true;
      emptyErrorMsg += ', lastname ';
    }
    if(email===""){
      isThereError = true;
      emptyErrorMsg += ', email ';     
    }

    if(isThereError){
      showAlert('error','Empty Fields',emptyErrorMsg);
    }
    
    $.ajax( {
        type: "POST",
        url: "crud_operations/add_employee.php",
        data: {
          "fname": fname,
          "lname": lname,
          "email": email
        },
        dataType: 'JSON',
        success: function(response){
          const status = response.status;
          const error = response.errorMessage;
          if(status=="success")  showAlert('success','Success','Employee added!');
          if(status=="error")  showAlert('error','Error',error)
        }
      }
    );
}
// EVENTS
$(document).on(
  'click',
  '#btnAdd', 
  () => {
    $('#modalAdd').modal('show'); 
  } 
);

$(document).on(
  "click",
  "#submitChangeTable",
  () => { generateTable() }
);
$(document).on(
  'click',
  '#btnSave', 
  () =>{ addEmployee();}
);

// HTML MODIFICATIONS 
// $('#container-for-input-label').html( generateLabelAndInput());