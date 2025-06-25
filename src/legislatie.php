<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('legislation_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('legislation_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('legislation_page_title'); ?></title>
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
                    <?php echo getLanguageSelector('legislatie.php'); ?>
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
                <h1>Legislație</h1>
                <p>Cadrul juridic care reglementează activitatea centrului</p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <h2>Cadru Legislativ</h2>
                    <p>Activitatea Centrului de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă este reglementată de un cadru legislativ complex, care asigură protecția drepturilor copilului și calitatea serviciilor oferite:</p>
                    
                    <div class="legislation-categories">
                        <div class="category-nav">
                            <button class="category-btn active" data-category="nationale">
                                <i class="fas fa-flag"></i> Acte Naționale
                            </button>
                            <button class="category-btn" data-category="internationale">
                                <i class="fas fa-globe"></i> Acte Internaționale
                            </button>
                            <button class="category-btn" data-category="interne">
                                <i class="fas fa-building"></i> Acte Interne
                            </button>
                            <button class="category-btn" data-category="metodologii">
                                <i class="fas fa-book"></i> Metodologii
                            </button>
                        </div>

                        <div class="category-content active" id="nationale">
                            <h3>Legislația Națională</h3>
                            <div class="legislation-grid">
                                <div class="legislation-card primary">
                                    <div class="legislation-icon">
                                        <i class="fas fa-balance-scale"></i>
                                    </div>
                                    <div class="legislation-content">
                                        <h4>Codul Familiei al Republicii Moldova</h4>
                                        <p>Actul normativ de bază care reglementează relațiile familiale și protecția copilului</p>
                                        <div class="legislation-details">
                                            <span class="detail-item"><i class="fas fa-calendar"></i> Adoptat: 2000</span>
                                            <span class="detail-item"><i class="fas fa-tag"></i> Categoria: Cod</span>
                                        </div>
                                        <a href="acte-nationale.php" class="legislation-link">
                                            <i class="fas fa-arrow-right"></i> Vezi detalii
                                        </a>
                                    </div>
                                </div>

                                <div class="legislation-card">
                                    <div class="legislation-icon">
                                        <i class="fas fa-shield-alt"></i>
                                    </div>
                                    <div class="legislation-content">
                                        <h4>Legea nr. 140/2013</h4>
                                        <p>Privind protecția specială a copiilor în situație de risc și separarea copilului de părinți</p>
                                        <div class="legislation-details">
                                            <span class="detail-item"><i class="fas fa-calendar"></i> Adoptat: 2013</span>
                                            <span class="detail-item"><i class="fas fa-tag"></i> Categoria: Lege specială</span>
                                        </div>
                                        <a href="acte-nationale.php" class="legislation-link">
                                            <i class="fas fa-arrow-right"></i> Vezi detalii
                                        </a>
                                    </div>
                                </div>

                                <div class="legislation-card">
                                    <div class="legislation-icon">
                                        <i class="fas fa-universal-access"></i>
                                    </div>
                                    <div class="legislation-content">
                                        <h4>Legea nr. 121/2010</h4>
                                        <p>Cu privire la drepturile persoanei cu dizabilități</p>
                                        <div class="legislation-details">
                                            <span class="detail-item"><i class="fas fa-calendar"></i> Adoptat: 2010</span>
                                            <span class="detail-item"><i class="fas fa-tag"></i> Categoria: Lege specială</span>
                                        </div>
                                        <a href="acte-nationale.php" class="legislation-link">
                                            <i class="fas fa-arrow-right"></i> Vezi detalii
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="category-content" id="internationale">
                            <h3>Acte Internaționale</h3>
                            <div class="legislation-grid">
                                <div class="legislation-card primary">
                                    <div class="legislation-icon">
                                        <i class="fas fa-globe"></i>
                                    </div>
                                    <div class="legislation-content">
                                        <h4>Convenția ONU cu privire la Drepturile Copilului</h4>
                                        <p>Tratatul fundamental pentru protecția drepturilor copilului la nivel global</p>
                                        <div class="legislation-details">
                                            <span class="detail-item"><i class="fas fa-calendar"></i> Ratificată: 1993</span>
                                            <span class="detail-item"><i class="fas fa-tag"></i> Categoria: Convenție UN</span>
                                        </div>
                                        <a href="acte-internationale.php" class="legislation-link">
                                            <i class="fas fa-arrow-right"></i> Vezi detalii
                                        </a>
                                    </div>
                                </div>

                                <div class="legislation-card">
                                    <div class="legislation-icon">
                                        <i class="fas fa-hands-helping"></i>
                                    </div>
                                    <div class="legislation-content">
                                        <h4>Convenția de la Haga</h4>
                                        <p>Privind protecția copiilor și cooperarea în materie de adopție internațională</p>
                                        <div class="legislation-details">
                                            <span class="detail-item"><i class="fas fa-calendar"></i> Ratificată: 1998</span>
                                            <span class="detail-item"><i class="fas fa-tag"></i> Categoria: Convenție</span>
                                        </div>
                                        <a href="acte-internationale.php" class="legislation-link">
                                            <i class="fas fa-arrow-right"></i> Vezi detalii
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="category-content" id="interne">
                            <h3>Acte Normative Interne</h3>
                            <div class="legislation-grid">
                                <div class="legislation-card">
                                    <div class="legislation-icon">
                                        <i class="fas fa-file-contract"></i>
                                    </div>
                                    <div class="legislation-content">
                                        <h4>Regulamentul de Organizare și Funcționare</h4>
                                        <p>Documentul care stabilește structura și atribuțiile centrului</p>
                                        <div class="legislation-details">
                                            <span class="detail-item"><i class="fas fa-calendar"></i> Ultima actualizare: 2024</span>
                                            <span class="detail-item"><i class="fas fa-tag"></i> Categoria: Regulament intern</span>
                                        </div>
                                        <a href="acte-interne.php" class="legislation-link">
                                            <i class="fas fa-arrow-right"></i> Vezi detalii
                                        </a>
                                    </div>
                                </div>

                                <div class="legislation-card">
                                    <div class="legislation-icon">
                                        <i class="fas fa-user-shield"></i>
                                    </div>
                                    <div class="legislation-content">
                                        <h4>Codul Deontologic</h4>
                                        <p>Principiile și normele etice pentru personalul centrului</p>
                                        <div class="legislation-details">
                                            <span class="detail-item"><i class="fas fa-calendar"></i> Adoptat: 2023</span>
                                            <span class="detail-item"><i class="fas fa-tag"></i> Categoria: Cod de conduită</span>
                                        </div>
                                        <a href="codul-deontologic.php" class="legislation-link">
                                            <i class="fas fa-arrow-right"></i> Vezi detalii
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="category-content" id="metodologii">
                            <h3>Metodologii și Proceduri</h3>
                            <div class="legislation-grid">
                                <div class="legislation-card">
                                    <div class="legislation-icon">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <div class="legislation-content">
                                        <h4>Metodologia de Evaluare a Copilului</h4>
                                        <p>Proceduri standardizate pentru evaluarea nevoilor copilului</p>
                                        <div class="legislation-details">
                                            <span class="detail-item"><i class="fas fa-calendar"></i> Versiunea: 2024</span>
                                            <span class="detail-item"><i class="fas fa-tag"></i> Categoria: Metodologie</span>
                                        </div>
                                        <a href="metodologii.php" class="legislation-link">
                                            <i class="fas fa-arrow-right"></i> Vezi detalii
                                        </a>
                                    </div>
                                </div>

                                <div class="legislation-card">
                                    <div class="legislation-icon">
                                        <i class="fas fa-heartbeat"></i>
                                    </div>
                                    <div class="legislation-content">
                                        <h4>Protocoale de Reabilitare</h4>
                                        <p>Ghiduri pentru serviciile de reabilitare medicală și socială</p>
                                        <div class="legislation-details">
                                            <span class="detail-item"><i class="fas fa-calendar"></i> Versiunea: 2024</span>
                                            <span class="detail-item"><i class="fas fa-tag"></i> Categoria: Protocol</span>
                                        </div>
                                        <a href="metodologii.php" class="legislation-link">
                                            <i class="fas fa-arrow-right"></i> Vezi detalii
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="compliance-section">
                        <h3>Conformitatea și Aplicarea</h3>
                        <div class="compliance-info">
                            <div class="compliance-card">
                                <div class="compliance-icon">
                                    <i class="fas fa-check-double"></i>
                                </div>
                                <div class="compliance-content">
                                    <h4>Monitorizarea Conformității</h4>
                                    <p>Verificarea regulată a aplicării normelor legale în activitatea zilnică</p>
                                </div>
                            </div>
                            <div class="compliance-card">
                                <div class="compliance-icon">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                                <div class="compliance-content">
                                    <h4>Formarea Personalului</h4>
                                    <p>Instruirea continuă a angajaților privind legislația aplicabilă</p>
                                </div>
                            </div>
                            <div class="compliance-card">
                                <div class="compliance-icon">
                                    <i class="fas fa-sync-alt"></i>
                                </div>
                                <div class="compliance-content">
                                    <h4>Actualizarea Procedurilor</h4>
                                    <p>Adaptarea procedurilor interne la modificările legislative</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="updates-section">
                        <h3>Actualizări Legislative</h3>
                        <div class="updates-timeline">
                            <div class="update-item">
                                <div class="update-date">Mai 2025</div>
                                <div class="update-content">
                                    <h4>Modificări în Codul Familiei</h4>
                                    <p>Îmbunătățiri ale procedurii de plasament și adopție</p>
                                </div>
                            </div>
                            <div class="update-item">
                                <div class="update-date">Martie 2025</div>
                                <div class="update-content">
                                    <h4>Noi standarde de calitate</h4>
                                    <p>Actualizarea standardelor pentru serviciile sociale</p>
                                </div>
                            </div>
                            <div class="update-item">
                                <div class="update-date">Ianuarie 2025</div>
                                <div class="update-content">
                                    <h4>Regulament intern actualizat</h4>
                                    <p>Revizuirea procedurilor operaționale interne</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="info-note">
                        <div class="info-icon">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div class="info-content">
                            <h4>Accesul la legislație</h4>
                            <p>Pentru accesul la documentele complete sau întrebări despre aplicarea legislației, contactați departamentul juridic al centrului la <a href="mailto:centru_plasament@agssi.md">centru_plasament@agssi.md</a> sau <a href="tel:022737027">022 737 027</a>.</p>
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
            <p><?php echo t('footer_copyright'); ?></p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>