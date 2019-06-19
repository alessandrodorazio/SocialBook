<?php
    session_start();
    session_destroy();
    header("Location: http://104.248.91.99/utenti/login.php");