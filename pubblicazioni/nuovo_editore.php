<?php
session_start();
error_reporting( E_ALL );
ini_set('display_errors', 1);

include(dirname(__FILE__)."/../connect.php");
require_once(dirname(__FILE__)."/../controller/PubblicazioneController.php");

PubblicazioneController::nuovo_editore($mysql, $_POST["nome"]);