CREATE TABLE Editore (
    id integer AUTO_INCREMENT,
    nome char(128) NOT NULL,

    PRIMARY KEY(id),
    UNIQUE(nome)
);
CREATE TABLE Pubblicazione (
    isbn char(13),
    editore integer,
    titolo char(128) NOT NULL,
    lingua char(128),
    pagine integer,
    data_pubblicazione date,
    n_like integer default 0,

    PRIMARY KEY(isbn),
    FOREIGN KEY(editore) REFERENCES Editore(id)  ON DELETE SET NULL,
    CHECK (data_pubblicazione <= CURRENT_DATE )
);
CREATE TABLE Autore (
    id integer AUTO_INCREMENT,
    nome char(128) NOT NULL,
    cognome char(128) NOT NULL,

    PRIMARY KEY(id)
);
CREATE TABLE Utente (
    username char(128),
    tipologia integer DEFAULT 0,
    email char(128) NOT NULL,
    password char(128) NOT NULL,

    PRIMARY KEY(username),
    UNIQUE(email)
);
CREATE TABLE Keywords (
    id integer AUTO_INCREMENT,
    pubblicazione  char(13) NOT NULL,
    parola char(128) NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(pubblicazione) REFERENCES Pubblicazione(isbn)  ON DELETE CASCADE,
    UNIQUE(parola, pubblicazione)
);
CREATE TABLE Indice (
    id integer AUTO_INCREMENT,
    pubblicazione  char(13) NOT NULL,
    titolo char(128) NOT NULL,
    numero integer NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY (pubblicazione) REFERENCES Pubblicazione(isbn) ON DELETE CASCADE,
    UNIQUE(numero, pubblicazione)
);
CREATE TABLE Ristampe (
    id integer AUTO_INCREMENT,
    pubblicazione  char(13) NOT NULL,
    numero char(13) NOT NULL,
    data_ristampa date NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY (pubblicazione) REFERENCES Pubblicazione(isbn)  ON DELETE CASCADE,
    UNIQUE(numero, pubblicazione),
    CHECK (data <= CURRENT_DATE)
);
CREATE TABLE Sorgente (
    id integer AUTO_INCREMENT,
    tipo char(128) NOT NULL,
    uri char(128),
    formato char(128) NOT NULL,
    descrizione char(255) NOT NULL,
    pubblicazione char(13) NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(pubblicazione) REFERENCES Pubblicazione(isbn) ON DELETE CASCADE
);
CREATE TABLE Autore_Pubblicazione (
    autore integer,
    pubblicazione char(13),

    PRIMARY KEY(autore, pubblicazione),
    FOREIGN KEY(autore) REFERENCES Autore(id)  ON DELETE CASCADE,
    FOREIGN KEY(pubblicazione) REFERENCES Pubblicazione(isbn)  ON DELETE CASCADE,
    UNIQUE(autore, pubblicazione)
);
CREATE TABLE Storia (
    id integer AUTO_INCREMENT,
    utente char(128) NOT NULL,
    pubblicazione char(13) NOT NULL,
    frase char(128),
    data_modifica timestamp DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(id),
    FOREIGN KEY(utente) REFERENCES Utente(username)  ON DELETE SET NULL,
    FOREIGN KEY(pubblicazione) REFERENCES Pubblicazione(isbn)  ON DELETE CASCADE
);
CREATE TABLE Recensione (
    utente char(128),
    pubblicazione char(13),
    mi_piace int,
    descrizione char(255) NOT NULL,
    data_inserimento timestamp DEFAULT CURRENT_TIMESTAMP,
    approvata tinyint(1) DEFAULT 0,

    PRIMARY KEY(utente, pubblicazione),
    FOREIGN KEY(Utente) REFERENCES Utente(username) ON DELETE CASCADE,
    FOREIGN KEY(Pubblicazione) REFERENCES Pubblicazione(isbn) ON DELETE CASCADE,
    CHECK(data <= CURRENT_DATE)
);
