
<!DOCTYPE HTML>
<html>

<head>
    <title>nuovo account</title>
</head>

<body>
<h1 style="color: red;">Registrazione nuovo utente</h1>

    <?php
        session_start();
        include("connessione.php");
        if(!Array_key_exists('host', $_SESSION)){
            $_SESSION['host']=$host;
            $_SESSION['user']=$user;
            $_SESSION['password']=$password;
            $_SESSION['database']=$database;
        }
        
        include("libreria.php");
        $conn=connessione();
        if($conn){
            
        }

        echo "<form action = 'scrivi.php' method = 'post'><br>";
    ?>

   

    <label for="mail">Mail:</label>
    <input type="email" id="mail" name="mail" required>
    <br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" minlength="8" required>
   

    <input type="checkbox" onclick="hidePassword()">Mostra password

    <br><br>

    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" pattern="[A-Za-z]+" required>

    <br><br>

    <label for="cognome">Cognome:</label>
    <input type="text" id="cognome" name="cognome" pattern="[A-Za-z]+" required>

    <br><br>

    <label for="codFiscale">Codice Fiscale:</label>
    <input type="text" id="codFiscale" name="codFiscale" pattern="[A-Za-z0-9]{16}" required>

    <br><br>

    <label for="dataNascita">Data di nascita:</label>
    <input type="date" id="dataNascita" name="dataNascita" required>

    <br><br>

    <label for="luogoNascita">Luogo di nascita:</label>
    <input type="text" id="luogoNascita" name="luogoNascita" pattern="[A-Za-z]+" required>

    <br><br>

    <label for="cellulare">Numero di cellulare:</label>
    <input type="tel" id="cellulare" name="cellulare" pattern="[0-9]{10}" required>

    <br><br>

    <label for="cartaCredito">Numero di carta di credito:</label>
    <input type="text" id="cartaCredito" name="cartaCredito" pattern="[0-9]{16}" required>

    <br><br>

    <input type="submit" value="Registrati"><br>


    <script>
    function hidePassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
    </script>
  
    <?php
        

        $s="SELECT * FROM `utente`";
        $result=query($conn, $s);
        echo "<br><br>il numero di righe è ".num_row($result)."<br>";
        while($row=fetch_row($result)){
            echo $row[1]."\t\t";
            echo $row[2]."\t\t";
            echo $row[3]."\t\t";
            echo $row[4]."\t\t";
            echo $row[5]."\t\t";
            echo $row[6]."\t\t";
            echo $row[7]."\t\t";
            echo $row[8]."\t\t";
            echo $row[9]."\t\t";
            echo $row[10]."\t\t";
           
        
            echo "<br>";
            echo "<br>";
        }

  
    ?>
    

</body>

</html>