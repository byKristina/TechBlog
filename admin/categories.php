<?php
session_start();
if(isset($_SESSION['user']) && ($_SESSION['user']->role == "admin")):   ?>
   <?php
require_once "../modules/conn.php";
require_once "../modules/functions.php";
require_once 'views/head.php';
require_once 'views/nav.php';


?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                   Categories
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Categories
                    </li>
                </ol>

<?php


//INSERT
if(isset($_POST["add"])){
    $category=$_POST["title"];
       if (empty($category)){
           echo "<div class='alert alert-danger'>"."Category can not be empty"."</div>";
       }


       $reTitle="/^[A-Z][a-z]{3,15}$/";
    
       $errors=[];
       
       if (!preg_match($reTitle,$category)){
           $errors[] = "Invalid category format. First letter must be capitalized.";
           }
                               
           if(count($errors) > 0){
               echo "<ul>";
               
               foreach($errors as $error){
                   echo "<li> $error </li>";
               }
               echo "</ul>";
           }
else{
    $insertSql="INSERT INTO category VALUES(null,:category)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bindParam(':category', $category);
try{
    $stmt->execute() ? 201 :500;
    echo "<div class='alert alert-success'>"."Insert completed successfully"."</div>";
}
catch(PDOException $e){
    echo $e->getMessage();
    echo "<div class='alert alert-danger'>"."Error while inserting category"."</div>";
   }
  }
}  


//DELETE

if(isset($_POST["delete"])){
    $id=$_POST["delete"];

    $sql = "DELETE FROM category WHERE id =  :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id); 

    try{
        $stmt->execute();
        echo "<div class='alert alert-success'>"."Deleted successfully"."</div>";
       }catch(PDOException $e){
       echo "<div class='alert alert-danger'>"."Error while deleting"."</div>";
        }
     }  


//UPDATE
     if(isset($_POST["update"])){
        $id=$_POST["updateid"];
        $title=$_POST["title"];

        $reTitle="/^[A-Z][a-z]{3,15}$/";
    
        $errors=[];
        
        if (!preg_match($reTitle,$title)){
            $errors[] = "Invalid category format. First letter must be capitalized.";
            }
                                
            if(count($errors) > 0){
                echo "<ul>";
                
                foreach($errors as $error){
                    echo "<li> $error </li>";
                }
                echo "</ul>";
            }
 
 
 else{


        $updateSql="UPDATE category SET name='$title' WHERE id = $id";
         try{
        
         $conn->exec($updateSql);
         echo "<div class='alert alert-success'>"."Edited successfully"."</div>";
         }catch(PDOException $e){
            echo $e->getMessage();
            echo "<div class='alert alert-danger'>"."Error while editing data"."</div>";
         }
        }
    }

 $upit = "SELECT * FROM category";
  $categories = $conn->query($upit)->fetchAll();
  
?>

<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                    <div class="form-group">
                        <label>Title</label>
                        <input name="title"  id="title" class="form-control" placeholder="Enter text" value="">
                        
                    </div>
                    <div class="form-group">
                    <input type="hidden" name="updateid" id="updateid" />
                    <button type="submit" name="add" class="btn btn-primary">Add</button>
                    <button type="submit" name="update" class="btn btn-warning">Update</button>
                    </div>


                <div class="col-md-8">
                    <table class="table table-striped table-condensed table-bordered">
                        <tr><th>Name</th><th></th><th></th></tr>
                        <?php foreach($categories as $c): ?>
                        <tr><td><?= $c->name ?></td>
                        <td>
                        <button type="submit" name="delete" class="btn btn-danger" value="<?= $c->id ?>">Delete</button>
                        </td>
                        <td>
                     
                        <a class="update" data-up="<?= $c->id ?>"  href="#">Edit</a>
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
</div>


<?php
require_once 'views/footer.php';
?>

<?php endif;?>