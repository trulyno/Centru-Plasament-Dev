<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('administration_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('administration_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('administration_page_title'); ?></title>
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
                    <img src="images/logo.jpeg" alt="<?php echo t('logo_alt'); ?>" class="logo-image">
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
                    <?php echo getLanguageSelector('administratia.php'); ?>
                </div>
            </div>
        </div>
        
        <!-- Navigation Section -->
        <div class="nav-container">
            <div class="logo-mobile">
                <img src="images/logo.jpeg" alt="Logo CPRCVF" class="logo-mobile-image">
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
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"><?php echo t('nav_about'); ?> <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="administratia.php">Administrația</a></li>
                            <li><a href="organigrama.php">Organigrama</a></li>
                            
                            <li><a href="functii-vacante.php">Funcții Vacante</a></li>
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
                <h1>Administrația</h1>
                <p>Conducerea și personalul administrativ al centrului</p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <h2>Echipa Administrativă</h2>
                    <p>Mai jos găsiți informații despre echipa administrativă a centrului nostru, care asigură buna funcționare a instituției și calitatea serviciilor oferite.</p>
                    
                    <div class="admin-team-container">
                        <div class="admin-team-grid">
                            <!-- Director -->
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/director.png" alt="director" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Sergiu Oceretnîi</h3>
                                    <p class="admin-staff-position">Director</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Bacalu Ana inspector resurse umane.png" alt="iru" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Bacalu Ana</h3>
                                    <p class="admin-staff-position">Inspector Resurse Umane</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Țvetov Angela contabil șef.png" alt="contabilsef" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Țvetov Angela</h3>
                                    <p class="admin-staff-position">Contabil șef</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Mahmadbecov Rodica contabil.png" alt="contabil" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Mahmadbecov Rodica</h3>
                                    <p class="admin-staff-position">Contabil</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Cojușco Tatiana contabil.png" alt="contabil" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Cojușco Tatiana</h3>
                                    <p class="admin-staff-position">Contabil</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Bîrta Vladimir Jurist.png" alt="Jurist" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Bîrta Vladimir</h3>
                                    <p class="admin-staff-position">Jurist</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Țurcanu Vasile Inginer principal.png" alt="Inginerprincipal" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Țurcanu Vasile</h3>
                                    <p class="admin-staff-position">Inginer Principal</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Cojocaru Tatiana Asistent Social.png" alt="asistensocial" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Cojocaru Tatiana</h3>
                                    <p class="admin-staff-position">Asistent Social</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Toțkaia Angela Psiholog.png" alt="psiholog" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Toțkaia Angela</h3>
                                    <p class="admin-staff-position">Psiholog</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Ciorici Cătălina Șefă secție Maternală.png" alt="sefsecmati" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Ciorici Cătălina</h3>
                                    <p class="admin-staff-position">Șefă Secție Maternală</p>
                                </div>
                            </div>
                             <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Blaj Sorina Sef sectie Psihopedagogie.png" alt="sefpsihopedagogie" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Blaj Sorina</h3>
                                    <p class="admin-staff-position">Șef Secție Psihopedagogie</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Burunciuc Aurelia -Medic nutriționist.png" alt="medicnutritionist" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Burunciuc Aurelia</h3>
                                    <p class="admin-staff-position">Medic Nutriționist</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Corina Vozian sef sectie zi.png" alt="sefsectiezi" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Vozian Corina</h3>
                                    <p class="admin-staff-position">Șef Secție Zi</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Ecaterina David Sef sectie Respiro.png" alt="sefsectierespiro" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>David Ecaterina</h3>
                                    <p class="admin-staff-position">Șef Secție Respiro</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Timirgaz Violeta -Sef sectie reabilitare.png" alt="sefsectiezreabilitare" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Timigraz Violeta</h3>
                                    <p class="admin-staff-position">Șef Secție Reabilitare</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Ionita Natalia Secretar.png" alt="secretar" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Ionița Natalia</h3>
                                    <p class="admin-staff-position">Secretar</p>
                                </div>
                            </div>
                            <div class="admin-staff-card">
                                <div class="admin-staff-image">
                                    <img src="images/Capros Marina Sef sectie de Criza.png" alt="sectiecriza" loading="lazy" decoding="async">
                                </div>
                                <div class="admin-staff-info">
                                    <h3>Capros Marina</h3>
                                    <p class="admin-staff-position">Șef Secție Criză</p>
                                </div>
                            </div>



                        
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Audio Element -->
    <audio id="audioElement" preload="metadata">
        <source src="audio/18_Alexandru_Lozanciuc_-_Sa_daruim_copiilor_pamantul.mp3" type="audio/mpeg">
        Browser-ul tău nu suportă elementul audio.
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
            <p>&copy; 2025 Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă. Toate drepturile rezervate.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>