// import './../../bootstrap/js/bootstrap.bundle.min.js
import './../../../node_modules/bootstrap/dist/js/bootstrap.bundle.js';

import './../../../node_modules/datatables.net/js/dataTables.min.js';


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
      if (icon == 'success') {
      
        //  originally the page would be reloaded but it would
        //  create quite a problem if it did the page
        // location.reload(true); 
      }
    }
  });
}


const deleteEntryPhpActionLink = './../php/crud_operations/delete_entry.php';
const addEntryPhpActionLink = './../php/crud_operations/add_entry.php';
const updateEntryActionLink = './../php/crud_operations/update_entry.php';
const generateTableActionLink = './../php/crud_operations/generate_table_contents.php';

function retrieveKeyValueDataFromInputs(idOfContainer,classOfInput,prefixOfInputId = "input-" ) { 
  const allInputChildren = document.getElementById(idOfContainer).querySelectorAll("." + classOfInput);

  const returnData = {
    data: {},
    isThereEmptyFields: false,
    emptyColumns: "",
    numberOfEmptyColumns : 0
  }

  for (let child of allInputChildren) {
    
    let key = child.getAttribute('id').replace(prefixOfInputId, "");
    if (child.value === "") { 
      
      returnData.isThereEmptyFields = true;
      returnData.numberOfEmptyColumns += 1;

      returnData.emptyColumns += `${key},`;
      
      continue;
    } 

    returnData.data[key] = child.value;
  };

  return returnData;
}


function generateAddEntryModal(columnHeaders, columnWithForeignData) { 
  
  let htmlContentOfModal = "";
  let htmlContentOdEditModal = "";

  for (let column of columnHeaders) {

    if (columnWithForeignData.hasOwnProperty(column)) { 
      htmlContentOfModal += `<label for="input-${column}"> ${column}</label><br><select class="table-entry-input" name="input-${column}" id="input-${column} ">${columnWithForeignData[column]}</select><br>`;
      htmlContentOdEditModal += `<label for="edit-${column}"> ${column}</label><br><select class="table-edit-input" name="edit-${column}" id="edit-${column} ">${columnWithForeignData[column]}</select><br>`;
    } else {
      htmlContentOfModal += `<label for="input-${column}" id="lbl-input-${column}">${column}</label> <br>
      <input name="input-${column}" type="text" id="input-${column}" class="form-control table-entry-input"> <br>`;

      htmlContentOdEditModal += `<label for="edit-${column}" id="lbl-edit-${column}">${column}</label> <br>
      <input name="edit-${column}" type="text" id="edit-${column}" class="form-control table-edit-input"> <br>`;
    }
  }
  $('#container-for-input-label').html(htmlContentOfModal);
  // document.getElementById("edit-input-container").html = document.getElementById('container-for-input-label').html;

  $('#edit-input-container').html(htmlContentOdEditModal);
  
}

const generateTable = () => { 
  const tableName = $('#input-table-name').val();
  $.ajax(
    {
      type: "POST",
      url: generateTableActionLink,
      data: {
        "input-table-name": tableName,
      },
      dataType: 'JSON',
      success: function (response) {
        
        // console.log(response);

        $('#display-table-name').html(response.table_name);

        $('#display-table-head').html(response.table_header);
        $('#display-table-body').html(response.table_body);
        
        $('#display-table-entry-title').html(response.table_name);
        $('#btnAdd').text(" + ADD " + response.table_name);

        generateAddEntryModal(
          response.table_column_headers,
          response.columns_options_for_foreign_data
        );
        
        // $('#edit-input-container').html($("#container-for-input-label").html())


        $('#table1').DataTable();
      },
      error: function( xhr, status, error ){ 

        console.log("XHR: " + xhr, "STATUS: " + status, "ERROR : " + error);
      } 
    }
  );


}

function updateEntry(updateId, updateValue) { 


  const dataFromInputs = retrieveKeyValueDataFromInputs("edit-input-container","table-edit-input","edit-")

  if (dataFromInputs.isThereEmptyFields) {
    displayErrorMessageForEmptyInputs(dataFromInputs.emptyColumns, dataFromInputs.numberOfEmptyColumns);
    return;
  }

  const tableName = $('#display-table-name').text();

  const post_data = {
    table_name: tableName,
    data: dataFromInputs.data,
    update_column: updateId,
    update_column_value: updateValue
  };

  $.ajax({
    type: "POST",
    url: updateEntryActionLink,
    data: post_data,
    dataType: 'JSON',
    success: function(response){
      
      const status = response.status;
      const error = response.errorMessage;
      
      if (status == "success") showAlert('success', 'Success', 'Entry UPDATED!');
      if(status=="error")  showAlert('error','Error',error)
    }
  });
}

function displayErrorMessageForEmptyInputs( emptyColumnsString, numberOfEmptyColumns ) { 
  
  let errorMessage = emptyColumnsString;
  const endPattern = /,$/;
  let replacement = "";
  
  if (numberOfEmptyColumns > 2) {
    errorMessage = errorMessage.replace(endPattern, "");
    replacement = ", and ";
  } else if (numberOfEmptyColumns === 2) {
    replacement = " and ";
  } else if (numberOfEmptyColumns === 1) { 
    replacement = "";
  } 

  errorMessage = errorMessage.replace(endPattern, replacement);
  showAlert('error', 'Empty Fields', `The columns ${errorMessage} are empty.\nPlease fill them to properly add an entry.`);
}

function addEntry() {

  const dataFromInputs = retrieveKeyValueDataFromInputs("container-for-input-label","table-entry-input")

  if (dataFromInputs.isThereEmptyFields) {
    displayErrorMessageForEmptyInputs(dataFromInputs.emptyColumns, dataFromInputs.numberOfEmptyColumns);
    return;
  }

  const tableName = $('#display-table-name').text();

  const post_data = {
    table_name: tableName,
    data: dataFromInputs.data
  };

  $.ajax({
    type: "POST",
    url: addEntryPhpActionLink,
    data: {
      post_data: post_data,
    operation: "add_entry"},
    dataType: 'JSON',
    success: function(response){
      const status = response.status;
      const error = response.errorMessage;
      if(status=="success")  showAlert('success','Success','Entry added!');
      if(status=="error")  showAlert('error','Error',error)
    }
  });
}

function deleteEntry(key, value) { 

  const tableName = $('#display-table-name').text();

  const post_data = {
    table_name: tableName,
    delete_column: key,
    delete_column_value: value
  };

  $.ajax({
    type: "POST",
    url: deleteEntryPhpActionLink,
    data: post_data,
    dataType: 'JSON',
    success: function(response){
      const status = response.status;
      const error = response.errorMessage;
      if(status=="success")  showAlert('success','Success','Entry DELETED!');
      if(status=="error")  showAlert('error','Error',error)
    }
  });
}
// EVENTS

$(document).on(
  "click",
  "#submitChangeTable",
  () => { generateTable() }
);
$(document).on(
  'click',
  '#btnAdd', 
  () => {
    $('#modalAdd').modal('show'); 
  } 
);

// CRUD TRIGGERS
var currentEntryActionKey = "";
var currentEntryActionValue = "";
$(document).on(
  'click',
  '.btnEdit', 
  function () { 

    // console.log(this);
    currentEntryActionKey = this.getAttribute("data-primary-key");
    currentEntryActionValue = this.getAttribute("data-primary-value");
    $('#modalEdit').modal('show'); 

  }
);
$(document).on(
  'click',
  '.btnDelete',
  function () { 
    deleteEntry(
      this.getAttribute("data-primary-key"),
      this.getAttribute("data-primary-value")
    );
  }
)
$(document).on(
  "click",
  "#btnUpdate",
  function () { updateEntry(currentEntryActionKey, currentEntryActionValue); }
);
$(document).on(
  'click',
  '#btnSave', 
  () =>{ addEntry();}
);
