<?php
session_start();
require_once '../config/admin_config.php';
require_once 'includes/auth.php';
require_once 'includes/content_manager.php';

checkAuth();

$contentManager = new ContentManager();
$page = $_GET['page'] ?? 'index';

if (!isset($ADMIN_PAGES[$page])) {
    header('Location: dashboard.php');
    exit();
}

$pageInfo = $ADMIN_PAGES[$page];
$success = '';
$error = '';

// Handle form submissions
if ($_POST) {
    $action = $_POST['action'] ?? '';
    
    switch ($action) {
        case 'update_services':
            $services = $_POST['services'] ?? [];
            $names = $_POST['names'] ?? [];
            $namesShort = $_POST['names_short'] ?? [];
            $images = $_POST['images'] ?? [];
            $descriptions = $_POST['descriptions'] ?? [];
            
            // Validate data
            $errors = [];
            $errors = array_merge($errors, $contentManager->validateData('SERVICES', $services));
            $errors = array_merge($errors, $contentManager->validateData('SERVICES_NAMES', $names));
            $errors = array_merge($errors, $contentManager->validateData('SERVICES_NAMES_SHORT', $namesShort));
            $errors = array_merge($errors, $contentManager->validateData('SERVICES_IMAGES', $images));
            
            if (empty($errors)) {
                $success = $contentManager->updateData('SERVICES', $services) &&
                          $contentManager->updateData('SERVICES_NAMES', $names) &&
                          $contentManager->updateData('SERVICES_NAMES_SHORT', $namesShort) &&
                          $contentManager->updateData('SERVICES_IMAGES', $images) &&
                          $contentManager->updateData('SERVICES_DESCRIPTION', $descriptions);
                
                if ($success) {
                    $success = 'Serviciile au fost actualizate cu succes!';
                } else {
                    $error = 'Eroare la salvarea datelor.';
                }
            } else {
                $error = implode('<br>', $errors);
            }
            break;
            
        case 'add_service':
            $newService = $_POST['new_service'] ?? '';
            $newName = $_POST['new_name'] ?? '';
            $newNameShort = $_POST['new_name_short'] ?? '';
            $newImage = $_POST['new_image'] ?? '';
            $newDescription = $_POST['new_description'] ?? '';
            
            if (!empty($newService) && !empty($newName)) {
                $success = $contentManager->addItem('SERVICES', $newService) &&
                          $contentManager->addItem('SERVICES_NAMES', $newName) &&
                          $contentManager->addItem('SERVICES_NAMES_SHORT', $newNameShort) &&
                          $contentManager->addItem('SERVICES_IMAGES', $newImage) &&
                          $contentManager->addItem('SERVICES_DESCRIPTION', $newDescription);
                
                if ($success) {
                    $success = 'Serviciul a fost adăugat cu succes!';
                } else {
                    $error = 'Eroare la adăugarea serviciului.';
                }
            } else {
                $error = 'Numele serviciului și identificatorul sunt obligatorii.';
            }
            break;
            
        case 'delete_service':
            $index = intval($_POST['index'] ?? -1);
            if ($index >= 0) {
                $success = $contentManager->removeItem('SERVICES', $index) &&
                          $contentManager->removeItem('SERVICES_NAMES', $index) &&
                          $contentManager->removeItem('SERVICES_NAMES_SHORT', $index) &&
                          $contentManager->removeItem('SERVICES_IMAGES', $index) &&
                          $contentManager->removeItem('SERVICES_DESCRIPTION', $index);
                
                if ($success) {
                    $success = 'Serviciul a fost șters cu succes!';
                } else {
                    $error = 'Eroare la ștergerea serviciului.';
                }
            }
            break;
    }
}

// Get current data
$services = $contentManager->getData('SERVICES');
$names = $contentManager->getData('SERVICES_NAMES');
$namesShort = $contentManager->getData('SERVICES_NAMES_SHORT');
$images = $contentManager->getData('SERVICES_IMAGES');
$descriptions = $contentManager->getData('SERVICES_DESCRIPTION');

// Get available images
$availableImages = [];
$imageDir = '../images/';
if (is_dir($imageDir)) {
    $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    foreach ($extensions as $ext) {
        $imageFiles = glob($imageDir . '*.' . $ext);
        if ($imageFiles) {
            foreach ($imageFiles as $imageFile) {
                $availableImages[] = basename($imageFile);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionare <?php echo htmlspecialchars($pageInfo['name']); ?> - Panou Admin</title>
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
                        <a href="manage.php?page=<?php echo $key; ?>" class="menu-item <?php echo $key === $page ? 'active' : ''; ?>">
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
                    <h1>
                        <i class="fas <?php echo $pageInfo['icon']; ?>"></i>
                        <?php echo htmlspecialchars($pageInfo['name']); ?>
                    </h1>
                    <p>Gestionare conținut pentru <?php echo htmlspecialchars($pageInfo['name']); ?></p>
                </div>
                <div class="header-right">
                    <a href="dashboard.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        Înapoi la Dashboard
                    </a>
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
                
                <?php if ($page === 'services'): ?>
                    <!-- Services Management -->
                    <div class="content-card">
                        <div class="card-header">
                            <h3><i class="fas fa-hands-helping"></i> Gestionare Servicii</h3>
                            <button class="btn btn-primary" onclick="toggleAddService()">
                                <i class="fas fa-plus"></i>
                                Adaugă Serviciu
                            </button>
                        </div>
                        
                        <!-- Add New Service Form -->
                        <div id="addServiceForm" class="add-form" style="display: none;">
                            <form method="POST">
                                <input type="hidden" name="action" value="add_service">
                                <div class="form-grid">
                                    <div class="form-group">
                                        <label>Identificator Serviciu</label>
                                        <input type="text" name="new_service" placeholder="ex: sectia-noua" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nume Complet</label>
                                        <input type="text" name="new_name" placeholder="ex: Secția Nouă" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Nume Scurt</label>
                                        <input type="text" name="new_name_short" placeholder="ex: Secția Nouă">
                                    </div>
                                    <div class="form-group">
                                        <label>Imagine</label>
                                        <select name="new_image">
                                            <option value="">Selectează imagine...</option>
                                            <?php foreach ($availableImages as $image): ?>
                                                <option value="<?php echo htmlspecialchars($image); ?>">
                                                    <?php echo htmlspecialchars($image); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Descriere</label>
                                    <textarea name="new_description" rows="4" placeholder="Descrierea serviciului..."></textarea>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i>
                                        Adaugă Serviciu
                                    </button>
                                    <button type="button" class="btn btn-secondary" onclick="toggleAddService()">
                                        <i class="fas fa-times"></i>
                                        Anulează
                                    </button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- Services List -->
                        <form method="POST" class="services-form">
                            <input type="hidden" name="action" value="update_services">
                            
                            <div class="services-list">
                                <?php for ($i = 0; $i < count($services); $i++): ?>
                                    <div class="service-item">
                                        <div class="service-header">
                                            <h4>Serviciul #<?php echo $i + 1; ?></h4>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="deleteService(<?php echo $i; ?>)">
                                                <i class="fas fa-trash"></i>
                                                Șterge
                                            </button>
                                        </div>
                                        
                                        <div class="form-grid">
                                            <div class="form-group">
                                                <label>Identificator</label>
                                                <input type="text" name="services[]" value="<?php echo htmlspecialchars($services[$i] ?? ''); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nume Complet</label>
                                                <input type="text" name="names[]" value="<?php echo htmlspecialchars($names[$i] ?? ''); ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nume Scurt</label>
                                                <input type="text" name="names_short[]" value="<?php echo htmlspecialchars($namesShort[$i] ?? ''); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Imagine</label>
                                                <select name="images[]">
                                                    <option value="">Selectează imagine...</option>
                                                    <?php foreach ($availableImages as $image): ?>
                                                        <option value="<?php echo htmlspecialchars($image); ?>" 
                                                                <?php echo ($images[$i] ?? '') === $image ? 'selected' : ''; ?>>
                                                            <?php echo htmlspecialchars($image); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if (!empty($images[$i])): ?>
                                                    <div class="image-preview">
                                                        <img src="../images/<?php echo htmlspecialchars($images[$i]); ?>" 
                                                             alt="Preview" style="max-width: 100px; max-height: 100px;">
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Descriere</label>
                                            <textarea name="descriptions[]" rows="4"><?php echo htmlspecialchars($descriptions[$i] ?? ''); ?></textarea>
                                        </div>
                                    </div>
                                <?php endfor; ?>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    Salvează Modificările
                                </button>
                                <button type="button" class="btn btn-secondary" onclick="createBackup()">
                                    <i class="fas fa-database"></i>
                                    Creează Backup
                                </button>
                            </div>
                        </form>
                    </div>
                    
                <?php else: ?>
                    <!-- Other Pages Management -->
                    <div class="content-card">
                        <div class="card-header">
                            <h3><i class="fas fa-info-circle"></i> Gestionare Conținut</h3>
                        </div>
                        <div class="card-content">
                            <div class="placeholder-content">
                                <i class="fas fa-tools"></i>
                                <h4>Funcționalitate în Dezvoltare</h4>
                                <p>Gestionarea conținutului pentru <strong><?php echo htmlspecialchars($pageInfo['name']); ?></strong> va fi disponibilă în curând.</p>
                                <p>Secțiunile disponibile pentru această pagină:</p>
                                <ul>
                                    <?php foreach ($pageInfo['sections'] as $section): ?>
                                        <li><?php echo htmlspecialchars($section); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
    
    <!-- Delete Confirmation Modal -->
    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-exclamation-triangle"></i> Confirmare Ștergere</h3>
                <button class="modal-close" onclick="closeDeleteModal()">&times;</button>
            </div>
            <div class="modal-body">
                <p>Ești sigur că vrei să ștergi acest serviciu? Această acțiune nu poate fi anulată.</p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" onclick="confirmDelete()">
                    <i class="fas fa-trash"></i>
                    Șterge
                </button>
                <button class="btn btn-secondary" onclick="closeDeleteModal()">
                    <i class="fas fa-times"></i>
                    Anulează
                </button>
            </div>
        </div>
    </div>
    
    <script src="assets/admin.js"></script>
    <script>
        let deleteIndex = -1;
        
        function toggleAddService() {
            const form = document.getElementById('addServiceForm');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
        
        function deleteService(index) {
            deleteIndex = index;
            document.getElementById('deleteModal').style.display = 'block';
        }
        
        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
            deleteIndex = -1;
        }
        
        function confirmDelete() {
            if (deleteIndex >= 0) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.innerHTML = `
                    <input type="hidden" name="action" value="delete_service">
                    <input type="hidden" name="index" value="${deleteIndex}">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        }
        
        function createBackup() {
            // You can implement backup creation via AJAX here if needed
            alert('Backup-ul va fi creat automat la salvarea modificărilor.');
        }
    </script>
</body>
</html>
