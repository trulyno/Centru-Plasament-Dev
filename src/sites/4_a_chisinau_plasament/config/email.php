<?php
/**
 * Email Configuration File
 * 
 * IMPORTANT: Update the email settings below with your actual email configuration
 * before deploying to production.
 */

// Email Configuration
return [
    // SMTP Settings (recommended for production)
    'smtp' => [
        'enabled' => false, // Set to true to use SMTP instead of basic mail()
        'host' => 'smtp.gmail.com', // Your SMTP server
        'port' => 587, // SMTP port (587 for TLS, 465 for SSL)
        'username' => 'your-email@domain.com', // Your email address
        'password' => 'your-app-password', // Your email password or app password
        'encryption' => 'tls', // 'tls' or 'ssl'
    ],
    
    // Email Addresses
    'addresses' => [
        'from_email' => 'noreply@centrulplasament.md', // Sender email address
        'from_name' => 'Centrul de Plasament și Reabilitare pentru Copii de Vârstă Fragedă din municipiul Chișinău', // Sender name
        'admin_email' => 'centru_plasament@AGSSSI.md', // Admin email (receives notifications)
        'reply_to' => 'centru_plasament@AGSSSI.md', // Reply-to address
    ],
    
    // Email Settings
    'settings' => [
        'charset' => 'utf-8',
        'content_type' => 'text/html',
        'enable_debug' => false, // Set to true for debugging email issues
    ]
];
?>
