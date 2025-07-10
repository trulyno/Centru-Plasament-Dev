<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('services_maternal_desc'); ?>">
    <meta name="keywords" content="<?php echo t('services_maternal_keywords'); ?>">
    <meta name="author" content="<?php echo t('site_author'); ?>">
    
    <title><?php echo t('services_maternal_page_title'); ?></title>
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
        <a href="#main-content" class="skip-link">Salt la conținutul principal</a>
    </div>

    <?php include 'includes/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content" id="main-content">
        <section class="page-header">
            <div class="container">
                <h1><?php echo t('services_maternal'); ?></h1>
                <p><?php echo t('maternal_header_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="service-hero">
                        <div class="service-hero-content">
                            <h2><?php echo t('maternal_about_title'); ?></h2>
                            <p><?php echo t('maternal_about_desc'); ?></p>
                        </div>
                        <div class="service-hero-image">
                            <img src="images/maternala5.jpg" alt="<?php echo t('services_maternal'); ?>" loading="lazy">
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
                                    <h4><?php echo t('maternal_service_accommodation_title'); ?></h4>
                                    <p><?php echo t('maternal_service_accommodation_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('maternal_service_parenting_title'); ?></h4>
                                    <p><?php echo t('maternal_service_parenting_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('maternal_service_counseling_title'); ?></h4>
                                    <p><?php echo t('maternal_service_counseling_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('maternal_service_education_title'); ?></h4>
                                    <p><?php echo t('maternal_service_education_desc'); ?></p>
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
                                <h4><?php echo t('maternal_info_beneficiaries_title'); ?></h4>
                                <p><?php echo t('maternal_info_beneficiaries_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <h4><?php echo t('maternal_info_duration_title'); ?></h4>
                                <p><?php echo t('maternal_info_duration_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-bed"></i>
                                </div>
                                <h4><?php echo t('maternal_info_capacity_title'); ?></h4>
                                <p><?php echo t('maternal_info_capacity_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h4><?php echo t('maternal_info_schedule_title'); ?></h4>
                                <p><?php echo t('maternal_info_schedule_desc'); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="service-gallery">
                        <h2><?php echo t('maternal_gallery_title'); ?></h2>
                        <div class="gallery-grid">
                            <div class="gallery-item">
                                <img src="images/maternala1.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/maternala2.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/maternala3.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/maternala4.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/maternala5.jpg" alt="" loading="lazy">
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