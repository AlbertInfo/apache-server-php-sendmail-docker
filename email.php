<?php
const __SENDER_NAME__ = "IT'S ME";
const __SENDER_EMAIL__ = 'alb.stend97@gmail.com';
const __RECEPIENT_EMAIL__ ='info@palazzoriccaguarducci.it';

$headers = array(
    'From' => __SENDER_NAME__ . '<' . __SENDER_EMAIL__ . '>',
    'X-Mailer' => 'PHP/' . phpversion()
);

$subject = 'Test di funzionamento mail';

$message = 'Ciao,'
. PHP_EOL . 'Messaggio importante'
.PHP_EOL . 'Tutto funziona!';

$message = wordwrap( $message, 70,PHP_EOL );

$to = __RECEPIENT_EMAIL__;

$mailSendingResult = mail ( $to, $subject, $message, $headers ); 


if($mailSendingResult){
    echo 'Success';

} else{
    echo 'Failure';
}