<?php
include_once 'classes/MaterialeBibliotecario.php';
include_once 'classes/Libro.php';
include_once 'classes/DVD.php';
include_once 'interfaces/Prestito.php';


// Esempio di utilizzo
$libro1 = new Libro("Il Signore degli Anelli", "J.R.R. Tolkien", 1954);
$dvd1 = new DVD("Inception", "Christopher Nolan", 2010);

echo "Numero totale di libri nella biblioteca: " . Libro::contaLibri() . "<br>";
echo "Numero totale di DVD nella biblioteca: " . DVD::contaDVD() . "<br>";

?>