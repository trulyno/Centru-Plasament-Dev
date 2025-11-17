<?php
session_start();
header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit;
}

$newsFile = __DIR__ . '/../data/news.json';
$uploadDir = __DIR__ . '/../data/uploads/';

// Create upload directory if it doesn't exist
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

// Load existing news
$news = [];
if (file_exists($newsFile)) {
    $newsContent = file_get_contents($newsFile);
    $news = json_decode($newsContent, true);
    if (!is_array($news)) {
        $news = [];
    }
}

// Handle different actions
$action = $_POST['action'] ?? '';

switch ($action) {
    case 'add':
    case 'edit':
        handleAddEdit($news, $newsFile, $uploadDir);
        break;
    
    case 'delete':
        handleDelete($news, $newsFile, $uploadDir);
        break;
    
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}

function handleAddEdit(&$news, $newsFile, $uploadDir) {
    $id = $_POST['id'] ?? uniqid('news_', true);
    $title = $_POST['title'] ?? '';
    $subtitle = $_POST['subtitle'] ?? '';
    $content = $_POST['content'] ?? '';
    $date = $_POST['date'] ?? date('Y-m-d');
    $action = $_POST['action'] ?? 'add';
    
    // Validate required fields
    if (empty($title) || empty($subtitle) || empty($content)) {
        echo json_encode(['success' => false, 'message' => 'All required fields must be filled']);
        return;
    }
    
    // Handle main image upload
    $imagePath = $_POST['existing_image'] ?? '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageResult = uploadFile($_FILES['image'], $uploadDir, 'image');
        if ($imageResult['success']) {
            // Delete old image if exists and editing
            if ($action === 'edit' && !empty($imagePath) && file_exists(__DIR__ . '/../' . $imagePath)) {
                unlink(__DIR__ . '/../' . $imagePath);
            }
            $imagePath = $imageResult['path'];
        } else {
            echo json_encode(['success' => false, 'message' => $imageResult['message']]);
            return;
        }
    }
    
    // Check if image is provided (required for new articles)
    if (empty($imagePath) && $action === 'add') {
        echo json_encode(['success' => false, 'message' => 'Main image is required']);
        return;
    }
    
    // Handle attachment images
    $attachmentImages = [];
    if (isset($_POST['existing_images']) && is_array($_POST['existing_images'])) {
        $attachmentImages = $_POST['existing_images'];
    }
    if (isset($_FILES['attachment_images'])) {
        foreach ($_FILES['attachment_images']['tmp_name'] as $key => $tmpName) {
            if ($_FILES['attachment_images']['error'][$key] === UPLOAD_ERR_OK) {
                $file = [
                    'name' => $_FILES['attachment_images']['name'][$key],
                    'type' => $_FILES['attachment_images']['type'][$key],
                    'tmp_name' => $tmpName,
                    'error' => $_FILES['attachment_images']['error'][$key],
                    'size' => $_FILES['attachment_images']['size'][$key]
                ];
                $result = uploadFile($file, $uploadDir, 'image');
                if ($result['success']) {
                    $attachmentImages[] = $result['path'];
                }
            }
        }
    }
    
    // Handle attachment videos
    $attachmentVideos = [];
    if (isset($_POST['existing_videos']) && is_array($_POST['existing_videos'])) {
        $attachmentVideos = $_POST['existing_videos'];
    }
    if (isset($_FILES['attachment_videos'])) {
        foreach ($_FILES['attachment_videos']['tmp_name'] as $key => $tmpName) {
            if ($_FILES['attachment_videos']['error'][$key] === UPLOAD_ERR_OK) {
                $file = [
                    'name' => $_FILES['attachment_videos']['name'][$key],
                    'type' => $_FILES['attachment_videos']['type'][$key],
                    'tmp_name' => $tmpName,
                    'error' => $_FILES['attachment_videos']['error'][$key],
                    'size' => $_FILES['attachment_videos']['size'][$key]
                ];
                $result = uploadFile($file, $uploadDir, 'video');
                if ($result['success']) {
                    $attachmentVideos[] = $result['path'];
                }
            }
        }
    }
    
    // Create/update article
    $article = [
        'id' => $id,
        'title' => $title,
        'subtitle' => $subtitle,
        'content' => $content,
        'image' => $imagePath,
        'date' => $date,
        'attachments' => [
            'images' => $attachmentImages,
            'videos' => $attachmentVideos
        ]
    ];
    
    // Update or add article
    if ($action === 'edit') {
        $found = false;
        foreach ($news as $key => $item) {
            if ($item['id'] === $id) {
                $news[$key] = $article;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $news[] = $article;
        }
    } else {
        $news[] = $article;
    }
    
    // Save to file
    if (file_put_contents($newsFile, json_encode($news, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
        echo json_encode(['success' => true, 'message' => 'News saved successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to save news']);
    }
}

function handleDelete(&$news, $newsFile, $uploadDir) {
    $id = $_POST['id'] ?? '';
    
    if (empty($id)) {
        echo json_encode(['success' => false, 'message' => 'Invalid ID']);
        return;
    }
    
    // Find and delete article
    $found = false;
    foreach ($news as $key => $article) {
        if ($article['id'] === $id) {
            // Delete main image
            if (!empty($article['image']) && file_exists(__DIR__ . '/../' . $article['image'])) {
                unlink(__DIR__ . '/../' . $article['image']);
            }
            
            // Delete attachment images
            if (!empty($article['attachments']['images'])) {
                foreach ($article['attachments']['images'] as $img) {
                    if (file_exists(__DIR__ . '/../' . $img)) {
                        unlink(__DIR__ . '/../' . $img);
                    }
                }
            }
            
            // Delete attachment videos
            if (!empty($article['attachments']['videos'])) {
                foreach ($article['attachments']['videos'] as $vid) {
                    if (file_exists(__DIR__ . '/../' . $vid)) {
                        unlink(__DIR__ . '/../' . $vid);
                    }
                }
            }
            
            unset($news[$key]);
            $found = true;
            break;
        }
    }
    
    if (!$found) {
        echo json_encode(['success' => false, 'message' => 'Article not found']);
        return;
    }
    
    // Re-index array
    $news = array_values($news);
    
    // Save to file
    if (file_put_contents($newsFile, json_encode($news, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE))) {
        echo json_encode(['success' => true, 'message' => 'News deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to delete news']);
    }
}

function uploadFile($file, $uploadDir, $type) {
    $maxSize = 50 * 1024 * 1024; // 50MB
    
    // Validate file size
    if ($file['size'] > $maxSize) {
        return ['success' => false, 'message' => 'File size exceeds 50MB'];
    }
    
    // Validate file type
    if ($type === 'image') {
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    } else {
        $allowedTypes = ['video/mp4', 'video/mpeg', 'video/quicktime', 'video/webm'];
        $allowedExtensions = ['mp4', 'mpeg', 'mov', 'webm'];
    }
    
    $fileType = $file['type'];
    $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if (!in_array($fileType, $allowedTypes) && !in_array($fileExtension, $allowedExtensions)) {
        return ['success' => false, 'message' => 'Invalid file type'];
    }
    
    // Generate unique filename
    $filename = uniqid() . '_' . time() . '.' . $fileExtension;
    $targetPath = $uploadDir . $filename;
    $relativePath = 'data/uploads/' . $filename;
    
    // Move uploaded file
    if (move_uploaded_file($file['tmp_name'], $targetPath)) {
        return ['success' => true, 'path' => $relativePath];
    } else {
        return ['success' => false, 'message' => 'Failed to upload file'];
    }
}
?>
