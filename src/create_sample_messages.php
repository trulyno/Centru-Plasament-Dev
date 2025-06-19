<?php
// Create sample contact messages for testing
$messages_dir = __DIR__ . '/messages';

// Sample messages
$sample_messages = [
    [
        'id' => uniqid(),
        'name' => 'Maria Popescu',
        'email' => 'maria.popescu@example.com',
        'phone' => '022654321',
        'subject' => 'plasament urgență',
        'message' => 'Bună ziua, am nevoie urgentă de ajutor pentru un copil de 3 ani care se află în situație de risc. Vă rog să mă contactați cât mai repede posibil.',
        'date' => date('Y-m-d H:i:s', strtotime('-2 hours')),
        'ip' => '192.168.1.100',
        'status' => 'new',
        'read' => false
    ],
    [
        'id' => uniqid(),
        'name' => 'Ion Vasile',
        'email' => 'ion.vasile@gmail.com',
        'phone' => '',
        'subject' => 'adopție',
        'message' => 'Soția și cu mine dorim să adoptăm un copil. Am toate documentele necesare și am trecut prin toate procedurile. Vă rugăm să ne informați despre disponibilitate.',
        'date' => date('Y-m-d H:i:s', strtotime('-5 hours')),
        'ip' => '192.168.1.101',
        'status' => 'new',
        'read' => false
    ],
    [
        'id' => uniqid(),
        'name' => 'Ana Creangă',
        'email' => 'ana.creanga@yahoo.com',
        'phone' => '069123456',
        'subject' => 'voluntariat',
        'message' => 'Doresc să fiu voluntar la centrul dumneavoastră. Am experiență în lucrul cu copiii și timp disponibil în weekend-uri. Cum pot să mă înscriu?',
        'date' => date('Y-m-d H:i:s', strtotime('-1 day')),
        'ip' => '192.168.1.102',
        'status' => 'read',
        'read' => true
    ],
    [
        'id' => uniqid(),
        'name' => 'Mihai Tănase',
        'email' => 'mihai.tanase@company.md',
        'phone' => '022999888',
        'subject' => 'donații',
        'message' => 'Compania noastră dorește să facă o donație pentru copiii de la centrul dumneavoastră. Avem jucării, haine și cărți pentru copii. Cum putem proceda?',
        'date' => date('Y-m-d H:i:s', strtotime('-2 days')),
        'ip' => '192.168.1.103',
        'status' => 'new',
        'read' => false
    ]
];

// Create messages
foreach ($sample_messages as $message) {
    $filename = $messages_dir . '/' . $message['id'] . '.json';
    file_put_contents($filename, json_encode($message, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    echo "Created message: {$message['name']} - {$message['subject']}\n";
}

echo "\nSample messages created successfully!\n";
echo "You can now test the admin panel at: http://localhost/admin/messages.php\n";
?>
