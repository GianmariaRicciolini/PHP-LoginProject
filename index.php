<?php
include_once __DIR__ . '/classes/Book.php';
include_once __DIR__ . '/classes/User.php';

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
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="index.php">YourLibrary</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <?php if ($userManager->isLoggedIn()) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="loginRegister.php">Login/Register</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<body>
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
                    <label for="immagine" class="form-label">Immagine:</label>
                    <input type="file" name="immagine" id="immagine" class="form-control" required>
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
                      <a href="?action=delete&book_id=<?php echo $book['id_book']; ?>" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo libro?')">Elimina</a>
                    </div>
                  </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>