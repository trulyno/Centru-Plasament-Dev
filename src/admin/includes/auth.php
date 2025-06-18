<?php
// Authentication functions

function checkAuth() {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        header('Location: index.php');
        exit();
    }
    
    // Check session timeout
    if (isset($_SESSION['login_time'])) {
        if (time() - $_SESSION['login_time'] > SESSION_TIMEOUT) {
            session_destroy();
            header('Location: index.php?timeout=1');
            exit();
        }
    }
    
    // Update last activity time
    $_SESSION['last_activity'] = time();
}

function logout() {
    session_destroy();
    header('Location: index.php');
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function getSessionInfo() {
    if (!isLoggedIn()) {
        return null;
    }
    
    return [
        'username' => $_SESSION['admin_username'] ?? '',
        'login_time' => $_SESSION['login_time'] ?? 0,
        'last_activity' => $_SESSION['last_activity'] ?? 0,
        'time_remaining' => SESSION_TIMEOUT - (time() - ($_SESSION['last_activity'] ?? 0))
    ];
}
?>
