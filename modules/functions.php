<?php

include "conn.php";

function getCategories($conn)
{
 global $conn;
 $query= "SELECT * FROM category";
 return $res=$conn->query($query)->fetchAll();
}

function getMenu($conn, $menutype_id){
  global $conn;
    $query= "SELECT * FROM menu WHERE menutype_id=:menutype_id ORDER BY position ASC";
    $stmt=$conn->prepare($query);
    $stmt->bindParam(":menutype_id", $menutype_id);
    $stmt->execute();
    //print_r( $stmt->execute());
    return $res=$stmt->fetchAll();
    //print_r($res);
   }



function getPosts($conn){
 try{
 $query= "SELECT p.id, i.url, i.alt, u.username AS username, p.name AS title, p.date, p.description FROM post p 
 INNER JOIN image i on p.image_id=i.id 
 INNER JOIN user u ON p.user_id=u.id ORDER BY p.date ASC ";

  foreach ($conn->query($query) as $row){
        $idp=$row->id;
    echo '<div class="card mb-4">
      <img class="card-img-top" src="'.$row->url.'" alt="'.$row->alt.'">
      <div class="card-body">
        <h2 class="card-title">'.$row->title.'</h2>
        <p class="card-text">'.substr($row->description,0,180). '...'.'</p>
        <a href="index.php?page=post&idp='.$row->id.'" class="btn btn-primary">Read More &rarr;</a>
      </div>
      <div class="card-footer text-muted">
        Posted on '.$row->date.' by
        <a href="#">'.$row->username.'</a>
      </div>
    </div>';

 }
 
 }catch(PDOException $ex){
 //echo $ex->getMessage();
 }
}

function getPostsByCategory($conn,$id){
    try{
        $query="SELECT p.id, i.url, i.alt, u.username AS username, c.name AS category, p.name AS title, 
        p.date, p.description FROM post p INNER JOIN category c on p.category_id=c.id INNER JOIN image i 
        on p.image_id=i.id INNER JOIN user u ON p.user_id=u.id WHERE c.id=:id ORDER BY p.date ASC";
        $stmt=$conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
         $res=$stmt->fetchAll();
        //print_r($res);
   
     foreach ($res as $row){
         $idp=$row->id;
       echo '<div class="card mb-4">
         <img class="card-img-top" src="'.$row->url.'" alt="'.$row->alt.'">
         <div class="card-body">
           <h2 class="card-title">'.$row->title.'</h2>
           <p class="card-text">'.substr($row->description,0,180). '...'.'</p>
           <a href="index.php?page=post&idp='.$row->id.'" class="btn btn-primary">Read More &rarr;</a>
         </div>
         <div class="card-footer text-muted">
           Posted on '.$row->date.' by
           <a href="#">'.$row->username.'</a>
         </div>
       </div>';
   
    }
    
    }catch(PDOException $ex){
    echo $ex->getMessage();
    }
   }
   
/*

   function getPostById($conn,$id){

    global $conn;
     $query= "SELECT p.description,p.id,p.category_id, i.url,u.username, c.name AS category, p.name, p.date,
    p.description FROM post p
     INNER JOIN category c on p.category_id=c.id
     INNER JOIN image i on p.image_id=i.id
     INNER JOIN user u ON p.user_id=u.id
     WHERE p.id = ?";
     $stmt=$conn->prepare($query);
    $stmt->execute(array($id));
    return $stmt->fetch();
    }


   function uploadImage($dbc,$image,$dst,$fnm)
   {
   try{
   move_uploaded_file($image, $dst);
   $query=$dbc->prepare("INSERT INTO slike(src) VALUES(?)");
   $query->execute(array($fnm));
   return $dbc->lastInsertId();
   }catch(PDOException $e){
   //echo $ex->getMessage();
   return false;
   }}
   function InsertPost($dbc,$imgid,$iduser,$heading,$about1,$about2,$kategorije)
   {
   try{
   $sql= "INSERT INTO postovi(slikaId, korisnikId, kategorijaId, naslov, opis1, opis2)
   VALUES(?,?,?,?,?,?)";
   $stmt= $dbc->prepare($sql);
   $stmt->execute(array($imgid,$iduser,$kategorije,$heading,$about1,$about2));
   return true;
   }catch(PDOException $ex){
   //echo $ex->getMessage();
   return false; }}
   function UpdatePost($dbc,$kategorije,$iduser,$heading, $about1, $about2, $postid)
   {
    try{
    $sql= "UPDATE postovi SET kategorijaId=? ,naslov= ?, opis1= ? ,opis2= ? WHERE id= ? and
   korisnikId=?";
    $stmt= $dbc->prepare($sql);
    $stmt->execute(array($kategorije,$heading,$about1,$about2, $postid,$iduser));
    return true;
    }catch(PDOException $ex){
    //echo $ex->getMessage();
    return false;
    }
   }
*/