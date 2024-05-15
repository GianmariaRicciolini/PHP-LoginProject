<?php
include_once __DIR__ . '/classes/DVD.php';
include_once __DIR__ . '/classes/Libro.php';
include_once __DIR__ . '/classes/MaterialeBibliotecario.php';

// Funzione per elaborare i dati del form e inserirli nel database
function processForm() {
    // Definisci le credenziali del database
    $host = 'localhost';
    $db   = 'ifoa_login_library';
    $user = 'root';
    $pass = '';

    try {
        // Connessione al database
        $dsn = "mysql:host=$host;dbname=$db";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $pdo = new PDO($dsn, $user, $pass, $options);

        // Processa i dati inviati dal form
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Recupera i dati dal form
            $tipo = $_POST['tipo'];
            $titolo = $_POST['titolo'];
            $autoreRegista = $_POST['autore_regista'];
            $annoPubblicazione = $_POST['anno_pubblicazione'];

            // Inserisce i dati nel database in base al tipo selezionato
            if ($tipo == "libro") {
                $query = "INSERT INTO books (title, author, year_publication) VALUES (?, ?, ?)";
            } elseif ($tipo == "dvd") {
                $query = "INSERT INTO movies (title, director, year_publication) VALUES (?, ?, ?)";
            }

            // Prepara la query
            $stmt = $pdo->prepare($query);

            // Esegui la query
            $stmt->bindValue(1, $titolo);
            $stmt->bindValue(2, $autoreRegista);
            $stmt->bindValue(3, $annoPubblicazione);
            if ($stmt->execute()) {
                // Query eseguita con successo
                header("Location: index.php");
                exit();
            } else {
                // Gestione degli errori
                echo "Errore nell'esecuzione della query";
            }
        }
    } catch (PDOException $e) {
        // Gestione degli errori di connessione al database
        echo "Connessione fallita: " . $e->getMessage();
    }
}
