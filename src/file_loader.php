<?php

// Define the keywords we're looking for
$keywords = ['SERVICES', 'SERVICES_NAMES', 'SERVICES_NAMES_SHORT'];

// Initialize global arrays
$GLOBALS['SERVICES'] = array();
$GLOBALS['SERVICES_NAMES'] = array();
$GLOBALS['SERVICES_NAMES_SHORT'] = array();

function readConfigFile($filename) {
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
            if (in_array($keyword, $GLOBALS['keywords'] ?? ['SERVICES', 'SERVICES_NAMES', 'SERVICES_NAMES_SHORT'])) {
                // Split the comma-separated values
                $valueArray = explode(',', $values);
                
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
