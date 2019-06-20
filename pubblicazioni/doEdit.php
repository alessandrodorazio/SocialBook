<?php
include(dirname(__FILE__)."/../connect.php");
require_once(dirname(__FILE__)."/../controller/PubblicazioneController.php");
session_start();
PubblicazioneController::modifica($mysql, $_SESSION["username"], $_POST["isbn"], $_POST["lingua"], $_POST["titolo"], $_POST["pagine"], $_POST["data_pubblicazione"]);
header("Location: http://104.248.91.99/pubblicazioni/show.php?isbn=".$_POST["isbn"]);
