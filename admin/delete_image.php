<?php 
    include("../config/connection_database.php");
    include("../config/path.php");
    
    if(isset($_POST["delete_image"])) {
        $delete_image = $_POST["delete_image"];

        $query_select = $conn->prepare("SELECT * FROM image_realisations WHERE id= :id_select;");
        $query_select->execute([":id_select"=>$delete_image]);
        $result_select = $query_select->fetch(PDO::FETCH_OBJ);
        $result_select_nom = $result_select->nom;

        $query_delete = $conn->prepare("DELETE FROM image_realisations WHERE id = :id;");
        if($query_delete->execute([":id"=>$delete_image])) {
            unlink("../images/$result_select_nom");
            header("location:thank_delete.php");
        }
    } 

    // $query_select = $conn->prepare("SELECT * FROM image_realisations WHERE image_realisations.id_realisation = :id_image;");
    // $query_select->execute([":id_image"=>$delete_image]);
    // $result_select = $query_select->fetchAll(PDO::FETCH_OBJ);
    // print_r($result_select);
    
    //On compte le nombres d'image pour ne pas supprimer toutes les images, on doit laisser au moins une image , sinon on propose a l'administreur de supprimer d'abord la realisation associe a cette image
    //$count_image = count($result_select);

    // if($count_image <=1) {
    //     echo "Vous ne pouvez pas supprimer toutes les images";
    // }
    //else {
        
    //}
    

?>
