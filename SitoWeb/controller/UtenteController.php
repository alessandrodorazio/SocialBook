<?php


class UtenteController
{

    public static function index(MySQL $conn) {
        $utenti = $conn->Execute("SELECT * FROM Utente");
        return $utenti;
    }

    public static function visualizza(MySQL $conn, $username) {

    }

    public static function crea(MySQL $conn, $username, $password) {
        echo "CALL Registrazione('".$username."','".$password."');";
        $conn->Execute("CALL Registrazione('".$username."','".$password."');");
        return login($conn, $username, $password);
    }

    public function modifica_tipo($user_id, $nuovo_tipo) {
        //CHANGE STATE (1)
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

    public function pubblicazioni_inserite($user_id) {

    }

}