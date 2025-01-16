<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Mio esercizio PHP</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <link rel="stylesheet" href="style.css" />


</head>

<body>
    
<?php 
 $x = 1245;
 echo $x;
 
 
 ?>
   <br>
   <?php 
 $x = 1245;
 
 
 var_dump($x); // permette di leggere sia il tipo che il valore della variabile.
 ?>

 <br>
 <?php 
 $cars = array("Volvo",11.33,"Toyota");
 var_dump($cars);
 ?>;

 <br>
 
 <h3>Esercizio numeri pari o dispari</h3>
 <br>
 <br>
 <br>
 <br>
 <br>


 <?php
$number = 100;
$risultato = $number % 2 == 0 ? "Il numero è pari" : "Il numero è dispari";
echo $risultato;


 ?>

 <br>
 <br>
 <br>
 <br>
 
 <?php

 $i = 0;
 while ($i <=10){
  
  echo $i++;
 }
//ALL'INTERNO DELLA PARENTESI TONDA C'E' LA CONDIZIONE BOOLENA, MA POTREBBE STARCI ANCHE
//UNA FUNZIONE CHE RITORNA TRUE OR FALSE
 ?>
 <?php

$i = 0;
while ($i <=10) :
  echo "<li>test n. $i</li>";
 echo $i++;

endwhile;
//sintax sugar : ridotta
?>
<br>
<h3>Ciclo do while</h3>
<?php


do {
  $i = 0;
  $i++;
  echo $i;
 
} while ($i >= 3);

  
//sintax sugar : ridotta
?>

<br>
<h3>Ciclo for</h3>
<?php
for($i = 1; $i <=10 ; $i++){
  echo $i;
}
?>

<br>
<h3>Ciclo foreach con array</h3>
<?php

$info = array('coffee','brown','caffeine');

foreach($info as &$value){
  echo "<li>$value</li>";
}


?>
<br>
<h3>Esercitazione</h3>
<br>
Creare uno script per stampare la riga 1-2-3-4-5-6-7-8-9-10 con un loop
Creare uno script per sommare tutti gli interi tra 0 e 30 e infine mostrare il risultato
Creare uno script che costruisca un patter di * 

<br>
<h3>Esercitazione n.1</h3>
<?php
$i=1;
for($i=1;$i<=10;$i++){
  if($i != 10){
    $result = " $i - ";
  }
  else
  $result = "$i";
  echo $result;
}
?>
<h3>Esercitazione n.2</h3>
<br>
<?php
$numbers = [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30];
foreach($numbers as &$value){
  $sum = $value +$value;
  echo $sum;
}


?>
<br>
<?php
$frutti = [
  'frutto0' => 'Banana',
  'frutto1' => 'Mela',
  'frutto2' => 'Pera'
];
$needle = 'Banana';
echo "Sono presenti " . "" .  count($frutti) . " "   . "frutti";

echo in_array($needle,$frutti) ? "$needle è contenuto in array" : 'Non trovato';

?>
<?php
function writeName(string $name): void{
 echo "Hello $name!!";
}
 
$test = writeName('Albi');

?>
</body>

</html>

