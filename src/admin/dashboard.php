<?php
session_start();

// Security headers
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1; mode=block');
header('Referrer-Policy: strict-origin-when-cross-origin');

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Verify user data integrity
$dataDir = __DIR__ . '/../data/';
$usersFile = $dataDir . 'users.json';
if (file_exists($usersFile)) {
    $users = json_decode(file_get_contents($usersFile), true) ?: [];
    $currentUser = $_SESSION['admin_username'] ?? '';
    
    // Check if user still exists and is active
    if (!isset($users[$currentUser]) || $users[$currentUser]['status'] !== 'active') {
        session_destroy();
        header('Location: login.php');
        exit;
    }
}

// Data directory paths
$dataDir = __DIR__ . '/../data/';
$contactFile = $dataDir . 'contacts.json';
$petitionsFile = $dataDir . 'petitions.json';
$statsFile = $dataDir . 'stats.json';
$vacanciesFile = $dataDir . 'vacancies.json';
$faqsFile = $dataDir . 'faqs.json';
$langDir = __DIR__ . '/../lang/';

// Create data directory if it doesn't exist
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Initialize files if they don't exist
if (!file_exists($contactFile)) {
    file_put_contents($contactFile, json_encode([], JSON_PRETTY_PRINT));
}
if (!file_exists($petitionsFile)) {
    file_put_contents($petitionsFile, json_encode([], JSON_PRETTY_PRINT));
}
if (!file_exists($vacanciesFile)) {
    file_put_contents($vacanciesFile, json_encode([], JSON_PRETTY_PRINT));
}
if (!file_exists($faqsFile)) {
    file_put_contents($faqsFile, json_encode([], JSON_PRETTY_PRINT));
}
if (!file_exists($statsFile)) {
    $defaultStats = [
        'stat1' => ['value' => 11078, 'label' => 'Copii beneficiari'],
        'stat2' => ['value' => 11050, 'label' => 'Copii externați'],
        'stat3' => ['value' => 1956, 'label' => 'Cazuri rezolvate'],
        'stat4' => ['value' => 79, 'label' => 'Angajați profesioniști']
    ];
    file_put_contents($statsFile, json_encode($defaultStats, JSON_PRETTY_PRINT));
}

// Load data
$contacts = json_decode(file_get_contents($contactFile), true) ?: [];
$petitions = json_decode(file_get_contents($petitionsFile), true) ?: [];
$stats = json_decode(file_get_contents($statsFile), true) ?: [];
$vacancies = json_decode(file_get_contents($vacanciesFile), true) ?: [];
$faqs = json_decode(file_get_contents($faqsFile), true) ?: [];

// Load language files
$langFiles = [];
if (is_dir($langDir)) {
    $langFiles = array_filter(scandir($langDir), function($file) {
        return pathinfo($file, PATHINFO_EXTENSION) === 'json';
    });
}
$languages = [];
foreach ($langFiles as $file) {
    $lang = pathinfo($file, PATHINFO_FILENAME);
    $languages[$lang] = json_decode(file_get_contents($langDir . $file), true) ?: [];
}

// Handle form submissions
$message = '';
$messageType = '';

if ($_POST['action'] ?? false) {
    switch ($_POST['action']) {
        case 'update_stats':
            $newStats = [
                'stat1' => ['value' => (int)$_POST['stat1']],
                'stat2' => ['value' => (int)$_POST['stat2']],
                'stat3' => ['value' => (int)$_POST['stat3']],
                'stat4' => ['value' => (int)$_POST['stat4']]
            ];
            
            if (file_put_contents($statsFile, json_encode($newStats, JSON_PRETTY_PRINT))) {
                $stats = $newStats;
                $message = 'Statisticile au fost actualizate cu succes!';
                $messageType = 'success';
            } else {
                $message = 'Eroare la actualizarea statisticilor!';
                $messageType = 'error';
            }
            break;
            
        case 'update_language':
            $language = $_POST['language'] ?? '';
            $langData = $_POST['lang_data'] ?? '';
            
            if ($language && $langData) {
                $decodedData = json_decode($langData, true);
                if ($decodedData !== null) {
                    $langFile = $langDir . $language . '.json';
                    if (file_put_contents($langFile, json_encode($decodedData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
                        $languages[$language] = $decodedData;
                        $message = 'Fișierul de limbă a fost actualizat cu succes!';
                        $messageType = 'success';
                    } else {
                        $message = 'Eroare la actualizarea fișierului de limbă!';
                        $messageType = 'error';
                    }
                } else {
                    $message = 'Date invalide pentru actualizarea limbii!';
                    $messageType = 'error';
                }
            }
            break;
            
        case 'mark_contact_read':
            $contactId = $_POST['contact_id'];
            if (isset($contacts[$contactId])) {
                $contacts[$contactId]['status'] = 'read';
                file_put_contents($contactFile, json_encode($contacts, JSON_PRETTY_PRINT));
                $message = 'Mesajul a fost marcat ca citit!';
                $messageType = 'success';
            }
            break;
            
        case 'mark_petition_read':
            $petitionId = $_POST['petition_id'];
            if (isset($petitions[$petitionId])) {
                $petitions[$petitionId]['status'] = 'read';
                file_put_contents($petitionsFile, json_encode($petitions, JSON_PRETTY_PRINT));
                $message = 'Petiția a fost marcată ca citită!';
                $messageType = 'success';
            }
            break;
            
        case 'delete_contact':
            $contactId = $_POST['contact_id'];
            if (isset($contacts[$contactId])) {
                unset($contacts[$contactId]);
                file_put_contents($contactFile, json_encode($contacts, JSON_PRETTY_PRINT));
                $message = 'Mesajul a fost șters!';
                $messageType = 'success';
            }
            break;
            
        case 'delete_petition':
            $petitionId = $_POST['petition_id'];
            if (isset($petitions[$petitionId])) {
                unset($petitions[$petitionId]);
                file_put_contents($petitionsFile, json_encode($petitions, JSON_PRETTY_PRINT));
                $message = 'Petiția a fost ștearsă!';
                $messageType = 'success';
            }
            break;
            
        case 'add_vacancy':
            $newVacancy = [
                'id' => uniqid(),
                'title' => $_POST['vacancy_title'],
                'section' => $_POST['vacancy_section'],
                'type' => $_POST['vacancy_type'],
                'responsibilities' => array_filter(explode("\n", $_POST['vacancy_responsibilities'])),
                'requirements' => array_filter(explode("\n", $_POST['vacancy_requirements'])),
                'created_at' => date('Y-m-d H:i:s'),
                'status' => 'active'
            ];
            $vacancies[] = $newVacancy;
            file_put_contents($vacanciesFile, json_encode($vacancies, JSON_PRETTY_PRINT));
            $message = 'Postul vacant a fost adăugat cu succes!';
            $messageType = 'success';
            break;
            
        case 'edit_vacancy':
            $vacancyId = $_POST['vacancy_id'];
            foreach ($vacancies as &$vacancy) {
                if ($vacancy['id'] === $vacancyId) {
                    $vacancy['title'] = $_POST['vacancy_title'];
                    $vacancy['section'] = $_POST['vacancy_section'];
                    $vacancy['type'] = $_POST['vacancy_type'];
                    $vacancy['responsibilities'] = array_filter(explode("\n", $_POST['vacancy_responsibilities']));
                    $vacancy['requirements'] = array_filter(explode("\n", $_POST['vacancy_requirements']));
                    $vacancy['status'] = $_POST['vacancy_status'];
                    break;
                }
            }
            file_put_contents($vacanciesFile, json_encode($vacancies, JSON_PRETTY_PRINT));
            $message = 'Postul vacant a fost actualizat cu succes!';
            $messageType = 'success';
            break;
            
        case 'delete_vacancy':
            $vacancyId = $_POST['vacancy_id'];
            $vacancies = array_filter($vacancies, fn($v) => $v['id'] !== $vacancyId);
            file_put_contents($vacanciesFile, json_encode(array_values($vacancies), JSON_PRETTY_PRINT));
            $message = 'Postul vacant a fost șters!';
            $messageType = 'success';
            break;
            
        case 'add_faq':
            $newFaq = [
                'id' => uniqid(),
                'question' => [
                    'ro' => $_POST['faq_question_ro'],
                    'en' => $_POST['faq_question_en']
                ],
                'answer' => [
                    'ro' => $_POST['faq_answer_ro'],
                    'en' => $_POST['faq_answer_en']
                ],
                'category' => $_POST['faq_category'],
                'status' => 'active',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $faqs[] = $newFaq;
            file_put_contents($faqsFile, json_encode($faqs, JSON_PRETTY_PRINT));
            $message = 'Întrebarea frecventă a fost adăugată cu succes!';
            $messageType = 'success';
            break;
            
        case 'edit_faq':
            $faqId = $_POST['faq_id'];
            foreach ($faqs as &$faq) {
                if ($faq['id'] === $faqId) {
                    $faq['question'] = [
                        'ro' => $_POST['faq_question_ro'],
                        'en' => $_POST['faq_question_en']
                    ];
                    $faq['answer'] = [
                        'ro' => $_POST['faq_answer_ro'],
                        'en' => $_POST['faq_answer_en']
                    ];
                    $faq['category'] = $_POST['faq_category'];
                    $faq['status'] = $_POST['faq_status'];
                    $faq['updated_at'] = date('Y-m-d H:i:s');
                    break;
                }
            }
            file_put_contents($faqsFile, json_encode($faqs, JSON_PRETTY_PRINT));
            $message = 'Întrebarea frecventă a fost actualizată cu succes!';
            $messageType = 'success';
            break;
            
        case 'delete_faq':
            $faqId = $_POST['faq_id'];
            $faqs = array_filter($faqs, fn($f) => $f['id'] !== $faqId);
            file_put_contents($faqsFile, json_encode(array_values($faqs), JSON_PRETTY_PRINT));
            $message = 'Întrebarea frecventă a fost ștearsă!';
            $messageType = 'success';
            break;
    }
}

// Count statistics
$totalContacts = count($contacts);
$newContacts = count(array_filter($contacts, fn($c) => $c['status'] === 'new'));
$totalPetitions = count($petitions);
$newPetitions = count(array_filter($petitions, fn($p) => $p['status'] === 'new'));
$totalVacancies = count($vacancies);
$activeVacancies = count(array_filter($vacancies, fn($v) => $v['status'] === 'active'));
$totalFaqs = count($faqs);
$activeFaqs = count(array_filter($faqs, fn($f) => $f['status'] === 'active'));
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrativ - CPRCVF</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="admin-style.css" rel="stylesheet">
</head>
<body class="dashboard-page">
    <header class="dashboard-header">
        <div class="dashboard-nav">
            <div class="dashboard-logo">
                <i class="fas fa-shield-alt"></i>
                <span>Panou Admin CPRCVF</span>
            </div>
            <div class="dashboard-user">
                <a href="../index.php" class="back-to-site-btn">
                    <i class="fas fa-home"></i>
                    Înapoi la site
                </a>
                <span>Bună ziua, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>!</span>
                <a href="logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    Deconectare
                </a>
            </div>
        </div>
    </header>

    <main class="dashboard-content">
        <?php if ($message): ?>
            <div class="alert alert-<?php echo $messageType; ?>">
                <i class="fas fa-<?php echo $messageType === 'success' ? 'check-circle' : 'exclamation-triangle'; ?>"></i>
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <!-- Dashboard Overview -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-card-title">Mesaje Contact</span>
                    <i class="fas fa-envelope stat-card-icon"></i>
                </div>
                <div class="stat-card-value"><?php echo $totalContacts; ?></div>
                <div class="stat-card-description">
                    <?php echo $newContacts; ?> mesaje noi
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-card-title">Petiții</span>
                    <i class="fas fa-file-alt stat-card-icon"></i>
                </div>
                <div class="stat-card-value"><?php echo $totalPetitions; ?></div>
                <div class="stat-card-description">
                    <?php echo $newPetitions; ?> petiții noi
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-card-title">Total Beneficiari</span>
                    <i class="fas fa-users stat-card-icon"></i>
                </div>
                <div class="stat-card-value"><?php echo number_format($stats['stat1']['value']); ?></div>
                <div class="stat-card-description">
                    Copii beneficiari
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-card-title">Total externați</span>
                    <i class="fas fa-home stat-card-icon"></i>
                </div>
                <div class="stat-card-value"><?php echo number_format($stats['stat2']['value']); ?></div>
                <div class="stat-card-description">
                    Copii extenrnați
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="dashboard-tabs">
            <button class="tab-btn" data-tab="contacts">
                <i class="fas fa-envelope"></i>
                Mesaje Contact (<?php echo $totalContacts; ?>)
            </button>
            <button class="tab-btn" data-tab="petitions">
                <i class="fas fa-file-alt"></i>
                Petiții (<?php echo $totalPetitions; ?>)
            </button>
            <button class="tab-btn" data-tab="vacancies">
                <i class="fas fa-briefcase"></i>
                Posturi Vacante (<?php echo $totalVacancies; ?>)
            </button>
            <button class="tab-btn" data-tab="faqs">
                <i class="fas fa-question-circle"></i>
                Întrebări Frecvente (<?php echo $totalFaqs; ?>)
            </button>
            <button class="tab-btn" data-tab="statistics">
                <i class="fas fa-chart-bar"></i>
                Editare Statistici
            </button>
            <button class="tab-btn" data-tab="content">
                <i class="fas fa-language"></i>
                Conținut Text
            </button>
        </div>

        <!-- Contact Messages Tab -->
        <div id="contacts-tab" class="tab-content">
            <div class="data-table-container">
                <div class="data-table-header">
                    <h2 class="data-table-title">
                        <i class="fas fa-envelope"></i>
                        Mesaje din Formularul de Contact
                    </h2>
                </div>
                
                <?php if (empty($contacts)): ?>
                    <div style="padding: 2rem; text-align: center; color: #6c757d;">
                        <i class="fas fa-inbox" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <p>Nu există mesaje în acest moment.</p>
                    </div>
                <?php else: ?>
                    <div class="data-table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Nume</th>
                                    <th>Email</th>
                                    <th>Subiect</th>
                                    <th>Status</th>
                                    <th>Acțiuni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_reverse($contacts, true) as $id => $contact): ?>
                                    <tr>
                                        <td><?php echo date('d.m.Y H:i', strtotime($contact['timestamp'])); ?></td>
                                        <td><?php echo htmlspecialchars($contact['name']); ?></td>
                                        <td class="email-cell"><?php echo htmlspecialchars($contact['email']); ?></td>
                                        <td>
                                            <div class="text-truncate" title="<?php echo htmlspecialchars($contact['subject']); ?>">
                                                <?php echo htmlspecialchars($contact['subject']); ?>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="status-badge status-<?php echo $contact['status']; ?>">
                                                <?php 
                                                echo match($contact['status']) {
                                                    'new' => 'Nou',
                                                    'read' => 'Citit',
                                                    default => 'Necunoscut'
                                                };
                                                ?>
                                            </span>
                                        </td>
                                        <td class="actions">
                                            <button onclick="viewContact('<?php echo $id; ?>')" class="btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Vezi
                                            </button>
                                            <?php if ($contact['status'] === 'new'): ?>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="action" value="mark_contact_read">
                                                    <input type="hidden" name="contact_id" value="<?php echo $id; ?>">
                                                    <button type="submit" class="btn-sm btn-success">
                                                        <i class="fas fa-check"></i> Marcare citit
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            <form method="POST" style="display: inline;" onsubmit="return confirm('Sigur doriți să ștergeți acest mesaj?')">
                                                <input type="hidden" name="action" value="delete_contact">
                                                <input type="hidden" name="contact_id" value="<?php echo $id; ?>">
                                                <button type="submit" class="btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Șterge
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Petitions Tab -->
        <div id="petitions-tab" class="tab-content">
            <div class="data-table-container">
                <div class="data-table-header">
                    <h2 class="data-table-title">
                        <i class="fas fa-file-alt"></i>
                        Petiții și Reclamații
                    </h2>
                </div>
                
                <?php if (empty($petitions)): ?>
                    <div style="padding: 2rem; text-align: center; color: #6c757d;">
                        <i class="fas fa-file-alt" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <p>Nu există petiții în acest moment.</p>
                    </div>
                <?php else: ?>
                    <div class="data-table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Nume</th>
                                    <th>Tip Entitate</th>
                                    <th>Email</th>
                                    <th>Subiect</th>
                                    <th>Status</th>
                                    <th>Acțiuni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_reverse($petitions, true) as $id => $petition): ?>
                                    <tr>
                                        <td><?php echo date('d.m.Y H:i', strtotime($petition['timestamp'])); ?></td>
                                        <td><?php echo htmlspecialchars($petition['first_name'] . ' ' . $petition['last_name']); ?></td>
                                        <td>
                                            <span class="status-badge <?php echo $petition['entity_type'] === 'individual' ? 'status-new' : 'status-read'; ?>">
                                                <?php echo $petition['entity_type'] === 'individual' ? 'Persoană fizică' : 'Persoană juridică'; ?>
                                            </span>
                                        </td>
                                        <td class="email-cell"><?php echo htmlspecialchars($petition['email']); ?></td>
                                        <td>
                                            <div class="text-truncate" title="<?php echo htmlspecialchars($petition['subject']); ?>">
                                                <?php echo htmlspecialchars($petition['subject']); ?>
                                            </div>
                                            <?php if (!empty($petition['files']) && is_array($petition['files']) && count($petition['files']) > 0): ?>
                                                <div class="file-indicator">
                                                    <i class="fas fa-paperclip"></i>
                                                    <?php echo count($petition['files']); ?> fișier(e)
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="status-badge status-<?php echo $petition['status']; ?>">
                                                <?php 
                                                echo match($petition['status']) {
                                                    'new' => 'Nou',
                                                    'read' => 'Citit',
                                                    default => 'Necunoscut'
                                                };
                                                ?>
                                            </span>
                                        </td>
                                        <td class="actions">
                                            <button onclick="viewPetition('<?php echo $id; ?>')" class="btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Vezi
                                            </button>
                                            <?php if ($petition['status'] === 'new'): ?>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="action" value="mark_petition_read">
                                                    <input type="hidden" name="petition_id" value="<?php echo $id; ?>">
                                                    <button type="submit" class="btn-sm btn-success">
                                                        <i class="fas fa-check"></i> Marcare citit
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                            <form method="POST" style="display: inline;" onsubmit="return confirm('Sigur doriți să ștergeți această petiție?')">
                                                <input type="hidden" name="action" value="delete_petition">
                                                <input type="hidden" name="petition_id" value="<?php echo $id; ?>">
                                                <button type="submit" class="btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Șterge
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Vacancies Tab -->
        <div id="vacancies-tab" class="tab-content">
            <div class="data-table-container">
                <div class="data-table-header">
                    <h2 class="data-table-title">
                        <i class="fas fa-briefcase"></i>
                        Gestionare Posturi Vacante
                    </h2>
                    <button onclick="showAddVacancyModal()" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Adaugă Post Vacant
                    </button>
                </div>
                
                <?php if (empty($vacancies)): ?>
                    <div style="padding: 2rem; text-align: center; color: #6c757d;">
                        <i class="fas fa-briefcase" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <p>Nu există posturi vacante în acest moment.</p>
                        <button onclick="showAddVacancyModal()" class="btn btn-primary" style="margin-top: 1rem;">
                            <i class="fas fa-plus"></i>
                            Adaugă primul post vacant
                        </button>
                    </div>
                <?php else: ?>
                    <div class="data-table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Titlu</th>
                                    <th>Secția</th>
                                    <th>Tip</th>
                                    <th>Data Creării</th>
                                    <th>Status</th>
                                    <th>Acțiuni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_reverse($vacancies, true) as $index => $vacancy): ?>
                                    <tr>
                                        <td>
                                            <strong><?php echo htmlspecialchars($vacancy['title']); ?></strong>
                                        </td>
                                        <td><?php echo htmlspecialchars($vacancy['section']); ?></td>
                                        <td>
                                            <span class="job-type-badge">
                                                <?php echo htmlspecialchars($vacancy['type']); ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('d.m.Y', strtotime($vacancy['created_at'])); ?></td>
                                        <td>
                                            <span class="status-badge status-<?php echo $vacancy['status']; ?>">
                                                <?php 
                                                echo match($vacancy['status']) {
                                                    'active' => 'Activ',
                                                    'inactive' => 'Inactiv',
                                                    default => 'Necunoscut'
                                                };
                                                ?>
                                            </span>
                                        </td>
                                        <td class="actions">
                                            <button onclick="viewVacancy('<?php echo $vacancy['id']; ?>')" class="btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Vezi
                                            </button>
                                            <button onclick="editVacancy('<?php echo $vacancy['id']; ?>')" class="btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Editează
                                            </button>
                                            <form method="POST" style="display: inline;" onsubmit="return confirm('Sigur doriți să ștergeți acest post vacant?')">
                                                <input type="hidden" name="action" value="delete_vacancy">
                                                <input type="hidden" name="vacancy_id" value="<?php echo $vacancy['id']; ?>">
                                                <button type="submit" class="btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Șterge
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- FAQs Tab -->
        <div id="faqs-tab" class="tab-content">
            <div class="data-table-container">
                <div class="data-table-header">
                    <h2 class="data-table-title">
                        <i class="fas fa-question-circle"></i>
                        Gestionare Întrebări Frecvente
                    </h2>
                    <button onclick="showAddFaqModal()" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Adaugă Întrebare
                    </button>
                </div>
                
                <?php if (empty($faqs)): ?>
                    <div style="padding: 2rem; text-align: center; color: #6c757d;">
                        <i class="fas fa-question-circle" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <p>Nu există întrebări frecvente în acest moment.</p>
                        <button onclick="showAddFaqModal()" class="btn btn-primary" style="margin-top: 1rem;">
                            <i class="fas fa-plus"></i>
                            Adaugă prima întrebare
                        </button>
                    </div>
                <?php else: ?>
                    <div class="data-table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Întrebare (RO)</th>
                                    <th>Categorie</th>
                                    <th>Data Creării</th>
                                    <th>Status</th>
                                    <th>Acțiuni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach (array_reverse($faqs, true) as $index => $faq): ?>
                                    <tr>
                                        <td>
                                            <div class="text-truncate" title="<?php echo htmlspecialchars($faq['question']['ro'] ?? ''); ?>">
                                                <strong><?php echo htmlspecialchars(substr($faq['question']['ro'] ?? '', 0, 80) . (strlen($faq['question']['ro'] ?? '') > 80 ? '...' : '')); ?></strong>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="category-badge category-<?php echo $faq['category']; ?>">
                                                <?php 
                                                echo match($faq['category']) {
                                                    'general' => 'General',
                                                    'services' => 'Servicii',
                                                    'admission' => 'Admitere',
                                                    'support' => 'Suport',
                                                    default => 'Necunoscut'
                                                };
                                                ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('d.m.Y', strtotime($faq['created_at'])); ?></td>
                                        <td>
                                            <span class="status-badge status-<?php echo $faq['status']; ?>">
                                                <?php 
                                                echo match($faq['status']) {
                                                    'active' => 'Activ',
                                                    'inactive' => 'Inactiv',
                                                    default => 'Necunoscut'
                                                };
                                                ?>
                                            </span>
                                        </td>
                                        <td class="actions">
                                            <button onclick="viewFaq('<?php echo $faq['id']; ?>')" class="btn-sm btn-primary">
                                                <i class="fas fa-eye"></i> Vezi
                                            </button>
                                            <button onclick="editFaq('<?php echo $faq['id']; ?>')" class="btn-sm btn-warning">
                                                <i class="fas fa-edit"></i> Editează
                                            </button>
                                            <form method="POST" style="display: inline;" onsubmit="return confirm('Sigur doriți să ștergeți această întrebare frecventă?')">
                                                <input type="hidden" name="action" value="delete_faq">
                                                <input type="hidden" name="faq_id" value="<?php echo $faq['id']; ?>">
                                                <button type="submit" class="btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Șterge
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Statistics Tab -->
        <div id="statistics-tab" class="tab-content">
            <div class="admin-form">
                <h2 style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-chart-bar"></i>
                    Editare Statistici pentru Pagina Principală
                </h2>
                
                <form method="POST">
                    <input type="hidden" name="action" value="update_stats">
                    
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                        <div class="form-group">
                            <label for="stat1">Copii Beneficiari - Valoare:</label>
                            <input type="number" id="stat1" name="stat1" value="<?php echo $stats['stat1']['value']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="stat2">Reunificări de Succes - Valoare:</label>
                            <input type="number" id="stat2" name="stat2" value="<?php echo $stats['stat2']['value']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="stat3">Plasamente pentru Adopție - Valoare:</label>
                            <input type="number" id="stat3" name="stat3" value="<?php echo $stats['stat3']['value']; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="stat4">Ani de Serviciu - Valoare:</label>
                            <input type="number" id="stat4" name="stat4" value="<?php echo $stats['stat4']['value']; ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i>
                            Salvează Modificările
                        </button>
                    </div>
                </form>
                
                <div style="margin-top: 2rem; padding: 1rem; background: #f8f9fa; border-radius: 0.5rem; border-left: 4px solid var(--info-color);">
                    <h4 style="margin-bottom: 0.5rem; color: var(--info-color);">
                        <i class="fas fa-info-circle"></i> Informații
                    </h4>
                    <p style="margin: 0; color: #6c757d;">
                        Aceste statistici se vor afișa automat pe pagina principală a site-ului în secțiunea de statistici.
                        Modificările vor fi vizibile imediat după salvare.
                    </p>
                </div>
            </div>
        </div>

        <!-- Content Management Tab -->
        <div id="content-tab" class="tab-content">
            <div class="admin-form">
                <h2 style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-language"></i>
                    Gestionare Conținut Text
                </h2>
                
                <div class="content-controls" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem; margin-bottom: 2rem; padding: 1.5rem; background: #f8f9fa; border-radius: 0.5rem;">
                    <div class="form-group">
                        <label for="language-select">Limbă:</label>
                        <select id="language-select" onchange="loadLanguageContent()">
                            <?php foreach (array_keys($languages) as $lang): ?>
                                <option value="<?php echo $lang; ?>"><?php echo strtoupper($lang); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="key-filter">Filtrare Chei:</label>
                        <input type="text" id="key-filter" placeholder="Caută după cheie..." oninput="filterContent()">
                    </div>
                    
                    <div class="form-group">
                        <label for="text-filter">Filtrare Text:</label>
                        <input type="text" id="text-filter" placeholder="Caută în text..." oninput="filterContent()">
                    </div>
                    
                    <div class="form-group">
                        <label>&nbsp;</label>
                        <div style="display: flex; gap: 0.5rem;">
                            <button type="button" class="btn btn-secondary" onclick="resetFilters()" id="reset-filters-btn" title="Resetează toate filtrele">
                                <i class="fas fa-times"></i>
                                <span class="btn-text">Resetează</span>
                            </button>
                            <button type="button" class="btn btn-primary" onclick="saveLanguageContent()" id="save-btn" disabled title="Salvează modificările">
                                <i class="fas fa-save"></i>
                                <span class="btn-text">Salvează</span>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem;">
                    <div class="content-table-wrapper">
                        <div class="data-table-wrapper" style="max-height: 600px; overflow-y: auto;">
                            <table class="data-table" id="content-table">
                                <thead>
                                    <tr>
                                        <th style="width: 30%;">Cheie</th>
                                        <th style="width: 70%;">Text</th>
                                    </tr>
                                </thead>
                                <tbody id="content-tbody">
                                    <!-- Content will be loaded dynamically -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="content-preview">
                        <h4 style="margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="fas fa-eye"></i>
                            Previzualizare
                        </h4>
                        <div id="preview-container" style="border: 2px solid var(--border-color); border-radius: 0.5rem; padding: 1rem; min-height: 200px; background: white;">
                            <p style="color: #6c757d; text-align: center; margin-top: 2rem;">
                                Selectați un câmp de text pentru previzualizare
                            </p>
                        </div>
                        <div style="margin-top: 1rem; font-size: 0.9rem; color: #6c757d;">
                            <strong>Suport pentru formatare:</strong><br>
                            &lt;b&gt;text bold&lt;/b&gt;<br>
                            &lt;i&gt;text italic&lt;/i&gt;<br>
                            &lt;u&gt;text subliniat&lt;/u&gt;<br>
                            &lt;br&gt; pentru linie nouă
                        </div>
                    </div>
                </div>
                
                <div style="margin-top: 2rem; padding: 1rem; background: #fff3cd; border-radius: 0.5rem; border-left: 4px solid #ffc107;">
                    <h4 style="margin-bottom: 0.5rem; color: #856404;">
                        <i class="fas fa-exclamation-triangle"></i> Atenție
                    </h4>
                    <p style="margin: 0; color: #856404;">
                        Modificările vor afecta textele afișate pe site. Verificați cu atenție înainte de salvare.
                        Butonul de salvare se va activa doar când există modificări.
                    </p>
                </div>
            </div>
        </div>
    </main>

    <!-- Contact Modal -->
    <div id="contactModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: 0.75rem; max-width: 600px; width: 90%; max-height: 90%; overflow-y: auto; box-shadow: var(--shadow-lg);">
            <div style="padding: 1.5rem; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-envelope"></i>
                    Detalii Mesaj Contact
                </h3>
                <button onclick="closeModal('contactModal')" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="contactModalContent" style="padding: 1.5rem;"></div>
        </div>
    </div>

    <!-- Petition Modal -->
    <div id="petitionModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: 0.75rem; max-width: 800px; width: 90%; max-height: 90%; overflow-y: auto; box-shadow: var(--shadow-lg);">
            <div style="padding: 1.5rem; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; display: flex; align-items: center; gap: 0.5rem;">
                    <i class="fas fa-file-alt"></i>
                    Detalii Petiție
                </h3>
                <button onclick="closeModal('petitionModal')" style="background: none; border: none; font-size: 1.5rem; cursor: pointer;">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div id="petitionModalContent" style="padding: 1.5rem;"></div>
        </div>
    </div>

    <script>
        // Language data
        const languagesData = <?php echo json_encode($languages); ?>;
        let currentLanguage = Object.keys(languagesData)[0] || 'ro';
        let originalData = {};
        let currentData = {};
        let hasChanges = false;

        // Tab functionality
        function showTab(tabName, buttonElement) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            
            // Remove active class from all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            // Show selected tab
            const targetTab = document.getElementById(tabName + '-tab');
            if (targetTab) {
                targetTab.classList.add('active');
            }
            
            // Add active class to clicked button
            if (buttonElement) {
                buttonElement.classList.add('active');
            } else {
                // If no button element provided, find and activate the corresponding button
                const tabButton = document.querySelector(`[data-tab="${tabName}"]`);
                if (tabButton) {
                    tabButton.classList.add('active');
                }
            }
            
            // Save current tab to localStorage
            localStorage.setItem('admin_current_tab', tabName);
            
            // Update URL hash
            if (window.location.hash.replace('#', '') !== tabName) {
                window.location.hash = tabName;
            }
        }
        
        // Load saved tab or default tab
        function loadSavedTab() {
            // Check for URL hash first
            const urlHash = window.location.hash.replace('#', '');
            const savedTab = localStorage.getItem('admin_current_tab');
            const defaultTab = 'contacts';
            
            // Priority: URL hash > saved tab > default
            let tabToShow = defaultTab;
            if (urlHash && document.getElementById(urlHash + '-tab')) {
                tabToShow = urlHash;
            } else if (savedTab && document.getElementById(savedTab + '-tab')) {
                tabToShow = savedTab;
            }
            
            // Show the tab
            showTab(tabToShow);
            
            // Update URL hash if different
            if (window.location.hash.replace('#', '') !== tabToShow) {
                window.location.hash = tabToShow;
            }
        }

        // Add event listeners to tab buttons on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize tab functionality
            const tabButtons = document.querySelectorAll('.tab-btn');
            tabButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tabName = this.getAttribute('data-tab');
                    showTab(tabName, this);
                });
            });
            
            // Load saved tab or show default
            loadSavedTab();
            
            // Initialize content management if language data is available
            if (languagesData && Object.keys(languagesData).length > 0) {
                loadLanguageContent();
            }
            
            // Listen for hash changes (browser back/forward)
            window.addEventListener('hashchange', function() {
                const hash = window.location.hash.replace('#', '');
                if (hash && document.getElementById(hash + '-tab')) {
                    showTab(hash);
                }
            });
        });

        // Modal functionality
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside
        document.addEventListener('click', function(e) {
            if (e.target.style.background && e.target.style.background.includes('rgba(0,0,0,0.5)')) {
                e.target.style.display = 'none';
            }
        });

        // View contact details
        function viewContact(contactId) {
            const contacts = <?php echo json_encode($contacts); ?>;
            const contact = contacts[contactId];
            
            if (contact) {
                const content = `
                    <div style="display: grid; gap: 1rem;">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                            <div>
                                <strong>Nume:</strong><br>
                                ${contact.name}
                            </div>
                            <div>
                                <strong>Email:</strong><br>
                                <a href="mailto:${contact.email}">${contact.email}</a>
                            </div>
                            <div>
                                <strong>Telefon:</strong><br>
                                ${contact.phone || 'Nu a fost specificat'}
                            </div>
                            <div>
                                <strong>Data:</strong><br>
                                ${new Date(contact.timestamp).toLocaleString('ro-RO')}
                            </div>
                        </div>
                        <div>
                            <strong>Subiect:</strong><br>
                            ${contact.subject}
                        </div>
                        <div>
                            <strong>Mesaj:</strong><br>
                            <div style="background: #f8f9fa; padding: 1rem; border-radius: 0.5rem; margin-top: 0.5rem; white-space: pre-wrap;">${contact.message}</div>
                        </div>
                    </div>
                `;
                
                document.getElementById('contactModalContent').innerHTML = content;
                document.getElementById('contactModal').style.display = 'flex';
            }
        }

        // View petition details
        function viewPetition(petitionId) {
            const petitions = <?php echo json_encode($petitions); ?>;
            const petition = petitions[petitionId];
            
            if (petition) {
                let filesSection = '';
                if (petition.files && Object.keys(petition.files).length > 0) {
                    filesSection = `
                        <div>
                            <strong>Fișiere anexate:</strong><br>
                            <div style="margin-top: 0.5rem;">
                    `;
                    
                    Object.entries(petition.files).forEach(([key, filename]) => {
                        const fileType = filename.split('.').pop().toLowerCase();
                        const icon = fileType === 'pdf' ? 'fas fa-file-pdf' : 'fas fa-file';
                        const color = fileType === 'pdf' ? '#dc3545' : '#6c757d';
                        
                        filesSection += `
                            <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.5rem; padding: 0.5rem; background: #f8f9fa; border-radius: 0.25rem;">
                                <i class="${icon}" style="color: ${color};"></i>
                                <span style="flex: 1;">${filename}</span>
                                <a href="download-file.php?file=${encodeURIComponent(filename)}" target="_blank" class="btn-sm btn-primary" style="text-decoration: none;">
                                    <i class="fas fa-download"></i> Descarcă
                                </a>
                            </div>
                        `;
                    });
                    
                    filesSection += '</div></div>';
                }
                
                const content = `
                    <div style="display: grid; gap: 1rem;">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                            <div>
                                <strong>Nume:</strong><br>
                                ${petition.first_name} ${petition.last_name}
                            </div>
                            <div>
                                <strong>Email:</strong><br>
                                <a href="mailto:${petition.email}">${petition.email}</a>
                            </div>
                            <div>
                                <strong>Telefon:</strong><br>
                                ${petition.phone}
                            </div>
                            <div>
                                <strong>Tip Entitate:</strong><br>
                                ${petition.entity_type === 'individual' ? 'Persoană fizică' : 'Persoană juridică'}
                            </div>
                        </div>
                        ${petition.entity_type === 'legal' ? `
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                            <div>
                                <strong>IDNO:</strong><br>
                                ${petition.idno || 'Nu a fost specificat'}
                            </div>
                            <div>
                                <strong>Denumire Organizație:</strong><br>
                                ${petition.organization_name || 'Nu a fost specificat'}
                            </div>
                        </div>
                        ` : `
                        <div>
                            <strong>IDNP:</strong><br>
                            ${petition.idnp || 'Nu a fost specificat'}
                        </div>
                        `}
                        <div>
                            <strong>Adresa:</strong><br>
                            <div style="background: #f8f9fa; padding: 1rem; border-radius: 0.5rem; margin-top: 0.5rem;">${petition.address}</div>
                        </div>
                        <div>
                            <strong>Subiect:</strong><br>
                            ${petition.subject}
                        </div>
                        <div>
                            <strong>Mesaj:</strong><br>
                            <div style="background: #f8f9fa; padding: 1rem; border-radius: 0.5rem; margin-top: 0.5rem; white-space: pre-wrap;">${petition.message}</div>
                        </div>
                        ${filesSection}
                        <div>
                            <strong>Data:</strong><br>
                            ${new Date(petition.timestamp).toLocaleString('ro-RO')}
                        </div>
                        ${petition.consent_info ? `
                        <div style="font-size: 0.9rem; color: #6c757d; border-top: 1px solid var(--border-color); padding-top: 1rem;">
                            <strong>Consimțăminte:</strong><br>
                            - Procesarea datelor personale: Da<br>
                            - Acuratețea informațiilor: Da
                        </div>
                        ` : ''}
                    </div>
                `;
                
                document.getElementById('petitionModalContent').innerHTML = content;
                document.getElementById('petitionModal').style.display = 'flex';
            }
        }
        
        // Content Management Functions
        function loadLanguageContent() {
            const selectedLang = document.getElementById('language-select').value;
            currentLanguage = selectedLang;
            
            if (!languagesData[selectedLang]) {
                return;
            }
            
            originalData = JSON.parse(JSON.stringify(languagesData[selectedLang]));
            currentData = JSON.parse(JSON.stringify(languagesData[selectedLang]));
            
            renderContentTable();
            updateSaveButton();
            updateResetButton();
        }
        
        function renderContentTable() {
            const tbody = document.getElementById('content-tbody');
            const keyFilter = document.getElementById('key-filter').value.toLowerCase();
            const textFilter = document.getElementById('text-filter').value.toLowerCase();
            
            tbody.innerHTML = '';
            
            Object.entries(currentData).forEach(([key, value]) => {
                const keyMatches = !keyFilter || key.toLowerCase().includes(keyFilter);
                const textMatches = !textFilter || value.toLowerCase().includes(textFilter);
                
                if (keyMatches && textMatches) {
                    const row = document.createElement('tr');
                    row.innerHTML = `
                        <td style="vertical-align: top; padding-top: 1rem;">
                            <strong>${escapeHtml(key)}</strong>
                        </td>
                        <td>
                            <textarea 
                                class="content-textarea" 
                                data-key="${escapeHtml(key)}"
                                onchange="updateContent('${escapeHtml(key)}', this.value)"
                                onfocus="updatePreview(this.value)"
                                oninput="updatePreview(this.value)"
                                style="width: 100%; min-height: 80px; padding: 0.5rem; border: 1px solid var(--border-color); border-radius: 0.25rem; resize: vertical; font-family: inherit;"
                            >${escapeHtml(value)}</textarea>
                        </td>
                    `;
                    tbody.appendChild(row);
                }
            });
        }
        
        function filterContent() {
            renderContentTable();
            updateResetButton();
        }
        
        function resetFilters() {
            document.getElementById('key-filter').value = '';
            document.getElementById('text-filter').value = '';
            renderContentTable();
            updateResetButton();
        }
        
        function updateResetButton() {
            const keyFilter = document.getElementById('key-filter').value;
            const textFilter = document.getElementById('text-filter').value;
            const resetBtn = document.getElementById('reset-filters-btn');
            
            const hasFilters = keyFilter.trim() !== '' || textFilter.trim() !== '';
            resetBtn.disabled = !hasFilters;
            resetBtn.style.opacity = hasFilters ? '1' : '0.6';
        }
        
        function updateContent(key, value) {
            currentData[key] = value;
            checkForChanges();
        }
        
        function checkForChanges() {
            hasChanges = JSON.stringify(originalData) !== JSON.stringify(currentData);
            updateSaveButton();
        }
        
        function updateSaveButton() {
            const saveBtn = document.getElementById('save-btn');
            saveBtn.disabled = !hasChanges;
            saveBtn.style.opacity = hasChanges ? '1' : '0.6';
        }
        
        function updatePreview(text) {
            const previewContainer = document.getElementById('preview-container');
            if (text.trim()) {
                // Convert basic HTML tags for preview
                const formattedText = text
                    .replace(/&/g, '&amp;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;')
                    .replace(/&lt;b&gt;(.*?)&lt;\/b&gt;/gi, '<b>$1</b>')
                    .replace(/&lt;i&gt;(.*?)&lt;\/i&gt;/gi, '<i>$1</i>')
                    .replace(/&lt;u&gt;(.*?)&lt;\/u&gt;/gi, '<u>$1</u>')
                    .replace(/&lt;br&gt;/gi, '<br>');
                
                previewContainer.innerHTML = `<div style="line-height: 1.5;">${formattedText}</div>`;
            } else {
                previewContainer.innerHTML = '<p style="color: #6c757d; text-align: center; margin-top: 2rem;">Selectați un câmp de text pentru previzualizare</p>';
            }
        }
        
        function saveLanguageContent() {
            if (!hasChanges) {
                return;
            }
            
            const formData = new FormData();
            formData.append('action', 'update_language');
            formData.append('language', currentLanguage);
            formData.append('lang_data', JSON.stringify(currentData));
            
            fetch('dashboard.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Reload the page to show the success message
                window.location.reload();
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Eroare la salvarea datelor!');
            });
        }
        
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
    </script>

    <!-- Vacancy Modals -->
    <div id="addVacancyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-plus"></i> Adaugă Post Vacant</h3>
                <button class="modal-close" onclick="closeModal('addVacancyModal')">&times;</button>
            </div>
            <form method="POST">
                <input type="hidden" name="action" value="add_vacancy">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="vacancy_title">Titlul Postului *</label>
                        <input type="text" id="vacancy_title" name="vacancy_title" required>
                    </div>
                    <div class="form-group">
                        <label for="vacancy_section">Secția *</label>
                        <input type="text" id="vacancy_section" name="vacancy_section" required>
                    </div>
                    <div class="form-group">
                        <label for="vacancy_type">Tipul Normei *</label>
                        <select id="vacancy_type" name="vacancy_type" required>
                            <option value="Normă întreagă">Normă întreagă</option>
                            <option value="Jumătate de normă">Jumătate de normă</option>
                            <option value="0.25 normă">0.25 normă</option>
                            <option value="Contract temporar">Contract temporar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="vacancy_responsibilities">Responsabilități (câte una pe linie) *</label>
                        <textarea id="vacancy_responsibilities" name="vacancy_responsibilities" rows="5" required placeholder="Introduceți responsabilitățile, câte una pe linie"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="vacancy_requirements">Cerințe (câte una pe linie) *</label>
                        <textarea id="vacancy_requirements" name="vacancy_requirements" rows="5" required placeholder="Introduceți cerințele, câte una pe linie"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addVacancyModal')">Anulează</button>
                    <button type="submit" class="btn btn-primary">Adaugă Post</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editVacancyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Editează Post Vacant</h3>
                <button class="modal-close" onclick="closeModal('editVacancyModal')">&times;</button>
            </div>
            <form method="POST">
                <input type="hidden" name="action" value="edit_vacancy">
                <input type="hidden" id="edit_vacancy_id" name="vacancy_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_vacancy_title">Titlul Postului *</label>
                        <input type="text" id="edit_vacancy_title" name="vacancy_title" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_vacancy_section">Secția *</label>
                        <input type="text" id="edit_vacancy_section" name="vacancy_section" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_vacancy_type">Tipul Normei *</label>
                        <select id="edit_vacancy_type" name="vacancy_type" required>
                            <option value="Normă întreagă">Normă întreagă</option>
                            <option value="Jumătate de normă">Jumătate de normă</option>
                            <option value="0.25 normă">0.25 normă</option>
                            <option value="Contract temporar">Contract temporar</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_vacancy_status">Status *</label>
                        <select id="edit_vacancy_status" name="vacancy_status" required>
                            <option value="active">Activ</option>
                            <option value="inactive">Inactiv</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_vacancy_responsibilities">Responsabilități (câte una pe linie) *</label>
                        <textarea id="edit_vacancy_responsibilities" name="vacancy_responsibilities" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_vacancy_requirements">Cerințe (câte una pe linie) *</label>
                        <textarea id="edit_vacancy_requirements" name="vacancy_requirements" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editVacancyModal')">Anulează</button>
                    <button type="submit" class="btn btn-primary">Actualizează Post</button>
                </div>
            </form>
        </div>
    </div>

    <div id="viewVacancyModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-eye"></i> Detalii Post Vacant</h3>
                <button class="modal-close" onclick="closeModal('viewVacancyModal')">&times;</button>
            </div>
            <div class="modal-body" id="viewVacancyContent">
                <!-- Content will be populated by JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('viewVacancyModal')">Închide</button>
            </div>
        </div>
    </div>

    <!-- FAQ Modals -->
    <div id="addFaqModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-plus"></i> Adaugă Întrebare Frecventă</h3>
                <button class="modal-close" onclick="closeModal('addFaqModal')">&times;</button>
            </div>
            <form method="POST">
                <input type="hidden" name="action" value="add_faq">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="faq_category">Categoria *</label>
                        <select id="faq_category" name="faq_category" required>
                            <option value="general">General</option>
                            <option value="services">Servicii</option>
                            <option value="admission">Admitere</option>
                            <option value="support">Suport</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="faq_question_ro">Întrebarea (Română) *</label>
                        <textarea id="faq_question_ro" name="faq_question_ro" rows="3" required placeholder="Introduceți întrebarea în română"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="faq_question_en">Întrebarea (Engleză) *</label>
                        <textarea id="faq_question_en" name="faq_question_en" rows="3" required placeholder="Introduceți întrebarea în engleză"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="faq_answer_ro">Răspunsul (Română) *</label>
                        <textarea id="faq_answer_ro" name="faq_answer_ro" rows="5" required placeholder="Introduceți răspunsul în română"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="faq_answer_en">Răspunsul (Engleză) *</label>
                        <textarea id="faq_answer_en" name="faq_answer_en" rows="5" required placeholder="Introduceți răspunsul în engleză"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addFaqModal')">Anulează</button>
                    <button type="submit" class="btn btn-primary">Adaugă Întrebare</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editFaqModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Editează Întrebare Frecventă</h3>
                <button class="modal-close" onclick="closeModal('editFaqModal')">&times;</button>
            </div>
            <form method="POST">
                <input type="hidden" name="action" value="edit_faq">
                <input type="hidden" id="edit_faq_id" name="faq_id">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="edit_faq_category">Categoria *</label>
                        <select id="edit_faq_category" name="faq_category" required>
                            <option value="general">General</option>
                            <option value="services">Servicii</option>
                            <option value="admission">Admitere</option>
                            <option value="support">Suport</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_faq_status">Status *</label>
                        <select id="edit_faq_status" name="faq_status" required>
                            <option value="active">Activ</option>
                            <option value="inactive">Inactiv</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_faq_question_ro">Întrebarea (Română) *</label>
                        <textarea id="edit_faq_question_ro" name="faq_question_ro" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_faq_question_en">Întrebarea (Engleză) *</label>
                        <textarea id="edit_faq_question_en" name="faq_question_en" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_faq_answer_ro">Răspunsul (Română) *</label>
                        <textarea id="edit_faq_answer_ro" name="faq_answer_ro" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_faq_answer_en">Răspunsul (Engleză) *</label>
                        <textarea id="edit_faq_answer_en" name="faq_answer_en" rows="5" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editFaqModal')">Anulează</button>
                    <button type="submit" class="btn btn-primary">Actualizează Întrebare</button>
                </div>
            </form>
        </div>
    </div>

    <div id="viewFaqModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-eye"></i> Detalii Întrebare Frecventă</h3>
                <button class="modal-close" onclick="closeModal('viewFaqModal')">&times;</button>
            </div>
            <div class="modal-body" id="viewFaqContent">
                <!-- Content will be populated by JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('viewFaqModal')">Închide</button>
            </div>
        </div>
    </div>

    <script>
        // Vacancy-related JavaScript functions
        const vacanciesData = <?php echo json_encode($vacancies); ?>;

        function showAddVacancyModal() {
            document.getElementById('addVacancyModal').style.display = 'block';
        }

        function editVacancy(vacancyId) {
            const vacancy = vacanciesData.find(v => v.id === vacancyId);
            if (!vacancy) return;

            document.getElementById('edit_vacancy_id').value = vacancy.id;
            document.getElementById('edit_vacancy_title').value = vacancy.title;
            document.getElementById('edit_vacancy_section').value = vacancy.section;
            document.getElementById('edit_vacancy_type').value = vacancy.type;
            document.getElementById('edit_vacancy_status').value = vacancy.status;
            document.getElementById('edit_vacancy_responsibilities').value = vacancy.responsibilities.join('\n');
            document.getElementById('edit_vacancy_requirements').value = vacancy.requirements.join('\n');

            document.getElementById('editVacancyModal').style.display = 'block';
        }

        function viewVacancy(vacancyId) {
            const vacancy = vacanciesData.find(v => v.id === vacancyId);
            if (!vacancy) return;

            const content = `
                <div class="vacancy-details">
                    <div class="detail-group">
                        <h4><i class="fas fa-briefcase"></i> ${escapeHtml(vacancy.title)}</h4>
                        <p><strong>Secția:</strong> ${escapeHtml(vacancy.section)}</p>
                        <p><strong>Tip:</strong> ${escapeHtml(vacancy.type)}</p>
                        <p><strong>Status:</strong> <span class="status-badge status-${vacancy.status}">${vacancy.status === 'active' ? 'Activ' : 'Inactiv'}</span></p>
                        <p><strong>Data creării:</strong> ${new Date(vacancy.created_at).toLocaleDateString('ro-RO')}</p>
                    </div>
                    
                    <div class="detail-group">
                        <h5><i class="fas fa-tasks"></i> Responsabilități:</h5>
                        <ul>
                            ${vacancy.responsibilities.map(resp => `<li>${escapeHtml(resp)}</li>`).join('')}
                        </ul>
                    </div>
                    
                    <div class="detail-group">
                        <h5><i class="fas fa-check-circle"></i> Cerințe:</h5>
                        <ul>
                            ${vacancy.requirements.map(req => `<li>${escapeHtml(req)}</li>`).join('')}
                        </ul>
                    </div>
                </div>
            `;

            document.getElementById('viewVacancyContent').innerHTML = content;
            document.getElementById('viewVacancyModal').style.display = 'block';
        }

        // FAQ-related JavaScript functions
        const faqsData = <?php echo json_encode($faqs); ?>;

        function showAddFaqModal() {
            document.getElementById('addFaqModal').style.display = 'block';
        }

        function editFaq(faqId) {
            const faq = faqsData.find(f => f.id === faqId);
            if (!faq) return;

            document.getElementById('edit_faq_id').value = faq.id;
            document.getElementById('edit_faq_category').value = faq.category;
            document.getElementById('edit_faq_status').value = faq.status;
            document.getElementById('edit_faq_question_ro').value = faq.question.ro;
            document.getElementById('edit_faq_question_en').value = faq.question.en;
            document.getElementById('edit_faq_answer_ro').value = faq.answer.ro;
            document.getElementById('edit_faq_answer_en').value = faq.answer.en;

            document.getElementById('editFaqModal').style.display = 'block';
        }

        function viewFaq(faqId) {
            const faq = faqsData.find(f => f.id === faqId);
            if (!faq) return;

            const categoryName = {
                'general': 'General',
                'services': 'Servicii',
                'admission': 'Admitere',
                'support': 'Suport'
            }[faq.category] || 'Necunoscut';

            const statusName = faq.status === 'active' ? 'Activ' : 'Inactiv';

            const content = `
                <div class="faq-details">
                    <div class="detail-group">
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1rem;">
                            <span class="category-badge category-${faq.category}">${categoryName}</span>
                            <span class="status-badge status-${faq.status}">${statusName}</span>
                        </div>
                        <p><strong>Data creării:</strong> ${new Date(faq.created_at).toLocaleDateString('ro-RO')}</p>
                        ${faq.updated_at !== faq.created_at ? `<p><strong>Ultima actualizare:</strong> ${new Date(faq.updated_at).toLocaleDateString('ro-RO')}</p>` : ''}
                    </div>
                    
                    <div class="detail-group">
                        <h5><i class="fas fa-question-circle"></i> Întrebarea (Română):</h5>
                        <div style="background: #f8f9fa; padding: 1rem; border-radius: 0.5rem; margin-top: 0.5rem;">
                            ${escapeHtml(faq.question.ro)}
                        </div>
                    </div>
                    
                    <div class="detail-group">
                        <h5><i class="fas fa-question-circle"></i> Întrebarea (Engleză):</h5>
                        <div style="background: #f8f9fa; padding: 1rem; border-radius: 0.5rem; margin-top: 0.5rem;">
                            ${escapeHtml(faq.question.en)}
                        </div>
                    </div>
                    
                    <div class="detail-group">
                        <h5><i class="fas fa-lightbulb"></i> Răspunsul (Română):</h5>
                        <div style="background: #e7f3ff; padding: 1rem; border-radius: 0.5rem; margin-top: 0.5rem; border-left: 4px solid #007bff;">
                            ${escapeHtml(faq.answer.ro).replace(/\n/g, '<br>')}
                        </div>
                    </div>
                    
                    <div class="detail-group">
                        <h5><i class="fas fa-lightbulb"></i> Răspunsul (Engleză):</h5>
                        <div style="background: #e7f3ff; padding: 1rem; border-radius: 0.5rem; margin-top: 0.5rem; border-left: 4px solid #007bff;">
                            ${escapeHtml(faq.answer.en).replace(/\n/g, '<br>')}
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('viewFaqContent').innerHTML = content;
            document.getElementById('viewFaqModal').style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modals = ['addVacancyModal', 'editVacancyModal', 'viewVacancyModal', 'addFaqModal', 'editFaqModal', 'viewFaqModal'];
            modals.forEach(modalId => {
                const modal = document.getElementById(modalId);
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
