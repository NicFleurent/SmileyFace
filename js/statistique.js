'use strict'
/* global Chart */
let diagChartJs = null;

document.addEventListener('DOMContentLoaded', function () {
    let nbSatisfE = parseInt(document.getElementById('nbEtudSatisf').textContent);
    let nbNeutreE = parseInt(document.getElementById('nbEtudNeutre').textContent);
    let nbInsatisfE = parseInt(document.getElementById('nbEtudInsatisf').textContent);
    let tabStats=[nbInsatisfE,nbNeutreE,nbSatisfE];
    console.log(tabStats);
    let diagChartJs = new chart('myChart', {
        type: 'pie',
        data: tabStats,
        options: {}
    });

});