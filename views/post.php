<?php
if(isset($_GET['idp'])){
  $idp=$_GET['idp'];
  // echo $id;
 
  $query= "SELECT p.id, p.description, i.url,u.username, p.name, p.date,
  p.description FROM post p
   INNER JOIN image i on p.image_id=i.id
   INNER JOIN user u ON p.user_id=u.id
   WHERE p.id = :id";
  $stmt=$conn->prepare($query);
  $stmt->bindParam(":id", $idp);
  $stmt->execute();
  $post=$stmt->fetch();

}

?> 
 
 
 
 <!-- Page Content -->
 <div class="container">

<div class="row">

  <!-- Post Content Column -->
  <div class="col-lg-8">

    <!-- Title -->
    <h1 class="mt-4"><?= $post->name?></h1>

    <!-- Author -->
    <p class="lead">
      by
      <a href="#"><?= $post->username?></a>
    </p>

    <p class="lead">Posted on  <?= $post->date?></p>

  

    <!-- Preview Image -->
    <img class="img-fluid rounded" src="<?= $post->url?>" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead"><?= $post->description?></p>

    
    </div></div></div>