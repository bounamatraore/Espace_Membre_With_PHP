<?php
    include("../config/connection_database.php");
    if(isset($_POST["delete"])) {
        $delete = $_POST["delete"];
        $query = $conn->prepare("DELETE FROM realisations WHERE id = :id_delete;");
        $result = $query->execute([":id_delete"=>$delete]);
    if($result) {
        header("location:index.php");
    }
    else {
        echo "Erreur lors de la suppression";
    }
    }
    
?>