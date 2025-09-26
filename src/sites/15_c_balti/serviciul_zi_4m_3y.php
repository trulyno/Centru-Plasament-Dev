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
    <meta name="description" content="<?php echo t('psycho_pedagogical_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('psycho_pedagogical_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('site_title'); ?>">

    <title><?php echo t('psycho_pedagogical_page_title'); ?></title>
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
                <h1><?php echo t('services_day_4m_3y'); ?></h1>
                <p><?php echo t('day_4m_3y_header_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="service-hero">
                        <div class="service-hero-content">
                            <h2><?php echo t('day_4m_3y_about_title'); ?></h2>
                            <p><?php echo t('service_day_4m_3y_desc'); ?></p>
                        </div>
                        <div class="service-hero-image">
                            <img src="images/ingrij cop 4l-3ani/IMG_4564.jpeg" alt="<?php echo t('services_day_4m_3y'); ?>" loading="lazy">
                        </div>
                    </div>

                    <div class="service-details">
                        <h2><?php echo t('services_title'); ?></h2>
                        <div class="services-list">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t(''); ?></h4>
                                    <p><?php echo t(''); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-ambulance"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t(''); ?></h4>
                                    <p><?php echo t(''); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-stethoscope"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t(''); ?></h4>
                                    <p><?php echo t(''); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t(''); ?></h4>
                                    <p><?php echo t(''); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t(''); ?></h4>
                                    <p><?php echo t(''); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="documents-section">
                        <h2><?php echo t('documents_title'); ?></h2>
                        <p class="documents-intro"><?php echo t('day_documents_intro'); ?></p>
                        <div class="documents-list">
                            <div class="document-item" data-aos="fade-up" data-aos-delay="100">
                                <div class="document-icon">
                                    <i class="fas fa-file-medical" aria-hidden="true"></i>
                                </div>
                                <div class="document-content">
                                    <h5><?php echo t(''); ?></h5>
                                    <p><?php echo t(''); ?></p>
                                </div>
                            </div>
                            <div class="document-item" data-aos="fade-up" data-aos-delay="100">
                                <div class="document-icon">
                                    <i class="fas fa-file-medical" aria-hidden="true"></i>
                                </div>
                                <div class="document-content">
                                    <h5><?php echo t(''); ?></h5>
                                    <p><?php echo t(''); ?></p>
                                </div>
                            </div>
                            <div class="document-item" data-aos="fade-up" data-aos-delay="100">
                                <div class="document-icon">
                                    <i class="fas fa-file-medical" aria-hidden="true"></i>
                                </div>
                                <div class="document-content">
                                    <h5><?php echo t(''); ?></h5>
                                    <p><?php echo t(''); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="service-info">
                        <h2><?php echo t('important_info_title'); ?></h2>
                        <div class="info-grid">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h4><?php echo t(''); ?></h4>
                                <p><?php echo t(''); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h4><?php echo t(''); ?></h4>
                                <p><?php echo t(''); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-gavel"></i>
                                </div>
                                <h4><?php echo t(''); ?></h4>
                                <p><?php echo t(''); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <h4><?php echo t(''); ?></h4>
                                <p><?php echo t(''); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="service-gallery">
                        <h2><?php echo t('day_4m_3y_gallery_title'); ?></h2>
                        <div class="gallery-grid">
                            <div class="gallery-item">
                                <img src="images/ingrij cop 4l-3ani/IMG_4566.jpeg" alt="<?php echo t('services_day_4m_3y'); ?>" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t('services_day_4m_3y'); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/ingrij cop 4l-3ani/IMG_6219.jpg" alt="<?php echo t('services_day_4m_3y'); ?>" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t('services_day_4m_3y'); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/ingrij cop 4l-3ani/IMG_6280.JPG" alt="<?php echo t('services_day_4m_3y'); ?>" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t('services_day_4m_3y'); ?></h4>
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
    <script src="gdpr-script.js"></script>
</body>
</html>
