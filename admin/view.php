<?php
    include("../config/path.php");
    include("../config/connection_database.php");
    if(isset($_POST["view"])){
        $view = $_POST["view"];
        $query = $conn->prepare("SELECT * FROM realisations WHERE id = :id;");
        $query->execute([":id"=>$view]);
        $result = $query->fetch(PDO::FETCH_OBJ);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($result->title)) {echo $result->title;}  else {echo "Voir realisation";} ?></title>
    <?php include("../config/head.php"); ?>
    <style>
        img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>D&eacute;tail </h1>
        <div class="card">
            <div class="body">
                <div class="title text-center">
                    <?php if(isset($result->title)) echo $result->title; ?> 
                </div>
                <div class="card">
                    <div class="card-header">
                        Description
                    </div>
                    <div class="card-body">
                        <div class="card-text"><?php if(isset($result->description)) echo $result->description;?></div>
                    </div>
                </div>
                <div class="card-text">
                   <strong> Date de d&eacute;but:</strong> <?php if(isset($result->date_start)) echo $result->date_start;?> 
                </div>
                <div class="card-text">
                   <strong> Date de fin:</strong> <?php if(isset($result->date_end)) echo $result->date_end;?> 
                </div>
            </div>
        </div>

         <?php
        if(isset($_POST["view"])) {
            $query_image = $conn->prepare("SELECT realisations.id AS id, image_realisations.id AS id_image, image_realisations.nom AS nomImage, image_realisations.id_realisation AS id_realisation FROM image_realisations INNER JOIN realisations ON realisations.id = image_realisations.id_realisation WHERE image_realisations.id_realisation = :id_realisation;");
            $query_image->execute([":id_realisation"=>$view]);
            $resultImages = $query_image->fetchAll(PDO::FETCH_OBJ);
        }
        ?>

        <div class="row">
            <?php foreach($resultImages as $resultImage): ?>

              <div class="col-sm.* col-md.*">
                <div class="thumbnail">
                  <figure class="mx-4 my-2"><img src="<?php echo $FOLDER_PATH ;?>/images/<?php echo $resultImage->nomImage ?>" alt ="image" class="mh-100 mw-100"  style="width: 100px; height: 100px;">
                 

                 <!-- Formulaire de Post pour supprimer une image -->
                  
                  <form action="<?php echo htmlspecialchars('delete_image.php'); ?>" method="post">
                  <input type="hidden" name="delete_image" id="delete_image" value="<?php echo $resultImage->id_image; ?>">
                  <input type="submit" name="submit" id="submit" value="Supprimer" class="btn btn-outline">
                  </form>
                  <!-- Formulaire de post pour modifier une image  -->
                  <form action="<?php echo htmlspecialchars('edit_image.php'); ?>" method="post">
                  <input type="hidden" name="edit_image" id="edit_image" value="<?php echo $resultImage->id_image; ?>">
                  <input type="submit" name="edit_submit" id="edit_submit" value="Modifier" class="btn btn-outline">
                  </form>
                  </figure>
                </div>
              </div>

            <?php endforeach;?>
        </div>
        <button class="btn btn-danger btn-xs m-3" style="float: right"><a href="index.php" class="nav-link text-white">Retour</a></button>
    </div> 
        
</body>
</html>