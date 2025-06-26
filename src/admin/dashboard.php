<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Data directory paths
$dataDir = __DIR__ . '/../data/';
$contactFile = $dataDir . 'contacts.json';
$petitionsFile = $dataDir . 'petitions.json';
$statsFile = $dataDir . 'stats.json';
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
    }
}

// Count statistics
$totalContacts = count($contacts);
$newContacts = count(array_filter($contacts, fn($c) => $c['status'] === 'new'));
$totalPetitions = count($petitions);
$newPetitions = count(array_filter($petitions, fn($p) => $p['status'] === 'new'));
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
</body>
</html>
