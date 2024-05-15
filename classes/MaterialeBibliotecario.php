<?php
include_once 'Prestito.php';
include_once 'Presta.php';
include_once 'Restituisci.php';

abstract class MaterialeBibliotecario implements Prestito {
    use Presta, Restituisci;

    static public $contatoreMateriali = 0;

    abstract public function prestato();
    abstract public function restituito();
}
?>
