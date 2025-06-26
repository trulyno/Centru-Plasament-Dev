<?php
header('Content-Type: application/json');

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Metodă nepermisă']);
    exit;
}

// Data directory and file paths
$dataDir = __DIR__ . '/../data/';
$petitionsFile = $dataDir . 'petitions.json';
$uploadsDir = $dataDir . 'uploads/';

// Create directories if they don't exist
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}
if (!is_dir($uploadsDir)) {
    mkdir($uploadsDir, 0755, true);
}

// Initialize file if it doesn't exist
if (!file_exists($petitionsFile)) {
    file_put_contents($petitionsFile, json_encode([], JSON_PRETTY_PRINT));
}

// Validate required fields
$requiredFields = ['entity_type', 'first_name', 'last_name', 'phone', 'email', 'address', 'subject', 'message'];
$missingFields = [];

foreach ($requiredFields as $field) {
    if (empty($_POST[$field])) {
        $missingFields[] = $field;
    }
}

if (!empty($missingFields)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Câmpurile următoare sunt obligatorii: ' . implode(', ', $missingFields)
    ]);
    exit;
}

// Validate email
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Adresa de email nu este validă'
    ]);
    exit;
}

// Validate entity type
if (!in_array($_POST['entity_type'], ['individual', 'legal'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Tipul de entitate nu este valid'
    ]);
    exit;
}

// Check consent checkboxes
if (empty($_POST['data_consent']) || empty($_POST['data_accuracy'])) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Trebuie să acordați consimțământul pentru procesarea datelor'
    ]);
    exit;
}

// Sanitize input data
$petitionData = [
    'entity_type' => $_POST['entity_type'],
    'first_name' => trim(strip_tags($_POST['first_name'])),
    'last_name' => trim(strip_tags($_POST['last_name'])),
    'phone' => trim(strip_tags($_POST['phone'])),
    'email' => trim(strip_tags($_POST['email'])),
    'address' => trim(strip_tags($_POST['address'])),
    'subject' => trim(strip_tags($_POST['subject'])),
    'message' => trim(strip_tags($_POST['message'])),
    'timestamp' => date('Y-m-d H:i:s'),
    'status' => 'new',
    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
    'consent_info' => [
        'data_consent' => true,
        'data_accuracy' => true
    ]
];

// Add entity-specific fields
if ($_POST['entity_type'] === 'legal') {
    $petitionData['idno'] = trim(strip_tags($_POST['idno'] ?? ''));
    $petitionData['organization_name'] = trim(strip_tags($_POST['company_name'] ?? ''));
} else {
    $petitionData['idnp'] = trim(strip_tags($_POST['idnp'] ?? ''));
}

// Handle file uploads
$uploadedFiles = [];

// Handle main petition file
if (isset($_FILES['petition_file']) && $_FILES['petition_file']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['petition_file'];
    
    // Validate file type
    if ($file['type'] !== 'application/pdf') {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Fișierul petiției trebuie să fie în format PDF'
        ]);
        exit;
    }
    
    // Validate file size (15MB max)
    if ($file['size'] > 15 * 1024 * 1024) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Fișierul petiției nu poate depăși 15 MB'
        ]);
        exit;
    }
    
    // Generate unique filename
    $petitionId = time() . '_' . uniqid();
    $filename = $petitionId . '_petition.pdf';
    $filepath = $uploadsDir . $filename;
    
    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        $uploadedFiles['petition_file'] = $filename;
    } else {
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'message' => 'Eroare la încărcarea fișierului petiției'
        ]);
        exit;
    }
}

// Handle additional files
if (isset($_FILES['additional_files']) && is_array($_FILES['additional_files']['name'])) {
    $additionalFiles = [];
    $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip'];
    
    for ($i = 0; $i < count($_FILES['additional_files']['name']); $i++) {
        if ($_FILES['additional_files']['error'][$i] === UPLOAD_ERR_OK) {
            $file = [
                'name' => $_FILES['additional_files']['name'][$i],
                'type' => $_FILES['additional_files']['type'][$i],
                'size' => $_FILES['additional_files']['size'][$i],
                'tmp_name' => $_FILES['additional_files']['tmp_name'][$i]
            ];
            
            // Validate file type
            if (!in_array($file['type'], $allowedTypes)) {
                continue; // Skip invalid files
            }
            
            // Validate file size (10MB max for additional files)
            if ($file['size'] > 10 * 1024 * 1024) {
                continue; // Skip large files
            }
            
            // Generate unique filename
            $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
            $filename = $petitionId . '_additional_' . $i . '.' . $extension;
            $filepath = $uploadsDir . $filename;
            
            if (move_uploaded_file($file['tmp_name'], $filepath)) {
                $additionalFiles[] = [
                    'original_name' => $file['name'],
                    'filename' => $filename,
                    'size' => $file['size']
                ];
            }
        }
    }
    
    if (!empty($additionalFiles)) {
        $uploadedFiles['additional_files'] = $additionalFiles;
    }
}

$petitionData['files'] = $uploadedFiles;

// Load existing petitions
$petitions = json_decode(file_get_contents($petitionsFile), true) ?: [];

// Generate unique ID if not already set
if (!isset($petitionId)) {
    $petitionId = time() . '_' . uniqid();
}

// Add new petition
$petitions[$petitionId] = $petitionData;

// Save to file
if (file_put_contents($petitionsFile, json_encode($petitions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    echo json_encode([
        'success' => true,
        'message' => 'Petiția dumneavoastră a fost trimisă cu succes! Veți primi o confirmare pe email în curând.'
    ]);
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'A apărut o eroare la trimiterea petiției. Vă rugăm să încercați din nou.'
    ]);
}
?>
