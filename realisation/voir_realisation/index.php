<?php 
    include("../../config/connection_database.php");
    include "../../config/path.php";
    if(isset($_POST["view_realisation"])) {
      $id = $_POST["view_realisation"];
    }
    else {
      header('location:../index.php');
      exit();
    }
    $query = $conn->prepare("SELECT * FROM realisations WHERE id=:id_view");
    $query->execute([":id_view"=>$id]);
    $result = $query->fetch(PDO::FETCH_OBJ);
    
    $queryImage = $conn->prepare("SELECT * FROM image_realisations INNER JOIN realisations ON realisations.id = image_realisations.id_realisation WHERE image_realisations.id_realisation = :realisationID;");
    $queryImage->execute([":realisationID" => $id]);
    $resultImages = $queryImage->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php if(isset($result->title)) { echo $result->title ;} else echo "Realisation";?></title>
    <?php include("../../config/head.php"); ?>
</head>
<body>
    <?php include("../../config/nav.php"); ?>
    <div class="container">
        
        <!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <input type="hidden" name="view_realisation" value="<?php if(isset($id)) { echo $id ;} ?>"> -->
        <?php echo $result->title;?> <br>
        <div class="row">
            <?php foreach($resultImages as $resultImage): ?>
              <div class="col-sm-6 col-md-4">
                <div class="thumbnail">
                  <figure><img src="<?php echo $FOLDER_PATH ;?>/images/<?php echo $resultImage->nom ?>" alt ="image" class="mh-100 mw-100"  style="width: 300px; height: 300px;">
                </div>
              </div>
        

            <?php endforeach;?>
        </div>
        <p>
        <h2>Description</h2>
        <?php echo $result->description; ?>
        </p>
        <b>Date d&eacute;but</b> : <?php echo $result->date_start;?> <br>
        <b>Date de fin</b> : <?php echo $result->date_end;?>
        <!-- </form> -->
        <a href="<?php echo $FOLDER_PATH; ?>/realisation/" class="nav-link btn">Revenir &agrave; la liste des r&eacute;alisation </a> 
    </div>    
</body>
</html>