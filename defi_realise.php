<?php
session_start();

if(isset($_POST['defi_id'])) {
    $defi_id = $_POST['defi_id'];

    include('connect_bdd.php');

    if(isset($_SESSION['id_number'])) {
        $user_id = $_SESSION['id_number']; 

        $sql_insert_realisation = "INSERT INTO realisation (user_Id, defis_Id, Statut) VALUES (:user_id, :defi_id, 2)";
        $result_insert_realisation = $db->prepare($sql_insert_realisation);
        $result_insert_realisation->bindParam(':defi_id', $defi_id, PDO::PARAM_INT);
        $result_insert_realisation->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        
        if ($result_insert_realisation->execute()) {
            $sql_update_user_monnaie = "UPDATE user SET Monnaie = Monnaie + (SELECT `Argent gagne` FROM defis WHERE Id_defis = :defi_id) WHERE id_user = :user_id";
            $result_update_user_monnaie = $db->prepare($sql_update_user_monnaie);
            $result_update_user_monnaie->bindParam(':defi_id', $defi_id, PDO::PARAM_INT);
            $result_update_user_monnaie->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $result_update_user_monnaie->execute();

            $sql_update_user_score = "UPDATE user SET `Total score` = `Total score` + (SELECT `Score` FROM defis WHERE Id_defis = :defi_id) WHERE id_user = :user_id";
            $result_update_user_score = $db->prepare($sql_update_user_score);
            $result_update_user_score->bindParam(':defi_id', $defi_id, PDO::PARAM_INT);
            $result_update_user_score->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $result_update_user_score->execute();

            if ($result_update_user_monnaie && $result_update_user_score) {
                header("Location: defis.php");
            } else {
                echo "Erreur lors de la mise à jour de l'utilisateur.";
            }
        } else {
            echo "Erreur lors de l'insertion dans la table realisation : " . $result_insert_realisation->errorInfo()[2];
        }
    } else {
        echo "Session utilisateur non trouvée. Veuillez vous connecter.";
    }
} else {
    echo "Identifiant du défi non reçu.";
}
?>
