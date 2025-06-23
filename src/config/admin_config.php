<?php
// Admin Configuration
define('ADMIN_USERNAME', 'admin');
define('ADMIN_PASSWORD', 'cprcvf2025!');

// Session timeout (in seconds) - 2 hours
define('SESSION_TIMEOUT', 7200);

// Site configuration
define('SITE_NAME', 'Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă');
define('SITE_SHORT_NAME', 'CPRCVF');

// File paths
define('CONFIG_FILE', '../info/ro_md.txt');
define('BACKUP_DIR', '../backups/');

// Ensure backup directory exists
if (!file_exists(BACKUP_DIR)) {
    mkdir(BACKUP_DIR, 0755, true);
}

// Available pages for management
$ADMIN_PAGES = [
    'index' => [
        'name' => 'Pagina Principală',
        'file' => 'index.php',
        'icon' => 'fa-home',
        'sections' => ['hero', 'about', 'services', 'stats', 'testimonials']
    ],
    'administratia' => [
        'name' => 'Administrația',
        'file' => 'administratia.html',
        'icon' => 'fa-users-cog',
        'sections' => ['leadership', 'management', 'contact']
    ],
    'organigrama' => [
        'name' => 'Organigrama',
        'file' => 'organigrama.html',
        'icon' => 'fa-sitemap',
        'sections' => ['structure', 'departments']
    ],
    'subdiviziune' => [
        'name' => 'Subdiviziune',
        'file' => 'subdiviziune.html',
        'icon' => 'fa-building',
        'sections' => ['departments', 'staff']
    ],
    'functii-vacante' => [
        'name' => 'Funcții Vacante',
        'file' => 'functii-vacante.html',
        'icon' => 'fa-briefcase',
        'sections' => ['positions', 'requirements']
    ],
    'services' => [
        'name' => 'Servicii',
        'file' => 'services_group',
        'icon' => 'fa-hands-helping',
        'sections' => ['reabilitare', 'zi', 'zi-4luni-3ani', 'maternala', 'respiro', 'criza-reintegrare']
    ],
    'transparenta' => [
        'name' => 'Transparența',
        'file' => 'transparency_group',
        'icon' => 'fa-eye',
        'sections' => ['achizitii', 'rapoarte', 'legislatie', 'petitii']
    ],
    'galerie' => [
        'name' => 'Galerie',
        'file' => 'galerie.php',
        'icon' => 'fa-images',
        'sections' => ['photos', 'videos', 'events']
    ]
];
?>
