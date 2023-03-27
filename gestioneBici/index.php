<?php
	if(isset($_POST['delete'])) {
	  	// Aggiorna la connessione al database con i nuovi valori
		$conn = new mysqli("localhost","5f","Esercizio2023!","Biciclette");

		if($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}

		//Definisco la query per cancellare un utente
		$sql = "DELETE FROM bicicletta WHERE bicicletta.id_bicicletta = '" . $_POST['id_bicicletta'] . "';";	

		//Esecuzione della query
		$ris = $conn->query($sql);

		if(!$ris)
			echo "Eliminazione Non Completata: Impossibile eliminare l'utente! Controllare se ha effettuato dei noleggi.";
		else
			echo "Eliminazione Completata: L'utente con di <b>". $_POST['id_bicicletta'] . "</b> è stato eliminato con successo!";
		
  }
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestione Bici</title>
	<link rel="stylesheet" href="main.css">
</head>
<body>

<?php
	// Prima connessione al database
	$conn = new mysqli("localhost","5f","Esercizio2023!","Biciclette");

	if($conn->connect_error){
  		die("Connection failed: " . $conn->connect_error);
	}

	// Se l'utente interagisce con il tasto di update, mostriamo i campi modificabili 
	if(isset($_POST['update'])) {
		echo "<div class='container_aggiungi'>
			<form class='form_aggiungi'  method='post'>
				<label for='modello'>Modello:</label>
				<input value='" . $_POST['modello'] . "' name='modello_aggiungi' type='modello' id='modello' name='modello' placeholder='Aggiorna il modello'>
				
				<label for='text'>Categoria:</label>
				<input value='" . $_POST['categoria'] . "' name='categoria_aggiungi' type='categoria' id='categoria' name='categoria' placeholder='Aggiorna la categoria'>
				
				<label for='annoAcquisto'>Anno Acquisto:</label>
				<input value='" . $_POST['annoAcquisto'] . "' type='annoacquisto' name='annoacquisto_aggiungi' id='annoacquisto' name='annoacquisto' placeholder='Aggiorna la data di acquisto'>
				
				<label for='annoRevisione'>Anno Revisione:</label>
				<input value='" . $_POST['annoRevisione'] . "' type='date' name='annorevisione_aggiungi' id='annorevisione' name='annorevisione' placeholder='Aggiorna l'anno di revisione'>
				
				<input value='" . $_POST['id_bicicletta'] . "' name='bicicletta_aggiungi' class='utente' type='hidden'>
				<input name='aggiorna_aggiungi' class='aggiorna_aggiungi' type='submit' value='Aggiorna'>
			</form>
		</div>";

	}else{
		if(isset($_POST['aggiorna_aggiungi'])) {

			//Definisco la query che aggiorna gli utenti con i dati forniti
			$sql = "UPDATE `bicicletta` SET 
			`modello` = '". $_POST['modello_aggiungi'] . "', 
			`categoria` = '". $_POST['categoria_aggiungi'] . "', 
			`annoAcquisto` = '". $_POST['annoacquisto_aggiungi'] . "', 
			`annoRevisione` = '". $_POST['annorevisione_aggiungi'] . "'
			WHERE `bicicletta`.`id_bicicletta` = '". $_POST['bicicletta_aggiungi'] . "';";	
echo "$sql";
			//Esecuzione della query
			$ris = $conn->query($sql);
			echo "La bici di id " . $_POST['bicicletta_aggiungi'] . " è stata aggiornata con successo";
		}


		//Definisco la query 
		$sql = "SELECT * FROM bicicletta";	
		//Esecuzione della query
		$ris = $conn->query($sql);
		if(!$ris){
			echo "ERROR";
		}

	while($row = $ris->fetch_assoc()) {

	echo "<div class='container'> 
	 		" . $row["id_bicicletta"] . ", "
	 		  . $row["modello"] . ", "
	 		  . $row["categoria"] . ", "
	 		  . $row["annoAcquisto"] . ", "
              . $row["annoRevisione"] . "
			<div>

			<form method='post'>
				<input type='hidden' name='id_bicicletta' value='" . $row["id_bicicletta"] ."'>
  				<input class='delete' type='submit' name='delete' value='ELIMINA'>
			</form>
    			<form method='post'>
					<input type='hidden' name='id_bicicletta' value='" . $row["id_bicicletta"] ."'>
					<input type='hidden' name='modello' value='" . $row["modello"] ."'>
					<input type='hidden' name='categoria' value='" . $row["categoria"] ."'>
					<input type='hidden' name='annoAcquisto' value='" . $row["annoAcquisto"] ."'>
					<input type='hidden' name='annoRevisione' value='" . $row["annoRevisione"] ."'>
					<input class='update' type='submit' name='update' value='Aggiornaa'>
   				</form>
  			</div> 
  		</div>";

  	}
  }
	$conn->close();
?>


</body>
</html>
