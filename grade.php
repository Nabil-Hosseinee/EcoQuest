<?php
session_start();
include('connect_bdd.php');

function attribuer_grade($total_score) {
    if ($total_score >= 2000) {
        return "Maître de l'Écologie";
    } elseif ($total_score >= 1000) {
        return "Éco-Héros";
    } elseif ($total_score >= 500) {
        return "Gardien de la Terre";
    } elseif ($total_score >= 200) {
        return "Explorateur Vert";
    } else {
        return "Débutant Écolo";
    }
}

$user_id = $_SESSION['id_number'];

$userStatement = $db->prepare("SELECT * FROM user WHERE Id_user = :user_id");
$userStatement->bindParam(':user_id', $user_id);
$userStatement->execute();
$user = $userStatement->fetch(PDO::FETCH_ASSOC);

$total_score = $user['Total score'];
$grade = attribuer_grade($total_score); 

$sql_update_grade = "UPDATE user SET Grade = :grade WHERE Id_user = :id_user";
$stmt_update_grade = $db->prepare($sql_update_grade);
$stmt_update_grade->bindParam(':grade', $grade);
$stmt_update_grade->bindParam(':id_user', $user_id);
$stmt_update_grade->execute();

$_SESSION['grade'] = $grade;
?>
