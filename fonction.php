<?php 
      function ucwLower($lettre) {
          return ucfirst(strtolower($lettre)) ;
      }
    function valider_champ($donnee) {
        $donnee = trim($donnee) ;
        $donnee = stripslashes($donnee) ;
        $donnee = htmlspecialchars($donnee) ;
        return $donnee ;
    }     
 ?>