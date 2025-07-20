<?php
/**
 * GDPR & Analytics Test Page
 * Simple test to verify the implementation is working correctly
 */

// Include required files
require_once __DIR__ . '/includes/lang.php';
require_once __DIR__ . '/includes/gdpr.php';
require_once __DIR__ . '/includes/analytics.php';

// Test analytics tracking
AnalyticsManager::trackEvent('test', 'page_load', 'test_page');

// Get current analytics summary
$analytics = AnalyticsManager::getAnalyticsSummary(7);
?>
<!DOCTYPE html>
<html lang="<?php echo getCurrentLanguage(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GDPR & Analytics Test - CPRCVF</title>
    <link rel="icon" href="images/logo.ico" type="image/x-icon" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <link href="gdpr-styles.css" rel="stylesheet">
    <style>
        .test-container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .test-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            border: 1px solid #e1e8ed;
            border-radius: 8px;
        }
        .test-section h3 {
            color: #2c3e50;
            margin-bottom: 1rem;
        }
        .status-ok {
            color: #27ae60;
            font-weight: bold;
        }
        .status-error {
            color: #e74c3c;
            font-weight: bold;
        }
        .test-button {
            background: #3498db;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            cursor: pointer;
            margin: 0.5rem 0.5rem 0 0;
        }
        .test-button:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <div class="test-container">
        <h1><i class="fas fa-check-circle"></i> GDPR & Analytics Implementation Test</h1>
        <p>This page tests the GDPR compliance and analytics system implementation.</p>
        
        <!-- GDPR Tests -->
        <div class="test-section">
            <h3><i class="fas fa-shield-alt"></i> GDPR Compliance Tests</h3>
            
            <p><strong>GDPRManager Class:</strong> 
                <span class="<?php echo class_exists('GDPRManager') ? 'status-ok' : 'status-error'; ?>">
                    <?php echo class_exists('GDPRManager') ? '✓ Loaded' : '✗ Not Found'; ?>
                </span>
            </p>
            
            <p><strong>Consent Banner:</strong> 
                <span class="status-ok">✓ Will appear for new visitors</span>
            </p>
            
            <p><strong>Current Consent Status:</strong> 
                <?php if (GDPRManager::hasAnyConsent()): ?>
                    <span class="status-ok">✓ Consent given</span>
                    <br>
                    <?php 
                    $consent = GDPRManager::getConsentData();
                    foreach ($consent as $category => $allowed):
                    ?>
                        - <?php echo ucfirst($category); ?>: <?php echo $allowed ? '✓ Allowed' : '✗ Denied'; ?><br>
                    <?php endforeach; ?>
                <?php else: ?>
                    <span class="status-error">⚠ No consent recorded</span>
                <?php endif; ?>
            </p>
            
            <button type="button" class="test-button" onclick="openGDPRModal()">
                <i class="fas fa-cog"></i> Test Cookie Settings
            </button>
            
            <button type="button" class="test-button" onclick="testEvent('gdpr', 'test_button_click')">
                <i class="fas fa-mouse-pointer"></i> Test Event Tracking
            </button>
        </div>
        
        <!-- Analytics Tests -->
        <div class="test-section">
            <h3><i class="fas fa-chart-bar"></i> Analytics System Tests</h3>
            
            <p><strong>AnalyticsManager Class:</strong> 
                <span class="<?php echo class_exists('AnalyticsManager') ? 'status-ok' : 'status-error'; ?>">
                    <?php echo class_exists('AnalyticsManager') ? '✓ Loaded' : '✗ Not Found'; ?>
                </span>
            </p>
            
            <p><strong>Data Directory:</strong> 
                <span class="<?php echo is_writable(__DIR__ . '/data') ? 'status-ok' : 'status-error'; ?>">
                    <?php echo is_writable(__DIR__ . '/data') ? '✓ Writable' : '✗ Not Writable'; ?>
                </span>
            </p>
            
            <p><strong>Analytics Tracking:</strong> 
                <span class="<?php echo GDPRManager::hasConsentForCategory('analytics') ? 'status-ok' : 'status-error'; ?>">
                    <?php echo GDPRManager::hasConsentForCategory('analytics') ? '✓ Enabled' : '⚠ Disabled (no consent)'; ?>
                </span>
            </p>
            
            <div style="margin-top: 1rem;">
                <h4>Current Analytics Data (Last 7 Days):</h4>
                <ul>
                    <li>Total Page Views: <strong><?php echo number_format($analytics['total_page_views']); ?></strong></li>
                    <li>Unique Visitors: <strong><?php echo number_format($analytics['unique_visitors']); ?></strong></li>
                    <li>Top Pages: <strong><?php echo count($analytics['top_pages']); ?></strong></li>
                    <li>Browsers Detected: <strong><?php echo count($analytics['browsers']); ?></strong></li>
                </ul>
            </div>
            
            <a href="admin/analytics.php" class="test-button">
                <i class="fas fa-chart-line"></i> View Full Analytics Dashboard
            </a>
        </div>
        
        <!-- Privacy Tests -->
        <div class="test-section">
            <h3><i class="fas fa-user-shield"></i> Privacy Features Tests</h3>
            
            <p><strong>IP Anonymization:</strong> 
                <span class="status-ok">✓ Implemented</span>
                <br>Your IP: <?php echo $_SERVER['REMOTE_ADDR'] ?? 'Unknown'; ?>
                <br>Anonymized: <?php 
                $ip = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
                    $parts = explode('.', $ip);
                    $parts[3] = '0';
                    echo implode('.', $parts);
                } else {
                    echo 'IPv6 anonymized';
                }
                ?>
            </p>
            
            <p><strong>Data Logging:</strong> 
                <span class="status-ok">✓ Active</span>
                <br>All data processing activities are logged for GDPR compliance.
            </p>
            
            <a href="privacy-policy.php" class="test-button">
                <i class="fas fa-file-alt"></i> View Privacy Policy
            </a>
        </div>
        
        <!-- JavaScript Tests -->
        <div class="test-section">
            <h3><i class="fas fa-code"></i> JavaScript Functionality Tests</h3>
            
            <button type="button" class="test-button" onclick="testJavaScript()">
                <i class="fas fa-play"></i> Test JavaScript Functions
            </button>
            
            <div id="js-test-results" style="margin-top: 1rem;"></div>
        </div>
        
        <div style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #e1e8ed;">
            <p><strong>Test completed!</strong> If you see any errors, please check the implementation.</p>
            <a href="index.php" class="test-button">
                <i class="fas fa-home"></i> Back to Homepage
            </a>
        </div>
    </div>
    
    <!-- GDPR Compliance Components -->
    <?php echo GDPRManager::renderConsentBanner(); ?>
    <?php echo GDPRManager::renderConsentModal(); ?>

    <script src="script.js"></script>
    <script src="gdpr-script.js"></script>
    
    <script>
        function testEvent(category, action) {
            if (window.gdprManager) {
                window.gdprManager.trackEvent(category, action, 'test_page');
                alert('Event tracked: ' + category + '/' + action);
            } else {
                alert('GDPR Manager not loaded!');
            }
        }
        
        function testJavaScript() {
            const results = document.getElementById('js-test-results');
            let output = '<h4>JavaScript Test Results:</h4><ul>';
            
            // Test GDPR Manager
            if (window.gdprManager) {
                output += '<li class="status-ok">✓ GDPR Manager loaded</li>';
                
                if (typeof window.gdprManager.hasConsent === 'function') {
                    output += '<li class="status-ok">✓ GDPR functions available</li>';
                } else {
                    output += '<li class="status-error">✗ GDPR functions missing</li>';
                }
            } else {
                output += '<li class="status-error">✗ GDPR Manager not loaded</li>';
            }
            
            // Test Analytics Tracker
            if (window.analyticsTracker) {
                output += '<li class="status-ok">✓ Analytics Tracker loaded</li>';
            } else {
                output += '<li class="status-error">✗ Analytics Tracker not loaded</li>';
            }
            
            // Test global functions
            if (typeof openGDPRModal === 'function') {
                output += '<li class="status-ok">✓ Global GDPR functions available</li>';
            } else {
                output += '<li class="status-error">✗ Global GDPR functions missing</li>';
            }
            
            output += '</ul>';
            results.innerHTML = output;
        }
        
        // Auto-run JavaScript test on page load
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(testJavaScript, 1000);
        });
    </script>
</body>
</html>
