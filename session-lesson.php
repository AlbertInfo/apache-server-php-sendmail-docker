<?php

//Il protocollo http 1 è stateless non tiene traccia delle informazioni.
//Cookies : stringhe di testo
//un server può trasmettere diversi cookies

//si utilizza la funzione setcookie()
// ha  parametri come : name - value - expires - path - domain - secure
// Ogni volta che un utente naviga una php APP , gli viene assegnato automaticamente
//un id all'interno del cookie PHPSESSID

// $_SESSION -> array che contiene le informazioni inerenti le sessioni

//Attraverso la funzione session_start() all'inizio dello script si inizia una
//nuova sessione 

session_start();

//Controllo se esiste la key visite , la setto a 0 e ogni volta che la chiamo aumento di 1
//Serve per vedere quante volte ho visitato la pagina
$_SESSION["visite"] = (array_key_exists('visite',$_SESSION) ? $_SESSION['visite']:0) + 1 ;

echo "Questa pagina è stata visitata: {$_SESSION["visite"]} volte";

//La sessione finisce con la funzione session_destroy();

//Le sessioni sono salvate in un file nel server all'interno di 
// session.save_path nel php.ini 