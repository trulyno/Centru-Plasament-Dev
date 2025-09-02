<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
require_once __DIR__ . '/includes/gdpr.php';
require_once __DIR__ . '/includes/analytics.php';

function image($src, $category, $title = '', $desc = '') {
    echo '
        <div class="gallery-item" data-category="' . htmlspecialchars($category) . '">
            <img src="images/' . htmlspecialchars($src) . '" alt="' . htmlspecialchars($title) . '" loading="lazy">
            <div class="gallery-overlay">
                <h3>' . htmlspecialchars($title) . '</h3>
                <p>' . htmlspecialchars($desc) . '</p>
                <div class="overlay-icon">
                    <i class="fas fa-search-plus"></i>
                </div>
            </div>
        </div>';
}

function video($src, $category, $title = '', $desc = '') {
    echo '
        <div class="gallery-item" data-category="' . htmlspecialchars($category) . '" data-type="video">
            <video src="videos/' . htmlspecialchars($src) . '" loading="lazy" muted>
                Browser-ul tău nu suportă elementul video.
            </video>
            <div class="gallery-overlay">
                <h3>' . htmlspecialchars($title) . '</h3>
                <p>' . htmlspecialchars($desc) . '</p>
            </div>
        </div>';
}

?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('gallery_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('gallery_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('gallery_page_title'); ?></title>
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
                <h1><?php echo t('gallery_section_title'); ?></h1>
                <p><?php echo t('gallery_section_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="gallery">
                    <div class="gallery-categories">
                        <button class="filter-btn active" data-filter="all"><?php echo t('gallery_filter_all'); ?></button>
                        <button class="filter-btn" data-filter="activities"><?php echo t('gallery_filter_activities'); ?></button>
                        <button class="filter-btn" data-filter="spaces"><?php echo t('gallery_filter_spaces'); ?></button>
                        <button class="filter-btn" data-filter="therapy"><?php echo t('gallery_filter_therapy'); ?></button>
                        <button class="filter-btn" data-filter="events"><?php echo t('gallery_filter_events'); ?></button>
                        <button class="filter-btn" data-filter="videos"><?php echo t('gallery_filter_videos'); ?></button>
                    </div>
                    <div class="gallery-grid">
                        <?php
                        // image('zi10.jpg', 'spaces', 'Camera de Odihnă', 'Spații confortabile pentru relaxare');
                        image('20250409_094126.jpg', 'activities', '', '');
                        image('20250409_095137.jpg', 'activities', '', '');
                        image('20250409_095151.jpg', 'activities', '', '');
                        image('20250409_103615.jpg', 'activities', '', '');
                        image('20250409_094126.jpg', 'spaces', '', '');
                        image('20250410_101150.jpg', 'spaces', '', '');
                        image('20250627_093744.jpg', 'spaces', '', '');
                        image('20250627_094357.jpg', 'activities', '', '');
                        image('259640924_1287898065006950_1799962175050298974_n.jpg', 'events', '', '');
                        image('a0d64175-841e-4af3-890b-d71b3edc83ca.jpg', 'events', '', '');
                        image('Fata Centrului 2021.jpg', 'spaces', '', '');
                        image('IMG_20190721_173019.jpg', 'events', '', '');
                        image('IMG_20190721_181621.jpg', 'events', '', '');
                        image('IMG_20190721_181625.jpg', 'events', '', '');
                        image('IMG_20190722_183125.jpg', 'activities', '', '');
                        image('photo_5373042441810210718_y.jpg', 'activities', '', '');
                        ?>         
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
                <video id="modalVideo" controls style="display: none;">
                    <source src="" type="video/mp4">
                    Browser-ul tău nu suportă elementul video.
                </video>
            </div>
            <div class="modal-info">
                <h3 id="modalTitle"></h3>
                <p id="modalDescription"></p>
            </div>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>


    <script src="script.js"></script>
    <script src="gdpr-script.js"></script>
</body>
</html>