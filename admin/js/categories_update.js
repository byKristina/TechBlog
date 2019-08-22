$(document).ready(function(){
    $(".update").on("click",function(){
    var id= $(this).data("up");
    //console.log(id);
    $.ajax({
        url:"ajax_get_categories.php",
        type:"POST",
        dataType:'json',
        data:{
            btn:true, id:id
        },
        success: function(data){
            var podaci=data.userdata;
          //  console.log(podaci);
            $("#title").val(podaci[0].name);
            $("#updateid").val(id);
        }
    });
 });
});