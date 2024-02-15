<?php 
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

$identifiant = $_POST["id"];
$_POST["id"] = filter_input(INPUT_POST,"id", FILTER_SANITIZE_SPECIAL_CHARS);
$mdp = sha1($_POST["mdp"]);
$message = "L'identifiant ou le Mot de passe est invalide.";

echo $identifiant;
echo $mdp;

include('connect_bdd.php');

$userStatement = $db->prepare("SELECT * FROM user");
$userStatement ->execute();
$user = $userStatement->fetchAll();

foreach ($user as $users) {
    if ($identifiant == $users['Identifiant'] && $mdp == $users['Mot de passe']) {
        header("Location: accueil.php");
    }
    else {
        echo "<script>alert('$message');</script>";
        header("Location: index.html");
    }
}
?>