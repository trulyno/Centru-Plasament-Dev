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
                        image('35414340_1971446026213393_7159231327290523648_n.jpg', 'events', '', '');
                        image('62430711_2518594071498583_1702592071983955968_n.jpg', 'events', '', '');
                        image('90157406-5d79-457e-b15c-2ca8280d59a8.jpeg', 'events', '', '');
                        image('465467964_9175578372466753_3153707713661157327_n.jpg', 'events', '', '');
                        image('465902125_9203929329631657_4720045432653106753_n.jpg', 'events', '', '');
                        image('476229653_1150989880153553_4153833112061254632_n.jpg', 'events', '', '');
                        image('483679680_1175620857690455_4630292612765403412_n.jpg', 'activities', '', '');
                        image('484347177_1178807370705137_2513999702540758669_n.jpg', 'therapy', '', '');
                        image('498153368_1230382275547646_3236568873941507497_n.jpg', 'activities', '', '');
                        image('499479238_1230373372215203_7708007265984725921_n.jpg', 'therapy', '', '');
                        image('499735032_1234985461753994_1856062075427537214_n.jpg', 'therapy', '', '');
                        image('510967252_1258802939372246_5576479473063294149_n.jpg', 'events', '', '');
                        image('IMG_0732.JPG', 'activities', '', '');
                        image('IMG_0745.JPG', 'events', '', '');
                        image('IMG_2350[1].JPG', 'activities', '', '');
                        image('IMG_2359[1].JPG', 'events', '', '');
                        image('IMG_2609[1].JPG', 'events', '', '');
                        image('IMG_2647[1].JPG', 'events', '', '');
                        image('IMG_2696[1].JPG', 'activities', '', '');
                        image('IMG_2795[1].JPG', 'events', '', '');
                        image('IMG_20250627_140234.jpg', 'activities', '', '');
                        image('logo1.jpg', 'therapy', '', '');
                        
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