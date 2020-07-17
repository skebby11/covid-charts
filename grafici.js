var ctx = document.getElementById('nuovposit').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo "'" . implode("','", $giorni) . "'"; ?>],
        datasets: [{
            label: 'Numero casi positivi nuovi',
            data: [<?php echo implode(",", $nuovposit); ?>],
            backgroundColor: [
                'rgba(54, 162, 235, 0.2)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)'
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
	
var ctx = document.getElementById('guarit').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo "'" . implode("','", $giorni) . "'"; ?>],
        datasets: [{
            label: 'Numero dimessi guariti',
            data: [<?php echo implode(",", $guarit); ?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)'
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
	
var ctx = document.getElementById('decit').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo "'" . implode("','", $giorni) . "'"; ?>],
        datasets: [{
            label: 'Numero deceduti',
            data: [<?php echo implode(",", $decit); ?>],
            backgroundColor: [
                'rgba(153, 102, 255, 0.2)'
            ],
            borderColor: [
                'rgba(153, 102, 255, 1)'
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
	
var ctx = document.getElementById('totcasiit').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo "'" . implode("','", $giorni) . "'"; ?>],
        datasets: [{
            label: 'Numero casi attualmente positivi',
            data: [<?php echo implode(",", $totcasiit); ?>],
            backgroundColor: [
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 159, 64, 1)'
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