<?php

session_start();

include "../modules/functions.php";
 if(isset($_SESSION['user']) && ($_SESSION['user']->role == "admin")){
require_once 'views/head.php';
require_once 'views/nav.php';
require_once 'views/start.php';
require_once 'views/footer.php';
}else {
    header("Location: ../index.php");
}

?>

