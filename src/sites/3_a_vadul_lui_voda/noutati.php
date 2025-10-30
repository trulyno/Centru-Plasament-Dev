<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
require_once __DIR__ . '/includes/gdpr.php';
require_once __DIR__ . '/includes/analytics.php';

// Load news from JSON file
$newsFile = __DIR__ . '/data/news.json';
$news = [];
if (file_exists($newsFile)) {
    $newsContent = file_get_contents($newsFile);
    $news = json_decode($newsContent, true);
    if (!is_array($news)) {
        $news = [];
    }
    // Sort by date (newest first)
    usort($news, function($a, $b) {
        return strtotime($b['date']) - strtotime($a['date']);
    });
}

// Pagination
$itemsPerPage = 9;
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$totalItems = count($news);
$totalPages = ceil($totalItems / $itemsPerPage);
$offset = ($currentPage - 1) * $itemsPerPage;
$newsPage = array_slice($news, $offset, $itemsPerPage);
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo t('news_meta_description'); ?>">
    <meta name="keywords" content="<?php echo t('news_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    
    <title><?php echo t('news_page_title'); ?></title>
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
                <h1><?php echo t('news_section_title'); ?></h1>
                <p><?php echo t('news_section_subtitle'); ?></p>
            </div>
        </section>

        <section class="content-section">
            <div class="container">
                <?php if (count($newsPage) > 0): ?>
                    <div class="news-grid-page">
                        <?php foreach ($newsPage as $article): 
                            $newsId = htmlspecialchars($article['id']);
                            $newsTitle = htmlspecialchars($article['title']);
                            $newsSubtitle = htmlspecialchars($article['subtitle']);
                            $newsImage = htmlspecialchars($article['image']);
                            $newsDate = date('d.m.Y', strtotime($article['date']));
                        ?>
                            <a href="articol.php?id=<?php echo $newsId; ?>" class="news-card fade-in">
                                <div class="news-image">
                                    <img src="<?php echo $newsImage; ?>" alt="<?php echo $newsTitle; ?>" loading="lazy">
                                    <div class="news-date">
                                        <i class="fas fa-calendar-alt"></i>
                                        <?php echo $newsDate; ?>
                                    </div>
                                </div>
                                <div class="news-content">
                                    <h3><?php echo $newsTitle; ?></h3>
                                    <p><?php echo $newsSubtitle; ?></p>
                                    <span class="news-read-more">
                                        <?php echo t('news_read_more'); ?>
                                        <i class="fas fa-arrow-right"></i>
                                    </span>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($totalPages > 1): ?>
                        <div class="pagination">
                            <?php if ($currentPage > 1): ?>
                                <a href="?page=<?php echo $currentPage - 1; ?>" class="pagination-btn">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            <?php endif; ?>

                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="?page=<?php echo $i; ?>" 
                                   class="pagination-btn <?php echo $i === $currentPage ? 'active' : ''; ?>">
                                    <?php echo $i; ?>
                                </a>
                            <?php endfor; ?>

                            <?php if ($currentPage < $totalPages): ?>
                                <a href="?page=<?php echo $currentPage + 1; ?>" class="pagination-btn">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php else: ?>
                    <div class="no-content">
                        <i class="fas fa-newspaper"></i>
                        <p><?php echo t('news_no_news'); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?>

    <script src="script.js"></script>
    <script src="gdpr-script.js"></script>
</body>
</html>
