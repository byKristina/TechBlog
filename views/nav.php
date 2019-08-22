<body>


    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php?page=home">TechBlog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          <?php  if(!isset($_SESSION['user'])):?>
          <?php      $navMenu=getMenu($conn, 1);
                
            foreach($navMenu as $row):?>
            <?php // print_r($row);?>
            <li class="nav-item active">

              <a class="nav-link" href="<?= $row->url ?>"><?= $row->name ?>
              </a>
            </li>
            <?php endforeach; ?>   
            <?php endif; ?>
            <?php if(isset($_SESSION['user']) && ($_SESSION['user']->role == "user")):?>
            
            <li class="nav-item">
            <?php    $navMenu=getMenu($conn, 2);      
                foreach($navMenu as $row):?>
                <li class="nav-item active">
    
                  <a class="nav-link" href="<?= $row->url ?>"><?= $row->name ?>
                  </a>
                </li>
                <?php endforeach; ?>   
					
					<?php endif; ?>

          <?php if(isset($_SESSION['user']) && ($_SESSION['user']->role == "admin")):?>
            
            <li class="nav-item">     
                <li class="nav-item active">
    
                  <a class="nav-link" href="modules/logout.php">Log out
                  </a>
                </li> 
					
					<?php endif; ?>



          </ul>
        </div>
      </div>



    </nav>