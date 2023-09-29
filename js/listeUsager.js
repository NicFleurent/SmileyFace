'use strict';

/* global bootstrap */
document.addEventListener('DOMContentLoaded', function () {
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

    /**
     * Créer un toast modif mdp
     */
    function creerToastMdp() {
        let optionsToast = {
            delay: 3000,
            animation: true,
            autohide: false
        };

        new bootstrap.Toast(document.getElementById('toast-Mdp'), optionsToast).show();
    }
});
    //Fait apparaître un avis de suppression
    let btnSupp = document.querySelectorAll('.btn-supprimer');
    let modalIdInput = document.getElementById('supp_id'); // Fix: Get the input element by its ID

    btnSupp.forEach(btn => {
        btn.addEventListener('click', function () {
            let plusPresTr = btn.closest('tr');
            let tableTd = plusPresTr.querySelector('td:first-child');

            modalIdInput.value = tableTd.textContent;
            let options = {
                backdrop: true,
                keyboard: true,
                show: true
            };

            new bootstrap.Modal(document.getElementById('modalSupp'), options).show();

        });
    });












