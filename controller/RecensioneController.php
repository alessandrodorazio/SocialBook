<?php


class RecensioneController
{
    public function crea(MySQL $conn, $utente, $pubblicazione, $mi_piace, $descrizione) {
        $mi_piace = ($mi_piace=="on")?1:0;
        $query="CALL query9('".$pubblicazione."', '".$utente."',".$mi_piace.",'".$descrizione."')";
        $conn->Execute($query);
        if($mi_piace==1){
            $conn->Execute("UPDATE Pubblicazione SET num_like=num_like+1 WHERE isbn='".$pubblicazione."';");
            $conn->Execute($query);
        }
    }

    public static function approva(MySQL $conn, $utente, $pubblicazione, $moderatore)
    {
        $conn->Execute("CALL query10('" . $utente . "','" . $pubblicazione . "','" . $moderatore . "');");
    }

    public static function in_attesa(MySQL $conn) {
        $recensioni = $conn->Execute("CALL query14();");
        return $recensioni;
    }

    public static function per_pubblicazione(MySQL $conn, $isbn){
        $recensioni = $conn->Execute("CALL query13('".$isbn."');");
        return $recensioni;
    }
}