const postForm = document.getElementById('post-form');

postForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Empêche l'envoi du formulaire

    // Récupère les données du formulaire
    const description = document.getElementById('description').value;
    const image = document.getElementById('image').files[0];

    // Met à jour l'image sélectionnée dans la galerie
    const selectedImage = document.getElementById('selectedImage');
    selectedImage.src = URL.createObjectURL(image);

    // Crée un nouvel élément de post
    const postCard = document.createElement('div');
    postCard.classList.add('post-card');
    postCard.innerHTML = `
        <div class="post-image">
            <img src="${URL.createObjectURL(image)}" alt="Post Image">
        </div>
        <div class="post-details">
            <p>${description}</p>
            <div class="comment-section">
                <input type="text" placeholder="Ajouter un commentaire...">
                <button>Ajouter</button>
            </div>
        </div>
    `;

    // Ajoute le nouvel élément de post à la galerie d'images
    const photoGallery = document.querySelector('.photo-gallery');
    const newPic = document.createElement('div');
    newPic.classList.add('pic');
    newPic.innerHTML = `
        <img src="${URL.createObjectURL(image)}" alt="">
    `;
    photoGallery.appendChild(newPic);
});
