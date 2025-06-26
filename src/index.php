<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
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
    <link rel="icon" href="images/logo.ico" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
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

    <!-- Header -->
    <header class="header">
        <!-- Top Header Section -->
        <div class="header-top" id="headerTop">
            <button class="header-expand-btn" id="headerExpandBtn" aria-label="<?php echo t('expand_header'); ?>" aria-expanded="false">
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="header-top-container" id="headerTopContainer">
                <div class="header-logo">
                    <img src="images/logo.png  " alt="<?php echo t('logo_alt'); ?>" class="logo-image">
                    <div class="logo-text">
                        <h1 class="logo-text-full"><?php echo t('site_title_full'); ?></h1>
                        <h1 class="logo-text-abbreviated"><?php echo t('site_title_short'); ?></h1>
                    </div>
                </div>
                
                <div class="header-contact">
                    <div class="contact-info-header">
                        <div class="contact-item-header">
                            <i class="fas fa-phone"></i>
                            <div>
                                <span><?php echo t('contact_phone'); ?></span>
                                <a href="tel:022737027">022 737 027</a>
                            </div>
                        </div>
                        <div class="contact-item-header">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <span><?php echo t('contact_email'); ?></span>
                                <a href="mailto:centru_plasament@agssi.md">centru_plasament@agssi.md</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="<?php echo t('social_facebook'); ?>">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="<?php echo t('social_instagram'); ?>">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="<?php echo t('social_linkedin'); ?>">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="<?php echo t('social_youtube'); ?>">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    
                    <div class="donate-section">
                        <button class="donate-btn" aria-label="<?php echo t('donate_aria'); ?>" title="<?php echo t('btn_donate'); ?>">
                            <i class="fas fa-heart"></i>
                            <span><?php echo t('btn_donate'); ?></span>
                        </button>
                        <button class="audio-btn" id="audioBtn" aria-label="<?php echo t('anthem_aria'); ?>" title="<?php echo t('anthem_title'); ?>">
                            <i class="fas fa-music"></i>
                            <span><?php echo t('btn_anthem'); ?></span>
                        </button>
                        <button class="lyrics-btn" id="lyricsBtn" aria-label="<?php echo t('lyrics_aria'); ?>" title="<?php echo t('lyrics_title'); ?>">
                            <i class="fas fa-align-left"></i>
                            <span><?php echo t('btn_lyrics'); ?></span>
                        </button>
                    </div>
                    
                    <!-- Language Selector -->
                    <?php echo getLanguageSelector('index.php'); ?>
                </div>
            </div>
        </div>
        
        <!-- Navigation Section -->
        <div class="nav-container">
            <div class="logo-mobile">
                <img src="images/logo.png  " alt="Logo CPRCVF" class="logo-mobile-image">
                <i class="fas fa-heart"></i>
                <span>CPRCVF</span>
            </div>
            <div class="mobile-action-buttons">
                <button class="donate-btn" aria-label="<?php echo t('donate_aria'); ?>" title="<?php echo t('btn_donate'); ?>">
                    <i class="fas fa-heart"></i>
                </button>
                <button class="audio-btn" id="audioBtn" aria-label="<?php echo t('anthem_aria'); ?>" title="<?php echo t('anthem_title'); ?>">
                    <i class="fas fa-music"></i>
                </button>
                <button class="lyrics-btn" id="lyricsBtn" aria-label="<?php echo t('lyrics_aria'); ?>" title="<?php echo t('lyrics_title'); ?>">
                    <i class="fas fa-align-left"></i>
                </button>
            </div>
            <nav>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="index.php"><?php echo t('nav_home'); ?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"><?php echo t('nav_services'); ?> <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="sectia-criza-reintegrare-familiala.php"><?php echo t('services_crisis'); ?></a></li>
                            <li><a href="sectia-maternala.php"><?php echo t('services_maternal'); ?></a></li>
                            <li><a href="sectia-zi-4luni-3ani.php"><?php echo t('services_day_4m_3y'); ?></a></li>
                            <li><a href="sectia-de-zi.php"><?php echo t('services_day'); ?></a></li>
                            <li><a href="sectia-respiro.php"><?php echo t('services_respiro'); ?></a></li>
                            <li><a href="sectia-asistenta-psihopedagogica.php"><?php echo t('services_psycho_pedagogical'); ?></a></li>
                            <li><a href="sectia-reabilitare.php"><?php echo t('services_rehabilitation'); ?></a></li>
                            <li><a href="sectia-asistenta-medicala.php"><?php echo t('services_medical'); ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"><?php echo t('nav_about'); ?> <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="administratia.php"><?php echo t('about_administration'); ?></a></li>
                            <li><a href="organigrama.php"><?php echo t('about_organigram'); ?></a></li>
                            
                            <li><a href="functii-vacante.php"><?php echo t('about_vacant_positions'); ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"><?php echo t('nav_transparency'); ?> <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-nested">
                                <a href="#" class="dropdown-toggle-nested"><?php echo t('transparency_legislation'); ?> <i class="fas fa-chevron-right"></i></a>
                                <ul class="dropdown-menu-nested">
                                    <li><a href="acte-nationale.php"><?php echo t('legislation_national'); ?></a></li>
                                    <li><a href="acte-internationale.php"><?php echo t('legislation_international'); ?></a></li>
                                    <li><a href="acte-interne.php"><?php echo t('legislation_internal'); ?></a></li>
                                    <li><a href="codul-deontologic.php"><?php echo t('legislation_ethics_code'); ?></a></li>
                                    <li><a href="metodologii.php"><?php echo t('legislation_methodologies'); ?></a></li>
                                </ul>
                            </li>
                            <li class="dropdown-nested">
                                <a href="#" class="dropdown-toggle-nested"><?php echo t('transparency_procurement'); ?> <i class="fas fa-chevron-right"></i></a>
                                <ul class="dropdown-menu-nested">
                                    <li><a href="invitatii-participare.php"><?php echo t('procurement_invitations'); ?></a></li>
                                    <li><a href="planuri-achizitii.php"><?php echo t('procurement_plans'); ?></a></li>
                                    <li><a href="rapoarte-achizitii.php"><?php echo t('procurement_reports'); ?></a></li>
                                </ul>
                            </li>
                            <li><a href="proiecte.php"><?php echo t('transparency_projects'); ?></a></li>
                            <li><a href="rapoarte.php"><?php echo t('transparency_reports'); ?></a></li>
                            <li><a href="registru-cadouri.php"><?php echo t('transparency_gifts_register'); ?></a></li>
                            <li><a href="petitii-reclamatii.php"><?php echo t('transparency_petitions'); ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"><?php echo t('nav_info_support'); ?> <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="ghiduri.php"><?php echo t('info_guides'); ?></a></li>
                            <li><a href="intrebari-frecvente.php"><?php echo t('info_faq'); ?></a></li>
                        </ul>
                    </li>
                    <li><a href="galerie.php"><?php echo t('nav_gallery'); ?></a></li>
                    <li><a href="index.php#contact"><?php echo t('nav_contact'); ?></a></li>
                    <li><a href="index.php#partners"><?php echo t('nav_partners'); ?></a></li>
                </ul>
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>
        </div>
    </header>

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
                    <img src="images/logo (1) (1).png" alt="<?php echo t('hero_slide_1_title'); ?>" loading="lazy">
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
                    <img src="images/zi10.jpg" alt="<?php echo t('hero_slide_2_title'); ?>" loading="lazy">
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
                    <img src="images/zoo1.jpeg" alt="<?php echo t('hero_slide_3_title'); ?>" loading="lazy">
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
                <div class="about-text fade-in">
                    <p id="pin"><?php echo t('about_text_1'); ?><br><br></p> 

                    <p id="target"><?php echo t('about_text_2'); ?><br><br></p>

                    <p id="capacity"><?php echo t('about_text_3'); ?></p>  
                </div>
                <div class="about-image fade-in">
                    <img src="images/intrare.jpg" alt="Intrarea în Centrul de Plasament și Reabilitare" loading="lazy">
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container" id="main-content">
            <h2 class="section-title fade-in"><?php echo t('services_section_title'); ?></h2>
            <!-- <p class="section-subtitle fade-in"><?php echo t('services_section_subtitle'); ?></p> -->
            <div class="services-grid">
                <a href="sectia-criza-reintegrare-familiala.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/criza.jpg" alt="<?php echo t('services_crisis'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_crisis'); ?></h3>
                    <p><?php echo t('service_crisis_desc'); ?></p>
                </a>
                <a href="sectia-maternala.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/maternala2.jpg" alt="<?php echo t('services_maternal'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_maternal'); ?></h3>
                    <p><?php echo t('service_maternal_desc'); ?></p>
                </a>
                <a href="sectia-zi-4luni-3ani.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/zi7.jpg" alt="<?php echo t('services_day_4m_3y'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_day_4m_3y'); ?></h3>
                    <p><?php echo t('service_day_4m_3y_desc'); ?></p>
                </a>
                <a href="sectia-de-zi.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/zi1.png" alt="<?php echo t('services_day'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_day'); ?></h3>
                    <p><?php echo t('service_day_desc'); ?></p>
                </a>
                <a href="sectia-respiro.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/respiro3.jpg" alt="<?php echo t('services_respiro'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_respiro'); ?></h3>
                    <p><?php echo t('service_respiro_desc'); ?></p>
                </a>
                <a href="sectia-asistenta-psihopedagogica.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/sap1.jpg" alt="<?php echo t('services_psycho_pedagogical'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_psycho_pedagogical'); ?></h3>
                    <p><?php echo t('service_psycho_desc'); ?></p>
                </a>
                <a href="sectia-reabilitare.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/masaj.jpg" alt="<?php echo t('services_rehabilitation'); ?>" loading="lazy">
                    </div>
                    <h3><?php echo t('services_rehabilitation'); ?></h3>
                    <p><?php echo t('service_rehabilitation_desc'); ?></p>
                </a>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item fade-in">
                    <h3 id="stat1">0</h3>
                    <p><?php echo t('stats_children'); ?></p>
                </div>
                <div class="stat-item fade-in">
                    <h3 id="stat2">0</h3>
                    <p>Externați cu Succes</p>
                </div>
                <div class="stat-item fade-in">
                    <h3 id="stat3">0</h3>
                    <p>Copii Încredințați spre Adopție</p>
                </div>
                <div class="stat-item fade-in">
                    <h3 id="stat4">0</h3>
                    <p><?php echo t('stats_years'); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Preview Section -->
    <section class="gallery-preview" id="gallery">
        <div class="container">
            <h2 class="section-title fade-in"><?php echo t('gallery_section_title'); ?></h2>
            <p class="section-subtitle fade-in"><?php echo t('gallery_section_subtitle'); ?></p>
            
            <!-- Gallery Slideshow -->
            <div class="gallery-slideshow">
                <div class="gallery-slide active">
                    <img src="images/respiro3.jpg" alt="<?php echo t('gallery_playroom_desc'); ?>" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3><?php echo t('gallery_playroom_title'); ?></h3>
                        <p><?php echo t('gallery_playroom_desc'); ?></p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/zi10.jpg" alt="<?php echo t('gallery_rest_desc'); ?>" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3><?php echo t('gallery_rest_title'); ?></h3>
                        <p><?php echo t('gallery_rest_desc'); ?></p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/zi6.jpg" alt="<?php echo t('gallery_educational_desc'); ?>" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3><?php echo t('gallery_educational_title'); ?></h3>
                        <p><?php echo t('gallery_educational_desc'); ?></p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/maternala2.jpg" alt="<?php echo t('gallery_garden_desc'); ?>" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3><?php echo t('gallery_garden_title'); ?></h3>
                        <p><?php echo t('gallery_garden_desc'); ?></p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/maternala5.jpg" alt="<?php echo t('gallery_events_desc'); ?>" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3><?php echo t('gallery_events_title'); ?></h3>
                        <p><?php echo t('gallery_events_desc'); ?></p>
                    </div>
                </div>
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
            <div class="partners-grid">
                <a href="https://social.gov.md/" target="_blank" class="partner-card fade-in">
                    <div class="partner-image">
                        <img src="images/logo-mps.webp" alt="MMPS" loading="lazy">
                    </div>
                    <div class="partner-content">
                        <h3>Ministerul Muncii și Protecţiei Sociale</h3>
                    </div>
                </a>
                <a href="https://agssi.md/" target="_blank" class="partner-card fade-in">
                    <div class="partner-image">
                        <img src="images/logo-mps.webp" alt="AGSSI" loading="lazy">
                    </div>
                    <div class="partner-content">
                        <h3>Agenția pentru Gestionarea Serviciilor cu Specializare Înaltă</h3>
                    </div>
                </a>
                <a href="https://ms.gov.md//" target="_blank" class="partner-card fade-in">
                    <div class="partner-image">
                        <img src="https://ms.gov.md/wp-content/uploads/2023/03/ministerul-s%C4%83n%C4%83t%C4%83%C8%9Bii-monocrom.png" alt="MSGOV" loading="lazy">
                    </div>
                    <div class="partner-content">
                        <h3>Ministerul Sănătății al Republicii Moldova</h3>
                    </div>
                </a>
                <a href="https://mec.gov.md/" target="_blank" class="partner-card fade-in">
                    <div class="partner-image">
                        <img src="https://dgpdc.md/wp-content/uploads/2023/07/11.png" alt="Ministerul Educatiei și Cercetarii" loading="lazy">
                    </div>
                    <div class="partner-content">
                        <h3>Ministerul Educației și Cercetării</h3>
                    </div>
                </a>
                <a href="https://www.unicef.org/moldova/" target="_blank" class="partner-card fade-in">
                    <div class="partner-image">
                        <img src="https://dgpdc.md/wp-content/uploads/2023/07/DGETS-1.png" alt="UNICEF Moldova" loading="lazy">
                    </div>
                    <div class="partner-content">
                        <h3>UNICEF Moldova</h3>
                    </div>
                </a>
                <a href="https://cpam.md/" target="_blank" class="partner-card fade-in">
                    <div class="partner-image">
                        <img src="https://cpam.md/wp-content/uploads/2018/06/777-2-1-2-1-1-2.png" alt="CPAM" loading="lazy">
                    </div>
                    <div class="partner-content">
                        <h3>Colegiul "Alexei Mateevici"</h3>
                    </div>
                </a>
                <a href="https://usm.md/" target="_blank" class="partner-card fade-in">
                    <div class="partner-image">
                        <img src="https://usm.md/wp-content/uploads/Logo_USM-221x300.png" alt="USM" loading="lazy">
                    </div>
                    <div class="partner-content">
                        <h3>Universitatea de Stat din Moldova</h3>
                    </div>
                </a>
                <a href="files/CCF.pdf" target="_blank" class="partner-card fade-in">
                    <div class="partner-image">
                        <img src="images/CCF Moldova.png" alt="CCF Moldova" loading="lazy">
                    </div>
                    <div class="partner-content">
                        <h3>CCF Moldova</h3>
                    </div>
                </a>
                <a href="files/Memorandum MMPS - OGI .pdf" target="_blank" class="partner-card fade-in">
                    <div class="partner-image">
                        <img src="images/ogi.png" alt="OGI Moldova" loading="lazy">
                    </div>
                    <div class="partner-content">
                        <h3>OGI Moldova</h3>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title fade-in"><?php echo t('testimonials_section_title'); ?></h2>
            <p class="section-subtitle fade-in"><?php echo t('testimonials_section_subtitle'); ?></p>
            <div class="testimonials-slideshow">
                <div class="testimonial-slide active">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"<?php echo t('testimonial_1_text'); ?>"</p>
                        <div class="testimonial-author">
                            <strong><?php echo t('testimonial_1_author'); ?></strong>
                            <span><?php echo t('testimonial_1_role'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"<?php echo t('testimonial_2_text'); ?>"</p>
                        <div class="testimonial-author">
                            <strong><?php echo t('testimonial_2_author'); ?></strong>
                            <span><?php echo t('testimonial_2_role'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"<?php echo t('testimonial_3_text'); ?>"</p>
                        <div class="testimonial-author">
                            <strong><?php echo t('testimonial_3_author'); ?></strong>
                            <span><?php echo t('testimonial_3_role'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"<?php echo t('testimonial_4_text'); ?>"</p>
                        <div class="testimonial-author">
                            <strong><?php echo t('testimonial_4_author'); ?></strong>
                            <span><?php echo t('testimonial_4_role'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"<?php echo t('testimonial_5_text'); ?>"</p>
                        <div class="testimonial-author">
                            <strong><?php echo t('testimonial_5_author'); ?></strong>
                            <span><?php echo t('testimonial_5_role'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"<?php echo t('testimonial_6_text'); ?>"</p>
                        <div class="testimonial-author">
                            <strong><?php echo t('testimonial_6_author'); ?></strong>
                            <span><?php echo t('testimonial_6_role'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"<?php echo t('testimonial_7_text'); ?>"</p>
                        <div class="testimonial-author">
                            <strong><?php echo t('testimonial_7_author'); ?></strong>
                            <span><?php echo t('testimonial_7_role'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"<?php echo t('testimonial_8_text'); ?>"</p>
                        <div class="testimonial-author">
                            <strong><?php echo t('testimonial_8_author'); ?></strong>
                            <span><?php echo t('testimonial_8_role'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"<?php echo t('testimonial_9_text'); ?>"</p>
                        <div class="testimonial-author">
                            <strong><?php echo t('testimonial_9_author'); ?></strong>
                            <span><?php echo t('testimonial_9_role'); ?></span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"<?php echo t('testimonial_10_text'); ?>"</p>
                        <div class="testimonial-author">
                            <strong><?php echo t('testimonial_10_author'); ?></strong>
                            <span><?php echo t('testimonial_10_role'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
                
            <div class="testimonials-nav">
                <button class="testimonial-btn active" data-testimonial="0"></button>
                <button class="testimonial-btn" data-testimonial="1"></button>
                <button class="testimonial-btn" data-testimonial="2"></button>
                <button class="testimonial-btn" data-testimonial="3"></button>
                <button class="testimonial-btn" data-testimonial="4"></button>
                <button class="testimonial-btn" data-testimonial="5"></button>
                <button class="testimonial-btn" data-testimonial="6"></button>
                <button class="testimonial-btn" data-testimonial="7"></button>
                <button class="testimonial-btn" data-testimonial="8"></button>
                <button class="testimonial-btn" data-testimonial="9"></button>
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
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong><?php echo t('contact_main_office'); ?></strong><br>
                            022 737 027
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong><?php echo t('contact_emergency'); ?></strong><br>
                            022 737 027
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <strong>Email:</strong><br>
                            centru_plasament@agssi.md
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <strong><?php echo t('contact_address'); ?></strong><br>
                            <?php echo t('contact_address_full'); ?>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <strong><?php echo t('contact_hours'); ?></strong><br>
                            <?php echo t('contact_hours_detail'); ?>
                        </div>
                    </div>
                </div>
                <div class="contact-form fade-in">
                    <h3 style="margin-bottom: 1.5rem; color: #2c3e50;"><?php echo t('contact_send_message'); ?></h3>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="name"><?php echo t('contact_form_name'); ?> *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><?php echo t('contact_form_email'); ?> *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
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
                        <div class="form-group">
                            <label for="message"><?php echo t('contact_form_message'); ?> *</label>
                            <textarea id="message" name="message" placeholder="<?php echo t('contact_form_message_placeholder'); ?>" required></textarea>
                        </div>
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i> <?php echo t('contact_form_send'); ?>
                        </button>
                    </form>
                </div>
                <div class="contact-map fade-in">
                    <h3 style="margin-bottom: 1.5rem; color: #2c3e50;"><?php echo t('contact_location_title'); ?></h3>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2721.1901148342927!2d28.825826984130842!3d46.99723990457751!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c97e96e1ce9959%3A0x3a7beac63524b2c2!2sCenter%20for%20the%20Placement%20and%20Rehabilitation%20of%20Young%20Children!5e0!3m2!1sen!2s!4v1748940567054!5m2!1sen!2s"
                            width="100%" 
                            height="300" 
                            style="border:0; border-radius: 10px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="<?php echo t('contact_location_title'); ?>">
                        </iframe>
                    </div>
                    <div class="map-directions">
                        <h4 style="margin-top: 1rem; margin-bottom: 0.5rem; color: #2c3e50;"><?php echo t('contact_how_to_find'); ?></h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                                <i class="fas fa-bus" style="color: #4a90e2; margin-right: 0.5rem; min-width: 20px;"></i>
                                <span><?php echo t('contact_transport_1'); ?></span>
                            </li>
                            <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                                <i class="fas fa-car" style="color: #4a90e2; margin-right: 0.5rem; min-width: 20px;"></i>
                                <span><?php echo t('contact_transport_2'); ?></span>
                            </li>
                            <li style="display: flex; align-items: center;">
                                <i class="fas fa-wheelchair" style="color: #4a90e2; margin-right: 0.5rem; min-width: 20px;"></i>
                                <span><?php echo t('contact_transport_3'); ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Audio Element -->
    <audio id="audioElement" preload="metadata">
        <source src="audio/18_Alexandru_Lozanciuc_-_Sa_daruim_copiilor_pamantul.mp3" type="audio/mpeg">
        <?php echo t('audio_not_supported'); ?>
    </audio>

    <!-- Lyrics Modal -->
    <div class="lyrics-modal" id="lyricsModal">
        <div class="lyrics-modal-content">
            <div class="lyrics-header">
                <h3><?php echo t('lyrics_modal_title'); ?></h3>
                <button class="lyrics-close-btn" id="lyricsCloseBtn" aria-label="<?php echo t('lyrics_close'); ?>">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="lyrics-body">
                <h4>Alexandru Lozanciuc - Să dăruim copiilor pământul</h4>
                <div class="lyrics-text">
                    <p>Nimic mai sfânt ca soarele<br>
                    Ce luminează viața noastră pe pământ<br>
                    Nimic mai sfânt pe acest pământ<br>
                    Ca mamele cu prunci prin soare alergând</p>
                    
                    <p>Cât de uimit ne dăruiesc<br>
                    Copiii noștri ce alăturea ne cresc<br>
                    Nimic mai drag pe acest meleag<br>
                    Decât copilul așteptându-te-n prag</p>
                    
                    <p>Hai oameni, hai să dăruim copiilor<br>
                    Pământul nostru neîmpărțit, neîmpărțit<br>
                    Hai oameni, hai să dăruim copiilor<br>
                    Pământul nostru înflorit, nepustiit</p>
                    
                    <p>Să fie toate acestea și în viitor<br>
                    Să aibă fiii noștri în case prunci lor<br>
                    Să nu lăsăm pământul să ne ardă în foc<br>
                    Să crească copilașii noștri cu noroc</p>

                    <p>Nimic mai sfânt ca pacea-n noi<br>
                    În timp de pace sunt și viața omului<br>
                    Nimic mai scump, mai omenesc<br>
                    Ca pacea pe care oamenii râvnesc</p>
                    
                    <p>Cât de uimiți și semne noi<br>
                    Când mire și mireasă trec pe lângă noi<br>
                    Câte minuni, băi oameni buni<br>
                    În orice seară pot copiii să-ți adun</p>
                    
                    <p>Hai oameni, hai să dăruim copiilor<br>
                    Pământul nostru neîmpărțit, neîmpărțit<br>
                    Hai oameni, hai să dăruim copiilor<br>
                    Pământul nostru înflorit, nepustiit</p>
                    
                    <p>Să fie toate acestea și în viitor<br>
                    Să aibă fiii noștri în case prunci lor<br>
                    Să nu lăsăm pământul să ne ardă în foc<br>
                    Să crească copilașii noștri cu noroc</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p><?php echo t('footer_copyright'); ?></p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
