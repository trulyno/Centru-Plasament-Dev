<?php
session_start();
require_once '../config/admin_config.php';
require_once 'includes/auth.php';
checkAuth();

// Get contact messages
function getContactMessages() {
    $messages_dir = '../messages';
    $messages = [];
    
    if (!is_dir($messages_dir)) {
        return $messages;
    }
    
    $files = glob($messages_dir . '/*.json');
    foreach ($files as $file) {
        $content = file_get_contents($file);
        if ($content) {
            $message = json_decode($content, true);
            if ($message) {
                $messages[] = $message;
            }
        }
    }
    
    // Sort by date (newest first)
    usort($messages, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
    
    return $messages;
}

// Handle message actions
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $message_id = $_POST['message_id'] ?? '';
    $messages_dir = '../messages';
    
    if ($action === 'mark_read' && $message_id) {
        $message_file = $messages_dir . '/' . $message_id . '.json';
        if (file_exists($message_file)) {
            $message = json_decode(file_get_contents($message_file), true);
            $message['read'] = true;
            $message['status'] = 'read';
            file_put_contents($message_file, json_encode($message, JSON_PRETTY_PRINT));
        }
    } elseif ($action === 'mark_unread' && $message_id) {
        $message_file = $messages_dir . '/' . $message_id . '.json';
        if (file_exists($message_file)) {
            $message = json_decode(file_get_contents($message_file), true);
            $message['read'] = false;
            $message['status'] = 'new';
            file_put_contents($message_file, json_encode($message, JSON_PRETTY_PRINT));
        }
    } elseif ($action === 'delete' && $message_id) {
        $message_file = $messages_dir . '/' . $message_id . '.json';
        if (file_exists($message_file)) {
            unlink($message_file);
        }
    } elseif ($action === 'bulk_delete' && isset($_POST['selected_messages'])) {
        foreach ($_POST['selected_messages'] as $msg_id) {
            $message_file = $messages_dir . '/' . $msg_id . '.json';
            if (file_exists($message_file)) {
                unlink($message_file);
            }
        }
    } elseif ($action === 'bulk_mark_read' && isset($_POST['selected_messages'])) {
        foreach ($_POST['selected_messages'] as $msg_id) {
            $message_file = $messages_dir . '/' . $msg_id . '.json';
            if (file_exists($message_file)) {
                $message = json_decode(file_get_contents($message_file), true);
                $message['read'] = true;
                $message['status'] = 'read';
                file_put_contents($message_file, json_encode($message, JSON_PRETTY_PRINT));
            }
        }
    }
    
    // Redirect to prevent form resubmission
    header('Location: messages.php');
    exit;
}

$messages = getContactMessages();
$total_messages = count($messages);
$unread_messages = count(array_filter($messages, function($msg) { return !$msg['read']; }));
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mesaje Contact - CPRCVF Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/admin.css" rel="stylesheet">
</head>
<body class="admin-dashboard">
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-heart"></i>
                    <span>CPRCVF Admin</span>
                </div>
            </div>
            <nav class="sidebar-menu">
                <div class="menu-section">
                    <h4>Navigare Principală</h4>
                    <a href="dashboard.php" class="menu-item">
                        <i class="fas fa-tachometer-alt"></i>
                        Tablou de Bord
                    </a>
                    <a href="manage.php?page=index" class="menu-item">
                        <i class="fas fa-home"></i>
                        Pagina Principală
                    </a>
                    <a href="manage.php?page=services" class="menu-item">
                        <i class="fas fa-hands-helping"></i>
                        Servicii
                    </a>
                    <a href="messages.php" class="menu-item active">
                        <i class="fas fa-envelope"></i>
                        Mesaje Contact
                        <?php if ($unread_messages > 0): ?>
                        <span class="notification-badge"><?php echo $unread_messages; ?></span>
                        <?php endif; ?>
                    </a>
                </div>
                <div class="menu-section">
                    <h4>Setări</h4>
                    <a href="settings.php" class="menu-item">
                        <i class="fas fa-cog"></i>
                        Configurare
                    </a>
                    <a href="backups.php" class="menu-item">
                        <i class="fas fa-download"></i>
                        Backup-uri
                    </a>
                </div>
            </nav>
            <div class="sidebar-footer">
                <div class="user-info">
                    <i class="fas fa-user"></i>
                    <span>Administrator</span>
                </div>
                <a href="logout.php" class="menu-item">
                    <i class="fas fa-sign-out-alt"></i>
                    Delogare
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <header class="admin-header">
                <div class="header-left">
                    <h1><i class="fas fa-envelope"></i> Mesaje Contact</h1>
                    <p>Gestionează mesajele primite prin formularul de contact</p>
                </div>
                <div class="header-right">
                    <div class="header-info">
                        <div class="date-time" id="currentDateTime"></div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <div class="admin-content">
                <!-- Stats -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $total_messages; ?></h3>
                            <p>Total Mesaje</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-envelope-open"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $unread_messages; ?></h3>
                            <p>Mesaje Necitite</p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $total_messages - $unread_messages; ?></h3>
                            <p>Mesaje Citite</p>
                        </div>
                    </div>
                </div>

                <!-- Messages List -->
                <div class="content-card">
                    <div class="card-header">
                        <h3><i class="fas fa-list"></i> Lista Mesajelor</h3>
                        <div class="card-actions">
                            <?php if (!empty($messages)): ?>
                            <button class="btn btn-secondary" id="selectAllBtn">
                                <i class="fas fa-check-square"></i>
                                Selectează Tot
                            </button>
                            <button class="btn btn-primary" id="bulkReadBtn" disabled>
                                <i class="fas fa-envelope-open"></i>
                                Marchează Citite
                            </button>
                            <button class="btn btn-danger" id="bulkDeleteBtn" disabled>
                                <i class="fas fa-trash"></i>
                                Șterge Selectate
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="card-content">
                        <?php if (empty($messages)): ?>
                        <div class="empty-state">
                            <i class="fas fa-inbox"></i>
                            <h4>Nu există mesaje</h4>
                            <p>Nu au fost primite încă mesaje prin formularul de contact.</p>
                        </div>
                        <?php else: ?>
                        <form id="bulkActionForm" method="POST">
                            <div class="messages-list">
                                <?php foreach ($messages as $message): ?>
                                <div class="message-item <?php echo !$message['read'] ? 'unread' : ''; ?>">
                                    <div class="message-header">
                                        <div class="message-select">
                                            <input type="checkbox" name="selected_messages[]" value="<?php echo htmlspecialchars($message['id']); ?>" class="message-checkbox">
                                        </div>
                                        <div class="message-status">
                                            <?php if (!$message['read']): ?>
                                            <span class="status-badge new">Nou</span>
                                            <?php else: ?>
                                            <span class="status-badge read">Citit</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="message-meta">
                                            <strong><?php echo htmlspecialchars($message['name']); ?></strong>
                                            <span class="message-email"><?php echo htmlspecialchars($message['email']); ?></span>
                                            <?php if (!empty($message['phone'])): ?>
                                            <span class="message-phone"><?php echo htmlspecialchars($message['phone']); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="message-date">
                                            <?php echo date('d.m.Y H:i', strtotime($message['date'])); ?>
                                        </div>
                                        <div class="message-actions">
                                            <?php if (!$message['read']): ?>
                                            <form method="POST" style="display: inline;">
                                                <input type="hidden" name="action" value="mark_read">
                                                <input type="hidden" name="message_id" value="<?php echo htmlspecialchars($message['id']); ?>">
                                                <button type="submit" class="btn btn-sm btn-primary" title="Marchează ca citit">
                                                    <i class="fas fa-envelope-open"></i>
                                                </button>
                                            </form>
                                            <?php else: ?>
                                            <form method="POST" style="display: inline;">
                                                <input type="hidden" name="action" value="mark_unread">
                                                <input type="hidden" name="message_id" value="<?php echo htmlspecialchars($message['id']); ?>">
                                                <button type="submit" class="btn btn-sm btn-secondary" title="Marchează ca necitit">
                                                    <i class="fas fa-envelope"></i>
                                                </button>
                                            </form>
                                            <?php endif; ?>
                                            <form method="POST" style="display: inline;" onsubmit="return confirm('Ești sigur că vrei să ștergi acest mesaj?');">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="message_id" value="<?php echo htmlspecialchars($message['id']); ?>">
                                                <button type="submit" class="btn btn-sm btn-danger" title="Șterge mesajul">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="message-subject">
                                        <strong>Subiect:</strong> <?php echo htmlspecialchars($message['subject']); ?>
                                    </div>
                                    <div class="message-content">
                                        <div class="message-text">
                                            <?php echo nl2br(htmlspecialchars($message['message'])); ?>
                                        </div>
                                    </div>
                                    <div class="message-footer">
                                        <div class="message-ip">
                                            <i class="fas fa-globe"></i>
                                            IP: <?php echo htmlspecialchars($message['ip']); ?>
                                        </div>
                                        <div class="contact-actions">
                                            <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>" class="btn btn-sm btn-primary">
                                                <i class="fas fa-reply"></i>
                                                Răspunde prin Email
                                            </a>
                                            <?php if (!empty($message['phone'])): ?>
                                            <a href="tel:<?php echo htmlspecialchars($message['phone']); ?>" class="btn btn-sm btn-secondary">
                                                <i class="fas fa-phone"></i>
                                                Sună
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="assets/admin.js"></script>
    <script>
        // Bulk actions functionality
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllBtn = document.getElementById('selectAllBtn');
            const bulkReadBtn = document.getElementById('bulkReadBtn');
            const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
            const checkboxes = document.querySelectorAll('.message-checkbox');
            const bulkForm = document.getElementById('bulkActionForm');
            
            if (selectAllBtn) {
                let allSelected = false;
                
                selectAllBtn.addEventListener('click', function() {
                    allSelected = !allSelected;
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = allSelected;
                    });
                    updateBulkButtons();
                    
                    this.innerHTML = allSelected ? 
                        '<i class="fas fa-square"></i> Deselectează Tot' : 
                        '<i class="fas fa-check-square"></i> Selectează Tot';
                });
                
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', updateBulkButtons);
                });
                
                bulkReadBtn.addEventListener('click', function() {
                    const selected = getSelectedMessages();
                    if (selected.length > 0) {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'action';
                        input.value = 'bulk_mark_read';
                        bulkForm.appendChild(input);
                        bulkForm.submit();
                    }
                });
                
                bulkDeleteBtn.addEventListener('click', function() {
                    const selected = getSelectedMessages();
                    if (selected.length > 0) {
                        if (confirm(`Ești sigur că vrei să ștergi ${selected.length} mesaje?`)) {
                            const input = document.createElement('input');
                            input.type = 'hidden';
                            input.name = 'action';
                            input.value = 'bulk_delete';
                            bulkForm.appendChild(input);
                            bulkForm.submit();
                        }
                    }
                });
            }
            
            function updateBulkButtons() {
                const selected = getSelectedMessages();
                const hasSelection = selected.length > 0;
                
                if (bulkReadBtn) bulkReadBtn.disabled = !hasSelection;
                if (bulkDeleteBtn) bulkDeleteBtn.disabled = !hasSelection;
            }
            
            function getSelectedMessages() {
                return Array.from(checkboxes).filter(cb => cb.checked);
            }
        });
    </script>
</body>
</html>
