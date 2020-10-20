<?php
    session_start();
    include('config.php') ; 
    include("fonction.php") ;
    $email = "" ;
    $passe = ""; 
    $errorEmail = $errorMotDePasse = "" ;
    if ($_SERVER["REQUEST_METHOD"] === "POST"){
        $email = valider_champ($_POST["email"]) ;
        $passe = valider_champ($_POST["passe"]) ;
        if(empty($email)) {
            $errorEmail = "L'email ne doit pas etre vide !" ;
        }
        else {
            $email = $_POST["email"] ;
        }
        if(empty($passe)) {
            $errorMotDePasse = "Le mot de passe doit etre renseigné" ;
        }
        else {
            $passe = $_POST["passe"];
        }
        if ($errorMotDePasse === "" && $errorEmail ==="") {
            $query = "SELECT * FROM utilisateurs_administrateurs WHERE email=:email";
           $rep = $conn->prepare($query) ;
           $rep->execute(array(":email"=>$email)) ;
     
        //$pwd = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT) ;
        //if ($rep->execute(array($email))){
             //while ($result = $rep->fetch()) {
            $result = $rep->fetch() ;
            //print_r($result) ; 
                if (!$result) {
                   $msg = "<p class='text-white bg-dark p-3 mt-3'>Mauvais identifiant ou mot de passe </p>" ;
                }
                else {
                   
                    if(password_verify($passe, $result["mot_de_passe"])) {
                        if ($result['user_admin'] === 'utilisateur') {
                            /* On a deux choix pour acceder a la page principale . 1.choix : on le dirige avec header(location:...) function ou bien on lui demande de cliquer un lien pour acceder a la principale */
                            //header('location:index.php) ;
                           //$msg = "<p class='text-white bg-dark p-3 mt-3'> Connexion reussi ! <a href='index.php'> Cliquer pour aller a la page principale </a> </p>" ;
                           header("location:index.php");
                           $_SESSION['prenom'] = $result['prenom'] ;
                           $_SESSION["nom"] = $result['nom'] ;
                           $_SESSION['id'] = $result['id'] ;
                           $_SESSION["email"] = $result["email"];
                           if (isset($_POST["connexionAutomatique"])) {
                                setcookie("prenom", $_SESSION["prenom"], time()+8600*30);
                                setcookie("nom", $_SESSION["nom"], time()+8600*30);
                                setcookie("email", $_SESSION["email"], time()+8600*30);
                                setcookie("id", $_SESSION["id"], time()+8600*30);
                           }                        
                            //    if(isset($_POST['connexionAutomatique'])) {
                            //         setcookie('cookiePrenom', $_SESSION['prenom'], time()+24*80000) ;
                            //         setcookie('cookieNom', $_SESSION['nom'], time()+24*80000) ;
                            //         setcookie('cookieId', $_SESSION['id'], time()+24*80000) ;
                            //     }
                        }
                        else {
                             /* On a deux choix pour acceder a la page principale . 1.choix : on le dirige avec header(location:...) function ou bien on lui demande de cliquer un lien pour acceder a la principale */
                            //header('location:index.php) ;
                            $msg = "<p class='text-white bg-dark p-3 mt-3'> Connexion reussi ! <a href='admin/home.php'> Cliquer pour aller a la page administrateur </a> </p>" ;
                        }
                       }
                        else
                       {
                       $msg = "<p class='text-white bg-dark p-3 mt-3 text-center'> Mauvais identifiant ou mot de passe </p>" ;
                       }
                   }
            //}
        }
        //}
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel='stylesheet' href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel='stylesheet' href="style.css">
    <style>
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if(isset($_COOKIE["connexionAutomatique"]) && $_COOKIE["connexionAutomatique"] !== "") : ?>
        <?php header("location:index.php"); ?>
        <?php else : ?>
        <div class="row">
            <div class="col-sm-4">
                <p><a href="register.php" class="btn btn-success btn-md my-4">Enregistrez-vous ?</a></p>
            </div>
            <div class="col-sm-8">
            <h2 class="btn btn-success my-4 btn-block" style="cursor:none ;">Connect Please </h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
        
                <div class="form-group">
                    <div class="row">
                        <label for="email" class="col-sm-4"> Votre email : </label>
                        <input type="text" name="email" value="<?php if(isset($email)) echo $email ; ?>" placeholder="Votre email" id="email" class="col-sm-8 form-control">
                    </div>
                    <div class="error"><?php if(isset($errorEmail)){ echo $errorEmail;} ;?></div>             
                </div>

                    <div class="form-group">
                       <div class="row">                        
                        <label for="passe" class="col-sm-4"> Votre mot de passe : </label>
                        <input type="password" name="passe"   placeholder="votre mot de passe" id="passe"  class="col-sm-8 form-control">
                        </div>
                        <div class="error"><?php if(isset($errorMotDePasse)){ echo $errorMotDePasse;} ;?></div>  
                    </div>
                    <div class="form-check" id="connexionAutomatique">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="connexionAutomatique">Se souvenir de moi !
                        </label>
                    </div>
                    <input type="submit" name="soumission" value="connexion" class="btn btn-success btn-block">
                </form>
                
                <?php if(isset($msg)) { echo $msg ;} ; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    
</body>
</html>

<?php

    ?>
