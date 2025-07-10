<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';

function document($src, $title = '') {
    echo '<div class="document-card">
                <div class="document-icon">
                    <i class="fas fa-file-pdf"></i>
                </div>
                <div class="document-content">
                    <h3>' . $title . '</h3>
                    <a href="' . $src . '" class="document-link" target="_blank">
                        <i class="fas fa-external-link-alt"></i> Vezi document
                    </a>
                </div>
            </div>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('guides_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('guides_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('guides_page_title'); ?></title>
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
                <h1><?php echo t('guides_header_title'); ?></h1>
                <p><?php echo t('guides_header_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <h2><?php echo t('guides_header_title'); ?></h2>
                    <p><?php echo t('content_coming_soon'); ?></p>
                </div>
            </div>
        </section>
    </main>

        <?php include 'includes/footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>