<?php
include_once __DIR__ . '/classes/Book.php';

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



    $books = $bookManager->getAllBooks();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login&Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Aggiungi Libro</h1>
        <form action="" method="post" class="mt-4">
            <div class="mb-3">
                <label for="titolo" class="form-label">Titolo:</label>
                <input type="text" name="titolo" id="titolo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="autore_regista" class="form-label">Autore:</label>
                <input type="text" name="autore_regista" id="autore_regista" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="anno_pubblicazione" class="form-label">Anno di Pubblicazione:</label>
                <input type="number" name="anno_pubblicazione" id="anno_pubblicazione" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Aggiungi</button>
        </form>
        <h2 class="mt-5">Libri</h2>
        <div class="row mt-3">
            <?php foreach ($books as $book) : ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                <div class="card-body">
    <h5 class="card-title"><?php echo $book['title']; ?></h5>
    <h6 class="card-subtitle mb-2 text-muted"><?php echo $book['author']; ?></h6>
    <p class="card-text"><?php echo $book['year_publication']; ?></p>
    <a href="?action=delete&book_id=<?php echo $book['id_book']; ?>" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo libro?')">Elimina</a>
</div>

                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
