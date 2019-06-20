<?php
session_start();
error_reporting( E_ALL );
ini_set('display_errors', 1);

include(dirname(__FILE__)."/../connect.php");
require_once(dirname(__FILE__)."/../controller/PubblicazioneController.php");

echo PubblicazioneController::nuovo_sorgente($mysql, $_POST["tipo"], $_POST["uri"], $_POST["formato"], $_POST["descrizione"], $_POST["isbn"]);
//header("Location: http://104.248.91.99/pubblicazioni/show.php?isbn=".$_POST["isbn"]);