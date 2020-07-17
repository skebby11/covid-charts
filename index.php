<?php

$oggi = date("Y-m-d");
$period = new DatePeriod(
 new DateTime('2020-02-24'),
 new DateInterval('P1D'),
 new DateTime($oggi .  '+1 day')
);

foreach ($period as $key => $value){
    $giorni[] = $value->format(''. 'd/m/Y' . '');   
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dati Coronavirus Reggio Emilia - Em. Rom. - Italia</title>
	<meta name="description" content="Dati relativi al Covid 19 per Reggio Emilia, Emilia Romagna e Italia. ">
	<meta property="og:url" content="https://www.sebastianoriva.it/coronavirus-re/"/>
	<meta property="og:image" content="https://www.sebastianoriva.it/coronavirus-re/corona-re-social-share-image.png">
	<meta name="twitter:image" content="https://www.sebastianoriva.it/coronavirus-re/corona-re-social-share-image.png">
	<meta property="article:author" content="https://www.facebook.com/sebastianoriva" />
	<meta name="author" content="Sebastiano Riva" />
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	
	 <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

	<link rel="stylesheet" href="style.css?0.1.8">
	
	<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
	
	

	
	<style type="text/css">
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
	
</head>

<body>
	
<div class="header ">
	
	<h1>Dati relativi al Coronavirus per Reggio Emilia, Emilia-Romagna e Italia</h1>
	
<div class="alert alert-primary" role="alert">
 <p>Dati ufficiali forniti direttamente e automaticamente dalla <a href="https://github.com/pcm-dpc/COVID-19" target="_blank">Protezione Civile</a>. Informazioni aggiornate quotidianamente alle 18:30.</p>
</div>
	
<div class="alert alert-secondary" role="alert">
  <p><a href="come-funziona" class="alert-link">Clicca qui</a> per scoprire come sono ottenuti ed elaborati questi dati e le FAQ.</p>
</div>
	


	
</div>
	
<div class="re ">

	<h2>Reggio Emilia</h2>
	
	<?php 

	$data = file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-province.json');
	$array = json_decode($data,1);
	$codice_provincia = 35;
	$expected = array_filter($array, function ($var) use ($codice_provincia) {
		return ($var['codice_provincia'] == $codice_provincia);
	});		
	?>
	
	<button onclick="tabellaRe()" id="mostraTabella" class="btn btn-secondary mb-3 mt-3">Mostra Tabella</button>
	
	<div id="tabellaRe" style="display: none;">

	<?php if (count($expected) > 0): ?>
	<div class="tabella" >
	<table class="tg">
	  <thead>
		<tr>
		  <th class="tg-dei9"><?php echo implode('</th><th>', array_keys(current($expected))); ?></th>
		</tr>
	  </thead>
	  <tbody>
	<?php foreach ($expected as $row): array_map(null, $expected); ?>
		<tr>
		  <td><?php echo implode('</td><td>', $row); ?></td>
		</tr>
	<?php endforeach; ?>
	  </tbody>
	</table>
	</div>
	<?php endif; ?>

	<?php
	$arr = json_decode($data);
	foreach ( $arr as $obj ){
		if ( $obj->codice_provincia == 35 ) {
			$totcasire[] =  $obj->totale_casi;
		}
	}
	

	
	?>
	</div>
		
<div class="row">
	<div class="col-md-6">
		<canvas id="totcasire" width="600px" height="400px"></canvas> 
	</div>
	<div class="col-md-6">
	</div>
</div>	
<script>
var ctx = document.getElementById('totcasire').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo "'" . implode("','", $giorni) . "'"; ?>],
        datasets: [{
            label: 'Numero casi totali',
            data: [<?php echo implode(",", $totcasire); ?>],
            backgroundColor: [
                'rgba(255, 206, 86, 0.2)'
            ],
            borderColor: [
                'rgba(255, 206, 86, 1)'
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

</div>
	
	<br><br>
	
<div class="emre ">
	
	<h2>Emilia-Romagna</h2>
	<?php 

	$datareg = file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-regioni.json');
	$arrayreg = json_decode($datareg,1);
	$codice_regione = 8;
	$expected = array_filter($arrayreg, function ($var) use ($codice_regione) {
		return ($var['codice_regione'] == $codice_regione);
	});		
	?>
	
	<button onclick="tabellaEr()" id="mostraTabella" class="btn btn-secondary mb-3 mt-3">Mostra Tabella</button>
	
	<div id="tabellaEr" style="display: none;">
	
	<div class="tabella">
		<?php if (count($expected) > 0): ?>
		<table class="tg">
		  <thead>
			<tr>
			  <th class="tg-dei9"><?php echo implode('</th><th>', array_keys(current($expected))); ?></th>
			</tr>
		  </thead>
		  <tbody>
		<?php foreach ($expected as $row): array_map(null, $expected); ?>
			<tr>
			  <td><?php echo implode('</td><td>', $row); ?></td>
			</tr>
		<?php endforeach; ?>
		  </tbody>
		</table>
		<?php endif; ?>
	</div>
		
	</div>
	
<?php
	$arr = json_decode($datareg);
	foreach ( $arr as $obj ){
		if ( $obj->codice_regione == 8 ) {
			$totcasireg[] =  $obj->totale_casi;
		}
	}
	
	foreach ( $arr as $obj ){
		if ( $obj->codice_regione == 8 ) {
			$totposreg[] =  $obj->variazione_totale_positivi;
		}
	}
?>

<br><br>
<div class="row">
	<div class="col-md-6">
		<canvas id="totcasireg" width="600px" height="400px"></canvas> 
	</div>
	<div class="col-md-6">
		<canvas id="attposre" width="600px" height="400px"></canvas> 
	</div>
</div>
	
	
<script>
var ctx = document.getElementById('totcasireg').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo "'" . implode("','", $giorni) . "'"; ?>],
        datasets: [{
            label: 'Numero casi totali',
            data: [<?php echo implode(",", $totcasireg); ?>],
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
	
var ctx = document.getElementById('attposre').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo "'" . implode("','", $giorni) . "'"; ?>],
        datasets: [{
            label: 'Variazione casi positivi',
            data: [<?php echo implode(",", $totposreg); ?>],
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
</script>
	
</div>

<br><br>
	
<div class="it">
	
	
    <h2>Italia</h2>
    <?php 

    $data = file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-andamento-nazionale.json');
    $array = json_decode($data,1);
    $codice_regione = 8;
    $expected = $array;	
    ?>


    <button onclick="tabellaIt()" id="mostraTabella" class="btn btn-secondary mb-3 mt-3">Mostra Tabella</button>

	
	<div id="tabellaIt" style="display: none;">

	<div class="tabella">
		<?php if (count($expected) > 0): ?>
		<table class="tg">
		  <thead>
			<tr>
			  <th class="tg-dei9"><?php echo implode('</th><th>', array_keys(current($expected))); ?></th>
			</tr>
		  </thead>
		  <tbody>
		<?php foreach ($expected as $row): array_map(null, $expected); ?>
			<tr>
			  <td><?php echo implode('</td><td>', $row); ?></td>
			</tr>
		<?php endforeach; ?>
		  </tbody>
		</table>
		<?php endif; ?>
	</div>
		
	</div>
	
	<br><br>
	
	
	<?php
	$arr = json_decode($data);
	foreach ( $arr as $obj ){
			$nuovposit[] =  $obj->variazione_totale_positivi;
			$guarit[] =  $obj->dimessi_guariti;
			$decit[] =  $obj->deceduti;
			$totcasiit[] =  $obj->totale_casi;
	}
	?>
<div class="row">
	<div class="col-md-6">
		<canvas id="nuovposit" width="600px" height="400px"></canvas> 
	</div>
	<div class="col-md-6">
		<canvas id="guarit" width="600px" height="400px"></canvas> 
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<canvas id="decit" width="600px" height="400px"></canvas> 
	</div>
	<div class="col-md-6">
		<canvas id="totcasiit" width="600px" height="400px"></canvas> 
	</div>
</div>
	
	
<script>
var ctx = document.getElementById('nuovposit').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php echo "'" . implode("','", $giorni) . "'"; ?>],
        datasets: [{
            label: 'Variazione casi positivi',
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
</script>

<script>
function tabellaRe() {
  var x = document.getElementById("tabellaRe");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
	
function tabellaEr() {
  var x = document.getElementById("tabellaEr");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
	
function tabellaIt() {
  var x = document.getElementById("tabellaIt");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>


</div>
	
<div class="footer">
<p><?php $handle = fopen("counter.txt", "r"); if(!$handle){ echo "could not open the file" ; } else { $counter = ( int ) fread ($handle,20) ; fclose ($handle) ; $counter++ ; echo"Visite: ". $counter ; $handle = fopen("counter.txt", "w" ) ; fwrite($handle,$counter) ; fclose ($handle) ; } ?>
</p>
<p>&copy 2020 - REALIZZATO DA <a href="https://www.sebastianoriva.it" target="_blank">Sebastiano Riva</a> @ 3AM. </p>
	
<p  style="font-size: 80%">Richieste, idee, segnalazioni: <a href="mailto:mail@sebastianoriva.it">mail[at]sebastianoriva[dot]it</a></p>
</div>
	

	
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>

</html>