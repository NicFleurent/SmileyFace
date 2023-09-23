
'use strict';

document.addEventListener('DOMContentLoaded', function () {
    let boutonEvent = document.querySelectorAll('.card[data-bs-toggle="offcanvas"]');

    boutonEvent.forEach((bouton) => {
        bouton.addEventListener('click', function () {
            let card = bouton.closest('.card');

            let nom = card.querySelector('.titreEvenement').textContent;
            let image = card.querySelector('.card-img-bottom').getAttribute('src');
            let date = card.querySelector('.card-text').textContent;
            let departements = card.querySelectorAll('.card-departement');
            let lien = card.querySelectorAll('.card-lien').textContent;

            let offcanvasTitre = document.querySelector('.offcanvas .card-header h2');
            let offcanvasImage = document.querySelector('.offcanvas img');
            let offcanvasDate = document.querySelector('.offcanvas .card-text');
            let offcanvasDepartement = document.querySelector('.offcanvas .card-departement');

            offcanvasTitre.textContent = nom;
            offcanvasImage.setAttribute('src', image);
            offcanvasDate.textContent = date;

            offcanvasDepartement.innerHTML = "";
            for(let i=0 ; i<departements.length ; i++){
                let departement = document.createElement("span");
                departement.setAttribute("class", "rounded text-departement p-2 m-2");
                departement.innerHTML = departements[i].innerHTML;
                offcanvasDepartement.append(departement);
            }

            console.log(bouton);
            let id = bouton.getAttribute("id");
            console.log(id)
            let btnChoixSondage = document.getElementById("btnChoixSondage");
            btnChoixSondage.setAttribute("href", "choixSondage.php?id=" + id);
            let btnStatistique = document.getElementById("btnStatistique");
            btnStatistique.setAttribute("href", "statistique.php?id=" + id);
            let btnGerer = document.getElementById("btnGerer");
            btnGerer.setAttribute("href", "modifier.php?id=" + id);
            let btnWeb = document.getElementById("btnWeb");
            btnWeb.setAttribute("href", lien);


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

