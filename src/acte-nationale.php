<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Acte normative naționale care reglementează activitatea Centrului de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă.">
    <meta name="keywords" content="acte naționale, legislație națională, norme legale">
    <meta name="author" content="Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă">
    
    <title>Acte Naționale - Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă</title>
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
        <a href="#main-content" class="skip-link">Salt la conținutul principal</a>
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
                    <?php echo getLanguageSelector('acte-nationale.php'); ?>
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
                <h1>Acte Naționale</h1>
                <p>Legislația națională care reglementează activitatea centrului</p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <h2>Acte Normative Naționale</h2>
                    <p>Activitatea Centrului de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă este reglementată de următoarele acte normative naționale:</p>
                    
                    <div class="documents-grid">
                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Codul Familiei al Republicii Moldova</h3>
                                <a href="https://www.legis.md/cautare/getResults?doc_id=112685&lang=ro" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>
                        </div>

                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Legea nr. 140/2013 privind protecția specială a copiilor în situație de risc</h3>
                                <a href="https://www.legis.md/cautare/getResults?doc_id=110518&lang=ro" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>
                        </div>

                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3> Legea nr. 547 din 25.12.2003 "Asistența Socială"</h3>
                                <a href="https://www.legis.md/cautare/getResults?doc_id=132934&lang=ro" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>
                        </div>

                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Legea nr. 140 din 14.06.2011 "Privind protecția specială a copiilor aflați în situație de risc și a copiilor separați de părinți"</h3>
                                <a href="https://www.legis.md/cautare/getResults?doc_id=146836&lang=ro#" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>
                        </div>

                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Legea nr. 123 din 18.06.2010 "Cu privire la serviciile sociale"</h3>
                                <a href="https://www.legis.md/cautare/getResults?doc_id=141516&lang=ro#" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>
                        </div>

                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Legea nr. 99 din 28.05.2010 "Privind regimul juridic al adopției"</h3>
                                <a href="https://www.legis.md/cautare/getResults?doc_id=138813&lang=ro#" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>
                        </div>

                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Legea nr. 338 din 15.12.1994 "Privind drepturile copilului"</h3>
                                <a href="https://www.legis.md/cautare/getResults?doc_id=140852&lang=ro#" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>
                        </div>

                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Legea nr. 60 din 30.03.2012 "Privind incluziunea socială a persoanelor cu dizabilități"</h3>
                                <a href="https://www.legis.md/cautare/getResults?doc_id=146155&lang=ro#" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>
                        </div>

                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Hotărârea de Guvern nr. 450 din 28.04.2006 "Pentru aprobarea Standartelor minime de calitate privind îngrijirea, educarea și socializarea copilului din Centrul de plasament temporar"</h3>
                                <a href="https://www.legis.md/cautare/getResults?doc_id=103705&lang=ro#" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>
                        </div>
                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Hotărârea Guvernului nr. 591 din 24 iulie 2017: Aprobă Regulamentul-cadru privind organizarea și funcționarea Serviciilor sociale de tip centru de plasament și standardele minime de calitate.</h3>
                                <a href="https://www.legis.md/cautare/getResults?doc_id=101381&lang=ro" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>
                        </div>
                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Ordinul nr. 114 din 24 mai 2024: Aprobă Ghidul privind Politica internă de protecție a copilului.</h3>
                                <a href="https://social.gov.md/wp-content/uploads/2024/05/Ordin-nr.-114_24.05.2024_Politica-interna-de-protectie.pdf" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>                        
                        </div>
                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Codul Muncii al Republicii Moldova: Aplicabil tuturor angajatorilor, inclusiv instituțiilor sociale de stat. </h3>
                                <a href="https://www.legis.md/cautare/getResults?doc_id=113032&lang=ro" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>
                        </div>
                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Ordinul N964 din 02.09.19, cu privire la standardul de supraveghere si dezvoltarii copilului in conditii de ambulator si a Carnetului de dezvoltare a copilului </h3>
                                <a href="https://old.msmps.gov.md/sites/default/files/legislatie/ordin_nr._964_din_020919.pdf" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>
                        </div>
                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Legea N23 din 16.03.2007, cu privire la profilaxia infectiei HIV/SIDA.</h3>
                                <a href="https://www.legis.md/cautare/getResults?doc_id=110180&lang=ro" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
                            </div>
                        </div>
                        <div class="document-card">
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <div class="document-content">
                                <h3>Legea N411 din 28.03.1995, cu privirea la ocrotirea sanatatii.</h3>
                                <a href="https://www.legis.md/cautare/getResults?doc_id=119465&lang=ro" class="document-link" target="_blank">
                                    <i class="fas fa-external-link-alt"></i> Vezi document
                                </a>
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