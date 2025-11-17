<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
require_once __DIR__ . '/includes/gdpr.php';
require_once __DIR__ . '/includes/analytics.php';

// Load FAQs from database
$faqsFile = __DIR__ . '/data/faqs.json';
$faqs = [];
if (file_exists($faqsFile)) {
    $faqs = json_decode(file_get_contents($faqsFile), true) ?: [];
}

// Example of adding FAQs programmatically (for development/testing)
// Uncomment the lines below to add sample FAQs

$sampleFaqs = [
    [
        'id' => 'sample1',
        'question' => ['ro' => 'Ce servicii oferiti?', 'en' => 'What services do you offer?'],
        'answer' => ['ro' => 'Oferim diverse servicii sociale incluzând sprijin pentru familii și copii.', 'en' => 'We offer various social services including support for families and children.'],
        'category' => 'services',
        'status' => 'active'
    ],
    [
        'id' => 'sample2',
        'question' => ['ro' => 'Cum vă pot contacta?', 'en' => 'How can I contact you?'],
        'answer' => ['ro' => 'Ne puteți contacta prin telefon, email sau vizitând biroul nostru în timpul programului de lucru.', 'en' => 'You can reach us via phone, email, or visit our office during business hours.'],
        'category' => 'general',
        'status' => 'active'
    ],
    [
        'id' => 'sample3',
        'question' => ['ro' => 'Care sunt cerințele de admitere?', 'en' => 'What are the admission requirements?'],
        'answer' => ['ro' => 'Cerințele variază în funcție de serviciu. Vă rugăm să ne contactați pentru informații specifice.', 'en' => 'Requirements vary by service. Please contact us for specific information.'],
        'category' => 'admission',
        'status' => 'active'
    ],
    [
        'id' => 'sample4',
        'question' => ['ro' => 'Oferiti suport de urgență?', 'en' => 'Do you provide emergency support?'],
        'answer' => ['ro' => 'Da, oferim suport de urgență 24/7 pentru situații urgente.', 'en' => 'Yes, we provide 24/7 emergency support for urgent situations.'],
        'category' => 'support',
        'status' => 'active'
    ]
];

// Add sample FAQs to the existing array
$faqs = array_merge($faqs, $sampleFaqs);

// Optionally save to file
// saveFaqsToFile($faqs, $faqsFile);


// FAQ Helper Functions
function addFaq($question, $answer, $category = 'general', $id = null) {
    $faqId = $id ?: md5($question);
    
    // Handle both string and array inputs for multilingual support
    $questionData = is_array($question) ? $question : ['ro' => $question, 'en' => $question];
    $answerData = is_array($answer) ? $answer : ['ro' => $answer, 'en' => $answer];
    
    return [
        'id' => $faqId,
        'question' => $questionData,
        'answer' => $answerData,
        'category' => $category,
        'status' => 'active'
    ];
}

function saveFaqsToFile($faqs, $filePath) {
    $dir = dirname($filePath);
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    return file_put_contents($filePath, json_encode($faqs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

function renderFaqItem($question, $answer, $category = 'general', $id = null) {
    $faqId = $id ?: md5($question);
    return '<div class="faq-item" data-id="' . $faqId . '">
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

function renderFaqSection($faqs) {
    $currentLang = getCurrentLanguage();
    $output = '';
    
    // Add all active FAQs without categorization
    foreach ($faqs as $faq) {
        if ($faq['status'] === 'active') {
            $question = $faq['question'][$currentLang] ?? $faq['question']['ro'] ?? '';
            $answer = $faq['answer'][$currentLang] ?? $faq['answer']['ro'] ?? '';
            
            if (!empty($question) && !empty($answer)) {
                $output .= renderFaqItem($question, $answer, 'general', $faq['id']);
            }
        }
    }
    
    // Show fallback content if no FAQs exist
    if (empty($output)) {
        $output = '<div class="faq-item no-items">
                    <div class="faq-question-placeholder">
                        <p style="color: #666; font-style: italic; padding: 1rem;">
                            ' . t('content_coming_soon') . '
                        </p>
                    </div>
                  </div>';
    }
    
    return $output;
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

                    <!-- FAQ Content -->
                    <div class="faq-container">
                        <?php
                        // Render all FAQs without categorization
                        echo renderFaqSection($faqs);
                        ?>
                    </div>
                </div>
            </div>
        </section>
    </main>

        <?php include 'includes/footer.php'; ?>


    <script src="script.js"></script>
    <script src="gdpr-script.js"></script>
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
        
        .faq-container {
            max-width: 800px;
            margin: 0 auto;
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