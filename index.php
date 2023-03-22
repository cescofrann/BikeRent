<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new mysqli("localhost","5f","Esercizio2023!","Biciclette");
	if($conn->connect_error){
  		die("Errore: " . $conn->connect_error . " (Contatta un Amminitratore)");
	}
	//Definisco la query che verrà mandata
	$sql = "SELECT mail, password, numTessera FROM utente";	
	
	//Esecuzione della query
	$ris = $conn->query($sql);
	if(!$ris){
		echo "Errore: SQL SINTAX (Contatta un Amministratore)";
	}

	while($row = $ris->fetch_assoc()) {
		if ($email == $row["mail"] && $password == $row["password"]) {
	        // Credenziali corrette, reindirizza l'utente all'area riservata
            $numTessera = $row["numTessera"];
            if(stripos($numTessera, 'aa') !== false){
                echo "CREDENZIALI CORRETTE E SEI AMMINISTRATORE";
            }else{
                echo "CREDENZIALI CORRETTE E SEI UN UTENTE";
            }
	        //header('Location: area-riservata.php');
	        exit;
	    } else {
	        // Credenziali non corrette, mostra un messaggio di errore
	        $errore = 'Username o password errati';
	    }
	}
    
}
?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Form</title>

	<link rel="stylesheet" href="main.css">
</head>
<body>

	<?php if (isset($errore)) { ?>
        <p><?php echo $errore; ?></p>
    <?php } ?>

	<h1 id="upper_title">Sito 5F</h1>
        <div class="box_login">
            <h2>Effettua il login</h2>
            <form action=" " method = "post">
                <label for="email_login">E-mail:</label><br>
                <input type="text" id="fname" name="email" class="box-bars"><br>
                <label for="password_login">Password:</label><br>
                <input type="password" id="lname" name="password" class="box-bars"><br><br>
                <input type="submit" value="Login" id="login_button" class="box-buttons">
                <input type="submit" value="Register" id="register_button" class="box-buttons">
              </form> 
        </div>


</body>
</html>
