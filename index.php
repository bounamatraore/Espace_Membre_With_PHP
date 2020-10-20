<?php 
    session_start() ;
    include 'input_validation.php';
    include 'config/path.php' ;
?>
<?php 
    if(!isset($_SESSION['prenom']) && !isset($_SESSION['nom']) && !isset($_SESSION['id']) && !isset($_SESSION['email']) && !isset($_COOKIE["prenom"]) && !isset($_COOKIE["nom"]) && !isset($_COOKIE["email"]) && !isset($_COOKIE["id"])) :
?>
<a href='loging.php'> Connect you </a> or <a href='register'> Register you </a> 

<?php else : ?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Page Principale</title>
    <style>
  /* Make the image fully responsive */
  .carousel-inner img {
    max-width: 100%;
    max-height: 100%;
  }
  </style>
</head>
<body>
<h1 class="text-dark bg-primary d-flex"> WELCOME <?PHP if(isset($_SESSION['prenom']) &&   isset($_SESSION["nom"])) { echo ucwLower($_SESSION['prenom']). " ". ucwLower($_SESSION['nom']);}
else {
  if(isset($_COOKIE["prenom"]) && isset($_COOKIE["nom"])) {
    echo ucwLower($_COOKIE['prenom']). " ". ucwLower($_COOKIE['nom']);
  }
}
 ?>  <button class="btn btn-warning ml-auto"> <a href="logout.php"> Se deconnecter</a> </button></h1> 

   <?php include 'config/nav.php' ?>
   <h2> Le carousel example </h2>
   <div class="container">
<div id="demo" class="carousel slide" data-ride="carousel">

  <!-- Indicators -->
  <ul class="carousel-indicators">
    <li data-target="#demo" data-slide-to="0" class="active"></li>
    <li data-target="#demo" data-slide-to="1"></li>
    <li data-target="#demo" data-slide-to="2"></li>
  </ul>
  
  <!-- The slideshow -->
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/flower1.jpg" alt="Floer 1" width="800" class="d-block w-100" height="400">
    </div>
    <div class="carousel-item">
      <img src="images/flower3.jpg" alt="Chicago" width="800" class="d-block w-100" height="400">
    </div>
    <div class="carousel-item">
      <img src="images/flower5.jpg" alt="New York" width="800" class="d-block w-100" height="400">
    </div>
  </div>
  
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev" role="button">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
  </a>
</div>
</div>
<?php endif ?>
     
</body>
</html>