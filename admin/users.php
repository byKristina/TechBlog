<?php
session_start();
include "../modules/functions.php";
if(isset($_SESSION['user']) && ($_SESSION['user']->role == "admin")):   ?>
   <?php
require_once "../modules/conn.php";
require_once 'views/head.php';
require_once 'views/nav.php';
?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                   Users
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Users
                    </li>
                </ol>

<?php
//ADD NEW
if(isset($_POST["add"])){
    $firstName=$_POST["firstName"];
    $lastName=$_POST["lastName"];
    $username=$_POST["username"];
    $email=$_POST["email"];   
    $password= md5($_POST["password"]);   
    $role=$_POST["role"];  
    
    
       if (empty($firstName) || empty($lastName) || empty($username) || empty($email) || empty($role) || empty($password) ){
           echo "<div class='alert alert-danger'>"."All fields must be filled out"."</div>";
       }

       $reFirstName="/^[A-Z][a-z]{3,15}$/";
       $reLastName="/^[A-Z][a-z]{3,15}$/";
       $reUsername="/^([A-Za-z0-9]{3,15}$/";
       $rePassword="/^[\S]{4,50}$/";
   
       $errors=[];
       
       if (!preg_match($reFirstName,$firstName)){
           $errors[] = "Invalid first name format. ";
           }
        if (!preg_match($reLastName,$lastName)){
               $errors[] = "Invalid last name format. ";
               }
   
            if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                   $errors[] = "Invalid email format.";
                   }
                               
           if(count($errors) > 0){
               echo "<ul>";
               
               foreach($errors as $error){
                   echo "<li> $error </li>";
               }
               echo "</ul>";
           }


else{
    $insertSql="INSERT INTO user(id,firstName,lastName,username,email,password,role_id,active,token) VALUES(null,:firstName,:lastName,:username,:email,:password,:role,1,'')";
    $stmt = $conn->prepare($insertSql);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
    
try{
    $stmt->execute() ? 201 :500;
    echo "<div class='alert alert-success'>"."Insert completed successfully"."</div>";
}
catch(PDOException $e){
    echo $e->getMessage();
    echo "<div class='alert alert-danger'>"."Error while inserting data"."</div>";
   }
  }
} 



//UPDATE
if(isset($_POST["update-user"])){
    $id=$_POST["updateidUser"];
    $firstName=$_POST["firstName"];
    $lastName=$_POST["lastName"];
    $username=$_POST["username"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $role=$_POST["role"];

    $reFirstName="/^[A-Z][a-z]{3,15}$/";
    $reLastName="/^[A-Z][a-z]{3,15}$/";
    $reUsername="/^([A-Za-z0-9]{3,15}$/";
    $rePassword="/^[\S]{4,50}$/";

    $errors=[];
    
    if (!preg_match($reFirstName,$firstName)){
        $errors[] = "Invalid first name format. ";
        }
     if (!preg_match($reLastName,$lastName)){
            $errors[] = "Invalid last name format. ";
            }

         if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
                $errors[] = "Invalid email format.";
                }
                            
        if(count($errors) > 0){
            echo "<ul>";
            
            foreach($errors as $error){
                echo "<li> $error </li>";
            }
            echo "</ul>";
        }
else{

    $password=md5($password);

    $updateSql="UPDATE user SET firstname=:firstname,lastname=:lastname,username=:username,
    email=:email,password=:password,
    role_id=:roleid WHERE id = :updateid";
    $prepare= $conn->prepare($updateSql);
    $prepare->bindParam(":updateid",$id);
    $prepare->bindParam(":firstname",$firstName);
    $prepare->bindParam(":lastname",$lastName);
    $prepare->bindParam(":username",$username);
    $prepare->bindParam(":email",$email);
    $prepare->bindParam(":password",$password);
    $prepare->bindParam(":roleid",$role);
    try{
    $prepare->execute();
    
     echo "<div class='alert alert-success'>"."Edited successfully"."</div>";
     }catch(PDOException $e){
        echo $e->getMessage();
        echo "<div class='alert alert-danger'>"."Error while editing data"."</div>";
     }
   }
}
 

$upit = "SELECT u.id as userId,firstName,lastName,username,email,active, r.name AS role
FROM user u INNER JOIN role r ON u.role_id=r.id";
 $users = $conn->query($upit)->fetchAll();
 $upit = "SELECT * FROM role;";
 $roles = $conn->query($upit)->fetchAll();
?>


         <form role="form" method="post"  action="users.php">
                    <div class="form-group">
                        <label>First Name</label>
                        <input id="firstName" name="firstName" class="form-control" placeholder="Enter text">
                    </div>

                    <div class="form-group">
                        <label> Last Name</label>
                        <input id="lastName" name="lastName" class="form-control" placeholder="Enter text">
                    </div>
                    
                    <div class="form-group">
                        <label> Username</label>
                        <input id="username" name="username" class="form-control" placeholder="Enter text">
                    </div>
                    
                    <div class="form-group">
                        <label> Email</label>
                        <input id="email" name="email" class="form-control" placeholder="Enter email">
                    </div>

                    <div class="form-group">
                        <label> Password</label>
                        <input id="password" name="password" class="form-control" placeholder="Enter password">
                    </div>

                    <div class="form-group">
                        <label>Role</label>
                        <select name="role" class="form-control">
                            <?php foreach($roles as $r): ?>
                                <option value="<?= $r->id ?>"> <?= $r->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    
                   
                    <div class="form-group">
                    <input type="hidden" name="updateidUser" id="updateidUser" />
                    <button type="submit" name="add" class="btn btn-primary">Add</button>
                    <button type="submit" name="update-user" class="btn btn-warning">Update</button>
                    </div>



               <div class="col-md-8">
                    <table class="table table-striped table-condensed table-bordered">
                        <tr><th>First Name</th><th>Last Name</th><th>Username</th><th>Email</th><th>Role</th><th></th><th></th></tr>
                        <?php foreach($users as $p): ?>
                        <tr>
                            <td><?= $p->firstName ?></td>
                            <td><?= $p->lastName ?></td>
                            <td><?= $p->username ?></td>
                            <td><?= $p->email ?></td>
                            <td><?= $p->role ?></td>
                    
                           
                        <td>
                        <a class="delete-user" data-id="<?= $p->userId ?>"  href="#">Delete</a> 
                         
                         </a>
                        </td>
                        <td>
                        <a class="update-user" data-up="<?= $p->userId ?>"  href="#">Edit</a>
                        </td>
                        
                        </tr>
                        <?php endforeach; ?>
                    </table>

                </form>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->



<?php
require_once 'views/footer.php';
?>
<?php else: {
    header("Location: ../index.php");
} 
endif;?>