<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/reseau.css">   
    <script src="https://kit.fontawesome.com/96e027db6d.js" crossorigin="anonymous"></script> 
    <title>EcoQuest | Réseau</title>
</head>
<body style="background-color: #A3EA9E;">

<?php
session_start();

include("connect_bdd.php");

if (isset($_SESSION['id_number']) && isset($_POST['commentaire'])) {
    $id_utilisateur = $_SESSION['id_number'];
    
    $commentaire = $_POST['commentaire'];

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo_content = file_get_contents($_FILES['photo']['tmp_name']);

        $maxFileSize = 55 * 1024 ; // 55 Ko max

        if ($_FILES['photo']['size'] > $maxFileSize) {
            echo '<div style="text-align: center; font-size: 24px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);">';
            echo 'La taille du fichier est trop grande. Veuillez choisir un fichier plus petit.' . '<br/><br/>';
            echo '<a href="reseau.php" style="color: #384955;">Retour à la page précédente</a>';
            echo '</div>';       

        } else {
            $sql_insert = "INSERT INTO post (user_Id, commentaire, photo) VALUES (:user_Id, :commentaire, :photo)";
            $stmt_insert = $db->prepare($sql_insert);
            $stmt_insert->bindParam(':user_Id', $id_utilisateur);
            $stmt_insert->bindParam(':commentaire', $commentaire);
            $stmt_insert->bindParam(':photo', $photo_content, PDO::PARAM_LOB);

            if ($stmt_insert->execute()) {
                echo 'Post ajouté avec succès!';
                header('reseau.php');
            } else {
                echo 'Erreur lors de l\'ajout du post.';
            }
        }
    } else {
        echo 'Aucun fichier téléchargé ou une erreur est survenue.';
    }
} else {
    echo 'Veuillez vous connecter pour pouvoir poster.';
}
?>
</body>
</html>