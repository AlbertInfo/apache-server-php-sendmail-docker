<?php

interface  RadioContract{

  public function start();

  public function stop();

  public function usbRead();
  
 
}



// Il chiamante anche in un altro file può utilizzarla 



//Essendo $radio una istanza di RadioContract posso utilizzare le sue funzionalità es: 

// $radio->start();
// $radio->stop();


class MivarRadio implements RadioContract{
public const serialNumber = 32;
  public function start(){
   echo 'Mi sono acceso';
  }

  public function stop(){
    echo 'Mi sono spento';
  }

  public function usbRead(){
    echo 'USB collegata';
  }
  
}

class RadioFactory{

    public static function get():RadioContract{
     return new MivarRadio();
    }
    //QUESTA CLASSE UTILIZZANDO IL METODO GET RITORNA UN RadioContract con tutte le sue funzionalità
  }

$radio = RadioFactory::get(); // cosi ho assegnato a $radio una istanza di RadioContract
$radioUsbFunction = $radio->usbRead();

echo $radioUsbFunction;


class AppleRadio extends MivarRadio {

    public function ssdRead(){
        echo 'SSD Riconosciuto!';
    }
    //abbiamo eseguito l'ovveride di un metodo ereditato da MivarRadio,
    //ossia abbiamo sovrascritto e cambiato il metodo usbRead();
    public function usbRead(){
        echo 'USB collegata : spazio disponibile 8gb!!';
    }
}

class RadioFactoryApple{
    
    public static function get():RadioContract{
     return new AppleRadio();
    }
    //QUESTA CLASSE UTILIZZANDO IL METODO GET RITORNA UN RadioContract con tutte le sue funzionalità
  }

  $radioApple = RadioFactoryApple::get();
   echo  $radioApple->ssdRead();
   echo $radioApple->usbRead();
  
   echo MivarRadio::serialNumber;