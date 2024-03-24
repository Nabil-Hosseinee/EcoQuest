<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoQuest | Défis</title>
    <link rel="stylesheet" href="./css/defis.css">
    <link rel="stylesheet" href="./css/general.css">
    <script src="https://kit.fontawesome.com/96e027db6d.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    
</head>
<body>

    <div id="burger-menu">
        <span></span>
    </div>
      
    <div id="menu">
        <div class="info">
            <h2>Où voulez vous vous rendre ?</h2>
        </div>

        <div class="image-container">
            <img src="./images/carte.jpg" alt="" class="responsive-image">
        </div>
    
        <div class="point defis_point" data-text="Défis">
            <a href="defis.php"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point profil_point" data-text="Profil">
            <a href="profil.html"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point reseau_point" data-text="Réseau">
            <a href=""><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point dashboard_point" data-text="Dashboard">
            <a href=""><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point shop_point" data-text="Boutique">
            <a href=""><i class="fa-solid fa-location-dot"></i></a>
        </div>
    </div>

    
    <div class="bg-container"></div>


    <header>
        <h2>Rapide, Facile et Utile</h2>
        <h1>Défis</h1>
        <p>Remplissez vos défis, sauvez la planète et remplissez toutes vos quêtes</p>
    </header>


    <section class="quotidien">
        <div class="left">
            <h2>Défis Quotidiens</h2>
            <p>Terminer vos défis quotidiens écologiques, c'est comme devenir un aventurier de l'éco, explorant un monde de solutions vertes avec enthousiasme et créativité pour un avenir plus cool et plus vert !</p>
            <img src="./images/defis_quotidien.png" alt="">
        </div>
        <div class="right">
            <?php
                include('connect_bdd.php');

                $sql_select_defis = "SELECT defis.*, defis_quotidiens.defi_id1, defis_quotidiens.defi_id2, defis_quotidiens.defi_id3, defis_quotidiens.Id_defis_quotidiens
                                    FROM defis_quotidiens 
                                    INNER JOIN defis ON defis_quotidiens.defi_id1 = defis.Id_defis 
                                                    OR defis_quotidiens.defi_id2 = defis.Id_defis 
                                                    OR defis_quotidiens.defi_id3 = defis.Id_defis";
                $result_select_defis = $db->prepare($sql_select_defis);
                $result_select_defis->execute();
                $defis_quotidiens = $result_select_defis->fetchAll(PDO::FETCH_ASSOC);

                foreach ($defis_quotidiens as $defi_quotidien) {
                    $id_defis_quotidiens = $defi_quotidien['Id_defis'];
                    $difficulte_defi = "";
                    switch ($defi_quotidien["Difficulte"]) {
                        case 0:
                            $difficulte_defi = "facile";
                            break;
                        case 1:
                            $difficulte_defi = "moyen";
                            break;
                        case 2:
                            $difficulte_defi = "difficile";
                            break;
                        default:
                            $difficulte_defi = "Inconnu";
                    }
                    
                    $intitule=$defi_quotidien['Intitule defis'];
                    $status=$defi_quotidien['Status'];
                
                    echo "<div class='box'>
                        <div class='icon-container'>
                        <i class='fa-solid fa-bicycle'></i>
                        </div>
                        <div class='description'>
                        <h3>Défi $difficulte_defi</h3>
                        <p>$intitule</p>";
                    
                        if ($status==2) {
                        echo "Défi complété";
                    }
                    else {
                        echo "<form action='defi_realise.php' method='post' id='$id_defis_quotidiens'>
                        <input type='hidden' name='defi_id' value='$id_defis_quotidiens' form='$id_defis_quotidiens'>
                        <button type='submit' name='complete_defi' form='$id_defis_quotidiens'>Compléter le défi</button>
                        </form>";
                    }
                        
                    echo "</div>
                        </div>";
                }
            ?>
        </div>
    </section>

    <section class="alldefis">
        <h2>Liste de tous les défis</h2>

        <ul class="defis-filtre">
            <li class="list defis-filtre-active" data-filter="all">Tout</li>
            <li class="list" data-filter="facile">Facile</li>
            <li class="list" data-filter="moyen">Moyen</li>
            <li class="list" data-filter="difficile">Difficile</li>
        </ul>

        <div class="defis-container">
            <?php
                include('connect_bdd.php');

                $sql_select_defis = "SELECT * FROM defis";
                $result_select_defis = $db->prepare($sql_select_defis);
                $result_select_defis->execute();
                $defis = $result_select_defis->fetchAll(PDO::FETCH_ASSOC);

                foreach ($defis as $defi) {
                    $difficulte_defi = "";
                    switch ($defi["Difficulte"]) {
                        case 0:
                            $difficulte_defi = "facile";
                            break;
                        case 1:
                            $difficulte_defi = "moyen";
                            break;
                        case 2:
                            $difficulte_defi = "difficile";
                            break;
                        default:
                            $difficulte_defi = "Inconnu";
                    }

                    echo '<div class="box all-box ' . $difficulte_defi . '">' .
                        '<div class="icon all-icon">' .
                        '<div class="box icon-container">';
                    echo '</div>' .
                        '</div>' .
                        '<div class="description">' .
                        '<h3>Défi ' . ucfirst($difficulte_defi) . '</h3>' . 
                        '<p>' . $defi["Intitule defis"] . '</p>' .
                        '</div>' .
                        '</div>';
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
        });


        // jquery animation alldefis
        
        // pour le filtre du menu
        $(document).on('click', '.defis-filtre li', function() {
            $(this).addClass('defis-filtre-active').siblings().removeClass('defis-filtre-active');
        })

        // pour le filtre des défis
        $(document).ready(function() {
            $('.list').click(function() {
                const value = $(this).attr('data-filter');
                if (value == 'all') {
                    $('.all-box').show('1000')
                }
                else {
                    $('.all-box').not('.'+value).hide('1000');
                    $('.all-box').filter('.'+value).show('1000');
                }
            })
        })
    </script>
</body>
</html>