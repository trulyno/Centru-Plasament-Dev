<?php
// Set error reporting to log errors instead of displaying them
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

header('Content-Type: application/json');

// Include GDPR manager and email functionality
require_once __DIR__ . '/../includes/gdpr.php';
require_once __DIR__ . '/../includes/email.php';

// Check if request is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Metodă nepermisă']);
    exit;
}

// Data directory and file paths
$dataDir = __DIR__ . '/../data/';
$contactFile = $dataDir . 'contacts.json';

// Create data directory if it doesn't exist
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Initialize file if it doesn't exist
if (!file_exists($contactFile)) {
    file_put_contents($contactFile, json_encode([], JSON_PRETTY_PRINT));
}

// Validate required fields
$requiredFields = ['name', 'email', 'subject', 'message'];
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

// Sanitize input data
$contactData = [
    'name' => trim(strip_tags($_POST['name'])),
    'email' => trim(strip_tags($_POST['email'])),
    'phone' => trim(strip_tags($_POST['phone'] ?? '')),
    'subject' => trim(strip_tags($_POST['subject'])),
    'message' => trim(strip_tags($_POST['message'])),
    'timestamp' => date('Y-m-d H:i:s'),
    'status' => 'new',
    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
];

// Load existing contacts
$contacts = json_decode(file_get_contents($contactFile), true) ?: [];

// Generate unique ID
$contactId = time() . '_' . uniqid();

// Add new contact
$contacts[$contactId] = $contactData;

// Save to file
if (file_put_contents($contactFile, json_encode($contacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    
    // Log data processing for GDPR compliance
    GDPRManager::logDataProcessing('contact_form', [
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'email' => $contactData['email'],
        'personal_data' => 'name, email'
    ], 'Processing contact form inquiry', 'Legitimate interest');
    
    // Send email notifications
    $emailSent = EmailManager::sendContactFormNotification($contactData);
    
    if ($emailSent) {
        echo json_encode([
            'success' => true,
            'message' => 'Mesajul dumneavoastră a fost trimis cu succes! Veți primi o confirmare pe email și vă vom contacta în cel mai scurt timp.'
        ]);
    } else {
        echo json_encode([
            'success' => true,
            'message' => 'Mesajul dumneavoastră a fost trimis cu succes! Vă vom contacta în cel mai scurt timp. (Notă: Confirmarea pe email poate întârzia din motive tehnice.)'
        ]);
    }
} else {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'A apărut o eroare la trimiterea mesajului. Vă rugăm să încercați din nou.'
    ]);
}
?>
