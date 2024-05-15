<?php
// Elimina il cookie di login
setcookie("user_login", "", time() - 3600, "/");

header("Location: index.php");
exit();
