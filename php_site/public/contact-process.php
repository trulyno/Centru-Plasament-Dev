<?php
/**
 * Contact form processing script
 */

// Include configuration
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../includes/functions.php';

// Initialize response
$response = [
    'success' => false,
    'message' => 'A apărut o eroare în procesarea formularului.'
];

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data and sanitize
    $name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
    $email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
    $subject = isset($_POST['subject']) ? sanitizeInput($_POST['subject']) : '';
    $message = isset($_POST['message']) ? sanitizeInput($_POST['message']) : '';
    $consent = isset($_POST['consent']) ? true : false;
    
    // Validate required fields
    $errors = [];
    
    if (empty($name)) {
        $errors[] = 'Numele este obligatoriu.';
    }
    
    if (empty($email)) {
        $errors[] = 'Email-ul este obligatoriu.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email-ul nu este valid.';
    }
    
    if (empty($subject)) {
        $errors[] = 'Subiectul este obligatoriu.';
    }
    
    if (empty($message)) {
        $errors[] = 'Mesajul este obligatoriu.';
    }
    
    if (!$consent) {
        $errors[] = 'Trebuie să fiți de acord cu politica de confidențialitate.';
    }
    
    // If no errors, process the form
    if (empty($errors)) {
        // Set email recipients and headers
        $to = CONTACT_EMAIL;
        $headers = "From: $name <$email>" . "\r\n";
        $headers .= "Reply-To: $email" . "\r\n";
        $headers .= "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
        
        // Build email content
        $emailContent = "
            <html>
            <head>
                <title>Contact nou de la website</title>
            </head>
            <body>
                <h2>Mesaj nou de la website</h2>
                <p><strong>Nume:</strong> $name</p>
                <p><strong>Email:</strong> $email</p>
                <p><strong>Telefon:</strong> $phone</p>
                <p><strong>Subiect:</strong> $subject</p>
                <p><strong>Mesaj:</strong><br>$message</p>
                <p>Acest mesaj a fost trimis de la formularul de contact de pe site.</p>
            </body>
            </html>
        ";
        
        // For development purposes, let's simulate a successful email
        // In production, uncomment the mail() function
        // $mailSent = mail($to, "Contact Website: $subject", $emailContent, $headers);
        $mailSent = true; // Simulate success
        
        if ($mailSent) {
            $response = [
                'success' => true,
                'message' => 'Mulțumim! Mesajul dvs. a fost trimis. Vă vom contacta în curând.'
            ];
        }
    } else {
        // Return validation errors
        $response['message'] = 'Vă rugăm să corectați următoarele erori:';
        $response['errors'] = $errors;
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
