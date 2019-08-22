 <!-- Page Content -->
 <div class="container">

<div class="row">

  <!-- Blog Entries Column -->
  <div class="col-md-8">

    <!-- Blog Post -->
   <?php if(isset($_GET['id'])){
            $id=$_GET['id'];
            // echo $id;
            getPostsByCategory($conn,$id);
    }else{getPosts($conn);}

    
    ?>
    
  
  </div>

  <!-- Sidebar Widgets Column -->
  <div class="col-md-4">

    

    <!-- Categories Widget -->
    <div class="card my-4">
      <h5 class="card-header">Categories</h5>
      <?php $categories=getCategories($conn);

    foreach ($categories as $row):   ?>

      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            <ul class="list-unstyled mb-0">
              <li>
              <a href="index.php?page=home&id=<?= $row->id ?>" class="category" data-category=<?= $row->id ?>><?= $row->name ?></a>
             
              </li>
            </ul>
            </div>
            </div>


            
      </div>
      <?php endforeach; ?>
    </div>

    </div>


  </div>
<!-- /.row -->

</div>
<!-- /.container -->