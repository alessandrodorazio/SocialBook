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
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="http://104.248.91.99/utenti/index.php">Utenti</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Login/registrati
                </a>
                <?php if(isset($_SESSION['username'])) {?>
                    <li class="nav-item">
                        <a class="nav-link" href="http://104.248.91.99/utenti/show.php?username=<?php echo $_SESSION['username']; ?>">Utenti</a>
                    </li>
                <?php } else { ?>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="http://104.248.91.99/utenti/login.php">Login</a>
                        <a class="dropdown-item" href="http://104.248.91.99/utenti/register.php">Registrati</a>
                    </div>
                <?php } ?>
            </li>
        </ul>
    </div>
</nav>