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
    <meta name="description" content="<?php echo t('services_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('services_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('site_title'); ?>">
    
    <title><?php echo t('services_page_title'); ?></title>
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
                <h1><?php echo t('services_social'); ?></h1>
                <p><?php echo t('social_header_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="service-hero">
                        <div class="service-hero-content">
                            <h2><?php echo t('social_about_title'); ?></h2>
                            <p><?php echo t('service_social_desc'); ?></p>  
                            <div class="service-mission-inline">
                                <p><?php echo t('social_mission_desc'); ?></p>
                            </div>
                            <div class="service-mission-inline">
                                <p><?php echo t('social_conclusion'); ?></p>
                            </div>
                        </div>
                        <div class="service-hero-image">
                            <img src="images/5.jpg" alt="<?php echo t('services_social'); ?>" loading="lazy">
                        </div>  
                    </div>

                    <!-- Integrated Services Section -->
                    <!-- <div class="service-categories-integrated">
                        <div class="services-intro">
                            <p><?php echo t('social_services_intro'); ?></p>
                        </div>
                        
                        <!-- Conclusion integrated at bottom -->
                        <!--<div class="service-conclusion-integrated">
                            
                        </div>
                    </div> -->

                    <div class="service-details">
                        <h2><?php echo t('services_title'); ?></h2>
                        <div class="services-list">
                            <!-- Main Service Categories -->
                            <div class="service-item featured">
                                <div class="service-icon">
                                    <i class="fas fa-hands-helping"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('social_personal_care_title'); ?></h4>
                                    <p><?php echo t('social_personal_care_desc'); ?></p>
                                </div>
                            </div>
                            
                            <div class="service-item featured">
                                <div class="service-icon">
                                    <i class="fas fa-brain"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('social_psychosocial_title'); ?></h4>
                                    <p><?php echo t('social_psychosocial_desc'); ?></p>
                                </div>
                            </div>
                            
                            <div class="service-item featured">
                                <div class="service-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('social_socialization_title'); ?></h4>
                                    <p><?php echo t('social_socialization_desc'); ?></p>
                                </div>
                            </div>
                            
                            <!-- Additional Service Details -->
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('service_title'); ?></h4>
                                    <p><?php echo t('service_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-ambulance"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('therapy_title'); ?></h4>
                                    <p><?php echo t('therapy_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-stethoscope"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('treatment_title'); ?></h4>
                                    <p><?php echo t('treatment_desc'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="documents-section">
                        <h2><?php echo t('documents_title'); ?></h2>
                        
                        <!-- Paid Service Documents -->
                        <div class="document-category">
                            <h3 class="document-category-title">
                                <i class="fas fa-credit-card" aria-hidden="true"></i>
                                <?php echo t('documents_paid_service_title'); ?>
                            </h3>
                            <div class="documents-list">
                                <div class="document-item">
                                    <div class="document-number">1</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_paid_1'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">2</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_paid_2'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">3</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_paid_3'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">4</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_paid_4'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">5</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_paid_5'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">6</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_paid_6'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">7</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_paid_7'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">8</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_paid_8'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">9</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_paid_9'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">10</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_paid_10'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">11</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_paid_11'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- State Maintenance Documents -->
                        <div class="document-category">
                            <h3 class="document-category-title">
                                <i class="fas fa-landmark" aria-hidden="true"></i>
                                <?php echo t('documents_state_maintenance_title'); ?>
                            </h3>
                            <p class="document-category-subtitle"><?php echo t('documents_state_maintenance_subtitle'); ?></p>
                            <div class="documents-list">
                                <div class="document-item">
                                    <div class="document-number">1</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_state_1'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">2</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_state_2'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">3</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_state_3'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">4</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_state_4'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">5</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_state_5'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">6</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_state_6'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">7</div>
                                    <div class="document-content">
                                        <p><strong><?php echo t('doc_state_7_title'); ?></strong></p>
                                        <ul class="document-sublist">
                                            <li><?php echo t('doc_state_7_a'); ?></li>
                                            <li><?php echo t('doc_state_7_b'); ?></li>
                                            <li><?php echo t('doc_state_7_c'); ?></li>
                                            <li><?php echo t('doc_state_7_d'); ?></li>
                                            <li><?php echo t('doc_state_7_e'); ?></li>
                                            <li><?php echo t('doc_state_7_f'); ?></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">8</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_state_8'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">9</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_state_9'); ?></p>
                                    </div>
                                </div>
                                <div class="document-item">
                                    <div class="document-number">10</div>
                                    <div class="document-content">
                                        <p><?php echo t('doc_state_10'); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="service-info">
                        <h2><?php echo t('important_info_title'); ?></h2>
                        <div class="info-grid">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h4><?php echo t('crisis_family_info_age_title'); ?></h4>
                                <p><?php echo t('crisis_family_info_age_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <h4><?php echo t('crisis_family_info_placement_title'); ?></h4>
                                <p><?php echo t('crisis_family_info_placement_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-gavel"></i>
                                </div>
                                <h4><?php echo t('crisis_family_info_admission_title'); ?></h4>
                                <p><?php echo t('crisis_family_info_admission_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-id-card"></i>
                                </div>
                                <h4><?php echo t('crisis_family_info_visiting_title'); ?></h4>
                                <p><?php echo t('crisis_family_info_visiting_desc'); ?></p>
                            </div>
                        </div>
                    </div> -->

                    <!-- <div class="service-gallery">
                        <h2><?php echo t('services_gallery_title'); ?></h2>
                        <div class="gallery-grid">
                            <div class="gallery-item">
                                <img src="images/.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/.jpg" alt="" loading="lazy">
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
