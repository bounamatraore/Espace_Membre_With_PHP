<?php 
    include("../config/connection_database.php");
    include("../input_validation.php");
    $title = $description = $date_start = $date_end = "";
    $error[] = "" ;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = valider_champ($_POST["title"]);
        $description = valider_champ($_POST["description"]);
        $date_start = valider_champ($_POST["date_start"]);
        $date_end = valider_champ($_POST["date_end"]);

           if(empty($title)) {
               $error["titleError"] = "Le titre doit etre renseigné";
           } 
           else {
               $title = $_POST["title"]; 
           }
           if(empty($description)) {
            $error["descriptionError"] = "Veuillez écrire une description";
            } 
            else {
            $description = $_POST["description"]; 
            }
            if(empty($date_start)) {
                $error["date_startError"] = "Choisisez une date de début";
            } 
                else {
                $date_start = $_POST["date_start"]; 
            }
            if(empty($date_end)) {
                $error["date_endError"] = "Choisisez une date de fin";
            } 
                else {
                $date_end = $_POST["date_end"]; 
                if ($date_start > $date_end) {
                    $error["date_endError"] = "La date de fin doit etre supérieure a la date de début";
                }
            }
            
            if(empty($error["titleError"]) && empty($error["descriptionError"]) && empty($error["date_startError"]) && empty($error["date_endError"])) {
                $query = $conn->prepare("INSERT INTO realisations(title, description, date_start, date_end) VALUES(:title, :description, :date_start, :date_end);");
                $result =  $query->execute([":title" => $title, ":description" => $description , ":date_start" => $date_start, ":date_end" => $date_end]) ;
                if($result) {
                    echo "L'ajout est fait avec success";
                    $title = $description = $date_start = $date_end = "";
                }
                else {
                    echo "Erreur d'inserssion";
                }
            }

    }

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Ajouter une nouvelle realisation</title>
     <?php include("../config/head.php"); ?>
     <style>
        .error {color: red;}
     </style>
 </head>
 <body style="background-color: black; color:white">
    <div class="container m-4">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <label for="title">Titre </label>
                <input type="text" class="form-control" id="title" name="title" value="<?php if(isset($title)) { echo $title;} ?>">
                <div class="error"><?php if(isset($error["titleError"])) { echo $error["titleError"];} ?></div>
            </div>
            <div class="form-group">
                <label for="description">Description: </label>
                <textarea name="description" id="description" class="form-control" rows="8"><?php if(isset($description)) { echo $description;} ?></textarea>
                <div class="error">
                <?php if(isset($error["descriptionError"])) { echo $error["descriptionError"];} ?></div>
            </div>
            <div class="form-group">
                <label for="date_start">Date de d&eacute;but: </label>
                <input type="date" class="form-control" id="date_start" name="date_start" value="<?php if(isset($date_start)) { echo $date_start;} ?>">
                <div class="error"><?php if(isset($error["date_startError"])) { echo $error["date_startError"];} ?></div>
            </div>
            <div class="form-group">
                <label for="date_end">Date de fin: </label>
                <input type="date" class="form-control" id="date_end" name="date_end" value="<?php if(isset($date_end)) { echo $date_end;} ?>">
                <div class="error"><?php if(isset($error["date_endError"])) { echo $error["date_endError"];} ?></div>
            </div>
            <input type="submit" value="Valider l'ajout" name="submit" class="btn btn-warning btn-lg"> 
            <button class="btn btn-danger btn-xs" style="float: right"><a href="index.php" class="nav-link">Retour</a></button>
        </form>  
    </div>      
    <?php  
        //Liberer la connexion
        $conn = null ; 
    ?>
 </body>
 </html>