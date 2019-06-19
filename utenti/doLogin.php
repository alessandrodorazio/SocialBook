<?php
    session_start();
    error_reporting( E_ALL );
    ini_set('display_errors', 1);

    include(dirname(__FILE__)."/../connect.php");
    require_once(dirname(__FILE__)."/../controller/UtenteController.php");

    $utente = UtenteController::login($mysql, $_POST["username"], $_POST["password"]);
    if($utente == "Error") header("Location: http://104.248.91.99/utenti/login.php");
    $_SESSION["username"] = $utente["username"];
    header("Location: http://104.248.91.99/utenti/show.php?id=".$utente["username"]);