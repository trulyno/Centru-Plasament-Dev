<?php
session_start();
require_once '../config/admin_config.php';
require_once 'includes/auth.php';
require_once 'includes/content_manager.php';

// Log the logout activity
if (isset($_SESSION['admin_username'])) {
    $contentManager = new ContentManager();
    $contentManager->logActivity("User logged out", 'fa-sign-out-alt');
}

logout();
?>
