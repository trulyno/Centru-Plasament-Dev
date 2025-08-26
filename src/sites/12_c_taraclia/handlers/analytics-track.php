<?php
/**
 * Analytics Tracking Endpoint
 * Handles GDPR-compliant analytics tracking requests
 */

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Include required files
require_once __DIR__ . '/../includes/gdpr.php';
require_once __DIR__ . '/../includes/analytics.php';

// Check if request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['error' => 'Method not allowed']);
    exit;
}

// Check GDPR consent
if (!GDPRManager::hasConsentForCategory('analytics')) {
    http_response_code(403);
    echo json_encode(['error' => 'Analytics tracking not permitted']);
    exit;
}

try {
    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid JSON input']);
        exit;
    }
    
    $type = $input['type'] ?? '';
    
    switch ($type) {
        case 'pageview':
            $page = $input['page'] ?? '';
            $referrer = $input['referrer'] ?? null;
            
            if (!$page) {
                http_response_code(400);
                echo json_encode(['error' => 'Page parameter required']);
                exit;
            }
            
            // Extract just the filename for tracking
            $page = basename($page, '.php');
            AnalyticsManager::trackPageView($page, $referrer);
            
            echo json_encode(['success' => true, 'message' => 'Page view tracked']);
            break;
            
        case 'event':
            $category = $input['category'] ?? '';
            $action = $input['action'] ?? '';
            $label = $input['label'] ?? null;
            $value = $input['value'] ?? null;
            
            if (!$category || !$action) {
                http_response_code(400);
                echo json_encode(['error' => 'Category and action parameters required']);
                exit;
            }
            
            AnalyticsManager::trackEvent($category, $action, $label, $value);
            
            echo json_encode(['success' => true, 'message' => 'Event tracked']);
            break;
            
        default:
            http_response_code(400);
            echo json_encode(['error' => 'Invalid tracking type']);
            exit;
    }
    
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Internal server error']);
    
    // Log error for debugging (without personal data)
    error_log('Analytics tracking error: ' . $e->getMessage());
}
?>
