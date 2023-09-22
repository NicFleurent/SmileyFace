    'use strict';

    /* global bootstrap */

    /**
         * Créer un toast lors d'un ajout
         */
    function creerToastA() {
        let optionsToast = {
            delay: 3000,
            animation: true,
            autohide: true
        };

        new bootstrap.Toast(document.getElementById('toast-A'), optionsToast).show();
    }

    document.addEventListener('DOMContentLoaded', function () {

        document.getElementById('usagerCreer').addEventListener('input', validationVideUsager);
        document.getElementById('mdpCreer').addEventListener('input', validationVideMdp);
        document.getElementById('mdpCreerConf').addEventListener('input', validationConfirmVideMdp);
        document.getElementById('mdpCreer').addEventListener('input', validationMdpExigence);
        document.getElementById('mdpCreerConf').addEventListener('input', validationMdpExigence);

        //Variables
        let usager = document.getElementById('usagerCreer');
        let usagerErreur = document.getElementById('usagerCreerVide');

        let mdp = document.getElementById('mdpCreer');
        let mdpErreur = document.getElementById('mdpCreerVide');

        let mdpConfirm = document.getElementById('mdpCreerConf');
        let mdpConfirmErreur = document.getElementById('mdpCreerConfVide');
        /**
         * Permet d'afficher un message d'erreur si le champ usager est vide
         */
        function validationVideUsager() {


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
            if (mdpConfirm.value == '' || mdp.value == null) {
                mdpConfirmErreur.textContent = 'Veuillez entrer votre mot de passe';
                mdpConfirm.classList.add('is-invalid');
            }
            else {
                mdpConfirmErreur.textContent = '';
                mdpConfirm.classList.remove('is-invalid');
            }
        }

        /**
         * Vérification si mdp identiques et si conforme aux exigences
         */
        function validationMdpExigence() {
            let regexPassword = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/;
            if (regexPassword.test(mdpConfirm.value)) {
                mdpConfirmErreur.textContent = 'Le mot de passe doit contenir au moins 8 caractères, 1 lettre majuscule, 1 chiffre et 1 caratère spécial';
                mdpConfirm.classList.add('is-invalid');
                console.log(mdpConfirm.value.test(regexPassword));
            }
            else {
                mdpConfirmErreur.textContent = '';
                mdpConfirm.classList.remove('is-invalid');
            }
            if (regexPassword.test(mdp.value)) {
                mdpErreur.textContent = 'Le mot de passe doit contenir au moins 8 caractères, 1 lettre majuscule, 1 chiffre et 1 caratère spécial';
                mdp.classList.add('is-invalid');
                console.log(mdp.value.test(regexPassword));
            }
            else {
                mdp.textContent = '';
                mdp.classList.remove('is-invalid');
            }
        }




    });
