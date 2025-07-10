<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('services_rehabilitation'); ?> oferă tratament și programe de reabilitare copiilor din instituție, în special celor cu dizabilități motorii, comportamentale, intelectuale sau de vorbire.">
    <meta name="keywords" content="reabilitare copii, terapie, masaj, kinetoterapie, fizioterapie">
    <meta name="author" content="Centrul de Plasament și Reabilitare pentru Copii de Vârstă Fragedă">
    
    <title><?php echo t('rehabilitation_page_title'); ?></title>
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

    <?php include 'includes/header.php'; ?>

    <!-- Main Content -->
    <main class="main-content" id="main-content">
        <section class="page-header">
            <div class="container">
                <h1><?php echo t('services_rehabilitation'); ?></h1>
                <p>Tratament și programe specializate de reabilitare pentru copii</p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <div class="service-hero">
                        <div class="service-hero-content">
                            <h2>Despre <?php echo t('services_rehabilitation'); ?></h2>
                            <p><?php echo t('services_rehabilitation'); ?> oferă tratament și programe de reabilitare copiilor din instituție, în special celor cu dizabilități motorii, comportamentale, intelectuale sau de vorbire. Copiii primesc un program individualizat, beneficiind de terapie, masaj, kinetoterapie și proceduri fizioterapeutice realizate de personal calificat, în spații special amenajate.</p>
                        </div>
                        <div class="service-hero-image">
                            <img src="" alt="Secția Reabilitare" loading="lazy">
                        </div>
                    </div>

                    <div class="service-details">
                        <h2><?php echo t('services_title'); ?></h2>
                        <div class="services-list">
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-hands-helping"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Terapie Specializată</h4>
                                    <p>Programe individualizate de terapie pentru diferite tipuri de dizabilități și nevoi speciale.</p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-spa"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Masaj Terapeutic</h4>
                                    <p>Proceduri de masaj realizate de personal calificat pentru îmbunătățirea funcțiilor motorii.</p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-running"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Kinetoterapie</h4>
                                    <p>Exerciții specializate pentru dezvoltarea și îmbunătățirea mobilității copiilor.</p>
                                </div>
                            </div>
                            <div class="service-item">
                                <div class="service-icon">
                                    <i class="fas fa-heartbeat"></i>
                                </div>
                                <div class="service-content">
                                    <h4>Proceduri Fizioterapeutice</h4>
                                    <p>Tratamente fizioterapeutice moderne în spații special amenajate.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="service-info">
                        <h2><?php echo t('important_info_title'); ?></h2>
                        <div class="info-grid">
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h4>Beneficiari</h4>
                                <p>Copii cu dizabilități motorii, comportamentale, intelectuale sau de vorbire</p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-user-md"></i>
                                </div>
                                <h4>Personal Calificat</h4>
                                <p>Terapeuți, kinetoterapeuti și specialiști în reabilitare</p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-home"></i>
                                </div>
                                <h4>Spații Specializate</h4>
                                <p>Săli special amenajate pentru toate tipurile de terapie</p>
                            </div>
                            <div class="info-card">
                                <div class="info-icon">
                                    <i class="fas fa-heart"></i>
                                </div>
                                <h4>Programe Individualizate</h4>
                                <p>Tratament personalizat pentru fiecare copil</p>
                            </div>
                        </div>
                    </div>

                    <div class="service-gallery">
                        <h2>Spațiile Noastre</h2>
                        <div class="gallery-grid">
                            <div class="gallery-item">
                                <img src="" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/terapie_senzoriala.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/hidroterapia.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4></h4>
                                </div>
                            </div>
                            <div class="gallery-item">
                                <img src="images/hidrokinetoterapie.jpg" alt="" loading="lazy">
                                <div class="gallery-overlay">
                                    <h4></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

        <?php include 'includes/footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>
