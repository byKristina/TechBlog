<?php

require_once "config.php";

try {
    
	$conn = new PDO("mysql:host=".MYSQL_HOST.";dbname=".MYSQL_DBNAME.";charset=utf8", MYSQL_USERNAME, MYSQL_PASSWORD);
	
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
}
catch(PDOException $e){
    echo $e->getMessage();
}




