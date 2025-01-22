<?php
// PHP E MYSQL INTERAZIONE CON IL DB 

//classi dTo -> data transfer object = classi che servono per contenere dati non hanno metodi specifici
//base64 : formato con cui si codificano i binary 

//PHP supporta più di 20 tipi di  Database non solo mysql 

//Ci sono due metodi per interagire con Mysql :
// MySQLi e
// PDO(Php Data Objects) -> anche con altri tipi di db  (meno efficiente)

//PD0 : 
//Permette di utilizzare le transactions

//Consente di 'preparare' gli statement per evitare di comporre in real time le query o i comandi
//per evitare sql injection
//Per utilizzare mysql con php bisogna caricare 2 estensioni : 

//php_pdo e php_pdo_mysql nel php.ini le configurazioni variano tra linux e windows 

function connectDatabase(): PDO
{
    $config = new stdClass();
    $config->host = 'localhost';
    $config->port = 3306;
    $config->db = 'dbname';
    $config->user = 'user';
    $config->password = 'password';
    $config->options = [];

    try{
        $conn = new PDO('mysql:host={$config->host};dbname={$config->db}',
        $config->user,
        $config->password,
        $config->options);
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $conn;

    }catch (PDOException $exception){
        echo "Connection error" . $exception->getMessage();
    }
}

$dbConnection = connectDatabase();