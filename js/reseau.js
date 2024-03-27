const postForm = document.getElementById('post-form');

postForm.addEventListener('submit', function (event) {
    event.preventDefault(); // Empêche l'envoi du formulaire

    // Récupère l'image du formulaire
    const image = document.getElementById('image').files[0];

    // Crée un nouvel élément pour l'image téléchargée
    const photoGallery = document.querySelector('.photo-gallery');
    const newPic = document.createElement('div');
    newPic.classList.add('pic', 'moi');  // Ajoute la classe 'moi' pour le filtrage
    newPic.innerHTML = `
        <img src="${URL.createObjectURL(image)}" alt="">
    `;
    photoGallery.appendChild(newPic);
});

// Filtre les photos en fonction de la sélection
document.querySelectorAll('input[name="photos"]').forEach(input => {
    input.addEventListener('change', function() {
        const selectedFilter = this.id.replace('check', ''); // Récupère le numéro du check
        const pics = document.querySelectorAll('.pic');
        
        pics.forEach(pic => {
            if (pic.classList.contains(selectedFilter) || selectedFilter === '1') {
                pic.style.display = 'block';
            } else {
                pic.style.display = 'none';
            }
        });
    });
});
