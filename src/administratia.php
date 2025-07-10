<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';

function staff($name, $position, $image) {
    echo '<div class="admin-staff-card">
                <div class="admin-staff-image">
                    <img src="images/' . $image . '" alt="' . $position . '" loading="lazy" decoding="async">
                </div>
                    <div class="admin-staff-info">
                        <h3>' . $name . '</h3>
                        <p class="admin-staff-position">' . $position . '</p>
                    </div>
                </div>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('administration_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('administration_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('administration_page_title'); ?></title>
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
                <h1><?php echo t('about_administration'); ?></h1>
                <p><?php echo t('administration_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <h2><?php echo t('administration_team_title'); ?></h2>
                    <p><?php echo t('administration_team_description'); ?></p>
                    
                    <div class="admin-team-container">
                        <div class="admin-team-grid">
                            <?php
                                staff('Sergiu Oceretnîi', 'Director', 'director.png');
                                staff('Bacalu Ana', 'Șef Resurse Umane', 'Bacalu Ana inspector resurse umane.png');
                                staff('Țvetov Angela', 'Contabil șef', 'Țvetov Angela contabil șef.png');
                                staff('Mahmadbecov Rodica', 'Contabil', 'Mahmadbecov Rodica contabil.png');
                                staff('Cojușco Tatiana', 'Contabil', 'Cojușco Tatiana contabil.png');
                                staff('Bîrta Vladimir', 'Jurist', 'Bîrta Vladimir Jurist.png');
                                staff('Țurcanu Vasile', 'Inginer Principal', 'Țurcanu Vasile Inginer principal.png');
                                staff('Cojocaru Tatiana', 'Asistent Social', 'Cojocaru Tatiana Asistent Social.png');
                                staff('Toțkaia Angela', 'Psiholog', 'Toțkaia Angela Psiholog.png');
                                staff('Ciorici Cătălina', 'Șef Secție Maternală', 'Ciorici Cătălina Șefă secție Maternală.png');
                                staff('Blaj Sorina', 'Șef Secție Psihopedagogie', 'Blaj Sorina Sef sectie Psihopedagogie.png');
                                staff('Burunciuc Aurelia', 'Medic Nutriționist', 'Burunciuc Aurelia -Medic nutriționist.png');
                                staff('Vozian Corina', 'Șef Secție Zi', 'Corina Vozian sef sectie zi.png');
                                staff('David Ecaterina', 'Șef Secție Respiro', 'Ecaterina David Sef sectie Respiro.png');
                                staff('Timigraz Violeta', 'Șef Secție Reabilitare', 'Timirgaz Violeta -Sef sectie reabilitare.png');
                                staff('Ionița Natalia', 'Secretar', 'Ionita Natalia Secretar.png');
                                staff('Capros Marina', 'Șef Secție Criză', 'Capros Marina Sef sectie de Criza.png');
                                staff('Lungu Ina', 'Asisten Principal', 'Lungu Ina Asis. principal.png');
                                staff('Manoli Galina', 'Contabil', 'Manoli Galina Contabil.png');
                                staff('Agapi Livia', 'Medic Reabilitolog', 'Agapi Livia Medic Reabilitolog.png');
                                staff('Golovcenco Carolina', 'Medic Neuropediatru', 'Golovcenco Carolina- Medic Neouropediatru.png');

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