<?php 
    include '../config/path.php' ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Contactez-Nous</title>
    <?php include("../config/head.php"); ?>
    <style> 
        
    </style>
</head>
<body>

    <?php  include '../config/nav.php'?>
    <h2 class="btn btn-secondary btn-block"> Contactez-Nous ? </h2>
    <div id="demo"></div>

    <div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
            Telephone :<a href="tel:+1438-877-9277"> 438 877 9277</a> <br>
            Email : <a href="mailto:bounama.traore@gmail.com">bounama.traore@gmail.com</a>
            </div>
        </div>
    </div>
    <div class='col-md-8'>
    <form method="post" id="contact-form" action="valider_contact.php">
            <div class="form-group">
                <label for="prenom">Votre Prenom </label>
                <input type="text" name="prenom" id="prenom" class="form-control">
                <div class="erreur"></div>
            </div>

            <div class="form-group">
                <label for="nom">Votre nom </label>
                <input type="text" name="nom" id="nom" class="form-control">
                <div class="erreur"></div>
            </div>

            <div class="form-group">
                <label for="email">Votre email </label>
                <input type="text" name="email" id="email" class="form-control">
                <div class="erreur"></div>
            </div>
            <input type="submit" name="submit" value="Envoyer votre message !" class="btn btn-warning">
    </form>    
    </div>
    </div>
    <script>
    $(document).ready(function(){
    // $('#demo').html('Hello demo') ;
    $("#contact-form").submit(function(e) {
        e.preventDefault() ;
        $('.erreur').empty() ;
        var donnees = $("#contact-form").serialize() ;

       $.ajax({
           type : 'POST',
           url : 'valider_contact.php',
           data : donnees ,
           dataType : 'json' ,
           timeout : 2000 ,
           success : function(valeur) {
                if (valeur.reussi !== 0) {
                    $('#demo').html('Vous etes inscrit avec success') ;
                    $('#form-contact')[0].reset();
                }
                else {
                    $("#prenom + .erreur").html(valeur.prenomErr) ;
                    $("#nom + .erreur").html(valeur.nomErr) ;
                    $("#email + .erreur").html(valeur.emailErr) ;
                }
           } ,
           error : function(error){
               $('#demo').html('Une erreur est survenue ') ;
           }
            //Fin success
       })//Fin ajax

    }) 
})
    </script>
</body>
</html>