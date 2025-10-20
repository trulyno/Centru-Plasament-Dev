<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
require_once __DIR__ . '/includes/gdpr.php';
require_once __DIR__ . '/includes/analytics.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $html_lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta tags for SEO and accessibility -->
    <meta name="description" content="<?php echo t('meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    <meta property="og:title" content="<?php echo t('meta_og_title'); ?>">
    <meta property="og:description" content="<?php echo t('meta_og_description'); ?>">
    <meta property="og:type" content="website">
    
    <title><?php echo t('site_title'); ?></title>
    <link rel="icon" href="images/logo.ico" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="./style.css" rel="stylesheet">
    <link href="gdpr-styles.css" rel="stylesheet">
</head>
<body class="index-page">
    <!-- Loading overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <!-- Accessibility improvements -->
    <div class="skip-links">
        <a href="#main-content" class="skip-link"><?php echo t('skip_to_content'); ?></a>
    </div>

    <?php include 'includes/header.php'; ?>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-slideshow">
            <div class="slide active">
                <div class="slide-content">
                    <div class="slide-text">
                        <h1><?php echo t('hero_slide_1_title'); ?></h1>
                        <p><?php echo t('hero_slide_1_text'); ?></p>
                        <a href="#contact" class="cta-button"><?php echo t('hero_slide_1_cta'); ?></a>
                    </div>
                </div>
                <div class="slide-image">
                    <img src="images/14.jpg" alt="<?php echo t('hero_slide_1_title'); ?>" loading="lazy">
                </div>
            </div>
            <div class="slide">
                <div class="slide-content">
                    <div class="slide-text">
                        <h1><?php echo t('hero_slide_2_title'); ?></h1>
                        <p><?php echo t('hero_slide_2_text'); ?></p>
                        <a href="#services" class="cta-button"><?php echo t('hero_slide_2_cta'); ?></a>
                    </div>
                </div>
                <div class="slide-image">
                    <img src="images/19.jpg" alt="<?php echo t('hero_slide_2_title'); ?>" loading="lazy">
                </div>
            </div>
            <div class="slide">
                <div class="slide-content">
                    <div class="slide-text">
                        <h1><?php echo t('hero_slide_3_title'); ?></h1>
                        <p><?php echo t('hero_slide_3_text'); ?></p>
                        <a href="#about" class="cta-button"><?php echo t('hero_slide_3_cta'); ?></a>
                    </div>
                </div>
                <div class="slide-image">
                    <img src="images/28.jpg" alt="<?php echo t('hero_slide_3_title'); ?>" loading="lazy">
                </div>
            </div>
        </div>
        <div class="slideshow-nav">
            <button class="slide-btn active" data-slide="0"></button>
            <button class="slide-btn" data-slide="1"></button>
            <button class="slide-btn" data-slide="2"></button>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <h2><?php echo t('about_section_title'); ?></h2><br>
            
            <div class="about-content">
                <div class="about-left">
                    <!-- About Navigation Buttons -->
                    <div class="about-tabs">
                        <button class="about-tab-btn active" data-tab="about-us"><?php echo t('about_tab_about_us'); ?></button>
                        <button class="about-tab-btn" data-tab="mission"><?php echo t('about_tab_mission'); ?></button>
                        <button class="about-tab-btn" data-tab="beneficiaries"><?php echo t('about_tab_beneficiaries'); ?></button>
                    </div>
                    
                    <div class="about-text-container">
                        <!-- About Us Tab Content -->
                        <div class="about-text fade-in about-tab-content active" id="about-us">
                            <p><?php echo t('about_text_1'); ?></p>
                        </div>
                        
                        <!-- Mission Tab Content -->
                        <div class="about-text fade-in about-tab-content" id="mission">
                            <p><?php echo t('about_text_2'); ?></p>
                        </div>
                        
                        <!-- Beneficiaries Tab Content -->
                        <div class="about-text fade-in about-tab-content" id="beneficiaries">
                            <p><?php echo t('about_text_3'); ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="about-image fade-in">
                    <img src="images/31.jpg" alt="" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Information Section -->
    <section class="info-section services-info" id="services-info">
        <div class="container">
            <h2 class="section-title fade-in"><?php echo t('info_services_title'); ?></h2>
            <div class="info-content fade-in">
                <p class="section-subtitle fade-in"><?php echo t('info_services_intro'); ?></p>
                
                <h3 class="info-subtitle"><?php echo t('info_services_title_1'); ?></h3>
                <ol class="info-list">
                    <li><?php echo t('info_service_1_1'); ?></li>
                    <li><?php echo t('info_service_1_2'); ?></li>
                    <li><?php echo t('info_service_1_3'); ?></li>
                    <li><?php echo t('info_service_1_4'); ?></li>
                </ol>

                <h3 class="info-subtitle"><?php echo t('info_services_title_2'); ?></h3>
                <ol class="info-list">
                    <li><?php echo t('info_service_2_1'); ?></li>
                    <li><?php echo t('info_service_2_2'); ?></li>
                    <li><?php echo t('info_service_2_3'); ?></li>
                </ol>

                <h3 class="info-subtitle"><?php echo t('info_services_title_3'); ?></h3>
                <ol class="info-list">
                    <li><?php echo t('info_service_3_1'); ?></li>
                    <li><?php echo t('info_service_3_2'); ?></li>
                    <li><?php echo t('info_service_3_3'); ?></li>
                    <li><?php echo t('info_service_3_4'); ?></li>
                </ol>

                <h3 class="info-subtitle"><?php echo t('info_services_title_4'); ?></h3>
                <ol class="info-list">
                    <li><?php echo t('info_service_4_1'); ?></li>
                    <li><?php echo t('info_service_4_2'); ?></li>
                    <li><?php echo t('info_service_4_3'); ?></li>
                    <li><?php echo t('info_service_4_4'); ?></li>
                </ol>
                
                <h3 class="info-subtitle"><?php echo t('info_services_note_1'); ?></h3>
                <h3 class="info-subtitle"><?php echo t('info_services_note_2'); ?></h3>
            </div>
        </div>
    </section>

    <!-- Activities Section -->
    <!-- <section class="info-section activities-info" id="activities-info">
        <div class="container">
            <h2 class="section-title fade-in"><?php echo t('info_activities_title'); ?></h2>
            <div class="info-content fade-in">
                <p class="section-subtitle fade-in"><?php echo t('info_activities_intro'); ?></p>
                
                <!-- Activity Cards Grid -->
                <!-- <div class="activities-grid">
                    <a href="activitati_educationale.php" class="activity-card fade-in">
                        <div class="activity-image">
                            <img src="images/POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Eu respect demnitatea umană!.jpg" alt="<?php echo t('activities_educational'); ?>" loading="lazy">
                        </div>
                        <div class="activity-info">
                            <h3><?php echo t('activities_educational'); ?></h3>
                            <p><?php echo t('activities_educational_header_subtitle'); ?></p>
                            <span class="activity-link-text">
                                <?php echo t('info_learn_more'); ?> <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                    
                    <a href="activitati_recreative.php" class="activity-card fade-in">
                        <div class="activity-image">
                            <img src="images/POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/Jocuri și activități în aer liber/Copilăria e despre joacă2.jpg" alt="<?php echo t('activities_recreational'); ?>" loading="lazy">
                        </div>
                        <div class="activity-info">
                            <h3><?php echo t('activities_recreational'); ?></h3>
                            <p><?php echo t('activities_recreational_header_subtitle'); ?></p>
                            <span class="activity-link-text">
                                <?php echo t('info_learn_more'); ?> <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                    
                    <a href="dezvoltare_personala.php" class="activity-card fade-in">
                        <div class="activity-image">
                            <img src="images/POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/ateliere de artterapie,muzica, sport/Activități de ergoterapie3.jpg" alt="<?php echo t('personal_development'); ?>" loading="lazy">
                        </div>
                        <div class="activity-info">
                            <h3><?php echo t('personal_development'); ?></h3>
                            <p><?php echo t('personal_development_header_subtitle'); ?></p>
                            <span class="activity-link-text">
                                <?php echo t('info_learn_more'); ?> <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                    
                    <a href="evenimente_speciale.php" class="activity-card fade-in">
                        <div class="activity-image">
                            <img src="images/POZE CENTRU/EVENIMENTE SPECIALE/vizite ale partenerilor/Școala de Arte E.Coca din or.Soroca.jpg" alt="<?php echo t('special_events'); ?>" loading="lazy">
                        </div>
                        <div class="activity-info">
                            <h3><?php echo t('special_events'); ?></h3>
                            <p><?php echo t('special_events_header_subtitle'); ?></p>
                            <span class="activity-link-text">
                                <?php echo t('info_learn_more'); ?> <i class="fas fa-arrow-right"></i>
                            </span>
                        </div>
                    </a>
                </div>
                <br>
                <p class="info-note"><?php echo t('info_activities_note'); ?></p>
            </div>
        </div>
    </section> -->

    <!-- Gallery Preview Section -->
    <section class="gallery-preview" id="gallery">
        <div class="container">
            <h2 class="section-title fade-in"><?php echo t('gallery_section_title'); ?></h2>
            <p class="section-subtitle fade-in"><?php echo t('gallery_section_subtitle'); ?></p>
            
            <!-- Gallery Slideshow -->
            <div class="gallery-slideshow">
                <!-- Previous Button -->
                <button class="gallery-nav-btn gallery-prev-btn" id="galleryPrevBtn">
                    <i class="fas fa-chevron-left"></i>
                </button>
                
                <div class="gallery-slide active">
                    <img src="images/1.jpg" alt="<?php echo t(''); ?>" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3><?php echo t(''); ?></h3>
                        <p><?php echo t(''); ?></p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/9.jpg" alt="<?php echo t(''); ?>" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3><?php echo t(''); ?></h3>
                        <p><?php echo t(''); ?></p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/5.jpg" alt="<?php echo t(''); ?>" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3><?php echo t(''); ?></h3>
                        <p><?php echo t(''); ?></p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/16.jpg" alt="<?php echo t(''); ?>" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3><?php echo t(''); ?></h3>
                        <p><?php echo t(''); ?></p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/25.jpg" alt="<?php echo t(''); ?>" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3><?php echo t(''); ?></h3>
                        <p><?php echo t(''); ?></p>
                    </div>
                </div>
                
                <!-- Next Button -->
                <button class="gallery-nav-btn gallery-next-btn" id="galleryNextBtn">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
            
            <!-- Gallery Navigation -->
            <div class="gallery-slideshow-nav">
                <button class="gallery-slide-btn active" data-slide="0"></button>
                <button class="gallery-slide-btn" data-slide="1"></button>
                <button class="gallery-slide-btn" data-slide="2"></button>
                <button class="gallery-slide-btn" data-slide="3"></button>
                <button class="gallery-slide-btn" data-slide="4"></button>
            </div>
            
            <!-- View All Gallery Button -->
            <div class="gallery-cta fade-in">
                <a href="galerie.php" class="gallery-view-all-btn">
                    <i class="fas fa-images"></i>
                    <?php echo t('gallery_view_all'); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <h2 class="section-title fade-in"><?php echo t('contact_section_title'); ?></h2>
            <p class="section-subtitle fade-in"><?php echo t('contact_section_subtitle'); ?></p>
            <div class="contact-grid">
                <div class="contact-info fade-in">
                    <h3 style="margin-bottom: 1.5rem; color: #2c3e50;"><?php echo t('contact_get_in_touch'); ?></h3>
                    <div class="contact-items-grid">
                        <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <strong><?php echo t('contact_main_office'); ?></strong><br>
                                023 528 871
                            </div>
                        </div>
                        <!-- <div class="contact-item">
                            <i class="fas fa-phone"></i>
                            <div>
                                <strong><?php echo t('contact_emergency'); ?></strong><br>
                                022 737 027
                            </div>
                        </div> -->
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong>Email:</strong><br>
                                cp.orhei@agssi.md
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-clock"></i>
                            <div>
                                <strong><?php echo t('contact_hours'); ?></strong><br>
                                <?php echo t('contact_hours_detail'); ?>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <strong><?php echo t('contact_address'); ?></strong><br>
                                <?php echo t('contact_address_full'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contact-map fade-in">
                    <h3 style="margin-bottom: 1.5rem; color: #2c3e50;"><?php echo t('contact_location_title'); ?></h3>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1686.808689242363!2d28.838609039041113!3d47.378613759053!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cbef7204ebcf09%3A0x3c9304d0889f6307!2sstrada%20Valeriu%20Cupcea%204%2C%20Orhei%2C%20Moldova!5e1!3m2!1sen!2s!4v1760983826280!5m2!1sen!2s"
                            width="100%" 
                            height="400" 
                            style="border:0; border-radius: 10px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="<?php echo t('contact_location_title'); ?>">
                        </iframe>
                    </div>
                </div>
            </div>
            <div class="contact-form-container">
                <div class="contact-form fade-in">
                    <h3 style="margin-bottom: 1.5rem; color: #2c3e50;"><?php echo t('contact_send_message'); ?></h3>
                    <form id="contactForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name"><?php echo t('contact_form_name'); ?> *</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo t('contact_form_email'); ?> *</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone"><?php echo t('contact_form_phone'); ?></label>
                                <input type="tel" id="phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="subject"><?php echo t('contact_form_subject'); ?> *</label>
                                <select id="subject" name="subject" required>
                                    <option value=""><?php echo t('contact_form_subject_select'); ?></option>
                                    <option value="informații generale"><?php echo t('contact_form_subject_general'); ?></option>
                                    <option value="plasament urgență"><?php echo t('contact_form_subject_emergency'); ?></option>
                                    <option value="adopție"><?php echo t('contact_form_subject_adoption'); ?></option>
                                    <option value="voluntariat"><?php echo t('contact_form_subject_volunteer'); ?></option>
                                    <option value="donații"><?php echo t('contact_form_subject_donations'); ?></option>
                                    <option value="altceva"><?php echo t('contact_form_subject_other'); ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message"><?php echo t('contact_form_message'); ?> *</label>
                            <textarea id="message" name="message" placeholder="<?php echo t('contact_form_message_placeholder'); ?>" required></textarea>
                        </div>
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i> <?php echo t('contact_form_send'); ?>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script src="script.js"></script>
    <script src="gdpr-script.js"></script>
</body>
</html>
