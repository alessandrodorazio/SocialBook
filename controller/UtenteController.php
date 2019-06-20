<?php


class UtenteController
{

    public static function index(MySQL $conn) {
        $utenti = $conn->Execute("SELECT * FROM Utente");
        return $utenti;
    }

    public static function visualizza(MySQL $conn, $username) {
        $utente = $conn->Execute("SELECT * FROM Utente u WHERE u.username='".$username."';");
        return $utente[0];
    }

    public static function crea(MySQL $conn, $username, $password) {
        $conn->Execute("CALL Registrazione('".$username."','".$password."');");
        return self::login($conn, $username, $password);
    }

    public static function modifica_tipo(MySQL $conn, $username, $nuovo_tipo) {
        $conn->Execute("CALL query1('".$username."',".$nuovo_tipo.");");
        return self::visualizza($conn, $username);
    }


    public static function login(MySQL $conn, $username, $password) {
        $utente = $conn->Execute("CALL Accesso('".$username."','".$password."');");
        if(count($utente) == 0) return "Error";
        return $utente[0];
    }

    public static function piu_collaborativi(MySQL $conn) {
        $utenti = $conn->Execute("CALL 4();");
        return $utenti;
    }

    public static function recensioni_utente(MySQL $conn, $username) {
        $recensioni = $conn->Execute("CALL recensioni_utente('".$username."');");
        return $recensioni;
    }

    public static function pubblicazioni_inserite(MySQL $conn, $username) {
        $pubblicazioni = $conn->Execute("CALL query5('".$username."');");
        return $pubblicazioni;
    }

    public function rendimod(MySQL $conn, $utente){
        $conn->Execute("CALL rendimod(".$utente.");");
        return self::visualizza($utente);
    }

}