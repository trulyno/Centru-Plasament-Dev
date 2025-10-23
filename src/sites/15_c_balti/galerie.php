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

function youtube($videoId, $category, $title = '', $desc = '') {
    // Extract video ID from URL if full URL is provided
    if (strpos($videoId, 'youtube.com') !== false || strpos($videoId, 'youtu.be') !== false) {
        if (preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $videoId, $matches)) {
            $videoId = $matches[1];
        }
    }
    
    $thumbnailUrl = "https://img.youtube.com/vi/" . htmlspecialchars($videoId) . "/maxresdefault.jpg";
    
    echo '
        <div class="gallery-item" data-category="' . htmlspecialchars($category) . '" data-type="youtube" data-video-id="' . htmlspecialchars($videoId) . '">
            <img src="' . $thumbnailUrl . '" alt="' . htmlspecialchars($title) . '" loading="lazy">
            <div class="gallery-overlay">
                <h3>' . htmlspecialchars($title) . '</h3>
                <p>' . htmlspecialchars($desc) . '</p>
                <div class="overlay-icon">
                    <i class="fab fa-youtube"></i>
                </div>
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
                        image('centru maternal/20220225_110248.jpg', '', '', '');
                        image('centru maternal/20220225_110340.jpg', '', '', '');
                        image('centru maternal/20241226_110458.jpg', '', '', '');
                        image('centru maternal/20241226_113036.jpg', '', '', '');
                        image('butonul1/butonul2.jpeg', '', '', '');
                        image('centru maternal/3ae3ff0b-beb4-4438-97c8-c82d08bd5dabphoto.jpeg', '', '', '');
                        image('centru maternal/7dac7c5d-7bbf-4737-beb4-f423cc2b0e68photo.jpeg', '', '', '');
                        image('centru maternal/9a05f984-3078-48c2-a7bb-000c0814265dphoto.jpeg', '', '', '');
                        image('centru maternal/9ff35cfc-e4ac-4f2d-93dd-23865df13569photo.jpeg', '', '', '');
                        image('cu plasamen planif/IMG_4555.jpeg', '', '', '');
                        image('cu plasamen planif/IMG_4561.jpeg', '', '', '');
                        image('greutate mica/IMG_4557.jpeg', '', '', '');
                        image('greutate mica/IMG_4558.jpeg', '', '', '');
                        image('greutate mica/IMG_4567.jpeg', '', '', '');
                        image('ingrij cop 4l-3ani/IMG_4564.jpeg', '', '', '');
                        image('ingrij cop 4l-3ani/IMG_4566.jpeg', '', '', '');
                        image('misiunea noastra/IMG_4867.jpeg', '', '', '');
                        image('servic de zi/IMG_4526.jpeg', '', '', '');
                        image('servic de zi/IMG_4560.jpeg', '', '', '');
                        image('servic de zi/IMG_4563.jpeg', '', '', '');
                        image('cu plasamen planif/20250417_103036.jpg', '', '', '');
                        image('cu plasamen planif/22.jpg', '', '', '');
                        image('cu plasamen planif/25.jpg', '', '', '');
                        image('cu plasamen planif/26.jpg', '', '', '');
                        image('cu plasamen planif/IMG_6283.JPG', '', '', '');
                        image('cu plasamen planif/IMG_6285.JPG', '', '', '');
                        image('greutate mica/IMG_4508.JPG', '', '', '');
                        image('greutate mica/IMG_4517.JPG', '', '', '');
                        image('ingrij cop 4l-3ani/IMG_6219.jpg', '', '', '');
                        image('ingrij cop 4l-3ani/IMG_6280.JPG', '', '', '');
                        image('int timp/5.jpg', '', '', '');
                        image('int timp/IMG_4530.JPG', '', '', '');
                        image('misiunea noastra/unnamed.jpg', '', '', '');
                        image('servic de zi/8.jpg', '', '', '');
                        image('servic de zi/9.jpg', '', '', '');
                        image('servic de zi/IMG_3067.JPG', '', '', '');
                        image('servic de zi/IMG_6258.JPG', '', '', '');
                        image('servic de zi/IMG_6261.JPG', '', '', '');
                        
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
                <iframe id="modalYoutube" 
                        style="display: none;" 
                        width="100%" 
                        height="100%" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                </iframe>
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