<?php
session_start() ;
    include('config.php') ; 

    if (isset($_POST['email'])) {
        $query = "SELECT * FROM utilisateurs_administrateurs WHERE email=:email" ;
       $rep = $conn->prepare($query) ;

    //$pwd = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT) ;
    
    $rep->execute(array(':email'=>$_POST['email'])) ;
    $result = $rep->fetch() ;

    $verifyPassword = password_verify($_POST['mot_de_passe'], $result['mot_de_passe']) ;

    if (!$result) {
       $msg = "<p class='text-white bg-dark p-3 mt-3'>Mauvais identifiant ou mot de passe </p>" ;
    }
    else {
        if($verifyPassword) {
            if ($result['user_admin'] === 'utilisateur') {
                /* On a deux choix pour acceder a la page principale . 1.choix : on le dirige avec header(location:...) function ou bien on lui demande de cliquer un lien pour acceder a la principale */
                //header('location:index.php) ;
               $msg = "<p class='text-white bg-dark p-3 mt-3'> Connexion reussi ! <a href='index.php'> Cliquer pour aller a la page principale </a> </p>" ;
               $_SESSION['prenom'] = $result['prenom'] ;
               $_SESSION['nom'] = $result['nom'] ;
               $_SESSION['id'] = $result['id'] ;
               if(isset($_POST['connexionAutomatique'])) {
                setcookie('cookiePrenom', $_SESSION['prenom'], time()+24*80000) ;
                setcookie('cookieNom', $_SESSION['nom'], time()+24*80000) ;
                setcookie('cookieId', $_SESSION['id'], time()+24*80000) ;
            }
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
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <p><a href="register.php" class="btn btn-success btn-md my-4">Enregistrez-vous ?</a></p>
            </div>
            <div class="col-sm-8">
            <h2 class="btn btn-success my-4 btn-block" style="cursor:none ;">Connect Please </h2>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                  <div class="form-group">
                    <div class="row">
                        <label for="email" class="col-sm-4"> Your email : </label>
                        <input type="text" name="email" placeholder="Your email" id="email" required class="col-sm-8 form-control"> 
                        </div>
                    
                    </div>

                    <div class="form-group">
                       <div class="row">                        
                        <label for="mot_de_passe" class="col-sm-4"> Votre mot de passe : </label>
                        <input type="password" name="mot_de_passe" placeholder="votre mot de passe" id="mot_de_passe" required class="col-sm-8 form-control">
                        </div>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="connexionAutomatique">Se souvenir de moi !
                        </label>
                    </div>
                    <input type="submit" name="submit" value="connexion" class="btn btn-success btn-block">
                </form>
                <?php if(isset($msg)) { echo $msg ;} ; ?>
            </div>
        </div>
    </div>
    
</body>
</html>