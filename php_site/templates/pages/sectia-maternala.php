<?php
/**
 * Secția Maternală page template
 */

// Page-specific metadata
$pageDescription = 'Secția Maternală oferă sprijin și adăpost mamelor și copiilor aflați în dificultate, dezvoltând abilitățile parentale și susținând relațiile familiale.';
$pageKeywords = 'maternală, mame singure, mame minore, gravide, violență domestică, sprijin familial';
?>

<!-- Main Content -->
<section class="page-header">
    <div class="container">
        <h1>Secția Maternală</h1>
        <p>Sprijin și protecție pentru mame și copii în situații de dificultate</p>
    </div>
</section>

<section class="content-section">
    <div class="container">
        <div class="content-wrapper">
            <div class="service-hero">
                <div class="service-hero-content">
                    <h2>Despre Secția Maternală</h2>
                    <p>Secția Maternală este un serviciu social gratuit ce previne separarea copilului de părinți, oferind sprijin și adăpost mamelor și copiilor aflați în dificultate. Aceasta dezvoltă abilitățile parentale, susține relațiile familiale și ajută la reintegrarea socială.</p>
                </div>
                <div class="service-hero-image">
                    <img src="/assets/images/maternala1.jpg" alt="Secția Maternală" loading="lazy">
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
                            <h4>Cazare Temporară</h4>
                            <p>Până la 16 cupluri mamă-copil pentru maximum 6 luni cu posibilitate de prelungire.</p>
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="service-content">
                            <h4>Dezvoltare Abilități Parentale</h4>
                            <p>Instruire și consiliere pentru dezvoltarea competențelor de creștere și îngrijire a copiilor.</p>
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <div class="service-content">
                            <h4>Consiliere Psihologică</h4>
                            <p>Sprijin psihologic și social pentru depășirea situațiilor de criză.</p>
                        </div>
                    </div>
                    <div class="service-item">
                        <div class="service-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <div class="service-content">
                            <h4>Educație și Reintegrare</h4>
                            <p>Sprijin pentru reintegrarea socială și dezvoltarea autonomiei personale.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="service-info">
                <h2>Informații Importante</h2>
                <div class="info-grid">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h4>Beneficiari</h4>
                        <p>Mame singure, minore, gravide vulnerabile, victime ale violenței domestice</p>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h4>Durata Serviciului</h4>
                        <p>Maximum 6 luni cu posibilitate de prelungire</p>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-bed"></i>
                        </div>
                        <h4>Capacitate</h4>
                        <p>Până la 16 cupluri mamă-copil</p>
                    </div>
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h4>Program</h4>
                        <p>Serviciu permanent 24/7</p>
                    </div>
                </div>
            </div>

            <div class="service-gallery">
                <h2>Galeria Secției Maternale</h2>
                <div class="gallery-grid">
                    <?php
                    // Define gallery images for this section
                    $maternalGallery = [
                        ['file' => 'maternala1.jpg', 'title' => 'Camere Confortabile', 'alt' => 'Camera pentru Mame și Copii'],
                        ['file' => 'maternala2.jpg', 'title' => 'Spațiu de Joacă pentru Copii', 'alt' => 'Spațiu de Joacă'],
                        ['file' => 'maternala3.jpg', 'title' => 'Consiliere și Instruire', 'alt' => 'Consiliere Parentală'],
                        ['file' => 'maternala4.jpg', 'title' => 'Bucătărie Utilată', 'alt' => 'Bucătărie Utilată'],
                        ['file' => 'maternala5.jpg', 'title' => 'Sala de Instruire', 'alt' => 'Sala de Instruire']
                    ];
                    
                    // Display gallery images
                    foreach ($maternalGallery as $image) {
                        echo '<div class="gallery-item">
                            <img src="/assets/images/' . $image['file'] . '" alt="' . $image['alt'] . '" loading="lazy">
                            <div class="gallery-overlay">
                                <h4>' . $image['title'] . '</h4>
                            </div>
                        </div>';
                    }
                    ?>
                </div>
            </div>

            <div class="contact-cta">
                <h3>Contactează-ne pentru mai multe informații</h3>
                <p>Pentru detalii despre serviciile Secției Maternale sau pentru a solicita acest serviciu, te rugăm să ne contactezi.</p>
                <a href="/#contact" class="cta-button">Contactează-ne</a>
            </div>
        </div>
    </div>
</section>
