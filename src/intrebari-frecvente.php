<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';

// Load FAQs from database
$faqsFile = __DIR__ . '/data/faqs.json';
$faqs = [];
if (file_exists($faqsFile)) {
    $faqs = json_decode(file_get_contents($faqsFile), true) ?: [];
}

// FAQ Helper Function
function faqItem($question, $answer, $category = 'general', $id = null) {
    $faqId = $id ?: md5($question);
    echo '<div class="faq-item" data-category="' . $category . '" data-id="' . $faqId . '">
            <div class="faq-question" role="button" tabindex="0" aria-expanded="false" aria-controls="faq-answer-' . $faqId . '">
                <h3>' . htmlspecialchars($question) . '</h3>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="faq-answer" id="faq-answer-' . $faqId . '" role="region" aria-hidden="true">
                <div class="faq-answer-content">
                    ' . nl2br(htmlspecialchars($answer)) . '
                </div>
            </div>
          </div>';
}

function faqCategory($title, $icon = 'fas fa-question-circle') {
    echo '<div class="faq-category-header">
            <i class="' . $icon . '"></i>
            <h2>' . htmlspecialchars($title) . '</h2>
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

    <?php include 'includes/header.php'; ?>

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
                        <?php
                        $currentLang = getCurrentLanguage();
                        $categories = [
                            'general' => ['title' => t('faq_category_general'), 'icon' => 'fas fa-info-circle'],
                            'services' => ['title' => t('faq_category_services'), 'icon' => 'fas fa-hands-helping'],
                            'admission' => ['title' => t('faq_category_admission'), 'icon' => 'fas fa-user-plus'],
                            'support' => ['title' => t('faq_category_support'), 'icon' => 'fas fa-life-ring']
                        ];

                        // Display FAQs by category
                        foreach ($categories as $categoryKey => $categoryData) {
                            // Show category header
                            faqCategory($categoryData['title'], $categoryData['icon']);
                            
                            $hasItems = false;
                            // Show FAQs for this category
                            foreach ($faqs as $faq) {
                                if ($faq['category'] === $categoryKey && $faq['status'] === 'active') {
                                    $question = $faq['question'][$currentLang] ?? $faq['question']['ro'] ?? '';
                                    $answer = $faq['answer'][$currentLang] ?? $faq['answer']['ro'] ?? '';
                                    
                                    if (!empty($question) && !empty($answer)) {
                                        faqItem($question, $answer, $categoryKey, $faq['id']);
                                        $hasItems = true;
                                    }
                                }
                            }
                            
                            // Show fallback content if no FAQs exist
                            if (!$hasItems) {
                                echo '<div class="faq-item no-items" data-category="' . $categoryKey . '">
                                        <div class="faq-question-placeholder">
                                            <p style="color: #666; font-style: italic; padding: 1rem;">
                                                ' . t('content_coming_soon') . '
                                            </p>
                                        </div>
                                      </div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

        <?php include 'includes/footer.php'; ?>

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