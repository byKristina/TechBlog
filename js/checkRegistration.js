
   function checkRegistration(){
   
    var reEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var reName = /^[A-Z][a-z]{2,17}$/;
    var rePassword = /^[A-z0-9_\!]{3,20}$/;
    var reUsername = /^[a-z0-9]{3,17}$/;

    var errors = [];

    var password = $("#passwordR").val();
    var email = $("#emailR").val();
    var fname = $("#firstName").val();
    var lname = $("#lastName").val();
    var username = $("#username").val();


if(!reName.test(fname)) {
    errors.push("First Name is not ok!");
    $("#errorFirstName").html("First Name is not ok!");
    $('#firstName').css('border','1px solid red');
    }
    else{
        $('#firstName').css('border','');
        $("#errorFirstName").html("");
        }


        if(!reName.test(lname)) {
            errors.push("Last Name is not ok!");
            $("#errorLastName").html("Last Name is not ok!");
            $('#lastName').css('border','1px solid red');
            }
            else{
                $('#lastName').css('border','');
                $("#errorLastName").html("");
                }

        if(!reUsername.test(username)) {
                    errors.push("Username is not ok!");
                    $("#errorUsername").html("Username is not ok!");
                    $('#username').css('border','1px solid red');
                    }
               else{
                        $('#username').css('border','');
                        $("#errorUsername").html("");
                        }


if(!rePassword.test(password)) {
    errors.push("Password is not ok!");
    $("#errorPasswordR").html("Password is not ok!");
    $('#passwordR').css('border','1px solid red');
         }
    else{
     $('#passwordR').css('border','');
     $('#passwordR').css('');
     }

     if(!reEmail.test(email)) {
        errors.push("Email is not ok!");
        $("#errorEmailR").html("Email is not ok!");
        $('#emailR').css('border','1px solid red');
        }
        else{
            $('#emailR').css('border','');
            $("#errorEmail").html("");
            }




    if(errors.length == 0) {
        return true;
       }
       else{
        return false;
        }
   }
