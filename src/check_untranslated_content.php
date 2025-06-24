<?php
/**
 * Script to check for untranslated hardcoded content in sectia pages
 */

$sectiaFiles = [
    'sectia-criza-reintegrare-familiala.php',
    'sectia-maternala.php', 
    'sectia-de-zi.php',
    'sectia-zi-4luni-3ani.php',
    'sectia-respiro.php',
    'sectia-asistenta-psihopedagogica.php',
    'sectia-reabilitare.php',
    'sectia-asistenta-medicala.php'
];

$hardcodedPatterns = [
    // Common hardcoded Romanian phrases that should be translated
    '/>[^<]*\b(Despre|Servicii|Galerie|Contactează|Pentru|Copii|Activități|Terapie|Medical|Asistență|Consiliere|Dezvoltare|Instruire)\b[^<]*</i',
    // Hardcoded Romanian text in alt attributes
    '/alt="[^"]*[ăâîșțĂÂÎȘȚ][^"]*"/i',
    // Hardcoded Romanian text in title attributes  
    '/title="[^"]*[ăâîșțĂÂÎȘȚ][^"]*"/i',
    // Direct Romanian text between tags
    '/>[^<]*[ăâîșțĂÂÎȘȚ][^<]*</i'
];

echo "🔍 Checking sectia pages for untranslated content...\n\n";

foreach ($sectiaFiles as $file) {
    $filePath = __DIR__ . '/' . $file;
    if (!file_exists($filePath)) {
        echo "❌ File not found: $file\n";
        continue;
    }
    
    $content = file_get_contents($filePath);
    $foundIssues = [];
    
    foreach ($hardcodedPatterns as $pattern) {
        preg_match_all($pattern, $content, $matches);
        if (!empty($matches[0])) {
            $foundIssues = array_merge($foundIssues, $matches[0]);
        }
    }
    
    if (!empty($foundIssues)) {
        echo "⚠️  $file has " . count($foundIssues) . " potential untranslated content:\n";
        foreach (array_unique($foundIssues) as $issue) {
            echo "   - " . trim($issue) . "\n";
        }
        echo "\n";
    } else {
        echo "✅ $file appears to be fully translated\n";
    }
}

echo "\n🎯 Check completed!\n";
?>
