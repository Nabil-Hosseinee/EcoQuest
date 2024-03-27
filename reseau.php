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
            <a href="post.php"><i class="fa-solid fa-location-dot"></i></a>
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
            <div class="blog-box">
                <div class="blog-img">
                    <img src="images/commu/eoliennes.jpg" alt="blog">
                </div>

                <div class="blog-text">
                    <span>18 mars 2023 / Eoliennes</span>
                    <a href="#" class="blog-title">De nouvelles éoliennes installées</a>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus maiores obcaecati, repellat id aspernatur eaque numquam adipisci sapiente voluptatum vitae ut excepturi libero facilis, ratione ex recusandae voluptas esse dignissimos?</p>
                    <a href="#">Lire la suite</a>
                </div>
            </div>
            <div class="blog-box">
                <div class="blog-img">
                    <img src="images/commu/bouteille.jpg" alt="blog">
                </div>

                <div class="blog-text">
                    <span>18 mars 2023 / Eoliennes</span>
                    <a href="#" class="blog-title">De nouvelles éoliennes installées</a>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus maiores obcaecati, repellat id aspernatur eaque numquam adipisci sapiente voluptatum vitae ut excepturi libero facilis, ratione ex recusandae voluptas esse dignissimos?</p>
                    <a href="#">Lire la suite</a>
                </div>
            </div>
            <div class="blog-box">
                <div class="blog-img">
                    <img src="images/commu/usine.jpg" alt="blog">
                </div>

                <div class="blog-text">
                    <span>18 mars 2023 / Eoliennes</span>
                    <a href="#" class="blog-title">De nouvelles éoliennes installées</a>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus maiores obcaecati, repellat id aspernatur eaque numquam adipisci sapiente voluptatum vitae ut excepturi libero facilis, ratione ex recusandae voluptas esse dignissimos?</p>
                    <a href="#">Lire la suite</a>
                </div>
            </div>
        </div>
    </section>

    <input type="radio" name="photos" id="check1" checked>
    <input type="radio" name="photos" id="check2">
    <input type="radio" name="photos" id="check3">
    <input type="radio" name="photos" id="check4">

    <div class="container">
        <h1>Posts</h1>
        <div class="photo-gallery">
            <?php foreach ($posts as $post): ?>
                <div class="pic">
                    <?php if (isset($post['Photo']) && isset($post['Commentaire'])): ?>
                        <!-- Afficher l'image et le commentaire si disponibles -->
                        <img src="data:image/jpeg;base64,<?= base64_encode($post['Photo']) ?>" alt="Image du post">
                        <p><?= $post['Commentaire'] ?></p>
                    <?php else: ?>
                        <p>Données du post non disponibles.</p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <section id="add-post">
        <h2>Ajouter un post</h2>
        <form action="reseau_back.php" method="post" enctype="multipart/form-data">
            <label for="photo">Choisir une photo :</label>
            <input type="file" name="photo" id="photo" accept="image/*" required>
            <br>
            <label for="commentaire">Commentaire :</label>
            <textarea name="commentaire" id="commentaire" rows="4" required></textarea>
            <br>
            <button type="submit">Publier</button>
        </form>
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

  <script src="/js/reseau.js"></script>



</body>
</html>