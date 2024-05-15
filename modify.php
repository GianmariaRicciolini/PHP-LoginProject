<?php
include_once __DIR__ . '/classes/Book.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $bookId = $_POST['id_book'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $year_publication = $_POST['year_publication'];
    $image = $_POST['image'];

    $updated = $bookManager->updateBook($bookId, $title, $author, $year_publication, $image);

    if ($updated) {
        $alertMessage = "Libro aggiornato con successo.";
        $alertClass = "alert-success show";
        header("Location: index.php");
    } else {
        $alertMessage = "Si è verificato un errore durante l'aggiornamento del libro.";
        $alertClass = "alert-danger show";
    }

} elseif (isset($_GET['id_book'])) {
    $bookId = $_GET['id_book'];
    $bookManager = new Book($pdo);

    $bookDetails = $bookManager->getBookById($bookId);

    if ($bookDetails) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Modify Book</title>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        </head>
        <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container">
            <a class="navbar-brand" href="index.php">YourLibrary</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                </ul>
            </div>
          </div>
        </nav>
            <div class="container">
                <h1 class="mt-5">Modify Book</h1>
                <form action="" method="post" class="mt-4">
                <input type="hidden" name="id_book" value="<?php echo $bookDetails['id_book']; ?>">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title:</label>
                        <input type="text" name="title" id="title" class="form-control" value="<?php echo $bookDetails['title']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="author" class="form-label">Author:</label>
                        <input type="text" name="author" id="author" class="form-control" value="<?php echo $bookDetails['author']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="year_publication" class="form-label">Year of Publication:</label>
                        <input type="number" name="year_publication" id="year_publication" class="form-control" value="<?php echo $bookDetails['year_publication']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">URL dell'immagine:</label>
                        <input type="text" name="image" id="image" class="form-control" value="<?php echo $bookDetails['image']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
        </body>
        </html>
        <?php
    } else {
        echo "Book not found.";
    }
} else {
    echo "Book ID not provided.";
}
