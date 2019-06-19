<?php


class UtenteController
{

    public static function index(MySQL $conn) {
        $utenti = $conn->Execute("SELECT * FROM Utente");
        return $utenti;
    }

    public static function visualizza(MySQL $conn, $username) {
        $utente = $conn->Execute("SELECT username FROM Utente WHERE username='".$username."');");
        return $utente[0];
    }

    public static function crea(MySQL $conn, $username, $password) {
        echo "CALL Registrazione('".$username."','".$password."');";
        $conn->Execute("CALL Registrazione('".$username."','".$password."');");
        return login($conn, $username, $password);
    }

    public function modifica_tipo(MySQL $conn, $username, $nuovo_tipo) {
        $conn->Execute("CALL query1('".$username."',".$nuovo_tipo.");");
        return self::visualizza($username);
    }

    public function elimina($user_id) {

    }

    public function registrazione($email, $password) {

    }

    public static function login(MySQL $conn, $username, $password) {
        $utente = $conn->Execute("CALL Accesso('".$username."','".$password."');");
        if(count($utente) == 0) return "Error";
        return $utente[0];
    }

    public function piu_collaborativi() {

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