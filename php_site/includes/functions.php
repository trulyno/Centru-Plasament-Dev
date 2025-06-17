<?php
/**
 * Helper functions for the site
 */

/**
 * Get the current page from the URL
 * 
 * @return string The current page or 'home' if none specified
 */
function getCurrentPage() {
    $page = isset($_GET['page']) ? $_GET['page'] : 'index';
    $page = trim(strtolower($page), '/');
    
    // Handle empty page
    if (empty($page)) {
        $page = 'index';
    }
    
    // Security: Remove any path traversal attempts
    $page = str_replace(['..', '//'], '', $page);
    
    return $page;
}

/**
 * Generate an active class if current page matches
 * 
 * @param string $page The page to check
 * @return string The 'active' class or empty string
 */
function isActive($page) {
    $currentPage = getCurrentPage();
    return ($currentPage === $page) ? 'active' : '';
}

/**
 * Clean and sanitize user input
 * 
 * @param string $input The input to sanitize
 * @return string Sanitized input
 */
function sanitizeInput($input) {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

/**
 * Format path for links
 * 
 * @param string $path The path/page name
 * @return string Formatted URL
 */
function formatUrl($path) {
    // If path has .html extension, remove it
    if (strpos($path, '.html') !== false) {
        $path = str_replace('.html', '', $path);
    }
    return $path;
}

/**
 * Get proper page title based on current page
 * 
 * @param string $page The current page
 * @return string Formatted page title
 */
function getPageTitle($page) {
    switch ($page) {
        case 'index':
            return SITE_NAME;
        case 'sectia-maternala':
            return 'Secția Maternală - ' . SITE_NAME;
        case 'sectia-rezidentiala':
            return 'Secția Rezidențială - ' . SITE_NAME;
        case 'sectia-de-zi':
            return 'Secția de Zi - ' . SITE_NAME;
        case 'sectia-reabilitare':
            return 'Secția de Reabilitare - ' . SITE_NAME;
        case 'sectia-respiro':
            return 'Secția Respiro - ' . SITE_NAME;
        case 'sectia-zi-4luni-3ani':
            return 'Secția Zi (4 luni - 3 ani) - ' . SITE_NAME;
        case 'administratia':
            return 'Administrația - ' . SITE_NAME;
        case 'organigrama':
            return 'Organigrama - ' . SITE_NAME;
        case 'functii-vacante':
            return 'Funcții Vacante - ' . SITE_NAME;
        case 'galerie':
            return 'Galerie - ' . SITE_NAME;
        case 'legislatie':
            return 'Legislație - ' . SITE_NAME;
        case 'intrebari-frecvente':
            return 'Întrebări Frecvente - ' . SITE_NAME;
        case 'petitii-reclamatii':
            return 'Petiții și Reclamații - ' . SITE_NAME;
        case '404':
            return 'Pagină Negăsită - ' . SITE_NAME;
        case '500':
            return 'Eroare Server - ' . SITE_NAME;
        default:
            return ucfirst(str_replace('-', ' ', $page)) . ' - ' . SITE_NAME;
    }
}
