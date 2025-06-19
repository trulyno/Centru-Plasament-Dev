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
            
        case 'update_homepage':
            $section = $_POST['section'] ?? '';
            
            switch ($section) {
                case 'hero':
                    $heroTitles = $_POST['hero_titles'] ?? [];
                    $heroDescriptions = $_POST['hero_descriptions'] ?? [];
                    $heroButtons = $_POST['hero_buttons'] ?? [];
                    $heroLinks = $_POST['hero_links'] ?? [];
                    $heroImages = $_POST['hero_images'] ?? [];
                    
                    $errors = [];
                    $errors = array_merge($errors, $contentManager->validateData('HERO_TITLES', $heroTitles));
                    $errors = array_merge($errors, $contentManager->validateData('HERO_DESCRIPTIONS', $heroDescriptions));
                    $errors = array_merge($errors, $contentManager->validateData('HERO_IMAGES', $heroImages));
                    
                    if (empty($errors)) {
                        $success = $contentManager->updateData('HERO_TITLES', $heroTitles) &&
                                  $contentManager->updateData('HERO_DESCRIPTIONS', $heroDescriptions) &&
                                  $contentManager->updateData('HERO_BUTTONS', $heroButtons) &&
                                  $contentManager->updateData('HERO_LINKS', $heroLinks) &&
                                  $contentManager->updateData('HERO_IMAGES', $heroImages);
                        
                        if ($success) {
                            $success = 'Secțiunea Hero a fost actualizată cu succes!';
                        } else {
                            $error = 'Eroare la salvarea datelor Hero.';
                        }
                    } else {
                        $error = implode('<br>', $errors);
                    }
                    break;
                    
                case 'about':
                    $aboutTitle = $_POST['about_title'] ?? '';
                    $aboutText1 = $_POST['about_text_1'] ?? '';
                    $aboutText2 = $_POST['about_text_2'] ?? '';
                    $aboutText3 = $_POST['about_text_3'] ?? '';
                    
                    $errors = [];
                    $errors = array_merge($errors, $contentManager->validateData('ABOUT_TITLE', [$aboutTitle]));
                    $errors = array_merge($errors, $contentManager->validateData('ABOUT_TEXT_1', [$aboutText1]));
                    $errors = array_merge($errors, $contentManager->validateData('ABOUT_TEXT_2', [$aboutText2]));
                    $errors = array_merge($errors, $contentManager->validateData('ABOUT_TEXT_3', [$aboutText3]));
                    
                    if (empty($errors)) {
                        $success = $contentManager->updateData('ABOUT_TITLE', [$aboutTitle]) &&
                                  $contentManager->updateData('ABOUT_TEXT_1', [$aboutText1]) &&
                                  $contentManager->updateData('ABOUT_TEXT_2', [$aboutText2]) &&
                                  $contentManager->updateData('ABOUT_TEXT_3', [$aboutText3]);
                        
                        if ($success) {
                            $success = 'Secțiunea Despre Noi a fost actualizată cu succes!';
                        } else {
                            $error = 'Eroare la salvarea datelor Despre Noi.';
                        }
                    } else {
                        $error = implode('<br>', $errors);
                    }
                    break;
                    
                case 'stats':
                    $statsValues = $_POST['stats_values'] ?? [];
                    $statsLabels = $_POST['stats_labels'] ?? [];
                    
                    $errors = [];
                    $errors = array_merge($errors, $contentManager->validateData('STATS_VALUES', $statsValues));
                    
                    if (empty($errors)) {
                        $success = $contentManager->updateData('STATS_VALUES', $statsValues) &&
                                  $contentManager->updateData('STATS_LABELS', $statsLabels);
                        
                        if ($success) {
                            $success = 'Statisticile au fost actualizate cu succes!';
                        } else {
                            $error = 'Eroare la salvarea statisticilor.';
                        }
                    } else {
                        $error = implode('<br>', $errors);
                    }
                    break;
                    
                case 'gallery':
                    $galleryTitles = $_POST['gallery_titles'] ?? [];
                    $galleryDescriptions = $_POST['gallery_descriptions'] ?? [];
                    $galleryImages = $_POST['gallery_images'] ?? [];
                    
                    $errors = [];
                    $errors = array_merge($errors, $contentManager->validateData('GALLERY_TITLES', $galleryTitles));
                    $errors = array_merge($errors, $contentManager->validateData('GALLERY_DESCRIPTIONS', $galleryDescriptions));
                    $errors = array_merge($errors, $contentManager->validateData('GALLERY_IMAGES', $galleryImages));
                    
                    if (empty($errors)) {
                        $success = $contentManager->updateData('GALLERY_TITLES', $galleryTitles) &&
                                  $contentManager->updateData('GALLERY_DESCRIPTIONS', $galleryDescriptions) &&
                                  $contentManager->updateData('GALLERY_IMAGES', $galleryImages);
                        
                        if ($success) {
                            $success = 'Galeria a fost actualizată cu succes!';
                        } else {
                            $error = 'Eroare la salvarea galeriei.';
                        }
                    } else {
                        $error = implode('<br>', $errors);
                    }
                    break;
                    
                case 'testimonials':
                    $testimonialQuotes = $_POST['testimonial_quotes'] ?? [];
                    $testimonialAuthors = $_POST['testimonial_authors'] ?? [];
                    $testimonialRoles = $_POST['testimonial_roles'] ?? [];
                    
                    $errors = [];
                    $errors = array_merge($errors, $contentManager->validateData('TESTIMONIALS_QUOTES', $testimonialQuotes));
                    $errors = array_merge($errors, $contentManager->validateData('TESTIMONIALS_AUTHORS', $testimonialAuthors));
                    $errors = array_merge($errors, $contentManager->validateData('TESTIMONIALS_ROLES', $testimonialRoles));
                    
                    if (empty($errors)) {
                        $success = $contentManager->updateData('TESTIMONIALS_QUOTES', $testimonialQuotes) &&
                                  $contentManager->updateData('TESTIMONIALS_AUTHORS', $testimonialAuthors) &&
                                  $contentManager->updateData('TESTIMONIALS_ROLES', $testimonialRoles);
                        
                        if ($success) {
                            $success = 'Testimonialele au fost actualizate cu succes!';
                        } else {
                            $error = 'Eroare la salvarea testimonialelor.';
                        }
                    } else {
                        $error = implode('<br>', $errors);
                    }
                    break;
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
if ($page === 'services') {
    $services = $contentManager->getData('SERVICES');
    $names = $contentManager->getData('SERVICES_NAMES');
    $namesShort = $contentManager->getData('SERVICES_NAMES_SHORT');
    $images = $contentManager->getData('SERVICES_IMAGES');
    $descriptions = $contentManager->getData('SERVICES_DESCRIPTION');
} elseif ($page === 'index') {
    // Homepage data
    $heroTitles = $contentManager->getData('HERO_TITLES');
    $heroDescriptions = $contentManager->getData('HERO_DESCRIPTIONS');
    $heroButtons = $contentManager->getData('HERO_BUTTONS');
    $heroLinks = $contentManager->getData('HERO_LINKS');
    $heroImages = $contentManager->getData('HERO_IMAGES');
    
    $aboutTitle = $contentManager->getData('ABOUT_TITLE')[0] ?? '';
    $aboutText1 = $contentManager->getData('ABOUT_TEXT_1')[0] ?? '';
    $aboutText2 = $contentManager->getData('ABOUT_TEXT_2')[0] ?? '';
    $aboutText3 = $contentManager->getData('ABOUT_TEXT_3')[0] ?? '';
    
    $statsValues = $contentManager->getData('STATS_VALUES');
    $statsLabels = $contentManager->getData('STATS_LABELS');
    
    $galleryTitles = $contentManager->getData('GALLERY_TITLES');
    $galleryDescriptions = $contentManager->getData('GALLERY_DESCRIPTIONS');
    $galleryImages = $contentManager->getData('GALLERY_IMAGES');
    
    $testimonialQuotes = $contentManager->getData('TESTIMONIALS_QUOTES');
    $testimonialAuthors = $contentManager->getData('TESTIMONIALS_AUTHORS');
    $testimonialRoles = $contentManager->getData('TESTIMONIALS_ROLES');
}

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
                    <a href="messages.php" class="menu-item">
                        <i class="fas fa-envelope"></i>
                        <span>Mesaje Contact</span>
                    </a>
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
                
                <?php if ($page === 'index'): ?>
                    <!-- Homepage Management -->
                    <div class="homepage-management">
                        <div class="tabs">
                            <button class="tab-btn active" data-tab="hero">Hero Section</button>
                            <button class="tab-btn" data-tab="about">Despre Noi</button>
                            <button class="tab-btn" data-tab="stats">Statistici</button>
                            <button class="tab-btn" data-tab="gallery">Galerie</button>
                            <button class="tab-btn" data-tab="testimonials">Testimoniale</button>
                        </div>
                        
                        <!-- Hero Section Management -->
                        <div class="tab-content active" id="hero">
                            <div class="content-card">
                                <div class="card-header">
                                    <h3><i class="fas fa-image"></i> Gestionare Hero Section</h3>
                                    <button type="button" class="btn btn-primary" onclick="addHeroSlide()">
                                        <i class="fas fa-plus"></i>
                                        Adaugă Slide
                                    </button>
                                </div>
                                <form method="POST" id="heroForm">
                                    <input type="hidden" name="action" value="update_homepage">
                                    <input type="hidden" name="section" value="hero">
                                    
                                    <div class="hero-slides" id="heroSlidesList">
                                        <?php for ($i = 0; $i < max(count($heroTitles), 1); $i++): ?>
                                            <div class="hero-slide" id="hero-slide-<?php echo $i; ?>">
                                                <div class="slide-header">
                                                    <h4>Slide #<?php echo $i + 1; ?></h4>
                                                    <?php if (count($heroTitles) > 1): ?>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeHeroSlide(<?php echo $i; ?>)">
                                                        <i class="fas fa-trash"></i>
                                                        Șterge
                                                    </button>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-grid">
                                                    <div class="form-group">
                                                        <label>Titlu</label>
                                                        <input type="text" name="hero_titles[]" value="<?php echo htmlspecialchars($heroTitles[$i] ?? ''); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Buton Text</label>
                                                        <input type="text" name="hero_buttons[]" value="<?php echo htmlspecialchars($heroButtons[$i] ?? ''); ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Link Buton</label>
                                                        <input type="text" name="hero_links[]" value="<?php echo htmlspecialchars($heroLinks[$i] ?? ''); ?>" placeholder="#section sau URL">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Imagine</label>
                                                        <select name="hero_images[]">
                                                            <option value="">Selectează imagine...</option>
                                                            <?php foreach ($availableImages as $image): ?>
                                                                <option value="<?php echo htmlspecialchars($image); ?>" 
                                                                        <?php echo ($heroImages[$i] ?? '') === $image ? 'selected' : ''; ?>>
                                                                    <?php echo htmlspecialchars($image); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Descriere</label>
                                                    <textarea name="hero_descriptions[]" rows="3"><?php echo htmlspecialchars($heroDescriptions[$i] ?? ''); ?></textarea>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                    
                                    <div class="form-actions">
                                        <button type="button" class="btn btn-secondary" onclick="addHeroSlide()">
                                            <i class="fas fa-plus"></i>
                                            Adaugă Slide
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i>
                                            Salvează Hero Section
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- About Section Management -->
                        <div class="tab-content" id="about">
                            <div class="content-card">
                                <div class="card-header">
                                    <h3><i class="fas fa-info-circle"></i> Gestionare Despre Noi</h3>
                                </div>
                                <form method="POST">
                                    <input type="hidden" name="action" value="update_homepage">
                                    <input type="hidden" name="section" value="about">
                                    
                                    <div class="form-group">
                                        <label>Titlu Secțiune</label>
                                        <input type="text" name="about_title" value="<?php echo htmlspecialchars($aboutTitle); ?>" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Primul Paragraf</label>
                                        <textarea name="about_text_1" rows="4" required><?php echo htmlspecialchars($aboutText1); ?></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Al Doilea Paragraf</label>
                                        <textarea name="about_text_2" rows="4" required><?php echo htmlspecialchars($aboutText2); ?></textarea>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label>Al Treilea Paragraf</label>
                                        <textarea name="about_text_3" rows="4" required><?php echo htmlspecialchars($aboutText3); ?></textarea>
                                    </div>
                                    
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i>
                                            Salvează Despre Noi
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Stats Management -->
                        <div class="tab-content" id="stats">
                            <div class="content-card">
                                <div class="card-header">
                                    <h3><i class="fas fa-chart-bar"></i> Gestionare Statistici</h3>
                                </div>
                                <form method="POST">
                                    <input type="hidden" name="action" value="update_homepage">
                                    <input type="hidden" name="section" value="stats">
                                    
                                    <div class="stats-grid">
                                        <?php for ($i = 0; $i < max(count($statsValues), 4); $i++): ?>
                                            <div class="stat-item">
                                                <h4>Statistica #<?php echo $i + 1; ?></h4>
                                                <div class="form-group">
                                                    <label>Valoare</label>
                                                    <input type="number" name="stats_values[]" value="<?php echo htmlspecialchars($statsValues[$i] ?? ''); ?>" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Eticheta</label>
                                                    <input type="text" name="stats_labels[]" value="<?php echo htmlspecialchars($statsLabels[$i] ?? ''); ?>" required>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                    
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i>
                                            Salvează Statistici
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Gallery Management -->
                        <div class="tab-content" id="gallery">
                            <div class="content-card">
                                <div class="card-header">
                                    <h3><i class="fas fa-images"></i> Gestionare Galerie</h3>
                                </div>
                                <form method="POST">
                                    <input type="hidden" name="action" value="update_homepage">
                                    <input type="hidden" name="section" value="gallery">
                                    
                                    <div class="gallery-items">
                                        <?php for ($i = 0; $i < max(count($galleryTitles), 5); $i++): ?>
                                            <div class="gallery-item">
                                                <h4>Imagine #<?php echo $i + 1; ?></h4>
                                                <div class="form-grid">
                                                    <div class="form-group">
                                                        <label>Titlu</label>
                                                        <input type="text" name="gallery_titles[]" value="<?php echo htmlspecialchars($galleryTitles[$i] ?? ''); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Imagine</label>
                                                        <select name="gallery_images[]" required>
                                                            <option value="">Selectează imagine...</option>
                                                            <?php foreach ($availableImages as $image): ?>
                                                                <option value="<?php echo htmlspecialchars($image); ?>" 
                                                                        <?php echo ($galleryImages[$i] ?? '') === $image ? 'selected' : ''; ?>>
                                                                    <?php echo htmlspecialchars($image); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Descriere</label>
                                                    <textarea name="gallery_descriptions[]" rows="2"><?php echo htmlspecialchars($galleryDescriptions[$i] ?? ''); ?></textarea>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                    
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i>
                                            Salvează Galerie
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Testimonials Management -->
                        <div class="tab-content" id="testimonials">
                            <div class="content-card">
                                <div class="card-header">
                                    <h3><i class="fas fa-quote-left"></i> Gestionare Testimoniale</h3>
                                    <button type="button" class="btn btn-primary" onclick="addTestimonial()">
                                        <i class="fas fa-plus"></i>
                                        Adaugă Testimonial
                                    </button>
                                </div>
                                <form method="POST" id="testimonialsForm">
                                    <input type="hidden" name="action" value="update_homepage">
                                    <input type="hidden" name="section" value="testimonials">
                                    
                                    <div class="testimonials-list" id="testimonialsList">
                                        <?php for ($i = 0; $i < max(count($testimonialQuotes), 1); $i++): ?>
                                            <div class="testimonial-item" id="testimonial-<?php echo $i; ?>">
                                                <div class="testimonial-header">
                                                    <h4>Testimonial #<?php echo $i + 1; ?></h4>
                                                    <?php if (count($testimonialQuotes) > 1): ?>
                                                    <button type="button" class="btn btn-danger btn-sm" onclick="removeTestimonial(<?php echo $i; ?>)">
                                                        <i class="fas fa-trash"></i>
                                                        Șterge
                                                    </button>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="form-group">
                                                    <label>Citat</label>
                                                    <textarea name="testimonial_quotes[]" rows="3" required><?php echo htmlspecialchars($testimonialQuotes[$i] ?? ''); ?></textarea>
                                                </div>
                                                <div class="form-grid">
                                                    <div class="form-group">
                                                        <label>Autor</label>
                                                        <input type="text" name="testimonial_authors[]" value="<?php echo htmlspecialchars($testimonialAuthors[$i] ?? ''); ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Rol</label>
                                                        <input type="text" name="testimonial_roles[]" value="<?php echo htmlspecialchars($testimonialRoles[$i] ?? ''); ?>" required>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endfor; ?>
                                    </div>
                                    
                                    <div class="form-actions">
                                        <button type="button" class="btn btn-secondary" onclick="addTestimonial()">
                                            <i class="fas fa-plus"></i>
                                            Adaugă Testimonial
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-save"></i>
                                            Salvează Testimoniale
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                <?php elseif ($page === 'services'): ?>
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
        
        // Hero slides management functions
        let heroSlideCounter = <?php echo max(count($heroTitles ?? []), 1); ?>;
        
        function addHeroSlide() {
            const heroSlidesList = document.getElementById('heroSlidesList');
            const newSlide = document.createElement('div');
            newSlide.className = 'hero-slide';
            newSlide.id = 'hero-slide-' + heroSlideCounter;
            
            newSlide.innerHTML = `
                <div class="slide-header">
                    <h4>Slide #${heroSlideCounter + 1}</h4>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeHeroSlide(${heroSlideCounter})">
                        <i class="fas fa-trash"></i>
                        Șterge
                    </button>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Titlu</label>
                        <input type="text" name="hero_titles[]" value="" required placeholder="Titlul slide-ului">
                    </div>
                    <div class="form-group">
                        <label>Buton Text</label>
                        <input type="text" name="hero_buttons[]" value="" placeholder="Textul butonului">
                    </div>
                    <div class="form-group">
                        <label>Link Buton</label>
                        <input type="text" name="hero_links[]" value="" placeholder="#section sau URL">
                    </div>
                    <div class="form-group">
                        <label>Imagine</label>
                        <select name="hero_images[]">
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
                    <textarea name="hero_descriptions[]" rows="3" placeholder="Descrierea slide-ului"></textarea>
                </div>
            `;
            
            heroSlidesList.appendChild(newSlide);
            heroSlideCounter++;
            updateHeroSlideNumbers();
            updateHeroDeleteButtons();
        }
        
        function removeHeroSlide(index) {
            const slide = document.getElementById('hero-slide-' + index);
            if (slide) {
                slide.remove();
                updateHeroSlideNumbers();
                updateHeroDeleteButtons();
            }
        }
        
        function updateHeroSlideNumbers() {
            const slides = document.querySelectorAll('.hero-slide');
            slides.forEach((slide, index) => {
                const header = slide.querySelector('h4');
                if (header) {
                    header.textContent = `Slide #${index + 1}`;
                }
            });
        }
        
        function updateHeroDeleteButtons() {
            const slides = document.querySelectorAll('.hero-slide');
            const deleteButtons = document.querySelectorAll('.hero-slide .btn-danger');
            
            if (slides.length <= 1) {
                deleteButtons.forEach(btn => btn.style.display = 'none');
            } else {
                deleteButtons.forEach(btn => btn.style.display = 'inline-block');
            }
        }
        
        // Testimonials management functions
        let testimonialCounter = <?php echo max(count($testimonialQuotes ?? []), 1); ?>;
        
        function addTestimonial() {
            const testimonialsList = document.getElementById('testimonialsList');
            const newTestimonial = document.createElement('div');
            newTestimonial.className = 'testimonial-item';
            newTestimonial.id = 'testimonial-' + testimonialCounter;
            
            newTestimonial.innerHTML = `
                <div class="testimonial-header">
                    <h4>Testimonial #${testimonialCounter + 1}</h4>
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeTestimonial(${testimonialCounter})">
                        <i class="fas fa-trash"></i>
                        Șterge
                    </button>
                </div>
                <div class="form-group">
                    <label>Citat</label>
                    <textarea name="testimonial_quotes[]" rows="3" required placeholder="Introduceți citatul..."></textarea>
                </div>
                <div class="form-grid">
                    <div class="form-group">
                        <label>Autor</label>
                        <input type="text" name="testimonial_authors[]" value="" required placeholder="Numele autorului">
                    </div>
                    <div class="form-group">
                        <label>Rol</label>
                        <input type="text" name="testimonial_roles[]" value="" required placeholder="Rolul autorului">
                    </div>
                </div>
            `;
            
            testimonialsList.appendChild(newTestimonial);
            testimonialCounter++;
            updateTestimonialNumbers();
            
            // Show delete buttons if we have more than one testimonial
            updateDeleteButtons();
        }
        
        function removeTestimonial(index) {
            const testimonial = document.getElementById('testimonial-' + index);
            if (testimonial) {
                testimonial.remove();
                updateTestimonialNumbers();
                updateDeleteButtons();
            }
        }
        
        function updateTestimonialNumbers() {
            const testimonials = document.querySelectorAll('.testimonial-item');
            testimonials.forEach((testimonial, index) => {
                const header = testimonial.querySelector('h4');
                if (header) {
                    header.textContent = `Testimonial #${index + 1}`;
                }
            });
        }
        
        function updateDeleteButtons() {
            const testimonials = document.querySelectorAll('.testimonial-item');
            const deleteButtons = document.querySelectorAll('.testimonial-item .btn-danger');
            
            if (testimonials.length <= 1) {
                deleteButtons.forEach(btn => btn.style.display = 'none');
            } else {
                deleteButtons.forEach(btn => btn.style.display = 'inline-block');
            }
        }
        
        // Initialize UI
        document.addEventListener('DOMContentLoaded', function() {
            updateDeleteButtons();
            updateHeroDeleteButtons();
        });
    </script>
</body>
</html>
