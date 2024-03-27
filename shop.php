<?php 
session_start();
include('connect_bdd.php');
$id_num = $_SESSION['id_number'];
$identidiant = $_SESSION['identifiant'];
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoQuest | Shop</title>
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/shop.css">
    <script src="https://kit.fontawesome.com/96e027db6d.js" crossorigin="anonymous"></script>
</head>
<body>

    <div id="burger-menu">
        <span></span>
    </div>

    
      
    <div id="menu">

        <div class="info">
            <h2>Où veux-tu te rendre, <?php echo $identidiant; ?> ?</h2>
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
            <img src="./images/carte.jpg" alt="" class="responsive-image">
        </div>
    
        <div class="point defis_point" data-text="Défis">
            <a href="defis.php"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point profil_point" data-text="Profil">
            <a href="profil.php"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point reseau_point" data-text="Réseau">
            <a href=""><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point dashboard_point" data-text="Dashboard">
            <a href="dash.php"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    
        <div class="point shop_point" data-text="Boutique">
            <a href="shop.html"><i class="fa-solid fa-location-dot"></i></a>
        </div>
    </div>
    
    <div class="banner">
        <div class="bg-banner">
            <img id="affichage-banner" src="./images/items/ban5.png" alt="">
        </div>
        <div class="overlay-text">
            <h1>Boutique</h1>
            <h2>Dépense les points que tu as gagné avec les défis ici !</h2>
        </div>
    </div>

    <?php 
    
    $bannerSelect = "SELECT * FROM item WHERE `Type` = 'Banniere'";
    $result_bannerSelect = $db->prepare($bannerSelect);
    $result_bannerSelect->execute();
    $banniere = $result_bannerSelect->fetchAll(PDO::FETCH_ASSOC);

    $avatarSelect = "SELECT * FROM item WHERE `Type` = 'Avatar' AND `Intitule item` != 'Avatar 1'";
    $result_avatarSelect = $db->prepare($avatarSelect);
    $result_avatarSelect->execute();
    $avatar = $result_avatarSelect->fetchAll(PDO::FETCH_ASSOC);



    ?>

    <section id="shop">

        <div class="banniere">
            <h3>Les Bannières</h3>
            <p>Ces items vous servent à designer votre profil.</p>
            <div class="banniere-container">
                <?php  
                    foreach ($banniere as $bannieres) {
                        $lien = $bannieres['Lien image'];
                        $intitule = $bannieres['Intitule item'];
                        $prix = $bannieres['Prix'];
                        $id_banner = $bannieres['Id_item'];

                        $sql_statut = "SELECT * FROM `acquisition` WHERE `user_Id`=$id_num AND `item_Id`=$id_banner AND `Obtenu`=1";
                        $result_select_statut = $db->prepare($sql_statut);
                        $result_select_statut->execute();
                        $banner_statut = $result_select_statut->fetchAll(PDO::FETCH_ASSOC);

                        echo "
                            <div class='banniere-box'>
                                <h4>$intitule</h4>
                                <img src='$lien' alt=''>";
                            if (count($banner_statut)!=0) {
                                echo "
                                    <h5>Item Obtenu</h5>
                                ";
                            }
                            else {
                                echo "
                                    <form action='achat_realise.php' method='post' id='$id_banner'>
                                        <p>Prix : $prix</p>
                                        <input type='hidden' name='itemId' value='$id_banner' form='$id_banner'>
                                        <button type='submit' name='achat_item'>Acheter cet item</button>
                                    </form>
                                ";
                            }
                        
                        echo "</div>";
                    }
                ?>
            </div>
        </div>

        <div class="avatar">
            <h3>Les Avatars</h3>
            <p>Choissiser l'avatar qui vous correspond.</p>
            <div class="avatar-container">
                <?php 
                    foreach ($avatar as $avatars) {
                        $lien = $avatars['Lien image'];
                        $intitule = $avatars['Intitule item'];
                        $prix = $avatars['Prix'];
                        $id_avatar = $avatars['Id_item'];

                        $sql_statut_avatar = "SELECT * FROM `acquisition` WHERE `user_Id`=$id_num AND `item_Id`=$id_avatar AND `Obtenu`=1";
                        $result_select_statut_avatar = $db->prepare($sql_statut_avatar);
                        $result_select_statut_avatar->execute();
                        $avatar_statut = $result_select_statut_avatar->fetchAll(PDO::FETCH_ASSOC);

                        echo "
                            <div class='banniere-box'>
                                <h4>$intitule</h4>
                                <img src='$lien' alt=''>
                            ";
                            if (count($avatar_statut) != 0) {
                                echo "
                                    <h5>Item Obtenu</h5>
                                ";
                            }
                            else {
                                echo "
                                    <form action='achat_realise.php' method='post' id='$id_avatar'>
                                        <p>Prix : $prix</p>
                                        <input type='hidden' name='itemId' value='$id_avatar' form='$id_avatar'>
                                        <button type='submit' name='achat_item'>Acheter cet item</button>
                                    </form>
                                ";
                            }
                            echo "</div>";
                    }
                ?>
            </div>
        </div>
    </section> 

      
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


    </script>

</body>
</html>