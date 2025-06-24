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
                        <h1 class="logo-text-full">Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă din municipiul Chișinău</h1>
                        <h1 class="logo-text-abbreviated">CPRCVF</h1>
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
                            <li><a href="subdiviziune.php">Subdiviziune</a></li>
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
            <div class="slide active">
                <div class="slide-content">
                    <div class="slide-text">
                        <h1>Fiecare Copil Merită un Viitor Luminos</h1>
                        <p>Oferim servicii cuprinzătoare de plasament și reabilitare pentru copiii mici în nevoie. Creăm medii sigure și îngrijitoare unde vindecarea și creșterea pot să înceapă.</p>
                        <a href="#contact" class="cta-button">Obține Ajutor Acum</a>
                    </div>
                </div>
                <div class="slide-image">
                    <img src="images/zi7.jpg" alt="Copii fericiți jucându-se împreună" loading="lazy">
                </div>
            </div>
            <div class="slide">
                <div class="slide-content">
                    <div class="slide-text">
                        <h1>Medii Sigure și Iubitoare</h1>
                        <p>Casele de plasament atent selectate oferă stabilitate și îngrijire în timp ce copiii se vindecă și se pregătesc pentru următorul capitol.</p>
                        <a href="#services" class="cta-button">Află Mai Mult</a>
                    </div>
                </div>
                <div class="slide-image">
                    <img src="images/zi10.jpg" alt="Mediu acasă confortabil" loading="lazy">
                </div>
            </div>
            <div class="slide">
                <div class="slide-content">
                    <div class="slide-text">
                        <h1>Echipă Profesională de Îngrijire</h1>
                        <p>Terapeuți licențiați, asistenți sociali și specialiști în îngrijirea copiilor lucrează împreună pentru a sprijini călătoria unică a fiecărui copil.</p>
                        <a href="#about" class="cta-button">Cunoaște Echipa Noastră</a>
                    </div>
                </div>
                <div class="slide-image">
                    <img src="images/zi1.png" alt="Profesioniști din sănătate lucrând cu copii" loading="lazy">
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
            <h2>Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă din municipiul Chișinău</h2>
            <div class="about-content">
                <div class="about-text fade-in">
                    &nbsp;<p id="pin">&nbsp;<b>Centrul de Plasament și Reabilitare pentru Copii de Vârstă Fragedă din munipiul Chișinău</b>, subordonat <i>Ministerului Muncii și Protecției Sociale</i>, oferă servicii sociale și medico-psiho-pedagogice dedicate copiilor de la 0 la 7 ani aflați în situații de risc, mamelor cu copii mici și femeilor gravide în ultimul trimestru de sarcină.</p> 

                    &nbsp;<p id="target">&nbsp;<b><i>Misiunea Centrului</i></b> este de a oferi sprijin, protecție și un mediu sigur pentru copii și familiile acestora, facilitând dezvoltarea armonioasă și reintegrarea copiilor în mediul familial. Beneficiarii includ copii în dificultate, copii cu dizabilități neuro-locomotorii, copii din familii vulnerabile, mame și gravide.</p>

                    &nbsp;<p id="capacity">&nbsp;Centrul are o capacitate maximă de <i>200 de beneficiari</i> și oferă servicii de plasament temporar și de urgență, servicii pentru cupluri mamă-copil, gravide și servicii <i>„Respiro"</i> pentru copii cu dizabilități, toate acestea menite să protejeze copilul și să sprijine familia.</p>  
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
            <h2 class="section-title fade-in">Serviciile Noastre</h2>
            <!-- <p class="section-subtitle fade-in">Îngrijire cuprinzătoare adaptată nevoilor unice ale fiecărui copil</p> -->
            <div class="services-grid">
                <a href="sectia-criza-reintegrare-familiala.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/criza.jpg" alt="Secția de Criză și Reintegrare Familială" loading="lazy">
                    </div>
                    <h3>Secția de Criză și Reintegrare Familială</h3>
                    <p>Secția de Criză și Reintegrare Familială găzduiește temporar copii cu vârsta cuprinsă între 0 – 7 ani, aflați în situații de risc, abandonați sau orfani. Plasamentul se realizează pentru o perioadă de până la 45 de zile, în baza Dispoziției de plasament de urgență emisă de Autoritatea Tutelară Locală, însoțită de Demers. Pe perioada plasamentului, copiii beneficiază de toate serviciile oferite de centru. Pentru soluționarea cazurilor, secția colaborează activ cu: autoritățile administrației publice locale și teritoriale; organele de drept; organizații non-guvernamentale; instituțiile comunității.</p>
                </a>
                <a href="sectia-maternala.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/maternala2.jpg" alt="Secția Maternală" loading="lazy">
                    </div>
                    <h3>Secția Maternală</h3>
                    <p>Secția Maternală este un serviciu social gratuit ce previne separarea copilului de părinți, oferind sprijin și adăpost mamelor și copiilor aflați în dificultate. Aceasta dezvoltă abilitățile parentale, susține relațiile familiale și ajută la reintegrarea socială. Beneficiarii sunt mame singure, mame minore, gravide fără locuință sau victime ale violenței, putând găzdui până la 16 cupluri mamă-copil pentru 6 luni, cu posibilitate de prelungire. Serviciul funcționează permanent, oferind siguranță și confidențialitate.</p>
                </a>
                <a href="sectia-zi-4luni-3ani.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/zi7.jpg" alt="Secția Zi pentru îngrijirea copiilor cu vârsta 4 luni - 3 ani" loading="lazy">
                    </div>
                    <h3>Secția Zi pentru îngrijirea copiilor cu vârsta 4 luni - 3 ani</h3>
                    <p>Secția Zi pentru îngrijirea copiilor de 4 luni – 3 ani este un serviciu destinat copiilor din familii vulnerabile, pentru a preveni separarea de părinți. Copiii sunt îngrijiți pe parcursul zilei de educatori, oferindu-le părinților posibilitatea de a-și găsi un loc de muncă. Secția funcționează ca o grădiniță modernă, asigurând toate nevoile copiilor mici. Accesul se face pe baza unei cereri motivate depuse la Direcția pentru protecția copilului.</p>
                </a>
                <a href="sectia-de-zi.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/zi1.png" alt="Secția de Zi" loading="lazy">
                    </div>
                    <h3>Secția de Zi</h3>
                    <p>Secția de Zi este destinată copiilor din Chișinău, cu dizabilități neuro-motorii și tulburări de neuro-dezvoltare (1–10 ani), repartizați în 3 grupe asemănătoare celor de la grădiniță. Scopul major este recuperarea cât mai timpurie a acestora, acordarea asistenței specializate complexe și suportul psihologic familiei în dificultate și păstrarea relației familiei-copil. Cursul de reabilitare a copiilor prevede mai multe etape cu o durată minimă de o lună, cu repetări pe parcursul anului și în dependență de diagnoza copilului.</p>
                </a>
                <a href="sectia-respiro.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/respiro3.jpg" alt="Secția Respiro" loading="lazy">
                    </div>
                    <h3>Secția Respiro</h3>
                    <p>Secția Respiro oferă protecție rezidențială temporară (până la 30 de zile/an) pentru copiii cu dizabilități, pentru a da familiilor ocazia de refacere și a preveni instituționalizarea sau abuzul acestora. Serviciul include consiliere și instruire pentru familiile din Chișinău și din toată Moldova, se adresează copiilor cu dizabilități neuro-motorii (1-12 ani) și funcționează non-stop pe durata găzduirii.</p>
                </a>
                <a href="sectia-asistenta-psihopedagogica.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/sap1.jpg" alt="Secția Asistență Psihopedagogică" loading="lazy">
                    </div>
                    <h3>Secția Asistență Psihopedagogică</h3>
                    <p>Secția de Asistență Psihopedagogică oferă evaluare, consiliere și intervenții specializate pentru copiii cu nevoi emoționale, cognitive și comportamentale. Echipa noastră – formată din psihologi, logopezi și cadre psihopedagogice – sprijină dezvoltarea armonioasă a copiilor aflați în plasament. Prin terapie, activități educaționale și intervenție timpurie, ajutăm fiecare copil să își valorifice potențialul într-un mediu sigur și afectuos.</p>
                </a>
                <a href="sectia-reabilitare.php" class="service-card fade-in">
                    <div class="service-image">
                        <img src="images/masaj.jpg" alt="Secția Reabilitare" loading="lazy">
                    </div>
                    <h3>Secția Reabilitare</h3>
                    <p>Secția Reabilitare oferă tratament și programe de reabilitare copiilor din instituție, în special celor cu dizabilități motorii, comportamentale, intelectuale sau de vorbire. Copiii primesc un program individualizat, beneficiind de terapie, masaj, kinetoterapie și proceduri fizioterapeutice realizate de personal calificat, în spații special amenajate.</p>
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
                    <p>Copii Beneficiari</p>
                </div>
                <div class="stat-item fade-in">
                    <h3 id="stat2">0</h3>
                    <p>Reunificări de Succes</p>
                </div>
                <div class="stat-item fade-in">
                    <h3 id="stat3">0</h3>
                    <p>Plasamente pentru Adopție</p>
                </div>
                <div class="stat-item fade-in">
                    <h3 id="stat4">0</h3>
                    <p>Ani de Serviciu</p>
                </div>
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
                <div class="gallery-slide active">
                    <img src="images/respiro3.jpg" alt="Copii jucându-se în sala de activități" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3>Sala de Joacă</h3>
                        <p>Copiii se distrează în spațiul nostru sigur și colorat</p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/zi10.jpg" alt="Camera de odihnă confortabilă" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3>Camera de Odihnă</h3>
                        <p>Spații liniștite și confortabile pentru relaxare</p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/zi6.jpg" alt="Activități educaționale cu copiii" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3>Activități Educaționale</h3>
                        <p>Programe educaționale adaptate vârstei fiecărui copil</p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/maternala2.jpg" alt="Grădina exterioară pentru joacă" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3>Grădina de Joacă</h3>
                        <p>Spațiu exterior sigur pentru activități în aer liber</p>
                    </div>
                </div>
                <div class="gallery-slide">
                    <img src="images/maternala5.jpg" alt="Eveniment special cu copiii" loading="lazy">
                    <div class="gallery-slide-content">
                        <h3>Evenimente Speciale</h3>
                        <p>Celebrăm împreună momente importante</p>
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
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <h2 class="section-title fade-in">Povești de Speranță</h2>
            <p class="section-subtitle fade-in">Asculți de la familiile ale căror vieți au fost atinse de serviciile noastre</p>
            <div class="testimonials-slideshow">
                <div class="testimonial-slide active">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"Recomand! A fost de mare ajutor copilului, a avut parte de atenție, afecțiune și reabilitare nivelul cel mai înalt! Centru Plasament Reabilitare Copii a făcut o mare diferența în progresul copilului! Mulțumesc tuturor colaboratorilor!"</p>
                        <div class="testimonial-author">
                            <strong>Ecaterina Zgureanu</strong>
                            <span>Părinte</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"Întradevăr un personal extraordinar doamne cu suflet mare! Vă mulțumim frumos că sunteți așa de bravo!"</p>
                        <div class="testimonial-author">
                            <strong>Svetlana Pădure</strong>
                            <span>Părinte</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"Mulțumim, echipă minunată a centrului, pentru tot efortul dumneavoastră dăruit copiilor."</p>
                        <div class="testimonial-author">
                            <strong>Tatiana Răcilă</strong>
                            <span>Părinte</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"Sunt foarte mulțumită de acest Centru. Acolo activează oameni cu suflet mare și plin de dragoste față de toți copilașii. Recomand cu încredere. Sănătate și putere tuturor!!!"</p>
                        <div class="testimonial-author">
                            <strong>Elena Bulat</strong>
                            <span>Părinte</span>
                        </div>
                    </div>
                </div>
                <div class="testimonial-slide">
                    <div class="testimonial-content">
                        <i class="fas fa-quote-left quote-icon"></i>
                        <p>"La fel, și eu vreau să le mulțumesc. Băiețelul meu este, în acest moment, internat acolo. Sunt niște doamne extraordinare și foarte înțelegătoare. Mulțumim în mod special doamnei Corina Vozian și doamnei Violeta Timirgaz. Suntem internați pentru a treia oară și, desigur, avem doar cuvinte de laudă și recunoștință. Succes, Centrului de Plasament și Reabilitare pentru Copii!"</p>
                        <div class="testimonial-author">
                            <strong>Mariana Cebotari</strong>
                            <span>Părinte</span>
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
                    <form id="contactForm">
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

    <script src="script.js"></script>
</body>
</html>
