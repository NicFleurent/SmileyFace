'use strict';

/* global bootstrap */

  
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












