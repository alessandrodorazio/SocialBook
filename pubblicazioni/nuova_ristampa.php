<?php
session_start();
error_reporting( E_ALL );
ini_set('display_errors', 1);

include(dirname(__FILE__)."/../connect.php");
require_once(dirname(__FILE__)."/../controller/PubblicazioneController.php");

PubblicazioneController::nuova_ristampa($mysql, $_POST["isbn"], $_POST["numero"], $_POST["data"]);
header("Location: http://104.248.91.99/pubblicazioni/show.php?isbn=".$_POST["isbn"]);