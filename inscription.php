<?php
include("connect_bdd.php");

if (isset($_POST['pseudo'], $_POST['mdp'], $_POST['id'])) {
    $pseudo = $_POST['pseudo'];
    $mdp = sha1($_POST['mdp']);
    $id = $_POST['id'];

    $sql = "INSERT INTO user (Identifiant, Pseudo, `Mot de passe`) VALUES (:id, :pseudo, :mdp)";
    $stmt = $db->prepare($sql);

    // Liaison des valeurs des paramètres
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':pseudo', $pseudo);
    $stmt->bindParam(':mdp', $mdp);

    // Exécution de la requête
    if ($stmt->execute()) {
        echo 'Inscription réussie!';
        header('Location: accueil.php');
        exit(); // Assurer qu'aucun code supplémentaire n'est exécuté après la redirection
    } else {
        echo 'Erreur lors de l\'inscription.';
    }
}
?>
