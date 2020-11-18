<?php
    // Appel au fichier de connection et de la fonction de validation
    include("../config/connection_database.php");
    include("../input_validation.php");
    
    // Requete de mise a jour des realisations
    // $title = $result->title;
    // $description = $result->description;
    // $date_start = $result->date_start;
    // $date_end = $result->date_end;
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
                $query = $conn->prepare("UPDATE realisations SET title=:title, description = :description, date_start = :date_start, date_end = :date_end WHERE id=:id;" );
                $result =  $query->execute([":title" => $title, ":description" => $description , ":date_start" => $date_start, ":date_end" => $date_end, ":id"=>$_POST["id"]]) ;
                if($result) {
                    echo "La modification est fait avec success";
                    $title = $description = $date_start = $date_end = "";
                }
                else {
                    echo "Une erreur est survenue lors de la modification";
                }
            }
    }

?>
