<?php
session_start();
require_once '../config/admin_config.php';
require_once 'includes/auth.php';
require_once 'includes/content_manager.php';

checkAuth();

$contentManager = new ContentManager();
$success = '';
$error = '';

// Handle actions
if ($_POST) {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'create_backup':
            if ($contentManager->createBackup()) {
                $success = 'Backup-ul a fost creat cu succes!';
            } else {
                $error = 'Eroare la crearea backup-ului.';
            }
            break;
            
        case 'restore_backup':
            $filename = $_POST['filename'] ?? '';
            if ($contentManager->restoreBackup($filename)) {
                $success = 'Configurația a fost restaurată cu succes din backup!';
            } else {
                $error = 'Eroare la restaurarea backup-ului.';
            }
            break;
            
        case 'delete_backup':
            $filename = $_POST['filename'] ?? '';
            $backupFile = BACKUP_DIR . $filename;
            if (file_exists($backupFile) && unlink($backupFile)) {
                $success = 'Backup-ul a fost șters cu succes!';
                $contentManager->logActivity("Backup deleted: " . $filename, 'fa-trash');
            } else {
                $error = 'Eroare la ștergerea backup-ului.';
            }
            break;
    }
}

$backups = $contentManager->getBackups();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backup-uri - Panou Admin</title>
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
                    <a href="settings.php" class="menu-item">
                        <i class="fas fa-cog"></i>
                        <span>Setări</span>
                    </a>
                    <a href="backups.php" class="menu-item active">
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
                    <h1><i class="fas fa-database"></i> Gestionare Backup-uri</h1>
                    <p>Creează și gestionează backup-urile configurației</p>
                </div>
                <div class="header-right">
                    <form method="POST" style="display: inline;">
                        <input type="hidden" name="action" value="create_backup">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-plus"></i>
                            Creează Backup
                        </button>
                    </form>
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
                
                <div class="content-card">
                    <div class="card-header">
                        <h3><i class="fas fa-list"></i> Lista Backup-uri</h3>
                        <div class="card-actions">
                            <span class="info-text">
                                <i class="fas fa-info-circle"></i>
                                Total: <?php echo count($backups); ?> backup-uri
                            </span>
                        </div>
                    </div>
                    
                    <div class="card-content">
                        <?php if (empty($backups)): ?>
                            <div class="empty-state">
                                <i class="fas fa-database"></i>
                                <h4>Nu există backup-uri</h4>
                                <p>Creează primul backup pentru a proteja configurația site-ului.</p>
                                <form method="POST">
                                    <input type="hidden" name="action" value="create_backup">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-plus"></i>
                                        Creează Primul Backup
                                    </button>
                                </form>
                            </div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="data-table">
                                    <thead>
                                        <tr>
                                            <th><i class="fas fa-file"></i> Nume Fișier</th>
                                            <th><i class="fas fa-calendar"></i> Data Creării</th>
                                            <th><i class="fas fa-weight"></i> Dimensiune</th>
                                            <th><i class="fas fa-cogs"></i> Acțiuni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($backups as $backup): ?>
                                            <tr>
                                                <td>
                                                    <div class="file-info">
                                                        <i class="fas fa-file-archive"></i>
                                                        <span><?php echo htmlspecialchars($backup['filename']); ?></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="date-info">
                                                        <span class="date"><?php echo date('d.m.Y', $backup['date']); ?></span>
                                                        <span class="time"><?php echo date('H:i:s', $backup['date']); ?></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="file-size">
                                                        <?php echo number_format($backup['size'] / 1024, 2); ?> KB
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="action-buttons">
                                                        <form method="POST" style="display: inline;">
                                                            <input type="hidden" name="action" value="restore_backup">
                                                            <input type="hidden" name="filename" value="<?php echo htmlspecialchars($backup['filename']); ?>">
                                                            <button type="submit" class="btn btn-success btn-sm" 
                                                                    onclick="return confirm('Ești sigur că vrei să restaurezi acest backup? Configurația actuală va fi suprascrisă.')">
                                                                <i class="fas fa-undo"></i>
                                                                Restaurează
                                                            </button>
                                                        </form>
                                                        
                                                        <a href="../backups/<?php echo htmlspecialchars($backup['filename']); ?>" 
                                                           class="btn btn-info btn-sm" download>
                                                            <i class="fas fa-download"></i>
                                                            Descarcă
                                                        </a>
                                                        
                                                        <form method="POST" style="display: inline;">
                                                            <input type="hidden" name="action" value="delete_backup">
                                                            <input type="hidden" name="filename" value="<?php echo htmlspecialchars($backup['filename']); ?>">
                                                            <button type="submit" class="btn btn-danger btn-sm" 
                                                                    onclick="return confirm('Ești sigur că vrei să ștergi acest backup?')">
                                                                <i class="fas fa-trash"></i>
                                                                Șterge
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Backup Information -->
                <div class="content-card">
                    <div class="card-header">
                        <h3><i class="fas fa-info"></i> Informații Backup</h3>
                    </div>
                    <div class="card-content">
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Protecție Automată</h4>
                                    <p>Un backup automat este creat înainte de fiecare modificare a configurației.</p>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-history"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Restaurare Rapidă</h4>
                                    <p>Poți restaura rapid configurația la orice versiune anterioară din listă.</p>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-icon">
                                    <i class="fas fa-download"></i>
                                </div>
                                <div class="info-content">
                                    <h4>Descărcare Locală</h4>
                                    <p>Descarcă backup-urile pentru a le păstra local ca măsură de siguranță.</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="warning-box">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <h4>Atenție!</h4>
                                <p>Restaurarea unui backup va suprascrie configurația actuală. Asigură-te că ai creat un backup recent înainte de restaurare.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script src="assets/admin.js"></script>
</body>
</html>
