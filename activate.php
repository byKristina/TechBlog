<?php

if(isset($_GET['a'])) {
    require_once "modules/conn.php";
    $token = $_GET['a'];
    $query = "SELECT * FROM user WHERE token = :token";
    $preparedquery=$conn->prepare($query);
    $preparedquery->bindParam(":token", $token);
    try{
        $result = $preparedquery->execute();
        if($preparedquery->rowcount()==1){
        $query = "UPDATE user SET active = 1 WHERE token = :token";
        $preparedquery = $conn->prepare($query);
        $preparedquery->bindParam(":token",$token);
        try{
        $result = $preparedquery->execute();
        if($result){
        http_response_code(200);
        echo "Account is successfully activated!";
        }
        else{
        http_response_code(422); 
        echo "Error 422.";
        }
        }
        catch(PDOExeption $e){
        http_response_code(500);
        }
        }
        else{
        http_response_code(422);
        echo "Account already exists.";
        }
        }
        catch(PDOExeption $e){
        http_response_code(500);
        }
       }