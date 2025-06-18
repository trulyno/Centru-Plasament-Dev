<?php
session_start();
require_once '../config/admin_config.php';
require_once 'includes/auth.php';
require_once 'includes/content_manager.php';

// Check authentication
checkAuth();

$contentManager = new ContentManager();
$stats = $contentManager->getStats();
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Panou Admin</title>
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
                <a href="dashboard.php" class="menu-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                
                <div class="menu-section">
                    <h4>Gestionare Conținut</h4>
                    <?php foreach ($ADMIN_PAGES as $key => $page): ?>
                        <a href="manage.php?page=<?php echo $key; ?>" class="menu-item">
                            <i class="fas <?php echo $page['icon']; ?>"></i>
                            <span><?php echo $page['name']; ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
                
                <div class="menu-section">
                    <h4>Sistem</h4>
                    <a href="settings.php" class="menu-item">
                        <i class="fas fa-cog"></i>
                        <span>Setări</span>
                    </a>
                    <a href="backups.php" class="menu-item">
                        <i class="fas fa-database"></i>
                        <span>Backup-uri</span>
                    </a>
                    <a href="logs.php" class="menu-item">
                        <i class="fas fa-clipboard-list"></i>
                        <span>Jurnale</span>
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
                    <h1>Dashboard</h1>
                    <p>Bun venit în panoul de administrare</p>
                </div>
                <div class="header-right">
                    <div class="header-info">
                        <span class="date-time" id="currentDateTime"></span>
                    </div>
                </div>
            </div>
            
            <div class="admin-content">
                <!-- Stats Cards -->
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $stats['total_pages']; ?></h3>
                            <p>Pagini Totale</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-hands-helping"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $stats['services_count']; ?></h3>
                            <p>Servicii Active</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-images"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $stats['images_count']; ?></h3>
                            <p>Imagini</p>
                        </div>
                    </div>
                    
                    <div class="stat-card">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3><?php echo $stats['last_backup']; ?></h3>
                            <p>Ultimul Backup</p>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Actions -->
                <div class="dashboard-grid">
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3><i class="fas fa-bolt"></i> Acțiuni Rapide</h3>
                        </div>
                        <div class="card-content">
                            <div class="quick-actions">
                                <a href="manage.php?page=index" class="action-btn primary">
                                    <i class="fas fa-home"></i>
                                    <span>Editează Pagina Principală</span>
                                </a>
                                <a href="manage.php?page=services" class="action-btn secondary">
                                    <i class="fas fa-hands-helping"></i>
                                    <span>Gestionează Servicii</span>
                                </a>
                                <a href="manage.php?page=galerie" class="action-btn tertiary">
                                    <i class="fas fa-images"></i>
                                    <span>Actualizează Galeria</span>
                                </a>
                                <a href="backups.php" class="action-btn warning">
                                    <i class="fas fa-database"></i>
                                    <span>Creează Backup</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="dashboard-card">
                        <div class="card-header">
                            <h3><i class="fas fa-chart-line"></i> Activitate Recentă</h3>
                        </div>
                        <div class="card-content">
                            <div class="activity-log">
                                <?php
                                $recentActivity = $contentManager->getRecentActivity();
                                if (empty($recentActivity)): ?>
                                    <div class="no-activity">
                                        <i class="fas fa-info-circle"></i>
                                        <p>Nu există activitate recentă</p>
                                    </div>
                                <?php else: ?>
                                    <?php foreach ($recentActivity as $activity): ?>
                                        <div class="activity-item">
                                            <div class="activity-icon">
                                                <i class="fas <?php echo $activity['icon']; ?>"></i>
                                            </div>
                                            <div class="activity-content">
                                                <p><?php echo htmlspecialchars($activity['description']); ?></p>
                                                <span class="activity-time"><?php echo $activity['time']; ?></span>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- System Status -->
                <div class="dashboard-card">
                    <div class="card-header">
                        <h3><i class="fas fa-server"></i> Status Sistem</h3>
                    </div>
                    <div class="card-content">
                        <div class="system-status">
                            <div class="status-item">
                                <div class="status-indicator success"></div>
                                <span>Server Web: Online</span>
                            </div>
                            <div class="status-item">
                                <div class="status-indicator success"></div>
                                <span>Fișier Configurare: Disponibil</span>
                            </div>
                            <div class="status-item">
                                <div class="status-indicator <?php echo file_exists(BACKUP_DIR) ? 'success' : 'error'; ?>"></div>
                                <span>Director Backup: <?php echo file_exists(BACKUP_DIR) ? 'Disponibil' : 'Indisponibil'; ?></span>
                            </div>
                            <div class="status-item">
                                <div class="status-indicator success"></div>
                                <span>Sesiune: Activă</span>
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
