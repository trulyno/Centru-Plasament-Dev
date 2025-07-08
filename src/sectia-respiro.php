<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('respiro_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('respiro_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('respiro_page_title'); ?></title>
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
                    <?php echo getLanguageSelector('sectia-respiro.php'); ?>
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

    <!-- Main Content -->
    <main class="main-content" id="main-content">
        <section class="page-header">
            <div class="container">
                <h1><?php echo t('services_respiro'); ?></h1>
                <p><?php echo t('respiro_header_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="service-hero">
                        <div class="service-hero-content">
                            <h2><?php echo t('respiro_about_title'); ?></h2>
                            <p><?php echo t('service_respiro_desc'); ?></p>
                        </div>
                        <div class="service-hero-image">
                            <img src="images/respiro3.jpg" alt="<?php echo t('services_respiro'); ?>" loading="lazy">
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
                                    <h4><?php echo t('respiro_service_protection_title'); ?></h4>
                                    <p><?php echo t('respiro_service_protection_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('respiro_service_training_title'); ?></h4>
                                    <p><?php echo t('respiro_service_training_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('respiro_service_nonstop_title'); ?></h4>
                                    <p><?php echo t('respiro_service_nonstop_desc'); ?></p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="service-content">
                                    <h4><?php echo t('respiro_service_prevention_title'); ?></h4>
                                    <p><?php echo t('respiro_service_prevention_desc'); ?></p>
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
                                <h4><?php echo t('respiro_info_beneficiaries_title'); ?></h4>
                                <p><?php echo t('respiro_info_beneficiaries_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <h4><?php echo t('respiro_info_duration_title'); ?></h4>
                                <p><?php echo t('respiro_info_duration_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h4><?php echo t('respiro_info_geographic_title'); ?></h4>
                                <p><?php echo t('respiro_info_geographic_desc'); ?></p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <h4><?php echo t('respiro_info_purpose_title'); ?></h4>
                                <p><?php echo t('respiro_info_purpose_desc'); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="service-gallery">
                        <h2><?php echo t('respiro_gallery_title'); ?></h2>
                        <div class="gallery-grid">
                            <div class="gallery-item">
                                <img src="images/zi10.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/respiro2.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/respiro3.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/respiro4.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/respiro5.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/respiro6.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4><?php echo t(''); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="contact-cta">
                        <h3><?php echo t('contact_title'); ?></h3>
                        <p><?php echo t('service_contact_desc') ?></p>
                        <a href="index.php#contact" class="cta-button"><?php echo t('contact_button'); ?></a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Audio Element -->
    <audio id="audioElement" preload="metadata">
        <source src="audio/18_Alexandru_Lozanciuc_-_Sa_daruim_copiilor_pamantul.mp3" type="audio/mpeg">
        <?php echo t('audio_not_supported'); ?>
    </audio>

    <!-- Lyrics Modal -->
    <div class="lyrics-modal" id="lyricsModal">
        <div class="lyrics-modal-content">
            <div class="lyrics-header">
                <h3>Versurile imnului instituției</h3>
                <button class="lyrics-close-btn" id="lyricsCloseBtn" aria-label="Închide versurile">
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