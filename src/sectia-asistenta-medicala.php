<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('services_medical'); ?> oferă sprijin și adăpost mamelor și copiilor aflați în dificultate, dezvoltând abilitățile parentale și susținând relațiile familiale.">
    <meta name="keywords" content="asistență medicală, mame singure, mame minore, gravide, violență domestică, sprijin familial">
    <meta name="author" content="Centrul de Plasament și Reabilitare pentru Copii de Vârstă Fragedă">
    
    <title><?php echo t('medical_page_title'); ?></title>
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
                <h1><?php echo t('services_medical'); ?></h1>
                <p><?php echo t('medical_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="service-hero">
                        <div class="service-hero-content">
                            <h2><?php echo t('medical_about_title'); ?></h2>
                            <p><?php echo t('medical_about_desc'); ?></p>
                        </div>
                        <div class="service-hero-image">
                            <img src="images/maternala.jpg" alt="<?php echo t('medical_alt_text'); ?>" loading="lazy">
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
                                    <h4><?php echo t('medical_consultations_title'); ?></h4>
                                    <p><?php echo t('medical_consultations_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('medical_evaluations_title'); ?></h4>
                                    <p><?php echo t('medical_evaluations_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('medical_treatment_title'); ?></h4>
                                    <p><?php echo t('medical_treatment_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('medical_rehabilitation_title'); ?></h4>
                                    <p><?php echo t('medical_rehabilitation_desc'); ?></p>
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
                                <h4><?php echo t('medical_monitoring_title'); ?></h4>
                                <p><?php echo t('medical_monitoring_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <h4><?php echo t('medical_legislation_title'); ?></h4>
                                <p><?php echo t('medical_legislation_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-bed"></i>
                                </div>
                                <h4><?php echo t('medical_rehabilitation_interdisciplinary_title'); ?></h4>
                                <p><?php echo t('medical_rehabilitation_interdisciplinary_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h4><?php echo t('medical_schedule_title'); ?></h4>
                                <p><?php echo t('medical_schedule_desc'); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="service-gallery">
                        <h2><?php echo t('medical_gallery_title'); ?></h2>
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
                    </div>
                </div>
            </div>
        </section>
    </main>

        <?php include 'includes/footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>