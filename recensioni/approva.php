<?php
include(dirname(__FILE__)."/../connect.php");
require_once(dirname(__FILE__)."/../controller/RecensioneController.php");
session_start();
echo RecensioneController::approva($mysql, $_GET["utente"], $_GET["isbn"], $_SESSION["username"]);
header("Location: http://104.248.91.99/recensioni/daApprovare.php");