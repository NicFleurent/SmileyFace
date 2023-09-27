
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
            let lien = card.querySelector('.card-lien').innerHTML;

            let offcanvasCarte = document.querySelector('.offcanvas .card-event');
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
                departement.setAttribute("class", "rounded text-departement text-center p-2 m-2");
                departement.innerHTML = departements[i].innerHTML;
                offcanvasDepartement.append(departement);
            }

            if(window.innerHeight >= 1330){
                if(offcanvasDepartement.offsetHeight > 960){
                    offcanvasImage.style.display="none";
                    offcanvasCarte.setAttribute("class","card card-event");
                }
                else if(offcanvasDepartement.offsetHeight > 790){
                    offcanvasImage.style.display="none";
                    offcanvasCarte.setAttribute("class","card h-100 card-event");
                }
                else{
                    offcanvasImage.style.display="block";
                    offcanvasCarte.setAttribute("class","card h-100 card-event");
                }
            }
            else if(window.innerHeight >= 960){
                if(offcanvasDepartement.offsetHeight > 600){
                    offcanvasImage.style.display="none";
                    offcanvasCarte.setAttribute("class","card card-event");
                }
                else if(offcanvasDepartement.offsetHeight > 300){
                    offcanvasImage.style.display="none";
                    offcanvasCarte.setAttribute("class","card h-100 card-event");
                }
                else{
                    offcanvasImage.style.display="block";
                    offcanvasCarte.setAttribute("class","card h-100 card-event");
                }
            }
            else if(window.innerHeight >= 800){
                if(offcanvasDepartement.offsetHeight > 420){
                    offcanvasImage.style.display="none";
                    offcanvasCarte.setAttribute("class","card card-event");
                }
                else if(offcanvasDepartement.offsetHeight > 180){
                    offcanvasImage.style.display="none";
                    offcanvasCarte.setAttribute("class","card h-100 card-event");
                }
                else{
                    offcanvasImage.style.display="block";
                    offcanvasCarte.setAttribute("class","card h-100 card-event");
                }
            }
            else{
                offcanvasImage.style.display="none";
                offcanvasCarte.setAttribute("class","card card-event");
            }
            

            let id = bouton.getAttribute("id");
            let btnChoixSondage = document.getElementById("btnChoixSondage");
            btnChoixSondage.setAttribute("href", "validation.php?destination=choixSondage&id=" + id);
            let btnStatistique = document.getElementById("btnStatistique");
            btnStatistique.setAttribute("href", "statistique.php?id=" + id);
            let btnGerer = document.getElementById("btnGerer");
            btnGerer.setAttribute("href", "validation.php?destination=modifier&id=" + id);

            let inputId = document.getElementById("inputId");
            inputId.setAttribute("value", id);

            let btnWeb;
            if(document.getElementById("btnWeb") !== null){
                btnWeb = document.getElementById("btnWeb");
            }
            else{
                btnWeb = document.getElementById("btnWebDisable");
            }
            
            btnWeb.setAttribute("target", "_blank");
            if(lien == ""){
                btnWeb.classList.remove("radius-0");
                btnWeb.classList.remove("btn");
                btnWeb.classList.remove("btn-ctr-bleu");
                btnWeb.classList.add("text-center");
                btnWeb.setAttribute("id", 'btnWebDisable');
                btnWeb.removeAttribute("href");
            }
            else{
                btnWeb.classList.add("radius-0");
                btnWeb.classList.add("btn");
                btnWeb.classList.add("btn-ctr-bleu");
                btnWeb.classList.remove("text-center");
                btnWeb.setAttribute("id", 'btnWeb');
                btnWeb.setAttribute("href", lien);
                btnWeb.setAttribute("target", "_blank");
            }
            


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

