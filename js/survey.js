$(document).ready(function(){
    $.ajax({
    url:"modules/survey.php",
    type:"json",
    method:"POST",
    data:{
         survey:true
    },
    success:function(data){
       
        $("#rezultati").html(data);
    
 },
 error:function(xhr,status,error){
 
 }
 });
});

$("#submit").click(function(){
 options=document.getElementsByName("radioBtn");
 var selected="";
 for(var i=0;i<options.length;i++){
 if(options[i].checked){
    selected=options[i].value;
 }
 }
 if(selected==""){
 $("#ispis").html("<div class='alert alert-danger'>You must choose option!</div>");
 }else{
 $.ajax({
 url:"modules/survey.php",
 type:"json",
 method:"POST",
 data:{
    selected:selected,
    submit:true
 },
 success:function(data){
 $("#rezultati").html(data);
 },
 error:function(xhr,status,error){

 }
 })
 }
})