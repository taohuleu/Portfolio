// Fichier : asset/js/carousel.js

document.addEventListener('DOMContentLoaded', function() {

    const carousel = document.querySelector('.carousel');
    if (!carousel) return;

    const slidesContainer = carousel.querySelector('.carousel-slides');
    const slides = carousel.querySelectorAll('.carousel-slide');
    const prevButton = carousel.querySelector('.carousel-prev');
    const nextButton = carousel.querySelector('.carousel-next');

    let currentIndex = 0;
    // MODIFICATION : La dernière position possible est le nombre de slides moins 4 (puisqu'on en affiche 4)
    const lastIndex = slides.length - 4; 

    function goToSlide(index) {
        // Gérer la boucle infinie
        if (index < 0) {
            index = lastIndex; // Si on recule depuis le début, on va à la fin
        } else if (index > lastIndex) {
            index = 0; // Si on avance depuis la fin, on revient au début
        }
        
        // MODIFICATION : La translation est de 25% par index
        slidesContainer.style.transform = `translateX(-${index * 25}%)`;
        currentIndex = index;
    }

    // Écouteurs d'événements pour les boutons
    prevButton.addEventListener('click', () => {
        goToSlide(currentIndex - 1);
    });

    nextButton.addEventListener('click', () => {
        goToSlide(currentIndex + 1);
    });

    // Initialiser le carrousel
    goToSlide(0);
});