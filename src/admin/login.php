<?php
session_start();

// Check if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

// Handle login
if ($_POST['username'] ?? false) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Simple admin credentials (in production, use hashed passwords)
    if ($username === 'admin' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Credențiale incorecte!';
    }
}
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panou Admin - Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="admin-style.css" rel="stylesheet">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <i class="fas fa-shield-alt"></i>
                <h1>Panou Administrativ</h1>
                <p>CPRCVF - Chișinău</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="error-message">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" class="login-form">
                <div class="form-group">
                    <label for="username">
                        <i class="fas fa-user"></i>
                        Utilizator
                    </label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">
                        <i class="fas fa-lock"></i>
                        Parolă
                    </label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Conectare
                </button>
            </form>
            
            <div class="login-footer">
                <p><i class="fas fa-info-circle"></i> Accesul este restricționat doar pentru administratori</p>
                <a href="../index.php" class="back-to-site">
                    <i class="fas fa-arrow-left"></i>
                    Înapoi la site
                </a>
            </div>
        </div>
    </div>
</body>
</html>
