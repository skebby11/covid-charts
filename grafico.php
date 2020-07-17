
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>

<?php 

	$data = file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-regioni.json');
	$array = json_decode($data,1);
	$codice_regione = 8;
	$expected = array_filter($array, function ($var) use ($codice_regione) {
		return ($var['codice_regione'] == $codice_regione);
	});		
	?>

	<?php
	$arr = json_decode($data);
	foreach ( $arr as $obj ){
		if ( $obj->codice_regione == 8 ) {
			$totcasi[] =  $obj->totale_casi;
		}
	}

$oggi = date("Y-m-d");

$period = new DatePeriod(
     new DateTime('2020-02-24'),
     new DateInterval('P1D'),
     new DateTime($oggi .  '+1 day')
);

foreach ($period as $key => $value){
    $giorni[] = $value->format(''. 'd/m/Y' . '');   
}

echo implode(", ", $giorni); 

	?>



<div class="totcasireg" style='width: 400px; height: 400px'> <canvas id="totcasireg" width="400px" height="400px"></canvas> </div>
<script>
var ctx = document.getElementById('totcasireg').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo "'" . implode("','", $giorni) . "'"; ?>],
        datasets: [{
            label: 'Numero casi totali',
            data: [<?php echo implode(",", $totcasi); ?>],
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
</script>
	