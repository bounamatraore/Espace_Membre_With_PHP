<?php 
include("../config/path.php");
include("../config/connection_database.php");
//Recuperation des donnees dans la base de donnee
$query = $conn->prepare("SELECT * FROM fichiers;") ;
$query->execute() ;
$results = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Realisation</title>
</head>
<body>
    <?php include '../config/nav.php' ?>

    <div class="container mt-4">
        <div class="row">
    <?php 
     foreach($results as $result) : ?>

            <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
            <figure><a href ="index.php?description=<?php echo $result->id;?> "><img src="<?php echo $FOLDER_PATH ;?>/images/<?php echo $result->nom ?>" alt ="image" class="mh-100 mw-100"  style="width: 300px; height: 300px;"> </a>
     <figcaption><strong><i>Description</i></strong> <br> <?php echo $result->description ; ?> 
           </div>
            </div>
     <?php endforeach ?>
     </div>
    </div>    
</body>
</html>