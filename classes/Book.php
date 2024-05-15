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
