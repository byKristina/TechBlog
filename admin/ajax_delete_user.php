<?php

$statusCode = 404;


if($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "You can't access this page!";
}


if(isset($_POST['id'])){
	
    $id = $_POST['id'];

    include "../modules/conn.php";
	
    $upit = $conn->prepare("DELETE FROM user WHERE id = :id");
    $upit->bindParam(':id', $id);

    try{
        $rezultat = $upit->execute();

        if($rezultat){
            $statusCode = 204;
        } else {
            $statusCode = 500;
        }
    }
    catch(PDOException $e){
        $statusCode = 500;
    }
}

http_response_code($statusCode);
