<?php
include("connect_bdd.php");

if (isset($_POST['pseudo'], $_POST['mdp'], $_POST['id'])) {
    $pseudo = $_POST['pseudo'];
    $mdp = sha1($_POST['mdp']);
    $id = $_POST['id'];

    $sql = "INSERT INTO user (Identifiant, Pseudo, `Mot de passe`) VALUES (:id, :pseudo, :mdp)";
    $stmt = $db->prepare($sql);

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':mdp', $mdp);

    if ($stmt->execute()) {
        echo 'Inscription réussie!';
        header('Location: index.html');
        exit(); 
    } else {
        echo 'Erreur lors de l\'inscription.';
    }
}
?>
