<?php
error_reporting( E_ALL );
ini_set('display_errors', 1);

include(dirname(__FILE__)."/../connect.php");
require_once(dirname(__FILE__)."/../controller/PubblicazioneController.php");

$pubblicazioni = PubblicazioneController::index($mysql);

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

    <div class="modal fade" id="nuovo_editore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="nuovo_editore.php" method="post">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Nuovo editore</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="nome" placeholder="Nome" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                        <button type="submit" class="btn btn-primary">Inserisci</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="nuovo_autore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="nuovo_autore.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nuovo autore</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <input type="text" name="nome" placeholder="Nome" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="cognome" placeholder="Cognome" class="form-control">
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Chiudi</button>
                    <button type="submit" class="btn btn-primary">Inserisci</button>
                </div>
            </div>
            </form>
        </div>
    </div>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuovo_editore">
        Nuovo editore
    </button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuovo_autore">
        Nuovo autore
    </button>


<div class="container pt-3">
    <h1>Lista pubblicazioni</h1>
    <table class="table table-bordered">
        <tr>
            <th>Titolo</th>
            <th>Autori</th>
            <th>Editore</th>
            <th>Anno di pubblicazione</th>
        </tr>
        <?php foreach($pubblicazioni as $pubblicazione) {
            echo "<tr>
                <td><a href='show.php?isbn=".$pubblicazione["isbn"]."'>".$pubblicazione["titolo"]."</a></td>
                <td>". $pubblicazione["autori"] ."</td>
                <td>". $pubblicazione["editore"]."</td>
                <td>". date("d/m/Y", strtotime($pubblicazione["data_pubblicazione"]))."</td>
            </tr>";

        }?>


    </table>

</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>


