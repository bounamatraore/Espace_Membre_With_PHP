<?php 
  include 'chemin.inc.php' ;
  $page = htmlspecialchars($_SERVER['PHP_SELF']) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'head.inc.php'; ?>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mt-3 sticky-top d-flex" role="navigation">
        <a href="#" class="navbar-brand">
       <img src="<?=$FOLDER_PATH?>/images/flower3.jpg"  width="40px" alt="image"> BOUNAMA.COM
        </a>
    
        <button class="navbar-toggler" data-toggle="collapse" data-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>
    
        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav navbar-center">
                <li <?php if($page == "$FOLDER_PATH/index.php") echo "class='active'"; ?>class="nav-item">
                    <a href="<?=$FOLDER_PATH?>/index.php" class="nav-link">Home</a>
                </li>
                <li <?php if($page == "$FOLDER_PATH/realisation/index.php") echo "class='active'";?> class="nav-item">
                        <a href="<?=$FOLDER_PATH?>/realisation" class="nav-link">Realisation</a>
                </li>
                <li <?php if($page == "$FOLDER_PATH/contact/index.php") echo "class='active' "; ?> class="nav-item">
                    <a href="<?=$FOLDER_PATH?>/contact" class="nav-link">contact</a>
                </li>
            </ul>
    
            <form class="form-inline ml-auto my-2 my-lg-0" action="search.php" method="post">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</body>
</html>