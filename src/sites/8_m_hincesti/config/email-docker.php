<?php
/**
 * Docker Email Configuration File
 * 
 * This configuration is optimized for Docker development environment with MailHog
 */

// Email Configuration for Docker Environment
return [
    // SMTP Settings - Using MailHog for email testing
    'smtp' => [
        'enabled' => false, // Keep false to use system mail() which routes to MailHog
        'host' => 'mailhog',
        'port' => 1025,
        'username' => '', // MailHog doesn't require authentication
        'password' => '',
        'encryption' => '', // No encryption for MailHog
    ],
    
    // Email Addresses
    'addresses' => [
        'from_email' => 'noreply@cprcvf.local', // Use .local for development
        'from_name' => 'Centrul de Plasament și Reabilitare (Docker)', 
        'admin_email' => 'admin@cprcvf.local', // Admin email (receives notifications)
        'reply_to' => 'contact@cprcvf.local', // Reply-to address
    ],
    
    // Email Settings
    'settings' => [
        'charset' => 'utf-8',
        'content_type' => 'text/html',
        'enable_debug' => true, // Enable debug for development
    ]
];
?>
