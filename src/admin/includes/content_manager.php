<?php
class ContentManager {
    private $configFile;
    private $data;
    
    public function __construct() {
        $this->configFile = CONFIG_FILE;
        $this->loadData();
    }
    
    private function loadData() {
        $this->data = [];
        
        if (!file_exists($this->configFile)) {
            return;
        }
        
        $lines = file($this->configFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line) || strpos($line, '=') === false) {
                continue;
            }
            
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);
            
            // Split by pipe separator
            $this->data[$key] = explode('|', $value);
            
            // Trim each value
            $this->data[$key] = array_map('trim', $this->data[$key]);
        }
    }
    
    public function getData($key = null) {
        if ($key === null) {
            return $this->data;
        }
        
        return $this->data[$key] ?? [];
    }
    
    public function updateData($key, $values) {
        if (!is_array($values)) {
            $values = [$values];
        }
        
        $this->data[$key] = $values;
        return $this->saveData();
    }
    
    public function addItem($key, $value) {
        if (!isset($this->data[$key])) {
            $this->data[$key] = [];
        }
        
        $this->data[$key][] = $value;
        return $this->saveData();
    }
    
    public function removeItem($key, $index) {
        if (!isset($this->data[$key]) || !isset($this->data[$key][$index])) {
            return false;
        }
        
        unset($this->data[$key][$index]);
        $this->data[$key] = array_values($this->data[$key]); // Re-index array
        return $this->saveData();
    }
    
    public function updateItem($key, $index, $value) {
        if (!isset($this->data[$key]) || !isset($this->data[$key][$index])) {
            return false;
        }
        
        $this->data[$key][$index] = $value;
        return $this->saveData();
    }
    
    private function saveData() {
        // Create backup before saving
        $this->createBackup();
        
        $content = '';
        foreach ($this->data as $key => $values) {
            $content .= $key . '=' . implode('|', $values) . "\n";
        }
        
        $result = file_put_contents($this->configFile, $content);
        
        if ($result !== false) {
            $this->logActivity("Configuration updated", 'fa-save');
            return true;
        }
        
        return false;
    }
    
    public function createBackup() {
        if (!file_exists($this->configFile)) {
            return false;
        }
        
        $backupFile = BACKUP_DIR . 'config_' . date('Y-m-d_H-i-s') . '.txt';
        $result = copy($this->configFile, $backupFile);
        
        if ($result) {
            $this->logActivity("Backup created: " . basename($backupFile), 'fa-database');
        }
        
        return $result;
    }
    
    public function getBackups() {
        $backups = [];
        
        if (!is_dir(BACKUP_DIR)) {
            return $backups;
        }
        
        $files = glob(BACKUP_DIR . 'config_*.txt');
        
        foreach ($files as $file) {
            $backups[] = [
                'filename' => basename($file),
                'path' => $file,
                'size' => filesize($file),
                'date' => filemtime($file)
            ];
        }
        
        // Sort by date, newest first
        usort($backups, function($a, $b) {
            return $b['date'] - $a['date'];
        });
        
        return $backups;
    }
    
    public function restoreBackup($filename) {
        $backupFile = BACKUP_DIR . $filename;
        
        if (!file_exists($backupFile)) {
            return false;
        }
        
        $result = copy($backupFile, $this->configFile);
        
        if ($result) {
            $this->loadData(); // Reload data
            $this->logActivity("Configuration restored from: " . $filename, 'fa-undo');
        }
        
        return $result;
    }
    
    public function getStats() {
        global $ADMIN_PAGES;
        
        $stats = [
            'total_pages' => count($ADMIN_PAGES),
            'services_count' => count($this->getData('SERVICES')),
            'images_count' => $this->countImages(),
            'last_backup' => $this->getLastBackupTime()
        ];
        
        return $stats;
    }
    
    private function countImages() {
        $imageDir = '../images/';
        if (!is_dir($imageDir)) {
            return 0;
        }
        
        $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $images = [];
        
        foreach ($extensions as $ext) {
            $files = glob($imageDir . '*.' . $ext);
            if ($files) {
                $images = array_merge($images, $files);
            }
        }
        
        return count($images);
    }
    
    private function getLastBackupTime() {
        $backups = $this->getBackups();
        
        if (empty($backups)) {
            return 'Niciodată';
        }
        
        $lastBackup = $backups[0];
        $diff = time() - $lastBackup['date'];
        
        if ($diff < 3600) {
            return floor($diff / 60) . ' min';
        } elseif ($diff < 86400) {
            return floor($diff / 3600) . ' ore';
        } else {
            return floor($diff / 86400) . ' zile';
        }
    }
    
    public function logActivity($description, $icon = 'fa-info') {
        $logFile = '../logs/admin_activity.log';
        $logDir = dirname($logFile);
        
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        $logEntry = [
            'timestamp' => time(),
            'user' => $_SESSION['admin_username'] ?? 'unknown',
            'description' => $description,
            'icon' => $icon,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ];
        
        $logLine = json_encode($logEntry) . "\n";
        file_put_contents($logFile, $logLine, FILE_APPEND | LOCK_EX);
    }
    
    public function getRecentActivity($limit = 10) {
        $logFile = '../logs/admin_activity.log';
        
        if (!file_exists($logFile)) {
            return [];
        }
        
        $lines = file($logFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $activities = [];
        
        // Get the last $limit lines
        $lines = array_slice($lines, -$limit);
        $lines = array_reverse($lines);
        
        foreach ($lines as $line) {
            $activity = json_decode($line, true);
            if ($activity) {
                $activity['time'] = $this->timeAgo($activity['timestamp']);
                $activities[] = $activity;
            }
        }
        
        return $activities;
    }
    
    private function timeAgo($timestamp) {
        $diff = time() - $timestamp;
        
        if ($diff < 60) {
            return 'Acum ' . $diff . ' secunde';
        } elseif ($diff < 3600) {
            return 'Acum ' . floor($diff / 60) . ' minute';
        } elseif ($diff < 86400) {
            return 'Acum ' . floor($diff / 3600) . ' ore';
        } else {
            return 'Acum ' . floor($diff / 86400) . ' zile';
        }
    }
    
    public function validateData($key, $values) {
        $errors = [];
        
        switch ($key) {
            case 'SERVICES':
                foreach ($values as $index => $service) {
                    if (empty(trim($service))) {
                        $errors[] = "Serviciul #" . ($index + 1) . " nu poate fi gol";
                    }
                }
                break;
                
            case 'SERVICES_NAMES':
            case 'SERVICES_NAMES_SHORT':
                foreach ($values as $index => $name) {
                    if (empty(trim($name))) {
                        $errors[] = "Numele serviciului #" . ($index + 1) . " nu poate fi gol";
                    }
                }
                break;
                
            case 'SERVICES_IMAGES':
            case 'HERO_IMAGES':
            case 'GALLERY_IMAGES':
            case 'FULL_GALLERY_IMAGES':
                foreach ($values as $index => $image) {
                    if (!empty(trim($image))) {
                        $imagePath = '../images/' . trim($image);
                        if (!file_exists($imagePath)) {
                            $errors[] = "Imaginea '" . trim($image) . "' nu există";
                        }
                    }
                }
                break;
                
            case 'HERO_TITLES':
            case 'HERO_DESCRIPTIONS':
            case 'HERO_BUTTONS':
            case 'GALLERY_TITLES':
            case 'GALLERY_DESCRIPTIONS':
            case 'FULL_GALLERY_TITLES':
            case 'FULL_GALLERY_DESCRIPTIONS':
            case 'FULL_GALLERY_CATEGORIES':
            case 'TESTIMONIALS_QUOTES':
            case 'TESTIMONIALS_AUTHORS':
            case 'TESTIMONIALS_ROLES':
                foreach ($values as $index => $value) {
                    if (empty(trim($value))) {
                        $errors[] = "Valoarea #" . ($index + 1) . " nu poate fi goală";
                    }
                }
                break;
                
            case 'STATS_VALUES':
                foreach ($values as $index => $value) {
                    if (!is_numeric(trim($value))) {
                        $errors[] = "Statistica #" . ($index + 1) . " trebuie să fie un număr";
                    }
                }
                break;
                
            case 'ABOUT_TEXT_1':
            case 'ABOUT_TEXT_2':
            case 'ABOUT_TEXT_3':
            case 'ABOUT_TITLE':
                if (is_array($values)) {
                    foreach ($values as $value) {
                        if (empty(trim($value))) {
                            $errors[] = "Textul despre noi nu poate fi gol";
                        }
                    }
                } else {
                    if (empty(trim($values))) {
                        $errors[] = "Textul despre noi nu poate fi gol";
                    }
                }
                break;
        }
        
        return $errors;
    }
    
    public function uploadImage($file) {
        $uploadDir = '../images/';
        $allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
        $maxSize = 5 * 1024 * 1024; // 5MB
        
        // Check if upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        
        // Validate file
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return ['success' => false, 'error' => 'Nu a fost încărcat niciun fișier valid.'];
        }
        
        if ($file['size'] > $maxSize) {
            return ['success' => false, 'error' => 'Fișierul este prea mare. Mărimea maximă permisă este 5MB.'];
        }
        
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        
        if (!in_array($mimeType, $allowedTypes)) {
            return ['success' => false, 'error' => 'Tipul de fișier nu este permis. Pentru imagini folosiți: JPG, PNG, GIF, WEBP.'];
        }
        
        // Generate unique filename
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $filename = uniqid('img_') . '.' . strtolower($extension);
        $uploadPath = $uploadDir . $filename;
        
        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            $this->logActivity("Imaginea '$filename' a fost încărcată", 'fa-upload');
            return ['success' => true, 'filename' => $filename];
        } else {
            return ['success' => false, 'error' => 'Eroare la încărcarea fișierului.'];
        }
    }
    
    public function deleteImage($filename) {
        $imagePath = '../images/' . $filename;
        
        if (!file_exists($imagePath)) {
            return false;
        }
        
        // Check if image is used in any configuration
        $isUsed = false;
        $imageKeys = ['SERVICES_IMAGES', 'HERO_IMAGES', 'GALLERY_IMAGES', 'FULL_GALLERY_IMAGES'];
        
        foreach ($imageKeys as $key) {
            $images = $this->getData($key);
            if (in_array($filename, $images)) {
                $isUsed = true;
                break;
            }
        }
        
        if ($isUsed) {
            // Don't delete if image is still in use
            return false;
        }
        
        if (unlink($imagePath)) {
            $this->logActivity("Imaginea '$filename' a fost ștearsă", 'fa-trash');
            return true;
        }
        
        return false;
    }
    
    public function getAvailableImages() {
        $availableImages = [];
        $imageDir = '../images/';
        
        if (is_dir($imageDir)) {
            $extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            foreach ($extensions as $ext) {
                $imageFiles = glob($imageDir . '*.' . $ext);
                if ($imageFiles) {
                    foreach ($imageFiles as $imageFile) {
                        $availableImages[] = basename($imageFile);
                    }
                }
            }
        }
        
        sort($availableImages);
        return $availableImages;
    }
}
?>
