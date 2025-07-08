<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';

function image($src, $category, $title = '', $desc = '') {
    echo '
        <div class="gallery-item" data-category="' . htmlspecialchars($category) . '">
            <img src="images/' . htmlspecialchars($src) . '" alt="' . htmlspecialchars($alt) . '" loading="lazy">
            <div class="gallery-overlay">
                <h3>' . htmlspecialchars($title) . '</h3>
                <p>' . htmlspecialchars($desc) . '</p>
                <div class="overlay-icon">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
        </div>';
}

function video($src, $category, $title = '', $desc = '') {
    echo '
        <div class="gallery-item" data-category="' . htmlspecialchars($category) . '" data-type="video">
            <video src="videos/' . htmlspecialchars($src) . '" loading="lazy" muted>
                Browser-ul tău nu suportă elementul video.
            </video>
            <div class="gallery-overlay">
                <h3>' . htmlspecialchars($title) . '</h3>
                <p>' . htmlspecialchars($desc) . '</p>
            </div>
        </div>';
}

?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('gallery_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('gallery_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('gallery_page_title'); ?></title>
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
                    <?php echo getLanguageSelector('galerie.php'); ?>
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
                <h1><?php echo t('gallery_section_title'); ?></h1>
                <p><?php echo t('gallery_section_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="gallery">
                    <div class="gallery-categories">
                        <button class="filter-btn active" data-filter="all"><?php echo t('gallery_filter_all'); ?></button>
                        <button class="filter-btn" data-filter="activities"><?php echo t('gallery_filter_activities'); ?></button>
                        <button class="filter-btn" data-filter="spaces"><?php echo t('gallery_filter_spaces'); ?></button>
                        <button class="filter-btn" data-filter="therapy"><?php echo t('gallery_filter_therapy'); ?></button>
                        <button class="filter-btn" data-filter="events"><?php echo t('gallery_filter_events'); ?></button>
                        <button class="filter-btn" data-filter="videos"><?php echo t('gallery_filter_videos'); ?></button>
                    </div>
                    <div class="gallery-grid">
                        <?php
                        image('zi10.jpg', 'spaces', 'Camera de Odihnă', 'Spații confortabile pentru relaxare');
                        image('zi11.jpg', 'spaces', 'Spații de Recreere', 'Zone dedicate jocului și relaxării');
                        image('maternala3.jpg', 'activities', '', '');
                        image('respiro3.jpg', 'spaces', 'Spații Respiro', 'Mediu sigur și confortabil pentru copii');
                        image('respiro6.jpg', 'spaces', 'Mediu Terapeutic', 'Spații special amenajate pentru terapie'); 
                        image('sap4.jpg', 'activities', 'Descoperirea Faunei', 'La gradina zoologica');
                        image('sap13.jpg', 'events', 'Eveniment Amuzant', 'Muzica,Dansuri si Baloane');
                        image('z21.jpg', 'activities', 'Confectionarea lucrarilor plastice', 'O amintire pe toata viata');
                        image('14.jpg', 'activities', 'Admirarea Gradinii Zoo', 'Plante exotice');
                        image('21.jpg', 'activities', 'Jocuri Gonflabile', 'Sarituri si fericire');
                        image('35.jpg', 'events', 'Festival Mascat', 'Copii mascati in eroii lor');
                        image('555.jpg', 'activities', 'Teatru cu marionete', 'Un spectacol calptivant');
                        image('585.jpg', 'activities', 'Bucuria copiilor', 'Castigarea unui concurs');
                        image('zoo1.jpeg', 'activities', 'Excursie  la Zoo', 'Copiii descopera animale noi');
                        image('zoo2.jpeg', 'activities', 'Animale noi si interesante', 'Copiii sunt multumiti');
                        image('zoo3.jpeg', 'activities', 'Habitatele animalelor', 'Copiii descopera unde locuiesc animalele');
                        image('zoo4.jpeg', 'activities', 'Animale la inaltime', 'Maimute si multi papagali');
                        image('zoo5.jpeg', 'activities', 'Animal de desert', 'Copiii descopera camila');
                        image('zoo6.jpeg', 'activities', 'Broasca Testoasa mangaiata de copii', 'Multa afectiune si iubire');
                        image('zoo7.jpeg', 'activities', 'La Izvor', 'O mica pauza de la aceasta aventura');
                        image('zoo8.jpeg', 'activities', 'Descoperirea Bufnitei', 'Singura data cand va fi treaza ziua');
                        image('zoo9.jpeg', 'activities', 'Animale prin copaci', 'Cum ele se tin atat de mult acolo?');
                        image('1.jpg', 'activities', '', '');
                        image('2.jpg', 'activities', '', '');
                        image('3.jpg', 'activities', '', '');
                        image('4.jpg', 'activities', '', '');
                        image('5.jpg', 'activities', '', '');
                        image('6.jpg', 'activities', '', '');
                        image('7.jpg', 'activities', '', '');
                        image('8.jpg', 'activities', '', '');
                        image('9.jpg', 'activities', '', '');
                        image('10.jpg', 'activities', '', '');
                        image('11.jpg', 'activities', '', '');
                        image('12.jpg', 'activities', '', '');
                        image('13.jpg', 'activities', '', '');
                        image('15.jpg', 'activities', '', '');
                        image('16.jpg', 'activities', '', '');
                        image('17.jpg', 'activities', '', '');
                        image('18.jpg', 'activities', '', '');
                        image('19.jpg', 'activities', '', '');
                        image('20.jpg', 'activities', '', '');
                        image('22.jpg', 'activities', '', '');
                        image('23.jpg', 'activities', '', '');
                        image('cresa1.jpg', 'activities', '', '');
                        image('cresa2.jpg', 'activities', '', '');
                        image('cresa3.jpg', 'activities', '', '');
                        image('cresa4.jpg', 'activities', '', '');
                        image('cresa5.jpg', 'activities', '', '');
                        image('cresa6.jpg', 'activities', '', '');
                        image('criza6.jpg', 'activities', '', '');
                        image('criza1.jpg', 'activities', '', '');
                        image('criza2.jpg', 'activities', '', '');
                        image('criza3.jpg', 'activities', '', '');
                        image('criza4.jpg', 'activities', '', '');
                        image('criza5.jpg', 'activities', '', '');
                        image('criza7.jpg', 'activities', '', '');
                        image('criza8.jpg', 'activities', '', '');
                        image('criza9.jpg', 'activities', '', '');
                        image('criza10.jpg', 'activities', '', '');
                        image('criza11.jpg', 'activities', '', '');
                        image('criza12.jpg', 'activities', '', '');
                        image('criza13.jpg', 'activities', '', '');
                        image('maternala1.jpg', 'activities', '', '');
                        image('maternala2.jpg', 'activities', '', '');
                        image('maternala4.jpg', 'activities', '', '');
                        image('maternala5.jpg', 'activities', '', '');
                        image('zi.jpg', 'activities', '', '');

                        video('video5363927670348345826.mp4', 'events', 'Eveniment Special', 'Sărbătorirea unor momente importante');
                        ?>         
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Gallery Modal -->
    <div class="gallery-modal" id="galleryModal">
        <div class="modal-backdrop"></div>
        <div class="modal-content">
            <button class="modal-close" id="modalClose" aria-label="Închide galeria">
                <i class="fas fa-times"></i>
            </button>
            <button class="modal-nav modal-prev" id="modalPrev" aria-label="Imagine precedentă">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="modal-nav modal-next" id="modalNext" aria-label="Imagine următoare">
                <i class="fas fa-chevron-right"></i>
            </button>
            <div class="modal-image-container">
                <img id="modalImage" src="" alt="" loading="lazy">
                <video id="modalVideo" controls style="display: none;">
                    <source src="" type="video/mp4">
                    Browser-ul tău nu suportă elementul video.
                </video>
            </div>
            <div class="modal-info">
                <h3 id="modalTitle"></h3>
                <p id="modalDescription"></p>
            </div>
        </div>
    </div>

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
            <p><?php echo t('footer_copyright'); ?></p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>