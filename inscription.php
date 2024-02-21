<?php
include("connect_bdd.php");

if (isset($_POST['pseudo'], $_POST['mdp'], $_POST['id'])) {
    $pseudo = $_POST['pseudo'];
    $mdp = sha1($_POST['mdp']);
    $id = $_POST['id'];

    // Vérification si le pseudo existe déjà
    $sql_check_pseudo = "SELECT * FROM user WHERE Pseudo = :pseudo";
    $stmt_check_pseudo = $db->prepare($sql_check_pseudo);
    $stmt_check_pseudo->bindParam(':pseudo', $pseudo);
    $stmt_check_pseudo->execute();

    // Vérification si l'e-mail existe déjà
    $sql_check_email = "SELECT * FROM user WHERE Identifiant = :id";
    $stmt_check_email = $db->prepare($sql_check_email);
    $stmt_check_email->bindParam(':id', $id);
    $stmt_check_email->execute();

    // Vérification si le mot de passe existe déjà
    $sql_check_mdp = "SELECT * FROM user WHERE `Mot de passe` = :mdp";
    $stmt_check_mdp = $db->prepare($sql_check_mdp);
    $stmt_check_mdp->bindParam(':mdp', $mdp);
    $stmt_check_mdp->execute();

    if ($stmt_check_pseudo->rowCount() > 0) {
        $message = "Ce pseudo est déjà utilisé. Veuillez en choisir un autre.";
        echo "<script>alert('$message'); window.location.href = 'inscription.html';</script>";
    } 
    elseif ($stmt_check_email->rowCount() > 0) {
        $message = "Cet identifiant (e-mail) est déjà utilisé. Veuillez en choisir un autre.";
        echo "<script>alert('$message'); window.location.href = 'inscription.html';</script>";
    } 
    elseif ($stmt_check_mdp->rowCount() > 0) {
        $message = "Ce mot de passe est déjà utilisé. Veuillez en choisir un autre.";
        echo "<script>alert('$message'); window.location.href = 'inscription.html';</script>";
    }
    else {
        // Les valeurs ne sont pas déjà présentes dans la base de données, insertion
        $sql_insert = "INSERT INTO user (Identifiant, Pseudo, `Mot de passe`) VALUES (:id, :pseudo, :mdp)";
        $stmt_insert = $db->prepare($sql_insert);
        $stmt_insert->bindParam(':id', $id);
        $stmt_insert->bindParam(':pseudo', $pseudo);
        $stmt_insert->bindParam(':mdp', $mdp);

        if ($stmt_insert->execute()) {
            echo 'Inscription réussie!';
            header('Location: index.html');
            exit();
        } else {
            echo 'Erreur lors de l\'inscription.';
        }
    }
}
?>
