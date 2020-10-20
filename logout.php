<?php 
    session_start() ;
    if(isset($_SESSION['prenom']) || isset($_SESSION['nom']) || isset($_SESSION['id']) || isset($_COOKIE["prenom"]) || isset($_COOKIE["nom"]) || isset($_COOKIE["email"]) || isset($_COOKIE["id"])) {
    unset($_SESSION['prenom']) ;
    unset($_SESSION['nom']) ;
    unset($_SESSION['id']) ;

    setcookie("prenom","", time()-10);
    unset($_COOKIE["prenom"]);

    setcookie("nom","", time()-10);
    unset($_COOKIE["nom"]);

    setcookie("email","", time()-10);
    unset($_COOKIE["email"]);

    setcookie("id","", time()-10);
    unset($_COOKIE["id"]);
    
    session_destroy() ;
    header('location:index.php') ;
}
?>