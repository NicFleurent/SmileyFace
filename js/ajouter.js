let nom = document.getElementById("nom");
let date = document.getElementById("date");
let lien = document.getElementById("lien");
let image = document.getElementById("image");
let departement = document.getElementById("departement");

let invalidNom = document.getElementById("invalidNom");
let invalidDate = document.getElementById("invalidDate");
let invalidLien = document.getElementById("invalidLien");
let invalidImage = document.getElementById("invalidImage");
let invalidDepartement = document.getElementById("invalidDepartement");

let inputNom;
let inputDate;
let inputLien;
let inputImage;
let inputDepartement;

const regexURL = /\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i;

nom.addEventListener("input", function(event){
    inputNom = nom.value;
    
    if(inputNom === "" || inputNom === null){
        invalidNom.style.display = "block";
        nom.setAttribute("class", "form-control is-invalid");
    }
    else{
        invalidNom.style.display = "none";
        nom.setAttribute("class", "form-control is-valid");
    }

});

date.addEventListener("input", function(event){
    inputDate = date.value;
    console.log(inputDate);

    if(inputDate === "" || inputDate === null){
        invalidDate.style.display = "block";
        date.setAttribute("class", "form-control is-invalid");
    }
    else{
        invalidDate.style.display = "none";
        date.setAttribute("class", "form-control is-valid");
    }
});

lien.addEventListener("input", function(event){
    inputLien = lien.value;

    if(inputLien === "" || inputLien === null){
        invalidLien.style.display = "block";
        invalidLien.innerHTML = "Le lien de l'évènement est requis";
        lien.setAttribute("class", "form-control is-invalid");
    }
    else if(!(regexURL.test(inputLien))){
        invalidLien.style.display = "block";
        invalidLien.innerHTML = "L'URL n'est pas valide";
        lien.setAttribute("class", "form-control is-invalid");
    }
    else{
        invalidLien.style.display = "none";
        lien.setAttribute("class", "form-control is-valid");
    }
});

departement.addEventListener("input", function(event){
    inputDepartement = departement.value;

    if(inputDepartement === "" || inputDepartement === null){
        invalidDepartement.style.display = "block";
        departement.setAttribute("class", "form-control is-invalid");
    }
    else{
        invalidDepartement.style.display = "none";
        departement.setAttribute("class", "form-control is-valid");
    }
});

image.addEventListener("input", function(event){
    inputImage = image.value;

    if(inputImage === "" || inputImage === null){
        invalidImage.style.display = "none";
        image.setAttribute("class", "form-control");
    }
    else if(!(regexURL.test(inputLien))){
        invalidImage.style.display = "block";
        image.setAttribute("class", "form-control is-invalid");
    }
    else{
        invalidImage.style.display = "none";
        image.setAttribute("class", "form-control is-valid");
    }
});