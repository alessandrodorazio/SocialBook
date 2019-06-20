<?php
    error_reporting( E_ALL );
    ini_set('display_errors', 1);

    include(dirname(__FILE__)."/../connect.php");
    require_once(dirname(__FILE__)."/../controller/PubblicazioneController.php");

    $pubblicazione = PubblicazioneController::visualizza($mysql, $_GET["isbn"]);
    $mysql->close();
    $mysql->MySQLConnect();
    $log = PubblicazioneController::log($mysql, $_GET["isbn"]);
    $mysql->close();
    $mysql->MySQLConnect();
    $sorgenti = PubblicazioneController::lista_sorgenti($mysql, $_GET["isbn"]);
    $mysql->close();
    $mysql->MySQLConnect();
    $indici = PubblicazioneController::lista_indici($mysql, $_GET["isbn"]);
    $mysql->close();
    $mysql->MySQLConnect();
    $ristampe = PubblicazioneController::lista_ristampe($mysql, $_GET["isbn"]);

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

    <div class="modal fade" id="nuovo_sorgente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="nuovo_sorgente.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuovo sorgente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="isbn" value="<?php echo $_GET["isbn"]; ?>">
                        <div class="col-md-6">
                            <label>Tipo</label>
                            <input type="text" name="tipo" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Formato</label>
                            <input type="text" name="formato" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>URI</label>
                            <input type="text" name="uri" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Descrizione</label>
                            <input type="text" name="descrizione" class="form-control">
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

    <div class="modal fade" id="nuova_ristampa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="nuova_ristampa.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuova ristampa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="isbn" value="<?php echo $_GET["isbn"]; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Numero</label>
                            <input type="text" name="numero" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Data</label>
                            <input type="date" name="data" class="form-control">
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

    <div class="modal fade" id="nuovo_indice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="nuovo_indice.php" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuovo indice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="isbn" value="<?php echo $_GET["isbn"]; ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Titolo</label>
                            <input type="text" name="titolo" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label>Numero</label>
                            <input type="text" name="numero" class="form-control">
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

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuovo_sorgente">
        Nuovo sorgente
    </button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuovo_indice">
        Nuovo indice
    </button>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#nuova_ristampa">
        Nuova ristampa
    </button>

    <a class="btn btn-warning" href="edit.php?isbn=<?php echo $_GET["isbn"]; ?>">
        Modifica
    </a>
    <div class="row">
        <div class="col-md-6">
            <h1>Dettagli pubblicazione</h1>
            <p>Titolo: <?php echo $pubblicazione["titolo"]; ?></p>
            <p>ISBN: <?php echo $pubblicazione["isbn"]; ?></p>
            <p>Editore: <?php echo $pubblicazione["editore"]; ?></p>
            <p>Lingua: <?php echo $pubblicazione["lingua"]; ?></p>
            <p>Pagine: <?php echo $pubblicazione["pagine"]; ?></p>
            <p>Data pubblicazione: <?php echo date("d/m/Y", strtotime($pubblicazione["data_pubblicazione"])); ?></p>
            <p>Parole chiave: <?php echo $pubblicazione["parole_chiave"]; ?></p>
            <p>Numero like: <?php echo $pubblicazione["n_like"]; ?></p>
            <h2>Sorgenti</h2>
            <table class="table table-bordered">
                <tr>
                    <th>Tipo</th>
                    <th>URI</th>
                    <th>Formato</th>
                    <th>Descrizione</th>
                </tr>
                <?php
                foreach($sorgenti as $sorgente){
                    echo "<td>".$sorgente["tipo"]."</td><td>".$sorgente["uri"]."</td>"."<td>".$sorgente["formato"]."</td><td>".$sorgente["descrizione"]."</td>";
                }
                ?>
            </table>

            <h2>Indici</h2>
            <table class="table table-bordered">
                <tr>
                    <th>Numero</th>
                    <th>Titolo</th>
                </tr>
                <?php
                foreach($indici as $indice){
                    echo "<td>".$indice["numero"]."</td><td>".$indice["titolo"]."</td>";
                }
                ?>
            </table>
            <h2 class="table table-borderd">Ristampe</h2>
            <table>
                <tr>
                    <th>Numero</th>
                    <th>Data</th>
                </tr>
                <?php
                foreach($ristampe as $ristampa){
                    echo "<td>".$ristampa["numero"]."</td><td>".$ristampa["data_ristampa"]."</td>"."<td>";
                }
                ?>
            </table>


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
                            <td>".date("d/m/Y H:m", strtotime($l["data_modifica"]))."</td>
                        </tr>";
                }?>
            </table>

            <h4 class="mt-4">Recensisci</h4>
            <form action="#">
                Mi piace <input type="checkbox" name="like">
                <textarea name="descrizione" id="" cols="30" rows="10" placeholder="Lascia una recensione" class="form-control"></textarea>
                <button class="btn btn-success float-right mt-2">Salva</button>
            </form>

            <h4>Recensioni</h4>
            <p>
                A Utente è piaciuta questa pubblicazione e ha scritto: (16/07/2019)
                <br>
                Descrizione della recensione
            </p>
        </div>
    </div>


</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>