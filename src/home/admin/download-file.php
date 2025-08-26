<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403);
    die('Access denied');
}

// Validate file parameter
if (!isset($_GET['file']) || empty($_GET['file'])) {
    http_response_code(400);
    die('No file specified');
}

$filename = $_GET['file'];

// Security: Only allow downloading files that are listed in petitions.json
$dataDir = __DIR__ . '/../data/';
$petitionsFile = $dataDir . 'petitions.json';
$uploadDir = $dataDir . 'uploads/';

if (!file_exists($petitionsFile)) {
    http_response_code(404);
    die('Petitions data not found');
}

$petitions = json_decode(file_get_contents($petitionsFile), true) ?: [];

// Check if the requested file exists in any petition
$fileExists = false;
foreach ($petitions as $petition) {
    if (isset($petition['files']) && is_array($petition['files'])) {
        foreach ($petition['files'] as $file) {
            if ($file === $filename) {
                $fileExists = true;
                break 2;
            }
        }
    }
}

if (!$fileExists) {
    http_response_code(403);
    die('File not authorized for download');
}

$filePath = $uploadDir . $filename;

// Check if file physically exists
if (!file_exists($filePath)) {
    http_response_code(404);
    die('File not found');
}

// Security: Prevent directory traversal
$realFilePath = realpath($filePath);
$realUploadDir = realpath($uploadDir);

if (!$realFilePath || strpos($realFilePath, $realUploadDir) !== 0) {
    http_response_code(403);
    die('Invalid file path');
}

// Get file info
$fileSize = filesize($filePath);
$fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

// Set appropriate content type
$contentTypes = [
    'pdf' => 'application/pdf',
    'doc' => 'application/msword',
    'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'txt' => 'text/plain',
    'jpg' => 'image/jpeg',
    'jpeg' => 'image/jpeg',
    'png' => 'image/png',
    'gif' => 'image/gif'
];

$contentType = $contentTypes[$fileExtension] ?? 'application/octet-stream';

// Set headers for download
header('Content-Type: ' . $contentType);
header('Content-Length: ' . $fileSize);
header('Content-Disposition: attachment; filename="' . basename($filename) . '"');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');

// Output file
readfile($filePath);
exit;
?>
