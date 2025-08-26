/**
 * GDPR Compliance JavaScript
 * Handles cookie consent, analytics tracking, and privacy settings
 */

// GDPR Cookie Management
class GDPRManager {
    constructor() {
        this.consentKey = 'gdpr_consent';
        this.bannerShownKey = 'gdpr_banner_shown';
        this.init();
    }

    init() {
        this.showBannerIfNeeded();
        // Remove privacy button since settings are now in footer
        // this.addPrivacyButton();
        this.bindEvents();
        this.addBodyPaddingForFooter();
    }

    addBodyPaddingForFooter() {
        // Add bottom padding to body to prevent content being hidden behind fixed footer
        const footerSection = document.getElementById('gdpr-footer-section');
        if (footerSection) {
            const updatePadding = () => {
                const footerHeight = footerSection.offsetHeight;
                document.body.style.paddingBottom = footerHeight + 'px';
            };
            
            // Update padding after a short delay to ensure footer is rendered
            setTimeout(updatePadding, 100);
            
            // Update on window resize
            window.addEventListener('resize', updatePadding);
        }
    }

    showBannerIfNeeded() {
        // For footer implementation, we don't show the banner anymore
        // The GDPR settings are now integrated into the footer
        return;
    }

    showBanner() {
        // Deprecated - using footer implementation instead
        const banner = document.getElementById('gdpr-banner');
        if (banner) {
            banner.classList.add('show');
            this.setBannerShown();
        }
    }

    hideFooterSection() {
        const footerSection = document.getElementById('gdpr-footer-section');
        if (footerSection) {
            footerSection.style.opacity = '0';
            footerSection.style.transform = 'translateY(20px)';
            setTimeout(() => {
                footerSection.style.display = 'none';
                // Remove body padding when footer is hidden
                document.body.style.paddingBottom = '0px';
            }, 300);
        }
    }

    hideBanner() {
        const banner = document.getElementById('gdpr-banner');
        if (banner) {
            banner.classList.remove('show');
            setTimeout(() => {
                banner.style.display = 'none';
            }, 300);
        }
    }

    hasConsent() {
        return this.getCookie(this.consentKey) !== null;
    }

    wasBannerShown() {
        return this.getCookie(this.bannerShownKey) !== null;
    }

    setBannerShown() {
        this.setCookie(this.bannerShownKey, 'true', 365);
    }

    getConsent() {
        const consent = this.getCookie(this.consentKey);
        return consent ? JSON.parse(consent) : null;
    }

    saveConsent(preferences) {
        this.setCookie(this.consentKey, JSON.stringify(preferences), 365);
        this.hideBanner();
        this.hideFooterSection();
        this.closeModal();
        
        // Remove body padding when footer is dismissed
        document.body.style.paddingBottom = '0px';
        
        // Reload analytics if analytics consent was given
        if (preferences.analytics) {
            this.initializeAnalytics();
        }

        // Show confirmation
        this.showConsentConfirmation();
    }

    showConsentConfirmation() {
        const notification = document.createElement('div');
        notification.className = 'gdpr-notification';
        notification.innerHTML = `
            <div class="gdpr-notification-content">
                <i class="fas fa-check-circle"></i>
                <span>Preferințele dvs. au fost salvate!</span>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 100);
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => {
                document.body.removeChild(notification);
            }, 300);
        }, 3000);
    }

    openModal() {
        const modal = document.getElementById('gdpr-modal');
        if (modal) {
            modal.classList.add('show');
            this.loadCurrentPreferences();
        }
    }

    closeModal() {
        const modal = document.getElementById('gdpr-modal');
        if (modal) {
            modal.classList.remove('show');
        }
    }

    loadCurrentPreferences() {
        const consent = this.getConsent() || {};
        
        // Load current settings into modal
        const analyticsCheckbox = document.getElementById('analytics');
        
        if (analyticsCheckbox) {
            analyticsCheckbox.checked = consent.analytics || false;
        }
    }

    addPrivacyButton() {
        // const privacyButton = document.createElement('button');
        // privacyButton.className = 'privacy-settings-link';
        // privacyButton.innerHTML = '<i class="fas fa-cog"></i>';
        // privacyButton.title = 'Setări confidențialitate';
        // privacyButton.setAttribute('aria-label', 'Setări confidențialitate');
        // privacyButton.onclick = () => this.openModal();
        
        // document.body.appendChild(privacyButton);
    }

    bindEvents() {
        // Modal close events
        document.addEventListener('click', (e) => {
            const modal = document.getElementById('gdpr-modal');
            if (e.target === modal) {
                this.closeModal();
            }
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeModal();
            }
        });
    }

    initializeAnalytics() {
        // Initialize analytics tracking if consent is given
        if (this.hasConsentForCategory('analytics')) {
            window.analyticsEnabled = true;
            // Track current page view
            this.trackPageView();
        }
    }

    hasConsentForCategory(category) {
        const consent = this.getConsent();
        return consent && consent[category] === true;
    }

    trackPageView() {
        if (!this.hasConsentForCategory('analytics')) {
            return;
        }

        // Track page view via fetch to analytics endpoint
        fetch('/handlers/analytics-track.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                type: 'pageview',
                page: window.location.pathname,
                referrer: document.referrer || null
            })
        }).catch(error => {
            console.warn('Analytics tracking failed:', error);
        });
    }

    trackEvent(category, action, label = null, value = null) {
        if (!this.hasConsentForCategory('analytics')) {
            return;
        }

        fetch('/handlers/analytics-track.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                type: 'event',
                category: category,
                action: action,
                label: label,
                value: value
            })
        }).catch(error => {
            console.warn('Event tracking failed:', error);
        });
    }

    // Cookie utilities
    setCookie(name, value, days) {
        const expires = new Date();
        expires.setTime(expires.getTime() + (days * 24 * 60 * 60 * 1000));
        document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/;SameSite=Lax`;
    }

    getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    deleteCookie(name) {
        document.cookie = `${name}=;expires=Thu, 01 Jan 1970 00:00:00 UTC;path=/;`;
    }
}

// Global functions for HTML onclick handlers
function openGDPRModal() {
    window.gdprManager.openModal();
}

function closeGDPRModal() {
    window.gdprManager.closeModal();
}

function acceptAllCookies() {
    const preferences = {
        necessary: true,
        analytics: true
    };
    window.gdprManager.saveConsent(preferences);
}

function rejectAllCookies() {
    const preferences = {
        necessary: true,
        analytics: false
    };
    window.gdprManager.saveConsent(preferences);
}

function saveGDPRPreferences() {
    const analyticsCheckbox = document.getElementById('analytics');
    
    const preferences = {
        necessary: true, // Always true
        analytics: analyticsCheckbox ? analyticsCheckbox.checked : false
    };
    
    window.gdprManager.saveConsent(preferences);
}

function dismissGDPRFooter() {
    window.gdprManager.hideFooterSection();
    // Remove body padding when footer is dismissed
    document.body.style.paddingBottom = '0px';
}

// Enhanced Analytics Tracking
class AnalyticsTracker {
    constructor() {
        this.sessionId = this.generateSessionId();
        this.startTime = Date.now();
        this.init();
    }

    init() {
        if (window.gdprManager && window.gdprManager.hasConsentForCategory('analytics')) {
            this.bindEvents();
            this.trackPageView();
        }
    }

    generateSessionId() {
        return Math.random().toString(36).substr(2, 9) + Date.now().toString(36);
    }

    bindEvents() {
        // Track outbound links
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link && link.href) {
                const url = new URL(link.href);
                if (url.hostname !== window.location.hostname) {
                    this.trackEvent('outbound_link', 'click', url.hostname);
                }
            }
        });

        // Track file downloads
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link && link.href) {
                const fileExtensions = ['.pdf', '.doc', '.docx', '.zip', '.jpg', '.png', '.gif'];
                const href = link.href.toLowerCase();
                const extension = fileExtensions.find(ext => href.includes(ext));
                if (extension) {
                    this.trackEvent('file_download', 'click', extension);
                }
            }
        });

        // Track scroll depth
        let maxScroll = 0;
        const trackScrollDepth = () => {
            const scrollPercent = Math.round((window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100);
            if (scrollPercent > maxScroll && scrollPercent % 25 === 0) {
                maxScroll = scrollPercent;
                this.trackEvent('scroll_depth', 'scroll', `${scrollPercent}%`);
            }
        };

        let scrollTimer;
        window.addEventListener('scroll', () => {
            clearTimeout(scrollTimer);
            scrollTimer = setTimeout(trackScrollDepth, 100);
        });

        // Track time on page
        window.addEventListener('beforeunload', () => {
            const timeOnPage = Math.round((Date.now() - this.startTime) / 1000);
            this.trackEvent('engagement', 'time_on_page', window.location.pathname, timeOnPage);
        });
    }

    trackPageView() {
        if (window.gdprManager && window.gdprManager.hasConsentForCategory('analytics')) {
            window.gdprManager.trackPageView();
        }
    }

    trackEvent(category, action, label = null, value = null) {
        if (window.gdprManager && window.gdprManager.hasConsentForCategory('analytics')) {
            window.gdprManager.trackEvent(category, action, label, value);
        }
    }
}

// Initialize when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Initialize GDPR Manager
    window.gdprManager = new GDPRManager();
    
    // Initialize Analytics Tracker
    window.analyticsTracker = new AnalyticsTracker();
    
    // Add notification styles
    if (!document.getElementById('gdpr-notification-styles')) {
        const styles = document.createElement('style');
        styles.id = 'gdpr-notification-styles';
        styles.textContent = `
            .gdpr-notification {
                position: fixed;
                top: 2rem;
                right: 2rem;
                background: #27ae60;
                color: white;
                padding: 1rem 1.5rem;
                border-radius: 8px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                z-index: 10001;
                transform: translateX(400px);
                transition: transform 0.3s ease;
            }
            
            .gdpr-notification.show {
                transform: translateX(0);
            }
            
            .gdpr-notification-content {
                display: flex;
                align-items: center;
                gap: 0.75rem;
            }
            
            .gdpr-notification i {
                font-size: 1.2rem;
            }
            
            @media (max-width: 768px) {
                .gdpr-notification {
                    top: 1rem;
                    right: 1rem;
                    left: 1rem;
                    transform: translateY(-100px);
                }
                
                .gdpr-notification.show {
                    transform: translateY(0);
                }
            }
        `;
        document.head.appendChild(styles);
    }
});
