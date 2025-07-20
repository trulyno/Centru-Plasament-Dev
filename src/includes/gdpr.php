<?php
/**
 * GDPR Compliance Manager
 * Handles cookie consent, data privacy, and user preferences
 */

class GDPRManager {
    
    public static function hasConsentForCategory($category) {
        if (!isset($_COOKIE['gdpr_consent'])) {
            return false;
        }
        
        $consent = json_decode($_COOKIE['gdpr_consent'], true);
        return isset($consent[$category]) && $consent[$category] === true;
    }
    
    public static function hasAnyConsent() {
        return isset($_COOKIE['gdpr_consent']);
    }
    
    public static function getConsentData() {
        if (!isset($_COOKIE['gdpr_consent'])) {
            return null;
        }
        
        return json_decode($_COOKIE['gdpr_consent'], true);
    }
    
    public static function renderConsentBanner() {
        if (self::hasAnyConsent()) {
            return '';
        }
        
        return '
        <div id="gdpr-banner" class="gdpr-banner">
            <div class="gdpr-content">
                <div class="gdpr-text">
                    <h3>' . t('gdpr_banner_title') . '</h3>
                    <p>' . t('gdpr_banner_description') . '</p>
                </div>
                <div class="gdpr-actions">
                    <button type="button" class="gdpr-btn gdpr-btn-primary" onclick="openGDPRModal()">
                        ' . t('gdpr_customize_settings') . '
                    </button>
                    <button type="button" class="gdpr-btn gdpr-btn-accept" onclick="acceptAllCookies()">
                        ' . t('gdpr_accept_all') . '
                    </button>
                    <button type="button" class="gdpr-btn gdpr-btn-reject" onclick="rejectAllCookies()">
                        ' . t('gdpr_reject_all') . '
                    </button>
                </div>
            </div>
        </div>';
    }
    
    public static function renderConsentModal() {
        return '
        <div id="gdpr-modal" class="gdpr-modal">
            <div class="gdpr-modal-content">
                <div class="gdpr-modal-header">
                    <h2>' . t('gdpr_modal_title') . '</h2>
                    <button type="button" class="gdpr-close" onclick="closeGDPRModal()">&times;</button>
                </div>
                <div class="gdpr-modal-body">
                    <p>' . t('gdpr_modal_description') . '</p>
                    
                    <div class="gdpr-category">
                        <div class="gdpr-category-header">
                            <input type="checkbox" id="necessary" checked disabled>
                            <label for="necessary">
                                <strong>' . t('gdpr_necessary_cookies') . '</strong>
                                <span class="gdpr-required">' . t('gdpr_required') . '</span>
                            </label>
                        </div>
                        <p class="gdpr-category-desc">' . t('gdpr_necessary_description') . '</p>
                    </div>
                    
                    <div class="gdpr-category">
                        <div class="gdpr-category-header">
                            <input type="checkbox" id="analytics">
                            <label for="analytics">
                                <strong>' . t('gdpr_analytics_cookies') . '</strong>
                            </label>
                        </div>
                        <p class="gdpr-category-desc">' . t('gdpr_analytics_description') . '</p>
                    </div>
                    
                    <div class="gdpr-category">
                        <div class="gdpr-category-header">
                            <input type="checkbox" id="marketing">
                            <label for="marketing">
                                <strong>' . t('gdpr_marketing_cookies') . '</strong>
                            </label>
                        </div>
                        <p class="gdpr-category-desc">' . t('gdpr_marketing_description') . '</p>
                    </div>
                </div>
                <div class="gdpr-modal-footer">
                    <button type="button" class="gdpr-btn gdpr-btn-secondary" onclick="closeGDPRModal()">
                        ' . t('gdpr_cancel') . '
                    </button>
                    <button type="button" class="gdpr-btn gdpr-btn-primary" onclick="saveGDPRPreferences()">
                        ' . t('gdpr_save_preferences') . '
                    </button>
                </div>
            </div>
        </div>';
    }
    
    public static function logDataProcessing($type, $data, $purpose, $legal_basis) {
        $logFile = __DIR__ . '/../data/gdpr_log.json';
        $logDir = dirname($logFile);
        
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        $logEntry = [
            'timestamp' => date('Y-m-d H:i:s'),
            'type' => $type,
            'data_subject' => $data['ip'] ?? $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'purpose' => $purpose,
            'legal_basis' => $legal_basis,
            'data_categories' => array_keys($data),
            'retention_period' => self::getRetentionPeriod($type)
        ];
        
        $logs = [];
        if (file_exists($logFile)) {
            $logs = json_decode(file_get_contents($logFile), true) ?: [];
        }
        
        $logs[] = $logEntry;
        
        // Keep only last 10000 entries
        if (count($logs) > 10000) {
            $logs = array_slice($logs, -10000);
        }
        
        file_put_contents($logFile, json_encode($logs, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
    
    private static function getRetentionPeriod($type) {
        $periods = [
            'contact_form' => '2 years',
            'petition' => '5 years',
            'analytics' => '26 months',
            'error_log' => '1 year'
        ];
        
        return $periods[$type] ?? '1 year';
    }
}
?>
