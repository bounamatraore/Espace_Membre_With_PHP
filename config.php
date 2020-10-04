<?php

  try {
    $conn = new PDO('mysql:host=localhost;dbname=espace_membre', 'root', '') ;
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION) ;
 }
 catch (PDOException $err) {
     die('Erreur de connexion '.$err->getMessage()) ;
 }
?>