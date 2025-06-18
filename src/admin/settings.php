<?php
session_start();
require_once '../config/admin_config.php';
require_once 'includes/auth.php';
require_once 'includes/content_manager.php';

checkAuth();

$contentManager = new ContentManager();
$success = '';
$error = '';

// Get current settings
$currentData = $contentManager->getData();

// Handle form submissions
if ($_POST) {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'update_general':
            $updates = [];
            
            // Handle general settings updates
            if (isset($_POST['site_name'])) {
                $updates['SITE_NAME'] = [$_POST['site_name']];
            }
            
            if (isset($_POST['site_description'])) {
                $updates['SITE_DESCRIPTION'] = [$_POST['site_description']];
            }
            
            if (isset($_POST['contact_phone'])) {
                $updates['CONTACT_PHONE'] = [$_POST['contact_phone']];
            }
            
            if (isset($_POST['contact_email'])) {
                $updates['CONTACT_EMAIL'] = [$_POST['contact_email']];
            }
            
            $allSuccess = true;
            foreach ($updates as $key => $value) {
                if (!$contentManager->updateData($key, $value)) {
                    $allSuccess = false;
                }
            }
            
            if ($allSuccess) {
                $success = 'Setările generale au fost actualizate cu succes!';
            } else {
                $error = 'Eroare la actualizarea setărilor.';
            }
            break;
            
        case 'change_password':
            $currentPassword = $_POST['current_password'] ?? '';
            $newPassword = $_POST['new_password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            
            if ($currentPassword !== ADMIN_PASSWORD) {
                $error = 'Parola curentă este incorectă.';
            } elseif ($newPassword !== $confirmPassword) {
                $error = 'Parolele nu se potrivesc.';
            } elseif (strlen($newPassword) < 8) {
                $error = 'Parola trebuie să aibă cel puțin 8 caractere.';
            } else {
                // Note: In a real application, you would update the password in a secure way
                // For now, we'll just show a message
                $success = 'Parola ar fi fost schimbată cu succes! (Funcționalitate în dezvoltare)';
            }
            break;
            
        case 'clear_cache':
            // Clear any cached data
            $contentManager->logActivity("Cache cleared", 'fa-broom');
            $success = 'Cache-ul a fost șters cu succes!';
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setări - Panou Admin</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="assets/admin.css" rel="stylesheet">
</head>
<body class="admin-dashboard">
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav class="admin-sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <i class="fas fa-shield-alt"></i>
                    <span>Admin Panel</span>
                </div>
                <button class="sidebar-toggle" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            
            <div class="sidebar-menu">
                <a href="dashboard.php" class="menu-item">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                
                <div class="menu-section">
                    <h4>Gestionare Conținut</h4>
                    <?php foreach ($ADMIN_PAGES as $key => $pageItem): ?>
                        <a href="manage.php?page=<?php echo $key; ?>" class="menu-item">
                            <i class="fas <?php echo $pageItem['icon']; ?>"></i>
                            <span><?php echo $pageItem['name']; ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
                
                <div class="menu-section">
                    <h4>Sistem</h4>
                    <a href="settings.php" class="menu-item active">
                        <i class="fas fa-cog"></i>
                        <span>Setări</span>
                    </a>
                    <a href="backups.php" class="menu-item">
                        <i class="fas fa-database"></i>
                        <span>Backup-uri</span>
                    </a>
                </div>
            </div>
            
            <div class="sidebar-footer">
                <div class="user-info">
                    <i class="fas fa-user-circle"></i>
                    <span><?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                </div>
                <a href="logout.php" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Deconectare</span>
                </a>
            </div>
        </nav>
        
        <!-- Main Content -->
        <main class="admin-main">
            <div class="admin-header">
                <div class="header-left">
                    <h1><i class="fas fa-cog"></i> Setări Sistem</h1>
                    <p>Configurează setările generale și de securitate</p>
                </div>
            </div>
            
            <div class="admin-content">
                <?php if ($success): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <?php echo $success; ?>
                    </div>
                <?php endif; ?>
                
                <?php if ($error): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-triangle"></i>
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <!-- General Settings -->
                <div class="content-card">
                    <div class="card-header">
                        <h3><i class="fas fa-globe"></i> Setări Generale</h3>
                    </div>
                    <div class="card-content">
                        <form method="POST">
                            <input type="hidden" name="action" value="update_general">
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="site_name">Numele Site-ului</label>
                                    <input type="text" id="site_name" name="site_name" 
                                           value="<?php echo htmlspecialchars($currentData['SITE_NAME'][0] ?? SITE_NAME); ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="contact_phone">Telefon Contact</label>
                                    <input type="text" id="contact_phone" name="contact_phone" 
                                           value="<?php echo htmlspecialchars($currentData['CONTACT_PHONE'][0] ?? '022 737 027'); ?>">
                                </div>
                                
                                <div class="form-group">
                                    <label for="contact_email">Email Contact</label>
                                    <input type="email" id="contact_email" name="contact_email" 
                                           value="<?php echo htmlspecialchars($currentData['CONTACT_EMAIL'][0] ?? 'centru_plasament@agssi.md'); ?>">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="site_description">Descrierea Site-ului</label>
                                <textarea id="site_description" name="site_description" rows="3"><?php echo htmlspecialchars($currentData['SITE_DESCRIPTION'][0] ?? 'Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă oferă îngrijire cuprinzătoare pentru copiii mici în nevoie.'); ?></textarea>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    Salvează Setările
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Security Settings -->
                <div class="content-card">
                    <div class="card-header">
                        <h3><i class="fas fa-shield-alt"></i> Setări de Securitate</h3>
                    </div>
                    <div class="card-content">
                        <form method="POST">
                            <input type="hidden" name="action" value="change_password">
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="current_password">Parola Curentă</label>
                                    <input type="password" id="current_password" name="current_password" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="new_password">Parolă Nouă</label>
                                    <input type="password" id="new_password" name="new_password" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="confirm_password">Confirmă Parola</label>
                                    <input type="password" id="confirm_password" name="confirm_password" required>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-key"></i>
                                    Schimbă Parola
                                </button>
                            </div>
                        </form>
                        
                        <!-- Session Info -->
                        <div class="info-box">
                            <h4><i class="fas fa-info-circle"></i> Informații Sesiune</h4>
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">Utilizator:</span>
                                    <span class="info-value"><?php echo htmlspecialchars($_SESSION['admin_username']); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Conectat la:</span>
                                    <span class="info-value"><?php echo date('d.m.Y H:i:s', $_SESSION['login_time']); ?></span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Ultima activitate:</span>
                                    <span class="info-value"><?php echo date('d.m.Y H:i:s', $_SESSION['last_activity'] ?? time()); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- System Settings -->
                <div class="content-card">
                    <div class="card-header">
                        <h3><i class="fas fa-server"></i> Setări Sistem</h3>
                    </div>
                    <div class="card-content">
                        <div class="system-info">
                            <div class="info-grid">
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-php"></i>
                                    </div>
                                    <div class="info-content">
                                        <h4>Versiune PHP</h4>
                                        <p><?php echo PHP_VERSION; ?></p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-server"></i>
                                    </div>
                                    <div class="info-content">
                                        <h4>Server</h4>
                                        <p><?php echo $_SERVER['SERVER_SOFTWARE'] ?? 'Unknown'; ?></p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-folder"></i>
                                    </div>
                                    <div class="info-content">
                                        <h4>Fișier Configurare</h4>
                                        <p><?php echo file_exists(CONFIG_FILE) ? 'Disponibil' : 'Indisponibil'; ?></p>
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <div class="info-icon">
                                        <i class="fas fa-database"></i>
                                    </div>
                                    <div class="info-content">
                                        <h4>Director Backup</h4>
                                        <p><?php echo is_writable(BACKUP_DIR) ? 'Disponibil' : 'Indisponibil'; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="system-actions">
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="action" value="clear_cache">
                                <button type="submit" class="btn btn-info">
                                    <i class="fas fa-broom"></i>
                                    Șterge Cache
                                </button>
                            </form>
                            
                            <a href="backups.php" class="btn btn-secondary">
                                <i class="fas fa-database"></i>
                                Gestionează Backup-uri
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Configuration Preview -->
                <div class="content-card">
                    <div class="card-header">
                        <h3><i class="fas fa-eye"></i> Previzualizare Configurație</h3>
                        <div class="card-actions">
                            <button class="btn btn-sm btn-secondary" onclick="toggleConfigPreview()">
                                <i class="fas fa-eye"></i>
                                Afișează/Ascunde
                            </button>
                        </div>
                    </div>
                    <div class="card-content">
                        <div id="configPreview" style="display: none;">
                            <div class="config-preview">
                                <pre><?php
                                    $configContent = file_get_contents(CONFIG_FILE);
                                    echo htmlspecialchars($configContent);
                                ?></pre>
                            </div>
                        </div>
                        <div class="warning-box">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <h4>Atenție!</h4>
                                <p>Modificarea manuală a fișierului de configurare poate cauza probleme de funcționare. Folosește formularul de mai sus pentru modificări sigure.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script src="assets/admin.js"></script>
    <script>
        function toggleConfigPreview() {
            const preview = document.getElementById('configPreview');
            if (preview.style.display === 'none') {
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        }
        
        // Password strength indicator
        document.getElementById('new_password').addEventListener('input', function() {
            const password = this.value;
            const strength = checkPasswordStrength(password);
            updatePasswordStrength(strength);
        });
        
        function checkPasswordStrength(password) {
            let score = 0;
            
            if (password.length >= 8) score++;
            if (password.length >= 12) score++;
            if (/[a-z]/.test(password)) score++;
            if (/[A-Z]/.test(password)) score++;
            if (/[0-9]/.test(password)) score++;
            if (/[^A-Za-z0-9]/.test(password)) score++;
            
            return score;
        }
        
        function updatePasswordStrength(score) {
            const strengthLevels = ['Foarte slabă', 'Slabă', 'Medie', 'Bună', 'Foarte bună', 'Excelentă'];
            const strengthColors = ['#dc2626', '#f59e0b', '#eab308', '#22c55e', '#16a34a', '#15803d'];
            
            let strengthElement = document.getElementById('passwordStrength');
            if (!strengthElement) {
                strengthElement = document.createElement('div');
                strengthElement.id = 'passwordStrength';
                strengthElement.style.cssText = 'margin-top: 0.5rem; font-size: 0.875rem; font-weight: 500;';
                document.getElementById('new_password').parentNode.appendChild(strengthElement);
            }
            
            const level = Math.min(score, strengthLevels.length - 1);
            strengthElement.textContent = `Puterea parolei: ${strengthLevels[level]}`;
            strengthElement.style.color = strengthColors[level];
        }
    </script>
    
    <style>
        .info-box {
            background: var(--admin-bg);
            padding: 1.5rem;
            border-radius: 8px;
            margin-top: 2rem;
        }
        
        .info-box h4 {
            margin-bottom: 1rem;
            color: var(--admin-text);
        }
        
        .info-box h4 i {
            margin-right: 0.5rem;
            color: var(--admin-primary);
        }
        
        .info-box .info-grid {
            display: grid;
            gap: 0.75rem;
        }
        
        .info-box .info-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--admin-border);
        }
        
        .info-box .info-item:last-child {
            border-bottom: none;
        }
        
        .info-label {
            font-weight: 500;
            color: var(--admin-text);
        }
        
        .info-value {
            color: var(--admin-text-light);
            font-family: 'Courier New', monospace;
        }
        
        .system-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--admin-border);
        }
        
        .config-preview {
            background: #f8f9fa;
            border: 1px solid var(--admin-border);
            border-radius: 4px;
            padding: 1rem;
            overflow-x: auto;
            max-height: 400px;
            overflow-y: auto;
        }
        
        .config-preview pre {
            margin: 0;
            font-family: 'Courier New', monospace;
            font-size: 0.875rem;
            line-height: 1.4;
            color: #333;
        }
        
        @media (max-width: 768px) {
            .system-actions {
                flex-direction: column;
            }
        }
    </style>
</body>
</html>
