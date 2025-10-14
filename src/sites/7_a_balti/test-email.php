<?php
/**
 * Email Test Script
 * 
 * This script can be used to test the email functionality.
 * Run this script to verify that emails are being sent correctly.
 */

require_once __DIR__ . '/includes/email.php';

// Test contact form email
echo "<h2>Testing Contact Form Email</h2>\n";

$testContactData = [
    'name' => 'Test User',
    'email' => 'test@example.com',
    'phone' => '022123456',
    'subject' => 'Test Contact Form',
    'message' => 'Acesta este un mesaj de test pentru formularul de contact.',
    'timestamp' => date('Y-m-d H:i:s'),
    'ip_address' => '127.0.0.1'
];

$contactResult = EmailManager::sendContactFormNotification($testContactData);
echo $contactResult ? "✅ Contact form email sent successfully\n" : "❌ Contact form email failed\n";

echo "<br><hr><br>\n";

// Test petition form email
echo "<h2>Testing Petition Form Email</h2>\n";

$testPetitionData = [
    'entity_type' => 'individual',
    'first_name' => 'Ion',
    'last_name' => 'Popescu',
    'email' => 'test@example.com',
    'phone' => '022123456',
    'address' => 'Str. Test 123, Chișinău',
    'subject' => 'Test Petition',
    'message' => 'Aceasta este o petiție de test.',
    'timestamp' => date('Y-m-d H:i:s'),
    'ip_address' => '127.0.0.1',
    'idnp' => '1234567890123',
    'files' => []
];

$petitionResult = EmailManager::sendPetitionFormNotification($testPetitionData);
echo $petitionResult ? "✅ Petition form email sent successfully\n" : "❌ Petition form email failed\n";

echo "<br><br>\n";
echo "<p><strong>Note:</strong> If emails failed to send, check your email configuration in <code>config/email.php</code> and ensure your server supports the <code>mail()</code> function.</p>\n";
?>
