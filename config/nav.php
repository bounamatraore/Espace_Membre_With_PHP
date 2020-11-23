<?php 
  include 'path.php' ;
  $page = htmlspecialchars($_SERVER['PHP_SELF']) ;
?>
   <h1>
   <a href="<?php echo $FOLDER_PATH; ?>" class="navbar-brand ml-4" style="font-size:30px;">
       <img src="<?=$FOLDER_PATH?>/images/sge.jpg"  width="40px" alt="image"> SGE-EQUIP
        </a>
   <button class="btn btn-success mx-2" style="float:right;"><a href="<?php echo $FOLDER_PATH;?>/admin/" class="text-white nav-link">Espace membre </a> </button></h1>
    <nav class="navbar navbar-expand-sm navbar-dark bg-primary sticky-top d-flex" role="navigation">
        <!-- <a href="#" class="navbar-brand">
       <img src="<?=$FOLDER_PATH?>/images/sge.jpg"  width="40px" alt="image"> SGE-EQUIP
        </a> -->
    
        <button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav navbar-center">
                <li <?php if($page == "/index.php") echo "class='active'"; ?>class="nav-item">
                    <a href="<?php echo $FOLDER_PATH?>/index.php" class="nav-link">ACCUEIL</a>
                </li>
                <li <?php if($page == "/realisation/index.php") echo "class='active'";?> class="nav-item">
                        <a href="<?=$FOLDER_PATH?>/realisation" class="nav-link">R&Eacute;ALISATION</a>
                </li>
                <li <?php if($page == "/contact/index.php") echo "class='active' "; ?> class="nav-item">
                    <a href="<?=$FOLDER_PATH?>/contact" class="nav-link">CONTACT</a>
                </li>
            </ul>
    
            <form class="form-inline ml-auto my-2 my-lg-0" action="search.php" method="post">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>