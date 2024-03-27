<?php
include 'connect_bdd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imagePath = ''; // Variable pour stocker le chemin de l'image

    // Vérifiez si une image a été téléchargée
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Déplacez l'image vers un répertoire de destination (par exemple, 'uploads/')
        $uploadDir = 'uploads/';
        $imageName = $_FILES['image']['name'];
        $imagePath = $uploadDir . $imageName;
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    }

    // Récupérez d'autres données du formulaire
    $userId = $_SESSION['user_id']; // Vous devez gérer l'authentification de l'utilisateur
    $commentaire = $_POST['commentaire']; // Assurez-vous de nettoyer et de valider les données

    // Insérez les données dans la table post
    $stmt = $db->prepare("INSERT INTO post (user_Id, Photo, Commentaire, Chemin_image) VALUES (:userId, :photo, :commentaire, :imagePath)");
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':photo', 1); // Vous devez gérer l'ID de la photo
    $stmt->bindParam(':commentaire', $commentaire);
    $stmt->bindParam(':imagePath', $imagePath);
    $stmt->execute();
}
?>
