<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('psycho_pedagogical_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('psycho_pedagogical_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('psycho_pedagogical_page_title'); ?></title>
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
                <h1><?php echo t('services_psycho_pedagogical'); ?></h1>
                <p><?php echo t('psycho_pedagogical_header_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="service-hero">
                        <div class="service-hero-content">
                            <h2><?php echo t('psycho_about_title'); ?></h2>
                            <p><?php echo t('psycho_about_desc'); ?></p>
                        </div>
                        <div class="service-hero-image">
                            <img src="images/sap4.jpg" alt="<?php echo t('services_psycho_pedagogical'); ?>" loading="lazy">
                        </div>
                    </div>

                    <div class="service-details">
                        <h2><?php echo t('services_title'); ?></h2>
                        <div class="services-list">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-child"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('psycho_evaluation_title'); ?></h4>
                                    <p><?php echo t('psycho_evaluation_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('psycho_speech_title'); ?></h4>
                                    <p><?php echo t('psycho_speech_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('psycho_counseling_title'); ?></h4>
                                    <p><?php echo t('psycho_counseling_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('psycho_education_title'); ?></h4>
                                    <p><?php echo t('psycho_education_desc'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="service-info">
                        <h2><?php echo t('important_info_title'); ?></h2>
                        <div class="info-grid">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-child"></i>
                                </div>
                                <h4><?php echo t('psycho_teaching_mode_title'); ?></h4>
                                <p><?php echo t('psycho_teaching_mode_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h4><?php echo t('psycho_organization_title'); ?></h4>
                                <p><?php echo t('psycho_organization_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <h4><?php echo t('psycho_schedule_title'); ?></h4>
                                <p><?php echo t('psycho_schedule_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h4><?php echo t('psycho_coverage_title'); ?></h4>
                                <p><?php echo t('psycho_coverage_desc'); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="service-gallery">
                        <h2><?php echo t('psycho_gallery_title'); ?></h2>
                        <div class="gallery-grid">
                            <div class="gallery-item">
                                <img src="images/sap2.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/sap3.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/sap4.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/sap5.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/404.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/sap7.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
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