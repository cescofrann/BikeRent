<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestione Bici</title>
	<style>
	 	table, th, td, tr {
			border: 3% solid transparent;
			border-collapse: collapse;
		}	

		.icona {
		  width: 80%;
		  height: 100px;
		  background-color: #f2f2f2;
		  border-radius: 10px;
		  box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
		  transition: transform 0.3s ease-in-out;
		}

		body{
		  width: 100%;
		  overflow-x: auto;
		}	

		table {
		  width: 100%;
		  max-width: 100%;
		  margin-bottom: 1rem;
		  background-color: transparent;
		  border-collapse: collapse;
		}
	</style>
</head>
<body>

<?php
	//Collegamento al database mysql
	$conn = new mysqli("localhost","5f","Esercizio2023!","Biciclette");
	if($conn->connect_error){
  		die("Connection failed: " . $conn->connect_error);
	}
	//Definisco la query che verrà mandata
	$sql = "SELECT * FROM utente";	
	//Esecuzione della query
	$ris = $conn->query($sql);
	if(!$ris){
		echo "ERROR";
	}

	echo "<div class='icona'> test <div align='right'>cancella</div>  <div align='right'>aggiorna</div> </div>";
	echo "<div class='icona'> test </div>";
	echo "<div class='icona'> test </div>";
	echo "<div class='icona'> test </div>";


	// echo "<table >";
	// echo "<tr>
	// 		<th>ID-Utente</th>
	// 		<th>Mail</th>
	// 		<th>Password</th>
	// 		<th>Nome</th>
	// 		<th>Cognome</th>
	// 		<th>Codice Fiscale</th>
	// 		<th>Data di Nascita</th>
	// 		<th>Luogo di Nascita</th>
	// 		<th>Cellulare</th>
	// 		<th>Carta di Credito</th>
	// 		<th>Numero Tessera</th>
	// 	</tr>";

		
		
	// while($row = $ris->fetch_assoc()) {
	// 	echo "<tr>";
	// 	echo "<td>" . $row["id_utente"] . "</td>" . 
	// 	"<td>" . $row["mail"] . "</td>" . 
	// 	"<td>" . $row["password"] . "</td>" . 
	// 	"<td>" . $row["nome"] . "</td>" . 
	// 	"<td>" . $row["cognome"] . "</td>" . 
	// 	"<td>" . $row["codFiscale"] . "</td>" . 
	// 	"<td>" . $row["dataNascita"] . "</td>" . 
	// 	"<td>" . $row["luogoNascita"] . "</td>" . 
	// 	"<td>" . $row["cellulare"] . "</td>" . 
	// 	"<td>" . $row["cartaCredito"] . "</td>" . 
	// 	"<td>" . $row["numTessera"] . "</td>";

	// 	echo "</tr>";
	// }
	//echo "</table>";
	$con->close();
?>


</body>
</html>
