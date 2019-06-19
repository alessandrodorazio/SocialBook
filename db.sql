CREATE TABLE Editore (

    id integer AUTO_INCREMENT,
    nome char(32) NOT NULL,

    PRIMARY KEY(id),
    UNIQUE(nome)

);

CREATE TABLE Pubblicazione (

    isbn char(13),
    editore integer,
    titolo char(32) NOT NULL,
    lingua char(32),
    pagine integer,
    data_pubblicazione date,
    n_like integer default 0,
    n_modifiche integer default 0,

    PRIMARY KEY(isbn),
    FOREIGN KEY(editore) REFERENCES Editore(id),
    CHECK (data_pubblicazione <= CURRENT_DATE )

);


CREATE TABLE Autore (

    id integer AUTO_INCREMENT,
    nome char(32) NOT NULL,
    cognome char(32) NOT NULL,

    PRIMARY KEY(id)

);


CREATE TABLE Utente (

    username char(32),
    tipologia integer DEFAULT 0,
    email char(32) NOT NULL,
    password char(128) NOT NULL,

    PRIMARY KEY(username),
    UNIQUE(email)

);

CREATE TABLE Keywords (

    id integer AUTO_INCREMENT,
    pubblicazione  char(13) NOT NULL,
    parola char(32) NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(pubblicazione) REFERENCES Pubblicazione(isbn),
    UNIQUE(parola, pubblicazione)

);


CREATE TABLE Indice (

    id integer AUTO_INCREMENT,
    pubblicazione  char(13) NOT NULL,
    titolo char(32) NOT NULL,
    numero integer NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY (pubblicazione) REFERENCES Pubblicazione(isbn),
    UNIQUE(numero, pubblicazione)

);


CREATE TABLE Ristampe (

    id integer AUTO_INCREMENT,
    pubblicazione  char(13) NOT NULL,
    numero char(13) NOT NULL,
    data_ristampa date NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY (pubblicazione) REFERENCES Pubblicazione(isbn),
    UNIQUE(numero, pubblicazione),
    CHECK (data <= CURRENT_DATE)

);


CREATE TABLE Sorgente (

    id integer AUTO_INCREMENT,
    tipo char(32) NOT NULL,
    uri char(32),
    formato char(32) NOT NULL,
    descrizione char(255) NOT NULL,
    pubblicazione char(13) NOT NULL,

    PRIMARY KEY(id),
    FOREIGN KEY(pubblicazione) REFERENCES Pubblicazione(isbn)

);


CREATE TABLE Autore_Pubblicazione (

    autore integer,
    pubblicazione char(13),

    PRIMARY KEY(autore, pubblicazione),
    FOREIGN KEY(autore) REFERENCES Autore(id),
    FOREIGN KEY(pubblicazione) REFERENCES Pubblicazione(isbn),
    UNIQUE(autore, pubblicazione)

);


CREATE TABLE Storia (

    id integer AUTO_INCREMENT,
    utente char(32) NOT NULL,
    pubblicazione char(13) NOT NULL,
    frase char(128),
    data_modifica timestamp DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY(id),
    FOREIGN KEY(utente) REFERENCES Utente(username),
    FOREIGN KEY(pubblicazione) REFERENCES Pubblicazione(isbn)

);


CREATE TABLE Recensione (

    utente char(32),
    pubblicazione char(13),
    mi_piace bit DEFAULT FALSE,
    descrizione char(255) NOT NULL,
    data timestamp DEFAULT CURRENT_TIMESTAMP,
    approvata bit DEFAULT 0,

    PRIMARY KEY(utente, pubblicazione),
    FOREIGN KEY(Utente) REFERENCES Utente(username),
    FOREIGN KEY(Pubblicazione) REFERENCES Pubblicazione(isbn),
    CHECK(data <= CURRENT_DATE)

);