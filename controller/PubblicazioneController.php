<?php


class PubblicazioneController
{

    public static function index(MySQL $conn){
        $pubblicazioni = $conn->Execute("CALL query6();");
        return $pubblicazioni;
    }

    public static function visualizza(MYSQL $conn, $isbn) {
        $pubblicazione = $conn->Execute("SELECT p.*, group_concat(parola) AS parole_chiave FROM Pubblicazione p, Keywords k WHERE k.pubblicazione='".$isbn."' AND isbn ='".$isbn."' GROUP BY isbn;");
        return $pubblicazione[0];
    }

    public static function nuovo_editore(MySQL $conn, $nome){

        $conn->Execute("INSERT INTO Editore(nome) VALUES('".$nome."')");
        return self::index($conn);
    }

    public static function lista_editori(MySQL $conn){
        $editori = $conn->Execute("SELECT * FROM Editore;");
        return $editori;
    }


    public static function nuovo_autore(MySQL $conn, $nome, $cognome) {
        $autore = $conn->Execute("INSERT INTO Autore(nome, cognome) VALUES('".$nome."', '".$cognome."')");
        return self::index($conn);
    }

    public static function lista_autori(MySQL $conn){
        $autori = $conn->Execute("SELECT * FROM Autore;");
        return $autori;
    }

    public static function lista_autori_pub(MySQL $conn, $isbn){
        $autori = $conn->Execute("SELECT group_concat(nome,' ', cognome) AS nome_cognome FROM Autore a, Autore_Pubblicazione ap WHERE pubblicazione='".$isbn."' AND ap.autore=a.id GROUP BY pubblicazione;");
        return $autori[0];
    }

    public static function nuovo_sorgente(MySQL $conn, $tipo, $uri, $formato, $descrizione, $pubblicazione){
        $query = "INSERT INTO Sorgente(tipo, uri, formato, descrizione, pubblicazione) VALUES(";
        $query = $query."'".$tipo."',";
        $query = $query."'".$uri."',";
        $query = $query."'".$formato."',";
        $query = $query."'".$descrizione."',";
        $query = $query."'".$pubblicazione."');";
        $conn->Execute($query);
        return self::index($conn);
    }

    public static function lista_sorgenti(MySQL $conn, $isbn){
        $sorgenti = $conn->Execute("SELECT * FROM Sorgente WHERE pubblicazione='".$isbn."';");
        return $sorgenti;
    }

    public static function nuovo_indice(MySQL $conn, $titolo, $numero, $pubblicazione){
        $query = "INSERT INTO Indice(pubblicazione, titolo, numero) VALUES(";
        $query = $query."'".$pubblicazione."',";
        $query = $query."'".$titolo."',";
        $query = $query."'".$numero."');";

        $conn->Execute($query);
        return self::index($conn);
    }

    public static function lista_indici(MySQL $conn, $isbn){
        $indici = $conn->Execute("SELECT * FROM Indice WHERE pubblicazione='".$isbn."';");
        return $indici;
    }

    public static function nuova_ristampa(MySQL $conn, $pubblicazione, $numero, $data){
        $query = "INSERT INTO Ristampe(pubblicazione, numero, data_ristampa) VALUES(";
        $query = $query."'".$pubblicazione."',";
        $query = $query."'".$numero."',";
        $query = $query."'".$data."');";

        $conn->Execute($query);
        return self::index($conn);
    }

    public static function lista_ristampe(MySQL $conn, $isbn){
        $ristampe = $conn->Execute("SELECT * FROM Ristampe WHERE pubblicazione='".$isbn."';");
        return $ristampe;
    }

    public static function nuova_storia(MySQL $conn, $utente, $pubblicazione, $frase){
        $query = "INSERT INTO Storia(utente, pubblicazione, frase) VALUES(";
        $query = $query."'".$utente."',";
        $query = $query."'".$pubblicazione."',";
        $query = $query."'".$frase."');";
        $conn->Execute($query);
        return self::index($conn);
    }

    public static function nuova_parola_chiave(MySQL $conn, $parola_chiave, $pubblicazione){
        if(! $parola_chiave) return null;
        $query = "INSERT INTO Keywords(parola, pubblicazione) VALUES(";
        $query = $query."'".$parola_chiave."',";
        $query = $query."'".$pubblicazione."');";

        $conn->Execute($query);
    }

    public static function crea(MySQL $conn, $utente, $isbn, $editore, $lingua=null, $titolo, $pagine=null, $data_pubblicazione, $sorgenti=null, $indici, $ristampe=null, $autori=null, $parole_chiave) {

        $query = "INSERT INTO Pubblicazione(isbn, editore, titolo, lingua, pagine, data_pubblicazione) VALUES (";
        $query = $query."'".$isbn."',";
        $query = $query."'".$editore."',";
        $query = $query."'".$titolo."',";
        $query = $query."'".$lingua."',";
        $query = $query."'".$pagine."',";
        $query = $query."'".$data_pubblicazione."');";

        $pubblicazione = $conn->Execute($query);

        $parole_chiave = explode(',', $parole_chiave);

        foreach($parole_chiave as $parola_chiave){
            self::nuova_parola_chiave($conn, $parola_chiave, $isbn);
        }

        foreach($sorgenti as $sorgente){
            self::nuovo_sorgente($conn, $sorgente["tipo"], $sorgente["uri"], $sorgente["formato"], $sorgente["descrizione"], $isbn);
        }

        foreach($indici as $indice){
            self::nuovo_indice($conn, $indice["tipo"], $indice["numero"], $isbn);
        }

        foreach($ristampe as $ristampa){
            self::nuova_ristampa($conn, $isbn, $ristampa["numero"], $ristampa["data_ristampa"]);
        }

        self::nuova_storia($conn, $utente, $isbn, "Inserimento pubblicazione");

        foreach($autori as $autore) {
            $conn->close();
            $conn->MySQLConnect();
            $query = "CALL ins_ap(".$autore.", '".$isbn."');";
            $conn->Execute($query);
        }

        return self::visualizza($conn, $isbn);

    }

    public static function num_like(MySQL $conn, $isbn) {
        $num = $conn->Execute("SELECT COUNT(*) AS mi_piace FROM Recensione WHERE mi_piace=1 AND pubblicazione='".$isbn."'");
        return $num[0]["mi_piace"];
    }

    public static function modifica(MySQL $conn, $utente, $isbn, $lingua, $titolo, $pagine, $data_pubblicazione) {
        $query="UPDATE Pubblicazione SET ";
        $query=$query." lingua='".$lingua."',";
        $query=$query."titolo='".$titolo."',";
        $query=$query."pagine='".$pagine."','";
        $query=$query."data_pubblicazione=".$data_pubblicazione." ";
        $query=$query."WHERE isbn='".$isbn."';";

        self::nuova_storia($conn, $utente, $isbn, "Modifica pubblicazione");
        $query->Execute();
        return self::visualizza($conn, $isbn);
    }

    public static function ultime_pubblicazioni(MySQL $conn) {
        $pubblicazioni = $conn->Execute("CALL query2();");
        return $pubblicazioni;
    }

    public static function aggiornate_recente(MySQL $conn) {
        $pubblicazioni = $conn->Execute("CALL query3();");
        return $pubblicazioni;
    }

    public static function cerca(MySQL $conn, $isbn, $titolo, $autore, $parola_chiave) {
        $risultati = $conn->Execute("CALL query8('".$isbn."','".$titolo."','".$autore."','".$parola_chiave."');");
        return $risultati;
    }

    public static function log(MySQL $conn, $pub_id) {
        $log = $conn->Execute("CALL query15('".$pub_id."');");
        return $log;
    }

    public static function con_download(MySQL $conn) {
        $pubblicazioni = $conn->Execute("CALL query16();");
        return $pubblicazioni;
    }

    public static function catalogo_ultima_ristampa(MySQL $conn) {
        $pubblicazioni = $conn->Execute("CALL query17();");
        return $pubblicazioni;
    }

    public static function stessi_autori(MySQL $conn, $pub_id) {
        $pubblicazioni = $conn->Execute("CALL query18('".$pub_id."');");
        return $pubblicazioni;
    }

}