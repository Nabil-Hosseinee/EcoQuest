<?php

session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('connect_bdd.php');

$identifiant = $_SESSION['identifiant'];


// Exécution de la requête SQL
$requete = $db->prepare(
    "SELECT * FROM item
    LEFT JOIN  Obtenu ON acquisition = 1
    LEFT JOIN item_id 
    WHERE Pseudo = '$identifiant'");
$requete->execute();

SELECT * FROM objets
LEFT JOIN objets_utilisateurs ON objets.id = objets_utilisateurs.id_objet AND objets_utilisateurs.id_utilisateur = 1
WHERE objets_utilisateurs.id_objet IS NULL;



// Récupération des résultats
$resultatsitem = $requete->fetchAll(PDO::FETCH_ASSOC);

$ownitem: $resultatsitem;

// Exécution de la requête SQL
$requete = $db->prepare("SELECT Monnaie, Pseudo FROM user WHERE Pseudo = '$identifiant'");
$requete->execute();

// Récupération des résultats
$resultatsmoney = $requete->fetchAll(PDO::FETCH_ASSOC);

$money: $resultatsmoney;

if ($resultat) {

    if ($money >= $prix) {
        // L'utilisateur a assez d'argent pour acheter l'objet
        $nouvelle_money = $money - $prix;
        // Mettre à jour la money dans la base de données
        $mise_a_jour = $connexion->prepare("UPDATE user SET Monnaie = :nouvelle_monnaie WHERE Pseudo = '$identifiant'");
        $mise_a_jour->bindParam(':nouvelle_monnaie', $nouvelle_money);
        $mise_a_jour->execute();

        echo '<script>alert("Félicitations ! Vous avez acheté  l\'objet, Votre nouveau solde est : " + $nouvelle_money + ".");</script>';
    } else {
        // L'utilisateur n'a pas assez d'argent pour acheter l'objet
        echo '<script>alert("Désolé, vous n\'avez pas assez d\'argent pour acheter l\'objet, allez faire plus de défi.");</script>';
    }
} else {
    echo "Utilisateur non trouvé.";
}

?>