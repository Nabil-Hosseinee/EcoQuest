<?php 
include("connect_bdd.php");
include("grade.php");

$id_num = $_SESSION['id_number'];
$nom = $_SESSION['nom'];
$pseudo = $_SESSION['pseudo'];
$grade = $_SESSION['grade'];


$demandeBanner = "SELECT * FROM `item` WHERE `Type` = 'Banniere'";
$resultBanner = $db->prepare($demandeBanner);
$resultBanner->execute();
$defBanner = $resultBanner->fetchAll(PDO::FETCH_ASSOC);

$demandeAvatar = "SELECT * FROM `item` WHERE `Type` = 'Avatar'";
$resultAvatar = $db->prepare($demandeAvatar);
$resultAvatar->execute();
$defAvatar = $resultAvatar->fetchAll(PDO::FETCH_ASSOC);

$demandeMonnaie = "SELECT Monnaie FROM user WHERE Id_user = $id_num";
$resultMonnaie = $db->prepare($demandeMonnaie);
$resultMonnaie->execute();
$defMonnaie = $resultMonnaie->fetchAll(PDO::FETCH_ASSOC);

foreach ($defMonnaie as $defMonnaies) {
    $argent = $defMonnaies['Monnaie'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoQuest | Profil</title>
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/profil.css">
    <script src="https://kit.fontawesome.com/96e027db6d.js" crossorigin="anonymous"></script>
</head>
<body>

    <div id="burger-menu">
        <span></span>
    </div>

    
    
    <div id="menu">

        <div class="info">
            <h2>Où voulez vous vous rendre ?</h2>
        </div>

        <a href="deconnexion.php">
            <button>
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

    <div id="test">
        <i class="fa-solid fa-gear"></i>
    </div>

    <div id="choix">
        <h2>Customiser mon Profil</h2>
        <p>Mes Bannières</p>
        <div class="banniere">
            <?php 
                foreach ($defBanner as $defis) {
                    echo "<img class='select-banner' src=" . $defis['Lien image'] ." alt= " . $defis['Intitule item'] . ">";
                }
            ?>
        </div>
        <p>Avatar</p>
        <div class="avatar">
            <?php 
                foreach ($defAvatar as $defis) {
                    echo "<img class='select-avatar' src=" . $defis['Lien image'] ." alt= " . $defis['Intitule item'] . ">";
                }
            ?>
        </div>
    </div>

    <div class="banner">
        <div class="monnaie">
            <h3>Votre monnaie :</h3>
            <p><?php echo $argent; ?></p>
        </div>
        <div class="bg-banner">
            <img id="affichage-banner" src="./images/items/ban2.jpg" alt="">
        </div>
        <div class="banner-container">
            <h1><?php echo $nom ?></h1>
            <div class="photo"><img id="affichage-avatar" src="./images/items/pp1.png" alt=""></div>
            <div class="pseudo"><?php echo "@" . $pseudo?> / [<?php echo $grade; ?>]</div>
        </div>
    </div>

    <div class="container">
        <div class="defi-info">
            <h2>Défis</h2>

            <?php 

                $sql_select_defis = "SELECT DISTINCT defis_quotidiens.*, defis.*, realisation.Statut FROM defis_quotidiens 
                INNER JOIN defis ON defis_quotidiens.defi_id1 = defis.Id_defis 
                                OR defis_quotidiens.defi_id2 = defis.Id_defis 
                                OR defis_quotidiens.defi_id3 = defis.Id_defis 
                LEFT JOIN realisation ON realisation.user_Id = defis_quotidiens.user_id 
                AND (realisation.defis_Id = defis_quotidiens.defi_id1 
                                OR realisation.defis_Id = defis_quotidiens.defi_id2 
                                OR realisation.defis_Id = defis_quotidiens.defi_id3) 
                WHERE defis_quotidiens.user_id = $id_num;";
                                                    
                $result_select_defis = $db->prepare($sql_select_defis);
                $result_select_defis->execute();
                $defis_quotidiens = $result_select_defis->fetchAll(PDO::FETCH_ASSOC);


                foreach ($defis_quotidiens as $defi_quotidien) {
                    $id_defis_quotidiens = $defi_quotidien['Id_defis'];
                    $difficulte_defi = $defi_quotidien['Difficulte'];
                    $icone=$defi_quotidien['Icone'];
                    $intitule=$defi_quotidien['Intitule defis'];

                    $sql_statut="SELECT * FROM realisation WHERE user_id=$id_num AND defis_id=$id_defis_quotidiens";

                    $result_select_statut = $db->prepare($sql_statut);
                    $result_select_statut->execute();
                    $defis_statut = $result_select_statut->fetchAll(PDO::FETCH_ASSOC);


                    //$statut=$defi_quotidien['Statut'];
                
                    echo "
                        <div class='box' id='box'>
                            <div class='icon'>
                                <div class='box icon-container'>
                                    <img src='$icone'>
                                </div>
                            </div>

                            <div class='description'>
                                <h3>Défi $difficulte_defi</h3>
                                <p>$intitule</p>";
                    
                        if (count($defis_statut)!=0) {
                        echo "
                            <h6> 
                                Défi complété
                            </h6>
                            ";
                    }
                    else {
                        echo "
                            <h6>
                                Défis en cours  
                            </h6>
                        ";
                    }
                        
                    echo "
                            </div>
                        </div>";
                }
            ?>
        </div>
    
        <div class="separator" id="separator"></div>
    
        <div class="donnees-infos">
            <h2>Classement</h2>
            <div class="classement">
                <?php 
                
                    $select_user_classement = "SELECT * FROM user ORDER BY `Total score` DESC LIMIT 10";
                    $classement_result = $db->prepare($select_user_classement);
                    $classement_result->execute();
                    $classement = $classement_result->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <table>
                    <tr>
                        <th>Numéro</th>
                        <th>Pseudo</th>
                        <th>Grade</th>
                        <th>Total Score</th>
                    </tr>

                    <?php
                        $compteur = 1;
                        foreach ($classement as $classements) {
                            $pseudo_class = $classements['Pseudo'];
                            $grade_class = $classements['Grade'];
                            $score_class = $classements['Total score'];

                            echo "
                                <tr>
                                    <td>$compteur</td>
                                    <td>$pseudo_class</td>
                                    <td>$grade_class</td>
                                    <td>$score_class</td>
                                </tr>
                            ";

                            $compteur+=1;
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>


    <script>

        // script pour afficher la carte 
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


        // script pour afficher les bannières et avatars
        var test = document.getElementById('test');
        var overlay2 = document.getElementById('choix');

        test.addEventListener('click', function() {
            overlay2.classList.toggle("filtre");
            if (burgerMenu.style.display === "none") {
                burgerMenu.style.display = "block";
            }
            else {
                burgerMenu.style.display = "none";
            }
        })


        // scrip pour choisir l'avatar
        var selects = document.querySelectorAll('.select-avatar');
        var affichageAvatar = document.getElementById('affichage-avatar');

        for (var i = 0; i < selects.length; i++) {
            selects[i].addEventListener('click', function() {
                console.log("c'est cliqué!!!");
                var src = this.getAttribute('src');
                console.log("L'image cliquée a pour source : " + src);
                affichageAvatar.src = src;
                overlay2.classList.toggle("filtre");
                
                if (burgerMenu.style.display === "none") {
                    burgerMenu.style.display = "block";
                }
                else {
                    burgerMenu.style.display = "none";
                }
            })
        }

        // script pour choisir la bannière
        var bannerSelects = document.querySelectorAll('.select-banner');
        var affichageBanner = document.getElementById('affichage-banner');

        for (var i = 0; i < bannerSelects.length; i++) {
            bannerSelects[i].addEventListener('click', function() {
                var bannerSrc = this.getAttribute('src');
                console.log("La bannière cliquée a pour source : " + bannerSrc);
                affichageBanner.src = bannerSrc;
                overlay2.classList.toggle("filtre");

                if (burgerMenu.style.display === "none") {
                    burgerMenu.style.display = "block";
                }
                else {
                    burgerMenu.style.display = "none";
                }
            })
        }
    </script>

</body>
</html>