<?php
session_start();

// Security headers
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// Check if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: dashboard.php');
    exit;
}

// User data file
$dataDir = __DIR__ . '/../data/';
$usersFile = $dataDir . 'users.json';
$loginAttemptsFile = $dataDir . 'login_attempts.json';

// Create data directory and files if they don't exist
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

if (!file_exists($usersFile)) {
    // Create default admin user with hashed password for "admin123"
    $defaultUsers = [
        'admin' => [
            'username' => 'adminCPRCVF',
            'password_hash' => password_hash('cprcvf2025!', PASSWORD_DEFAULT),
            'created_at' => date('c'),
            'last_login' => null,
            'status' => 'active'
        ]
    ];
    file_put_contents($usersFile, json_encode($defaultUsers, JSON_PRETTY_PRINT));
}

if (!file_exists($loginAttemptsFile)) {
    file_put_contents($loginAttemptsFile, json_encode([], JSON_PRETTY_PRINT));
}

// Load users and login attempts
$users = json_decode(file_get_contents($usersFile), true) ?: [];
$loginAttempts = json_decode(file_get_contents($loginAttemptsFile), true) ?: [];

// Function to check rate limiting
function isRateLimited($ip, $attempts, $maxAttempts = 5, $timeWindow = 900) { // 15 minutes
    $currentTime = time();
    $recentAttempts = array_filter($attempts, function($attempt) use ($ip, $currentTime, $timeWindow) {
        return $attempt['ip'] === $ip && ($currentTime - $attempt['timestamp']) < $timeWindow;
    });
    return count($recentAttempts) >= $maxAttempts;
}

// Function to log login attempt
function logLoginAttempt($ip, $username, $success, &$attempts, $file, $attemptedPassword = null, $userHash = null) {
    $logEntry = [
        'ip' => $ip,
        'username' => $username,
        'timestamp' => time(),
        'success' => $success,
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
        'attempted_password' => $attemptedPassword,
        'password_hash' => $userHash ?: ''
    ];
    
    // Only log password details for failed attempts (for debugging)
    if (!$success && $attemptedPassword !== null) {
        $logEntry['attempted_password'] = $attemptedPassword;
        $logEntry['password_hash'] = $userHash ?: '';
    }
    
    $attempts[] = $logEntry;
    
    // Keep only last 100 attempts to prevent file from growing too large
    if (count($attempts) > 100) {
        $attempts = array_slice($attempts, -100);
    }
    
    file_put_contents($file, json_encode($attempts, JSON_PRETTY_PRINT));
}

// Generate CSRF token
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Handle login
if ($_POST['username'] ?? false) {
    // Verify CSRF token
    if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        $error = 'Token de securitate invalid. Încercați din nou.';
    } else {
        $username = trim($_POST['username']);
        $password = $_POST['password'];
        $userIP = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
    
        // Check rate limiting
        if (isRateLimited($userIP, $loginAttempts)) {
            $error = 'Prea multe încercări de autentificare. Încercați din nou în 15 minute.';
        } else {
            // Find user by username field
            $foundUser = null;
            $userKey = null;
            foreach ($users as $key => $user) {
                if ($user['username'] === $username && $user['status'] === 'active') {
                    $foundUser = $user;
                    $userKey = $key;
                    break;
                }
            }
            
            if ($foundUser) {
                $storedHash = $foundUser['password_hash'];
                if (password_verify($password, $storedHash)) {
                    // Successful login
                    logLoginAttempt($userIP, $username, true, $loginAttempts, $loginAttemptsFile);
                    
                    // Update last login time
                    $users[$userKey]['last_login'] = date('c');
                    file_put_contents($usersFile, json_encode($users, JSON_PRETTY_PRINT));
                    
                    // Set session variables
                    $_SESSION['admin_logged_in'] = true;
                    $_SESSION['admin_username'] = $username;
                    $_SESSION['admin_user_data'] = $foundUser;
                    
                    header('Location: dashboard.php');
                    exit;
                } else {
                    // Invalid password
                    logLoginAttempt($userIP, $username, false, $loginAttempts, $loginAttemptsFile, $password, $storedHash);
                    $error = 'Credențiale incorecte!';
                }
            } else {
                // Invalid username or inactive user
                logLoginAttempt($userIP, $username, false, $loginAttempts, $loginAttemptsFile, $password);
                $error = 'Credențiale incorecte!';
            }
        }
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
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
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
