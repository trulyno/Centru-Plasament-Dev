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
$statsFile = $dataDir . 'stats.json';
$vacanciesFile = $dataDir . 'vacancies.json';
$faqsFile = $dataDir . 'faqs.json';

// Create data directory if it doesn't exist
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Initialize files if they don't exist
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
$stats = json_decode(file_get_contents($statsFile), true) ?: [];
$vacancies = json_decode(file_get_contents($vacanciesFile), true) ?: [];
$faqs = json_decode(file_get_contents($faqsFile), true) ?: [];

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
                    <span class="stat-card-title">Posturi Vacante</span>
                    <i class="fas fa-briefcase stat-card-icon"></i>
                </div>
                <div class="stat-card-value"><?php echo $totalVacancies; ?></div>
                <div class="stat-card-description">
                    <?php echo $activeVacancies; ?> posturi active
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-card-title">Întrebări Frecvente</span>
                    <i class="fas fa-question-circle stat-card-icon"></i>
                </div>
                <div class="stat-card-value"><?php echo $totalFaqs; ?></div>
                <div class="stat-card-description">
                    <?php echo $activeFaqs; ?> întrebări active
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
            <a href="analytics.php" class="tab-btn analytics-link">
                <i class="fas fa-analytics"></i>
                Analiză Trafic
            </a>
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

    </main>

    <script>
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
            const defaultTab = 'vacancies'; // Changed default tab to vacancies
            
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
