
<?php

interface  RadioContract
{

  public function start();

  public function stop();

  public function usbRead();
}



// Il chiamante anche in un altro file può utilizzarla 



//Essendo $radio una istanza di RadioContract posso utilizzare le sue funzionalità es: 

// $radio->start();
// $radio->stop();


class MivarRadio implements RadioContract
{
  public const serialNumber = 32;
  public function start()
  {
    echo 'Mi sono acceso';
  }

  public function stop()
  {
    echo 'Mi sono spento';
  }

  public function usbRead()
  {
    echo 'USB collegata';
  }
}

class RadioFactory
{

  public static function get(): RadioContract
  {
    return new MivarRadio();
  }
  //QUESTA CLASSE UTILIZZANDO IL METODO GET RITORNA UN RadioContract con tutte le sue funzionalità
}

$radio = RadioFactory::get(); // cosi ho assegnato a $radio una istanza di RadioContract
// $radioUsbFunction = $radio->usbRead();

// echo $radioUsbFunction;

//Apple radio è una radio che estende le proprietà di MivarRadio ma implementa anche la NavigateInternetContract
//Ovvero non la implementa AppleRadio ma qualcuno mi darà un componente che utilizzero'
//Attraverso l'aggiunta di funzionalità per composizione
class AppleRadio extends MivarRadio implements NavigateInternetContract
{
  //posso implementare quante interfacce si vuole, non cè un limite.

  public  NavigateInternetContract $somethingAbleToNavigate;

  public function __construct(NavigateInternetContract $somethingAbleToNavigate)
  {

    $this->somethingAbleToNavigate = $somethingAbleToNavigate;
  }
  //con la keyword parent riferisco al parent di AppleRadio ovvero MivarRadio
  //dopo di che richiamo il metoodo con parent::start(); e aggiungo nuove funzionalità.

  public function start()
  {
    parent::start();
    echo 'Funzionalità aggiuntiva dello start!!';
  }
  public function ssdRead()
  {
    echo 'SSD Riconosciuto!';
  }
  //abbiamo eseguito l'ovveride di un metodo ereditato da MivarRadio,
  //ossia abbiamo sovrascritto e cambiato il metodo usbRead();
  public function usbRead()
  {
    echo 'USB collegata : spazio disponibile 8gb!!'; //facendo questo ho migliorato la funzionalità usbRead
  }

  public function connectToInternet(): void
  {
    $this->somethingAbleToNavigate->connectToInternet();
  }
}
class SamsungGalaxyPhone implements NavigateInternetContract
{
  public function connectToInternet(): void
  {
    echo 'Sono connesso a Internet!!' ;
  }
}

interface NavigateInternetContract
{
  public function connectToInternet(): void;
}



class RadioFactoryApple
{

  public static function get(): RadioContract
  {
    $phone = new SamsungGalaxyPhone(); // è una classe che implementa l'interfaccia per la connessione
    return new AppleRadio($phone); // passo l'oggetto $phone al costruttore di AppleRadio
  }
  //QUESTA CLASSE UTILIZZANDO IL METODO GET RITORNA UN RadioContract con tutte le sue funzionalità
}

$radioApple = RadioFactoryApple::get();
//  echo  $radioApple->ssdRead();
//  echo $radioApple->usbRead();

echo MivarRadio::serialNumber;


$radioApple = RadioFactoryApple::get();
$radioApple->connectToInternet(); // Questo chiamerà connectToInternet() su SamsungGalaxyPhone
$radioApple->start();



//TRAITS 
//Dentro il trait ci sono le funzionalità che potenzialmente potrebbero usare altre classi
trait Logger
{
  public function log($logString)
  {
    $className = __CLASS__;
    echo date("Y-m-d h:i:s", time()) . ":[{$className}] {$logString}";
  }
}
//La classe user vuole usare la funzione log di Logger
class User
{
  use Logger;

  public $name;

  function __construct($name = '')
  {
    $this->name = $name;
    $this->log("Utente creato '{$this->name}'");
  }

  function __toString()
  {
    return $this->name;
  }
}

$alberto = new User();
$alberto->log('alberto');


//Se devo eseguire dentro una classe due trait che hanno funzioni che hanno lo stesso nome
//Posso dare un alias ad uno dei due come Command::run as runCommand,
//E mettere instead of sull'altro, quindi usero runCommand() e run();
trait Command
{

  function run()
  {
    echo 'Executing a command\n';
  }
}
trait Marathon
{

  function run()
  {
    echo "Running a marathon\n";
  }
}

class Person
{

  use Command, Marathon {
    Command::run as runCommand;
    Marathon::run insteadof Command;
  }
}

$personTest = new Person();
$personTest->runCommand();
$personTest->run();


//CLASSE ASTRATTI E METODI ASTRATTI : 

abstract class Component
{
  abstract function printOutput(); //metodo non implementato
}

//attraverso la classe poi posso implementare come voglio il metodo astratto
class ImageComponent extends Component
{

  function printOutput()
  {
    echo 'Pretty picture';
  }
}


//CLASSI ANONIME 

class Persona
{

  private string $name;
  private  ?string $surname;

  public function __construct(string $name, string $surname = null)
  {
    $this->name = $name;
    $this->surname = $surname;
  }

  public function  __toString()
  {

    return "$this->name" . " " . "$this->surname";
  }

  public function getName()
  {
    return $this->name;
  }

  public function getSurname()
  {
    return  $this->surname;
  }
}

// $person = new Persona("Antonio", "Bruno");
// echo $person->__toString();

class Driver extends Persona
{
  private ?DrivingLicense $license;
  public function __construct(DrivingLicense $license)
  {
    parent::__construct($license->getDriverName(), $license->getDriverSurname());
    $this->setLicense($license);
  }
  public function hasLicense(): bool
  {

    if (!is_null($this->license))
      return true;

    return false;
  }

  private  function setLicense(DrivingLicense $license)
  {
    $this->license = $license;
  }
}


class DrivingLicense
{

  private string $name;
  private string $surname;
  private DateTime $createdAt;
  private DateTime $expireAt;

  public function __construct(string $name, string $surname, DateTime $createdAt, DateTime $expireAt)
  {
    $this->name = $name;
    $this->surname = $surname;
    $this->createdAt = $createdAt;
    $this->expireAt = $expireAt;
  }


  public function getDriverName(): string
  {
    return $this->name;
  }

  public function getDriverSurname(): string
  {
    return $this->surname;
  }
}
class Car
{

  private ?Driver $driver;

  public function __construct(Driver $driver = null)
  {
    $this->driver = $driver;
  }

  public function hasDriver(): bool
  {
    if (!is_null($this->driver))
      return true;

    return false;
  }

  public function setDriver(Driver $driver): void
  {
    $this->driver = $driver;
  }

  public function getDriver(): Driver
  {
    return $this->driver;
  }
}

class Police
{

  public function checkCar(Car $car)
  {
    if (!$car->hasDriver())
      throw new \Exception("Car has not a driver!");

    if (!$car->getDriver()->hasLicense())
      throw new \Exception("Driver has not a license");

    echo 'Check is ok!!';
  }
}

$driver0 = new Driver(new DrivingLicense("Alberto", "Stendardi", new DateTime("2020-01-01"), new DateTime("2030-01-01")));

// $driver1 = new Driver("Giulia");

$car = new Car();
$car->setDriver($driver0);
$police = new Police();
echo $police->checkCar($car);


//CLASSI ANONIME 
//Può essere utile se ho bisogno magari di creare al volo una classe extra che ha delle funzionalità diverse
//Può essere utilizzata anche come wrapper di dati, tenendo una struttura generica dentro ed utilizzarla.
//Non può essere serializzata ossia trasformare una stringa di testo in una classe o viceversa.
$anonymous = new class('Alberto', 'Stendardi') extends Persona {

  public function getName(): string
  {
    return "Signor" . parent::getName(); //con parent:: prendo il ritorno del metodo della superclasse.
  }
};

echo $anonymous->getName();

//CLASSI STANDARD 
//Data wrapper per eccellenza
//utilizzate quando si vogliono storare dati in un oggetto invece che in un array
//Sono serializzabili a differenza delle anonime
$data = new stdClass(); //simile alle anonime


//TIPI DI VALORE E TIPI  DI RIFERIMENTO :

//I tipi di valore sono tipi primitivi (string,int,bool..)
//La differenza tra i tipi di valore e i tipi di riferimento è  : 


$a = 10; // int
$b = $a; // int 
$b++; 
echo "a:" . $a  . PHP_EOL; // a = 10;
echo "b:" . $b ; // b = 11;

//TIPI DI RIFERIMENTO : SONO GLI OGGETTI IN GENERALE

$c = new stdClass();
$c->value = 10;
$d = $c; // A D VIENE ASSEGNATO IL VALORE DI RIFERIMENTO A CUI PUNTA C
$d->value++; // INCREMENTIAMO IN UN UNICA VOLTA  IL VALUE DI C E IL VALUE DI D 

echo "c:" . $c->value . PHP_EOL;
echo "d:" . $d->value . PHP_EOL;

//comportamento dei tipi di valore come i tipi di riferimento con la &prima della variabile
$e = 10; // int
$f = &$e; // int 
$f++; 
echo "e:" . $e  . PHP_EOL; // a = 10;
echo "f:" . $f  . PHP_EOL;

//comportamento dei tipi di riferimento come i tipi di valore : ragionamento opposto
//Questo procedimento si chiama CLONAZIONE DEGLI OGGETTI 

//Quando viene assegnato un oggetto ad una nuova variabile, l'oggetto è passato  come riferimento
//Quindi riferisce la stessa porzione di memoria

//E' possible assegnare una copia dell'oggetto ad una nuova variabile, in questo caso si ottiene una 
//nuova porzione di memoria
//Con questa operazione se non viene esplicitato vengono copiate le variabile come tipi di valore ma non quelle
//con tipi di riferimento(Object)

//Metodo __clone() -> metodo speciale utilizzato per questo procedimento.

$g = new stdClass();
$g->value=10;
$h = clone $g; //clonando g , h si comporta come tipo di valore, quindi cambiera solo h
$h->value++; // aumento solo h perche ho copiato il valore di c in un altra porzione di memoria

echo "g" . $g->value . PHP_EOL;
echo "h" . $h->value . PHP_EOL;

//REFLECTION O INTROSPEZIONE 
// Possibilità di esaminare le caratteristiche di un oggetto 
//Informazioni riguardante l'origine di un oggetto :
// Utilizzato per : debuggers, serializzatori,profilatori ecc.

$reflection = new ReflectionClass("DrivingLicense");
echo $reflection;

interface ActionContract{
  function act():void;
}


class Action implements ActionContract{
  public function act():void{
    echo "Action";
  }
}

class Action2 {
  public function act():void{
    echo "Action2";
  }
}

class Action3 {

}

function wantAction(mixed $action){

  $reflectionClass = new ReflectionClass($action);
//esegui il codice all'interno dell'if solo se l'oggetto passato ha implementato il metodo act.
  if($reflectionClass->hasMethod("act")){ 

  
    echo $action->act();
  }
// altra parte di codice eventuale
}

wantAction(new Action());
wantAction(new Action2());
wantAction(new Action3());

//In questo metodo viene passato un argomento anche chiamato DELEGATO che è una stringa  e che verra istanziato
//come classe
function doAction(string $action){
if(class_exists($action)){
//se esiste una classe con la stringa passata su $action instanzio la classe con new
  $reflectionClass = new ReflectionClass($action);

//se la classe implementa un actionContract vado a chiamare anche il metodo act().
  if($reflectionClass->implementsInterface(ActionContract::class)){
    echo "ActionContract instance:" . (new $action())->act();
    return;
  }

}
throw new Exception("Actioncontract not implemented : INVALID");
}

// doAction(Action::class);
// doAction(Action2::class);

class_exists(Action2::class); //la classe esiste?
get_declared_classes(); //ritorna un array con tutte le classi dichiarate.
get_class_methods(Action2::class); //ritorna i metodi di una classe.
get_class_vars(Action2::class) . PHP_EOL; // ritorna le properties di una classe.

//SERIALIZZAZIONE 
//Serializzare un oggetto significa, prendere l'oggetto e rappresentarlo in un  insime di byte.
//Per poterlo rappresentarlo come stringa
//Avviene attraverso due metodi : 

// serialize(something) 
//unserialize($encoded)

//Tutte le istanze di oggetti possono essere serializzati.


class Bambino{

  public $name;

  public $surname;

  function __sleep() // METODO CHE VIENE EFFETTUATO DURANTE LA SERIALIZZAIZONE
  //se implemento questo metodo posso fare in modo di non  serializzare alcune property non inserendole
  //nell'array di ritorno
  {
    echo 'SERIALIZZANDO';
    return array("name","surname");//sleep deve per forza ritornare un array con le property della classe.
  }
//Con wakeup se viene implementato posso cambiare per esempio una property
  function __wakeup()
  {
    $this->surname = 'Claudio';
    echo "DESERIALIZZANDO"; //METODO CHE VIENE INVOCATO DURANTE LA DESERIALIZZAZIONE
  }
}

$a = new Bambino();
$a->name = 'Alice';
$a->surname = 'Giudice';

// echo serialize($a); //ottengo una stringa con i dati e altre informazioni per PHP 
// file_put_contents("serialize-example.txt", serialize($a)); //salvo in un file.txt la stringa

//Posso assegnare il contentuto del file.txt ad una  variabile. questa sarà una stringa.
// $newstring = file_get_contents("serialize-example.txt");

// $newUnserializeObject = unserialize($newstring); //ritrasformo la stringa in oggetto.
// var_dump($newUnserializeObject);

//La deserializzazione della stringa è possibile solo se abbiamo la classe iniziale con cui è stata serializzata

//Metodi della serializzazione

// __sleep();
// __workout();

//Serializzazione in JSON  (Javscript Object Notaion)

$arr = array("a" => 1, "b" => 2,"c"=>3);

// json_encode() -> accetta un value che è mixed : restituisce una stringa serializzata o false
// json_encode(mixed $value, int $flags=0, int $depth = 512)
//$value = oggetto che deve essere serializzato
//$flags = posso inserire dei comportamenti da eseguire es. delle formattazioni
//$depth = profondità intesa come quanto va indietro la serializzazione vede se ci sono oggetti che ereditano
//di standard è impostat a 512.

// echo json_encode($a); //restituisce un json di un oggetto con le sue proprietà
$s2= json_encode($a,flags:JSON_PRETTY_PRINT,depth:1); //JSON PRETTY PRINT formatta

file_put_contents("person.json",$s2);
$s3= json_decode($s2); //deserializza su una stdClass non su quella di partenza
var_dump($s3);

//PRINCIPI SOLID :

// S = Single Responsibility Principle -> una classe deve avere una sola responsabilità
//Produrre classi che sono fortemente specializzate, con features che cooperano per un solo scopo

//Code smell : puzza di qualcosa che non sta andando bene , pezzi di codice scontestualizzati dentro
//una classe o large setup in test = quando la classe ha un costruttore troppo complesso.

//O = Open closed principle  classe funzione o modulo dovrebbe avere meccanismi che permettono
//di estenderne il comportamento senza apportare modifiche al codice esistente.
//Quindi classi aperte alle estensioni ma chiuse alle modiche
//Code smell : troppi if/else complessi

//L = Liskov Substituion Principle = Le classi devono poter essere sostituite dalla classi da cui 
//derivano(superclassi) in maniera trasparente

//I = Interface Segregation Principle

//Una classe client non dovrebbe dipendere da metodi che non usa , è preferibile che le interfacce siano
//molte, specifiche e piccole.


// D = Dependency Inversion Principle 
//Una classe dovrebbe dipendere da astrazioni e non da concrete e specifiche implementazioni.
// Non creare istanze di basso livello(esempio connessioni a dB) nella logica di alto livello
//Esempio chiamare metodi di classi di basso livello in codice di alto livello.
//Componenti piu testabili.



 