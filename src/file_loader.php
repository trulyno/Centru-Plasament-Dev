<?php

// Define the keywords we're looking for
$keywords = [
    'SERVICES', 'SERVICES_NAMES', 'SERVICES_NAMES_SHORT', 'SERVICES_IMAGES', 'SERVICES_DESCRIPTION',
    'HERO_TITLES', 'HERO_DESCRIPTIONS', 'HERO_BUTTONS', 'HERO_LINKS', 'HERO_IMAGES',
    'ABOUT_TITLE', 'ABOUT_TEXT_1', 'ABOUT_TEXT_2', 'ABOUT_TEXT_3',
    'STATS_VALUES', 'STATS_LABELS',
    'GALLERY_TITLES', 'GALLERY_DESCRIPTIONS', 'GALLERY_IMAGES',
    'TESTIMONIALS_QUOTES', 'TESTIMONIALS_AUTHORS', 'TESTIMONIALS_ROLES',
    'FULL_GALLERY_TITLES', 'FULL_GALLERY_DESCRIPTIONS', 'FULL_GALLERY_IMAGES', 'FULL_GALLERY_CATEGORIES'
];

// Initialize global arrays
$GLOBALS['SERVICES'] = array();
$GLOBALS['SERVICES_NAMES'] = array();
$GLOBALS['SERVICES_NAMES_SHORT'] = array();
$GLOBALS['SERVICES_IMAGES'] = array();
$GLOBALS['SERVICES_DESCRIPTION'] = array();

// Homepage data
$GLOBALS['HERO_TITLES'] = array();
$GLOBALS['HERO_DESCRIPTIONS'] = array();
$GLOBALS['HERO_BUTTONS'] = array();
$GLOBALS['HERO_LINKS'] = array();
$GLOBALS['HERO_IMAGES'] = array();

$GLOBALS['ABOUT_TITLE'] = array();
$GLOBALS['ABOUT_TEXT_1'] = array();
$GLOBALS['ABOUT_TEXT_2'] = array();
$GLOBALS['ABOUT_TEXT_3'] = array();

$GLOBALS['STATS_VALUES'] = array();
$GLOBALS['STATS_LABELS'] = array();

$GLOBALS['GALLERY_TITLES'] = array();
$GLOBALS['GALLERY_DESCRIPTIONS'] = array();
$GLOBALS['GALLERY_IMAGES'] = array();

$GLOBALS['TESTIMONIALS_QUOTES'] = array();
$GLOBALS['TESTIMONIALS_AUTHORS'] = array();
$GLOBALS['TESTIMONIALS_ROLES'] = array();

$GLOBALS['FULL_GALLERY_TITLES'] = array();
$GLOBALS['FULL_GALLERY_DESCRIPTIONS'] = array();
$GLOBALS['FULL_GALLERY_IMAGES'] = array();
$GLOBALS['FULL_GALLERY_CATEGORIES'] = array();

function readConfigFile($filename) {
    global $keywords;

    // Check if file exists
    if (!file_exists($filename)) {
        die("Error: File '$filename' not found.\n");
    }
    
    // Open the file for reading
    $file = fopen($filename, 'r');
    
    if (!$file) {
        die("Error: Unable to open file '$filename'.\n");
    }
    
    // Read the file line by line
    while (($line = fgets($file)) !== false) {
        // Remove whitespace and newline characters
        $line = trim($line);
        
        // Skip empty lines
        if (empty($line)) {
            continue;
        }
        
        // Check if line contains an equals sign
        if (strpos($line, '=') !== false) {
            // Split the line into keyword and values
            list($keyword, $values) = explode('=', $line, 2);
            
            // Remove any whitespace from keyword
            $keyword = trim($keyword);
            
            // Check if this is one of our target keywords
            if (in_array($keyword, $keywords)) {
                // Split the comma-separated values
                $valueArray = explode('|', $values);
                
                // Trim whitespace from each value
                $valueArray = array_map('trim', $valueArray);
                
                // Remove empty values
                $valueArray = array_filter($valueArray, function($value) {
                    return !empty($value);
                });
                
                // Store in global array
                $GLOBALS[$keyword] = array_values($valueArray);
                
            }
        }
    }
    
    // Close the file
    fclose($file);
}

// Usage example
$configFile = 'info/ro_md.txt'; // Replace with your file path
readConfigFile($configFile);

?>
