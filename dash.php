<?php
include('grade.php');
include('connect_bdd.php');

$user_id = isset($_SESSION['id_number']) ? $_SESSION['id_number'] : null;

if ($user_id) {
    $sql_difficulty_count = "SELECT Difficulte, COUNT(*) AS nombre_defis FROM realisation JOIN defis ON realisation.defis_Id = defis.Id_defis WHERE realisation.user_Id = :user_id GROUP BY Difficulte";
    $stmt_difficulty_count = $db->prepare($sql_difficulty_count);
    $stmt_difficulty_count->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    if ($stmt_difficulty_count->execute()) {
        $difficulty_counts = $stmt_difficulty_count->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $difficulty_counts = [];
    }
} else {
    $difficulty_counts = [];
}

$difficulty_counts_json = json_encode($difficulty_counts);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/dash.css">   
    <script src="https://kit.fontawesome.com/96e027db6d.js" crossorigin="anonymous"></script> 
    <title>EcoQuest | Dash</title>
</head>
<body>

    <div id="burger-menu">
        <span></span>
    </div>


    <div id="menu">

        <div class="info">
            <h2>Où veux-tu te rendre ?</h2>
        </div>

        <a href="deconnexion.php">
            <button class="deco">
                <p>Déconnexion</p>
                <div class="deco_icon">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </div>
            </button>
        </a>

        <div class="image-container">
            <img src="./images/carte-fefe4.png" alt="" class="background-image">
        </div>
    
        <div class="point defis_point" data-text="Défis">
            <a href="defis.php"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point profil_point" data-text="Profil">
            <a href="profil.php"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point reseau_point" data-text="Réseau">
            <a href="reseau.php"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point dashboard_point" data-text="Dashboard">
            <a href="dash.php"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point shop_point" data-text="Boutique">
            <a href="shop.php"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    </div>


    <header>
        <div class="logo-container">
            <img src="" alt="">
        </div>

        <h1>Dashboard</h1>

        <div class="info-container">
            <div class="avatar">
                <img src="./images/items/pp1.png" alt="">
            </div>
            <div class="info-test">
                <?php

                if(isset($_SESSION['id_number'])) {
                    include('connect_bdd.php');

                    $user_id = $_SESSION['id_number']; 

                    $sql_user_info = "SELECT Pseudo, Grade FROM user WHERE Id_user = :user_id";
                    $stmt = $db->prepare($sql_user_info);
                    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
                    $stmt->execute();
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $pseudo = $row['Pseudo'];
                    $grade = $row['Grade'];

                    echo "<h3>$pseudo</h3>";
                    echo "<p>$grade</p>";
                } else {
                    echo "Session utilisateur non trouvée. Veuillez vous connecter.";
                }
                ?>
            </div>
        </div>

    </header>

    <section class="container">
    <div class="chiffre">
        <?php
        if(isset($_SESSION['id_number'])) {
            include('connect_bdd.php');

            $user_id = $_SESSION['id_number']; 

            // Nombre totale de défis
            $sql_count_defis = "SELECT COUNT(*) AS total_defis FROM defis";
            $result_count_defis = $db->prepare($sql_count_defis);
            $result_count_defis->execute();
            $ligne = $result_count_defis->fetch(PDO::FETCH_ASSOC);
            $total_defis = $ligne['total_defis'];

            // Défis réalisés
            $sql_count_realisations = "SELECT COUNT(*) AS total_realisations FROM realisation WHERE user_Id = :user_id";
            $stmt = $db->prepare($sql_count_realisations);
            $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $total_realisations = $row['total_realisations'];

            // Moyenne impact des défis réalisés
            $sql_avg_impact = "SELECT AVG(defis.Impact) FROM realisation JOIN defis ON realisation.defis_Id = defis.Id_defis WHERE realisation.user_Id = :user_id";
            $stmt_avg_impact = $db->prepare($sql_avg_impact);
            $stmt_avg_impact->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt_avg_impact->execute();
            $avg_impact = $stmt_avg_impact->fetchColumn(); 
            
            // Total Score
            $sql_total_score = "SELECT `Total score` FROM user WHERE Id_user = :user_id";
            $stmt_total_score = $db->prepare($sql_total_score);
            $stmt_total_score->bindParam(':user_id', $user_id, PDO::PARAM_INT);
            $stmt_total_score->execute();
            $total_score = $stmt_total_score->fetchColumn();

            // Défis réalisés
            echo '<div class="box">';
            echo '<h4>' . $total_realisations . ' / ' . $total_defis . '</h4>';
            echo '<p>Défis réalisés</p>';
            echo '</div>';

            // Moyenne impact des défis réalisés
            echo '<div class="separator"></div>';
            echo '<div class="box">';
            echo '<h4>' . round($avg_impact, 2) . '</h4>'; // Arrondi à deux décimales
            echo '<p>Moyenne impact des défis réalisés</p>';
            echo '</div>';

            // Total Score
            echo '<div class="separator"></div>';
            echo '<div class="box">';
            echo '<h4>' . $total_score . '</h4>';
            echo '<p>Points de grade</p>';
            echo '</div>';
        } else {
            echo "Session utilisateur non trouvée. Veuillez vous connecter.";
        }
        ?>
    </div>
</section>


    <script>
        var burgerMenu = document.getElementById('burger-menu');

        var overlay = document.getElementById('menu');

        burgerMenu.addEventListener('click', function() {
            this.classList.toggle("close");
            overlay.classList.toggle("overlay");
            if (test.style.display === "none") {
                test.style.display = "block";
            }
            else {
                test.style.display = "none";
            }
        });
    </script>


<section class="graphique">
        <div class="chart" id="piechart" style="width: 900px; height: 500px;"></div>
        <div class="chart" id="curve_chart" style="width: 900px; height: 500px"></div>
        <div class="chart" id="barchart_values" style="width: 900px; height: 500px;"></div>
    </section>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script>
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            var difficultyCounts = <?php echo $difficulty_counts_json; ?>;
            if (difficultyCounts.length > 0) {
                drawPieChart(difficultyCounts);
            }
        }

        function drawPieChart(difficultyCounts) {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Difficulte');
            data.addColumn('number', 'Nombre de défis réalisés');
            difficultyCounts.forEach(function(item) {
                data.addRow([item.Difficulte, parseInt(item.nombre_defis)]);
            });

            var options = {
                title: 'Proportion des défis réalisés selon chaque difficulté',
                pieSliceText: 'label',
                pieStartAngle: 100,
                colors: ['#ffb6c1', '#fff0b0'],
                slices: {0: {textStyle: {color: 'black'}}, 1: {textStyle: {color: 'black'}}}
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
        }
    </script>

    <script>
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Semaine', 'Empreinte carbone'],
                ['Semaine 1',  1120],
                ['Semaine 2',  1080],
                ['Semaine 3',  960],
                ['Semaine 4',  925]
            ]);

            var options = {
                title: 'Calcul de l\'empreinte carbone par semaine',
                curveType: 'function',
                legend: { position: 'bottom' },
                colors: ['#B5FF6D']
            };

            var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

            chart.draw(data, options);
        }
    </script>

    <script>
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ["Semaine", "Avancée des défis", { role: "style" }],
            ["Semaine 1", 8, "#153125"],
            ["Semaine 2", 12, "#384955"],
            ["Semaine 3", 17, "#86ACC6"],
            ["Semaine 4", 21, "#BDE3FF"]
            ]);

            var options = {
                title: "Avancée des défis par semaine",
                width: 600,
                height: 400,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
                colors: ['#153125', '#384955', '#86ACC6', '#BDE3FF']
            };
            var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
            chart.draw(data, options);
        }
    </script>

</body>
</html>