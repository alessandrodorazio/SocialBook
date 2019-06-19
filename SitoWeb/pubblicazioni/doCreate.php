<?php
    echo $_POST["autori"];
    include(dirname(__FILE__)."/../connect.php");
    require_once(dirname(__FILE__)."/../controller/PubblicazioneController.php");
    session_start();
    echo PubblicazioneController::crea($mysql, $_SESSION["username"], $_POST["isbn"], $_POST["editore"], $_POST["lingua"], $_POST["titolo"], $_POST["pagine"], $_POST["data_pubblicazione"], $_POST["sorgenti"], $_POST["indici"], $_POST["ristampe"], $_POST["autori"], $_POST["parole_chiave"]);
    //header("Location: http://104.248.91.99/pubblicazioni/show.php?id=".$_POST["isbn"]);