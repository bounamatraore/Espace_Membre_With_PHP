<?php  
    //Inclure le fichier de connexion de la base de donnee
   include("../config/connection_database.php");
   include("../config/path.php");
   
   if(isset($_POST["edit_image"])) {
       $edit_image= $_POST["edit_image"];
        $query_edit = $conn->prepare("SELECT * FROM image_realisations WHERE id=:id_edit;");
        $query_edit->execute([":id_edit"=>$edit_image]);
        $result_edit = $query_edit->fetch(PDO::FETCH_OBJ);
        $nom_image = $result_edit->nom;
   }
   else {
       header("location:$FOLDER_PATH/admin/");
   }
   $fileError[] = "";
   //if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST["submit"]) && isset($_FILES["myFile"])) {
    $upload = "../images/" ;
    $imgFiles = $upload . basename($_FILES['myFile']['name']) ;
    $str_replace = ["%", ";","="];
    $imgFile = str_replace($str_replace, "_",$imgFiles);
    $tmpNameFile = $_FILES["myFile"]["tmp_name"];
    $verify = @getimagesize($tmpNameFile);
    //$ok = true ;

    //On verifie d'abord si l'utilisateur telechargera une vrai image 
    $fileImageType = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION));
    
    //On verifie le fichier qu'on nous envoie , si c'est une image
        //$verify = getimagesize($_FILES["myFile"]["tmp_name"]);
     if($verify == false) {
         $fileError["err"] = "Veuillez choisir une image valide!";
     } 
     
     if(file_exists($imgFile)) {
         $fileError["err"] = "Le fichier existe deja";
     }
    
    if (empty($fileError["err"])) {
        // On va proceder au telechargement du fichier 
        if (move_uploaded_file($tmpNameFile, $imgFile)) {
            $files =  $_FILES['myFile']['name'] ;
            $file = str_replace($str_replace, "_",$files);
            //Requete de mise a jour de l'image
            $query =  $conn->prepare("UPDATE image_realisations SET nom=:nom WHERE id=:id;") ;
            $result = $query->execute([":nom" =>$file, ":id"=>$edit_image]); 
            if($result) {
                unlink("../images/$nom_image");
            }  
            header("location:index.php");
        }
        else {
            // echo "Choisir une image : ";
            // echo "Nom du fichier : '". $_FILES['myFile']['tmp_name'] . "'.";
            //$ok = false ;
           echo "Erreur de mise a jour";
        }
    }
    //else {
        //echo "Erreur d'insertion" ;
    // }
    }
  //}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une image</title>
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
                    <input type="file" name="myFile" id="myFile" accept=".jpg, .jpeg, .png" class="form-control" value="<?php if(isset($nom_image)) echo '../images/'.$nom_image; ?>">
                    <div class="error"><?php if(isset($fileError["err"])){echo $fileError["err"];};?></div>
                </div>
                    <input type="hidden" name="edit_image" id="edit_image" value="<?php if(isset($edit_image)) { echo $edit_image; } ?>">
                
                
            
                <input type="submit" name="submit" value="Modifier Image" class="btn btn-success">
            </form>
            <button type="button" class="btn btn-danger"><a href="<?php echo $FOLDER_PATH;?>/admin/" class="nav-link text-white">Retour</a></button>
        </div>
</body>
</html>