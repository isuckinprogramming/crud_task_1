import './bootstrap/js/bootstrap.bundle.min.js';
import './sweetalert/sweetalert2.all.min.js';
import './datatables/datatables.min.js';
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

function createFormLabelAndInput(names, generationNumber, type = "text"){
  return`<label for="input-${name}" id="lbl-input-${name}">${name}</label> <br>
  <input name="input-${name}" type="${type}" id="input-${name}" class="form-control"> <br>`;
}

function generateLabelAndInput(){

  const columnNames = [
    "employee_id",
    "first_name",
    "last_name",
    "email_acc",
    "password",
    "hire_date",
    "phone_number",
    "job_id",
    "commision_pct",
    "manager_id",
    "department_id"
  ];

  const allHTMLOutput = columnNames.reduce(
      ( acc, curr, index) =>{
          acc += createFormLabelAndInput(curr, index);
          return acc;
      }, 
      ""
  );

  return allHTMLOutput;
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
  'click',
  '#btnSave', 
  () =>{ addEmployee();}
);

// HTML MODIFICATIONS 
$('#container-for-input-label').html( generateLabelAndInput());