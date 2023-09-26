'use strict';

/* global bootstrap */

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('usagerCreer').addEventListener('input', validationVideUsager);
    document.getElementById('mdpCreer').addEventListener('input', validationVideMdp);

    /**
     * Permet d'afficher un message d'erreur si le champ usager vide
     */
    function validationVideUsager() {
        let usager = document.getElementById('usagerCreer');
        let usagerErreur = document.getElementById('usagerCreerVide');
        if (usager.value == '' || usager.value == null) {
            usagerErreur.textContent = 'Veuillez entrer votre nom d\'usager';
            usager.classList.add('is-invalid');
        }
        else {
            usagerErreur.textContent = '';
            usager.classList.remove('is-invalid');
        }
    }
    /**
     * Permet d'afficher un message d'erreur si le champ mdp est vide
     */
    function validationVideMdp() {
        let mdp = document.getElementById('mdpCreer');
        let mdpErreur = document.getElementById('mdpCreerVide');
        if (mdp.value == '' || mdp.value == null) {
            mdpErreur.textContent = 'Veuillez entrer votre mot de passe';
            mdp.classList.add('is-invalid');
        }
        else {
            mdpErreur.textContent = '';
            mdp.classList.remove('is-invalid');
        }
    }
   
});