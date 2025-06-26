<?php
// Test script to populate sample data for the admin dashboard

// Data directory paths
$dataDir = __DIR__ . '/../data/';
$contactFile = $dataDir . 'contacts.json';
$petitionsFile = $dataDir . 'petitions.json';
$statsFile = $dataDir . 'stats.json';

// Create data directory if it doesn't exist
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Sample contact messages
$sampleContacts = [
    'contact_1' => [
        'name' => 'Maria Popescu',
        'email' => 'maria.popescu@email.md',
        'phone' => '069123456',
        'subject' => 'informații generale',
        'message' => 'Bună ziua, aș dori să aflu mai multe informații despre serviciile de plasament pentru copii. Vă rog să mă contactați. Mulțumesc!',
        'timestamp' => date('Y-m-d H:i:s', strtotime('-2 hours')),
        'status' => 'new',
        'ip_address' => '192.168.1.100'
    ],
    'contact_2' => [
        'name' => 'Ion Mihai',
        'email' => 'ion.mihai@gmail.com',
        'phone' => '068987654',
        'subject' => 'voluntariat',
        'message' => 'Salut! Sunt interesat să devin voluntar la centrul dumneavoastră. Am experiență în lucrul cu copiii și aș vrea să contribui la activitățile organizației.',
        'timestamp' => date('Y-m-d H:i:s', strtotime('-1 day')),
        'status' => 'read',
        'ip_address' => '192.168.1.101'
    ],
    'contact_3' => [
        'name' => 'Ana Gheorghe',
        'email' => 'ana.gheorghe@yahoo.com',
        'phone' => '',
        'subject' => 'adopție',
        'message' => 'Bună seara, soțul și cu mine dorim să adoptăm un copil. Puteți să ne oferiți informații despre procedurile necesare și documentele pe care trebuie să le pregătim?',
        'timestamp' => date('Y-m-d H:i:s', strtotime('-3 days')),
        'status' => 'new',
        'ip_address' => '192.168.1.102'
    ]
];

// Sample petitions
$samplePetitions = [
    'petition_1' => [
        'entity_type' => 'individual',
        'first_name' => 'Vasile',
        'last_name' => 'Ciobanu',
        'phone' => '069111222',
        'email' => 'vasile.ciobanu@email.md',
        'address' => 'mun. Chișinău, sect. Centru, str. Stefan cel Mare 123, ap. 45',
        'subject' => 'Solicitare informații despre serviciile de reabilitare',
        'message' => 'Stimați domni,

Prin prezenta doresc să solicit informații detaliate despre serviciile de reabilitare oferite de centrul dumneavoastră pentru copiii cu nevoi speciale.

Fiul meu, în vârstă de 6 ani, are nevoie de servicii specializate de kinetoterapie și logopedia. Aș dori să știu:
1. Care sunt condițiile de admitere
2. Ce documente sunt necesare
3. Dacă există liste de așteptare
4. Care este costul serviciilor

Vă rog să mă contactați la numărul de telefon sau email-ul indicate mai sus.

Cu respect,
Vasile Ciobanu',
        'idnp' => '2001234567890',
        'timestamp' => date('Y-m-d H:i:s', strtotime('-1 hour')),
        'status' => 'new',
        'ip_address' => '192.168.1.103',
        'consent_info' => [
            'data_consent' => true,
            'data_accuracy' => true
        ],
        'files' => []
    ],
    'petition_2' => [
        'entity_type' => 'legal',
        'first_name' => 'Elena',
        'last_name' => 'Rusu',
        'phone' => '022345678',
        'email' => 'contact@ongcopii.md',
        'address' => 'mun. Chișinău, sect. Botanica, str. Dacia 67, bir. 12',
        'subject' => 'Propunere de parteneriat pentru proiecte comune',
        'message' => 'Stimate colegi,

Organizația noastră "Pentru Copiii Moldovei" dorește să inițieze un parteneriat cu centrul dumneavoastră pentru implementarea unor proiecte comune în domeniul protecției copilului.

Propunem următoarele direcții de colaborare:
- Organizarea de evenimente comune pentru copii
- Schimb de experiență între specialiști
- Implementarea de proiecte finanțate din surse externe
- Organizarea de cursuri de formare pentru părinți

Suntem deschisi la discuții și propuneri din partea dumneavoastră.

Așteptăm cu interes răspunsul dumneavoastră.

Cu stimă,
Elena Rusu
Director executiv',
        'idno' => '1007600123456',
        'organization_name' => 'Organizația "Pentru Copiii Moldovei"',
        'timestamp' => date('Y-m-d H:i:s', strtotime('-2 days')),
        'status' => 'read',
        'ip_address' => '192.168.1.104',
        'consent_info' => [
            'data_consent' => true,
            'data_accuracy' => true
        ],
        'files' => []
    ]
];

// Sample statistics
$sampleStats = [
    'stat1' => ['value' => 11078, 'label' => 'Copii beneficiari'],
    'stat2' => ['value' => 11050, 'label' => 'Familii asistate'],
    'stat3' => ['value' => 1956, 'label' => 'Cazuri rezolvate'],
    'stat4' => ['value' => 79, 'label' => 'Angajați profesioniști']
];

// Save sample data
echo "Crearea datelor de test...\n";

if (file_put_contents($contactFile, json_encode($sampleContacts, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    echo "✓ Mesaje de contact create cu succes\n";
} else {
    echo "✗ Eroare la crearea mesajelor de contact\n";
}

if (file_put_contents($petitionsFile, json_encode($samplePetitions, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    echo "✓ Petiții create cu succes\n";
} else {
    echo "✗ Eroare la crearea petițiilor\n";
}

if (file_put_contents($statsFile, json_encode($sampleStats, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
    echo "✓ Statistici create cu succes\n";
} else {
    echo "✗ Eroare la crearea statisticilor\n";
}

echo "\nDatele de test au fost create!\n";
echo "Puteți accesa panoul admin la: http://localhost/admin/login.php\n";
echo "Credențiale: admin / admin123\n";
?>
