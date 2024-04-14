
const logInActionLink = "/step by step implementation/src/php/LogIn.php";
$(document).on(
  "click",
  "#login-trigger",
  ()=> {

    const input_user_email = $('#input-user-email').val();
    const input_user_password = $('#input-user-password').val();
    
    $.ajax({
      type: "POST",
      url: logInActionLink,
      dataType: "json",
      data: {
        user_email: input_user_email, 
        user_password : input_user_password
      },
      success: function(response){
        // const responseData = JSON.parse(response);
        if(response.login_status){
          
          window.location.replace(response.next_page);
        } else {
          
          Swal.fire({
            icon: "info",
            title: "Log-In Failed",
            timer: 3000,
            text: "Incorrect password or email"
          
          });
        } 
      }
    
    });

  }
)