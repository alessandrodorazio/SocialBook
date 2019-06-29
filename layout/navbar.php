<?php
    session_start();
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">SocialBook</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="pubblicazioniDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pubblicazioni
                </a>
                <div class="dropdown-menu" aria-labelledby="pubblicazioniDropdown">
                    <a class="dropdown-item" href="http://104.248.91.99/pubblicazioni/index.php">Lista</a>
                    <a class="dropdown-item" href="http://104.248.91.99/pubblicazioni/create.php">Aggiungi</a>
                    <a class="dropdown-item" href="http://104.248.91.99/pubblicazioni/index.php?t=2">Ultime pubblicazioni</a>
                    <a class="dropdown-item" href="http://104.248.91.99/pubblicazioni/index.php?t=3">Aggiornate di recente</a>
                    <a class="dropdown-item" href="http://104.248.91.99/pubblicazioni/index.php?t=16">Con download</a>
                    <a class="dropdown-item" href="http://104.248.91.99/pubblicazioni/search.php">Cerca</a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="utentiDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Utenti
                </a>
                <div class="dropdown-menu" aria-labelledby="utentiDropdown">
                    <a class="dropdown-item" href="http://104.248.91.99/utenti/index.php">Lista</a>
                    <a class="dropdown-item" href="http://104.248.91.99/utenti/index.php?t=4">Più collaborativi</a>
                </div>
            </li>
            <?php if(isset($_SESSION['username'])) {?>
                <li class="nav-item">
                    <a class="nav-link" href="http://104.248.91.99/utenti/show.php?username=<?php echo $_SESSION['username']; ?>">Il mio profilo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="http://104.248.91.99/utenti/doLogout.php">Esci</a>
                </li>
                <?php if($_SESSION["tipologia"] == 2) {?>
                    <li class="nav-item">
                        <a class="nav-link" href="http://104.248.91.99/recensioni/daApprovare.php">Recensioni da approvare</a>
                    </li>
                <?php } ?>
            <?php } else { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="loginDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Login/registrati
                    </a>
                    <div class="dropdown-menu" aria-labelledby="loginDropdown">
                        <a class="dropdown-item" href="http://104.248.91.99/utenti/login.php">Login</a>
                        <a class="dropdown-item" href="http://104.248.91.99/utenti/register.php">Registrati</a>
                    </div>
                <?php } ?>
            </li>
        </ul>
    </div>
</nav>