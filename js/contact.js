var errors = [];
    var reEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var reSubject = /^[A-Za-z0-9]{3,50}$/;
    



    document.getElementById("email").addEventListener("blur",function(){
        var email = $("#email").val();
        if(!reEmail.test(email)){
        document.getElementById("email").style.border = "1px solid red";
        errors.push("Email is not ok!");
         $("#errorEmail").html("Email is not ok!");
        }
        else {
        document.getElementById("email").style.border = "1px solid #ccc";
        $("#errorEmail").html("");
        }
        });

        document.getElementById("subject").addEventListener("blur",function(){
            var subject = $("#subject").val();
            if(!reSubject.test(subject)) {
              document.getElementById("subject").style.border = "1px solid red";
             errors.push("Subject is not ok!");
            $("#errorSubject").html("Subject is not ok!");
            }
            else {
            document.getElementById("subject").style.border = "1px solid #ccc";
            $("#errorSubject").html("");
            }
            });

            document.getElementById("message").addEventListener("blur",function(){
                var message = $("#message").val();
                if(!message) {
                  document.getElementById("message").style.border = "1px solid red";
                  errors.push("Message is not ok!");
                    $("#errorMessage").html("Message is not ok!");
                }
                else {
                document.getElementById("message").style.border = "1px solid #ccc";
                $("#errorMessage").html("");
                }
                });




$("#btnSend").on('click', function(e){
    var email = $("#email").val();
    var reEmail = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var errors = [];
    if(!reEmail.test(email)) {
    errors.push("Email is not ok!");
    $("#errorEmail").html("Email is not ok!");
    }
    var subject = $("#subject").val();
    var reSubject = /^[A-Za-z0-9]{4,50}$/;
    if(!reSubject.test(subject)) {
    errors.push("Subject is not ok!");
    $("#errorSubject").html("Subject is not ok!");
    }
    var message = $("#message").val();
    if(!message) {
    errors.push("Message is not ok!");
    $("#errorMessage").html("Message is not ok!");
    }
    if(errors.length == 0) {
    $.ajax({
        url : "modules/contactform.php",
        method:"POST",
        dataType: "json",
        data: {
        contact : "true",
        email : email,
        subject : subject,
        message : message
            },
        success: function(data) {
        
           alert("Sent!");
   
    },
    error: function(xhr, status, message) {
                     
                }
                
            });
            alert("Message sent");
        }
});