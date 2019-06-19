<?php
error_reporting( E_ALL );
ini_set('display_errors', 1);
    session_start();
    if(isset($_SESSION['username']))
        header("http://104.248.91.99/pubblicazioni/index.php");
    else
        header("Location: http://104.248.91.99/utenti/login.php");
?>