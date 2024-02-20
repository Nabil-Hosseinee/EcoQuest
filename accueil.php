<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Créer un fichier temporaire
$filename = tempnam('C:/xampp/tmp', "session_data_");

// Ouvrir le fichier temporaire en écriture
$handle = fopen($filename, "w");

// Écrire des données de session dans le fichier
fwrite($handle, json_encode($_SESSION));
fwrite($handle, "");

// Fermer le fichier
fclose($handle);

// Afficher le nom du fichier temporaire
echo "Fichier temporaire créé : $filename";
?>
