<?php
/**
 * Home page (index)
 */

// Page-specific metadata
$pageDescription = 'Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă oferă îngrijire cuprinzătoare pentru copiii mici în nevoie. Plasament sigur, terapie, suport educațional și servicii de reunificare familială.';
$pageKeywords = 'plasament copii, reabilitare, plasament familial, adopție, terapie pentru copii, servicii familiale';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="hero-content">
        <h1>Bine ați venit la Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă</h1>
        <p>Oferim servicii complexe de îngrijire și reabilitare pentru copiii aflați în situații de dificultate</p>
        <div class="hero-buttons">
            <a href="/sectia-maternala" class="btn btn-primary">Secția Maternală</a>
            <a href="/sectia-rezidentiala" class="btn btn-secondary">Secția Rezidențială</a>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="services" id="services">
    <div class="section-container">
        <div class="section-header">
            <h2>Serviciile Noastre</h2>
            <p>Oferim o gamă largă de servicii specializate pentru copii și familii</p>
        </div>
        
        <div class="services-grid">
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-home"></i>
                </div>
                <h3>Secția Maternală</h3>
                <p>Sprijin pentru mame și copii aflați în situații de risc, prevenind abandonul și dezvoltând abilitățile parentale.</p>
                <a href="/sectia-maternala" class="service-link">Află mai multe <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-bed"></i>
                </div>
                <h3>Secția Rezidențială</h3>
                <p>Îngrijire completă pentru copiii care necesită plasament, creând un mediu sigur și stimulativ pentru dezvoltare.</p>
                <a href="/sectia-rezidentiala" class="service-link">Află mai multe <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-sun"></i>
                </div>
                <h3>Secția de Zi</h3>
                <p>Servicii de îngrijire pe timpul zilei pentru familiile aflate în dificultate, incluzând activități educative și hrană.</p>
                <a href="/sectia-de-zi" class="service-link">Află mai multe <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3>Secția de Reabilitare</h3>
                <p>Terapii specializate pentru recuperare medicală și dezvoltare, sprijin pentru copiii cu nevoi speciale.</p>
                <a href="/sectia-reabilitare" class="service-link">Află mai multe <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <h3>Secția Respiro</h3>
                <p>Îngrijire temporară pentru familii, oferind părinților răgazul necesar în situații dificile.</p>
                <a href="/sectia-respiro" class="service-link">Află mai multe <i class="fas fa-arrow-right"></i></a>
            </div>
            
            <div class="service-card">
                <div class="service-icon">
                    <i class="fas fa-baby"></i>
                </div>
                <h3>Secția Zi (4 luni - 3 ani)</h3>
                <p>Program specializat pentru copii foarte mici, cu focus pe stimulare timpurie și îngrijire adaptată.</p>
                <a href="/sectia-zi-4luni-3ani" class="service-link">Află mai multe <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about" id="about">
    <div class="section-container">
        <div class="about-content">
            <div class="about-text">
                <h2>Despre Centrul Nostru</h2>
                <p>Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă este o instituție publică specializată, dedicată îngrijirii și bunăstării copiilor care se află în situații dificile și care necesită protecție și suport.</p>
                <p>Misiunea noastră este de a oferi un mediu sigur, stimulativ și afectuos pentru copii, favorizând dezvoltarea lor armonioasă și facilitând integrarea lor în societate.</p>
                <div class="about-stats">
                    <div class="stat-item">
                        <div class="stat-number">25+</div>
                        <div class="stat-text">Ani de Experiență</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">100+</div>
                        <div class="stat-text">Specialiști Dedicați</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-number">1000+</div>
                        <div class="stat-text">Copii Ajutați</div>
                    </div>
                </div>
                <a href="/administratia" class="btn btn-primary">Despre Administrație</a>
            </div>
            <div class="about-image">
                <img src="/assets/images/sectia-de-zi.jpg" alt="Imagine Centru de Plasament">
            </div>
        </div>
    </div>
</section>

<!-- Gallery Preview Section -->
<section class="gallery-preview">
    <div class="section-container">
        <div class="section-header">
            <h2>Galerie</h2>
            <p>Imagini din activitățile și facilitățile centrului</p>
        </div>
        
        <div class="gallery-grid">
            <?php
            // Define a list of images for the gallery preview
            $galleryImages = [
                ['file' => 'maternala1.jpg', 'alt' => 'Secția Maternală'],
                ['file' => 'respiro1.jpg', 'alt' => 'Secția Respiro'],
                ['file' => 'zi1.png', 'alt' => 'Secția de Zi'],
                ['file' => 'hidroterapia.jpg', 'alt' => 'Hidroterapie'],
                ['file' => 'kinetoterapie.jpg', 'alt' => 'Kinetoterapie'],
                ['file' => 'masaj.jpg', 'alt' => 'Masaj terapeutic']
            ];
            
            // Display gallery images
            foreach ($galleryImages as $image) {
                echo '<div class="gallery-item">
                    <img src="/assets/images/' . $image['file'] . '" alt="' . $image['alt'] . '">
                    <div class="gallery-overlay">
                        <a href="/galerie" class="gallery-link">
                            <i class="fas fa-search-plus"></i>
                        </a>
                    </div>
                </div>';
            }
            ?>
        </div>
        
        <div class="gallery-more">
            <a href="/galerie" class="btn btn-secondary">Vezi întreaga galerie</a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials">
    <div class="section-container">
        <div class="section-header">
            <h2>Testimoniale</h2>
            <p>Ce spun despre noi familiile și partenerii</p>
        </div>
        
        <div class="testimonials-slider" id="testimonialsSlider">
            <div class="testimonial-slide">
                <div class="testimonial-content">
                    <div class="testimonial-text">
                        <i class="fas fa-quote-left"></i>
                        <p>Centrul a oferit sprijin vital pentru mine și copilul meu într-un moment dificil. Am primit nu doar un acoperiș deasupra capului, ci și suport emoțional și practici care m-au ajutat să devin un părinte mai bun.</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-info">
                            <h4>Ana M.</h4>
                            <p>Beneficiară a Secției Maternale</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-slide">
                <div class="testimonial-content">
                    <div class="testimonial-text">
                        <i class="fas fa-quote-left"></i>
                        <p>Activitatea Centrului este de o importanță extraordinară pentru comunitate. Profesionalismul personalului și dedicarea lor față de bunăstarea copiilor merită toată aprecierea noastră.</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-info">
                            <h4>Dr. Mihai P.</h4>
                            <p>Medic Pediatru, partener</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-slide">
                <div class="testimonial-content">
                    <div class="testimonial-text">
                        <i class="fas fa-quote-left"></i>
                        <p>Secția de Reabilitare a făcut minuni pentru dezvoltarea fiicei noastre. Terapiile specializate și îngrijirea personalizată au făcut o diferență enormă în progresul ei.</p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-info">
                            <h4>Familia Ionescu</h4>
                            <p>Beneficiari ai Secției de Reabilitare</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="testimonials-controls">
            <button id="prevTestimonial" class="testimonial-btn" aria-label="Testimonial precedent">
                <i class="fas fa-arrow-left"></i>
            </button>
            <div class="testimonial-indicators">
                <span class="active"></span>
                <span></span>
                <span></span>
            </div>
            <button id="nextTestimonial" class="testimonial-btn" aria-label="Testimonial următor">
                <i class="fas fa-arrow-right"></i>
            </button>
        </div>
    </div>
</section>

<!-- FAQ Preview Section -->
<section class="faq-preview">
    <div class="section-container">
        <div class="section-header">
            <h2>Întrebări Frecvente</h2>
            <p>Răspunsuri la cele mai comune întrebări</p>
        </div>
        
        <div class="faq-items">
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Cum pot beneficia de serviciile centrului?</h3>
                    <span class="faq-toggle"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Pentru a accesa serviciile noastre, puteți contacta asistența socială din cadrul primăriei sau ne puteți contacta direct la numărul de telefon <?php echo CONTACT_PHONE; ?>. Veți fi ghidat prin procesul de evaluare și veți fi informat despre serviciile disponibile care se potrivesc nevoilor dumneavoastră.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Care sunt criteriile de eligibilitate pentru Secția Maternală?</h3>
                    <span class="faq-toggle"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Secția Maternală este destinată mamelor cu copii care se află în situații de risc, inclusiv mame minore, victime ale violenței domestice, sau cele care nu au resurse pentru creșterea copilului. Fiecare caz este evaluat individual de către echipa noastră multidisciplinară.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Ce tipuri de terapii sunt disponibile în Secția de Reabilitare?</h3>
                    <span class="faq-toggle"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Secția noastră de Reabilitare oferă o gamă largă de terapii: kinetoterapie, hidroterapie, terapie senzorială, masaj terapeutic, logopedie, și intervenții psihologice. Programul terapeutic este personalizat în funcție de nevoile specifice ale fiecărui copil.</p>
                </div>
            </div>
        </div>
        
        <div class="faq-more">
            <a href="/intrebari-frecvente" class="btn btn-primary">Vezi toate întrebările</a>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact" id="contact">
    <div class="section-container">
        <div class="section-header">
            <h2>Contact</h2>
            <p>Suntem aici pentru a vă răspunde întrebărilor</p>
        </div>
        
        <div class="contact-container">
            <div class="contact-info">
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="contact-text">
                        <h3>Adresa noastră</h3>
                        <address><?php echo CONTACT_ADDRESS; ?></address>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="contact-text">
                        <h3>Telefon</h3>
                        <a href="tel:<?php echo CONTACT_PHONE; ?>"><?php echo CONTACT_PHONE; ?></a>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="contact-text">
                        <h3>Email</h3>
                        <a href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="contact-text">
                        <h3>Program</h3>
                        <p>Luni - Vineri: 8:00 - 17:00</p>
                        <p>Weekend: Închis</p>
                    </div>
                </div>
            </div>
            
            <div class="contact-form">
                <form id="contactForm" action="/contact-process.php" method="POST">
                    <div class="form-group">
                        <label for="name">Nume și Prenume</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Telefon</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    
                    <div class="form-group">
                        <label for="subject">Subiect</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Mesaj</label>
                        <textarea id="message" name="message" rows="5" required></textarea>
                    </div>
                    
                    <div class="form-group form-checkbox">
                        <input type="checkbox" id="consent" name="consent" required>
                        <label for="consent">Sunt de acord cu <a href="/politica-confidentialitate">politica de confidențialitate</a> și procesarea datelor personale.</label>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Trimite Mesaj</button>
                </form>
                <div id="formMessage" class="form-message"></div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map">
    <div class="map-container">
        <iframe 
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2719.956961842525!2d28.860837115627716!3d47.02973397914919!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40c97cbc3699bb03%3A0x8f49a688f352ab8a!2sCuza%20Vod%C4%83%2029%2F2%2C%20Chi%C8%99in%C4%83u%2C%20Moldova!5e0!3m2!1sen!2sus!4v1623245433333!5m2!1sen!2sus" 
            width="600" 
            height="450" 
            style="border:0;" 
            allowfullscreen="" 
            loading="lazy"
            title="Harta Centrului de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă"
            aria-label="Locația Centrului pe hartă"
        ></iframe>
    </div>
</section>
