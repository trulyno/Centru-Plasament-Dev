<?php
/**
 * Main entry point for the PHP site
 * This file handles routing for all pages
 */

// Include configuration and functions
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Get current page from URL
$page = getCurrentPage();

// Common variables for all pages
$pageTitle = getPageTitle($page);

// Use the AVAILABLE_PAGES constant from config.php
$validPages = AVAILABLE_PAGES;

// Check if the requested page exists
if (!isset($validPages[$page])) {
    // Page not found, show 404
    header("HTTP/1.0 404 Not Found");
    $page = '404';
    $pageTitle = getPageTitle($page);
}

// Include the header
include_once TEMPLATES_DIR . '/header.php';

// Include the page content
if (isset($validPages[$page])) {
    include_once TEMPLATES_DIR . '/pages/' . $validPages[$page];
} else {
    // Fallback to 404 if something went wrong
    include_once TEMPLATES_DIR . '/pages/404.php';
}

// Include the footer
include_once TEMPLATES_DIR . '/footer.php';
