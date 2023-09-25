'use strict';

document.addEventListener('DOMContentLoaded', function () {

    document.getElementById('nip').addEventListener('input', validationVideUsager);
    /**
     * 
     */
    function validationVideUsager() {
        let nip = document.getElementById('nip');

        let nipErreur = document.getElementById('nipVide');
        let nipErreurValidation = false;
    let btnValide = document.getElementById('btnValide');


        if (nip.value == '' || nip.value == null) {
            nipErreur.textContent = 'Veuillez entrer le NIP';
            nip.classList.add('is-invalid');
            nipErreurValidation = true;
            controlSubmit();
        }
        else if(nip.value.length < 4){
            nipErreur.textContent = 'NIP à 4 chiffres';
            nip.classList.add('is-invalid');
            nipErreurValidation = true;
            controlSubmit();
        }
        else {
            if(nip.value == '1234'){
                nipErreur.textContent = '';
                nip.classList.remove('is-invalid');
                nip.classList.add('is-valid');
                nipErreurValidation = false;
                controlSubmit();
            }
            else{
                nipErreur.textContent = 'NIP invalide';
                nip.classList.add('is-invalid');
                nipErreurValidation = true;
                controlSubmit();
            }
        }

        function controlSubmit(){
            if(nipErreurValidation){
                btnValide.disabled = true;
            }
            else{
                btnValide.disabled = false;
            }
        }
    }
});