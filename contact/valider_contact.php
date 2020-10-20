<?php 
$conn = new PDO('mysql: host=localhost;dbname=espace_membre', 'root',"") ;

try {

}
catch (PDOException $err) {
    die('Erreur de connexion '.$err->getMessage()) ;
}

include '../input_validation.php' ;
    $contact = [ 
        "prenom" => "",
        "nom" => "",
        "email" => "" ,
        "prenomErr" => "",
        "nomErr" => "",
        "emailErr" => "",
        "reussi" => 0
    ] ;

   //$msg = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $contact['prenom'] = valider_champ($_POST['prenom']) ;
        $contact['nom']    = valider_champ($_POST['nom']) ;
        $contact['email']  = valider_champ($_POST['email']) ;

        if (empty($contact['prenom'])) {
            $contact['prenomErr'] = 'Le prenom ne doit pas etre vide ! ' ;
            $contact["reussi"] = 0  ;
        }
        else {
            if (!preg_match('/^[a-zA-Z ]{2,}$/' , $contact['prenom'])) {
                $contact['prenomErr'] = 'Le prenom doit comporter que des lettres , des espaces et minimum de 2 caracacteres !' ;
                $contact['reussi'] = 0 ;
            }
           //$msg .= " Votre prenom est : {$contact['prenom']} <br>" ;
        }

        if (empty($contact['nom'])) {
            $contact['nomErr'] = 'Le nom ne doit pas etre vide ! ' ;
            $contact["reussi"] = 0  ;
        }
        else {
            if (!preg_match('/^[a-zA-Z ]{2,}$/' , $contact['nom'])) {
                $contact['nomErr'] = 'Le nom doit comporter que des lettres , des espaces et minimum de 2 caracacteres ! ' ;
                $contact['reussi'] = 0 ;
            }
           ////$msg .= " Votre nom est : {$contact['nom']} <br>" ;
        }

        if (empty($contact['email'])) {
            $contact['emailErr'] = 'L\'email ne doit pas etre vide !' ;
            $contact["reussi"] = 0  ;
        }
        else {
            if (!filter_var($contact['email'] , FILTER_VALIDATE_EMAIL)) {
                $contact['emailErr'] = 'L\'email est invalide ! ' ;
                $contact['reussi'] = 0 ;
            }
           //$msg .= " Votre email est : {$contact['email']}<br>" ;
        }
        echo json_encode($contact) ;

        if ($contact['reussi'] !== 0) {
          $query = $conn->prepare('INSERT INTO contact(prenom, nom, email) VALUES (:prenom, :nom, :email') ;
          $query->bindParam(':prenom', $contact['prenom']) ;
          $query->bindParam(':nom', $contact['nom']) ;
          $query->bindParam(':email', $contact['email']) ;
          $query->execute() ;
        }
       
    }

?>