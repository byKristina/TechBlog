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
                   Menu
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i>  <a href="index.php">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Menu
                    </li>
                </ol>

<?php

if(isset($_POST["add"])){
    $name=$_POST["name"];
    $url=$_POST["url"];
    $menutype=$_POST["menutype"];
    $position=$_POST["position"];    
    
       if (empty($name) || empty($url) || empty($menutype) || empty($position)){
           echo "<div class='alert alert-danger'>"."All fields must be filled out"."</div>";
       }
       if (empty($name) || empty($url) || empty($menutype) || empty($position)){
        echo "<div class='alert alert-danger'>"."All fields must be filled out"."</div>";
    }

    $reName="/^[A-Z][a-z]{3,15}$/";
  
    $errors=[];
    
    if (!preg_match($reName,$name)){
        $errors[] = "Invalid name format. ";
        }
    if (($position==0) || ($position > 15 )){
            $errors[] = "Invalid position. Can not be 0 and can not be greater than 15. ";
            }

                            
        if(count($errors) > 0){
            echo "<ul>";
            
            foreach($errors as $error){
                echo "<li> $error </li>";
            }
            echo "</ul>";
        }


else{
    $insertSql="INSERT INTO menu VALUES(null,:menutype,:url,:name,:position)";
    $stmt = $conn->prepare($insertSql);
    $stmt->bindParam(':menutype', $menutype);
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':position', $position);
 
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
//DELETE
if(isset($_GET["idDeleteMenu"])){
    $id=$_GET["idDeleteMenu"];

    $sql = "DELETE FROM menu WHERE id =  :id";
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
if(isset($_POST["update-menu"])){
    $id=$_POST["updateidMenu"];
   
    $name=$_POST["name"];
    $url=$_POST["url"];
    $menutype=intval($_POST["menutype"]);
    $position=intval($_POST["position"]);


    if (empty($name) || empty($url) || empty($menutype) || empty($position)){
        echo "<div class='alert alert-danger'>"."All fields must be filled out"."</div>";
    }

    $reName="/^[A-Z][a-z]{3,15}$/";
  
    $errors=[];
    
    if (!preg_match($reName,$name)){
        $errors[] = "Invalid name format. ";
        }
    if (($position==0) || ($position > 15 )){
            $errors[] = "Invalid position. Can not be 0 and can not be greater than 15. ";
            }

                            
        if(count($errors) > 0){
            echo "<ul>";
            
            foreach($errors as $error){
                echo "<li> $error </li>";
            }
            echo "</ul>";
        }


else{


    $updateSql="UPDATE menu SET name=:name,url=:url,menutype_id=:menutype,
    position=:position WHERE id = :updateid";
    $prepare= $conn->prepare($updateSql);
    $prepare->bindParam(":updateid",$id);
    $prepare->bindParam(":name",$name);
    $prepare->bindParam(":url",$url);
    $prepare->bindParam(":menutype",$menutype);
    $prepare->bindParam(":position",$position);
     try{
    
        $prepare->execute();
     echo "<div class='alert alert-success'>"."Edited successfully"."</div>";
     }catch(PDOException $e){
        echo $e->getMessage();
        echo "<div class='alert alert-danger'>"."Error while editing data"."</div>";
     }
    }
}




$upit = "SELECT * FROM menutype;";
$menutype = $conn->query($upit)->fetchAll();
$upit = "SELECT m.*,mt.name as type FROM menu m INNER JOIN menutype mt ON m.menutype_id=mt.id;";
$menus = $conn->query($upit)->fetchAll();

?>


        <form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
                <div class="form-group">
                        <label>Name</label>
                        <input id="name" name="name" class="form-control" placeholder="Enter text">
                    </div>
                    <div class="form-group">
                        <label>Url</label>
                        <input id="url" name="url" class="form-control" placeholder="Enter text">
                    </div>

                    <div class="form-group">
                        <label>Menu Type</label>
                        <select id="menutype" name="menutype" class="form-control">
                            <?php foreach($menutype as $m): ?>
                                <option value="<?= $m->id ?>"> <?= $m->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                        <input id="position" name="position" class="form-control" placeholder="Enter text">
                    </div>

                    <div class="form-group">
                    <input type="hidden" name="updateidMenu" id="updateidMenu" />
                    <button type="submit" name="add" class="btn btn-primary">Add</button>
                    <button type="submit" name="update-menu" class="btn btn-warning">Update</button>
                    </div>
                       

                <div class="col-md-8">
                    <table class="table table-striped table-condensed table-bordered">
                        <tr><th>Name</th><th>Menu Type</th><th>Url</th><th>Position</th><th></th><th></th></tr>
                        <?php foreach($menus as $p): ?>
                        
                        <tr>
                           
                            <td><?= $p->name ?></td>
                            <td><?= $p->type ?></td>
                             <td><?= $p->url ?></td>
                             <td><?= $p->position ?></td>
                        <td>

                         <a href="menu.php?idDeleteMenu=<?= $p->id ?>"> 
                         <span class="btn btn-danger">Delete</span>
                         </a>
                        </td>
                        <td>
                        <a class="update-menu" data-up="<?= $p->id ?>"  href="#">Edit</a>
                        </td>
                        
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    </form>
                    

                </div>


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