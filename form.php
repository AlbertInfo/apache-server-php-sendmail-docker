<?php
//RECUPERO DATI DA UN MODULO 

// Per recuperare dati da un modulo/form si utilizzano 2 array $_GET E $_POST
//ESSI consentono di recuperare dati inviati dal front-end mediante metodo get e post
//GET -> CHIEDERE UNA RISORSA AL SERVER
//POST -> CREARE UNA RISORSA NEL SERVER

//Con il metodo get le informazioni vengono passate nell'url - url-encodate -url-encode
//Con il metodo post invece vengono passate nel body della richiesta.


var_dump($_GET); //Accedo alle informazioni inviate dal front-end con method get
var_dump($_POST) . PHP_EOL; //Accedo alle informazioni inviate dal front-end con method post

var_dump($_SERVER); //Informazioni sul server
var_dump($_SERVER["PHP_SELF"]); //Informazioni sulla pagina percorso
var_dump($_SERVER["SERVER_PORT"]); //Informazioni sulla porta del server
var_dump($_SERVER["HTTP_HOST"]); //Informazioni sulL'host
var_dump($_SERVER["SERVER_PROTOCOL"]); //Informazioni sul protocollo 
// var_dump($_SERVER["HTTP_REFERER"]); //Informazioni sul protocollo 
var_dump($_SERVER["REQUEST_METHOD"]); //Informazioni sul metodo
// var_dump($_FILES['toProcess']);

//$_POST, $_GET e $_FILES sono degli array associativi..
//Le keys utilizzate corrispondo all'attributo name dei campi utilizzati in html
//Nei values troviamo i valori dei campi

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    //esegui codice
} else {
    die('You may only GET this page.');
}


header("Content-Type : text/plain"); // cosi forzo il tipo di headers che il browser riceverà
// header('Version : 3');
header('Location : https://www.google.it');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="text_field_name">Nome</label>
        <input type="text" name="text_field_name" id="">

        <button type="submit">Invia</button>
    </form>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="GET">
        Seleziona il tuo colore preferito:
        <!-- Attraverso il name della select diciamo di metterle tutte dentro un array attributes sennò andrebbero -->
        <!-- in giro per l'array $_POST -->
        <select name="attributes[]" multiple id="">
            <option value="giallo">Giallo</option>
            <option value="rosso">Rosso</option>
            <option value="verde">Verde</option>
            <option value="marrone">Marrone</option>

        </select>

        <button type="submit" name="s" value="Salva il tuo colore">Invia</button>
    </form>

    <?php
    // if (array_key_exists('s', $_GET)) {
    //     print_r($_GET);

    //     $description = join(" ", $_GET['attributes']);
    //     echo "You have a {$description} color!";
    // }

    //INVIO DI IMMAGINI AL SERVER
    //attraverso l'utilizzo dell'array $_FILES;
    // In questo array per ogni immagine inviata abbiamo :
    // nome- tipo-grandezza-tmp_name = il nome e il percorso del file sul server che contine il file
   

    ?>

    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <!-- Con il MAX_FILE_SIZE limitiamo al value in byte la grandezza del file da uploadare -->
        <!-- Con enctype multipart/form-data si dice al server che il file che arriverà è un immagine o file -->
        <input type="hidden" name="MAX_FILE_SIZE" value="10240" id="">
        File name: <input type="file" name="toProcess">

        <input type="submit">Invia file</input>
    </form>


</body>

</html>