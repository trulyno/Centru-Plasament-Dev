<?php
session_start();

// Default language
define('DEFAULT_LANG', 'ro');

// Available languages
$available_languages = [
    'ro' => [
        'name' => 'Română',
        'code' => 'ro'
    ],
    'en' => [
        'name' => 'English',
        'code' => 'en'
    ]
];

// Get current language from session, URL parameter, or default
function getCurrentLanguage() {
    global $available_languages;
    
    // Check URL parameter first
    if (isset($_GET['lang']) && array_key_exists($_GET['lang'], $available_languages)) {
        $_SESSION['lang'] = $_GET['lang'];
        return $_GET['lang'];
    }
    
    // Check session
    if (isset($_SESSION['lang']) && array_key_exists($_SESSION['lang'], $available_languages)) {
        return $_SESSION['lang'];
    }
    
    // Check browser language
    if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $browser_lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        if (array_key_exists($browser_lang, $available_languages)) {
            $_SESSION['lang'] = $browser_lang;
            return $browser_lang;
        }
    }
    
    // Default fallback
    $_SESSION['lang'] = DEFAULT_LANG;
    return DEFAULT_LANG;
}

// Load language file
function loadLanguage($lang = null) {
    if ($lang === null) {
        $lang = getCurrentLanguage();
    }
    
    $lang_file = __DIR__ . '/../lang/' . $lang . '.json';
    
    if (file_exists($lang_file)) {
        $json_content = file_get_contents($lang_file);
        return json_decode($json_content, true);
    }
    
    // Fallback to default language
    $default_file = __DIR__ . '/../lang/' . DEFAULT_LANG . '.json';
    if (file_exists($default_file)) {
        $json_content = file_get_contents($default_file);
        return json_decode($json_content, true);
    }
    
    return [];
}

// Translation function
function t($key, $lang = null) {
    static $translations = [];
    
    $target_lang = $lang !== null ? $lang : getCurrentLanguage();
    
    if (!isset($translations[$target_lang])) {
        $translations[$target_lang] = loadLanguage($target_lang);
    }
    
    return isset($translations[$target_lang][$key]) ? $translations[$target_lang][$key] : $key;
}

// Get language selector HTML
function getLanguageSelector($current_page = '') {
    global $available_languages;
    $current_lang = getCurrentLanguage();
    
    $html = '<div class="language-selector">';
    $html .= '<button class="language-toggle" aria-label="' . t('language_switch') . '">';
    $html .= '<span class="current-lang">' . $available_languages[$current_lang]['code'] . '</span>';
    $html .= '<i class="fas fa-chevron-down"></i>';
    $html .= '</button>';
    $html .= '<div class="language-dropdown">';
    
    foreach ($available_languages as $code => $info) {
        $is_current = ($code === $current_lang);
        $url = $current_page . '?lang=' . $code;
        
        $html .= '<a href="' . $url . '" class="language-option' . ($is_current ? ' active' : '') . '">';
        $html .= '<span class="name">' . $info['name'] . '</span>';
        if ($is_current) {
            $html .= '<i class="fas fa-check"></i>';
        }
        $html .= '</a>';
    }
    
    $html .= '</div>';
    $html .= '</div>';
    
    return $html;
}

// Initialize current language
$current_lang = getCurrentLanguage();
$translations = loadLanguage($current_lang);

// Set HTML lang attribute
$html_lang = $current_lang;
?>
