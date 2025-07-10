<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';

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
                        image('zi10.jpg', 'spaces', 'Camera de Odihnă', 'Spații confortabile pentru relaxare');
                        image('zi11.jpg', 'spaces', 'Spații de Recreere', 'Zone dedicate jocului și relaxării');
                        image('maternala3.jpg', 'activities', '', '');
                        image('respiro3.jpg', 'spaces', 'Spații Respiro', 'Mediu sigur și confortabil pentru copii');
                        image('respiro6.jpg', 'spaces', 'Mediu Terapeutic', 'Spații special amenajate pentru terapie'); 
                        image('sap4.jpg', 'activities', 'Descoperirea Faunei', 'La gradina zoologica');
                        image('sap13.jpg', 'events', 'Eveniment Amuzant', 'Muzica,Dansuri si Baloane');
                        image('z21.jpg', 'activities', 'Confectionarea lucrarilor plastice', 'O amintire pe toata viata');
                        image('14.jpg', 'activities', 'Admirarea Gradinii Zoo', 'Plante exotice');
                        image('21.jpg', 'activities', 'Jocuri Gonflabile', 'Sarituri si fericire');
                        image('35.jpg', 'events', 'Festival Mascat', 'Copii mascati in eroii lor');
                        image('555.jpg', 'activities', 'Teatru cu marionete', 'Un spectacol calptivant');
                        image('585.jpg', 'activities', 'Bucuria copiilor', 'Castigarea unui concurs');
                        image('zoo1.jpeg', 'activities', 'Excursie  la Zoo', 'Copiii descopera animale noi');
                        image('zoo2.jpeg', 'activities', 'Animale noi si interesante', 'Copiii sunt multumiti');
                        image('zoo3.jpeg', 'activities', 'Habitatele animalelor', 'Copiii descopera unde locuiesc animalele');
                        image('zoo4.jpeg', 'activities', 'Animale la inaltime', 'Maimute si multi papagali');
                        image('zoo5.jpeg', 'activities', 'Animal de desert', 'Copiii descopera camila');
                        image('zoo6.jpeg', 'activities', 'Broasca Testoasa mangaiata de copii', 'Multa afectiune si iubire');
                        image('zoo7.jpeg', 'activities', 'La Izvor', 'O mica pauza de la aceasta aventura');
                        image('zoo8.jpeg', 'activities', 'Descoperirea Bufnitei', 'Singura data cand va fi treaza ziua');
                        image('zoo9.jpeg', 'activities', 'Animale prin copaci', 'Cum ele se tin atat de mult acolo?');
                        image('1.jpg', 'activities', '', '');
                        image('2.jpg', 'activities', '', '');
                        image('3.jpg', 'activities', '', '');
                        image('4.jpg', 'activities', '', '');
                        image('5.jpg', 'activities', '', '');
                        image('6.jpg', 'activities', '', '');
                        image('7.jpg', 'activities', '', '');
                        image('8.jpg', 'activities', '', '');
                        image('9.jpg', 'activities', '', '');
                        image('10.jpg', 'activities', '', '');
                        image('11.jpg', 'activities', '', '');
                        image('12.jpg', 'activities', '', '');
                        image('13.jpg', 'activities', '', '');
                        image('15.jpg', 'activities', '', '');
                        image('16.jpg', 'activities', '', '');
                        image('17.jpg', 'activities', '', '');
                        image('18.jpg', 'activities', '', '');
                        image('19.jpg', 'activities', '', '');
                        image('20.jpg', 'activities', '', '');
                        image('22.jpg', 'activities', '', '');
                        image('23.jpg', 'activities', '', '');
                        image('cresa1.jpg', 'activities', '', '');
                        image('cresa2.jpg', 'activities', '', '');
                        image('cresa3.jpg', 'activities', '', '');
                        image('cresa4.jpg', 'activities', '', '');
                        image('cresa5.jpg', 'activities', '', '');
                        image('cresa6.jpg', 'activities', '', '');
                        image('criza6.jpg', 'activities', '', '');
                        image('criza1.jpg', 'activities', '', '');
                        image('criza2.jpg', 'activities', '', '');
                        image('criza3.jpg', 'activities', '', '');
                        image('criza4.jpg', 'activities', '', '');
                        image('criza5.jpg', 'activities', '', '');
                        image('criza7.jpg', 'activities', '', '');
                        image('criza8.jpg', 'activities', '', '');
                        image('criza9.jpg', 'activities', '', '');
                        image('criza10.jpg', 'activities', '', '');
                        image('criza11.jpg', 'activities', '', '');
                        image('criza12.jpg', 'activities', '', '');
                        image('criza13.jpg', 'activities', '', '');
                        image('maternala1.jpg', 'activities', '', '');
                        image('maternala2.jpg', 'activities', '', '');
                        image('maternala4.jpg', 'activities', '', '');
                        image('maternala5.jpg', 'activities', '', '');
                        image('zi.jpg', 'activities', '', '');

                        video('video5363927670348345826.mp4', 'events', 'Eveniment Special', 'Sărbătorirea unor momente importante');
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
</body>
</html>