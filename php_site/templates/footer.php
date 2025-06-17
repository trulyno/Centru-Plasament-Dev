<?php
/**
 * Footer template included on all pages
 */
?>

    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container">
            <!-- Footer Top Section -->
            <div class="footer-top">
                <div class="footer-info">
                    <img src="/assets/images/logo.jpeg" alt="Logo Centru Plasament" class="footer-logo">
                    <p>Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă oferă îngrijire și sprijin pentru copii și familii în situații de risc.</p>
                </div>
                
                <div class="footer-contact">
                    <h3>Contact</h3>
                    <div class="contact-info-footer">
                        <div class="contact-item-footer">
                            <i class="fas fa-phone"></i>
                            <a href="tel:<?php echo CONTACT_PHONE; ?>"><?php echo CONTACT_PHONE; ?></a>
                        </div>
                        <div class="contact-item-footer">
                            <i class="fas fa-envelope"></i>
                            <a href="mailto:<?php echo CONTACT_EMAIL; ?>"><?php echo CONTACT_EMAIL; ?></a>
                        </div>
                        <div class="contact-item-footer">
                            <i class="fas fa-map-marker-alt"></i>
                            <address><?php echo CONTACT_ADDRESS; ?></address>
                        </div>
                    </div>
                </div>
                
                <div class="footer-links">
                    <h3>Linkuri Rapide</h3>
                    <ul>
                        <li><a href="/">Acasă</a></li>
                        <li><a href="/sectia-maternala">Secția Maternală</a></li>
                        <li><a href="/sectia-rezidentiala">Secția Rezidențială</a></li>
                        <li><a href="/sectia-de-zi">Secția de Zi</a></li>
                        <li><a href="/galerie">Galerie</a></li>
                        <li><a href="/intrebari-frecvente">Întrebări Frecvente</a></li>
                        <li><a href="/petitii-reclamatii">Petiții și Reclamații</a></li>
                    </ul>
                </div>
                
                <div class="footer-social">
                    <h3>Urmăriți-ne</h3>
                    <div class="social-icons">
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook"></i></a>
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Footer Bottom Section -->
            <div class="footer-bottom">
                <div class="footer-partners">
                    <p>Partenerii noștri:</p>
                    <div class="partner-logos">
                        <a href="#"><img src="/assets/images/logo-primaria.png" alt="Logo Primaria Chișinău"></a>
                        <a href="#"><img src="/assets/images/logo-mm.png" alt="Logo Ministerul Muncii"></a>
                        <a href="#"><img src="/assets/images/logo-mps.webp" alt="Logo MPS"></a>
                        <a href="#"><img src="/assets/images/logo-unicef.png" alt="Logo UNICEF"></a>
                        <a href="#"><img src="/assets/images/logo-dgets.png" alt="Logo DGETS"></a>
                    </div>
                </div>
                
                <div class="footer-copyright">
                    <p>&copy; <?php echo date('Y'); ?> Centrul de Plasament și Reabilitare pentru Copiii de Vârstă Fragedă. Toate drepturile rezervate.</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to top button -->
    <button id="backToTop" class="back-to-top" aria-label="Înapoi la început">
        <i class="fas fa-arrow-up"></i>
    </button>

    <!-- JavaScript -->
    <script src="/assets/js/script.js"></script>
</body>
</html>
