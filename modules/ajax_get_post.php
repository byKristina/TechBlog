<?php

include "conn.php";
header("Content-type:application/json");
if(isset($_POST['btn'])){
    $id=$_POST['id'];
    $query="SELECT * FROM post WHERE id=:id";
    $prepared = $conn->prepare($query);
    $prepared->bindParam(":id",$id);
    $prepared->execute();
    $result = $prepared->fetchAll();
    echo json_encode(['userdata'=>$result]);
   
}