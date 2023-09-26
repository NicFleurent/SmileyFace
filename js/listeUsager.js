'use strict';

/* global bootstrap */

/**
     * Créer un toast lors d'un ajout
     */
function creerToastA() {
    let optionsToast = {
        delay: 3000,
        animation: true,
        autohide: false
    };

    new bootstrap.Toast(document.getElementById('toast-A'), optionsToast).show();
}

/**
     * Créer un toast lors d'un ajout
     */
function creerToastM() {
    let optionsToast = {
        delay: 3000,
        animation: true,
        autohide: false
    };

    new bootstrap.Toast(document.getElementById('toast-M'), optionsToast).show();
}

//Fait apparaître un avis de suppression
// document.getElementById('confirmSupp').addEventListener('click', function (event) {

//     let options = {
//        backdrop: true,
//        keyboard: true,
//        show: true
//     };

//     new bootstrap.Modal(document.getElementById('modalSupp'), options).show();
// });



