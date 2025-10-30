<?php
// Include language configuration
require_once __DIR__ . '/includes/lang.php';
require_once __DIR__ . '/includes/gdpr.php';
require_once __DIR__ . '/includes/analytics.php';

// Get article ID from URL
$articleId = isset($_GET['id']) ? $_GET['id'] : '';
$article = null;

// Load news from JSON file
$newsFile = __DIR__ . '/data/news.json';
if (file_exists($newsFile) && !empty($articleId)) {
    $newsContent = file_get_contents($newsFile);
    $news = json_decode($newsContent, true);
    if (is_array($news)) {
        foreach ($news as $item) {
            if ($item['id'] === $articleId) {
                $article = $item;
                break;
            }
        }
    }
}

// Redirect if article not found
if (!$article) {
    header('Location: noutati.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo htmlspecialchars($article['subtitle']); ?>">
    <meta name="keywords" content="<?php echo t('news_meta_keywords'); ?>">
    <meta name="author" content="<?php echo t('meta_author'); ?>">
    <meta property="og:title" content="<?php echo htmlspecialchars($article['title']); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($article['subtitle']); ?>">
    <meta property="og:image" content="<?php echo htmlspecialchars($article['image']); ?>">
    <meta property="og:type" content="article">
    
    <title><?php echo htmlspecialchars($article['title']); ?> - <?php echo t('site_title_short'); ?></title>
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
        <section class="article-header">
            <div class="container">
                <a href="noutati.php" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    <?php echo t('news_back_to_news'); ?>
                </a>
                <div class="article-meta">
                    <span class="article-date">
                        <i class="fas fa-calendar-alt"></i>
                        <?php echo t('news_published_on'); ?> <?php echo date('d.m.Y', strtotime($article['date'])); ?>
                    </span>
                </div>
                <h1><?php echo htmlspecialchars($article['title']); ?></h1>
                <p class="article-subtitle"><?php echo htmlspecialchars($article['subtitle']); ?></p>
            </div>
        </section>

        <section class="article-content-section">
            <div class="container">
                <div class="article-main-image">
                    <img src="<?php echo htmlspecialchars($article['image']); ?>" 
                         alt="<?php echo htmlspecialchars($article['title']); ?>" 
                         loading="lazy">
                </div>

                <div class="article-body">
                    <?php echo nl2br(htmlspecialchars($article['content'])); ?>
                </div>

                <?php if (!empty($article['attachments']['images']) || !empty($article['attachments']['videos'])): ?>
                    <div class="article-attachments">
                        <h2><?php echo t('news_attachments'); ?></h2>
                        
                        <?php if (!empty($article['attachments']['images'])): ?>
                            <div class="attachments-section">
                                <h3>
                                    <i class="fas fa-images"></i>
                                    <?php echo t('news_images'); ?>
                                </h3>
                                <div class="attachment-gallery">
                                    <?php foreach ($article['attachments']['images'] as $image): ?>
                                        <div class="attachment-item">
                                            <img src="<?php echo htmlspecialchars($image); ?>" 
                                                 alt="<?php echo t('news_attachments'); ?>" 
                                                 loading="lazy"
                                                 onclick="openImageModal(this.src)">
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (!empty($article['attachments']['videos'])): ?>
                            <div class="attachments-section">
                                <h3>
                                    <i class="fas fa-video"></i>
                                    <?php echo t('news_videos'); ?>
                                </h3>
                                <div class="attachment-videos">
                                    <?php foreach ($article['attachments']['videos'] as $video): ?>
                                        <div class="video-item">
                                            <video controls>
                                                <source src="<?php echo htmlspecialchars($video); ?>" type="video/mp4">
                                                Browser-ul tău nu suportă elementul video.
                                            </video>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <div class="article-footer">
                    <a href="noutati.php" class="btn-primary">
                        <i class="fas fa-arrow-left"></i>
                        <?php echo t('news_back_to_news'); ?>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Image Modal -->
    <div class="image-modal" id="imageModal" onclick="closeImageModal()">
        <span class="image-modal-close">&times;</span>
        <img class="image-modal-content" id="modalImg">
    </div>

    <?php include 'includes/footer.php'; ?>

    <script src="script.js"></script>
    <script src="gdpr-script.js"></script>
    <script>
        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImg');
            modal.style.display = 'flex';
            modalImg.src = src;
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }

        // Close modal on Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
</body>
</html>
