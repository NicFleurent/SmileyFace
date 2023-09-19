
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

            console.log(bouton);
            let id = bouton.getAttribute("id");
            console.log(id)
            let btnChoixSondage = document.getElementById("btnChoixSondage");
            btnChoixSondage.setAttribute("href", "choixSondage.php?id=" + id);
            let btnStatistique = document.getElementById("btnStatistique");
            btnStatistique.setAttribute("href", "statistique.php?id=" + id);
            let btnGerer = document.getElementById("btnGerer");
            btnGerer.setAttribute("href", "modifier.php?id=" + id);


        });

    });


    // let eventLi = document.querySelectorAll('.row li')
    // eventLi.forEach((event) => {
    //     document.getElementById('barreRecherche').addEventListener('input', function () {
    //         let champRecherche = getElementById('barreRecherche').value;
    //         let nom = card.querySelector('.card-title').textContent;
    //         if(champRecherche.includes(nom)){

    //         }
    //     });
    // });






});

