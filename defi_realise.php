<?php
    if(isset($_POST['defi_id'])) {
        $defi_id = $_POST['defi_id'];

        include('connect_bdd.php');

        $sql_update_defi = "UPDATE defis SET Status = 2 WHERE Id_defis = :defi_id";

        $result_update_defi = $db->prepare($sql_update_defi);
        $result_update_defi->bindParam(':defi_id', $defi_id, PDO::PARAM_INT);
        if ($result_update_defi->execute()) {
            header("Location: defis.php");
        } else {
            echo "Erreur lors de la mise à jour du défi : " . $result_update_defi->errorInfo()[2];
        }
    } else {
        echo "Identifiant du défi non reçu.";
    }
?>