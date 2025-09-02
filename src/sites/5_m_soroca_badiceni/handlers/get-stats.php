<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type');

// Data directory and file paths
$dataDir = __DIR__ . '/../data/';
$statsFile = $dataDir . 'stats.json';

// Initialize file if it doesn't exist with default values
if (!file_exists($statsFile)) {
    if (!is_dir($dataDir)) {
        mkdir($dataDir, 0755, true);
    }
    
    $defaultStats = [
        'stat1' => ['value' => 11078, 'label' => 'Copii beneficiari'],
        'stat2' => ['value' => 11050, 'label' => 'Familii asistate'],
        'stat3' => ['value' => 1956, 'label' => 'Cazuri rezolvate'],
        'stat4' => ['value' => 79, 'label' => 'Angajați profesioniști']
    ];
    
    file_put_contents($statsFile, json_encode($defaultStats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Load and return statistics
$stats = json_decode(file_get_contents($statsFile), true);

if ($stats === null) {
    http_response_code(500);
    echo json_encode(['error' => 'Eroare la încărcarea statisticilor']);
    exit;
}

echo json_encode([
    'success' => true,
    'data' => $stats
]);
?>
