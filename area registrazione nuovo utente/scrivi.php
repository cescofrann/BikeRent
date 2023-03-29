<?php
session_start();

include("libreria.php");
$conn=connessione();
$exc = 0;
if(array_key_exists('mail',$_POST)){
    
    $mail=$_POST['mail'];
    
    $password=$_POST['password']; 

    $nome = $_POST['nome'];
    
    $cognome=$_POST['cognome'];
    
    $codiceFiscale=$_POST['codFiscale'];
    
    $dataNascita=$_POST['dataNascita'];
    
    $luogoNascita=$_POST['luogoNascita'];
    
    $numeroTelefono=$_POST['cellulare'];
    
    $cartaCredito=$_POST['cartaCredito'];
    
    $numeroTessera=createNewNumeroTessera($conn);
    



  
        $s="INSERT INTO `utente`(`id_utente`, `mail`, `password`, `nome`, `cognome`,`codFiscale`, `dataNascita`, `luogoNascita`, `cellulare`, `cartaCredito`,`numTessera`)
        VALUES (null,'$mail', '$password', '$nome', '$cognome','$codiceFiscale', '$dataNascita', '$luogoNascita', '$numeroTelefono','$cartaCredito', '$numeroTessera');";
        $result=query($conn, $s);

        echo "utente aggiunto con successo";
        echo goBackToIndexPage();
    
    
}



function createNewNumeroTessera($conn){
    // Genera un nuovo numero casuale di tessera
    $numeroT = rand(100, 999);

    // Verifica se il numero è già presente nella tabella utente
    $query = "SELECT COUNT(*) as count FROM utente WHERE numTessera = $numeroT";
    $result = query($conn, $query);
    $row = $result->fetch_assoc();

    // Se il numero è già presente, genera un nuovo numero casuale e ripeti la verifica
    while ($row['count'] > 0) {
        $numeroT = rand(1, 100);
        $query = "SELECT COUNT(*) as count FROM utente WHERE numTessera = $numeroT";
        $result = query($conn, $query);
        $row = $result->fetch_assoc();
    }

    return $numeroT;
}



function goBackToIndexPage(){
    echo "<br><br><a href='indexRegistrazione.php'><button>torna indietro per aggiungere nuovi user</button></a><br>";
}



close($conn);




?>