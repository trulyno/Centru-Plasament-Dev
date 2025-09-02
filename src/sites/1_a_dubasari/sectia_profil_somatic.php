<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
require_once __DIR__ . '/includes/gdpr.php';
require_once __DIR__ . '/includes/analytics.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('somatic_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('somatic_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('site_title'); ?>">
    
    <title><?php echo t('somatic_page_title'); ?></title>
    <link rel="icon" href="images/logo.ico" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="gdpr-styles.css" rel="stylesheet">
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
                <h1><?php echo t('services_somatic'); ?></h1>
                <p><?php echo t('somatic_header_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="service-hero">
                        <div class="service-hero-content">
                            <h2><?php echo t('somatic_about_title'); ?></h2>
                            <p><?php echo t('service_somatic_desc'); ?></p>
                        </div>
                        <div class="service-hero-image">
                            <img src="images/20250409_094126.jpg" alt="<?php echo t(''); ?>" loading="lazy">
                        </div>
                    </div>

                    <div class="service-info">
                        <h2><?php echo t('important_info_title'); ?></h2>
                        <div class="info-grid">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h4><?php echo t('somatic_autonomy_title'); ?></h4>
                                <p><?php echo t('somatic_autonomy_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h4><?php echo t('somatic_security_title'); ?></h4>
                                <p><?php echo t('somatic_security_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-gavel"></i>
                                </div>
                                <h4><?php echo t('somatic_inclusion_title'); ?></h4>
                                <p><?php echo t('somatic_inclusion_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <h4><?php echo t('somatic_quality_of_life_title'); ?></h4>
                                <p><?php echo t('somatic_quality_of_life_desc'); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="service-gallery">
                        <h2><?php echo t('somatic_gallery_title'); ?></h2>
                        <div class="gallery-grid">
                            <div class="gallery-item">
                                <img src="" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
    </main>

        <?php include 'includes/footer.php'; ?>


    <script src="script.js"></script>
    <script src="gdpr-script.js"></script>
</body>
</html>
