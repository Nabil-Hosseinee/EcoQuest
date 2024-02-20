<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

include('connect_bdd.php');

$user_id = $_SESSION['user_id'];
$userStatement = $db->prepare("SELECT * FROM user WHERE Id_user = :user_id");
$userStatement->bindParam(':user_id', $user_id);
$userStatement->execute();
$user = $userStatement->fetch();

echo "Bienvenue, " . $user['Pseudo'];

echo "<a href='deconnexion.php'>Deconnexion</a>";

?>