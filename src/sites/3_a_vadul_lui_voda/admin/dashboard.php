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

// Create data directory if it doesn't exist
if (!is_dir($dataDir)) {
    mkdir($dataDir, 0755, true);
}

// Initialize files if they don't exist
if (!file_exists($vacanciesFile)) {
    file_put_contents($vacanciesFile, json_encode([], JSON_PRETTY_PRINT));
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

// Load news data
$newsFile = $dataDir . 'news.json';
$news = [];
if (!file_exists($newsFile)) {
    file_put_contents($newsFile, json_encode([], JSON_PRETTY_PRINT));
}
if (file_exists($newsFile)) {
    $newsContent = file_get_contents($newsFile);
    $news = json_decode($newsContent, true);
    if (!is_array($news)) {
        $news = [];
    }
    // Sort by date (newest first)
    usort($news, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
}

// Handle news edit mode
$newsEditMode = false;
$editNewsArticle = null;
if (isset($_GET['edit_news']) && !empty($_GET['edit_news'])) {
    $newsEditMode = true;
    $editNewsId = $_GET['edit_news'];
    foreach ($news as $article) {
        if ($article['id'] === $editNewsId) {
            $editNewsArticle = $article;
            break;
        }
    }
    if (!$editNewsArticle) {
        header('Location: dashboard.php#news');
        exit;
    }
}

// Include analytics
require_once __DIR__ . '/../includes/lang.php';
require_once __DIR__ . '/../includes/gdpr.php';
require_once __DIR__ . '/../includes/analytics.php';

// Get analytics data
$analytics = AnalyticsManager::getAnalyticsSummary(30);

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
    }
}

// Count statistics
$totalVacancies = count($vacancies);
$activeVacancies = count(array_filter($vacancies, fn($v) => $v['status'] === 'active'));
$totalNews = count($news);
$recentNews = count(array_filter($news, function($article) {
    return strtotime($article['date']) > strtotime('-30 days');
}));
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
            
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-card-title">Știri & Articole</span>
                    <i class="fas fa-newspaper stat-card-icon"></i>
                </div>
                <div class="stat-card-value"><?php echo $totalNews; ?></div>
                <div class="stat-card-description">
                    <?php echo $recentNews; ?> publicate în ultimele 30 de zile
                </div>
            </div>
            
            <div class="stat-card">
                <div class="stat-card-header">
                    <span class="stat-card-title">Trafic Site</span>
                    <i class="fas fa-chart-line stat-card-icon"></i>
                </div>
                <div class="stat-card-value"><?php echo number_format($analytics['total_page_views']); ?></div>
                <div class="stat-card-description">
                    <?php echo number_format($analytics['unique_visitors']); ?> vizitatori unici (30 zile)
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="dashboard-tabs">
            <button class="tab-btn" data-tab="news">
                <i class="fas fa-newspaper"></i>
                Știri & Articole (<?php echo $totalNews; ?>)
            </button>
            <button class="tab-btn" data-tab="vacancies">
                <i class="fas fa-briefcase"></i>
                Posturi Vacante (<?php echo $totalVacancies; ?>)
            </button>
            <button class="tab-btn" data-tab="analytics">
                <i class="fas fa-chart-bar"></i>
                Analiză Trafic
            </button>
            <button class="tab-btn" data-tab="statistics">
                <i class="fas fa-cog"></i>
                Editare Statistici
            </button>
        </div>

        <!-- News Tab -->
        <div id="news-tab" class="tab-content">
            <div class="data-table-container">
                <div class="data-table-header">
                    <h2 class="data-table-title">
                        <i class="fas fa-newspaper"></i>
                        Gestionare Știri & Articole
                    </h2>
                    <button onclick="showAddNewsModal()" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        Adaugă Articol Nou
                    </button>
                </div>
                
                <?php if (empty($news)): ?>
                    <div style="padding: 2rem; text-align: center; color: #6c757d;">
                        <i class="fas fa-newspaper" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <p>Nu există articole de știri în acest moment.</p>
                        <button onclick="showAddNewsModal()" class="btn btn-primary" style="margin-top: 1rem;">
                            <i class="fas fa-plus"></i>
                            Adaugă primul articol
                        </button>
                    </div>
                <?php else: ?>
                    <div class="data-table-wrapper">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Imagine</th>
                                    <th>Titlu & Subtitlu</th>
                                    <th>Data Publicării</th>
                                    <th>Atașamente</th>
                                    <th>Acțiuni</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($news as $article): ?>
                                    <tr>
                                        <td>
                                            <?php if (!empty($article['image'])): ?>
                                                <img src="../<?php echo htmlspecialchars($article['image']); ?>" 
                                                     alt="<?php echo htmlspecialchars($article['title']); ?>"
                                                     class="news-thumbnail"
                                                     style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;"
                                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                                <div style="display:none; width: 60px; height: 40px; background: #f8f9fa; border: 1px dashed #dee2e6; border-radius: 4px; align-items: center; justify-content: center;">
                                                    <i class="fas fa-image" style="color: #6c757d;"></i>
                                                </div>
                                            <?php else: ?>
                                                <div style="width: 60px; height: 40px; background: #f8f9fa; border: 1px dashed #dee2e6; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                                    <i class="fas fa-image" style="color: #6c757d;"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div>
                                                <strong class="text-truncate" style="max-width: 200px; display: block;"><?php echo htmlspecialchars($article['title']); ?></strong>
                                                <small class="text-truncate" style="max-width: 200px; display: block; color: #6c757d;"><?php echo htmlspecialchars($article['subtitle']); ?></small>
                                            </div>
                                        </td>
                                        <td><?php echo date('d.m.Y', strtotime($article['date'])); ?></td>
                                        <td>
                                            <?php 
                                            $attachmentCount = 0;
                                            if (!empty($article['attachments']['images'])) {
                                                $attachmentCount += count($article['attachments']['images']);
                                            }
                                            if (!empty($article['attachments']['videos'])) {
                                                $attachmentCount += count($article['attachments']['videos']);
                                            }
                                            ?>
                                            <?php if ($attachmentCount > 0): ?>
                                                <span class="file-indicator">
                                                    <i class="fas fa-paperclip"></i>
                                                    <?php echo $attachmentCount; ?> fișiere
                                                </span>
                                            <?php else: ?>
                                                <span style="color: #6c757d;">Fără atașamente</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="actions">
                                            <button onclick="viewNews('<?php echo htmlspecialchars($article['id']); ?>')" 
                                                    class="btn-sm btn-primary" 
                                                    title="Vezi detalii">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button onclick="editNews('<?php echo htmlspecialchars($article['id']); ?>')" 
                                                    class="btn-sm btn-secondary" 
                                                    title="Editează">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button onclick="deleteNews('<?php echo htmlspecialchars($article['id']); ?>')" 
                                                    class="btn-sm btn-danger" 
                                                    title="Șterge">
                                                <i class="fas fa-trash"></i>
                                            </button>
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

        <!-- Analytics Tab -->
        <div id="analytics-tab" class="tab-content">
            <div class="data-table-container">
                <div class="data-table-header">
                    <h2 class="data-table-title">
                        <i class="fas fa-chart-bar"></i>
                        Analiză Trafic - Ultimele 30 de zile
                    </h2>
                </div>

                <?php if ($analytics['total_page_views'] === 0): ?>
                    <div style="padding: 2rem; text-align: center; color: #6c757d;">
                        <i class="fas fa-chart-line" style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;"></i>
                        <h3>Nu există date de analiză</h3>
                        <p>Datele de analiză vor apărea aici după ce vizitatorii vor interacționa cu site-ul.</p>
                    </div>
                <?php else: ?>
                    <!-- Analytics Statistics Cards -->
                    <div class="analytics-stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
                        <div class="analytics-stat-card" style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
                            <h3 style="font-size: 2rem; margin: 0; color: #3498db;"><?php echo number_format($analytics['total_page_views']); ?></h3>
                            <p style="margin: 0.5rem 0 0 0; color: #6c757d;">Vizualizări pagini</p>
                        </div>
                        <div class="analytics-stat-card" style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
                            <h3 style="font-size: 2rem; margin: 0; color: #27ae60;"><?php echo number_format($analytics['unique_visitors']); ?></h3>
                            <p style="margin: 0.5rem 0 0 0; color: #6c757d;">Vizitatori unici</p>
                        </div>
                        <div class="analytics-stat-card" style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
                            <h3 style="font-size: 2rem; margin: 0; color: #e74c3c;"><?php echo count($analytics['top_pages']); ?></h3>
                            <p style="margin: 0.5rem 0 0 0; color: #6c757d;">Pagini vizitate</p>
                        </div>
                        <div class="analytics-stat-card" style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); text-align: center;">
                            <h3 style="font-size: 2rem; margin: 0; color: #f39c12;"><?php echo count($analytics['browsers']); ?></h3>
                            <p style="margin: 0.5rem 0 0 0; color: #6c757d;">Tipuri browsere</p>
                        </div>
                    </div>

                    <!-- Analytics Charts -->
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem;">
                        <!-- Top Pages -->
                        <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <h3 style="margin-top: 0; color: #2c3e50;">Pagini populare</h3>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <?php foreach (array_slice($analytics['top_pages'], 0, 10) as $page => $views): ?>
                                    <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                                        <span style="color: #2c3e50;"><?php echo htmlspecialchars($page); ?></span>
                                        <span style="background: #3498db; color: white; padding: 0.25rem 0.5rem; border-radius: 12px; font-size: 0.85rem;"><?php echo number_format($views); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Browsers -->
                        <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <h3 style="margin-top: 0; color: #2c3e50;">Browsere utilizate</h3>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <?php foreach ($analytics['browsers'] as $browser => $count): ?>
                                    <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                                        <span style="color: #2c3e50;"><?php echo htmlspecialchars($browser); ?></span>
                                        <span style="background: #27ae60; color: white; padding: 0.25rem 0.5rem; border-radius: 12px; font-size: 0.85rem;"><?php echo number_format($count); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <!-- Traffic Sources -->
                        <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                            <h3 style="margin-top: 0; color: #2c3e50;">Surse de trafic</h3>
                            <ul style="list-style: none; padding: 0; margin: 0;">
                                <?php if (empty($analytics['top_referrers'])): ?>
                                    <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0;">
                                        <span style="color: #2c3e50;">Trafic direct</span>
                                        <span style="background: #e74c3c; color: white; padding: 0.25rem 0.5rem; border-radius: 12px; font-size: 0.85rem;"><?php echo number_format($analytics['total_page_views']); ?></span>
                                    </li>
                                <?php else: ?>
                                    <?php foreach (array_slice($analytics['top_referrers'], 0, 10) as $referrer => $count): ?>
                                        <li style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 0; border-bottom: 1px solid #eee;">
                                            <span style="color: #2c3e50;"><?php echo htmlspecialchars($referrer); ?></span>
                                            <span style="background: #e74c3c; color: white; padding: 0.25rem 0.5rem; border-radius: 12px; font-size: 0.85rem;"><?php echo number_format($count); ?></span>
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>

                        <!-- Hourly Distribution -->
                        <div style="background: white; padding: 1.5rem; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); grid-column: 1 / -1;">
                            <h3 style="margin-top: 0; color: #2c3e50;">Distribuție orară</h3>
                            <div style="display: flex; align-items: end; gap: 4px; height: 150px; padding: 1rem 0;">
                                <?php 
                                $maxHourly = max($analytics['hourly_distribution']);
                                for ($i = 0; $i < 24; $i++): 
                                    $height = $maxHourly > 0 ? ($analytics['hourly_distribution'][$i] / $maxHourly) * 100 : 0;
                                ?>
                                    <div style="flex: 1; background: #3498db; border-radius: 2px 2px 0 0; position: relative; min-height: 20px; height: <?php echo $height; ?>%;" title="<?php echo $i; ?>:00 - <?php echo $analytics['hourly_distribution'][$i]; ?> vizualizări">
                                        <span style="position: absolute; top: -25px; font-size: 0.7rem; font-weight: 600; color: #2c3e50; left: 50%; transform: translateX(-50%);"><?php echo $analytics['hourly_distribution'][$i]; ?></span>
                                        <span style="position: absolute; bottom: -20px; font-size: 0.7rem; color: #6c757d; left: 50%; transform: translateX(-50%);"><?php echo str_pad($i, 2, '0', STR_PAD_LEFT); ?></span>
                                    </div>
                                <?php endfor; ?>
                            </div>
                        </div>
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
            const defaultTab = 'news'; // Default to news tab
            
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

    <!-- News Modals -->
    <div id="addNewsModal" class="modal">
        <div class="modal-content" style="max-width: 800px;">
            <div class="modal-header">
                <h3><i class="fas fa-plus"></i> Adaugă Articol Nou</h3>
                <button class="modal-close" onclick="closeModal('addNewsModal')">&times;</button>
            </div>
            <form id="addNewsForm" class="admin-form" enctype="multipart/form-data">
                <input type="hidden" name="action" value="add">
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="form-group">
                        <label for="add_news_title">
                            Titlu <span class="required">*</span>
                        </label>
                        <input type="text" id="add_news_title" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="add_news_subtitle">
                            Subtitlu <span class="required">*</span>
                        </label>
                        <input type="text" id="add_news_subtitle" name="subtitle" required>
                    </div>

                    <div class="form-group">
                        <label for="add_news_date">
                            Data Publicării <span class="required">*</span>
                        </label>
                        <input type="date" id="add_news_date" name="date" required value="<?php echo date('Y-m-d'); ?>">
                    </div>

                    <div class="form-group">
                        <label for="add_news_content">
                            Conținut <span class="required">*</span>
                        </label>
                        <textarea id="add_news_content" name="content" rows="6" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="add_news_image">
                            Imagine Principală <span class="required">*</span>
                        </label>
                        <input type="file" id="add_news_image" name="image" accept="image/*" required>
                        <small class="form-help">Format acceptat: JPG, PNG, GIF (max 5MB)</small>
                    </div>

                    <div class="form-group">
                        <label>Atașamente</label>
                        <div class="attachments-manager">
                            <div class="attachment-type">
                                <h4><i class="fas fa-images"></i> Imagini Adiționale</h4>
                                <input type="file" id="add_attachment_images" name="attachment_images[]" accept="image/*" multiple>
                                <div id="addImagePreview" class="preview-container"></div>
                            </div>

                            <div class="attachment-type">
                                <h4><i class="fas fa-video"></i> Video-uri</h4>
                                <input type="file" id="add_attachment_videos" name="attachment_videos[]" accept="video/*" multiple>
                                <div id="addVideoPreview" class="preview-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Salvează
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('addNewsModal')">
                        Anulează
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="editNewsModal" class="modal">
        <div class="modal-content" style="max-width: 800px;">
            <div class="modal-header">
                <h3><i class="fas fa-edit"></i> Editează Articol</h3>
                <button class="modal-close" onclick="closeModal('editNewsModal')">&times;</button>
            </div>
            <form id="editNewsForm" class="admin-form" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <input type="hidden" id="edit_news_id" name="id">
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="form-group">
                        <label for="edit_news_title">
                            Titlu <span class="required">*</span>
                        </label>
                        <input type="text" id="edit_news_title" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_news_subtitle">
                            Subtitlu <span class="required">*</span>
                        </label>
                        <input type="text" id="edit_news_subtitle" name="subtitle" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_news_date">
                            Data Publicării <span class="required">*</span>
                        </label>
                        <input type="date" id="edit_news_date" name="date" required>
                    </div>

                    <div class="form-group">
                        <label for="edit_news_content">
                            Conținut <span class="required">*</span>
                        </label>
                        <textarea id="edit_news_content" name="content" rows="6" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="edit_news_image">
                            Imagine Principală
                        </label>
                        <div id="edit_current_image" class="current-image" style="display: none;">
                            <img id="edit_current_image_img" src="" alt="Current image" style="max-width: 300px; margin-bottom: 10px; border-radius: 8px;">
                            <input type="hidden" id="edit_existing_image" name="existing_image">
                        </div>
                        <input type="file" id="edit_news_image" name="image" accept="image/*">
                        <small class="form-help">Format acceptat: JPG, PNG, GIF (max 5MB). Lasă gol pentru a păstra imaginea actuală.</small>
                    </div>

                    <div class="form-group">
                        <label>Atașamente</label>
                        <div class="attachments-manager">
                            <div class="attachment-type">
                                <h4><i class="fas fa-images"></i> Imagini Adiționale</h4>
                                <div id="editExistingImages" class="preview-container"></div>
                                <input type="file" id="edit_attachment_images" name="attachment_images[]" accept="image/*" multiple>
                                <div id="editImagePreview" class="preview-container"></div>
                            </div>

                            <div class="attachment-type">
                                <h4><i class="fas fa-video"></i> Video-uri</h4>
                                <div id="editExistingVideos" class="preview-container"></div>
                                <input type="file" id="edit_attachment_videos" name="attachment_videos[]" accept="video/*" multiple>
                                <div id="editVideoPreview" class="preview-container"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        Salvează Modificările
                    </button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editNewsModal')">
                        Anulează
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div id="viewNewsModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3><i class="fas fa-eye"></i> Detalii Articol</h3>
                <button class="modal-close" onclick="closeModal('viewNewsModal')">&times;</button>
            </div>
            <div class="modal-body" id="viewNewsContent">
                <!-- Content will be populated by JavaScript -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('viewNewsModal')">Închide</button>
            </div>
        </div>
    </div>

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

    <script>
        // News-related JavaScript functions
        const newsData = <?php echo json_encode($news); ?>;

        function showAddNewsModal() {
            // Reset form
            document.getElementById('addNewsForm').reset();
            document.getElementById('addImagePreview').innerHTML = '';
            document.getElementById('addVideoPreview').innerHTML = '';
            document.getElementById('addNewsModal').style.display = 'block';
        }

        function editNews(newsId) {
            const article = newsData.find(n => n.id === newsId);
            if (!article) return;

            // Fill form with article data
            document.getElementById('edit_news_id').value = article.id;
            document.getElementById('edit_news_title').value = article.title;
            document.getElementById('edit_news_subtitle').value = article.subtitle;
            document.getElementById('edit_news_date').value = article.date;
            document.getElementById('edit_news_content').value = article.content;

            // Handle current image
            if (article.image) {
                document.getElementById('edit_current_image').style.display = 'block';
                document.getElementById('edit_current_image_img').src = '../' + article.image;
                document.getElementById('edit_existing_image').value = article.image;
            } else {
                document.getElementById('edit_current_image').style.display = 'none';
            }

            // Handle existing attachments
            const existingImagesContainer = document.getElementById('editExistingImages');
            const existingVideosContainer = document.getElementById('editExistingVideos');
            existingImagesContainer.innerHTML = '';
            existingVideosContainer.innerHTML = '';

            if (article.attachments) {
                // Existing images
                if (article.attachments.images && article.attachments.images.length > 0) {
                    article.attachments.images.forEach((img, index) => {
                        const div = document.createElement('div');
                        div.className = 'preview-item';
                        div.innerHTML = `
                            <img src="../${img}" alt="Attachment">
                            <button type="button" class="remove-attachment" onclick="removeExistingAttachment(this, 'image', ${index})">
                                <i class="fas fa-times"></i>
                            </button>
                            <input type="hidden" name="existing_images[]" value="${img}">
                        `;
                        existingImagesContainer.appendChild(div);
                    });
                }

                // Existing videos
                if (article.attachments.videos && article.attachments.videos.length > 0) {
                    article.attachments.videos.forEach((vid, index) => {
                        const div = document.createElement('div');
                        div.className = 'preview-item';
                        div.innerHTML = `
                            <video src="../${vid}" style="max-width: 200px;" controls></video>
                            <button type="button" class="remove-attachment" onclick="removeExistingAttachment(this, 'video', ${index})">
                                <i class="fas fa-times"></i>
                            </button>
                            <input type="hidden" name="existing_videos[]" value="${vid}">
                        `;
                        existingVideosContainer.appendChild(div);
                    });
                }
            }

            // Clear new attachment previews
            document.getElementById('editImagePreview').innerHTML = '';
            document.getElementById('editVideoPreview').innerHTML = '';

            document.getElementById('editNewsModal').style.display = 'block';
        }

        function viewNews(newsId) {
            const article = newsData.find(n => n.id === newsId);
            if (!article) return;

            let attachmentsHtml = '';
            if (article.attachments) {
                if (article.attachments.images && article.attachments.images.length > 0) {
                    attachmentsHtml += '<div class="attachment-group"><h6><i class="fas fa-images"></i> Imagini (' + article.attachments.images.length + ')</h6>';
                    article.attachments.images.forEach(img => {
                        attachmentsHtml += '<img src="../' + img + '" style="max-width: 100px; margin: 5px; border-radius: 4px;">';
                    });
                    attachmentsHtml += '</div>';
                }
                if (article.attachments.videos && article.attachments.videos.length > 0) {
                    attachmentsHtml += '<div class="attachment-group"><h6><i class="fas fa-video"></i> Video-uri (' + article.attachments.videos.length + ')</h6>';
                    article.attachments.videos.forEach(vid => {
                        attachmentsHtml += '<video src="../' + vid + '" style="max-width: 200px; margin: 5px;" controls></video>';
                    });
                    attachmentsHtml += '</div>';
                }
            }

            const content = `
                <div class="news-details">
                    <div class="detail-group">
                        <h5><i class="fas fa-heading"></i> Titlu</h5>
                        <p>${article.title}</p>
                    </div>
                    <div class="detail-group">
                        <h5><i class="fas fa-text-height"></i> Subtitlu</h5>
                        <p>${article.subtitle}</p>
                    </div>
                    <div class="detail-group">
                        <h5><i class="fas fa-calendar"></i> Data Publicării</h5>
                        <p>${new Date(article.date).toLocaleDateString('ro-RO')}</p>
                    </div>
                    <div class="detail-group">
                        <h5><i class="fas fa-image"></i> Imagine Principală</h5>
                        <img src="../${article.image}" style="max-width: 300px; border-radius: 8px;">
                    </div>
                    <div class="detail-group">
                        <h5><i class="fas fa-align-left"></i> Conținut</h5>
                        <div style="max-height: 200px; overflow-y: auto; padding: 10px; background: #f8f9fa; border-radius: 4px;">
                            ${article.content.replace(/\n/g, '<br>')}
                        </div>
                    </div>
                    ${attachmentsHtml ? '<div class="detail-group"><h5><i class="fas fa-paperclip"></i> Atașamente</h5>' + attachmentsHtml + '</div>' : ''}
                </div>
            `;

            document.getElementById('viewNewsContent').innerHTML = content;
            document.getElementById('viewNewsModal').style.display = 'block';
        }

        function deleteNews(newsId) {
            if (confirm('Sunteți sigur că doriți să ștergeți acest articol? Această acțiune nu poate fi anulată.')) {
                // Send delete request via AJAX
                const formData = new FormData();
                formData.append('action', 'delete');
                formData.append('id', newsId);

                fetch('../handlers/news-handler.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Articolul a fost șters cu succes!');
                        location.reload();
                    } else {
                        alert('Eroare la ștergerea articolului: ' + (data.message || 'Eroare necunoscută'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Eroare la ștergerea articolului!');
                });
            }
        }

        function removeExistingAttachment(button, type, index) {
            if (confirm('Sunteți sigur că doriți să eliminați acest atașament?')) {
                button.closest('.preview-item').remove();
            }
        }

        // Handle file previews for add form
        document.addEventListener('DOMContentLoaded', function() {
            // Add form image preview
            document.getElementById('add_attachment_images')?.addEventListener('change', function(e) {
                handleFilePreview(e, 'addImagePreview', 'image');
            });

            // Add form video preview
            document.getElementById('add_attachment_videos')?.addEventListener('change', function(e) {
                handleFilePreview(e, 'addVideoPreview', 'video');
            });

            // Edit form image preview
            document.getElementById('edit_attachment_images')?.addEventListener('change', function(e) {
                handleFilePreview(e, 'editImagePreview', 'image');
            });

            // Edit form video preview
            document.getElementById('edit_attachment_videos')?.addEventListener('change', function(e) {
                handleFilePreview(e, 'editVideoPreview', 'video');
            });
        });

        function handleFilePreview(event, previewContainerId, type) {
            const preview = document.getElementById(previewContainerId);
            for (let file of event.target.files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'preview-item';
                    if (type === 'image') {
                        div.innerHTML = `
                            <img src="${e.target.result}" alt="Preview">
                            <button type="button" class="remove-attachment" onclick="this.parentElement.remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                    } else {
                        div.innerHTML = `
                            <video src="${e.target.result}" style="max-width: 200px;" controls></video>
                            <button type="button" class="remove-attachment" onclick="this.parentElement.remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        `;
                    }
                    preview.appendChild(div);
                };
                reader.readAsDataURL(file);
            }
        }

        // Handle form submissions
        document.getElementById('addNewsForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            submitNewsForm(this, 'Articolul a fost adăugat cu succes!');
        });

        document.getElementById('editNewsForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            submitNewsForm(this, 'Articolul a fost actualizat cu succes!');
        });

        function submitNewsForm(form, successMessage) {
            const formData = new FormData(form);
            
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Se procesează...';
            submitBtn.disabled = true;

            fetch('../handlers/news-handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(successMessage);
                    location.reload();
                } else {
                    alert('Eroare: ' + (data.message || 'Eroare necunoscută'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Eroare la procesarea formularului!');
            })
            .finally(() => {
                // Restore button state
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        }

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
        const faqsData = [];

        function showAddFaqModal() {
            // Removed FAQ functionality
        }

        function editFaq(faqId) {
            // Removed FAQ functionality
        }

        function viewFaq(faqId) {
            // Removed FAQ functionality
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modals = ['addNewsModal', 'editNewsModal', 'viewNewsModal', 'addVacancyModal', 'editVacancyModal', 'viewVacancyModal'];
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
