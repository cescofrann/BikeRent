<?php

//creazione oggetto mysqli per realizzare connessione
$con = new mysqli("localhost", "root", "", "progettobici");
if(!$con){
    die("connessione non effettutata".mysqli_error($con)."<br>");
}

//definizione stringa contenendo SQL
$sql = "SELECT s.id_stazione, COUNT(n.id_noleggio) AS totaleNoleggiStazione FROM noleggio as n RIGHT JOIN stazione AS s ON s.id_stazione = n.id_stazionePartenza GROUP BY s.id_stazione";
$sql2 = "SELECT b.id_bicicletta, COUNT(n.id_noleggio) AS totaleNoleggiBici FROM bicicletta AS b LEFT JOIN noleggio AS n ON b.id_bicicletta = n.id_bicicletta GROUP BY b.id_bicicletta";
//esecuzione query che restituisce $ris
//array associativi che contiene resultset della prima query
$ris = mysqli_query($con, $sql) or die ("Query fallita");
//array associativi che contiene resultset della seconda query
$ris2 = mysqli_query($con,$sql2) or die ("Query fallita ");
//$ris = $con->query($sql) or die ("Query fallita");
//$ris2 = $con->query($sql2) or die ("Query fallita"); //creo array associativo che contiene resultset della seconda query
//$ris2 = mysqli_query($con,$sql2) or die ("Query fallita 2");

//genero tabella di visualizzaione query 1
echo "<table><tr><th>ID_stazione<th>Num_noleggi</tr>";

//ciclo foreach legge elementi del resltset $ris query 1
foreach($ris as $riga){

    echo "<tr><td>".$riga["id_stazione"];
    echo"<td>".$riga["totaleNoleggiStazione"];

}
echo "</table><br><br>";

echo "<table><tr><th>ID_bicicletta<th>Num_noleggi</tr>";

//ciclo foreach legge elementi del resltset $ris2 query 2
foreach($ris2 as $riga){

    echo "<tr><td>".$riga["id_bicicletta"];
    echo"<td>".$riga["totaleNoleggiBici"];

}


//rilascio connessione
$con->close();


?>