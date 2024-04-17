

function registerUserData(table_name = 'employees') {

  const allInputs = document.getElementById("container-for-input-label").querySelectorAll(".table-entry-input");
  const allRegisterData = { }
  
  for (let dataInput of allInputs) { 
    const nameOfData = dataInput.getAttribute('id').replace("input-", "");
    const message = ` ${nameOfData} : ${dataInput.value} `;
    
    allRegisterData[nameOfData] = dataInput.value;
    console.log("Display Message " + message);
  }

  console.log(allRegisterData);

  $.ajax({
    method: 'POST',
    url: './../php/Register.php',
    data: { operation: "register_user", register_user_data : allRegisterData, table_name: table_name} ,
    dataType: 'JSON',
    success: function (response) { 
      
      console.log(response);
    }
  });

}

function retrieveNamesOfElementsWithForeignData() { 
  
  const allInputsSelection = document.getElementById("container-for-input-label").querySelectorAll(".foreign-data-selection");

  const columnsWithForeignData = [];
  
  for (let selectionInput of allInputsSelection) { 
    columnsWithForeignData.push( selectionInput.getAttribute('data-column-id') );
  }
  return columnsWithForeignData;
}

function createOptionsForSelection( arrayOfDataForOptions ) { 

  let allOptionsHTMLForm = '';

  for (let data of arrayOfDataForOptions) { 

    if (Array.isArray(data)) { 
      allOptionsHTMLForm += createOptionsForSelection( data )
    } else {
      let optionTemplate = `<option value="${data.value}">${data.display}</option>`;
      allOptionsHTMLForm += optionTemplate;
    }  
  }
  return allOptionsHTMLForm;
}

$.ajax({
  method: "POST",
  url: "./../php/Register.php",
  data: { column_names_with_foreign_data :retrieveNamesOfElementsWithForeignData()},
  dataType: "JSON",
  success: function (response) {
    
    console.log(response);
    
    document.getElementById("input-job_id").innerHTML = createOptionsForSelection(response.job_id);
    document.getElementById("input-department_id").innerHTML = createOptionsForSelection(response.department_id);
    document.getElementById("input-manager_id").innerHTML = createOptionsForSelection(response.manager_id);
  }
});
  