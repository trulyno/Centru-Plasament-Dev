<?php
require('file_loader.php');
?>

<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Meta tags for SEO and accessibility -->
    <meta name="description" content="Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă oferă îngrijire cuprinzătoare pentru copiii mici în nevoie. Plasament sigur, terapie, suport educațional și servicii de reunificare familială.">
    <meta name="keywords" content="plasament copii, reabilitare, plasament familial, adopție, terapie pentru copii, servicii familiale">
    <meta name="author" content="Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă">
    <meta property="og:title" content="Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă">
    <meta property="og:description" content="Oferim medii sigure și îngrijitoare unde copiii mici pot să se vindece și să crească.">
    <meta property="og:type" content="website">
    
    <title>Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă</title>
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
                    <img src="images/logo.jpeg" alt="Logo Centru Plasament" class="logo-image">
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
                                <a href="tel:022737027">022 737 027</a>
                            </div>
                        </div>
                        <div class="contact-item-header">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <span>Email</span>
                                <a href="mailto:centru_plasament@agssi.md">centru_plasament@agssi.md</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    
                    <div class="donate-section">
                        <button class="donate-btn" aria-label="Donează pentru a sprijini copiii" title="Donează">
                            <i class="fas fa-heart"></i>
                            <span>Donează</span>
                        </button>
                        <button class="audio-btn" id="audioBtn" aria-label="Imnul instituției" title="Imnul instituției: Alexandru Lozanciuc - Să dăruim copiilor pământul">
                            <i class="fas fa-music"></i>
                            <span>Imn</span>
                        </button>
                        <button class="lyrics-btn" id="lyricsBtn" aria-label="Afișează versurile" title="Versurile imnului">
                            <i class="fas fa-align-left"></i>
                            <span>Versuri</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Navigation Section -->
        <div class="nav-container">
            <div class="logo-mobile">
                <i class="fas fa-heart"></i>
                <span>CPRCVF</span>
            </div>
            <nav>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="index.html">Acasă</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Servicii <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="sectia-reabilitare.html">Secția Reabilitare</a></li>
                            <li><a href="sectia-rezidentiala.html">Secția Rezidențială</a></li>
                            <li><a href="sectia-respiro.html">Secția Respiro</a></li>
                            <li><a href="sectia-zi-4luni-3ani.html">Secția Zi (4 luni - 3 ani)</a></li>
                            <li><a href="sectia-maternala.html">Secția Maternală</a></li>
                            <li><a href="sectia-de-zi.html">Secția de Zi</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Despre Noi <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="administratia.html">Administrația</a></li>
                            <li><a href="organigrama.html">Organigrama</a></li>
                            <li><a href="subdiviziune.html">Subdiviziune</a></li>
                            <li><a href="functii-vacante.html">Funcții Vacante</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Transparența <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-nested">
                                <a href="#" class="dropdown-toggle-nested">Legislație <i class="fas fa-chevron-right"></i></a>
                                <ul class="dropdown-menu-nested">
                                    <li><a href="acte-nationale.html">Acte Naționale</a></li>
                                    <li><a href="acte-internationale.html">Acte Internaționale</a></li>
                                    <li><a href="acte-interne.html">Acte Interne</a></li>
                                    <li><a href="codul-deontologic.html">Codul Deontologic</a></li>
                                    <li><a href="metodologii.html">Metodologii</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-nested">
                                <a href="#" class="dropdown-toggle-nested">Achiziții <i class="fas fa-chevron-right"></i></a>
                                <ul class="dropdown-menu-nested">
                                    <li><a href="invitatii-participare.html">Invitații de Participare</a></li>
                                    <li><a href="planuri-achizitii.html">Planuri de Achiziții</a></li>
                                    <li><a href="rapoarte-achizitii.html">Rapoarte de Achiziții</a></li>
                                </ul>
                            </li>
                            <li><a href="proiecte.html">Proiecte</a></li>
                            <li><a href="rapoarte.html">Rapoarte</a></li>
                            <li><a href="registru-cadouri.html">Registru Cadouri</a></li>
                            <li><a href="petitii-reclamatii.html">Petiții și Reclamații</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Suport Informațional <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="ghiduri.html">Ghiduri</a></li>
                            <li><a href="intrebari-frecvente.html">Întrebări Frecvente</a></li>
                        </ul>
                    </li>
                    <li><a href="galerie.html">Galerie</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="#partners">Parteneri</a></li>
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
            <?php for ($i = 0; $i < count($GLOBALS['HERO_TITLES']); $i++): ?>
            <div class="slide <?php echo $i === 0 ? 'active' : ''; ?>">
                <div class="slide-content">
                    <div class="slide-text">
                        <h1><?php echo htmlspecialchars($GLOBALS['HERO_TITLES'][$i]); ?></h1>
                        <p><?php echo htmlspecialchars($GLOBALS['HERO_DESCRIPTIONS'][$i]); ?></p>
                        <a href="<?php echo htmlspecialchars($GLOBALS['HERO_LINKS'][$i] ?? '#contact'); ?>" class="cta-button">
                            <?php echo htmlspecialchars($GLOBALS['HERO_BUTTONS'][$i] ?? 'Obține Ajutor Acum'); ?>
                        </a>
                    </div>
                </div>
                <div class="slide-image">
                    <img src="images/<?php echo htmlspecialchars($GLOBALS['HERO_IMAGES'][$i]); ?>" 
                         alt="<?php echo htmlspecialchars($GLOBALS['HERO_TITLES'][$i]); ?>" loading="lazy">
                </div>
            </div>
            <?php endfor; ?>
        </div>
        <div class="slideshow-nav">
            <?php for ($i = 0; $i < count($GLOBALS['HERO_TITLES']); $i++): ?>
            <button class="slide-btn <?php echo $i === 0 ? 'active' : ''; ?>" data-slide="<?php echo $i; ?>"></button>
            <?php endfor; ?>
        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <div class="container">
            <h2><?php echo htmlspecialchars($GLOBALS['ABOUT_TITLE'][0] ?? 'Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă din municipiul Chișinău'); ?></h2>
            <div class="about-content">
                <div class="about-text fade-in">
                    &nbsp;<p id="pin">&nbsp;<?php echo htmlspecialchars($GLOBALS['ABOUT_TEXT_1'][0] ?? ''); ?></p> 

                    &nbsp;<p id="target">&nbsp;<?php echo htmlspecialchars($GLOBALS['ABOUT_TEXT_2'][0] ?? ''); ?><</p>

                    &nbsp;<p id="capacity">&nbsp;<?php echo htmlspecialchars($GLOBALS['ABOUT_TEXT_3'][0] ?? ''); ?></p>  
                </div>
                <div class="about-image fade-in">
                    <i class="fas fa-child"></i>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services" id="services">
        <div class="container" id="main-content">
            <h2 class="section-title fade-in">Serviciile Noastre</h2>
            <p class="section-subtitle fade-in">Îngrijire cuprinzătoare adaptată nevoilor unice ale fiecărui copil</p>
            <div class="services-grid">
                <?php
                // Loop through each service and display it
                   for ($i = 0; $i < count($GLOBALS['SERVICES']); $i++) {
                        $serviceName = $GLOBALS['SERVICES'][$i];
                        $serviceImage = "images/" . $GLOBALS['SERVICES_IMAGES'][$i];
                        $serviceLink = strtolower(str_replace(' ', '-', $serviceName)) . ".html";
                        $serviceDescription = $GLOBALS['SERVICES_DESCRIPTION'][$i];
                        $serviceNameFull = $GLOBALS['SERVICES_NAMES'][$i];
                        $serviceNameShort = $GLOBALS['SERVICES_NAMES_SHORT'][$i];

                        echo "<a href='$serviceLink' class='service-card fade-in'>
                                <div class='service-image'>
                                    <img src='$serviceImage' alt='$serviceNameFull' loading='lazy'>
                                </div>
                                <h3>$serviceNameFull</h3>
                                <p>$serviceDescription</p>
                              </a>";
                    }
                ?>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid">
                <?php for ($i = 0; $i < count($GLOBALS['STATS_VALUES']); $i++): ?>
                <div class="stat-item fade-in">
                    <h3 id="stat<?php echo $i + 1; ?>"><?php echo htmlspecialchars($GLOBALS['STATS_VALUES'][$i]); ?></h3>
                    <p><?php echo htmlspecialchars($GLOBALS['STATS_LABELS'][$i] ?? ''); ?></p>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Gallery Preview Section -->
    <section class="gallery-preview" id="gallery">
        <div class="container">
            <h2 class="section-title fade-in">Galeria Noastră</h2>
            <p class="section-subtitle fade-in">O privire asupra activităților și spațiilor noastre dedicate copiilor</p>
            
            <!-- Gallery Slideshow -->
            <div class="gallery-slideshow">
                <?php for ($i = 0; $i < count($GLOBALS['GALLERY_IMAGES']); $i++): ?>
                <div class="gallery-slide <?php echo $i === 0 ? 'active' : ''; ?>">
                    <img src="images/<?php echo htmlspecialchars($GLOBALS['GALLERY_IMAGES'][$i]); ?>" 
                         alt="<?php echo htmlspecialchars($GLOBALS['GALLERY_TITLES'][$i] ?? ''); ?>" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3><?php echo htmlspecialchars($GLOBALS['GALLERY_TITLES'][$i] ?? ''); ?></h3>
                        <p><?php echo htmlspecialchars($GLOBALS['GALLERY_DESCRIPTIONS'][$i] ?? ''); ?></p>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            
            <!-- Gallery Navigation -->
            <div class="gallery-slideshow-nav">
                <?php for ($i = 0; $i < count($GLOBALS['GALLERY_IMAGES']); $i++): ?>
                <button class="gallery-slide-btn <?php echo $i === 0 ? 'active' : ''; ?>" data-slide="<?php echo $i; ?>"></button>
                <?php endfor; ?>
            </div>
            
            <!-- View All Gallery Button -->
            <div class="gallery-cta fade-in">
                <a href="galerie.html" class="gallery-view-all-btn">
                    <i class="fas fa-images"></i>
                    Vezi Galeria Completă
                </a>
            </div>
        </div>
    </section>

    <!-- Partners Section -->
    <section class="partners" id="partners">
        <div class="container">
            <h2 class="section-title fade-in">Partenerii Noștri</h2>
            <p class="section-subtitle fade-in">Colaborăm cu organizații de încredere pentru a oferi cea mai bună îngrijire</p>
            <div class="partners-grid">
                <a href="https://social.gov.md/" target="_blank" class="partner-card fade-in">
                    <div class="partner-image">
                        <img src="images/logo-mps.webp" alt="MMPS" loading="lazy">
                    </div>
                    <div class="partner-content">
                        <h3>Ministerul Muncii și Protecţiei Sociale</h3>
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
                <a href="https://mec.gov.md/" target="_blank" class="partner-card fade-in">
                    <div class="partner-image">
                        <img src="https://dgpdc.md/wp-content/uploads/2023/07/11.png" alt="Ministerul Educatiei și Cercetarii" loading="lazy">
                    </div>
                    <div class="partner-content">
                        <h3>Ministerul Educației și Cercetării</h3>
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
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title fade-in">Povești de Speranță</h2>
            <p class="section-subtitle fade-in">Asculți de la familiile ale căror vieți au fost atinse de serviciile noastre</p>
            <div class="testimonials-slideshow">
                <?php for ($i = 0; $i < count($GLOBALS['TESTIMONIALS_QUOTES']); $i++): ?>
                <div class="testimonial-slide <?php echo $i === 0 ? 'active' : ''; ?>">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"<?php echo htmlspecialchars($GLOBALS['TESTIMONIALS_QUOTES'][$i] ?? ''); ?>"</p>
                        <div class="testimonial-author">
                            <strong><?php echo htmlspecialchars($GLOBALS['TESTIMONIALS_AUTHORS'][$i] ?? ''); ?></strong>
                            <span><?php echo htmlspecialchars($GLOBALS['TESTIMONIALS_ROLES'][$i] ?? ''); ?></span>
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>
            <div class="testimonials-nav">
                <?php for ($i = 0; $i < count($GLOBALS['TESTIMONIALS_QUOTES']); $i++): ?>
                <button class="testimonial-btn <?php echo $i === 0 ? 'active' : ''; ?>" data-testimonial="<?php echo $i; ?>"></button>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="contact" id="contact">
        <div class="container">
            <h2 class="section-title fade-in">Contactează-ne</h2>
            <p class="section-subtitle fade-in">Suntem aici să ajutăm 24/7. Contactează-ne oricând.</p>
            <div class="contact-grid">
                <div class="contact-info fade-in">
                    <h3 style="margin-bottom: 1.5rem; color: #2c3e50;">Intră în Legătură</h3>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong>Biroul Principal:</strong><br>
                            022 737 027
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <strong>Urgențe 24/7:</strong><br>
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
                            <strong>Adresă:</strong><br>
                            Strada Alexandru Cozmescu 51<br>
                            Chișinău, Telecentru, MD-2028
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <strong>Program:</strong><br>
                            Luni - Vineri: 08:00 - 18:00<br>
                            Sâmbătă: 09:00 - 15:00<br>
                            Duminică: Închis (Urgențe 24/7)
                        </div>
                    </div>
                </div>
                <div class="contact-form fade-in">
                    <h3 style="margin-bottom: 1.5rem; color: #2c3e50;">Trimite-ne un Mesaj</h3>
                    <form id="contactForm" action="contact_handler.php" method="POST">
                        <div class="form-group">
                            <label for="name">Nume Complet *</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Adresă Email *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Număr de Telefon</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subiect *</label>
                            <select id="subject" name="subject" required>
                                <option value="">Selectează subiectul...</option>
                                <option value="informații generale">Informații Generale</option>
                                <option value="plasament urgență">Plasament de Urgență</option>
                                <option value="adopție">Adopție</option>
                                <option value="voluntariat">Voluntariat</option>
                                <option value="donații">Donații</option>
                                <option value="altceva">Altceva</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Mesaj *</label>
                            <textarea id="message" name="message" placeholder="Vă rugăm să descrieți cum vă putem ajuta..." required></textarea>
                        </div>
                        <button type="submit" class="submit-btn">
                            <i class="fas fa-paper-plane"></i> Trimite Mesajul
                        </button>
                    </form>
                </div>
                <div class="contact-map fade-in">
                    <h3 style="margin-bottom: 1.5rem; color: #2c3e50;">Locația Noastră</h3>
                    <div class="map-container">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2721.1901148342927!2d28.825826984130842!3d46.99723990457751!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c97e96e1ce9959%3A0x3a7beac63524b2c2!2sCenter%20for%20the%20Placement%20and%20Rehabilitation%20of%20Young%20Children!5e0!3m2!1sen!2s!4v1748940567054!5m2!1sen!2s"
                            width="100%" 
                            height="300" 
                            style="border:0; border-radius: 10px;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade"
                            title="Locația Centrului de Plasament pentru Copiii de Vârstă Fragedă">
                        </iframe>
                    </div>
                    <div class="map-directions">
                        <h4 style="margin-top: 1rem; margin-bottom: 0.5rem; color: #2c3e50;">Cum să ne găsești:</h4>
                        <ul style="list-style: none; padding: 0; margin: 0;">
                            <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                                <i class="fas fa-bus" style="color: #4a90e2; margin-right: 0.5rem; min-width: 20px;"></i>
                                <span>Troleibuz 10, 24 - Stația "Vl. Korolenko"</span>
                            </li>
                            <li style="margin-bottom: 0.5rem; display: flex; align-items: center;">
                                <i class="fas fa-car" style="color: #4a90e2; margin-right: 0.5rem; min-width: 20px;"></i>
                                <span>Parcare gratuită disponibilă</span>
                            </li>
                            <li style="display: flex; align-items: center;">
                                <i class="fas fa-wheelchair" style="color: #4a90e2; margin-right: 0.5rem; min-width: 20px;"></i>
                                <span>Acces pentru persoane cu dizabilități</span>
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

    <script src="script.js?v=<?php echo filemtime('script.js'); ?>"></script>
</body>
</html>
