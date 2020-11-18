<?php 
    session_start();
    include("../config/path.php");
    include("../input_validation.php");
    include("../config/connection_database.php");
    $query = $conn->prepare("SELECT * FROM realisations;");
    $query->execute([]);
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $count = count($results);
?>
    <?php 
    if(!isset($_SESSION['prenom']) && !isset($_SESSION['nom']) && !isset($_SESSION['id']) && !isset($_SESSION['email']) && !isset($_COOKIE["prenom"]) && !isset($_COOKIE["nom"]) && !isset($_COOKIE["email"]) && !isset($_COOKIE["id"])) :
    ?>
    <div style="font-size:30px;">
        <a href='<?php echo $FOLDER_PATH; ?>/loging.php' style="color:white; background-color: green; text-decoration:none;">Vous devrez &ecirc;tre un Membre pour se connecter</a> ou <a href='<?php echo $FOLDER_PATH;?>/register.php' style="color:white; background-color: green; text-decoration:none;">Cr&eacute;er un compte avec l'aide du Membre</a> 
    </div>
    <?php else : ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <?php include("../config/head.php"); ?>
</head>
<body>
<h1 class="text-dark bg-primary d-flex"> Bonjour <?PHP if(isset($_SESSION['prenom']) &&   isset($_SESSION["nom"])) { echo ucwLower($_SESSION['prenom']). " ". ucwLower($_SESSION['nom']);}
else {
  if(isset($_COOKIE["prenom"]) && isset($_COOKIE["nom"])) {
    echo ucwLower($_COOKIE['prenom']). " ". ucwLower($_COOKIE['nom']);
  }
}
 ?>  <button class="btn btn-warning ml-auto"> <a href="<?php echo $FOLDER_PATH;?>/logout.php"> Se deconnecter</a> </button></h1> 
    <div class="container-fluid">
        <h1 class="text-center"><a href="new_realisation.php" class="nav-link">Ajouter une nouvelle realisation</a></h1>
        <?php if($count > 0) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <tr>
                    <!-- <th>ID</th> -->
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Ann&eacute;e de d&eacute;but</th>
                    <th>Ann&eacute;e de fin</th>
                    <th>Voir d&eacute;tail</th>
                    <th>Modifier</th>
                    <th>Supprimer </th>
                    <th>Ajouter une image </th>
                </tr>
                <?php foreach($results as $result): ?>
                    <tr>
                        <!-- <td><?php echo $result->id; ?></td> -->
                        <td><?php echo $result->title; ?></td>
                        <td><?php echo $result->description; ?></td>
                        <td><?php echo $result->date_start; ?></td>
                        <td><?php echo $result->date_end; ?></td>
                        <td><form action="view.php" method="post"><input type="hidden" name="view" id="view" value="<?php echo $result->id;?>"><input type="submit" name="submit" id="submit" value="détail"></form> </td>
                        <td><form action="edit.php" method="post"><input type="hidden" name="update" id="update" value="<?php echo $result->id;?>"><input type="submit" name="submit" id="submit" value="modifier"></form></td>
                        <td><form action="delete.php" method="post"><input type="hidden" name="delete" id="delete" value="<?php echo $result->id;?>"><input type="submit" name="submit" id="submit" value="supprimer"></form></td>
                        <td><form action="new_image.php" method="post"><input type="hidden" name="new_image" id="new_image" value="<?php echo $result->id;?>"><input type="submit" name="submit" id="submit" value="ajouter image"></form></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
        <?php endif; ?>
    </div>  
    <?php endif; ?>  
</body>
</html>