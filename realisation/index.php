<?php 
include '../config/chemin.inc.php' ;
include '../connexion.inc.php' ;
//Recuperation des donnees dans la base de donnee
$query = $conn->prepare("SELECT * FROM fichiers;") ;
$query->execute() ;
$query->bind_result($id , $nom , $description) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Realisation</title>
</head>
<body>
    <?php include '../config/nav.inc.php' ?>

    <div class="container mt-4">
        <div class="row">
    <?php 
     while ($query->fetch()) : ?>

            <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
            <figure><a href ="index.php?description=realisation"><img src="<?php echo $FOLDER_PATH ;?>/images/<?php echo $nom ?>" alt ="image" class="mh-100 mw-100"  style="width: 300px; height: 300px;"> </a>
     <figcaption><strong><i>Description</i></strong> <br> <?php echo $description ; ?> 
           </div>
            </div>
     <?php endwhile ?>
     </div>
    </div>
    
</body>
</html>