<?php
	if(isset($_POST['delete'])) {
	  	// Aggiorna la connessione al database con i nuovi valori
		$conn = new mysqli("localhost","5f","Esercizio2023!","Biciclette");

		if($conn->connect_error){
			die("Connection failed: " . $conn->connect_error);
		}

		//Definisco la query per cancellare un utente
		$sql = "DELETE FROM utente WHERE utente.id_utente = '" . $_POST['id_utente'] . "';";	

		//Esecuzione della query
		$ris = $conn->query($sql);

		if(!$ris)
			echo "Eliminazione Non Completata: Impossibile eliminare l'utente! Controllare se ha effettuato dei noleggi.";
		else
			echo "Eliminazione Completata: L'utente con di <b>". $_POST['id_utente'] . "</b> è stato eliminato con successo!";
		
  }
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Gestione Utenti</title>
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
				<label for='email'>Email:</label>
				<input value='" . $_POST['mail'] . "' name='mail_aggiungi' type='mail' id='mail' name='mail' placeholder='Aggiorna la Email'>
				
				<label for='password'>Password:</label>
				<input value='" . $_POST['password'] . "' name='password_aggiungi' type='text' id='password' name='password' placeholder='Aggiorna la Password'>
				
				<label for='nome'>Nome:</label>
				<input value='" . $_POST['nome'] . "' name='nome_aggiungi' type='nome' id='nome' name='nome' placeholder='Aggiorna il Nome'>
				
				<label for='cognome'>Cognome:</label>
				<input value='" . $_POST['cognome'] . "' name='cognome_aggiungi' type='cognome' id='cognome' name='cognome' placeholder='Aggiorna il Cognome'>
				
				<label for='codFiscale'>Codice Fiscale:</label>
				<input value='" . $_POST['codFiscale'] . "' name='codFiscale_aggiungi' type='codFiscale' id='codFiscale' name='codFiscale' placeholder='Aggiorna il Codice Fiscale'>

				<label for='dataNascita'>Data di Nascita:</label>
				<input value='" . $_POST['dataNascita'] . "' name='dataNascita_aggiungi' type='date' id='dataNascita' name='dataNascita' placeholder='Aggiorna la Data di Nascita'>
				
				<label for='luogoNascita'>Luogo di Nascita:</label>
				<input value='" . $_POST['luogoNascita'] . "' name='luogoNascita_aggiungi' type='luogoNascita' id='luogoNascita' name='luogoNascita' placeholder='Aggiorna il Luogo di Nascita'>
				
				<label for='cellulare'>Cellulare:</label>
				<input value='" . $_POST['cellulare'] . "' name='cellulare_aggiungi' type='cellulare' id='cellulare' name='cellulare' placeholder='Aggiorna il Cellulare'>
				
				<label for='cartaCredito'>Carta di Credito:</label>
				<input value='" . $_POST['cartaCredito'] . "' name='cartaCredito_aggiungi' type='cartaCredito' id='cartaCredito' name='cartaCredito' placeholder='Aggiorna la Carta di Credito'>
				
				<label for='numTessera'>Numero Tessera:</label>
				<input value='" . $_POST['numTessera'] . "' name='numTessera_aggiungi' type='numTessera' id='numTessera' name='numTessera' placeholder='Aggiorna il Numore della Tessera'>

				<input value='" . $_POST['id_utente'] . "' name='utente_aggiungi' class='utente' type='hidden'>
				<input name='aggiorna_aggiungi' class='aggiorna_aggiungi' type='submit' value='Aggiorna'>
			</form>
		</div>";

	}else{
		if(isset($_POST['aggiorna_aggiungi'])) {

			//Definisco la query che aggiorna gli utenti con i dati forniti
			$sql = "UPDATE `utente` SET 
			`mail` = '". $_POST['mail_aggiungi'] . "', 
			`nome` = '". $_POST['nome_aggiungi'] . "', 
			`cognome` = '". $_POST['cognome_aggiungi'] . "', 
			`password` = '". $_POST['password_aggiungi'] . "', 
			`codFiscale` = '". $_POST['codFiscale_aggiungi'] . "', 
			`dataNascita` = '". $_POST['dataNascita_aggiungi'] . "', 
			`cellulare` = '". $_POST['cellulare_aggiungi'] . "', 
			`luogoNascita` = '". $_POST['luogoNascita_aggiungi'] . "', 
			`cartaCredito` = '". $_POST['cartaCredito_aggiungi'] . "',
			`numTessera` = '". $_POST['numTessera_aggiungi'] . "'
			WHERE `utente`.`id_utente` = '". $_POST['utente_aggiungi'] . "';";	

			//Esecuzione della query
			$ris = $conn->query($sql);
			echo "L'utente di id " . $_POST['utente_aggiungi'] . " è stato aggiornato con successo";
		}


		//Definisco la query 
		$sql = "SELECT * FROM utente";	
		//Esecuzione della query
		$ris = $conn->query($sql);
		if(!$ris){
			echo "ERROR";
		}

	while($row = $ris->fetch_assoc()) {

	echo "<div class='container'> 
	 		" . $row["id_utente"] . ", "
	 		  . $row["mail"] . ", "
	 		  . $row["password"] . ", "
	 		  . $row["nome"] . ", "
	 		  . $row["cognome"] . ", "
	 		  . $row["codFiscale"] . ", "
	 		  . $row["dataNascita"] . ", "
	 		  . $row["luogoNascita"] . ", "
	 		  . $row["cellulare"] . ", "
	 		  . $row["cartaCredito"] . ", "
	 		  . $row["numTessera"] . "
			<div>

			<form method='post'>
				<input type='hidden' name='id_utente' value='" . $row["id_utente"] ."'>
  				<input class='delete' type='submit' name='delete' value='ELIMINA'>
			</form>
    			<form method='post'>
					<input type='hidden' name='id_utente' value='" . $row["id_utente"] ."'>
					<input type='hidden' name='mail' value='" . $row["mail"] ."'>
					<input type='hidden' name='password' value='" . $row["password"] ."'>
					<input type='hidden' name='nome' value='" . $row["nome"] ."'>
					<input type='hidden' name='cognome' value='" . $row["cognome"] ."'>
					<input type='hidden' name='codFiscale' value='" . $row["codFiscale"] ."'>
					<input type='hidden' name='dataNascita' value='" . $row["dataNascita"] ."'>
					<input type='hidden' name='luogoNascita' value='" . $row["luogoNascita"] ."'>
					<input type='hidden' name='cellulare' value='" . $row["cellulare"] ."'>
					<input type='hidden' name='cartaCredito' value='" . $row["cartaCredito"] ."'>
					<input type='hidden' name='numTessera' value='" . $row["numTessera"] ."'>
					<input class='update' type='submit' name='update' value='Aggiornaa'>
   				</form>
  			</div> 
  		</div>";

  	}
  }
	$con->close();
?>


</body>
</html>
