<?php
/**
 * Simple Analytics Manager
 * GDPR-compliant traffic analysis without external dependencies
 */

class AnalyticsManager {
    
    private static $dataFile = __DIR__ . '/../data/analytics.json';
    private static $sessionsFile = __DIR__ . '/../data/sessions.json';
    
    public static function trackPageView($page, $referrer = null) {
        // Only track if user has given consent
        if (!GDPRManager::hasConsentForCategory('analytics')) {
            return;
        }
        
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        // Check if this page has already been viewed in this session
        if (!isset($_SESSION['viewed_pages'])) {
            $_SESSION['viewed_pages'] = [];
        }
        
        $sessionKey = $page . '_' . date('Y-m-d');
        if (in_array($sessionKey, $_SESSION['viewed_pages'])) {
            // Already counted this page view for today in this session
            return;
        }
        
        // Mark this page as viewed in this session
        $_SESSION['viewed_pages'][] = $sessionKey;
        
        // Clean old session data (keep only today's views)
        $_SESSION['viewed_pages'] = array_filter($_SESSION['viewed_pages'], function($key) {
            return strpos($key, '_' . date('Y-m-d')) !== false;
        });
        
        $data = self::loadAnalyticsData();
        $today = date('Y-m-d');
        $hour = (int) date('H'); // Convert to integer to match array_fill indices
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
        $ip = self::getAnonymizedIP();
        
        // Initialize data structure
        if (!isset($data['daily'][$today])) {
            $data['daily'][$today] = [
                'page_views' => 0,
                'unique_visitors' => [],
                'pages' => [],
                'referrers' => [],
                'browsers' => [],
                'hourly' => array_fill(0, 24, 0)
            ];
        }
        
        // Track page view
        $data['daily'][$today]['page_views']++;
        $data['daily'][$today]['hourly'][$hour]++;
        
        // Track unique visitor
        $visitorHash = hash('sha256', $ip . $userAgent . date('Y-m-d'));
        if (!in_array($visitorHash, $data['daily'][$today]['unique_visitors'])) {
            $data['daily'][$today]['unique_visitors'][] = $visitorHash;
        }
        
        // Track page
        if (!isset($data['daily'][$today]['pages'][$page])) {
            $data['daily'][$today]['pages'][$page] = 0;
        }
        $data['daily'][$today]['pages'][$page]++;
        
        // Track referrer
        if ($referrer && $referrer !== '-') {
            $referrerDomain = parse_url($referrer, PHP_URL_HOST) ?: 'direct';
            if (!isset($data['daily'][$today]['referrers'][$referrerDomain])) {
                $data['daily'][$today]['referrers'][$referrerDomain] = 0;
            }
            $data['daily'][$today]['referrers'][$referrerDomain]++;
        }
        
        // Track browser
        $browser = self::getBrowser($userAgent);
        if (!isset($data['daily'][$today]['browsers'][$browser])) {
            $data['daily'][$today]['browsers'][$browser] = 0;
        }
        $data['daily'][$today]['browsers'][$browser]++;
        
        // Clean old data (keep last 90 days)
        $cutoffDate = date('Y-m-d', strtotime('-90 days'));
        foreach ($data['daily'] as $date => $dayData) {
            if ($date < $cutoffDate) {
                unset($data['daily'][$date]);
            }
        }
        
        self::saveAnalyticsData($data);
        
        // Log for GDPR compliance
        GDPRManager::logDataProcessing('analytics', [
            'ip' => $ip,
            'page' => $page,
            'user_agent' => substr($userAgent, 0, 100)
        ], 'Website analytics and improvement', 'Legitimate interest');
    }
    
    public static function trackEvent($category, $action, $label = null, $value = null) {
        if (!GDPRManager::hasConsentForCategory('analytics')) {
            return;
        }
        
        $data = self::loadAnalyticsData();
        $today = date('Y-m-d');
        
        if (!isset($data['events'][$today])) {
            $data['events'][$today] = [];
        }
        
        $eventKey = $category . '/' . $action . ($label ? '/' . $label : '');
        if (!isset($data['events'][$today][$eventKey])) {
            $data['events'][$today][$eventKey] = 0;
        }
        $data['events'][$today][$eventKey]++;
        
        self::saveAnalyticsData($data);
    }
    
    public static function getAnalyticsSummary($days = 30) {
        $data = self::loadAnalyticsData();
        $summary = [
            'total_page_views' => 0,
            'unique_visitors' => 0,
            'top_pages' => [],
            'top_referrers' => [],
            'browsers' => [],
            'hourly_distribution' => array_fill(0, 24, 0),
            'daily_views' => []
        ];
        
        $startDate = date('Y-m-d', strtotime("-{$days} days"));
        $allVisitors = [];
        
        foreach ($data['daily'] as $date => $dayData) {
            if ($date >= $startDate) {
                $summary['total_page_views'] += $dayData['page_views'];
                $allVisitors = array_merge($allVisitors, $dayData['unique_visitors']);
                
                // Aggregate top pages
                foreach ($dayData['pages'] as $page => $views) {
                    if (!isset($summary['top_pages'][$page])) {
                        $summary['top_pages'][$page] = 0;
                    }
                    $summary['top_pages'][$page] += $views;
                }
                
                // Aggregate referrers
                foreach ($dayData['referrers'] as $referrer => $count) {
                    if (!isset($summary['top_referrers'][$referrer])) {
                        $summary['top_referrers'][$referrer] = 0;
                    }
                    $summary['top_referrers'][$referrer] += $count;
                }
                
                // Aggregate browsers
                foreach ($dayData['browsers'] as $browser => $count) {
                    if (!isset($summary['browsers'][$browser])) {
                        $summary['browsers'][$browser] = 0;
                    }
                    $summary['browsers'][$browser] += $count;
                }
                
                // Aggregate hourly distribution
                for ($i = 0; $i < 24; $i++) {
                    $summary['hourly_distribution'][$i] += $dayData['hourly'][$i];
                }
                
                $summary['daily_views'][$date] = $dayData['page_views'];
            }
        }
        
        $summary['unique_visitors'] = count(array_unique($allVisitors));
        
        // Sort top items
        arsort($summary['top_pages']);
        arsort($summary['top_referrers']);
        arsort($summary['browsers']);
        
        return $summary;
    }
    
    public static function getBasicStats() {
        $data = self::loadAnalyticsData();
        $today = date('Y-m-d');
        
        $totalViews = 0;
        $todayViews = 0;
        
        foreach ($data['daily'] as $date => $dayData) {
            $totalViews += $dayData['page_views'];
            if ($date === $today) {
                $todayViews = $dayData['page_views'];
            }
        }
        
        return [
            'total_views' => $totalViews,
            'today_views' => $todayViews
        ];
    }
    
    private static function loadAnalyticsData() {
        if (!file_exists(self::$dataFile)) {
            $dir = dirname(self::$dataFile);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            return ['daily' => [], 'events' => []];
        }
        
        return json_decode(file_get_contents(self::$dataFile), true) ?: ['daily' => [], 'events' => []];
    }
    
    private static function saveAnalyticsData($data) {
        file_put_contents(self::$dataFile, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    
    private static function getAnonymizedIP() {
        $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        
        // Anonymize IP by removing last octet for IPv4 or last 80 bits for IPv6
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            $parts = explode('.', $ip);
            $parts[3] = '0'; // Anonymize last octet
            return implode('.', $parts);
        } elseif (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)) {
            // For IPv6, keep only first 48 bits (3 groups of 16 bits)
            $parts = explode(':', $ip);
            return implode(':', array_slice($parts, 0, 3)) . '::';
        }
        
        return '0.0.0.0';
    }
    
    private static function getBrowser($userAgent) {
        if (strpos($userAgent, 'Chrome') !== false) return 'Chrome';
        if (strpos($userAgent, 'Firefox') !== false) return 'Firefox';
        if (strpos($userAgent, 'Safari') !== false && strpos($userAgent, 'Chrome') === false) return 'Safari';
        if (strpos($userAgent, 'Edge') !== false) return 'Edge';
        if (strpos($userAgent, 'Opera') !== false) return 'Opera';
        if (strpos($userAgent, 'MSIE') !== false || strpos($userAgent, 'Trident') !== false) return 'Internet Explorer';
        return 'Other';
    }
}

// Auto-track page views
if (!defined('ANALYTICS_DISABLED')) {
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
    $referrer = $_SERVER['HTTP_REFERER'] ?? null;
    AnalyticsManager::trackPageView($currentPage, $referrer);
}
?>
