<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('day_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('day_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('day_page_title'); ?></title>
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
                <h1><?php echo t('day_header_title'); ?></h1>
                <p><?php echo t('day_header_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="service-hero">
                        <div class="service-hero-content">
                            <h2><?php echo t('day_about_title'); ?></h2>
                            <p><?php echo t('service_day_desc'); ?></p>
                        </div>
                        <div class="service-hero-image">
                            <img src="images/zi.jpg" alt="<?php echo t('day_header_title'); ?>" loading="lazy">
                        </div>
                    </div>

                    <div class="service-details">
                        <h2><?php echo t('day_services_title'); ?></h2>
                        <div class="services-list">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-stethoscope"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_service_medical_title'); ?></h4>
                                    <p><?php echo t('day_service_medical_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-spa"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_service_recovery_title'); ?></h4>
                                    <p><?php echo t('day_service_recovery_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-swimmer"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_service_hydro_title'); ?></h4>
                                    <p><?php echo t('day_service_hydro_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-hands-helping"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_service_occupational_title'); ?></h4>
                                    <p><?php echo t('day_service_occupational_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-comments"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_service_speech_title'); ?></h4>
                                    <p><?php echo t('day_service_speech_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-brain"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_service_behavioral_title'); ?></h4>
                                    <p><?php echo t('day_service_behavioral_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_service_psychological_title'); ?></h4>
                                    <p><?php echo t('day_service_psychological_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_service_psychopedagogical_title'); ?></h4>
                                    <p><?php echo t('day_service_psychopedagogical_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-apple-alt"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_service_nutritional_title'); ?></h4>
                                    <p><?php echo t('day_service_nutritional_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-eye"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('day_service_sensory_title'); ?></h4>
                                    <p><?php echo t('day_service_sensory_desc'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="documents-section">
                        <h2><?php echo t('documents_title'); ?></h2>
                        <p class="documents-intro"><?php echo t('day_documents_intro'); ?> <?php echo t('day_header_title'); ?>, <?php echo t('day_documents_required'); ?>:</p>
                        <div class="documents-list">
                            <div class="document-item" data-aos="fade-up" data-aos-delay="100">
                                <div class="document-icon">
                                    <i class="fas fa-file-medical" aria-hidden="true"></i>
                                </div>
                                <div class="document-content">
                                    <h5><?php echo t('day_document_referral_title'); ?></h5>
                                    <p><?php echo t('day_document_referral_desc'); ?></p>
                                </div>
                            </div>
                            <div class="document-item" data-aos="fade-up" data-aos-delay="200">
                                <div class="document-icon">
                                    <i class="fas fa-book" aria-hidden="true"></i>
                                </div>
                                <div class="document-content">
                                    <h5><?php echo t('day_document_development_title'); ?></h5>
                                    <p><?php echo t('day_document_development_desc'); ?></p>
                                </div>
                            </div>
                            <div class="document-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="document-icon">
                                    <i class="fas fa-id-card" aria-hidden="true"></i>
                                </div>
                                <div class="document-content">
                                    <h5><?php echo t('day_document_identity_title'); ?></h5>
                                    <p><?php echo t('day_document_identity_desc'); ?></p>
                                </div>
                            </div>
                            <div class="document-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="document-icon">
                                    <i class="fas fa-certificate" aria-hidden="true"></i>
                                </div>
                                <div class="document-content">
                                    <h5><?php echo t('day_document_disability_title'); ?></h5>
                                    <p><?php echo t('day_document_disability_desc'); ?></p>
                                </div>
                            </div>
                            <div class="document-item" data-aos="fade-up" data-aos-delay="500">
                                <div class="document-icon">
                                    <i class="fas fa-signature" aria-hidden="true"></i>
                                </div>
                                <div class="document-content">
                                    <h5><?php echo t('day_document_consent_title'); ?></h5>
                                    <p><?php echo t('day_document_consent_desc'); ?></p>
                                </div>
                            </div>
                            <div class="document-item" data-aos="fade-up" data-aos-delay="600">
                                <div class="document-icon">
                                    <i class="fas fa-shield-virus" aria-hidden="true"></i>
                                </div>
                                <div class="document-content">
                                    <h5><?php echo t('day_document_medical_title'); ?></h5>
                                    <p><?php echo t('day_document_medical_desc'); ?></p>
                                </div>
                            </div>
                            <div class="document-item" data-aos="fade-up" data-aos-delay="700">
                                <div class="document-icon">
                                    <i class="fas fa-edit" aria-hidden="true"></i>
                                </div>
                                <div class="document-content">
                                    <h5><?php echo t('day_document_application_title'); ?></h5>
                                    <p><?php echo t('day_document_application_desc'); ?></p>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="documents-note">
                            <div class="note-icon">
                                <i class="fas fa-info-circle" aria-hidden="true"></i>
                            </div>
                            <div class="note-content">
                                <h4>Informații importante</h4>
                                <p>Toate documentele trebuie să fie în copie și originale pentru verificare. Pentru mai multe detalii despre procedura de înregistrare, vă rugăm să ne contactați.</p>
                            </div>
                        </div> -->
                    </div>

                    <div class="service-info">
                        <h2><?php echo t('important_info_title'); ?></h2>
                        <div class="info-grid">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-child"></i>
                                </div>
                                <h4><?php echo t('day_info_age_title'); ?></h4>
                                <p><?php echo t('day_info_age_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h4><?php echo t('day_info_organization_title'); ?></h4>
                                <p><?php echo t('day_info_organization_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <h4><?php echo t('day_info_schedule_title'); ?></h4>
                                <p><?php echo t('day_info_schedule_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h4><?php echo t('day_info_coverage_title'); ?></h4>
                                <p><?php echo t('day_info_coverage_desc'); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="service-gallery">
                        <h2><?php echo t('day_gallery_title'); ?></h2>
                        <div class="gallery-grid">
                            <div class="gallery-item">
                                <img src="images/1.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/2.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/3.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/4.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/5.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/6.jpg" alt="" loading="lazy">
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