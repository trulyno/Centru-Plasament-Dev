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
                        // ACTIVITĂȚI EDUCAȚIONALE - Ateliere tematice
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/9 mai-Ziua Europei.jpg', 'activities', 'Ziua Europei', 'Atelier tematic dedicat Zilei Europei - 9 mai');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/9 mai-Ziua Europei2.jpg', 'activities', 'Ziua Europei', 'Copiii celebrează Ziua Europei prin activități educative');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Adolescența este mai frumoasă în siguranță.jpg', 'activities', 'Educație pentru adolescenți', 'Workshop despre siguranță în adolescență');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Adolescența este mai frumoasă în siguranță!2.jpg', 'activities', 'Educație pentru adolescenți', 'Activități educative pentru adolescenți');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Adolescența este mai frumoasă în siguranță!3.jpg', 'activities', 'Educație pentru adolescenți', 'Sesiune educațională despre adolescență responsabilă');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Eu respect demnitatea umană!.jpg', 'activities', 'Demnitate umană', 'Atelier despre respectul pentru demnitatea umană');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Eu respect demnitatea umană2.jpg', 'activities', 'Demnitate umană', 'Copiii învață despre importanța respectului mutual');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Familia.jpg', 'activities', 'Valori familiale', 'Atelier despre importanța familiei');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Familia2.jpg', 'activities', 'Valori familiale', 'Discuții despre relațiile familiale sănătoase');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Familia3.jpg', 'activities', 'Valori familiale', 'Activități despre legăturile familiale');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Spune Nu drogurilor!.jpg', 'activities', 'Prevenție antidrog', 'Campanie de prevenție împotriva drogurilor');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Spune Nu drogurilor2.jpg', 'activities', 'Prevenție antidrog', 'Educație despre pericolele drogurilor');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Spune Nu drogurilor3.jpg', 'activities', 'Prevenție antidrog', 'Workshop preventiv despre substanțele interzise');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Spune Nu traficului de ființe umane.jpg', 'activities', 'Prevenție trafic uman', 'Educație despre prevenirea traficului de persoane');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Spune Nu traficului de ființe umane2.jpg', 'activities', 'Prevenție trafic uman', 'Sesiune de informare despre traficul de persoane');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Spune Nu traficului de ființe umane3.jpg', 'activities', 'Prevenție trafic uman', 'Atelier de conștientizare despre siguranță personală');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Spunem Stop discriminării.jpg', 'activities', 'Împotriva discriminării', 'Campanie împotriva discriminării');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Spunem Stop discriminării2.jpg', 'activities', 'Împotriva discriminării', 'Activități pentru promovarea egalității');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Spunem Stop discriminării3.jpg', 'activities', 'Împotriva discriminării', 'Workshop despre diversitate și incluziune');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Spunem Stop discriminării4.jpg', 'activities', 'Împotriva discriminării', 'Educație pentru toleranță și respect');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Spunem Stop discriminării5.jpg', 'activities', 'Împotriva discriminării', 'Sesiune educativă despre non-discriminare');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Violența este arma celor slabi.jpg', 'activities', 'Împotriva violenței', 'Campanie împotriva violenței');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/ateliere tematice/Violența este arma celor slabi2.jpg', 'activities', 'Împotriva violenței', 'Workshop despre rezolvarea pașnică a conflictelor');
                        
                        // ACTIVITĂȚI EDUCAȚIONALE - Lecții nonformale
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/lecții nonformale/”Importanța cooperării în Echipă”.jpg', 'activities', 'Lucrul în echipă', 'Lecție despre cooperarea și munca în echipă');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/lecții nonformale/Activitate cu tema ”Pubertatea”.jpg', 'activities', 'Educație sexuală', 'Sesiune educativă despre pubertate');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/lecții nonformale/Activitste cu tema ”Importanța cooperării în Echipă”.jpg', 'activities', 'Lucrul în echipă', 'Activități practice de cooperare');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/lecții nonformale/Cum actionam in cazul calamităților naturale.jpg', 'activities', 'Siguranță', 'Educație despre comportamentul în caz de calamități');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/lecții nonformale/Cum acționăm in cazul calamityăților naturale2.jpg', 'activities', 'Siguranță', 'Workshop despre pregătirea pentru dezastre naturale');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/lecții nonformale/Cum acționăm in cazul calamităților naturale3.jpg', 'activities', 'Siguranță', 'Simulare de situații de urgență');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/lecții nonformale/Micii Europeni- excursie virtuală în Germania.jpg', 'activities', 'Educație europeană', 'Excursie virtuală în Germania');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/lecții nonformale/Micii europeni- excursie virtuală în Germania2.jpg', 'activities', 'Educație europeană', 'Copiii explorează cultura germană');
                        
                        // ACTIVITĂȚI EDUCAȚIONALE - Vizite educative
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/vizite educative/La memorialul victimelor Holocaustului.jpg', 'activities', 'Vizită memorialul Holocaust', 'Vizită educativă la memorialul victimelor Holocaustului');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/vizite educative/La memorialul victimelor Holocaustului2.jpg', 'activities', 'Vizită memorialul Holocaust', 'Moment de comemorare și educație istorică');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/vizite educative/Muzeul de istorie si etnografie s.Cosăuți.jpg', 'activities', 'Vizită muzeul', 'Vizită la muzeul de istorie și etnografie din Cosăuți');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/vizite educative/Muzeul de istorie si etnografie s.Cosăuți2.jpg', 'activities', 'Vizită muzeul', 'Copiii descoperă istoria locală');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/vizite educative/Muzeul de istorie si etnografie s.Cosăuți3.jpg', 'activities', 'Vizită muzeul', 'Sesiune educativă la muzeu');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/vizite educative/Vizită la DSE Soroca.jpg', 'activities', 'Vizită DSE', 'Vizită educativă la Direcția pentru Situații de Urgență');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/vizite educative/Vizită la DSE Soroca2.jpg', 'activities', 'Vizită DSE', 'Copiii învață despre siguranță publică');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/vizite educative/Vizită la DSE Soroca3.jpg', 'activities', 'Vizită DSE', 'Demonstrații practice de salvare');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/vizite educative/Vizită la muzeul de istorie și etnografie Soroca.jpg', 'activities', 'Vizită muzeul Soroca', 'Vizită la muzeul de istorie din Soroca');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/vizite educative/Vizită la muzeul de istorie și etnografie Soroca2.jpg', 'activities', 'Vizită muzeul Soroca', 'Explorarea tradițiilor locale');
                        image('POZE CENTRU/ACTIVITĂȚI EDUCAȚIONALE/vizite educative/Vizită la muzeul de istorie și etnografie Soroca3.jpg', 'activities', 'Vizită muzeul Soroca', 'Activități interactive la muzeu');
                        
                        // ACTIVITĂȚI RECREATIVE ȘI CULTURALE - Jocuri și activități în aer liber
                        image('POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/Jocuri și activități în aer liber/Copilăria e desopre joacă.jpg', 'activities', 'Jocuri în aer liber', 'Copilăria înseamnă joacă și distracție');
                        image('POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/Jocuri și activități în aer liber/Copilăria e despre joacă2.jpg', 'activities', 'Jocuri în aer liber', 'Activități recreative pentru copii');
                        image('POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/Jocuri și activități în aer liber/Copilăria e despre joacă3.jpg', 'activities', 'Jocuri în aer liber', 'Timpul liber petrecut prin joacă');
                        image('POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/Jocuri și activități în aer liber/Copilăria e despre joacă4.jpg', 'activities', 'Jocuri în aer liber', 'Bucuria jocului în natură');
                        image('POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/Jocuri și activități în aer liber/Fiecare zi de vară e o aventură!.jpg', 'activities', 'Activități de vară', 'Aventuri de vară pentru copii');
                        image('POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/Jocuri și activități în aer liber/Fiecare zi de vară e o aventură!2.jpg', 'activities', 'Activități de vară', 'Programme de vară pline de aventuri');
                        image('POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/Jocuri și activități în aer liber/Fiecare zi de vară e o aventură!3.jpg', 'activities', 'Activități de vară', 'Jocuri și explorări în aer liber');
                        image('POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/Jocuri și activități în aer liber/Fiecare zi de vară e o aventură!4.jpg', 'activities', 'Activități de vară', 'Distracție și învățare în natură');
                        image('POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/Jocuri și activități în aer liber/Fiecare zi de vară e o aventură!5.jpg', 'activities', 'Activități de vară', 'Experiențe memorabile de vară');
                        
                        // ACTIVITĂȚI RECREATIVE ȘI CULTURALE - Participare la spectacole
                        image('POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/participare la spectacole/Târgul meșterilor populari 2025.jpg', 'events', 'Târg meșteri populari', 'Participare la târgul meșterilor populari 2025');
                        image('POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/participare la spectacole/Târgul meșterilor populari2.jpg', 'events', 'Târg meșteri populari', 'Copiii descoperă meșteșugurile tradiționale');
                        image('POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/participare la spectacole/Târgul meșterilor populari3.jpg', 'events', 'Târg meșteri populari', 'Activități culturale și tradiționale');
                        
                        // ACTIVITĂȚI RECREATIVE ȘI CULTURALE - Zile tematice, excursii
                        image('POZE CENTRU/ACTIVITYATI RECREATIVE SI CULTURALE/Zile tematice, excursii/La steaua care-a răsărit.....jpg', 'events', 'Sărbători de iarnă', 'Celebrarea sărbătorilor de iarnă');
                        
                        // DEZVOLTARE PERSONALĂ ȘI SOCIALĂ
                        image('POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/Gestionarea corectă a banilor.jpg', 'therapy', 'Educație financiară', 'Workshop despre gestionarea responsabilă a banilor');
                        
                        // DEZVOLTARE PERSONALĂ ȘI SOCIALĂ - Activități de dezvoltare a abilităților sociale
                        image('POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/activități de dezvoltare a abilităților sociale/Activități de salubrizare -Ziua Nistrului.jpg', 'activities', 'Ziua Nistrului', 'Activități de salubrizare pentru Ziua Nistrului');
                        image('POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/activități de dezvoltare a abilităților sociale/Activități de salubrizare -Ziua Nistrului2.jpg', 'activities', 'Ziua Nistrului', 'Copiii participă la curățenia mediului');
                        image('POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/activități de dezvoltare a abilităților sociale/Activități de salubrizare -Ziua Nistrului3.jpg', 'activities', 'Ziua Nistrului', 'Educație ecologică prin acțiuni practice');
                        
                        // DEZVOLTARE PERSONALĂ ȘI SOCIALĂ - Ateliere de artterapie, muzică, sport
                        image('POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/ateliere de artterapie,muzica, sport/Activități de ergoterapie.jpg', 'therapy', 'Ergoterapie', 'Sesiuni de ergoterapie pentru dezvoltare motorie');
                        image('POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/ateliere de artterapie,muzica, sport/Activități de ergoterapie2.jpg', 'therapy', 'Ergoterapie', 'Exerciții de dezvoltare a abilităților motorii');
                        image('POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/ateliere de artterapie,muzica, sport/Activități de ergoterapie3.jpg', 'therapy', 'Ergoterapie', 'Terapie ocupațională adaptată');
                        image('POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/ateliere de artterapie,muzica, sport/Activități de ergoterapie4.jpg', 'therapy', 'Ergoterapie', 'Programe personalizate de ergoterapie');
                        image('POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/ateliere de artterapie,muzica, sport/Activități de sport.jpg', 'activities', 'Activități sportive', 'Programme de sport și mișcare');
                        image('POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/ateliere de artterapie,muzica, sport/Activități de sport!2.jpg', 'activities', 'Activități sportive', 'Sport și jocuri de echipă');
                        image('POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/ateliere de artterapie,muzica, sport/Activități de sport3.jpg', 'activities', 'Activități sportive', 'Dezvoltarea fizică prin sport');
                        
                        // DEZVOLTARE PERSONALĂ ȘI SOCIALĂ - Sprijin emoțional
                        image('POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/sprijin emoțional/Gestionarea emoțiilor- Pro-Viața.jpg', 'therapy', 'Gestionarea emoțiilor', 'Workshop pentru gestionarea emoțiilor');
                        image('POZE CENTRU/DEZVOLTARTE PERSONALĂ ȘI SOCIALĂ/sprijin emoțional/Gestionarea emoțiilor- Pro-Viața2.jpg', 'therapy', 'Gestionarea emoțiilor', 'Sesiuni de sprijin emoțional');
                        
                        // EVENIMENTE SPECIALE - Sărbători
                        image('POZE CENTRU/EVENIMENTE SPECIALE/sărbători/Zi de naștere în spital.jpg', 'events', 'Aniversare în spital', 'Sărbătorirea unei zile de naștere în spital');
                        image('POZE CENTRU/EVENIMENTE SPECIALE/sărbători/Zi de naștere în spital2.jpg', 'events', 'Aniversare în spital', 'Bucurie și zâmbete în ziua specială');
                        image('POZE CENTRU/EVENIMENTE SPECIALE/sărbători/Ziua Copilăriei.jpg', 'events', 'Ziua Copilăriei', 'Celebrarea Zilei Internaționale a Copilului');
                        image('POZE CENTRU/EVENIMENTE SPECIALE/sărbători/Ziua Copilăriei2.jpg', 'events', 'Ziua Copilăriei', 'Activități speciale de Ziua Copilăriei');
                        image('POZE CENTRU/EVENIMENTE SPECIALE/sărbători/Ziua Copilăriei 3.jpg', 'events', 'Ziua Copilăriei', 'Sărbătoare dedicată copiilor');
                        
                        // EVENIMENTE SPECIALE - Vizite ale partenerilor
                        image('POZE CENTRU/EVENIMENTE SPECIALE/vizite ale partenerilor/Asociația bisericilor creștine.jpg', 'events', 'Vizită parteneri', 'Vizita Asociației bisericilor creștine');
                        image('POZE CENTRU/EVENIMENTE SPECIALE/vizite ale partenerilor/Biblioteca Steliana Grama Soroca.jpg', 'events', 'Vizită bibliotecă', 'Colaborare cu Biblioteca Steliana Grama din Soroca');
                        image('POZE CENTRU/EVENIMENTE SPECIALE/vizite ale partenerilor/Biblioteca Steliana Grama Soroca2.jpg', 'events', 'Vizită bibliotecă', 'Activități culturale cu biblioteca locală');
                        image('POZE CENTRU/EVENIMENTE SPECIALE/vizite ale partenerilor/Școala de Arte E.Coca din or.Soroca.jpg', 'events', 'Vizită școala de arte', 'Colaborare cu Școala de Arte E.Coca din Soroca');
                        image('POZE CENTRU/EVENIMENTE SPECIALE/vizite ale partenerilor/Școala de Arte E.Coca din or.Soroca2.jpg', 'events', 'Vizită școala de arte', 'Activități artistice cu școala de arte');
                        image('POZE CENTRU/EVENIMENTE SPECIALE/vizite ale partenerilor/Școala de Arte E.Coca din or.Soroca3.jpg', 'events', 'Vizită școala de arte', 'Programme culturale și educative');
                        
                        image('1.jpg', 'spaces', '', '');
                        image('2.jpg', 'spaces', '', '');
                        image('3.jpg', 'spaces', '', '');
                        image('4.jpg', 'spaces', '', '');
                        image('5.jpg', 'spaces', '', '');
                        image('6.jpg', 'spaces', '', '');
                        image('7.jpg', 'spaces', '', '');
                        image('8.jpg', 'spaces', '', '');
                        image('9.jpg', 'spaces', '', '');
                        image('10.jpg', 'spaces', '', '');
                        image('11.jpg', 'spaces', '', '');
                        image('12.jpg', 'spaces', '', '');
                        image('13.jpg', 'spaces', '', '');
                        image('14.jpg', 'spaces', '', '');
                        image('15.jpg', 'spaces', '', '');
                        image('16.jpg', 'spaces', '', '');
                        image('17.jpg', 'spaces', '', '');
                        image('18.jpg', 'spaces', '', '');
                        image('19.jpg', 'spaces', '', '');
                        image('20.jpg', 'spaces', '', '');
                        image('21.jpg', 'spaces', '', '');
                        image('22.jpg', 'spaces', '', '');
                        image('23.jpg', 'spaces', '', '');

                        // YouTube videos
                        youtube('Pa1s3QZoLGM', 'videos', '', '');
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