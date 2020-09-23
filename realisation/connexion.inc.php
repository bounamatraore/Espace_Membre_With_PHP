<?php

 $conn = new PDO("mysql:host=localhost; dbname=file_example", "root","") ;

 try {
    //echo "Connexion reussie a la base de donnee !" ;
}
catch (PDOException $err) {
    die('Erreur de connexion '.$err->getMessage()) ;
}

?>