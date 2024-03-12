<?php
// Inclure le fichier de connexion à la base de données
include('connect_bdd.php');

// Sélectionner 3 défis quotidiens aléatoires non résolus
$sql_select_defis = "SELECT * FROM defis WHERE Status IN (0, 1) AND Difficulte = '0' AND date_expiration >= NOW() ORDER BY RAND() LIMIT 3";
$result_select_defis = $db->query($sql_select_defis);

if ($result_select_defis->rowCount() > 0) {
    while ($row = $result_select_defis->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='defi'>";
        echo "<h3>" . $row["Intitule defis"] . "</h3>";
        echo "<p>Score : " . $row["Score"] . "</p>";
        echo "<p>Argent gagné : " . $row["Argent gagne"] . "</p>";
        echo "<button onclick='resolveDefi(" . $row["Id_defis"] . ")'>Résoudre</button>";
        echo "</div>";
    }
} else {
    echo "Aucun défi quotidien disponible ou tous les défis quotidiens ont expiré.\n";
}

echo "Nombre de défis quotidiens non résolus : " . $result_select_defis->rowCount();    

// Fermer la connexion à la base de données
$db = null;
?>
