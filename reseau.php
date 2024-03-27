<?php
include("connect_bdd.php");

$sql_select_posts = "SELECT * FROM post ORDER BY Id_post DESC"; 
$stmt_select_posts = $db->query($sql_select_posts);
$posts = $stmt_select_posts->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/general.css">
    <link rel="stylesheet" href="./css/reseau.css">   
    <script src="https://kit.fontawesome.com/96e027db6d.js" crossorigin="anonymous"></script> 
    <title>EcoQuest | Communauté</title>
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

    <section id="blog">
    <div class="blog-heading">
        <span>Actualités</span>
        <h3>Communauté</h3>
    </div>

    <div class="blog-container">
        <?php
        include('connect_bdd.php');
        $sql_select_posts = "SELECT post.*, user.Nom, user.Grade FROM post LEFT JOIN user ON post.user_Id = user.Id_user ORDER BY Id_post DESC LIMIT 3";
        $result_select_posts = $db->prepare($sql_select_posts);
        $result_select_posts->execute();
        $posts = $result_select_posts->fetchAll(PDO::FETCH_ASSOC);

        foreach ($posts as $post) {
            $commentaire = isset($post['Commentaire']) ? $post['Commentaire'] : '';
            $nom_utilisateur = isset($post['Nom']) ? $post['Nom'] : 'Utilisateur inconnu';
            $grade_utilisateur = isset($post['Grade']) ? $post['Grade'] : '';

            echo "<div class='custom-post-container'>";
            echo "<div class='custom-post-image'>";
            echo "<img src='data:image/jpeg;base64," . base64_encode($post['Photo']) . "' alt='Image du post'>";
            echo "</div>";
            echo "<div class='custom-post-info'>";
            echo "<p class='custom-top-left-text'><strong>$nom_utilisateur</strong> - $grade_utilisateur</p>";
            echo "<p class='custom-comment'>$commentaire</p>";
            echo "</div>";
            echo "</div>";
        }
        ?>
    </div>
</section>


    <input type="radio" name="photos" id="check1" checked>
    <input type="radio" name="photos" id="check2">
    <input type="radio" name="photos" id="check3">
    <input type="radio" name="photos" id="check4">

    <div class="container">
        <h1>Posts</h1>
        <?php
    include('connect_bdd.php');
    $sql_select_posts = "SELECT post.*, user.Nom, user.Grade FROM post 
                         LEFT JOIN user ON post.user_Id = user.Id_user ORDER BY Id_post DESC";
    $result_select_posts = $db->prepare($sql_select_posts);
    $result_select_posts->execute();
    $posts = $result_select_posts->fetchAll(PDO::FETCH_ASSOC);

    foreach ($posts as $post) {
        $commentaire = isset($post['Commentaire']) ? $post['Commentaire'] : '';
        $nom_utilisateur = isset($post['Nom']) ? $post['Nom'] : 'Utilisateur inconnu';
        $grade_utilisateur = isset($post['Grade']) ? $post['Grade'] : '';

        echo "<div class='post-container'>";
        echo "<div class='post-image'>";
        echo "<img src='data:image/jpeg;base64," . base64_encode($post['Photo']) . "' alt='Image du post'>";
        echo "</div>";
        echo "<div class='post-info'>";
        echo "<p class=top-left-text><strong>$nom_utilisateur</strong> - $grade_utilisateur</p>";
        echo "<p class='comment'>$commentaire</p>";
        echo "</div>";
        echo "</div>";
    }
?>



    </div>

    <button id="ouvrirFormulaire"><i class="fa-solid fa-plus"></i></button>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeModal">&times;</span>
            <h2>Ajouter un post</h2>
            <form action="reseau_back.php" method="post" enctype="multipart/form-data">
                <label for="photo">Choisir une photo :</label>
                <input type="file" name="photo" id="photo" accept="image/*" required>
                <br>
                <label for="commentaire">Commentaire :</label>
                <textarea name="commentaire" id="commentaire" rows="4" required></textarea>
                <br>
                <button class="btn-form" type="submit">Publier</button>
            </form>
        </div>
    </div>

    <script>
        // Modal
        document.getElementById('ouvrirFormulaire').addEventListener('click', function() {
            document.getElementById('myModal').style.display = "block";
        });

        document.getElementById('closeModal').addEventListener('click', function() {
            document.getElementById('myModal').style.display = "none";
        });

        window.addEventListener('click', function(event) {
            var modal = document.getElementById('myModal');
            if (event.target == modal) {
                modal.style.display = "none";
            }
        });

        // Menu
        var burgerMenu = document.getElementById('burger-menu');

        var overlay = document.getElementById('menu');

        burgerMenu.addEventListener('click', function() {
            this.classList.toggle("close");
            overlay.classList.toggle("overlay");
        });
    </script>

  <script src="/js/reseau.js"></script>



</body>
</html>