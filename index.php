<?php
include_once __DIR__ . '/classes/Book.php';
include_once __DIR__ . '/classes/User.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['titolo'];
    $author = $_POST['autore_regista'];
    $year_publication = $_POST['anno_pubblicazione'];
    $image = $_POST ['immagine'];
    $newBookId = $bookManager->insertBook($title, $author, $year_publication, $image);

    if ($newBookId) {
        $alertMessage = "Nuovo libro inserito con ID: $newBookId";
        $alertClass = "alert-success show";
    } else {
        $alertMessage = "Si è verificato un errore durante l'inserimento del libro.";
        $alertClass = "alert-danger show";
    }
}


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id_book'])) {
    $bookId = $_GET['id_book'];
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

include __DIR__ . '/includes/head.php';
?>
    <div class="container">
    <?php if ($userManager->isLoggedIn()) : ?>
            <h1 class="mt-5">Ciao <?php echo $userManager->getLoggedInUsername(); ?>! Aggiungi un libro!</h1>
        <?php else: ?>
            <h1 class="mt-5">Effettua il login o registrati!</h1>
        <?php endif; ?>
        <?php if ($userManager->isLoggedIn()) : ?>
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
    <div class="mb-3">
        <label for="immagine" class="form-label">URL dell'immagine:</label>
        <input type="text" name="immagine" id="immagine" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Aggiungi</button>
</form>
        <?php endif; ?>
        <h2 class="mt-5">Libri</h2>
        <div class="row mt-3">
            <?php foreach ($books as $book) : ?>
                <div class="col-md-4 mb-4">
                  <div class="card">
                    <img src="<?php echo $book['image']; ?>" class="card-img-top" alt="Immagine libro">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $book['title']; ?></h5>
                      <h6 class="card-subtitle mb-2 text-muted"><?php echo $book['author']; ?></h6>
                      <p class="card-text"><?php echo $book['year_publication']; ?></p>
                      <?php if ($userManager->isLoggedIn()) : ?>
                        <a href="?action=delete&id_book=<?php echo $book['id_book']; ?>" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo libro?')">Elimina</a>
                        <a href="modify.php?id_book=<?php echo $book['id_book']; ?>" class="btn btn-primary">Modify</a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>