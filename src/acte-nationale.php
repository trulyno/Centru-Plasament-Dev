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
    <meta name="description" content="<?php echo t('national_acts_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('national_acts_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('national_acts_page_title'); ?></title>
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
                <h1><?php echo t('national_acts_title'); ?></h1>
                <p><?php echo t('national_acts_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <h2><?php echo t('national_acts_content_title'); ?></h2>
                    <p><?php echo t('national_acts_content_description'); ?></p>
                    
                    <div class="documents-grid">

                        <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=112685&lang=ro", "Codul Familiei al Republicii Moldova");
                        ?>

                        
                        <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=132934&lang=ro", "Legea nr. 547 din 25.12.2003 Asistența Socială");
                        ?>

                         <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=146836&lang=ro#", "Legea nr. 140 din 14.06.2011 Privind protecția specială a copiilor aflați în situație de risc și a copiilor separați de părinți");
                        ?>

                        <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=141516&lang=ro#", "Legea nr. 123 din 18.06.2010 Cu privire la serviciile sociale");
                        ?>

                        <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=138813&lang=ro#", "Legea nr. 99 din 28.05.2010 Privind regimul juridic al adopției");
                        ?>

                         <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=140852&lang=ro#", "Legea nr. 338 din 15.12.1994 Privind drepturile copilului");
                        ?>

                         <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=146155&lang=ro#", "Legea nr. 60 din 30.03.2012 Privind incluziunea socială a persoanelor cu dizabilități");
                        ?>

                        <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=103705&lang=ro#", "Hotărârea de Guvern nr. 450 din 28.04.2006 Pentru aprobarea Standartelor minime de calitate privind îngrijirea, educarea și socializarea copilului din Centrul de plasament temporar");
                        ?>

                         <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=101381&lang=ro", "Hotărârea Guvernului nr. 591 din 24 iulie 2017: Aprobă Regulamentul-cadru privind organizarea și funcționarea Serviciilor sociale de tip centru de plasament și standardele minime de calitate.");
                        ?>

                         <?php
                           document("https://social.gov.md/wp-content/uploads/2024/05/Ordin-nr.-114_24.05.2024_Politica-interna-de-protectie.pdf", "Ordinul nr. 114 din 24 mai 2024: Aprobă Ghidul privind Politica internă de protecție a copilului.");
                        ?>

                        <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=113032&lang=ro", "Codul Muncii al Republicii Moldova: Aplicabil tuturor angajatorilor, inclusiv instituțiilor sociale de stat.");
                        ?>

                        <?php
                           document("https://old.msmps.gov.md/sites/default/files/legislatie/ordin_nr._964_din_020919.pdf", "Ordinul N964 din 02.09.19, cu privire la standardul de supraveghere si dezvoltarii copilului in conditii de ambulator si a Carnetului de dezvoltare a copilului");
                        ?>

                        <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=110180&lang=ro", "Legea N23 din 16.03.2007, cu privire la profilaxia infectiei HIV/SIDA.");
                        ?>
                        <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=119465&lang=ro", "Legea N411 din 28.03.1995, cu privirea la ocrotirea sanatatii.");
                        ?>

                    </div>
                        </div>
                        

                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="script.js"></script>
</body>
</html>