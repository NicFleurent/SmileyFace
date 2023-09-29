'use strict';

document.addEventListener('DOMContentLoaded', function () {


    document.getElementById('mdpCreer').addEventListener('input', validationVideMdp);
    document.getElementById('mdpCreerConf').addEventListener('input', validationConfirmVideMdp);


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
    /**
     * Permet d'afficher un message d'erreur si le champ mdp confirm est vide
     */
    function validationConfirmVideMdp() {
        let mdpConfirm = document.getElementById('mdpCreerConf');
        let mdpConfirmErreur = document.getElementById('mdpCreerConfVide');
        if (mdpConfirm.value == '' || mdpConfirm.value == null) {
            mdpConfirmErreur.textContent = 'Veuillez entrer votre mot de passe';
            mdpConfirm.classList.add('is-invalid');
        }
        else {
            mdpConfirmErreur.textContent = '';
            mdpConfirm.classList.remove('is-invalid');
        }
    }
});