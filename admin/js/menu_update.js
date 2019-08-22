 //UPDATE MENU
 $('.update-menu').click(function(){
    var id = $(this).data('up');
   //  alert(id);

    $.ajax({
        method: 'POST',
        url: "ajax_get_menu.php",
        dataType: 'json',
        data: {
            btn:true, id : id
        },
        success: function(data){

            var podaci=data.userdata;
             console.log(podaci);
              $("#name").val(podaci[0].name);
              $("#url").val(podaci[0].url);
              $("#menutype").val(podaci[0].menutype_id);
              $("#position").val(podaci[0].position);
            

              $("#updateidMenu").val(id); 
            
            
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