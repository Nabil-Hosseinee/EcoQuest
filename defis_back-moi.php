<?php
// Inclure le fichier de connexion à la base de données
include('connect_bdd.php');

// Vérifier si l'identifiant du défi est présent dans la requête POST
if(isset($_POST['id_defi'])) {
    // Récupérer l'identifiant du défi depuis la requête POST
    $id_defi = $_POST['id_defi'];

    // Mettre à jour le statut du défi dans la base de données en le passant à l'état "résolu" (status = 2)
    $sql_update_statut = "UPDATE defis SET Status = 2 WHERE Id_defis = :id_defi";
    $stmt = $db->prepare($sql_update_statut);
    $stmt->bindParam(':id_defi', $id_defi, PDO::PARAM_INT);
    
    // Exécuter la requête préparée
    if($stmt->execute()) {
        echo "Le statut du défi a été changé avec succès.";
    } else {
        echo "Erreur lors du changement du statut du défi : " . implode(" - ", $stmt->errorInfo());
    }
} else {
    echo "Identifiant du défi non fourni.";
}

// Vérifier si des défis quotidiens arrivés à expiration ont leur statut à 3 et les remettre à 0
$sql_update_expired_defis = "UPDATE defis SET Status = 0 WHERE Status = 3 AND Difficulte = '0' AND date_expiration < CURDATE()";
if ($db->exec($sql_update_expired_defis) !== FALSE) {
    echo "Les défis quotidiens arrivés à expiration ont été mis à jour avec succès.\n";
} else {
    echo "Erreur lors de la mise à jour des défis quotidiens arrivés à expiration: " . implode(" - ", $db->errorInfo());
}

// Réinitialiser les statuts des défis au début de la période
$sql_reset_defis_status = "UPDATE defis SET Status = 0 WHERE Status = 2 AND Difficulte = '0' AND Date_debut = CURDATE()";
if ($db->exec($sql_reset_defis_status) !== FALSE) {
    echo "Les statuts des défis quotidiens ont été réinitialisés avec succès.\n";
} else {
    echo "Erreur lors de la réinitialisation des statuts des défis quotidiens: " . implode(" - ", $db->errorInfo());
}

// Mettre à jour la monnaie des utilisateurs lorsque les défis sont résolus
$sql_update_user_money = "UPDATE user
                          SET Monnaie = Monnaie + (
                              SELECT SUM(Argent gagne) FROM defis WHERE Status = 2
                          )
                          WHERE EXISTS (
                              SELECT * FROM defis WHERE Status = 2 AND user.Id_user = defis.Id_user
                          )";
if ($db->exec($sql_update_user_money) !== FALSE) {
    echo "La monnaie des utilisateurs a été mise à jour avec succès.\n";
} else {
    echo "Erreur lors de la mise à jour de la monnaie des utilisateurs: " . implode(" - ", $db->errorInfo());
}

// Fermer la connexion à la base de données
$db = null;
?>
