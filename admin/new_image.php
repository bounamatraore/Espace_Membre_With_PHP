<?php  
    //Inclure le fichier de connexion de la base de donnee
   include("../config/connection_database.php");
   include("../config/path.php");
   
   if(isset($_POST["new_image"])) {
       $new_image = $_POST["new_image"];
   }
   else {
       header("location:$FOLDER_PATH/admin/");
   }
   $fileError[] = "";
   if($_SERVER["REQUEST_METHOD"] === "POST"){
       if(isset($_FILES["myFile"])) {
    $upload = "../images/" ;
    $imgFile = $upload . basename($_FILES['myFile']['name']) ;
    //$ok = true ;

    //On verifie d'abord si l'utilisateur telechargera une vrai image 
    $fileImageType = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    
    
    if (move_uploaded_file($_FILES['myFile']['tmp_name'], $imgFile)) {
        // echo "File ". $_FILES['myFile']['name'] ." téléchargé avec succès.\n";
        // echo "Affichage du contenu\n";
        $ok = true ;
        //readfile($_FILES['myFile']['tmp_name']);
    }
    else {
        echo "Choisir une image : ";
        echo "Nom du fichier : '". $_FILES['myFile']['tmp_name'] . "'.";
        $ok = false ;
     }
    // print_r($_FILES);
    
    if ($ok) {
    $file =  $_FILES['myFile']['name'] ;
     $query =  $conn->prepare("INSERT INTO image_realisations(id_realisation, nom) VALUES (:id_realisation, :nom);") ;
    $result = $query->execute([":id_realisation" =>$new_image, ":nom"=>$file]);    
    header("location:index.php");
    }
    else {
        echo " Erreur d'insertion" ;
    }
    }
  }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de nouvelle image</title>
    <?php include("../config/head.php"); ?>
  <style>
      * {
          box-sizing: border-box ;
      }
    
  </style>
  <link rel="stylesheet" href="style.scss">
</head>
<body>
      <div class="container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                
                <input type="hidden" name="MAX_FILE_SIZE" value="3000000" /> 
                <div class="form-group m-2">
                    <input type="file" name="myFile" id="myFile" class="form-control">
                </div>
                    <input type="hidden" name="new_image" id="new_image" value="<?php if(isset($new_image)) { echo $new_image; } ?>">
                
                
            
                <input type="submit" name="submit" value="Ajouter image" class="btn btn-success">
            </form>
            <button type="button" class="btn btn-danger"><a href="<?php echo $FOLDER_PATH;?>/admin/" class="nav-link text-white">Retour</a></button>
        </div>
</body>
</html>