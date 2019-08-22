$(document).ready(function(){
    //DELETE USER
    
    $('.delete-user').click(function(){
        var id = $(this).data('id');
        // alert(id);

        $.ajax({
            method: 'POST',
            url: "ajax_delete_user.php",
            dataType: 'json',
            data: {
                id : id
            },
            success: function(podaci){
                alert("User successfully deleted!");
            },
            error: function(xhr, statusTxt, error){
                var status = xhr.status;
                switch(status){
                    case 500:
                        alert("Server error.");
                        break;
                    case 404:
                        alert("Page not found.");
                        break;
                    default:
                        alert("Error: " + status + " - " + statusTxt);
                        break;
                }
            }
        });
    });

    //UPDATE USER
    $('.update-user').click(function(){
        var id = $(this).data('up');
        // alert(id);

        $.ajax({
            method: 'POST',
            url: "ajax_get_user.php",
            dataType: 'json',
            data: {
                btn:true, id : id
            },
            success: function(data){

                var podaci=data.userdata;
                console.log(podaci);
                  $("#firstName").val(podaci[0].firstName);
                  $("#lastName").val(podaci[0].lastName);
                  $("#username").val(podaci[0].username);
                  $("#email").val(podaci[0].email);
                  $("#role").val(podaci[0].role_id);
                  $("#password").val(podaci[0].password);

                  $("#updateidUser").val(id); 
                
                
            },
            error: function(xhr, statusTxt, error){
                var status = xhr.status;
                switch(status){
                    case 500:
                        alert("Server error.");
                        break;
                    case 404:
                        alert("Page not found.");
                        break;
                    default:
                        alert("Error: " + status + " - " + statusTxt);
                        break;
                }
            }
        });
    });
});
