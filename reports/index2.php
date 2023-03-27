<?php
function getData($conn, $sql, $valori, $dato){
	
	$result = $conn->query($sql);
	if(!$result){
		echo "Errore: SQL SINTAX (Contatta un Amministratore)";
	}
    
    $dati = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
        $dati['labels'][] = $row[$valori];
        $dati['dati'][] = $row[$dato];
        $dati['colori'][] = '#' . substr(md5(rand()), 0, 6);
        }
    }
    return $dati;

}
    //$conn = new mysqli("173.249.59.244:3306","5f","Esercizio2023!","Biciclette");
	$conn = new mysqli("localhost","5f", "Esercizio2023!","Biciclette");
	if($conn->connect_error){
  		die("Errore: " . $conn->connect_error . "(Contatta un Amministratore)");
	}
	

	// QUERY PER OTTENERE IL LUOGO DI NASCITA DI OGNI CITTADINO

  $sql_luoghi = "SELECT utente.luogoNascita as Luogo, COUNT(utente.id_utente) as Totale FROM utente GROUP BY utente.luogoNascita";	
  $dati1 = getData($conn, $sql_luoghi, "Luogo", "Totale");


  // QUERY PER OTTENERE PER OGNI BICICLETTA QUANTI NOLEGGI HA FATTO CON ESSA

  $sql_noleggio = "SELECT b.id_bicicletta as id, COUNT(n.id_noleggio) as Noleggi FROM bicicletta AS b LEFT JOIN noleggio AS n ON b.id_bicicletta = n.id_bicicletta GROUP BY b.id_bicicletta";	
  $dati2 = getData($conn, $sql_noleggio, "id", "Noleggi");


  $conn->close();

?>


<!DOCTYPE html>
<html>
  <head>
    <title>Reports</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="index.js"></script>
    <style>
      canvas {
        max-width: 600px;
        margin: 20px auto;
        display: block;
      }
    </style>
  </head>
  <body>
    <canvas id="regioni"></canvas>
    <canvas id="noleggio"></canvas>

    <script>
      var dati1 = <?php echo json_encode($dati1); ?>;
      var ctx1 = document.getElementById('regioni').getContext('2d');
      
      var ctx2 = document.getElementById('noleggio').getContext('2d');
      var dati2 = <?php echo json_encode($dati2); ?>;

      var myChart1 = new Chart(ctx1, {
        type: 'pie',
        data: {
          labels: dati1.labels,
          datasets: [
            {
              label: 'Persone',
              data: dati1.dati,
              backgroundColor: dati1.colori,
            },
          ],
        },
      });

      var myChart = new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: dati2.labels,
            datasets: [{
                label: 'Bicicletta',
                data: dati2.dati,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            },
          ]
        },
        ooptions: {
          scales: {
              yAxes: [{
                ticks: {
                  beginAtZero:true
                }
              }]
            }
          } 
      });

    </script>
  </body>
</html>
