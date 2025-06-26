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
            <button class="tab-btn active" data-tab="contacts">
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
        </div>

        <!-- Contact Messages Tab -->
        <div id="contacts-tab" class="tab-content active">
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
            }
        }

        // Add event listeners to tab buttons on page load
        document.addEventListener('DOMContentLoaded', function() {
            const tabButtons = document.querySelectorAll('.tab-btn');
            tabButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const tabName = this.getAttribute('data-tab');
                    showTab(tabName, this);
                });
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
    </script>
</body>
</html>
