<?php 
session_start();

$identifiant = $_POST["id"];
$_POST["id"] = filter_input(INPUT_POST,"id", FILTER_SANITIZE_SPECIAL_CHARS);
$mdp = sha1($_POST["mdp"]);

include('connect_bdd.php');

$userStatement = $db->prepare("SELECT * FROM user");
$userStatement ->execute();
$user = $userStatement->fetchAll();

$found = false;

foreach ($user as $users) {
    if ($identifiant == $users['Identifiant'] || $identifiant == $users['Pseudo'] && $mdp == $users['Mot de passe']) {
        header("Location: accueil.php");
    }
    else {
        $message = "Identifiant ou mot de passe invalide.";
        echo "<script>alert('$message'); window.location.href = 'index.html';</script>";
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
