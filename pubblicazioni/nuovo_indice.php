<?php
session_start();
error_reporting( E_ALL );
ini_set('display_errors', 1);

include(dirname(__FILE__)."/../connect.php");
require_once(dirname(__FILE__)."/../controller/PubblicazioneController.php");

PubblicazioneController::nuovo_indice($mysql, $_POST["titolo"], $_POST["numero"], $_POST["isbn"]);
header("Location: http://104.248.91.99/pubblicazioni/show.php?isbn=".$_POST["isbn"]);