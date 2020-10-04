var ctx = $('#myChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Janv.', 'Fevr.', 'Mars', 'Avri.', 'Mai', 'Juin', 'Juil.', 'Aout', 'Sept.', 'Octo.', 'Nove.', 'Dece.'],
        datasets: [{
            label: 'Dépenses sur l\'année',
            data: [48.23, 19, 3, 5, 2, 3, 12, 19, 3, 5, 2, 3],
            backgroundColor: [
                '#89023E'
            ],
            borderColor: [
                '#ff5e62'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});