<?php
error_reporting( E_ALL );
ini_set('display_errors', 1);

include(dirname(__FILE__)."/../connect.php");
require_once(dirname(__FILE__)."/../controller/PubblicazioneController.php");

$pubblicazione = PubblicazioneController::visualizza($mysql, $_GET["isbn"]);
$log = PubblicazioneController::log($mysql, $_GET["isbn"]);

?>

<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SocialBook</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bg-light">
<?php include(dirname(__FILE__) . '/../layout/navbar.php'); ?>
<div class="container pt-3">


    <div class="row">
        <div class="col-md-6">
            <h1>Dettagli pubblicazione</h1>
            <p>Titolo: <?php echo $pubblicazione["titolo"]; ?></p>
            <p>ISBN: <?php echo $pubblicazione["isbn"]; ?></p>
            <p>Editore: <?php echo $pubblicazione["editore"]; ?></p>
            <p>Lingua: <?php echo $pubblicazione["lingua"]; ?></p>
            <p>Pagine: <?php echo $pubblicazione["pagine"]; ?></p>
            <p>Data pubblicazione: <?php echo $pubblicazione["data_pubblicazione"]; ?></p>
            <p>Parole chiave</p>
            LISTA SORGENTI

            <h4 class="mt-4">Recensisci</h4>
            <form action="#">
                Mi piace <input type="checkbox" name="like">
                <textarea name="descrizione" id="" cols="30" rows="10" placeholder="Lascia una recensione" class="form-control"></textarea>
                <button class="btn btn-success float-right mt-2">Salva</button>
            </form>
        </div>
        <div class="col-md-6">
            <h2>Registro modifiche</h2>
            <table class="table table-bordered">
                <tr>
                    <th>Descrizione</th>
                    <th>Utente</th>
                    <th>Data</th>
                </tr>
                <?php foreach($log as $l){
                   echo "<tr>
                            <td>".$l["frase"]."</td>
                            <td>".$l["username"]."</td>
                            <td>".date("d-m-Y HH:mm", strtotime($l["data_modifica"]))."</td>
                        </tr>";
                }?>
            </table>
        </div>
    </div>


    <?php //foreach ?>
    <h3>Recensioni</h3>
    <p>
        A Utente è piaciuta questa pubblicazione e ha scritto: (16/07/2019)
        <br>
        Descrizione della recensione
    </p>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>