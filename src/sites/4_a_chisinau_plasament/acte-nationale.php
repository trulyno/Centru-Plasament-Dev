<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
require_once __DIR__ . '/includes/gdpr.php';
require_once __DIR__ . '/includes/analytics.php';

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
                           document("https://www.legis.md/cautare/getResults?doc_id=132934&lang=ro", "Legea nr. 547 din 25.12.2003 Asistența Socială");
                        ?>

                        <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=141516&lang=ro#", "Legea nr. 123 din 18.06.2010 Cu privire la serviciile sociale");
                        ?>

                         <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=146155&lang=ro#", "Legea nr. 60 din 30.03.2012 Privind incluziunea socială a persoanelor cu dizabilități");
                        ?>

                         <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=101381&lang=ro", "Hotărârea Guvernului nr. 591 din 24 iulie 2017: Aprobă Regulamentul-cadru privind organizarea și funcționarea Serviciilor sociale de tip centru de plasament și standardele minime de calitate.");
                        ?>

                        <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=113032&lang=ro", "Codul Muncii al Republicii Moldova: Aplicabil tuturor angajatorilor, inclusiv instituțiilor sociale de stat.");
                        ?>

                        <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=110180&lang=ro", "Legea N23 din 16.03.2007, cu privire la profilaxia infectiei HIV/SIDA.");
                        ?>

                        <?php
                           document("https://www.legis.md/cautare/getResults?doc_id=119465&lang=ro", "Legea N411 din 28.03.1995, cu privirea la ocrotirea sanatatii.");
                        ?>

                        <?php
                            document('files/Ordin nr. 1289.pdf', 'Ordinul Ministerului Sănătății nr. 1289 din 30.12.2016 privind aprobarea Standardelor minime de calitate a serviciilor sociale prestate în cadrul centrelor de plasament pentru persoane vârstnice și persoane cu dizabilități din gestiunea Agenției Naționale Asistență Socială');
                        ?>

                        <?php
                            document('files/Standarte minime de calitate.pdf', 'Standarde minime de calitate a serviciilor sociale prestate în cadrul centrelor de plasament pentru persoane vârstnice și persoane cu dizabilități din gestiunea Agenției Naționale Asistență Sociale');
                        ?>

                    </div>
                        </div>
                        

                </div>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>


    <script src="script.js"></script>
    <script src="gdpr-script.js"></script>
</body>
</html>