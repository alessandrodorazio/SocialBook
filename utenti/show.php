<?php
error_reporting( E_ALL );
ini_set('display_errors', 1);

include(dirname(__FILE__)."/../connect.php");
require_once(dirname(__FILE__)."/../controller/UtenteController.php");

$utente = UtenteController::visualizza($mysql, $_GET["username"]);
$mysql->close();
$mysql->MySQLConnect();
$pubblicazioni = UtenteController::pubblicazioni_inserite($mysql, $_GET["username"]);

?>

    <!doctype html>
    <html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Utenti | SocialBook</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head>
    <body class="bg-light">
    <?php include(dirname(__FILE__) . '/../layout/navbar.php'); ?>
    <div class="container pt-3">
        <h1>Dettagli utente</h1>

        <div class="row">
            <div class="col-md-6">
                <table>
                    <tr>
                        <th>Username</th>
                        <td><?php echo $utente["username"]; ?></td>
                    </tr>
                </table>
                <h2>Recensioni</h2>
                <table class="table table-bordered">
                    <tr>
                        <th>Pubblicazione</th>
                        <th>Like</th>
                        <th>Descrizione</th>
                        <th>Data</th>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <h2>Pubblicazioni</h2>
                <ul>
                    <?php foreach($pubblicazioni as $pubblicazione) echo "<li><a href='../pubblicazioni/show.php?isbn=".$pubblicazione["titolo"]."'>".$pubblicazione["titolo"]."</a></li>"; ?>
                </ul>
            </div>

        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
    </html>


<?php
