<?php
require 'phpmailer_example/vendor/autoload.php';
require ('phpmailer_example/src/example.php');
$mail = getMailer();
$mail->send();