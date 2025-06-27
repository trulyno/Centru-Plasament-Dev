<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';

// FAQ Helper Function
function faqItem($question, $answer, $category = 'general') {
    echo '<div class="faq-item" data-category="' . $category . '">
            <div class="faq-question" role="button" tabindex="0" aria-expanded="false" aria-controls="faq-answer-' . md5($question) . '">
                <h3>' . $question . '</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" id="faq-answer-' . md5($question) . '" role="region" aria-hidden="true">
                <div class="faq-answer-content">
                    ' . $answer . '
                </div>
            </div>
          </div>';
}

function faqCategory($title, $icon = 'fas fa-question-circle') {
    echo '<div class="faq-category-header">
            <i class="' . $icon . '"></i>
            <h2>' . $title . '</h2>
          </div>';
}
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('faq_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('faq_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('faq_page_title'); ?></title>
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

    <!-- Header -->
    <header class="header">
        <!-- Top Header Section -->
        <div class="header-top" id="headerTop">
            <button class="header-expand-btn" id="headerExpandBtn" aria-label="<?php echo t('expand_header'); ?>" aria-expanded="false">
                <i class="fas fa-chevron-down"></i>
            </button>
            <div class="header-top-container" id="headerTopContainer">
                <div class="header-logo">
                    <img src="images/logo.png  " alt="<?php echo t('logo_alt'); ?>" class="logo-image">
                    <div class="logo-text">
                        <h1 class="logo-text-full"><?php echo t('site_title_full'); ?></h1>
                        <h1 class="logo-text-abbreviated"><?php echo t('site_title_short'); ?></h1>
                    </div>
                </div>
                
                <div class="header-contact">
                    <div class="contact-info-header">
                        <div class="contact-item-header">
                            <i class="fas fa-phone"></i>
                            <div>
                                <span><?php echo t('contact_phone'); ?></span>
                                <a href="tel:022737027">022 737 027</a>
                            </div>
                        </div>
                        <div class="contact-item-header">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <span><?php echo t('contact_email'); ?></span>
                                <a href="mailto:centru_plasament@agssi.md">centru_plasament@agssi.md</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="social-links">
                        <a href="#" class="social-link" aria-label="<?php echo t('social_facebook'); ?>">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="<?php echo t('social_instagram'); ?>">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="<?php echo t('social_linkedin'); ?>">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-link" aria-label="<?php echo t('social_youtube'); ?>">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                    
                    <div class="donate-section">
                        <button class="donate-btn" aria-label="<?php echo t('donate_aria'); ?>" title="<?php echo t('btn_donate'); ?>">
                            <i class="fas fa-heart"></i>
                            <span><?php echo t('btn_donate'); ?></span>
                        </button>
                        <button class="audio-btn" id="audioBtn" aria-label="<?php echo t('anthem_aria'); ?>" title="<?php echo t('anthem_title'); ?>">
                            <i class="fas fa-music"></i>
                            <span><?php echo t('btn_anthem'); ?></span>
                        </button>
                        <button class="lyrics-btn" id="lyricsBtn" aria-label="<?php echo t('lyrics_aria'); ?>" title="<?php echo t('lyrics_title'); ?>">
                            <i class="fas fa-align-left"></i>
                            <span><?php echo t('btn_lyrics'); ?></span>
                        </button>
                    </div>
                    
                    <!-- Language Selector -->
                    <?php echo getLanguageSelector('intrebari-frecvente.php'); ?>
                </div>
            </div>
        </div>
        
        <!-- Navigation Section -->
        <div class="nav-container">
            <div class="logo-mobile">
                <img src="images/logo.png  " alt="Logo CPRCVF" class="logo-mobile-image">
                <i class="fas fa-heart"></i>
                <span>CPRCVF</span>
            </div>
            <div class="mobile-action-buttons">
                <button class="donate-btn" aria-label="<?php echo t('donate_aria'); ?>" title="<?php echo t('btn_donate'); ?>">
                    <i class="fas fa-heart"></i>
                </button>
                <button class="audio-btn" id="audioBtn" aria-label="<?php echo t('anthem_aria'); ?>" title="<?php echo t('anthem_title'); ?>">
                    <i class="fas fa-music"></i>
                </button>
                <button class="lyrics-btn" id="lyricsBtn" aria-label="<?php echo t('lyrics_aria'); ?>" title="<?php echo t('lyrics_title'); ?>">
                    <i class="fas fa-align-left"></i>
                </button>
            </div>
            <nav>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="index.php"><?php echo t('nav_home'); ?></a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"><?php echo t('nav_services'); ?> <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="sectia-criza-reintegrare-familiala.php"><?php echo t('services_crisis'); ?></a></li>
                            <li><a href="sectia-maternala.php"><?php echo t('services_maternal'); ?></a></li>
                            <li><a href="sectia-zi-4luni-3ani.php"><?php echo t('services_day_4m_3y'); ?></a></li>
                            <li><a href="sectia-de-zi.php"><?php echo t('services_day'); ?></a></li>
                            <li><a href="sectia-respiro.php"><?php echo t('services_respiro'); ?></a></li>
                            <li><a href="sectia-asistenta-psihopedagogica.php"><?php echo t('services_psycho_pedagogical'); ?></a></li>
                            <li><a href="sectia-reabilitare.php"><?php echo t('services_rehabilitation'); ?></a></li>
                            <li><a href="sectia-asistenta-medicala.php"><?php echo t('services_medical'); ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"><?php echo t('nav_about'); ?> <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="administratia.php"><?php echo t('about_administration'); ?></a></li>
                            <li><a href="organigrama.php"><?php echo t('about_organigram'); ?></a></li>
                            
                            <li><a href="functii-vacante.php"><?php echo t('about_vacant_positions'); ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"><?php echo t('nav_transparency'); ?> <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-nested">
                                <a href="#" class="dropdown-toggle-nested"><?php echo t('transparency_legislation'); ?> <i class="fas fa-chevron-right"></i></a>
                                <ul class="dropdown-menu-nested">
                                    <li><a href="acte-nationale.php"><?php echo t('legislation_national'); ?></a></li>
                                    <li><a href="acte-internationale.php"><?php echo t('legislation_international'); ?></a></li>
                                    <li><a href="acte-interne.php"><?php echo t('legislation_internal'); ?></a></li>
                                    <li><a href="codul-deontologic.php"><?php echo t('legislation_ethics_code'); ?></a></li>
                                    <li><a href="metodologii.php"><?php echo t('legislation_methodologies'); ?></a></li>
                                </ul>
                            </li>
                            <li class="dropdown-nested">
                                <a href="#" class="dropdown-toggle-nested"><?php echo t('transparency_procurement'); ?> <i class="fas fa-chevron-right"></i></a>
                                <ul class="dropdown-menu-nested">
                                    <li><a href="invitatii-participare.php"><?php echo t('procurement_invitations'); ?></a></li>
                                    <li><a href="planuri-achizitii.php"><?php echo t('procurement_plans'); ?></a></li>
                                    <li><a href="rapoarte-achizitii.php"><?php echo t('procurement_reports'); ?></a></li>
                                </ul>
                            </li>
                            <li><a href="proiecte.php"><?php echo t('transparency_projects'); ?></a></li>
                            <li><a href="rapoarte.php"><?php echo t('transparency_reports'); ?></a></li>
                            <li><a href="registru-cadouri.php"><?php echo t('transparency_gifts_register'); ?></a></li>
                            <li><a href="petitii-reclamatii.php"><?php echo t('transparency_petitions'); ?></a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle"><?php echo t('nav_info_support'); ?> <i class="fas fa-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="ghiduri.php"><?php echo t('info_guides'); ?></a></li>
                            <li><a href="intrebari-frecvente.php"><?php echo t('info_faq'); ?></a></li>
                        </ul>
                    </li>
                    <li><a href="galerie.php"><?php echo t('nav_gallery'); ?></a></li>
                    <li><a href="index.php#contact"><?php echo t('nav_contact'); ?></a></li>
                    <li><a href="index.php#partners"><?php echo t('nav_partners'); ?></a></li>
                </ul>
                <button class="mobile-menu-btn" id="mobileMenuBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content" id="main-content">
        <section class="page-header">
            <div class="container">
                <h1><?php echo t('faq_header_title'); ?></h1>
                <p><?php echo t('faq_header_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <div class="content-wrapper">
                    <!-- FAQ Search -->
                    <div class="faq-search-section">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="faqSearch" placeholder="<?php echo t('faq_search_placeholder'); ?>" aria-label="<?php echo t('faq_search_aria'); ?>">
                        </div>
                    </div>

                    <!-- FAQ Categories Filter -->
                    <div class="faq-filters">
                        <button class="filter-btn active" data-category="all"><?php echo t('faq_all_categories'); ?></button>
                        <button class="filter-btn" data-category="general"><?php echo t('faq_category_general'); ?></button>
                        <button class="filter-btn" data-category="services"><?php echo t('faq_category_services'); ?></button>
                        <button class="filter-btn" data-category="admission"><?php echo t('faq_category_admission'); ?></button>
                        <button class="filter-btn" data-category="support"><?php echo t('faq_category_support'); ?></button>
                    </div>

                    <!-- FAQ Content -->
                    <div class="faq-container">
                        
                        <!-- General Questions -->
                        <?php faqCategory(t('faq_category_general'), 'fas fa-info-circle'); ?>
                        
                        <!-- <?php faqItem(
                            t('faq_what_is_cprcvf_q'),
                            t('faq_what_is_cprcvf_a'),
                            'general'
                        ); ?> -->

                        <!-- Services Questions -->
                        <?php faqCategory(t('faq_category_services'), 'fas fa-hands-helping'); ?>

                        <!-- <?php faqItem(
                            t('faq_what_services_q'),
                            t('faq_what_services_a'),
                            'services'
                        ); ?> -->

                        <!-- Admission Questions -->
                        <?php faqCategory(t('faq_category_admission'), 'fas fa-user-plus'); ?>

                        <!-- <?php faqItem(
                            t('faq_how_to_apply_q'),
                            t('faq_how_to_apply_a'),
                            'admission'
                        ); ?> -->

                        <!-- Support Questions -->
                        <?php faqCategory(t('faq_category_support'), 'fas fa-life-ring'); ?>

                        <!-- <?php faqItem(
                            t('faq_emergency_contact_q'),
                            t('faq_emergency_contact_a'),
                            'support'
                        ); ?> -->

                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Audio Element -->
    <audio id="audioElement" preload="metadata">
        <source src="audio/18_Alexandru_Lozanciuc_-_Sa_daruim_copiilor_pamantul.mp3" type="audio/mpeg">
        <?php echo t('audio_not_supported'); ?>
    </audio>

    <!-- Lyrics Modal -->
    <div class="lyrics-modal" id="lyricsModal">
        <div class="lyrics-modal-content">
            <div class="lyrics-header">
                <h3><?php echo t('lyrics_modal_title'); ?></h3>
                <button class="lyrics-close-btn" id="lyricsCloseBtn" aria-label="<?php echo t('lyrics_close'); ?>">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="lyrics-body">
                <h4>Alexandru Lozanciuc - Să dăruim copiilor pământul</h4>
                <div class="lyrics-text">
                    <p>Nimic mai sfânt ca soarele<br>
                    Ce luminează viața noastră pe pământ<br>
                    Nimic mai sfânt pe acest pământ<br>
                    Ca mamele cu prunci prin soare alergând</p>
                    
                    <p>Cât de uimit ne dăruiesc<br>
                    Copiii noștri ce alăturea ne cresc<br>
                    Nimic mai drag pe acest meleag<br>
                    Decât copilul așteptându-te-n prag</p>
                    
                    <p>Hai oameni, hai să dăruim copiilor<br>
                    Pământul nostru neîmpărțit, neîmpărțit<br>
                    Hai oameni, hai să dăruim copiilor<br>
                    Pământul nostru înflorit, nepustiit</p>
                    
                    <p>Să fie toate acestea și în viitor<br>
                    Să aibă fiii noștri în case prunci lor<br>
                    Să nu lăsăm pământul să ne ardă în foc<br>
                    Să crească copilașii noștri cu noroc</p>

                    <p>Nimic mai sfânt ca pacea-n noi<br>
                    În timp de pace sunt și viața omului<br>
                    Nimic mai scump, mai omenesc<br>
                    Ca pacea pe care oamenii râvnesc</p>
                    
                    <p>Cât de uimiți și semne noi<br>
                    Când mire și mireasă trec pe lângă noi<br>
                    Câte minuni, băi oameni buni<br>
                    În orice seară pot copiii să-ți adun</p>
                    
                    <p>Hai oameni, hai să dăruim copiilor<br>
                    Pământul nostru neîmpărțit, neîmpărțit<br>
                    Hai oameni, hai să dăruim copiilor<br>
                    Pământul nostru înflorit, nepustiit</p>
                    
                    <p>Să fie toate acestea și în viitor<br>
                    Să aibă fiii noștri în case prunci lor<br>
                    Să nu lăsăm pământul să ne ardă în foc<br>
                    Să crească copilașii noștri cu noroc</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p><?php echo t('footer_copyright'); ?></p>
        </div>
    </footer>

    <script src="script.js"></script>
    <script>
        // FAQ Functionality
        document.addEventListener('DOMContentLoaded', function() {
            // FAQ Search functionality
            const searchInput = document.getElementById('faqSearch');
            const faqItems = document.querySelectorAll('.faq-item');
            
            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase();
                    
                    faqItems.forEach(item => {
                        const question = item.querySelector('.faq-question h3').textContent.toLowerCase();
                        const answer = item.querySelector('.faq-answer-content').textContent.toLowerCase();
                        
                        if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            }
            
            // Category filter functionality
            const filterButtons = document.querySelectorAll('.filter-btn');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    
                    // Update active filter button
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    
                    // Filter FAQ items
                    faqItems.forEach(item => {
                        const itemCategory = item.getAttribute('data-category');
                        
                        if (category === 'all' || itemCategory === category) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                    
                    // Clear search when filtering
                    if (searchInput) {
                        searchInput.value = '';
                    }
                });
            });
            
            // FAQ accordion functionality
            const faqQuestions = document.querySelectorAll('.faq-question');
            
            faqQuestions.forEach(question => {
                question.addEventListener('click', function() {
                    const faqItem = this.parentElement;
                    const answer = faqItem.querySelector('.faq-answer');
                    const isExpanded = this.getAttribute('aria-expanded') === 'true';
                    
                    // Close all other FAQ items
                    faqQuestions.forEach(otherQuestion => {
                        if (otherQuestion !== this) {
                            const otherItem = otherQuestion.parentElement;
                            const otherAnswer = otherItem.querySelector('.faq-answer');
                            
                            otherQuestion.setAttribute('aria-expanded', 'false');
                            otherAnswer.setAttribute('aria-hidden', 'true');
                            otherItem.classList.remove('active');
                        }
                    });
                    
                    // Toggle current FAQ item
                    if (!isExpanded) {
                        this.setAttribute('aria-expanded', 'true');
                        answer.setAttribute('aria-hidden', 'false');
                        faqItem.classList.add('active');
                    } else {
                        this.setAttribute('aria-expanded', 'false');
                        answer.setAttribute('aria-hidden', 'true');
                        faqItem.classList.remove('active');
                    }
                });
                
                // Handle keyboard navigation
                question.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.click();
                    }
                });
            });
        });
    </script>
    <style>
        /* FAQ Specific Styles */
        .faq-search-section {
            margin-bottom: 2rem;
        }
        
        .search-box {
            position: relative;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #666;
        }
        
        .search-box input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e1e5e9;
            border-radius: 25px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        
        .search-box input:focus {
            outline: none;
            border-color: #007bff;
        }
        
        .faq-filters {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 2rem;
        }
        
        .filter-btn {
            padding: 0.5rem 1rem;
            border: 2px solid #e1e5e9;
            background: white;
            color: #333;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.9rem;
        }
        
        .filter-btn:hover,
        .filter-btn.active {
            background: #007bff;
            color: white;
            border-color: #007bff;
        }
        
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .faq-category-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin: 2rem 0 1rem 0;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #007bff;
        }
        
        .faq-category-header i {
            color: #007bff;
            font-size: 1.2rem;
        }
        
        .faq-category-header h2 {
            margin: 0;
            color: #333;
            font-size: 1.5rem;
        }
        
        .faq-item {
            margin-bottom: 1rem;
            border: 1px solid #e1e5e9;
            border-radius: 8px;
            overflow: hidden;
            transition: box-shadow 0.3s ease;
        }
        
        .faq-item:hover {
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1.25rem;
            background: #f8f9fa;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .faq-question:hover {
            background: #e9ecef;
        }
        
        .faq-question h3 {
            margin: 0;
            font-size: 1.1rem;
            color: #333;
            flex-grow: 1;
        }
        
        .faq-question i {
            color: #007bff;
            transition: transform 0.3s ease;
        }
        
        .faq-item.active .faq-question i {
            transform: rotate(180deg);
        }
        
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .faq-item.active .faq-answer {
            max-height: 500px;
        }
        
        .faq-answer-content {
            padding: 1.25rem;
            background: white;
            color: #666;
            line-height: 1.6;
        }
        
        .faq-contact-section {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid #e1e5e9;
        }
        
        .contact-card {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
        }
        
        .contact-card h3 {
            margin: 0 0 1rem 0;
            font-size: 1.5rem;
        }
        
        .contact-card p {
            margin: 0 0 1.5rem 0;
            opacity: 0.9;
        }
        
        .contact-buttons {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .contact-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: rgba(255,255,255,0.2);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }
        
        .contact-btn:hover {
            background: rgba(255,255,255,0.3);
            transform: translateY(-2px);
        }
        
        @media (max-width: 768px) {
            .faq-filters {
                justify-content: flex-start;
                overflow-x: auto;
                padding-bottom: 0.5rem;
            }
            
            .contact-buttons {
                flex-direction: column;
            }
            
            .contact-btn {
                justify-content: center;
            }
        }
    </style>
</body>
</html>