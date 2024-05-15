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

$userManager = new User($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $registrationStatus = $userManager->registerUser($username, $email, $password);

    if ($registrationStatus === true) {
        $userManager->setLoginCookie($username);
        
        header("Location: index.php");
        exit();
    } else {
        $registrationError = $registrationStatus;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if ($userManager->authenticate($username, $password)) {
        $userManager->setLoginCookie($username);
        
        header("Location: index.php");
        exit();
    } else {
        $loginError = "Credenziali non valide. Riprova.";
    }
}
class User {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getLoggedInUsername() {
        if ($this->isLoggedIn()) {
            return $_COOKIE['user_login'];
        } else {
            return null;
        }
    }

    public function authenticate($username, $password) {
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return false;
        }
    }

    public function setLoginCookie($username) {
        // Imposta il cookie di login
        setcookie("user_login", $username, time() + (86400 * 30), "/"); // 30 giorni
    }

    public function isLoggedIn() {
        return isset($_COOKIE['user_login']);
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function getUserByEmail($email) {
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }

    public function registerUser($username, $email, $password) {

        $existingUser = $this->getUserByUsername($username);
        if ($existingUser) {
            return "Username già in uso. Scegli un altro username.";
        }

        $existingEmail = $this->getUserByEmail($email);
        if ($existingEmail) {
            return "Email già in uso. Scegli un'altra email.";
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (username, email, password) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$username, $email, $hashedPassword]);

        return true;
    }
}