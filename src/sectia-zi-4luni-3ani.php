<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('day_4m_3y_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('day_4m_3y_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('day_4m_3y_page_title'); ?></title>
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
                <h1><?php echo t('day_4m_3y_header_title'); ?></h1>
                <p><?php echo t('day_4m_3y_header_desc'); ?></p>
            </div>
        </section>



        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="service-hero">
                        <div class="service-hero-content">
                            <h2><?php echo t('day_4m_3y_about_title'); ?></h2>
                            <p><?php echo t('day_4m_3y_about_desc'); ?></p>
                        </div>
                        <div class="service-hero-image">
                            <img src="images/cresa3.jpg" alt="Secția Zi 4 luni - 3 ani" loading="lazy">
                        </div>
                    </div>

                    <div class="service-details">
                        <h2><?php echo t('services_title'); ?></h2>
                        <div class="services-list">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-baby"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_4m_3y_service_specialized_care_title'); ?></h4>
                                    <p><?php echo t('day_4m_3y_service_specialized_care_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_4m_3y_service_early_education_title'); ?></h4>
                                    <p><?php echo t('day_4m_3y_service_early_education_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_4m_3y_service_nutrition_title'); ?></h4>
                                    <p><?php echo t('day_4m_3y_service_nutrition_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_4m_3y_service_parent_support_title'); ?></h4>
                                    <p><?php echo t('day_4m_3y_service_parent_support_desc'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="service-info">
                        <h2><?php echo t('important_info_title'); ?></h2>
                        <div class="info-grid">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-baby"></i>
                                </div>
                                <h4><?php echo t('day_4m_3y_info_age_title'); ?></h4>
                                <p><?php echo t('day_4m_3y_info_age_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <h4><?php echo t('day_4m_3y_info_prevention_title'); ?></h4>
                                <p><?php echo t('day_4m_3y_info_prevention_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h4><?php echo t('day_4m_3y_info_schedule_title'); ?></h4>
                                <p><?php echo t('day_4m_3y_info_schedule_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <h4><?php echo t('day_4m_3y_info_vulnerable_title'); ?></h4>
                                <p><?php echo t('day_4m_3y_info_vulnerable_desc'); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="service-gallery">
                        <h2><?php echo t('day_4m_3y_gallery_title'); ?></h2>
                        <div class="gallery-grid">
                            <div class="gallery-item">
                                <img src="images/cresa1.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/cresa2.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/cresa3.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/cresa4.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/cresa5.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/cresa6.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4></h4>
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