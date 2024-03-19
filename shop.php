<?php

session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

include('connect_bdd.php');

$identifiant = $_SESSION['identifiant'];


// Exécution de la requête SQL
$requete = $db->prepare(
    "SELECT * FROM item
    LEFT JOIN  acquisition ON item.id_item = acquisition.item_Id 
    LEFT JOIN user ON user.id_user = acquisition.user_Id 
    WHERE user.Pseudo = '$identifiant' AND acquisition.Obtenu = 1"); 
$requete->execute();


// Récupération des résultats
$resultatsitem = $requete->fetchAll(PDO::FETCH_ASSOC);

$ownitem= $resultatsitem;


if ($ownitem) {

    if ($ownitem == $prix) {
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












// Exécution de la requête SQL
$requete = $db->prepare("SELECT Monnaie, Pseudo FROM user WHERE Pseudo = '$identifiant'");
$requete->execute();

// Récupération des résultats
$resultatsmoney = $requete->fetchAll(PDO::FETCH_ASSOC);

$money: $resultatsmoney;

if ($money) {

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