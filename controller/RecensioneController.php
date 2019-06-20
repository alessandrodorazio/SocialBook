<?php


class RecensioneController
{
    public function crea(MySQL $conn, $utente, $pubblicazione, $mi_piace, $descrizione) {
        $query="CALL query9('".$pubblicazione."', '".$utente."',".$mi_piace.",'".$descrizione."')";
        $conn->Execute($query);
        PubblicazioneController::visualizza($conn, $pubblicazione);
    }

    public function approva($rec_id, $mod_id) {

    }

    public function approvate($pub_id) {

    }

    public function in_attesa() {

    }
}