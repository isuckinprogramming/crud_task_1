<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Step-by-Step</title>

  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="sweetalert/sweetalert2.min.css">
  <link rel="stylesheet" href="datatables/datatables.min.css">
</head>
<body>
  <!-- DISPLAY TABLE  -->
  <!-- div.container>div[class="card mt-3"]>div.card-header>h5{Employee Table} -->
  <div class="container">
    <div class="card mt-3">
      <div class="card-header">
        <h5>Employee Table</h5>
      </div>

      <!-- div.card-body>a[href="3" class="btn btn-primary btn-sm" id="btnAdd" ]{+ Add employee} -->
      <div class="card-body">
        <a href="#" class="btn btn-primary btn-sm" id="btnAdd">+ Add employee</a>
        <!-- table[id="table1" class="table table-bordered"]>thead>tr>th{Employee}+th{Name}+th{Email}+th -->
        <table id="table1" class="table table-bordered">
          <thead>
            <tr>
              <th>Employee</th>
              <th>Name</th>
              <th>Email</th>
              <th></th>
            </tr>
          </thead>
          <!-- tbody>td{ID Data}+td{Name Data}+td{Email Data}+td -->
          <tbody>
            <tr>
              <td>ID Data</td>
              <td>Name Data</td>
              <td>Email Data</td>
              <td>
                <!-- a[href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm"]{EDIT} -->
                <a 
                  href="#" 
                  id="btnEdit" 
                  data-id="to be filled" 
                  data-first_name="to be filled" 
                  data-last_name="to be filled" 
                  data-email="to be filled" 
                  class="btn btn-warning btn-sm">
                  EDIT
                </a>
                <!-- a[class="btn btn-danger btn-sm" href="#" id="btnDelete" data-id="to be filled"] -->
                <a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">
                  DELETE
                </a>
              </td>
            </tr>

            <!-- SAMPLE -->
            <!-- (tr>td{ID Data $$}+td{Name Data $$}+td{Email Data $$}+td>a[href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm"]{EDIT}+a[class="btn btn-danger btn-sm" href="#" id="btnDelete" data-id="to be filled"]{DELETE})*10 -->
            <tr>
              <td>ID Data 01</td>
              <td>Name Data 01</td>
              <td>Email Data 01</td>
              <td>
                <a href="#" id="btnEdit" 
                data-id="to be filled" data-first_name="to be filled" 
                data-last_name="to be filled" data-email="to be filled" 
                class="btn btn-warning btn-sm">EDIT</a>
                <a href="#" class="btn btn-danger btn-sm" 
                id="btnDelete" data-id="to be filled">
                DELETE
                </a>
              </td>
            </tr>
            <tr>
              <td>ID Data 02</td>
              <td>Name Data 02</td>
              <td>Email Data 02</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 03</td>
              <td>Name Data 03</td>
              <td>Email Data 03</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 04</td>
              <td>Name Data 04</td>
              <td>Email Data 04</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 05</td>
              <td>Name Data 05</td>
              <td>Email Data 05</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 06</td>
              <td>Name Data 06</td>
              <td>Email Data 06</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 07</td>
              <td>Name Data 07</td>
              <td>Email Data 07</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 08</td>
              <td>Name Data 08</td>
              <td>Email Data 08</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 09</td>
              <td>Name Data 09</td>
              <td>Email Data 09</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 10</td>
              <td>Name Data 10</td>
              <td>Email Data 10</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 11</td>
              <td>Name Data 11</td>
              <td>Email Data 11</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 12</td>
              <td>Name Data 12</td>
              <td>Email Data 12</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 13</td>
              <td>Name Data 13</td>
              <td>Email Data 13</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 14</td>
              <td>Name Data 14</td>
              <td>Email Data 14</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 15</td>
              <td>Name Data 15</td>
              <td>Email Data 15</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 16</td>
              <td>Name Data 16</td>
              <td>Email Data 16</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 17</td>
              <td>Name Data 17</td>
              <td>Email Data 17</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 18</td>
              <td>Name Data 18</td>
              <td>Email Data 18</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 19</td>
              <td>Name Data 19</td>
              <td>Email Data 19</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 20</td>
              <td>Name Data 20</td>
              <td>Email Data 20</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 21</td>
              <td>Name Data 21</td>
              <td>Email Data 21</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 22</td>
              <td>Name Data 22</td>
              <td>Email Data 22</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 23</td>
              <td>Name Data 23</td>
              <td>Email Data 23</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 24</td>
              <td>Name Data 24</td>
              <td>Email Data 24</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 25</td>
              <td>Name Data 25</td>
              <td>Email Data 25</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 26</td>
              <td>Name Data 26</td>
              <td>Email Data 26</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 27</td>
              <td>Name Data 27</td>
              <td>Email Data 27</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 28</td>
              <td>Name Data 28</td>
              <td>Email Data 28</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 29</td>
              <td>Name Data 29</td>
              <td>Email Data 29</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>
            <tr>
              <td>ID Data 30</td>
              <td>Name Data 30</td>
              <td>Email Data 30</td>
              <td><a href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm">EDIT</a><a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">DELETE</a></td>
            </tr>

          </tbody>
        </table
      </div>
    </div>
  </div>
  
  <!-- ADD MODAL -->
  <!-- div[class="modal fade" id="modalAdd"]>div[class="modal-dialog"]>div[class="modal-content"]>div[class="modal-header"]+div.modal-body+div.modal-footer -->
  <div class="modal fade" id="modalAdd">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <!-- H4.modal-title{ADD EMPLOYEE}+button[type="button" class="btn-close" data-bs-dismiss="modal"] -->
          <H4 class="modal-title">ADD EMPLOYEE</H4>
          <button type="button" class="btn-close" data-bs-dismiss="modal">  
          </button>
        </div>
        <div class="modal-body">
          <!-- label[for="txtFname"]{First Name:}+input[type="text"  id="txtFname" class="form-control"]+label[for="txtLname"]{Last Name:}+input[type="text" id="txtLname" class="form-control"]+label[for="txtEmail"]{Email Address:}+input[type="text" id="txtEmail" class="form-control"] -->
          <label for="txtFname">First Name:</label><input type="text" id="txtFname" class="form-control">
          
          <label for="txtLname">Last Name:</label><input type="text" id="txtLname" class="form-control">
          
          <label for="txtEmail">Email Address:</label><input type="text" id="txtEmail" class="form-control">
        </div>
        <div class="modal-footer">
          <!-- button[type="button" class="btn btn-danger" data-bs-dismiss="modal"]{CANCEL}+button[type="button" class="btn btn-success" id="btnSave"]{SAVE} -->
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCEL</button>
          <button type="button" class="btn btn-success" id="btnSave">SAVE</button>
        </div>
      </div>
    </div>
  </div>

  <!-- EDIT MODAL -->
  <!-- div[class="modal fade" id="modalEdit"]>div[class="modal-dialog"]>div[class="modal-content"]>div[class="modal-header"]+div.modal-body+div.modal-footer -->
  <div class="modal fade" id="modalEdit">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">EDIT EMPLOYEE</h4>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

        </div>
        <div class="modal-body">
          <!-- input[type="hidden"  id="e_emp_id" ]+label[for="e_txtFname"]{Enter firstname:}+input[type="text"  id="e_txtFname" class="form-control"] -->
          <input type="hidden" id="e_emp_id">
          
          <label for="e_txtFname">Enter firstname:</label>
          <input type="text" id="e_txtFname" class="form-control">

          <label for="e_txtLname">Last Name:</label>
          <input type="text" id="e_txtLname" class="form-control">

          <label for="e_txtEmail">Email Address:</label>
          <input type="text" id="e_txtEmail" class="form-control">
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">CANCEL</button>
          <button type="button" class="btn btn-success" id="btnUpdate">UPDATE</button>

        </div>
      </div>
    </div>
  </div>

<!-- import scripts -->
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="sweetalert/sweetalert2.all.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="datatables/datatables.min.js"></script>
  
<!-- event handling code -->
<script>

$('#table1').DataTable();

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
    });
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


$(document).on(
  'click',
  '#btnAdd', 
  () => { $('#modalAdd').modal('show'); } 
);

$(document).on(
  'click',
  '#btnSave', 
  () =>{ addEmployee();}
);

</script>

</body>
</html>