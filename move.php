<?php 
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

$identifiant = $_POST["Identifiant"];
$_POST["Identifiant"] = filter_input(INPUT_POST,"Identifiant", FILTER_SANITIZE_SPECIAL_CHARS);
$mdp = sha1($_POST["Mot de passe"]); 

include('connect_bdd.php');

$userStatement = $db->prepare("SELECT * FROM ecotracker");
$userStatement ->execute();
$user = $userStatement->fetchAll();

foreach ($user as $users) {
    ($identifiant == $users['Identifiant'] && $mdp == $users['Mot de passe'])
    $_SESSION["authentification"]= "OK";
    $_SESSION['Identifiant']= $identifiant;
    $_SESSION['Mot de passe'] = $mdp;
    header("Location: accueil.php");    
}
?>