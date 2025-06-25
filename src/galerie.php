<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Galeria foto cu activitățile și spațiile Centrului de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă din Chișinău.">
    <meta name="keywords" content="galerie foto, activități copii, spații centru plasament">
    <meta name="author" content="Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă">
    
    <title>Galerie - Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă</title>
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
                               <li><a href="sectia-asistenta-medicala.php">Secția Asistență Medicală</a></li> 
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
                <h1>Galeria Noastră</h1>
                <p>Imagini din activitățile zilnice și spațiile dedicate copiilor</p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="gallery">
                    <div class="gallery-categories">
                        <button class="filter-btn active" data-filter="all">Toate</button>
                        <button class="filter-btn" data-filter="activities">Activități</button>
                        <button class="filter-btn" data-filter="spaces">Spații</button>
                        <button class="filter-btn" data-filter="therapy">Terapie</button>
                        <button class="filter-btn" data-filter="events">Evenimente</button>
                    </div>

                    <div class="gallery-grid">
                        <div class="gallery-item" data-category="spaces">
                            <img src="images/zi10.jpg" alt="Camera de Odihnă" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Camera de Odihnă</h3>
                                <p>Spații confortabile pentru relaxare</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="gallery-item" data-category="spaces">
                            <img src="images/zi11.jpg" alt="Spații de Recreere" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Spații de Recreere</h3>
                                <p>Zone dedicate jocului și relaxării</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item" data-category="activities">
                            <img src="images/maternala3.jpg" alt="Consiliere Parentală" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Consiliere Parentală</h3>
                                <p>Sesiuni de instruire și dezvoltare</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item" data-category="spaces">
                            <img src="images/respiro3.jpg" alt="Spații Respiro" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Spații Dedicate</h3>
                                <p>Mediu sigur și confortabil pentru copii</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item" data-category="spaces">
                            <img src="images/respiro6.jpg" alt="Mediu Terapeutic" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Mediu Terapeutic</h3>
                                <p>Spații special amenajate pentru terapie</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item" data-category="activities">
                            <img src="images/sap4.jpg" alt="Descoperirea Faunei" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Descoperirea Faunei</h3>
                                <p>La gradina zoologica</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item" data-category="events">
                            <img src="images/sap13.jpg" alt="Eveniment Amuzants" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Eveniment Amuzant</h3>
                                <p>Muzica,Dansuri si Baloane</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item" data-category="activities">
                            <img src="images/z21.jpg" alt="Confectionarea lucrarilor plastice" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Confectionarea lucrarilor plastice</h3>
                                <p>O amintire pe toata viata</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item" data-category="activities">
                            <img src="images/14.jpg" alt="Admirarea Gradinii Zoo" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Admirarea Gradinii Zoo</h3>
                                <p>Plante exotice</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="gallery-item" data-category="activities">
                            <img src="images/21.jpg" alt="Jocuri Gonflabile" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Jocuri Gonflabile</h3>
                                <p>Sarituri si fericire</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="gallery-item" data-category="events">
                            <img src="images/35.jpg" alt="Festival Mascat" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Festival Mascat</h3>
                                <p>Copii mascati in eroii lor</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>

                        <div class="gallery-item" data-category="activities">
                            <img src="images/555.jpg" alt="Teatru cu marionete" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Teatru cu marionete</h3>
                                <p>Un spectacol calptivant</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                        <div class="gallery-item" data-category="activities">
                            <img src="images/585.jpg" alt="Bucuria copiilor" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Bucuria copiilor</h3>
                                <p>Castigarea unui concurs</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
                         <div class="gallery-item" data-category="activities">
                            <img src="images/zoo1.jpeg" alt="Excursie la Zoo" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Excursie  la Zoo</h3>
                                <p>Copiii descopera animale noi</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
 <div class="gallery-item" data-category="activities">
                            <img src="images/zoo2.jpeg" alt="Animale noi si interesante" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Animale noi si interesante</h3>
                                <p>Copiii sunt multumiti</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
 <div class="gallery-item" data-category="activities">
                            <img src="images/zoo3.jpeg" alt="Habitatele animalelor" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Habitatele animalelor</h3>
                                <p>Copiii descopera unde locuiesc animalele</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
 <div class="gallery-item" data-category="activities">
                            <img src="images/zoo4.jpeg" alt="Animale la inaltime" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Animale la inaltime</h3>
                                <p>Maimute si multi papagali</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
 <div class="gallery-item" data-category="activities">
                            <img src="images/zoo5.jpeg" alt="Animal de desert" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Animal de desert</h3>
                                <p>Copiii descopera camila</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
 <div class="gallery-item" data-category="activities">
                            <img src="images/zoo6.jpeg" alt="Broasca Testoasa mangaiata de copii" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Broasca Testoasa mangaiata de copii</h3>
                                <p>Multa afectiune si iubire</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
 <div class="gallery-item" data-category="activities">
                            <img src="images/zoo7.jpeg" alt="La Izvor" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>La Izvor</h3>
                                <p>O mica pauza de la aceasta aventura</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
 <div class="gallery-item" data-category="activities">
                            <img src="images/zoo8.jpeg" alt="Descoperirea Bufnitei" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Descoperirea Bufnitei</h3>
                                <p>Singura data cand va fi treaza ziua</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>
 <div class="gallery-item" data-category="activities">
                            <img src="images/zoo9.jpeg" alt="Animale prin copaci" loading="lazy">
                            <div class="gallery-overlay">
                                <h3>Animale prin copaci</h3>
                                <p>Cum ele se tin atat de mult acolo?</p>
                                <div class="overlay-icon">
                                    <i class="fas fa-search-plus"></i>
                                </div>
                            </div>
                        </div>


                    
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
            <p>&copy; 2025 Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă. Toate drepturile rezervate.</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>