<?php
//Fichier d connexion
include('config.php') ;
//inclusion de la fonction
include('fonction.php') ;
//Initialisation des valeurs 
$prenom = $nom = $email = $mot_de_passe = "" ;
$nomErr = $prenomErr = $emailErr = $mot_de_passeErr = "" ;
$ok = 1 ;

 if($_SERVER["REQUEST_METHOD"] == "POST") {
     //verifiaction du prenom
     $prenom = valider_champ($_POST['prenom']) ;
     $nom = valider_champ($_POST['nom']) ;
     $email = valider_champ($_POST['email']) ;
     $mot_de_passe = valider_champ($_POST['mot_de_passe']) ;
     if(empty($prenom)) {
         $prenomErr = " Le prenom ne doit pas etre vide ?" ;
         $ok = 0 ; 
     }
     else {
        //Verifier si le nom contient des lettres et des espaces vides
     if (!preg_match("/^[a-zA-Z ]*$/", $prenom)) {
            $prenomErr = " Seulement les lettres et les espaces qui sont autorises" ;
            $ok = 0 ;
        }
     }

     //verification du nom
     if(empty($nom)) {
        $nomErr = "Le nom ne doit pas etre vide ?" ;
        $ok = 0 ; 
    }
    else {
       //Verifier si le nom contient des lettres et des espaces vides
       if (!preg_match("/^[a-zA-Z ]*$/", $nom)) {
           $nomErr = " Seulement les lettres et les espaces qui sont autorises" ;
           $ok = 0 ;
       }
    } // Fin validation nom

 // verifiaction de l'email  
    if (empty($email)) {
        $emailErr = " L'email ne doit pas etre vide ";
        $ok = 0 ;
    }
    else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = " Email invalide ";
          $ok = 0 ;
        }
    } //Fin validation email

    // verification du mot de passe 
    if (empty($mot_de_passe)) {
        $mot_de_passeErr = " Le mot de passe ne doit pas etre vide " ;
        $ok = 0 ;
    }
    else {
        if (!preg_match('/^[a-zA-Z-0-9]{6,20}$/', $mot_de_passe))  {
            $mot_de_passeErr = "Le mot de passe est invalide : il doit comporter que des lettres (majuscule ou minuscule) , des chiffres !" ;
            $ok = 0 ;
        }
       
    }

/*Selection des donnees pour comparer avec ce que l'utilisateur va entrer , si le prenom, le nom et l'email sont identique on lui envoie un message qu'il avait cree un compte il y a de cela des annees puis il revient a nouveau, s'il oublie son mot de passe on envoie des messages(de changement de mot de passe ou de se connecter s'il se souvient) */    
    $query = "SELECT * FROM utilisateurs_administrateurs WHERE email=:email ;" ;
    $rep = $conn->prepare($query) ;
    $rep->execute(array(':email' => $email)) ;
    $result = $rep->fetchAll() ;

     if (!$result)   {
        
        $querys = $conn->prepare("INSERT INTO utilisateurs_administrateurs(prenom, nom , email ,mot_de_passe) VALUES(:prenom, :nom , :email , :mot_de_passe);") ;
    //Nous allons hacher le nouveau mot de passe pour la securite des informations de l'utilistaeur 
        $mot_de_passe_hacher = password_hash($mot_de_passe, PASSWORD_DEFAULT) ;

    // Enregistrer la premiere lettre du prenom et du nom en majuscule puis l'email en minuscule 
        $prenomUcwlower = ucwLower($prenom) ;
        $nomUcwlower =  ucwLower($nom) ;
        $emailLower = strtolower($email) ;
    //Liaisons des donnees 
          $querys->bindParam(':prenom' , $prenomUcwlower ) ;
          $querys->bindParam(':nom' ,$nomUcwlower) ;
          $querys->bindParam(':email' , $emailLower) ;
          $querys->bindParam(':mot_de_passe' , $mot_de_passe_hacher) ;
    // execution de la requete
      if ( $ok !== 0) {
        $querys->execute() ; 

        //On verifie si l'enregistrement a bien ete fait , on affiche on message a l'utilisateur qu'il est inscrit avec success et on lui demande de se connecter avec un lien 
        if ($querys) {
            echo "<p class='text-warning p-3 bg-dark'>Vous etes inscrit avec success ! <a href=\"loging.php\" class=\"btn btn-link\">cliquer ici pour se connecter </a> </p> " ;
    // On vide tous les champs remplie par l'utilisateur
           $nom = $prenom = $email = $mot_de_passe = "";
         }
      }
      else {

      }
          
    }
  
// Si l'utilisateur est deja membre on lui demande de se connecter
    else {
        echo "<p class='text-warning p-3 bg-dark'> Un compte existe déjà avec cette adresse courriel. <a href=\"loging.php\" class=\"btn btn-link\">Utilisez-la pour ouvrir une session ou entrez une autre 
        adresse pour continuer </a> </p> " ;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register user</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel='stylesheet' href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel='stylesheet' href="style.css">
</head>
<body>
    <div class='container'>
        <h1 class='text-center bg-success text-white m-4 p-2'> Incription </h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
            <div class="form-group">
               <div class="row">
                <label for='prenom' class="col-sm-2">Votre prenom : </label>
                <input type="text" name="prenom" id="prenom" placeholder="Votre prenom" class="col-sm-10 form-control" value="<?php echo $prenom ; ?>">
                <?php if (isset($prenomErr)) { echo "<div class='text-danger'>". $prenomErr. "</div>" ;}; ?> 
            </div>
            
        </div>

        <div class="form-group">
               <div class="row">
                <label for='nom' class="col-sm-2">Votre nom : </label>
                <input type="text" name="nom" id="nom" placeholder="Votre nom" class="col-sm-10 form-control" value="<?php if(isset($nom)) echo $nom ; ?>">
                <?php if (isset($nomErr)) { echo "<div class='text-danger'>". $nomErr. "</div>";}; ?> 
            </div>
           
        </div>

        
        <div class="form-group">
            <div class="row">
                <label for='email' class="col-sm-2">Votre email : </label>
                <input type="text" name="email" id="email" placeholder="Votre email" class="col-sm-10 form-control" value="<?php if(isset($email)) echo $email ; ?>">
                <?php if (isset($emailErr)) { echo "<div class='text-danger'>". $emailErr. "</div>" ;}; ?> 
            </div>
           
        </div>

        
        <div class="form-group">
            <div class="row">
                <label for='mot_de_passe' class="col-sm-2">Votre mot de passe : </label>
                <input type="password" name="mot_de_passe" id="mot_de_passe"  placeholder="Votre mot de passe" class="col-sm-10 form-control" value="<?php if(isset($mot_de_passe)) echo $mot_de_passe ; ?>">
                <?php if (isset($mot_de_passeErr)) { echo "<div class='text-danger'>". $mot_de_passeErr. "</div>" ;}; ?> 
            </div>           
        </div>
        <input type="submit" name="submit" value="Creer compte" id="inscription" class="btn btn-block btn-primary">
        </form>
    </div>
</body>
</html>