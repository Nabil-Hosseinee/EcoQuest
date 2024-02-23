<?php
session_start();
$identifiant = $_SESSION['identifiant'];
$mdp = $_SESSION['mdp'];

echo $identifiant;
echo "</br>";
echo $mdp;
echo "</br>";
echo "</br>";

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

        echo "Identifiant et mot de passe ajoutés avec succès dans le fichier temporaire : $tmpFile";
    } else {
        echo "Impossible d'ouvrir le fichier temporaire en écriture";
    }
} else {
    echo "Impossible de créer le fichier temporaire";
}
echo "</br>";
echo "</br>"; 
?>


<h1>Bienvenue a vous <?php echo $identifiant ?></h1>

<a href="deconnexion.php">Deconnexion</a>
<a href="defis.php">Défis</a>
