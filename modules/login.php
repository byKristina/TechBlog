<?php
session_start(); 
	if(isset($_POST['btnLogin'])){

		$email = $_POST['tbEmail'];
		$password = $_POST['tbPassword'];

		$errors = [];
		$rePassword = "/^[\S]{4,30}$/";

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			$errors[] = "Email is invalid.";
		}

		if(!preg_match($rePassword, $password)){
			$errors[] = "Password is invalid.";
		}

		if(count($errors) > 0){
			$_SESSION['errors'] = $errors;
			http_response_code(422);
			header("Location: ../index.php?page=login");
		}
		else {
			require_once "conn.php";
			$password = md5($password);

			 $query = "SELECT u.id, u.email, u.username, u.firstName, u.lastName, r.name as role FROM user u INNER JOIN role r 
              ON u.role_id = r.id WHERE active = 1 
              AND email = :email AND password = :password";

			    $stmt = $conn->prepare($query);
			    $stmt->bindParam(":email", $email);
			    $stmt->bindParam(":password", $password);

			    $stmt->execute();
			    $user = $stmt->fetch(); 
			    if($user) {
					$_SESSION['user'] = $user;
					//print_r($_SESSION['user']);
					//echo "You have successfully logged in!";
				   header("Location: ../index.php?page=home");
				  
					if ($_SESSION['user']->role == "admin"){
						
						header("Location: ../admin/index.php");
						
					}
					else if ($_SESSION['user']->role == "user")
					//napravi stranu za usera i da moze da doda post
						header("Location: ../index.php?page=home");
								        
			    } else {
			        $_SESSION['errors'] = "Invalid email or password.";
			        header("Location: ../index.php?page=login");
				}
				

				
		}
	}