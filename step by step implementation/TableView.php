<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Step-by-Step</title>

  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="sweetalert/sweetalert2.min.css">
  <link rel="stylesheet" href="datatables/datatables.min.css">

  <script defer="true" src="./js/jquery.min.js"></script>

  <script defer="true" src="./TableView.js" type="module"></script>
</head>
<body>
  <?php
    include "<crud_operations/generate_table_contents.php";

    $tableName = "employees"; 
    generate_table($tableName); 
  
  ?>
  
  <!-- DISPLAY TABLE  -->
  <!-- div.container>div[class="card mt-3"]>div.card-header>h5{Employee Table} -->
  <div class="container-fluid">
    <div class="card mt-3">
      <div class="card-header">
        <h5> <?php echo $tableName; ?> </h5>
      </div>
      <!-- div.card-body>a[href="3" class="btn btn-primary btn-sm" id="btnAdd" ]{+ Add employee} -->
      <div class="card-body container-fluid">
        <a href="#" class="btn btn-primary btn-sm" id="btnAdd">+ Add employee</a>
        <!-- table[id="table1" class="table table-bordered"]>thead>tr>th{Employee}+th{Name}+th{Email}+th -->
        <table id="table1" class="table table-bordered">

          <thead>
            <?php echo $currentTableGenerated["header"]; ?>
          </thead>
          <tbody>
            <?php echo $currentTableGenerated["body"]; ?>
          </tbody>
          <div>
          <!-- tbody>td{ID Data}+td{Name Data}+td{Email Data}+td -->
          <!-- 
            <tr>
              <td>ID Data</td>
              <td>Name Data</td>
              <td>Email Data</td>
              <td> -->
                <!-- a[href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm"]{EDIT} -->
                <!-- <a 
                  href="#" 
                  id="btnEdit" 
                  data-id="to be filled" 
                  data-first_name="to be filled" 
                  data-last_name="to be filled" 
                  data-email="to be filled" 
                  class="btn btn-warning btn-sm">
                  EDIT
                </a> -->
                <!-- a[class="btn btn-danger btn-sm" href="#" id="btnDelete" data-id="to be filled"] -->
                <!-- <a href="#" class="btn btn-danger btn-sm" id="btnDelete" data-id="to be filled">
                  DELETE
                </a>
              </td>
            </tr> -->

            <!-- SAMPLE -->
            <!-- (tr>td{ID Data $$}+td{Name Data $$}+td{Email Data $$}+td>a[href="#" id="btnEdit" data-id="to be filled" data-first_name="to be filled" data-last_name="to be filled" data-email="to be filled" class="btn btn-warning btn-sm"]{EDIT}+a[class="btn btn-danger btn-sm" href="#" id="btnDelete" data-id="to be filled"]{DELETE})*10 -->
          </div>     
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
        <div class="modal-body" id="container-for-input-label" >
          <!-- label[for="txtFname"]{First Name:}+input[type="text"  id="txtFname" class="form-control"]+label[for="txtLname"]{Last Name:}+input[type="text" id="txtLname" class="form-control"]+label[for="txtEmail"]{Email Address:}+input[type="text" id="txtEmail" class="form-control"] -->          
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
          <h4 class="modal-title" id="edit-modal-table-title">EDIT EMPLOYEE</h4>
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
</body>
</html>