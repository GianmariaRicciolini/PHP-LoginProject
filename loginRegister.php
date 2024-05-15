<?php
include_once __DIR__ . '/classes/User.php';

include __DIR__ . '/includes/head.php';
?>
    <div class="container">
        <h1 class="mt-5">Login</h1>
        <?php if (isset($loginError)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $loginError; ?>
            </div>
        <?php endif; ?>
        <form action="" method="post" class="mt-4">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-primary">Login</button>
        </form>

        <h1 class="mt-5">Registrati</h1>
        <?php if (isset($registrationMessage)) : ?>
            <div class="alert alert-success" role="alert">
                <?php echo $registrationMessage; ?>
            </div>
        <?php endif; ?>
        <?php if (isset($registrationError)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $registrationError; ?>
            </div>
        <?php endif; ?>
        <form action="" method="post" class="mt-4">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" name="username" id="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" name="register" class="btn btn-primary">Registrati</button>
        </form>
    </div>
</body>
</html>
