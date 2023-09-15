'use strict';

document.addEventListener('DOMContentLoaded', function () {



    document.getElementById('usager1').addEventListener('blur', validationVide);
    document.getElementById('mdp1').addEventListener('blur', validationVide);
    /**
     * 
     */
    function validationVide() {
        let usager = document.getElementById('usager1');
        let mdp = document.getElementById('mdp1');
        let usagerErreur = document.getElementById('usagerVide');
        let mdpErreur = document.getElementById('mdpVide');


        if (usager.value == '') {
            usagerErreur.textContent = 'Veuillez entrer votre nom d\'usager';
            usager.classList.add('is-invalid');
        }
        else {
            usagerErreur.textContent = '' ;
            usager.classList.remove('is-invalid');
        }

        if (mdp.value == '') {
            mdpErreur.textContent = 'Veuillez entrer votre mot de passe';
            mdp.classList.add('is-invalid');
        }
        else {
            mdpErreur.textContent = '';
            mdp.classList.remove('is-invalid');
        }

    }
});