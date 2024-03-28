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

  <!-- div.container>div[class="card mt-3"]>div.card-header>h5{Employee Table} -->
  <div class="container">
    <div class="card mt-3">
      <div class="card-header">
        <h5>Employee Table</h5>
      </div>

      <!-- div.card-body>a[href="3" class="btn btn-primary btn-sm" id="btnAdd" ]{+ Add employee} -->
      <div class="card-body">
        <a href="3" class="btn btn-primary btn-sm" id="btnAdd">+ Add employee</a>
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
          </tbody>

          
        </table

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

</script>
</body>
</html>