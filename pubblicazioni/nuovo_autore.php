<?php
session_start();
error_reporting( E_ALL );
ini_set('display_errors', 1);

include(dirname(__FILE__)."/../connect.php");
require_once(dirname(__FILE__)."/../controller/PubblicazioneController.php");

PubblicazioneController::nuovo_autore($mysql, $_POST["nome"], $_POST["cognome"]);
header("Location: http://104.248.91.99/pubblicazioni/index.php");