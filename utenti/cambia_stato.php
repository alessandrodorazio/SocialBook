<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include(dirname(__FILE__) . "/../connect.php");
require_once(dirname(__FILE__) . "/../controller/UtenteController.php");

if($_SESSION["tipo"] == 2){
    UtenteController::modifica_tipo($mysql, $_GET["username"], $_GET["tipo"]);
}
header("Location: http://104.248.91.99/utenti/show.php?username=" . $_GET["username"]);