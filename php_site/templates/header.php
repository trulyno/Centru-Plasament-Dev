<?php
/**
 * Header template included on all pages
 */
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta tags for SEO and accessibility -->
    <meta name="description" content="<?php echo isset($pageDescription) ? $pageDescription : 'Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă oferă îngrijire cuprinzătoare pentru copiii mici în nevoie. Plasament sigur, terapie, suport educațional și servicii de reunificare familială.'; ?>">
    <meta name="keywords" content="<?php echo isset($pageKeywords) ? $pageKeywords : 'plasament copii, reabilitare, plasament familial, adopție, terapie pentru copii, servicii familiale'; ?>">
    <meta name="author" content="Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă">
    <meta property="og:title" content="<?php echo getPageTitle(getCurrentPage()); ?>">
    <meta property="og:description" content="<?php echo isset($pageDescription) ? $pageDescription : 'Oferim medii sigure și îngrijitoare unde copiii mici pot să se vindece și să crească.'; ?>">
    <meta property="og:type" content="website">
    
    <title><?php echo getPageTitle(getCurrentPage()); ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
</head>
<body<?php echo (getCurrentPage() === 'index') ? ' class="index-page"' : ''; ?>>
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
            <button class="header-expand-btn" id="headerExpandBtn" aria-label="Extinde header" aria-expanded="false">
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="header-top-container" id="headerTopContainer">
                <div class="header-logo">
                    <img src="/assets/images/logo.jpeg" alt="Logo Centru Plasament" class="logo-image">
                    <div class="logo-text">
                        <h1>Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă din municipiul Chișinău</h1>
                    </div>
                </div>
                
                <div class="header-contact">
                    <div class="contact-info-header">
                        <div class="contact-item-header">
                            <i class="fas fa-phone"></i>
                            <div>
                                <span>Telefon</span>
                                <a href="tel:<?php echo CONTACT_PHONE; ?>"><?php echo CONTACT_PHONE; ?></a>
                            </div>
                        </div>
                        <div class="contact-item-header">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <span>Email</span>
                                <a href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a>
                            </div>
                        </div>
                        <div class="contact-item-header">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <span>Adresă</span>
                                <address><?php echo CONTACT_ADDRESS; ?></address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navigation Menu -->
        <nav class="main-navigation">
            <div class="nav-container">
                <button class="mobile-menu-btn" id="mobileMenuBtn" aria-label="Meniu mobil">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                
                <ul class="nav-menu" id="navMenu">
                    <li class="<?php echo isActive('index'); ?>"><a href="/">Acasă</a></li>
                    <li class="has-dropdown <?php echo isActive('sectia-maternala') || isActive('sectia-rezidentiala') || isActive('sectia-de-zi') || isActive('sectia-reabilitare') || isActive('sectia-respiro') || isActive('sectia-zi-4luni-3ani') ? 'active' : ''; ?>">
                        <a href="#">Subdiviziuni <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li class="<?php echo isActive('sectia-maternala'); ?>"><a href="/sectia-maternala">Secția Maternală</a></li>
                            <li class="<?php echo isActive('sectia-rezidentiala'); ?>"><a href="/sectia-rezidentiala">Secția Rezidențială</a></li>
                            <li class="<?php echo isActive('sectia-de-zi'); ?>"><a href="/sectia-de-zi">Secția de Zi</a></li>
                            <li class="<?php echo isActive('sectia-reabilitare'); ?>"><a href="/sectia-reabilitare">Secția de Reabilitare</a></li>
                            <li class="<?php echo isActive('sectia-respiro'); ?>"><a href="/sectia-respiro">Secția Respiro</a></li>
                            <li class="<?php echo isActive('sectia-zi-4luni-3ani'); ?>"><a href="/sectia-zi-4luni-3ani">Secția Zi (4 luni - 3 ani)</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown <?php echo isActive('administratia') || isActive('organigrama') || isActive('functii-vacante') ? 'active' : ''; ?>">
                        <a href="#">Despre Noi <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li class="<?php echo isActive('administratia'); ?>"><a href="/administratia">Administrația</a></li>
                            <li class="<?php echo isActive('organigrama'); ?>"><a href="/organigrama">Organigrama</a></li>
                            <li class="<?php echo isActive('functii-vacante'); ?>"><a href="/functii-vacante">Funcții Vacante</a></li>
                        </ul>
                    </li>
                    <li class="<?php echo isActive('galerie'); ?>"><a href="/galerie">Galerie</a></li>
                    <li class="has-dropdown <?php echo isActive('legislatie') || isActive('acte-nationale') || isActive('acte-internationale') || isActive('acte-interne') || isActive('ghiduri') || isActive('metodologii') || isActive('codul-deontologic') ? 'active' : ''; ?>">
                        <a href="#">Legislație <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li class="<?php echo isActive('acte-nationale'); ?>"><a href="/acte-nationale">Acte Naționale</a></li>
                            <li class="<?php echo isActive('acte-internationale'); ?>"><a href="/acte-internationale">Acte Internaționale</a></li>
                            <li class="<?php echo isActive('acte-interne'); ?>"><a href="/acte-interne">Acte Interne</a></li>
                            <li class="<?php echo isActive('ghiduri'); ?>"><a href="/ghiduri">Ghiduri</a></li>
                            <li class="<?php echo isActive('metodologii'); ?>"><a href="/metodologii">Metodologii</a></li>
                            <li class="<?php echo isActive('codul-deontologic'); ?>"><a href="/codul-deontologic">Codul Deontologic</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown <?php echo isActive('achizitii') || isActive('planuri-achizitii') || isActive('invitatii-participare') || isActive('rapoarte-achizitii') ? 'active' : ''; ?>">
                        <a href="#">Achiziții <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li class="<?php echo isActive('planuri-achizitii'); ?>"><a href="/planuri-achizitii">Planuri de Achiziții</a></li>
                            <li class="<?php echo isActive('invitatii-participare'); ?>"><a href="/invitatii-participare">Invitații de Participare</a></li>
                            <li class="<?php echo isActive('rapoarte-achizitii'); ?>"><a href="/rapoarte-achizitii">Rapoarte de Achiziții</a></li>
                        </ul>
                    </li>
                    <li class="has-dropdown <?php echo isActive('rapoarte') || isActive('registru-cadouri') ? 'active' : ''; ?>">
                        <a href="#">Transparență <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li class="<?php echo isActive('rapoarte'); ?>"><a href="/rapoarte">Rapoarte</a></li>
                            <li class="<?php echo isActive('registru-cadouri'); ?>"><a href="/registru-cadouri">Registru de Cadouri</a></li>
                        </ul>
                    </li>
                    <li class="<?php echo isActive('proiecte'); ?>"><a href="/proiecte">Proiecte</a></li>
                    <li class="has-dropdown <?php echo isActive('intrebari-frecvente') || isActive('petitii-reclamatii') ? 'active' : ''; ?>">
                        <a href="#">Info Utile <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li class="<?php echo isActive('intrebari-frecvente'); ?>"><a href="/intrebari-frecvente">Întrebări Frecvente</a></li>
                            <li class="<?php echo isActive('petitii-reclamatii'); ?>"><a href="/petitii-reclamatii">Petiții și Reclamații</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Main Content Area -->
    <main id="main-content">
