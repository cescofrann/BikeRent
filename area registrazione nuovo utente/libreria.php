<?php
function connessione() {
	
//	$conn=mysql_connect($db_host,$db_user,$db_password);
//	if($conn==FALSE)
//		echo("Errore connessione");
include("connessione.php");
	$conn = mysqli_connect($host,$user,$password, $database);

	if (!$conn) {  // Check connection
		die("Connection failed: " . mysqli_connect_error());
	} 
	//echo "Connected successfully";
	
	return $conn;
}
function close($conn){
		if(!mysqli_close($conn)){
			die("errore close");
		}
}
function query($conn, $s) {
	if(!$request=mysqli_query($conn, $s)){
		die("errore query ".mysqli_error($conn));
	}
	return $request;
}

function fetch_row($result) {		// estrae la singola riga dal risultato della query (array non associativo)
		$row=mysqli_fetch_row($result);
	return $row;
}
function fetch_assoc($result) {		// estrae la singola riga dal risultato della query (array associativo)
		$row=mysqli_fetch_assoc($result);
	return $row;
}
function num_row($result) {		// restituisce il numero di righe di $result
		$num_row=mysqli_num_rows($result);
	return $num_row;
}	


function head($title){
	echo "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\n";

	echo "<html lang=\"it-IT\">\n";

	echo "<head>\n";
		echo "<title>$title</title>\n";
		echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">\n";
        echo "<link href='stil.css' rel='stylesheet' type='text/css'>\n";
	echo "</head>\n";

	echo "<body>\n";
	echo "<h2>$title</h2>\n";
}

function tail(){
	
	echo "</body>\n";

	echo "</html>\n";
}
function alertPhp($stringa){
    $messaggio="alert(\"".$stringa."\");";
    echo("<script language=\"Javascript\">");
    echo($messaggio);
    echo("</script>");
}

