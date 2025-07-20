<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
require_once __DIR__ . '/includes/gdpr.php';
require_once __DIR__ . '/includes/analytics.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Politica de confidențialitate și protecția datelor personale">
    <meta name="keywords" content="confidențialitate, protecția datelor, GDPR, cookie-uri">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title>Politica de Confidențialitate - <?php echo t('site_title_short'); ?></title>
    <link rel="icon" href="images/logo.ico" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="gdpr-styles.css" rel="stylesheet">
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

    <?php include 'includes/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content" id="main-content">
        <section class="page-header">
            <div class="container">
                <h1>Politica de Confidențialitate</h1>
                <p>Protecția datelor dumneavoastră personale este prioritatea noastră</p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="privacy-content">
                        
                        <h2>1. Introducere</h2>
                        <p>Centrul de Plasament și Reabilitare pentru Copii de Vârstă Fragedă („noi", „CPRCVF") respectă confidențialitatea datelor dumneavoastră personale și se angajează să le protejeze în conformitate cu Regulamentul General privind Protecția Datelor (GDPR) și legislația națională aplicabilă.</p>

                        <h2>2. Date cu caracter personal colectate</h2>
                        <p>Colectăm următoarele categorii de date personale:</p>
                        <ul>
                            <li><strong>Date de identificare:</strong> nume, prenume, adresă email, număr de telefon</li>
                            <li><strong>Date de contact:</strong> adresa poștală, alte informații de contact</li>
                            <li><strong>Date tehnice:</strong> adresa IP anonimizată, tipul browserului, informații despre dispozitiv</li>
                            <li><strong>Date de navigare:</strong> paginile vizitate, timpul petrecut pe site, sursele de trafic (doar cu consimțământul)</li>
                        </ul>

                        <h2>3. Scopurile prelucrării</h2>
                        <p>Prelucrăm datele dumneavoastră personale în următoarele scopuri:</p>
                        <ul>
                            <li><strong>Funcționarea site-ului:</strong> furnizarea conținutului și funcționalităților de bază</li>
                            <li><strong>Comunicare:</strong> răspunsul la întrebări și petiții trimise prin formularele de contact</li>
                            <li><strong>Îmbunătățirea serviciilor:</strong> analiza traficului pentru optimizarea site-ului (doar cu consimțământul)</li>
                            <li><strong>Obligații legale:</strong> respectarea cerințelor legale în materie de transparență și acces la informații</li>
                        </ul>

                        <h2>4. Temeiurile juridice</h2>
                        <p>Prelucrarea datelor se bazează pe următoarele temeiuri juridice:</p>
                        <ul>
                            <li><strong>Consimțământul:</strong> pentru cookie-urile de analiză și marketing</li>
                            <li><strong>Interesul legitim:</strong> pentru funcționarea site-ului și îmbunătățirea serviciilor</li>
                            <li><strong>Obligația legală:</strong> pentru procesarea petițiilor și reclamațiilor</li>
                        </ul>

                        <h2>5. Cookie-urile utilizate</h2>
                        <div class="cookie-categories">
                            <div class="cookie-category">
                                <h3><i class="fas fa-cog"></i> Cookie-uri necesare</h3>
                                <p>Aceste cookie-uri sunt esențiale pentru funcționarea site-ului și nu pot fi dezactivate. Includ preferințele de limbă și setările de confidențialitate.</p>
                            </div>
                            
                            <div class="cookie-category">
                                <h3><i class="fas fa-chart-bar"></i> Cookie-uri de analiză</h3>
                                <p>Ne ajută să înțelegem cum interacționați cu site-ul pentru a-l îmbunătăți. Toate datele sunt anonimizate și nu vă identifică personal.</p>
                            </div>
                            
                            <div class="cookie-category">
                                <h3><i class="fas fa-bullhorn"></i> Cookie-uri de marketing</h3>
                                <p>Folosite pentru a afișa conținut relevant și pentru campaniile de informare publică. Nu sunt utilizate în prezent.</p>
                            </div>
                        </div>

                        <h2>6. Perioadele de păstrare</h2>
                        <ul>
                            <li><strong>Formularele de contact:</strong> 2 ani</li>
                            <li><strong>Petițiile și reclamațiile:</strong> 5 ani (conform legii)</li>
                            <li><strong>Datele de analiză:</strong> 26 de luni</li>
                            <li><strong>Jurnalele de erori:</strong> 1 an</li>
                        </ul>

                        <h2>7. Drepturile dumneavoastră</h2>
                        <p>În conformitate cu GDPR, aveți următoarele drepturi:</p>
                        <ul>
                            <li><strong>Dreptul de acces:</strong> să solicitați informații despre datele prelucrate</li>
                            <li><strong>Dreptul de rectificare:</strong> să corectați datele inexacte</li>
                            <li><strong>Dreptul de ștergere:</strong> să solicitați ștergerea datelor (cu anumite excepții)</li>
                            <li><strong>Dreptul de limitare:</strong> să restricționați prelucrarea în anumite condiții</li>
                            <li><strong>Dreptul de portabilitate:</strong> să primiți datele într-un format structurat</li>
                            <li><strong>Dreptul de opoziție:</strong> să vă opuneți prelucrării bazate pe interesul legitim</li>
                            <li><strong>Dreptul de retragere:</strong> să vă retrageți consimțământul în orice moment</li>
                        </ul>

                        <h2>8. Securitatea datelor</h2>
                        <p>Implementăm măsuri tehnice și organizatorice adecvate pentru a proteja datele dumneavoastră:</p>
                        <ul>
                            <li>Criptarea datelor în tranzit (HTTPS)</li>
                            <li>Anonimizarea adreselor IP</li>
                            <li>Accesul restricționat la datele personale</li>
                            <li>Backup-uri regulate și securizate</li>
                            <li>Monitorizarea accesului la sisteme</li>
                        </ul>

                        <h2>9. Transferuri internaționale</h2>
                        <p>Datele dumneavoastră sunt prelucrate în Republica Moldova și nu sunt transferate în afara Spațiului Economic European, cu excepția serviciilor cloud sigurite care respectă cerințele GDPR.</p>

                        <h2>10. Contact și reclamații</h2>
                        <p>Pentru exercitarea drepturilor sau pentru întrebări legate de protecția datelor, ne puteți contacta:</p>
                        <ul>
                            <li><strong>Email:</strong> dataprotection@cprcvf.md</li>
                            <li><strong>Adresa:</strong> [Adresa completă a instituției]</li>
                            <li><strong>Telefon:</strong> [Numărul de telefon]</li>
                        </ul>
                        
                        <p>De asemenea, aveți dreptul să depuneți o plângere la Centrul Național pentru Protecția Datelor cu Caracter Personal în cazul în care considerați că drepturile dumneavoastră au fost încălcate.</p>

                        <h2>11. Modificări ale politicii</h2>
                        <p>Această politică poate fi actualizată periodic. Modificările importante vor fi comunicate prin intermediul site-ului nostru.</p>
                        
                        <p><strong>Ultima actualizare:</strong> <?php echo date('d.m.Y'); ?></p>

                        <div class="privacy-actions">
                            <button type="button" class="gdpr-btn gdpr-btn-primary" onclick="openGDPRModal()">
                                <i class="fas fa-cog"></i> Configurează Cookie-urile
                            </button>
                            <a href="contact.php" class="gdpr-btn gdpr-btn-secondary">
                                <i class="fas fa-envelope"></i> Contactează-ne
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <!-- GDPR Compliance Components -->
    <?php echo GDPRManager::renderConsentModal(); ?>

    <script src="script.js"></script>
    <script src="gdpr-script.js"></script>

    <style>
        .privacy-content {
            max-width: 800px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .privacy-content h2 {
            color: #2c3e50;
            margin-top: 3rem;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #3498db;
        }

        .privacy-content h3 {
            color: #34495e;
            margin-top: 2rem;
            margin-bottom: 1rem;
        }

        .privacy-content ul {
            margin-bottom: 1.5rem;
        }

        .privacy-content li {
            margin-bottom: 0.5rem;
        }

        .cookie-categories {
            display: grid;
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .cookie-category {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 8px;
            border-left: 4px solid #3498db;
        }

        .cookie-category h3 {
            margin-top: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #2c3e50;
        }

        .cookie-category i {
            color: #3498db;
        }

        .privacy-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #e1e8ed;
        }

        .gdpr-btn-secondary {
            background: #6c757d;
            color: white;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .gdpr-btn-secondary:hover {
            background: #5a6268;
            color: white;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .privacy-actions {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</body>
</html>
