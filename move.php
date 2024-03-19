<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

$identifiant = $_POST["id"];
$_POST["id"] = filter_input(INPUT_POST,"id", FILTER_SANITIZE_SPECIAL_CHARS);
$mdp = sha1($_POST["mdp"]);

$_SESSION['identifiant'] = $identifiant;
$_SESSION['mdp'] = $mdp;

echo $identifiant;
echo $mdp;

include('connect_bdd.php');

$userStatement = $db->prepare("SELECT * FROM user");
$userStatement ->execute();
$users = $userStatement->fetchAll(PDO::FETCH_ASSOC);

foreach ($users as $user) {
    if (($identifiant == $user['Identifiant'] || $identifiant == $user['Pseudo']) && $mdp == $user['Mot de passe']) {

        $date_actuelle = date('Y-m-d');

        $user_id = $user['Id_user']; 

        $sql_select_defis_quotidiens = "SELECT * FROM defis_quotidiens WHERE date = :date AND user_id= :user_id";
        $stmt_select_defis_quotidiens = $db->prepare($sql_select_defis_quotidiens);
        $stmt_select_defis_quotidiens->bindParam(':date', $date_actuelle);
        $stmt_select_defis_quotidiens->bindParam(':user_id', $user_id);
        $stmt_select_defis_quotidiens->execute();

        if ($stmt_select_defis_quotidiens->rowCount() == 0) {
            $sql_select_defis = "SELECT * FROM defis ORDER BY RAND() LIMIT 3";
            $stmt_select_defis = $db->prepare($sql_select_defis);
            $stmt_select_defis->execute();
            $defis_quotidiens = $stmt_select_defis->fetchAll(PDO::FETCH_ASSOC);

            

            $sql_insert_defis_quotidiens = "INSERT INTO defis_quotidiens (date, user_id, defi_id1, defi_id2, defi_id3) VALUES (:date, :user_id, :defi_id1, :defi_id2, :defi_id3)";
            $stmt_insert_defis_quotidiens = $db->prepare($sql_insert_defis_quotidiens);
            $stmt_insert_defis_quotidiens->bindParam(':date', $date_actuelle);
            $stmt_insert_defis_quotidiens->bindParam(':user_id', $user_id);
            $stmt_insert_defis_quotidiens->bindParam(':defi_id1', $defis_quotidiens[0]['Id_defis']);
            $stmt_insert_defis_quotidiens->bindParam(':defi_id2', $defis_quotidiens[1]['Id_defis']);
            $stmt_insert_defis_quotidiens->bindParam(':defi_id3', $defis_quotidiens[2]['Id_defis']);
            $stmt_insert_defis_quotidiens->execute();

            echo "Trois nouveaux défis quotidiens ont été ajoutés pour aujourd'hui.";
        } else {
            echo "Les défis quotidiens pour aujourd'hui existent déjà.";
        }

        header("Location: accueil.php");
    } else {
        $message = "Identifiant ou mot de passe invalide.";
        echo "<script>alert('$message'); window.location.href = 'index.html';</script>";
    }
}
?>