<?php

include("connect_bdd.php");

if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
    $pseudo = $_POST['pseudo'];
    $mdp = sha1($_POST['mdp']);
    $id = $_POST['id'];

    $sql = "INSERT INTO user (Identifiant, Pseudo, Mot de passe) VALUES ($id, $pseudo, $mdp)";
    $result = $db->prepare($sql);
    $result->execute();

    if ($result) {
        echo 'Inscription réussie!';
        header('Location: accueil.php');
    } else {
        echo 'Erreur lors de l\'inscription.';
    }
}
?>