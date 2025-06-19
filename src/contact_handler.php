<?php
// Contact form handler
session_start();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

// Validate required fields
$required_fields = ['name', 'email', 'subject', 'message'];
foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        echo json_encode(['success' => false, 'message' => 'Toate câmpurile obligatorii trebuie completate.']);
        exit;
    }
}

// Sanitize input
$name = htmlspecialchars(trim($_POST['name']));
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
$subject = htmlspecialchars(trim($_POST['subject']));
$message = htmlspecialchars(trim($_POST['message']));

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Adresa de email nu este validă.']);
    exit;
}

// Validate message length
if (strlen($message) < 10) {
    echo json_encode(['success' => false, 'message' => 'Mesajul trebuie să conțină cel puțin 10 caractere.']);
    exit;
}

// Create contact messages directory if it doesn't exist
$messages_dir = __DIR__ . '/messages';
if (!is_dir($messages_dir)) {
    mkdir($messages_dir, 0755, true);
}

// Create message data
$message_data = [
    'id' => uniqid(),
    'name' => $name,
    'email' => $email,
    'phone' => $phone,
    'subject' => $subject,
    'message' => $message,
    'date' => date('Y-m-d H:i:s'),
    'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
    'status' => 'new',
    'read' => false
];

// Save message to file
$message_file = $messages_dir . '/' . $message_data['id'] . '.json';
if (file_put_contents($message_file, json_encode($message_data, JSON_PRETTY_PRINT))) {
    // Log the contact form submission
    $log_entry = date('Y-m-d H:i:s') . " - Contact form submission: {$name} ({$email}) - {$subject}\n";
    file_put_contents(__DIR__ . '/logs/contact_form.log', $log_entry, FILE_APPEND | LOCK_EX);
    
    echo json_encode([
        'success' => true, 
        'message' => 'Mesajul a fost trimis cu succes! Vă vom contacta în curând.'
    ]);
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'A apărut o eroare la trimiterea mesajului. Vă rugăm să încercați din nou.'
    ]);
}
?>
