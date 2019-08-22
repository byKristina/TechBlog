<?php
session_start();
include "modules/conn.php";
include "modules/functions.php";

$page = "";
if(isset($_GET['page'])){
	$page = $_GET['page'];
} else {
  header('Location: index.php?page=home');
}

include 'views/head.php';
include 'views/nav.php';
switch ($page) {
  
    case 'home':
      include 'views/home.php';       
      break;

    case 'contact':
      include 'views/contact.php';       
      break;
    
    case 'survey':
     include 'views/survey.php';
      break;
   

    case 'login':
      include 'views/login.php';
      break;  

      case 'post':
      include 'views/post.php';
      break;  

      case 'userPosts':
      include 'views/userPosts.php';
      break;  

    default:
      include 'views/home.php';               
      break;
  }


require 'views/footer.php';

