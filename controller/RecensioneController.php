<?php


class RecensioneController
{
    public function crea(MySQL $conn, $utente, $pubblicazione, $mi_piace, $descrizione) {
        $mi_piace = ($mi_piace=="on")?true:false;
        $query="CALL query9('".$pubblicazione."', '".$utente."',".$mi_piace.",'".$descrizione."')";
        $conn->Execute($query);
    }

    public function approva($rec_id, $mod_id) {

    }

    public function approvate($pub_id) {

    }

    public function in_attesa() {

    }

    public static function per_pubblicazione(MySQL $conn, $isbn){
        $recensioni = $conn->Execute("CALL query13('".$isbn."');");
        return $recensioni;
    }
}