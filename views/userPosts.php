
<?php
if(isset($_SESSION['user']) && ($_SESSION['user']->role == "user")):   ?>
   <?php
require_once "modules/conn.php";

$user_id=$_SESSION['user']->id;

$upit = "SELECT * FROM category;";
$categories = $conn->query($upit)->fetchAll();


 $query= "SELECT p.id,p.name AS title, i.url, i.alt, p.date, c.name AS category, p.description FROM post p 
        INNER JOIN category c on p.category_id=c.id
        INNER JOIN image i on p.image_id=i.id 
        INNER JOIN user u ON p.user_id=u.id 
        WHERE u.id = :id
        ORDER BY p.date DESC;";
         $stmt=$conn->prepare($query);
         $stmt->bindParam(":id", $user_id);
         $stmt->execute();
         $prikaz=$stmt->fetchAll();


  //INSERT
         if(isset($_POST['add'])){
            $title=$_POST["title"];
            $description=$_POST["description"];
            $category=$_POST["category"];     
    
        
            
            $image=$_FILES["image"];
            $fileName = $image['name'];
            $fileType = $image['type'];
            $fileSize = $image['size'];
            $fileTmp = $image['tmp_name'];
            define('FILE_SIZE', 4194304); // 4 MB
            
            $errors = [];
        
            $reTitle = '/^[\w\s]{4,100}$/';
        
            if(!preg_match($reTitle, $title)){
                $errors[] = "Title is not ok!";
            }
        
            $allowTypes = array("/image/jpg", "image/jpeg", "image/png");
        
            if(!in_array($fileType, $allowTypes)){
                $errors[] = "Invalid file type!";
            }
        
            if($fileSize > FILE_SIZE){ 
                $errors[] = "Image must be less than 4 MB.";
            }
        
            if(count($errors) == 0){
                
                $newFile = time().$fileName;
                $fileUrl = "img/post/".$newFile;
        
                // upload image
                if(move_uploaded_file($fileTmp, $fileUrl)){
                
                    $filePathDB = 'img/post/' . $newFile;
        
                    $insert_image = "INSERT INTO image VALUES(null, :alt, :url)";
        
                    $stmt = $conn->prepare($insert_image);
        
                    $stmt->bindParam(":alt", $title);
                    $stmt->bindParam(":url", $filePathDB);
        
                    try{
                        $res_insert = $stmt->execute();
        
                        $id_image = $conn->lastInsertId();
        
                        $insert_post = "INSERT INTO post VALUES(null, :title, :user, :category, :image, :description, :date)";
        
                        $prepare_post = $conn->prepare($insert_post);
        
                        $prepare_post->bindParam(":title", $title);
                        $prepare_post->bindParam(":category", $category);
                        $prepare_post->bindParam(":description", $description);
        
                        $date=time();
                        $date1=strftime("%Y-%m-%d %H:%M:%S", $date);
                      

                        $prepare_post->bindParam(":date", $date1);
        
                        $prepare_post->bindParam(":user", $user_id);
        
                        $prepare_post->bindParam(":image", $id_image);
        
                        $inserted = $prepare_post->execute();
        
                        if($inserted){
                            echo "<div class='alert alert-success'>"."Insert completed successfully"."</div>";
                        }
        
                    }
                    catch(PDOException $ex){
                        echo $ex->getMessage();
                        echo "<div class='alert alert-danger'>"."Error while inserting data"."</div>";
                    }
        
                } else {
                    echo "<div class='alert alert-danger'>"."Error while uploading file"."</div>";
                }
            }
            else {
                
                foreach($errors as $error){
                  echo  "<div class='alert alert-danger'>$error</div>";
                }
        
            }
        }





//DELETE
if(isset($_GET["idDeletePost"])){
    $idDeletePost=$_GET["idDeletePost"];

    try{
       

       $post_image = " SELECT p.*, i.url
                   FROM post p 
                       INNER JOIN image i
                           ON p.image_id = i.id 
                   WHERE p.id = :id";
       $priprema = $conn->prepare($post_image);
       $priprema->bindParam(":id", $idDeletePost);

       $rez = $priprema->execute();

       if($rez){
           $post = $priprema->fetch(); 

           if(!empty($post)){


               $upit = "   DELETE 
               FROM post 
               WHERE id = :id";

               $priprema = $conn->prepare($upit);
               $priprema->bindParam(":id", $idDeletePost);

               $rez = $priprema->execute();

               if($rez){

                   unlink($post->url);
                

                   $upit = "   DELETE 
                               FROM image 
                               WHERE id = :id";

                   $priprema = $conn->prepare($upit);
                   $priprema->bindParam(":id", $post->image_id);

                   $rez = $priprema->execute();

                 
                    echo "<div class='alert alert-success'>Successfully deleted</div>";
               }
            }
   }
}
   catch(PDOException $ex){
      echo "<div class='alert alert-success'>Error while deleting</div>";
   }

     } 



//UPDATE
if(isset($_POST["update-post"])){
    $id=$_POST["updateidPost"];

    $title=$_POST["title"];
    $description=$_POST["description"];
    $category=$_POST["category"];     

    $errors = [];

    $reTitle = '/^[\w\s]{4,100}$/';

    if(!preg_match($reTitle, $title)){
		$errors[] = "Title is not ok!";
    }

    $image=$_FILES["image"];
    //if image is uploaded
    if($image['size'] != 0){
         $fileName = $image['name'];
         $fileType = $image['type'];
         $fileSize = $image['size'];
         $fileTmp = $image['tmp_name'];
         define('FILE_SIZE', 4194304); //4MB

    $allowTypes = array("image/jpg", "image/jpeg", "image/png");

	if(!in_array($fileType, $allowTypes)){
		$errors[] = "Invalid file type!";
	}

	if($fileSize > FILE_SIZE){ 
		$errors[] = "Image must be less than 4 MB.";
    }
    if(count($errors) == 0){
		
		$newFile = time().$fileName;
        $fileUrl = "img/post/".$newFile;
        if(move_uploaded_file($fileTmp, $fileUrl)){
		
            $filePathDB = 'img/post/' . $newFile;

            $select_image = "SELECT * FROM post WHERE id = :id";
            $priprema = $conn->prepare($select_image);
            $priprema->bindParam(":id" , $id);

            try{
                $rez = $priprema->execute();

                if($rez){
                    $post = $priprema->fetch();
                    $idImage = $post->image_id;
                   

                    // UPDATE IMAGE

                    $update_image = "UPDATE image SET alt = :alt, url = :url WHERE id = :id";
                    
                    $priprema_slika = $conn->prepare($update_image);

                    $priprema_slika->bindParam(":alt", $title);
                    $priprema_slika->bindParam(":url", $filePathDB);
                    $priprema_slika->bindParam(":id", $idImage);

                    $rez_slika = $priprema_slika->execute();

                    if($rez_slika){
                

                        $update_post = "UPDATE post SET name = :title, description = :description WHERE id = :id";

                        $priprema_post = $conn->prepare($update_post);
                        
                        $priprema_post->bindParam(":title", $title);
                        $priprema_post->bindParam(":description", $description);
                     
                        $priprema_post->bindParam(":id", $id);

                        $rez = $priprema_post->execute();

                        echo ($rez)? "<div class='alert alert-success'>"."Edited successfully"."</div>" : "<div class='alert alert-danger'>"."Error while editing"."</div>";
                    }
                }

            }
            catch(PDOException $ex){
                echo $ex->getMessage();
            }
        } else {
            echo "<div class='alert alert-success'>"."Error while uploading file!"."</div>";
        }
    }
}else {

	if(count($errors) == 0) {
			

        try{
            $update_post = "UPDATE post SET name = :title, description = :description WHERE id = :id";

            $priprema_post = $conn->prepare($update_post);
            
            $priprema_post->bindParam(":title", $title);
            $priprema_post->bindParam(":description", $description);
            $priprema_post->bindParam(":id", $id);

            $rez = $priprema_post->execute();

            echo ($rez)? "<div class='alert alert-success'>"."Edited successfully"."</div>" : "<div class='alert alert-danger'>"."Error while editing"."</div>";
        }
        catch(PDOException $ex){
            echo $ex->getMessage();
        }
    }
}

// ISPIS GRESAKA

if(count($errors) > 0){
    echo "<ol>";
    
    foreach($errors as $error){
        echo "<li> $error </li>";
    }
    echo "</ol>";
}
}



?>





<div class="container">
<form role="form" method="post" enctype="multipart/form-data" action="index.php?page=userPosts">
  <h2>New Post:</h2>
                    <div class="form-group">
                        <label>Title</label>
                        <input id="title" name="title" class="form-control" placeholder="Enter text">
                    </div>

                    <div class="form-group">
                        <label>Image</label>
                        <input id="image" name="image" type="file">
                    </div>

                    <div class="form-group">
                        <label>Text</label>
                        <textarea id="description" name="description" placeholder="Enter text" class="form-control" rows="3"></textarea>
                    </div>


                    <div class="form-group">
                        <label>Category</label>
                        <select id="category" name="category" class="form-control">
                            <?php foreach($categories as $c): ?>
                                <option value="<?= $c->id ?>"> <?= $c->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                   
                   <div class="form-group">
                   <input type="hidden" name="updateidPost" id="updateidPost" />
                    <button type="submit" name="add" class="btn btn-primary">Add</button>
                    <button type="submit" name="update-post" class="btn btn-warning">Update</button>
                    </div>
                       
                    



               <div >
                    <table class="table table-striped table-condensed table-bordered">
                        <tr><th>Title</th><th>Category</th><th>Image</th><th>Text</th><th></th><th></th></tr>
                        <?php foreach($prikaz as $p): ?>
                       
                        <tr><td width="200px"><?= $p->title ?></td>
                        <td><?= $p->category ?></td>
                        <td><img width="200px" src="<?= $p->url?>" alt="<?= $p->alt ?>"></td>
                        <td><?=  substr($p->description,0,180) ?></td>
                        <td>
                        <a href="index.php?page=userPosts&idDeletePost=<?= $p->id ?>">
                        <span class="btn btn-danger">Delete</span>
                        </a>
                        </td>
                        <td>
                        <a class="update-post" data-up="<?= $p->id ?>"  href="#">Edit</a>
                        </td>
                        
                        </tr>
                        <?php endforeach; ?>
                    </table>
                    </form>
        </div>
        </div>

<?php else: header("Location: index.php");
endif;?>