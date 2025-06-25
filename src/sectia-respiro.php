<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Secția Respiro oferă protecție rezidențială temporară pentru copiii cu dizabilități, pentru a da familiilor ocazia de refacere și a preveni instituționalizarea.">
    <meta name="keywords" content="respiro, copii dizabilități, protecție temporară, sprijin familii">
    <meta name="author" content="Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă">
    
    <title>Secția Respiro - Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă</title>
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
        <div class="header-top">
            <div class="header-top-container">
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
                <img src="images/logo.jpeg" alt="Logo CPRCVF" class="logo-mobile-image">
                <i class="fas fa-heart"></i>
                <span>CPRCVF</span>
            </div>
            <div class="mobile-action-buttons">
                <button class="donate-btn" aria-label="Donează pentru a sprijini copiii" title="Donează">
                    <i class="fas fa-heart"></i>
                </button>
                <button class="audio-btn" id="audioBtn" aria-label="Imnul instituției" title="Imnul instituției">
                    <i class="fas fa-music"></i>
                </button>
                <button class="lyrics-btn" id="lyricsBtn" aria-label="Afișează versurile" title="Versurile imnului">
                    <i class="fas fa-align-left"></i>
                </button>
            </div>
            <nav>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="index.php">Acasă</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Servicii <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="sectia-criza-reintegrare-familiala.php">Secția de Criză și Reintegrare Familială</a></li>
                            <li><a href="sectia-maternala.php">Secția Maternală</a></li>
                            <li><a href="sectia-zi-4luni-3ani.php">Secția Zi (4 luni - 3 ani)</a></li>
                            <li><a href="sectia-de-zi.php">Secția de Zi</a></li>
                            <li><a href="sectia-respiro.php">Secția Respiro</a></li>
                            <li><a href="sectia-asistenta-psihopedagogica.php">Secția Asistență Psihopedagogică</a></li>
                            <li><a href="sectia-reabilitare.php">Secția Reabilitare</a></li>
                            <!-- <li><a href="sectia-asistenta-medicala.php">Secția Asistență Medicală</a></li> -->
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Despre Noi <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="administratia.php">Administrația</a></li>
                            <li><a href="organigrama.php">Organigrama</a></li>
                            
                            <li><a href="functii-vacante.php">Funcții Vacante</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Transparența <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-nested">
                                <a href="#" class="dropdown-toggle-nested">Legislație <i class="fas fa-chevron-right"></i></a>
                                <ul class="dropdown-menu-nested">
                                    <li><a href="acte-nationale.php">Acte Naționale</a></li>
                                    <li><a href="acte-internationale.php">Acte Internaționale</a></li>
                                    <li><a href="acte-interne.php">Acte Interne</a></li>
                                    <li><a href="codul-deontologic.php">Codul Deontologic</a></li>
                                    <li><a href="metodologii.php">Metodologii</a></li>
                                </ul>
                            </li>
                            <li class="dropdown-nested">
                                <a href="#" class="dropdown-toggle-nested">Achiziții <i class="fas fa-chevron-right"></i></a>
                                <ul class="dropdown-menu-nested">
                                    <li><a href="invitatii-participare.php">Invitații de Participare</a></li>
                                    <li><a href="planuri-achizitii.php">Planuri de Achiziții</a></li>
                                    <li><a href="rapoarte-achizitii.php">Rapoarte de Achiziții</a></li>
                                </ul>
                            </li>
                            <li><a href="proiecte.php">Proiecte</a></li>
                            <li><a href="rapoarte.php">Rapoarte</a></li>
                            <li><a href="registru-cadouri.php">Registru Cadouri</a></li>
                            <li><a href="petitii-reclamatii.php">Petiții și Reclamații</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle">Suport Informațional <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="ghiduri.php">Ghiduri</a></li>
                            <li><a href="intrebari-frecvente.php">Întrebări Frecvente</a></li>
                        </ul>
                    </li>
                    <li><a href="galerie.php">Galerie</a></li>
                    <li><a href="index.php#contact">Contact</a></li>
                    <li><a href="index.php#partners">Parteneri</a></li>
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
                <h1>Secția Respiro</h1>
                <p>Protecție temporară pentru copiii cu dizabilități și sprijin pentru familiile lor</p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="service-hero">
                        <div class="service-hero-content">
                            <h2>Despre Secția Respiro</h2>
                            <p>Secția Respiro oferă protecție rezidențială temporară (până la 30 de zile/an) pentru copiii cu dizabilități, pentru a da familiilor ocazia de refacere și a preveni instituționalizarea sau abuzul acestora. Serviciul include consiliere și instruire pentru familiile din Chișinău și din toată Moldova, se adresează copiilor cu dizabilități neuro-motorii (1-12 ani) și funcționează non-stop pe durata găzduirii.</p>
                        </div>
                        <div class="service-hero-image">
                            <img src="images/respiro3.jpg" alt="Secția Respiro" loading="lazy">
                        </div>
                    </div>

                    <div class="service-details">
                        <h2>Servicii Oferite</h2>
                        <div class="services-list">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Protecție Rezidențială Temporară</h4>
                                    <p>Găzduire temporară pentru copii cu dizabilități, până la 30 de zile pe an.</p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Consiliere și Instruire</h4>
                                    <p>Sprijin psihologic și instruire pentru familiile copiilor cu dizabilități.</p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Funcționare Non-stop</h4>
                                    <p>Serviciu permanent pe durata găzduirii pentru siguranța copiilor.</p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Prevenire Instituționalizare</h4>
                                    <p>Sprijin pentru menținerea copilului în mediul familial.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="service-info">
                        <h2>Informații Importante</h2>
                        <div class="info-grid">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-child"></i>
                                </div>
                                <h4>Vârsta Beneficiarilor</h4>
                                <p>Copii cu vârsta între 1-12 ani cu dizabilități neuro-motorii</p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <h4>Durata Serviciului</h4>
                                <p>Maximum 30 de zile pe an</p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <h4>Acoperire Geografică</h4>
                                <p>Familii din Chișinău și din toată Moldova</p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <h4>Scopul Principal</h4>
                                <p>Refacerea familiilor și prevenirea abuzului</p>
                            </div>
                        </div>
                    </div>

                    <div class="service-gallery">
                        <h2>Galeria Secției Respiro</h2>
                        <div class="gallery-grid">
                            <div class="gallery-item">
                                <img src="images/respiro1.jpg" alt="Activități Zilnice" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4>Activități Zilnice</h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/respiro2.jpg" alt="Îngrijire Specializată" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4>Îngrijire Specializată</h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/respiro3.jpg" alt="Spațiu de Joacă" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4>Spațiu de Joacă</h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/respiro4.jpg" alt="Terapie Individualizată" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4>Terapie Individualizată</h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/respiro5.jpg" alt="Consiliere Familială" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4>Consiliere Familială</h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/respiro6.jpg" alt="Mediu Sigur și Confortabil" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4>Mediu Sigur și Confortabil</h4>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="contact-cta">
                        <h3>Contactează-ne pentru mai multe informații</h3>
                        <p>Pentru detalii despre serviciile Secției Respiro sau pentru a solicita acest serviciu, te rugăm să ne contactezi.</p>
                        <a href="index.php#contact" class="cta-button">Contactează-ne</a>
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