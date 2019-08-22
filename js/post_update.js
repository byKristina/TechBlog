 //UPDATE POST
 $('.update-post').click(function(){
    var id = $(this).data('up');
   //  alert(id);

    $.ajax({
        method: 'POST',
        url: "modules/ajax_get_post.php",
        dataType: 'json',
        data: {
            btn:true, id : id
        },
        success: function(data){

            var podaci=data.userdata;
             console.log(podaci);
              $("#title").val(podaci[0].name);
           //   $("#image").val(podaci[0].image_id);
              $("#description").html(podaci[0].description);
              $("#category").val(podaci[0].category_id);
            

              $("#updateidPost").val(id); 
            
            
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