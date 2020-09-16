<?php 
    session_start() ;
    if(isset($_SESSION['prenom']) && isset($_SESSION['nom']) && isset($_SESSION['id'])) {
    unset($_SESSION['prenom']) ;
    unset($_SESSION['nom']) ;
    unset($_SESSION['id']) ;
    session_destroy() ;
    header('location:index.php') ;
}
?>