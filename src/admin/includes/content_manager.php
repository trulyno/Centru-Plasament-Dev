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
                foreach ($values as $index => $image) {
                    if (!empty(trim($image))) {
                        $imagePath = '../images/' . trim($image);
                        if (!file_exists($imagePath)) {
                            $errors[] = "Imaginea '" . trim($image) . "' nu există";
                        }
                    }
                }
                break;
        }
        
        return $errors;
    }
}
?>
