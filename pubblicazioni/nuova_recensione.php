<?php
include(dirname(__FILE__)."/../connect.php");
require_once(dirname(__FILE__)."/../controller/PubblicazioneController.php");
session_start();
RecensioneController::crea($mysql, $_SESSION["username"], $_POST["isbn"], $_POST["mi_piace"], $_POST["descrizione"]);
header("Location: http://104.248.91.99/pubblicazioni/show.php?isbn=".$_POST["isbn"]);