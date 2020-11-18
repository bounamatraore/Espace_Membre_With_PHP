<?php 
    session_start() ;
    include 'input_validation.php';
    include 'config/path.php' ;
?>
 <?php 
    // if(!isset($_SESSION['prenom']) && !isset($_SESSION['nom']) && !isset($_SESSION['id']) && !isset($_SESSION['email']) && !isset($_COOKIE["prenom"]) && !isset($_COOKIE["nom"]) && !isset($_COOKIE["email"]) && !isset($_COOKIE["id"])) :
?> 
<!-- <a href='loging.php'> Connect you </a> or <a href='register'> Register you </a>  -->

<?php // else : ?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <title>Page Principale</title>
    <?php include("config/head.php"); ?>
    <style>
  /* Make the image fully responsive */
  .carousel-inner img {
    max-width: 100%;
    max-height: 100%;
  }
  <style>
    .nav.active {
        color:red;
    }
  </style>
</head>
<body>
    <!-- <h1 class="text-dark bg-primary d-flex"> WELCOME <?PHP //if(isset($_SESSION['prenom']) &&   isset($_SESSION["nom"])) { echo ucwLower($_SESSION['prenom']). " ". ucwLower($_SESSION['nom']);}
    //else {
      //if(isset($_COOKIE["prenom"]) && isset($_COOKIE["nom"])) {
        //echo ucwLower($_COOKIE['prenom']). " ". ucwLower($_COOKIE['nom']);
    // }
    //}
    ?>  <button class="btn btn-warning ml-auto"> <a href="logout.php"> Se deconnecter</a> </button></h1>  -->

   <?php include 'config/nav.php' ?>
   
   <div class="container-fluid">
      <div id="demo" class="carousel slide" data-ride="carousel">

          <!-- Indicators -->
          <!-- <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
          </ul> -->
          
          <!-- The slideshow -->
          <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="images/sge1.jpg" alt="Floer 1" width="800" class="d-block w-100" height="600">
              </div>
              <div class="carousel-item">
                <img src="images/sge2.jpg" alt="Chicago" width="800" class="d-block w-100" height="600">
              </div>
              <div class="carousel-item">
                <img src="images/sge3.jpg" alt="New York" width="800" class="d-block w-100" height="600">
              </div>
          </div>
  
          <!-- Left and right controls -->
          <a class="carousel-control-prev" href="#demo" data-slide="prev" role="button">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          </a>
          <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
          </a>
     </div> <!--Fin de carousel-->
      
      <section style="background-color: tan; padding: 20px;">
        <h1 style="text-align: center; color: red;">Qui sommes nous</h1>
        <p>Crée en janvier 2002 par deux anciens cadres de BERGEON-SENEGAL :

- M. CHEIKH BOUNAMA TRAORE : Directeur technique puis directeur Général de BERGEON
- M. AMADOU BASSE Conducteur des travaux puis Directeur technique de Bergeon.

SGE-EQUIP ne cesse de grandir. même si elle n’a pas encore atteint l’âge de la maturité, elle a déjà conquis toute sa place dans le domaine de ses différentes professions que sont :

- Le froid et la climatisation
- La plomberie Sanitaire
- Les applications de l’Energie Solaire</p>
      </section>
  </div> <!-- Fin de container-fluid -->

    <?php // endif ?>     
</body>
</html>