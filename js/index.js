
'use strict';

document.addEventListener('DOMContentLoaded', function () {
    let boutonEvent = document.querySelectorAll('.btn[data-bs-toggle="offcanvas"]');

    boutonEvent.forEach((bouton) => {
        bouton.addEventListener('click', function () {
            let card = bouton.closest('.card');

            let nom = card.querySelector('.card-title').textContent;
            let image = card.querySelector('.card-img-top').getAttribute('src');
            let departement = card.querySelector('.card-text').textContent;

            let offcanvasTitre = document.querySelector('.offcanvas .card-header h2');
            let offcanvasImage = document.querySelector('.offcanvas img');
            let offcanvasTexte = document.querySelector('.offcanvas .card-text');

            offcanvasTitre.textContent = nom;
            offcanvasImage.setAttribute('src', image);
            offcanvasTexte.textContent = departement;


        });

    });

    document.getElementById('barreRecherche').addEventListener('input', (e) => {
    let champRecherche = getElementById('barreRecherche').value
    
    });

});

