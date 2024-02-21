<?php 
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

$identifiant = $_POST["id"];
$_POST["id"] = filter_input(INPUT_POST,"id", FILTER_SANITIZE_SPECIAL_CHARS);
$mdp = sha1($_POST["mdp"]);

// test
$_SESSION['identifiant'] = $identifiant;
$_SESSION['mdp'] = $mdp;

echo $identifiant;
echo $mdp;

include('connect_bdd.php');

$userStatement = $db->prepare("SELECT * FROM user");
$userStatement ->execute();
$user = $userStatement->fetchAll();

foreach ($user as $users) {
    if (($identifiant == $users['Identifiant'] || $identifiant == $users['Pseudo']) && $mdp == $users['Mot de passe']) {
        header("Location: accueil.php");
    }
    else {
        $message = "Identifiant ou mot de passe invalide.";
        echo "<script>alert('$message'); window.location.href = 'index.html';</script>";
    }
}
?>