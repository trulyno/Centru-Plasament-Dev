<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('vacant_positions_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('vacant_positions_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('vacant_positions_page_title'); ?></title>
    <link rel="icon" href="images/logo.ico" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <!-- Loading overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <!-- Accessibility improvements -->
    <div class="skip-links">
        <a href="#main-content" class="skip-link"><?php echo t('skip_to_content'); ?></a>
    </div>

    <?php include 'includes/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content" id="main-content">
        <section class="page-header">
            <div class="container">
                <h1><?php echo t('about_vacant_positions'); ?></h1>
                <p><?php echo t('vacant_positions_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="intro-text">
                        <h2><?php echo t('vacant_positions_join_team'); ?></h2>
                        <p><?php echo t('vacant_positions_intro'); ?></p>
                    </div>

                    <!-- Current Job Openings -->
                    <div class="job-section">
                        <h3><i class="fas fa-briefcase"></i> <?php echo t('vacant_positions_available'); ?></h3>
                        
                        <?php
                        // Load vacancies from data file
                        $vacanciesFile = __DIR__ . '/data/vacancies.json';
                        $vacancies = [];
                        if (file_exists($vacanciesFile)) {
                            $vacancies = json_decode(file_get_contents($vacanciesFile), true) ?: [];
                            // Filter only active vacancies
                            $vacancies = array_filter($vacancies, fn($v) => $v['status'] === 'active');
                        }
                        
                        if (empty($vacancies)): ?>
                            <div class="no-vacancies">
                                <i class="fas fa-info-circle"></i>
                                <p><?php echo t('vacant_positions_none_available'); ?></p>
                            </div>
                        <?php else: ?>
                            <?php foreach ($vacancies as $vacancy): ?>
                                <div class="job-card">
                                    <div class="job-header">
                                        <h4><?php echo htmlspecialchars($vacancy['title']); ?></h4>
                                        <span class="job-type"><?php echo htmlspecialchars($vacancy['type']); ?></span>
                                    </div>
                                    <div class="job-details">
                                        <p><strong><?php echo t('vacant_positions_section'); ?>:</strong> <?php echo htmlspecialchars($vacancy['section']); ?></p>
                                        <p><strong><?php echo t('vacant_positions_responsibilities'); ?>:</strong></p>
                                        <ul>
                                            <?php foreach ($vacancy['responsibilities'] as $responsibility): ?>
                                                <li><?php echo htmlspecialchars($responsibility); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <p><strong><?php echo t('vacant_positions_requirements'); ?>:</strong></p>
                                        <ul>
                                            <?php foreach ($vacancy['requirements'] as $requirement): ?>
                                                <li><?php echo htmlspecialchars($requirement); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <div class="job-actions">
                                            <span class="job-date"><?php echo t('vacant_positions_published'); ?>: <?php echo date('d F Y', strtotime($vacancy['created_at'])); ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>

                    <!-- Application Process -->
                    <div class="application-section">
                        <h3><i class="fas fa-file-alt"></i> <?php echo t('vacant_positions_how_to_apply'); ?></h3>
                        <div class="application-steps">
                            <div class="step">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h4><?php echo t('vacant_positions_step1_title'); ?></h4>
                                    <p><?php echo t('vacant_positions_step1_desc'); ?></p>
                                </div>
                            </div>
                            <div class="step">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h4><?php echo t('vacant_positions_step2_title'); ?></h4>
                                    <p><?php echo t('vacant_positions_step2_desc'); ?> <strong>centru_plasament@agssi.md</strong></p>
                                </div>
                            </div>
                            <div class="step">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h4><?php echo t('vacant_positions_step3_title'); ?></h4>
                                    <p><?php echo t('vacant_positions_step3_desc'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>