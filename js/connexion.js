'use strict';

document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('usager1').addEventListener('input', validationVideUsager);
    document.getElementById('mdp1').addEventListener('input', validationVideMdp);
    /**
     * 
     */
    function validationVideUsager() {
        let usager = document.getElementById('usager1');

        let usagerErreur = document.getElementById('usagerVide');


        if (usager.value == '' || usager.value == null) {
            usagerErreur.textContent = 'Veuillez entrer votre nom d\'utilisateur';
            usager.classList.add('is-invalid');
        }
        else {
            usagerErreur.textContent = '';
            usager.classList.remove('is-invalid');
        }
    }

    function validationVideMdp() {
        let mdp = document.getElementById('mdp1');
        let mdpErreur = document.getElementById('mdpVide');

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