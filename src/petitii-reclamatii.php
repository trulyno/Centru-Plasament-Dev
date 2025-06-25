<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Informații despre depunerea petițiilor și reclamațiilor la Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă.">
    <meta name="keywords" content="petiții, reclamații, feedback, sesizări">
    <meta name="author" content="Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă">
    
    <title>Petiții și Reclamații - Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă</title>
    <link rel="icon" href="images/logo.ico" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="petition-form.css" rel="stylesheet">
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
                <h1>Petiții și Reclamații</h1>
                <p>Sistemul de petiții și reclamații pentru îmbunătățirea serviciilor</p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="petition-info">
                        <h2>Sistem de Petiții și Reclamații</h2>
                        <p>Prin intermediul acestui formular puteți depune petiții și reclamații conform legislației în vigoare. Toate petițiile vor fi examinate în conformitate cu prevederile legale.</p>
                        
                        <div class="requirements-box">
                            <h3><i class="fas fa-info-circle"></i> Cerințe pentru depunerea petițiilor</h3>
                            <ul>
                                <li><strong>Format:</strong> Petiția trebuie să fie în format PDF</li>
                                <li><strong>Semnătură digitală:</strong> Obligatorie cu MSIGN</li>
                                <li><strong>Dimensiune maximă:</strong> 15 MB</li>
                                <li><strong>Fișiere suplimentare:</strong> Maximum 3 fișiere în format PDF, DOC sau ZIP</li>
                            </ul>
                        </div>
                    </div>

                    <form class="petition-form" id="petitionForm">
                        <h3>Formular de Depunere Petiție/Reclamație</h3>
                        
                        <!-- Entity Type Selection -->
                        <div class="form-group">
                            <label class="form-label required">Tipul solicitantului:</label>
                            <div class="radio-group">
                                <label class="radio-option">
                                    <input type="radio" name="entity_type" value="individual" required>
                                    <span class="radio-custom"></span>
                                    <span class="radio-text">Persoană fizică</span>
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="entity_type" value="legal" required>
                                    <span class="radio-custom"></span>
                                    <span class="radio-text">Persoană juridică</span>
                                </label>
                            </div>
                        </div>

                        <!-- Legal Entity Fields -->
                        <div class="form-row" id="legalEntityFields" style="display: none;">
                            <div class="form-group">
                                <label for="idno" class="form-label">IDNO (opțional):</label>
                                <input type="text" id="idno" name="idno" class="form-input" placeholder="Ex: 1234567890123">
                                <small class="form-hint">Codul de identificare fiscală pentru persoane juridice</small>
                            </div>
                            
                            <div class="form-group">
                                <label for="company_name" class="form-label">Denumirea companiei/instituției (opțional):</label>
                                <input type="text" id="company_name" name="company_name" class="form-input" placeholder="Denumirea completă a organizației">
                            </div>
                        </div>

                        <!-- Individual Fields -->
                        <div class="form-row" id="individualFields" style="display: none;">
                            <div class="form-group">
                                <label for="idnp" class="form-label">IDNP (opțional):</label>
                                <input type="text" id="idnp" name="idnp" class="form-input" placeholder="Ex: 2001234567890">
                                <small class="form-hint">Codul numeric personal</small>
                            </div>
                        </div>

                        <!-- Personal Information -->
                        <div class="form-row">
                            <div class="form-group">
                                <label for="last_name" class="form-label required">Numele:</label>
                                <input type="text" id="last_name" name="last_name" class="form-input" required placeholder="Numele de familie">
                            </div>
                            
                            <div class="form-group">
                                <label for="first_name" class="form-label required">Prenumele:</label>
                                <input type="text" id="first_name" name="first_name" class="form-input" required placeholder="Prenumele">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone" class="form-label required">Telefon:</label>
                                <input type="tel" id="phone" name="phone" class="form-input" required placeholder="+373 XX XXX XXX">
                            </div>
                            
                            <div class="form-group">
                                <label for="email" class="form-label required">Email:</label>
                                <input type="email" id="email" name="email" class="form-input" required placeholder="exemplu@email.com">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address" class="form-label required">Adresa de domiciliu/reședință:</label>
                            <textarea id="address" name="address" class="form-textarea" required placeholder="Adresa completă (oraș, stradă, nr. casei, apartament)"></textarea>
                        </div>

                        <!-- Petition Details -->
                        <div class="form-group">
                            <label for="subject" class="form-label required">Subiectul petițiilor/reclamației:</label>
                            <input type="text" id="subject" name="subject" class="form-input" required placeholder="Descrierea scurtă a subiectului">
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label required">Mesajul:</label>
                            <textarea id="message" name="message" class="form-textarea large" required placeholder="Descrierea detaliată a petițiilor sau reclamației..."></textarea>
                        </div>

                        <!-- File Uploads -->
                        <div class="form-group">
                            <label for="petition_file" class="form-label required">Fișierul petițiilor (PDF cu semnătură digitală MSIGN):</label>
                            <div class="file-upload-wrapper">
                                <input type="file" id="petition_file" name="petition_file" class="form-file" accept=".pdf" required>
                                <div class="file-upload-info">
                                    <i class="fas fa-file-pdf"></i>
                                    <span>Alegeți fișierul PDF (max. 15 MB)</span>
                                </div>
                            </div>
                            <small class="form-hint">Fișierul trebuie să fie semnat digital cu MSIGN</small>
                        </div>

                        <div class="form-group">
                            <label for="additional_files" class="form-label">Fișiere suplimentare (opțional):</label>
                            <div class="file-upload-wrapper">
                                <input type="file" id="additional_files" name="additional_files[]" class="form-file" accept=".pdf,.doc,.docx,.zip" multiple>
                                <div class="file-upload-info">
                                    <i class="fas fa-paperclip"></i>
                                    <span>Maximum 3 fișiere (PDF, DOC, ZIP)</span>
                                </div>
                            </div>
                            <small class="form-hint">Documente de susținere: PDF, DOC sau ZIP (max. 10 MB per fișier)</small>
                        </div>

                        <!-- Consent Checkboxes -->
                        <div class="consent-section">
                            <div class="form-group checkbox-group">
                                <label class="checkbox-option">
                                    <input type="checkbox" name="data_consent" required>
                                    <span class="checkbox-custom"></span>
                                    <span class="checkbox-text">
                                        Sunt de acord cu prelucrarea datelor cu caracter personal în conformitate cu 
                                        <strong>articolele 6, 8, 9 din Legea nr. 133 din 08.07.2011</strong> privind protecția datelor cu caracter personal.
                                    </span>
                                </label>
                            </div>

                            <div class="form-group checkbox-group">
                                <label class="checkbox-option">
                                    <input type="checkbox" name="data_accuracy" required>
                                    <span class="checkbox-custom"></span>
                                    <span class="checkbox-text">
                                        Confirm că toate datele furnizate sunt corecte și complete, și îmi asum responsabilitatea pentru veridicitatea informațiilor.
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-actions">
                            <button type="submit" class="submit-btn">
                                <i class="fas fa-paper-plane"></i>
                                Trimite Petiția
                            </button>
                            <button type="reset" class="reset-btn">
                                <i class="fas fa-undo"></i>
                                Resetează Formularul
                            </button>
                        </div>

                        <div class="form-footer">
                            <p><i class="fas fa-info-circle"></i> Petițiile și reclamațiile vor fi examinate conform termenelor prevăzute de legislația în vigoare.</p>
                        </div>
                    </form>
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