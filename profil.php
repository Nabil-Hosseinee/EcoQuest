<?php 

include("connect_bdd.php");


$demandeBanner = "SELECT * FROM `item` WHERE `Type` = 'Banniere'";
$resultBanner = $db->prepare($demandeBanner);
$resultBanner->execute();
$defBanner = $resultBanner->fetchAll(PDO::FETCH_ASSOC);


$demandeAvatar = "SELECT * FROM `item` WHERE `Type` = 'Avatar'";
$resultAvatar = $db->prepare($demandeAvatar);
$resultAvatar->execute();
$defAvatar = $resultAvatar->fetchAll(PDO::FETCH_ASSOC);

// echo "<pre>";
// var_dump($def);
// echo "<pre>";

// foreach ($def as $defis) {
//     echo $defis['Intitule item'];
//     echo '<br>';
//     echo $defis['Lien image'];
//     echo '<br>';
//     echo '<br>';
// }

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

        <div class="image-container">
            <img src="./images/carte.jpg" alt="" class="responsive-image">
        </div>
    
        <div class="point defis_point" data-text="Défis">
            <a href="defis.html"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point profil_point" data-text="Profil">
            <a href="profil.php"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point reseau_point" data-text="Réseau">
            <a href=""><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point dashboard_point" data-text="Dashboard">
            <a href="dash.html"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point shop_point" data-text="Boutique">
            <a href=""><i class="fa-solid fa-location-dot"></i></a>
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
            <!-- <img class="select-banner" src="./images/banner1.avif" alt="">
            <img class="select-banner" src="./images/banner2.avif" alt="">
            <img class="select-banner" src="./images/banner3.avif" alt="">
            <img class="select-banner" src="./images/banner1.avif" alt=""> -->
        </div>
        <p>Avatar</p>
        <div class="avatar">
            <!-- <img class="select-avatar" src="./images/avatar1.webp" alt="">
            <img class="select-avatar" src="./images/avatar2.jpg" alt="">
            <img class="select-avatar" src="./images/avatar3.jpg" alt="">
            <img class="select-avatar" src="./images/avatar1.webp" alt="">
            <img class="select-avatar" src="./images/avatar1.webp" alt="">
            <img class="select-avatar" src="./images/avatar2.jpg" alt=""> -->
            
            <?php 
                foreach ($defAvatar as $defis) {
                    echo "<img class='select-avatar' src=" . $defis['Lien image'] ." alt= " . $defis['Intitule item'] . ">";
                }
            ?>
        </div>
    </div>


    <div class="banner">
        <div class="bg-banner">
            <img id="affichage-banner" src="./images/banner1.avif" alt="">
        </div>
        <div class="banner-container">
            <h1>Nom Prénom</h1>
            <div class="photo"><img id="affichage-avatar" src="./images/avatar1.webp" alt=""></div>
            <div class="pseudo">@pseudo / [Grade]</div>
        </div>
    </div>

    <div class="container">
        <div class="defi-info">
            <h2>Défis</h2>
            <div class="box" id="box">
                <div class="icon">
                    <div class="box icon-container">
                        <i class="fa-solid fa-bicycle"></i>
                    </div>
                </div>
                <div class="description">
                    <h3>Défis 1 | Moyen</h3>
                    <p>Parcourir 20km en vélos dans une journée.</p>
                    <div class="progress-bar__wrapper">
                        <label class="progress-bar__value" htmlFor="progress-bar"> 90% </label>
                        <progress id="progress-bar" value="90" max="100"><progress>
                    </div>
                </div>
            </div>

            <div class="box" id="box">
                <div class="icon">
                    <div class="box icon-container">
                        <i class="fa-solid fa-lemon"></i>
                    </div>
                </div>
                <div class="description">
                    <h3>Défis 1 | Facile</h3>
                    <p>Manger 3 fruits</p>
                    
                    <div class="progress-bar__wrapper">
                        <!-- remplacer le 40% par le pourcentage d'avancement dans la BDD -->
                        <label class="progress-bar__value" htmlFor="progress-bar"> 50% </label>
                        <!-- Remplacer le '40' de l'attribut'value' par une balise php avec le pourcentage d'avancement -->
                        <progress id="progress-bar" value="50" max="100"><progress>
                    </div>
                </div>
            </div>
            
            <div class="box" id="box">
                <div class="icon">
                    <div class="box icon-container">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                </div>
                <div class="description">
                    <h3>Défis 1 | Difficile</h3>
                    <p>Faire un voyage en Afrique et planter 32 arbres.</p>
                    
                    <div class="progress-bar__wrapper">
                        <label class="progress-bar__value" htmlFor="progress-bar"> 30% </label>
                        <progress id="progress-bar" value="30" max="100"><progress>
                    </div>
                </div>
            </div>


        </div>
    
        <div class="separator" id="separator"></div>
    
        <div class="donnees-infos">
            <h2>Mes données</h2>
            <div class="donnees-container">
                <div class="top-donnees"></div>
                <div class="bot-donnees"></div>
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