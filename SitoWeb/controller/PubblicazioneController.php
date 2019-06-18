<?php


class PubblicazioneController
{

    public static function index(MySQL $conn){
        $pubblicazioni = $conn->Execute("SELECT * FROM Pubblicazione");
        return $pubblicazioni;
    }

    public static function visualizza(MYSQL $conn, $isbn) {
        $pubblicazione = $conn->Execute("SELECT * FROM Pubblicazione WHERE isbn =".$isbn);
        return $pubblicazione;
    }

    public function crea(MySQL $conn, $editore_nome, $isbn, $lingua, $titolo, $pagine, $data_pubblicazione) {

        $editore = $conn->Execute("SELECT * FROM Editore WHERE nome='" . $editore_nome . "';");
        if(count($editore) == 0) {
            $editore = $conn->Execute("INSERT INTO Editore(nome) VALUES('".$editore_nome."')");
        }
        $editore_id = $editore->id;

        $query = "INSERT INTO PUBBLICAZIONE(isbn, editore, titolo, lingua, data_pubblicazione) VALUES (";
        $query = $query."'".$isbn."',";
        $query = $query."'".$editore_id."',";
        $query = $query."'".$titolo."',";
        $query = $query."'".$lingua."',";
        $query = $query."'".$data_pubblicazione."');";

        $pubblicazione = $conn->Execute($query);

        PubblicazioneController::visualizza($conn, $pubblicazione->id);

    }

    public function modifica($pub_id) {

    }

    public function elimina($pub_id) {

    }

    public function ultime_pubblicazioni($count) {

    }

    public function aggiornate_recente() {

    }

    public function cerca() {

    }

    public function log($pub_id) {

    }

    public function con_download() {

    }

    public function catalogo_ultima_ristampa() {

    }

    public function stessi_autori($pub_id) {

    }

}