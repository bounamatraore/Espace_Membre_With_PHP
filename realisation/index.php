<?php 
include("../config/path.php");
include("../config/connection_database.php");
//Recuperation des donnees dans la base de donnee
$query = $conn->prepare("SELECT * FROM realisations;") ;
$query->execute() ;
$results = $query->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Realisation</title>
    <?php include("../config/head.php"); ?>
</head>
<body>
    <?php include '../config/nav.php'; ?>

    <div class="container mt-4">
        <div class="row">
    <?php foreach($results as $result) : ?>

      <?php  
        
        $queryImage = $conn->prepare("SELECT  realisations.id, realisations.title,image_realisations.id_realisation, image_realisations.nom FROM image_realisations INNER JOIN realisations ON realisations.id = image_realisations.id_realisation WHERE image_realisations.id_realisation = :realisationId");
        $queryImage->execute(array(":realisationId"=>$result->id));
        $resultImage = $queryImage->fetch(PDO::FETCH_OBJ);
        ?>


        <?php if(isset($resultImage->id_realisation)) :?>
            <div class="col-sm-6 col-md-4">
            <div class="thumbnail">
            <form action="<?php echo str_replace(" ","+",htmlspecialchars('voir_realisation/#'.$result->title));?>" method="post">
            <input type="hidden" name="view_realisation" value="<?php echo htmlspecialchars($result->id);?>">
            <button type="submit" name="submit" id="submit" style="background-color: transparent; cursor: pointer; border: none; outline: none;">
            <figure><img src="<?php echo $FOLDER_PATH ;?>/images/<?php echo $resultImage->nom ?>" alt ="image" title="voir cette realisation" class="mh-100 mw-100"  style="width: 300px; height: 300px;">
            <figcaption><?php echo $resultImage->title ; ?> 
            </button>
            </form>
     
        </figure>
        
            
           </div>
           
            </div>
         <?php endif; ?>
     <?php endforeach ?>
     </div>
    </div>    
</body>
</html>