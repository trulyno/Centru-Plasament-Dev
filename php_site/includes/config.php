<?php
/**
 * Configuration file for the PHP site
 */

// Site settings
define('SITE_NAME', 'Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă');
define('SITE_URL', 'http://localhost'); // Change in production

// Directory settings
define('BASE_DIR', dirname(__DIR__));
define('TEMPLATES_DIR', BASE_DIR . '/templates');
define('INCLUDES_DIR', BASE_DIR . '/includes');
define('ASSETS_DIR', BASE_DIR . '/assets');
define('PUBLIC_DIR', BASE_DIR . '/public');

// Available pages mapping
define('AVAILABLE_PAGES', [
    'index' => 'home.php',
    'sectia-maternala' => 'sectia-maternala.php',
    'sectia-rezidentiala' => 'sectia-rezidentiala.php',
    'sectia-de-zi' => 'sectia-de-zi.php',
    'sectia-reabilitare' => 'sectia-reabilitare.php',
    'sectia-respiro' => 'sectia-respiro.php',
    'sectia-zi-4luni-3ani' => 'sectia-zi-4luni-3ani.php',
    'administratia' => 'administratia.php',
    'organigrama' => 'organigrama.php',
    'functii-vacante' => 'functii-vacante.php',
    'galerie' => 'galerie.php',
    'legislatie' => 'legislatie.php',
    'acte-nationale' => 'acte-nationale.php',
    'acte-internationale' => 'acte-internationale.php',
    'acte-interne' => 'acte-interne.php',
    'ghiduri' => 'ghiduri.php',
    'metodologii' => 'metodologii.php',
    'codul-deontologic' => 'codul-deontologic.php',
    'achizitii' => 'achizitii.php',
    'planuri-achizitii' => 'planuri-achizitii.php',
    'invitatii-participare' => 'invitatii-participare.php',
    'rapoarte-achizitii' => 'rapoarte-achizitii.php',
    'rapoarte' => 'rapoarte.php',
    'registru-cadouri' => 'registru-cadouri.php',
    'proiecte' => 'proiecte.php',
    'intrebari-frecvente' => 'intrebari-frecvente.php',
    'petitii-reclamatii' => 'petitii-reclamatii.php',
    '404' => '404.php',
    '500' => '500.php',
]);

// Contact information
define('CONTACT_PHONE', '022 737 027');
define('CONTACT_EMAIL', 'cprcvfc@example.md');
define('CONTACT_ADDRESS', 'Mun. Chișinău, str. Cuza Vodă 29/2');

// Error reporting - turn off for production
ini_set('display_errors', 1);
error_reporting(E_ALL);
