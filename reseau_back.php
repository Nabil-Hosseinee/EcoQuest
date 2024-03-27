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
            echo 'La taille du fichier est trop grande. Veuillez choisir un fichier plus petit.';
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
