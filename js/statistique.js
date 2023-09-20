'use strict';

/* global Chart */




document.addEventListener('DOMContentLoaded', function () {
    //Graphique Étudiants
    const ctxEt = document.getElementById('canvas-diagramme').getContext('2d');
    let tabStatsEt = [parseInt(document.getElementById('nbEtudSatisf').textContent),
    parseInt(document.getElementById('nbEtudNeutre').textContent),
    parseInt(document.getElementById('nbEtudInsatisf').textContent)];
    let tabLabelEt = ['Étudiants satisfaits', 'Étudiants neutres', 'Étudiants insatisfaits'];
    let titreGraphEt = document.getElementById('titre-etu');
    console.log(tabStatsEt.every(stat => stat === '0'));
    if (tabStatsEt.every(stat => stat === '0')) {   
        titreGraphEt.textContent = 'Aucune donnée n\'a été enregistré';  
    }
    else{
        titreGraphEt.textContent = 'Satisfaction des étudiants';
        const dataChartJs = {
            labels: tabLabelEt,
            datasets: [
                {
                    label: 'Votes',
                    data: tabStatsEt,
                    backgroundColor: [
                        'rgba(57, 166, 227, 1)',
                        'rgba(255, 190, 18, 1)',
                        'rgba(241, 60, 25, 1)'
                    ],
                    borderColor: 'rgb(100, 100, 100)',
                },
            ]
        };

        // Les options du diagramme.
        const optionsChartJs = {

        };

        // eslint-disable-next-line no-unused-vars  
        let diagChartJs = new Chart(ctxEt, {
            type: 'pie',
            data: dataChartJs,
            options: optionsChartJs
        });
    }

    //Graphique Entreprise
    const ctxEn = document.getElementById('canvas-diagramme2').getContext('2d');
    let tabStatsEn = [document.getElementById('nbEntSatisf').textContent,
    document.getElementById('nbEntInsatisf').textContent,
    document.getElementById('nbEntInsatisf').textContent];
    let tabLabelEn = ['Entreprises satisfaites', 'Entreprises neutres', 'Entreprises insatisfaites'];
    let titreGraphEn = document.getElementById('titre-ent');
    if (tabLabelEn != null) {
        titreGraphEn.textContent = 'Satisfaction des entreprises';
        const dataChartJsEn = {
            labels: tabLabelEn,
            datasets: [
                {
                    label: 'Votes',
                    data: tabStatsEn,
                    backgroundColor: [
                        'rgba(57, 166, 227, 1)',
                        'rgba(255, 190, 18, 1)',
                        'rgba(241, 60, 25, 1)'
                    ],
                    borderColor: 'rgb(100, 100, 100)',
                },
            ]
        };

        // Les options du diagramme.
        const optionsChartJsEn = {

        };

        // eslint-disable-next-line no-unused-vars  
        let diagChartJsEn = new Chart(ctxEn, {
            type: 'pie',
            data: dataChartJsEn,
            options: optionsChartJsEn
        });
    }
    else if(tabLabelEt === null){
        titreGraphEn.textContent = 'Satisfaction des entreprises';
        const dataChartJsEn = {
            labels: tabLabelEn,
            datasets: [
                {
                    label: 'Votes',
                    data: tabStatsEn,
                    backgroundColor: [
                        'rgba(57, 166, 227, 1)',
                        'rgba(255, 190, 18, 1)',
                        'rgba(241, 60, 25, 1)'
                    ],
                    borderColor: 'rgb(100, 100, 100)',
                },
            ]
        };

        // Les options du diagramme.
        const optionsChartJsEn = {

        };

        // eslint-disable-next-line no-unused-vars  
        let diagChartJsEn = new Chart(ctxEt, {
            type: 'pie',
            data: dataChartJsEn,
            options: optionsChartJsEn
        });
    }
});

