<?php
 include('config.php') ;

 $sq = "SELECT * FROM utilisateurs_administrateurs;";
 $sql = $conn->prepare($sq) ;
 $result = $sql->execute([]) ;
 $results = $sql->fetch() ;
 var_dump($results) ;
?>