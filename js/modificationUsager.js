document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('usagerCreer').addEventListener('input', validationVideUsager);
    document.getElementById('mdpCreer').addEventListener('input', validationVideMdp);

    let usager = document.getElementById('usagerCreer');
    let usagerErreur = document.getElementById('usagerCreerVide');
    
    let mdp = document.getElementById('mdpCreer');
    let mdpErreur = document.getElementById('mdpCreerVide');
    /**
     * Permet d'afficher un message d'erreur si le champ usager vide
     */
    function validationVideUsager() {
        if (usager.value == '' || usager.value == null) {
            usagerErreur.textContent = 'Veuillez entrer votre nom d\'usager';
            mdp.classList.remove('is-valid');
            usager.classList.add('is-invalid');
        }
        else {
            usagerErreur.textContent = '';
            usager.classList.remove('is-invalid');
            usager.classList.add('is-valid');
        }
    }
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
   
});