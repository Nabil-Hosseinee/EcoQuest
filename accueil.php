<?php
session_start();
$identifiant = $_SESSION['identifiant'];
$mdp = $_SESSION['mdp'];
// $id_num = $_SESSION['id_number'];

// echo $identifiant;
// echo "</br>";
// echo $mdp;
// echo "</br>";
// echo "</br>";

// Récupération des identifiants et du mot de passe
// $identifiant = $_POST["id"];
// $mdp = sha1($_POST["mdp"]);

// Spécifie le chemin vers le répertoire temporaire de XAMPP
$tmpDir = 'C:/xampp/tmp'; // Assurez-vous d'adapter ce chemin à votre installation XAMPP

// Crée un fichier temporaire dans le répertoire temporaire de XAMPP
$tmpFile = tempnam($tmpDir, 'example_');

// Vérifie si le fichier temporaire a été créé avec succès
if ($tmpFile !== false) {
    // Ouvre le fichier en mode écriture
    $handle = fopen($tmpFile, 'w');

    // Vérifie si l'ouverture du fichier a réussi
    if ($handle !== false) {
        // Écrit l'identifiant et le mot de passe dans le fichier
        fwrite($handle, "Identifiant: $identifiant\n");
        fwrite($handle, "Mot de passe: $mdp\n");

        // Ferme le fichier
        fclose($handle);

        // echo "Identifiant et mot de passe ajoutés avec succès dans le fichier temporaire : $tmpFile";
    } else {
        echo "Impossible d'ouvrir le fichier temporaire en écriture";
    }
} else {
    echo "Impossible de créer le fichier temporaire";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoQuest | Home</title>
    <link rel="stylesheet" href="./css/accueil.css">
    <link rel="stylesheet" href="./css/general.css">
    <script src="https://kit.fontawesome.com/96e027db6d.js" crossorigin="anonymous"></script>
</head>
<body>

    <div class="info">
        <h1>Bienvenue, <?php echo $identifiant ?></h1>
    </div>

    <a href="deconnexion.php">
        <button>
            <p>Déconnexion</p>
            <div class="deco_icon">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
        </button>
    </a>

    <div class="image-container">
        <img src="./images/carte-fefe4.png" alt="" class="background-image">
    </div>

    <div class="point defis_point" data-text="Défis">
        <a href="defis.php"><i class="fa-solid fa-location-dot"></i></a>
    </div>

    <div class="point profil_point" data-text="Profil">
        <a href="profil.php"><i class="fa-solid fa-location-dot"></i></a>
    </div>

    <div class="point reseau_point" data-text="Réseau">
        <a href="reseau.php"><i class="fa-solid fa-location-dot"></i></a>
    </div>

    <div class="point dashboard_point" data-text="Dashboard">
        <a href="dash.php"><i class="fa-solid fa-location-dot"></i></a>
    </div>

    <div class="point shop_point" data-text="Boutique">
        <a href="shop.php"><i class="fa-solid fa-location-dot"></i></a>
    </div>

    
    
</body>
</html>


