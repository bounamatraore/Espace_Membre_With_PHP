<?php
    // Appel au fichier de connection et de la fonction de validation
    include("../config/connection_database.php");
    include("../input_validation.php");
     //Recuperation de la donnee selon l'id passe dans le formulaire
        if(isset($_POST["update"])){
            $id = $_POST["update"];
            $query = $conn->prepare("SELECT * FROM realisations WHERE id = :id;");
            $query->execute([":id"=> $id]);
            $result = $query->fetch(PDO::FETCH_OBJ);
            $title = $result->title;
            $description = $result->description;
            $date_start = $result->date_start;
            $date_end = $result->date_end;
        }

        $error[] = "" ; // On stocke les erreurs dans le tableau $error
        //On verifie que la methode d'envoie est du type Post
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            //On verifie que les variables sont definis
            if(isset($_POST["title"]) && isset($_POST["description"]) && isset($_POST["date_start"]) && isset($_POST["date_end"])){
            //On recupere chaque valeur et on les stocke dans des variables respectives 
            $title = valider_champ($_POST["title"]);
            $description = valider_champ($_POST["description"]);
            $date_start = valider_champ($_POST["date_start"]);
            $date_end = valider_champ($_POST["date_end"]);
            //On verifie que chaque champ n'est pas vide
           if(empty($title)) {
               $error["titleError"] = "Le titre doit etre renseigné";
           }
        //    else {
        //        $title = $_POST["title"];
        //    }
           if(empty($description)) {
            $error["descriptionError"] = "Veuillez écrire une description";
            }
            // else {
            // $description = $_POST["description"];
            // }
            if(empty($date_start)) {
                $error["date_startError"] = "Choisisez une date de début";
            }
            //     else {
            //     $date_start = $_POST["date_start"];
            // }
            if(empty($date_end)) {
                $error["date_endError"] = "Choisisez une date de fin";
            }
                else {
                //$date_end = $_POST["date_end"];
                if ($date_end < $date_start) {
                    $error["date_endError"] = "La date de fin doit etre supérieure a la date de début";
                }
            }
            //On verifie que tous les champs sont corrects
            if(empty($error["titleError"]) && empty($error["descriptionError"]) && empty($error["date_startError"]) && empty($error["date_endError"])) {
                //Requete de mise a jour selon l'id passe en parametre 
                $query = $conn->prepare("UPDATE realisations SET title = :title, description = :description, date_start = :date_start, date_end = :date_end WHERE id = :id;" );

                        $result_m =  $query->execute([":title" => $title, ":description" => $description , ":date_start" => $date_start, ":date_end" => $date_end, ":id"=>$id]) ;
                    if($result_m) {
                        header("location:index.php");
                    }
                    else {
                        echo "Une erreur est survenue lors de la modification";
                    }
            }                    
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($title)){ echo $title;} else {
        echo "Modifier";
    } ?></title>
    <?php include("../config/head.php"); ?>
</head>
<body>
    <div class="container m-4">
        <form action="<?php echo htmlspecialchars('edit.php');?>" method="post">
            <div class="form-group">
                <label for="title">Titre </label>
                <input type="hidden" name="update" value="<?php if(isset($id))  echo  $id; ?>">
                <input type="text" class="form-control" id="title" name="title" value="<?php  if(isset($title)) echo $title; ?>">
                <div class="error"><?php if(isset($error["titleError"])) { echo $error["titleError"];} ?></div>
            </div>
            <div class="form-group">
                <label for="description">Description: </label>
                <textarea name="description" id="description" class="form-control" rows="8"><?php if(isset($description)) echo $description;?></textarea>
                <div class="error">
                <?php if(isset($error["descriptionError"])) { echo $error["descriptionError"];} ?></div>
            </div>
            <div class="form-group">
                <label for="date_start">Date de d&eacute;but: </label>
                <input type="date" class="form-control" id="date_start" name="date_start" value="<?php if(isset($date_start)) echo $date_start; ?>">
                <div class="error"><?php if(isset($error["date_startError"])) { echo $error["date_startError"];}?></div>
            </div>
            <div class="form-group">
                <label for="date_end">Date de fin: </label>
                <input type="date" class="form-control" id="date_end" name="date_end" value="<?php if(isset($date_end)) echo $date_end;?>">
                <div class="error"><?php if(isset($error["date_endError"])) { echo $error["date_endError"];} ?></div>
            </div>
            <input type="submit" value="Valider la modification" name="submit" class="btn btn-warning btn-lg">
            <button class="btn btn-danger btn-xs" style="float: right"><a href="index.php" class="nav-link text-white">Annuler la modification</a></button>
        </form>
      </div>
</body>
</html>