<?php

$host = 'localhost';
$db   = 'ifoa_login_library';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

$pdo = new PDO($dsn, $user, $pass, $options);


$bookManager = new Book($pdo);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $title = $_POST['titolo'];
    $author = $_POST['autore_regista'];
    $year_publication = $_POST['anno_pubblicazione'];

    $bookManager = new Book($pdo);
    $newBookId = $bookManager->insertBook($title, $author, $year_publication);

    if ($newBookId) {
        $alertMessage = "Nuovo libro inserito con ID: $newBookId";
        $alertClass = "alert-success show";
    } else {
        $alertMessage = "Si è verificato un errore durante l'inserimento del libro.";
        $alertClass = "alert-danger show";
    }
}
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['book_id'])) {
    $bookId = $_GET['book_id'];
    $deleted = $bookManager->deleteBookById($bookId);
    if ($deleted) {
        $books = $bookManager->getAllBooks();
        $alertMessage = "Libro eliminato con successo.";
        $alertClass = "alert-success show";
    } else {
        $alertMessage = "Errore durante l'eliminazione del libro.";
        $alertClass = "alert-danger show";
    }
}

class Book {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAllBooks() {
        $sql = "SELECT * FROM books";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }

    public function insertBook($title, $author, $year_publication) {
        if (!empty($title) && !empty($author) && !empty($year_publication)) {

            $sql = "INSERT INTO books (title, author, year_publication) VALUES (?, ?, ?)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([$title, $author, $year_publication]);

            return $this->pdo->lastInsertId();
        } else {

            return false;
        }
    }

    public function deleteBookById($id) {
        $sql = "DELETE FROM books WHERE id_book = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }
}
