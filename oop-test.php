
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
    echo 'Sono connesso a Internet!!';
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
    return new AppleRadio($phone); // passso l'oggetto $phone al costruttore di AppleRadio
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
