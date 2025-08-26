
    <!-- GDPR Settings Section (above footer) -->
    <?php echo GDPRManager::renderFooterConsentSection(); ?>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-main">
                    <p><?php echo t('footer_copyright'); ?></p>
                </div>
                <div class="footer-links">
                    <a href="privacy-policy.php"><?php echo t('footer_privacy_policy'); ?></a>
                    <a href="#" class="footer-link-btn" onclick="openGDPRModal(); return false;">
                        <i class="fas fa-cog"></i>
                        <?php echo t('gdpr_customize_settings'); ?>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- GDPR Compliance Components -->
    <?php echo GDPRManager::renderConsentModal(); ?>
