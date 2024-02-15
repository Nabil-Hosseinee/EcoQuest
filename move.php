<?php 
session_start();

$identifiant = $_POST["id"];
$_POST["id"] = filter_input(INPUT_POST,"id", FILTER_SANITIZE_SPECIAL_CHARS);
$mdp = sha1($_POST["mdp"]);
$message = "L'identifiant ou le Mot de passe est invalide.";

include('connect_bdd.php');

$userStatement = $db->prepare("SELECT * FROM user");
$userStatement ->execute();
$user = $userStatement->fetchAll();

$found = false;

foreach ($user as $users) {
    if ($identifiant == $users['Identifiant'] && $mdp == $users['Mot de passe']) {
        $found = true;
        break;
    }
}

if ($found) {
    header("Location: accueil.php");
    exit; // Assurez-vous de quitter le script après une redirection
} else {
    $_SESSION["error_message"] = $message;
    header("Location: index.php");
    exit; // Assurez-vous de quitter le script après une redirection
}
?>
