function checkLogin(){
    var email = $("#email").val();
    var password = $("#password").val();
  
    var reEmail = /^[\w]+[\.\_\-\w]*\@[\w]+([\.][\w]+)+$/;
    var rePassword = /^[\S]{4,17}$/;
    var errors = [];

    
    if(!reEmail.test(email)) {
    errors.push("Email is not ok!");
    $("#errorEmail").html("Email is not ok!");
    $('#email').css('border','1px solid red');
    }
    else{
        $('#email').css('border','');
        $("#errorEmail").html("");
        }

    if(!rePassword.test(password)) {
     errors.push("Password is not ok!");
     $("#errorPassword").html("Password is not ok!");
     $('#password').css('border','1px solid red');
          }
     else{
      $('#password').css('border','');
      $('#password').css('');
      }


    if(errors.length == 0) {
    return true;
   }
   else{
    return false;
    }
}
   