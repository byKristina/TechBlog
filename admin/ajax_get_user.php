<?php

include "../modules/conn.php";
header("Content-type:application/json");
if(isset($_POST['btn'])){
    $id=intval($_POST['id']);
    $query="SELECT id,firstName,lastName,email,password,role_id,username FROM user WHERE id=:id";
    $prepared = $conn->prepare($query);
    $prepared->bindParam(":id",$id);
    $prepared->execute();
    $result = $prepared->fetchAll();
    echo json_encode(['userdata'=>$result]);
   
}