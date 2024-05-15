<?php
include_once 'MaterialeBibliotecario.php';

class DVD extends MaterialeBibliotecario {
    public $titolo;
    public $regista;
    public $annoPubblicazione;

    public function __construct($titolo, $regista, $annoPubblicazione) {
        $this->titolo = $titolo;
        $this->regista = $regista;
        $this->annoPubblicazione = $annoPubblicazione;
        self::$contatoreMateriali++;
    }

    public function prestato() {
        $this->presta();
    }

    public function restituito() {
        $this->restituisci();
    }

    static public function contaDVD() {
        return self::$contatoreMateriali;
    }
}
