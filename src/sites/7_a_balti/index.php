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
    <link href="style.css" rel="stylesheet">
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
                    <img src="images/12.jpg" alt="<?php echo t('hero_slide_2_title'); ?>" loading="lazy">
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
                    <img src="images/8.jpg" alt="<?php echo t('hero_slide_3_title'); ?>" loading="lazy">
                </div>
            </div>
            <div class="slide">
                <div class="slide-content">
                    <div class="slide-text">
                        <h1><?php echo t('hero_slide_4_title'); ?></h1>
                        <p><?php echo t('hero_slide_4_text'); ?></p>
                        <a href="#about" class="cta-button"><?php echo t('hero_slide_4_cta'); ?></a>
                    </div>
                </div>
                <div class="slide-image">
                    <img src="images/15.jpg" alt="<?php echo t('hero_slide_4_title'); ?>" loading="lazy">
                </div>
            </div>
        </div>
        <div class="slideshow-nav">
            <button class="slide-btn active" data-slide="0"></button>
            <button class="slide-btn" data-slide="1"></button>
            <button class="slide-btn" data-slide="2"></button>
            <button class="slide-btn" data-slide="3"></button>
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
                    <img src="images/1.jpg" alt="Intrarea în Centrul de Plasament" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <!-- <section class="services" id="services">
        <div class="container" id="main-content">
            <h2 class="section-title fade-in"><?php echo t('services_section_title'); ?></h2>
            <!-- <p class="section-subtitle fade-in"><?php echo t('services_section_subtitle'); ?></p> -->
            <!-- <div class="services-grid">
                <a href="sectia-criza-reintegrare-familiala.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/criza2.jpg" alt="<?php echo t('services_crisis'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_crisis'); ?></h3>
                    <p><?php echo t('crisis_header_subtitle'); ?></p>
                </a>
                <a href="sectia-maternala.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/maternala5.jpg" alt="<?php echo t('services_maternal'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_maternal'); ?></h3>
                    <p><?php echo t('maternal_header_subtitle'); ?></p>
                </a>
                <a href="sectia-zi-4luni-3ani.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/cresa3.jpg" alt="<?php echo t('services_day_4m_3y'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_day_4m_3y'); ?></h3>
                    <p><?php echo t('day_4m_3y_header_subtitle'); ?></p>
                </a>
                <a href="sectia-de-zi.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/zi.jpg" alt="<?php echo t('services_day'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_day'); ?></h3>
                    <p><?php echo t('day_header_subtitle'); ?></p>
                </a>
                <a href="sectia-respiro.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/respiro3.jpg" alt="<?php echo t('services_respiro'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_respiro'); ?></h3>
                    <p><?php echo t('respiro_header_subtitle'); ?></p>
                </a>
                <a href="sectia-asistenta-psihopedagogica.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/sap4.jpg" alt="<?php echo t('services_psycho_pedagogical'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_psycho_pedagogical'); ?></h3>
                    <p><?php echo t('psycho_pedagogical_header_subtitle'); ?></p>
                </a>
                <a href="sectia-reabilitare.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/reabilitare5.jpg" alt="<?php echo t('services_rehabilitation'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_rehabilitation'); ?></h3>
                    <p><?php echo t('rehabilitation_header_subtitle'); ?></p>
                </a>
                <a href="sectia-asistenta-medicala.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/med2.jpg" alt="<?php echo t('services_medical'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('medical_about_title'); ?></h3>
                    <p><?php echo t('medical_subtitle'); ?></p>
                </a>
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
                    <img src="images/2.jpg" alt="<?php echo t(''); ?>" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3><?php echo t(''); ?></h3>
                        <p><?php echo t(''); ?></p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/3.jpg" alt="<?php echo t(''); ?>" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3><?php echo t(''); ?></h3>
                        <p><?php echo t(''); ?></p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/4.jpg" alt="<?php echo t(''); ?>" loading="lazy">
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
                    <img src="images/6.jpg" alt="<?php echo t(''); ?>" loading="lazy">
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

    <!-- Partners Section -->
    <section class="partners" id="partners">
        <div class="container">
            <h2 class="section-title fade-in"><?php echo t('partners_section_title'); ?></h2>
            <p class="section-subtitle fade-in"><?php echo t('partners_section_subtitle'); ?></p>
            <div class="partners-slider">
                <div class="partners-track">
                    <a href="https://social.gov.md/" target="_blank" class="partner-slide">
                        <img src="images/logo-mps.webp" alt="MMPS" loading="lazy">
                    </a>
                    <a href="https://AGSSSI.md/" target="_blank" class="partner-slide">
                        <img src="images/logo-mps.webp" alt="AGSSSI" loading="lazy">
                    </a>
                    <a href="https://ms.gov.md//" target="_blank" class="partner-slide">
                        <img src="https://ms.gov.md/wp-content/uploads/2023/03/ministerul-s%C4%83n%C4%83t%C4%83%C8%9Bii-monocrom.png" alt="MSGOV" loading="lazy">
                    </a>
                    <!-- <a href="https://mec.gov.md/" target="_blank" class="partner-slide">
                        <img src="https://dgpdc.md/wp-content/uploads/2023/07/11.png" alt="Ministerul Educatiei și Cercetarii" loading="lazy">
                    </a>
                    <a href="https://www.unicef.org/moldova/" target="_blank" class="partner-slide">
                        <img src="https://dgpdc.md/wp-content/uploads/2023/07/DGETS-1.png" alt="UNICEF Moldova" loading="lazy">
                    </a>
                    <a href="https://cpam.md/" target="_blank" class="partner-slide">
                        <img src="https://cpam.md/wp-content/uploads/2018/06/777-2-1-2-1-1-2.png" alt="CPAM" loading="lazy">
                    </a>
                    <a href="https://usm.md/" target="_blank" class="partner-slide">
                        <img src="https://usm.md/wp-content/uploads/Logo_USM-221x300.png" alt="USM" loading="lazy">
                    </a>
                    <a href="files/CCF.pdf" target="_blank" class="partner-slide">
                        <img src="images/CCF Moldova.png" alt="CCF Moldova" loading="lazy">
                    </a>
                    <a href="files/Memorandum MMPS - OGI .pdf" target="_blank" class="partner-slide">
                        <img src="images/ogi.png" alt="OGI Moldova" loading="lazy">
                    </a> -->
                    <!-- Duplicate slides for seamless loop -->
                    <a href="https://social.gov.md/" target="_blank" class="partner-slide">
                        <img src="images/logo-mps.webp" alt="MMPS" loading="lazy">
                    </a>
                    <a href="https://AGSSSI.md/" target="_blank" class="partner-slide">
                        <img src="images/logo-mps.webp" alt="AGSSSI" loading="lazy">
                    </a>
                    <a href="https://ms.gov.md//" target="_blank" class="partner-slide">
                        <img src="https://ms.gov.md/wp-content/uploads/2023/03/ministerul-s%C4%83n%C4%83t%C4%83%C8%9Bii-monocrom.png" alt="MSGOV" loading="lazy">
                    </a>
                    <!-- <a href="https://mec.gov.md/" target="_blank" class="partner-slide">
                        <img src="https://dgpdc.md/wp-content/uploads/2023/07/11.png" alt="Ministerul Educatiei și Cercetarii" loading="lazy">
                    </a>
                    <a href="https://www.unicef.org/moldova/" target="_blank" class="partner-slide">
                        <img src="https://dgpdc.md/wp-content/uploads/2023/07/DGETS-1.png" alt="UNICEF Moldova" loading="lazy">
                    </a>
                    <a href="https://cpam.md/" target="_blank" class="partner-slide">
                        <img src="https://cpam.md/wp-content/uploads/2018/06/777-2-1-2-1-1-2.png" alt="CPAM" loading="lazy">
                    </a>
                    <a href="https://usm.md/" target="_blank" class="partner-slide">
                        <img src="https://usm.md/wp-content/uploads/Logo_USM-221x300.png" alt="USM" loading="lazy">
                    </a>
                    <a href="files/CCF.pdf" target="_blank" class="partner-slide">
                        <img src="images/CCF Moldova.png" alt="CCF Moldova" loading="lazy">
                    </a>
                    <a href="files/Memorandum MMPS - OGI .pdf" target="_blank" class="partner-slide">
                        <img src="images/ogi.png" alt="OGI Moldova" loading="lazy">
                    </a> -->
                </div>
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
                                023 125 142
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <strong>Email:</strong><br>
                                cp.balti@agssi.md
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
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d951.484252081934!2d27.91967477413015!3d47.74201100237943!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40cb671ff1ed6665%3A0x2e51a4499b3272cf!2sStr.%20Veteranilor%2C%20B%C4%83l%C8%9Bi%2C%20Moldova!5e1!3m2!1sen!2s!4v1760465651273!5m2!1sen!2s"
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
