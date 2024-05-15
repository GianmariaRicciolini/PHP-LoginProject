<?php
include_once 'MaterialeBibliotecario.php';

class Libro extends MaterialeBibliotecario {
    public $titolo;
    public $autore;
    public $annoPubblicazione;

    public function __construct($titolo, $autore, $annoPubblicazione) {
        $this->titolo = $titolo;
        $this->autore = $autore;
        $this->annoPubblicazione = $annoPubblicazione;
        self::$contatoreMateriali++;
    }

    public function prestato() {
        $this->presta();
    }

    public function restituito() {
        $this->restituisci();
    }

    static public function contaLibri() {
        return self::$contatoreMateriali;
    }
}
