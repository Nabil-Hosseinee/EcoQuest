<?php 
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

$identifiant = $_POST["id"];
$_POST["id"] = filter_input(INPUT_POST,"id", FILTER_SANITIZE_SPECIAL_CHARS);
$mdp = sha1($_POST["mdp"]); 

include('connect_bdd.php');

$userStatement = $db->prepare("SELECT * FROM user");
$userStatement ->execute();
$user = $userStatement->fetchAll();

foreach ($user as $users) {
    ($identifiant == $users['Identifiant'] && $mdp == $users['Mot de passe']);
    $_SESSION["authentification"]= "OK";
    $_SESSION['Identifiant']= $identifiant;
    $_SESSION['Mot de passe'] = $mdp;
    header("Location: accueil.php");
}
?>