<?php
    include(dirname(__FILE__)."/../connect.php");
    require_once(dirname(__FILE__)."/../controller/UtenteController.php");
    UtenteController::crea($mysql, $_POST["username"], $_POST["password"]);
    header("Location: http://104.248.91.99/utenti/login.php");