<?php
error_reporting( E_ALL );
ini_set('display_errors', 1);

include(dirname(__FILE__)."/../connect.php");
require_once(dirname(__FILE__)."/../controller/PubblicazioneController.php");

$autori = PubblicazioneController::lista_autori($mysql);
$mysql->close();
$mysql->MySQLConnect();
$editori = PubblicazioneController::lista_editori($mysql);

?>

<!doctype html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nuova pubblicazione | SocialBook</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bg-light">
<?php include(dirname(__FILE__) . '/../layout/navbar.php'); ?>
<div class="container pt-3">
    <h1>Inserisci pubblicazione</h1>
    <form action="doCreate.php" method="post">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="titolo">Titolo</label>
                    <input type="text" name="titolo" id="titolo" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" name="isbn" id="isbn" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="lingua">Lingua</label>
                    <input type="text" name="lingua" id="lingua" class="form-control">
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="pagine">Numero pagine</label>
                    <input type="text" name="pagine" id="pagine" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="parole_chiave">Parole chiave (separate da una virgola)</label>
                    <input type="text" name="parole_chiave" id="parole_chiave" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="data_pubblicazione">Data di pubblicazione</label>
                    <input type="date" name="data_pubblicazione" id="data_pubblicazione" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="editore">Nome editore</label>
                    <select name="editore" id="editore">
                        <?php foreach($editori as $editore){ echo "<option value='".$editore["id"]."'>".$editore["nome"]."</option>"; } ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="autori">Autori</label>
                    <select name="autori[]" id="autori" class="form-control" multiple>
                        <?php foreach($autori as $autore){ echo "<option value='".$autore["id"]."'>".$autore["nome"]." ".$autore["cognome"]."</option>"; } ?>
                    </select>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-lg float-right">Inserisci</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>


