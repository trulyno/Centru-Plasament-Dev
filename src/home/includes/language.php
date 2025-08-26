<?php
/**
 * Language Support System
 * Handles multi-language functionality for the website
 */

class LanguageManager {
    private $currentLang = 'ro';
    private $defaultLang = 'ro';
    private $availableLanguages = ['ro', 'en'];
    private $translations = [];
    
    public function __construct() {
        $this->detectLanguage();
        $this->loadTranslations();
    }
    
    /**
     * Detect current language from URL parameter, session, or browser
     */
    private function detectLanguage() {
        // Check URL parameter first
        if (isset($_GET['lang']) && in_array($_GET['lang'], $this->availableLanguages)) {
            $this->currentLang = $_GET['lang'];
            $_SESSION['lang'] = $this->currentLang;
        } 
        // Check session
        elseif (isset($_SESSION['lang']) && in_array($_SESSION['lang'], $this->availableLanguages)) {
            $this->currentLang = $_SESSION['lang'];
        }
        // Default to Romanian
        else {
            $this->currentLang = $this->defaultLang;
        }
    }
    
    /**
     * Load translations for current language
     */
    private function loadTranslations() {
        $langFile = __DIR__ . '/../lang/' . $this->currentLang . '.json';
        if (file_exists($langFile)) {
            $content = file_get_contents($langFile);
            $this->translations = json_decode($content, true) ?? [];
        }
    }
    
    /**
     * Get translation for a key
     */
    public function t($key, $default = null) {
        if (isset($this->translations[$key])) {
            return $this->translations[$key];
        }
        return $default ?? $key;
    }
    
    /**
     * Get current language
     */
    public function getCurrentLang() {
        return $this->currentLang;
    }
    
    /**
     * Get available languages
     */
    public function getAvailableLanguages() {
        return $this->availableLanguages;
    }
    
    /**
     * Generate language switcher URL
     */
    public function getLanguageUrl($lang) {
        $currentUrl = $_SERVER['REQUEST_URI'];
        $baseUrl = strtok($currentUrl, '?');
        
        // Remove existing lang parameter
        $params = $_GET;
        unset($params['lang']);
        
        // Add new lang parameter
        $params['lang'] = $lang;
        
        $queryString = http_build_query($params);
        return $baseUrl . ($queryString ? '?' . $queryString : '?lang=' . $lang);
    }
    
    /**
     * Get language name for display
     */
    public function getLanguageName($lang) {
        $names = [
            'ro' => 'Română',
            'en' => 'English'
        ];
        return $names[$lang] ?? $lang;
    }
}

// Initialize language manager
session_start();
$lang = new LanguageManager();

// Helper function for easy translation access
function t($key, $default = null) {
    global $lang;
    return $lang->t($key, $default);
}

// Helper function to get current language
function getCurrentLang() {
    global $lang;
    return $lang->getCurrentLang();
}
?>
