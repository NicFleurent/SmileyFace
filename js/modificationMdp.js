'use strict';

document.addEventListener('DOMContentLoaded', function () {


    document.getElementById('mdpCreer').addEventListener('input', validationVideMdp);
    document.getElementById('mdpCreerConf').addEventListener('input', validationConfirmVideMdp);

    let mdp = document.getElementById('mdpCreer');
    let mdpErreur = document.getElementById('mdpCreerVide');

    let mdpConfirm = document.getElementById('mdpCreerConf');
    let mdpConfirmErreur = document.getElementById('mdpCreerConfVide');
    /**
     * Permet d'afficher un message d'erreur si le champ mdp est vide
     */
    function validationVideMdp() {
        if (mdp.value == '' || mdp.value == null) {
            mdpErreur.textContent = 'Veuillez entrer votre mot de passe';
            mdp.classList.remove('is-valid');
            mdp.classList.add('is-invalid');
        }
        else {
            mdpErreur.textContent = '';
            mdp.classList.remove('is-invalid');
            mdp.classList.add('is-valid');
        }
    }
    /**
     * Permet d'afficher un message d'erreur si le champ mdp confirm est vide
     */
    function validationConfirmVideMdp() {
        if (mdpConfirm.value == '' || mdpConfirm.value == null) {
            mdpConfirmErreur.textContent = 'Veuillez entrer votre mot de passe';
            mdpConfirm.classList.remove('is-valid');
            mdpConfirm.classList.add('is-invalid');
        }
        else if(mdpConfirm.value != mdp.value){
            mdpConfirmErreur.textContent = 'Le mot de passe ne correspond pas';
            mdpConfirm.classList.remove('is-valid');
            mdpConfirm.classList.add('is-invalid');
        }
        else {
            mdpConfirmErreur.textContent = '';
            mdpConfirm.classList.remove('is-invalid');
            mdpConfirm.classList.add('is-valid');
        }
    }
});