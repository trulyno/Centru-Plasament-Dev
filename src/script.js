// Mobile menu functionality
const mobileMenuBtn = document.getElementById('mobileMenuBtn');
const navMenu = document.getElementById('navMenu');
let mobileOverlay = null;

// Create mobile overlay if it doesn't exist
function createMobileOverlay() {
    if (!mobileOverlay) {
        mobileOverlay = document.createElement('div');
        mobileOverlay.className = 'mobile-overlay';
        document.body.appendChild(mobileOverlay);
        
        // Close menu when overlay is clicked
        mobileOverlay.addEventListener('click', closeMobileMenu);
    }
}

// Open mobile menu
function openMobileMenu() {
    createMobileOverlay();
    navMenu.classList.add('active');
    mobileOverlay.classList.add('active');
    document.body.style.overflow = 'hidden'; // Prevent body scroll
    mobileMenuBtn.innerHTML = '<i class="fas fa-times"></i>';
}

// Close mobile menu
function closeMobileMenu() {
    navMenu.classList.remove('active');
    if (mobileOverlay) {
        mobileOverlay.classList.remove('active');
    }
    document.body.style.overflow = ''; // Restore body scroll
    mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
    
    // Close all dropdowns when menu closes
    document.querySelectorAll('.dropdown').forEach(dropdown => {
        dropdown.classList.remove('active');
    });
    document.querySelectorAll('.dropdown-nested').forEach(nested => {
        nested.classList.remove('active');
    });
}

// Toggle mobile menu
mobileMenuBtn.addEventListener('click', () => {
    if (navMenu.classList.contains('active')) {
        closeMobileMenu();
    } else {
        openMobileMenu();
    }
});

// Close mobile menu on window resize if screen becomes large
window.addEventListener('resize', () => {
    if (window.innerWidth > 930 && navMenu.classList.contains('active')) {
        closeMobileMenu();
    }
});

// Header collapse functionality for mobile
const headerExpandBtn = document.getElementById('headerExpandBtn');
const headerTop = document.getElementById('headerTop');

if (headerExpandBtn && headerTop) {
    // Initially collapse header on mobile
    if (window.innerWidth <= 930) {
        headerTop.classList.add('collapsed');
    }
    
    headerExpandBtn.addEventListener('click', () => {
        const isExpanded = headerTop.classList.contains('expanded');
        
        if (isExpanded) {
            headerTop.classList.remove('expanded');
            headerTop.classList.add('collapsed');
            headerExpandBtn.classList.remove('expanded');
            headerExpandBtn.setAttribute('aria-expanded', 'false');
        } else {
            headerTop.classList.remove('collapsed');
            headerTop.classList.add('expanded');
            headerExpandBtn.classList.add('expanded');
            headerExpandBtn.setAttribute('aria-expanded', 'true');
        }
    });
    
    // Handle window resize
    window.addEventListener('resize', () => {
        if (window.innerWidth > 930) {
            headerTop.classList.remove('collapsed', 'expanded');
            headerExpandBtn.classList.remove('expanded');
            headerExpandBtn.setAttribute('aria-expanded', 'false');
        } else {
            if (!headerTop.classList.contains('expanded')) {
                headerTop.classList.add('collapsed');
            }
        }
    });
}

// Enhanced mobile dropdown functionality
document.addEventListener('DOMContentLoaded', function() {
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
    const nestedDropdownToggles = document.querySelectorAll('.dropdown-toggle-nested');
    
    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            // For mobile only
            if (window.innerWidth <= 930) {
                const dropdown = this.closest('.dropdown');
                const isActive = dropdown.classList.contains('active');
                
                // Close all other dropdowns
                dropdownToggles.forEach(otherToggle => {
                    if (otherToggle !== this) {
                        const otherDropdown = otherToggle.closest('.dropdown');
                        otherDropdown.classList.remove('active');
                        // Also close nested dropdowns
                        otherDropdown.querySelectorAll('.dropdown-nested').forEach(nested => {
                            nested.classList.remove('active');
                        });
                    }
                });
                
                // Toggle current dropdown
                dropdown.classList.toggle('active');
                
                // If closing, also close nested dropdowns
                if (isActive) {
                    dropdown.querySelectorAll('.dropdown-nested').forEach(nested => {
                        nested.classList.remove('active');
                    });
                }
            }
        });
    });
    
    // Handle nested dropdown toggles
    nestedDropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', function(e) {
            e.preventDefault();
            
            if (window.innerWidth <= 768) {
                const nestedDropdown = this.closest('.dropdown-nested');
                const isActive = nestedDropdown.classList.contains('active');
                
                // Close other nested dropdowns in the same parent
                const parentDropdown = this.closest('.dropdown');
                parentDropdown.querySelectorAll('.dropdown-nested').forEach(otherNested => {
                    if (otherNested !== nestedDropdown) {
                        otherNested.classList.remove('active');
                    }
                });
                
                // Toggle current nested dropdown
                nestedDropdown.classList.toggle('active');
            }
        });
    });
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.dropdown') && !e.target.closest('.mobile-menu-btn')) {
            document.querySelectorAll('.dropdown').forEach(dropdown => {
                dropdown.classList.remove('active');
            });
            document.querySelectorAll('.dropdown-nested').forEach(nested => {
                nested.classList.remove('active');
            });
        }
    });
});

// Fade in animation on scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
        }
    });
}, observerOptions);

document.querySelectorAll('.fade-in').forEach(el => {
    observer.observe(el);
});

// Animated counters
function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    const timer = setInterval(() => {
        start += increment;
        if (start >= target) {
            element.textContent = target.toLocaleString();
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(start).toLocaleString();
        }
    }, 16);
}

// Load and start counters when stats section is visible
const statsSection = document.querySelector('.stats');
const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            loadAndAnimateStats();
            statsObserver.unobserve(entry.target);
        }
    });
});

// Function to load statistics from API and animate counters
async function loadAndAnimateStats() {
    try {
        const response = await fetch('handlers/get-stats.php');
        const result = await response.json();
        
        if (result.success && result.data) {
            const stats = result.data;
            
            // Animate counters with loaded values
            if (document.getElementById('stat1')) {
                animateCounter(document.getElementById('stat1'), stats.stat1.value);
            }
            if (document.getElementById('stat2')) {
                animateCounter(document.getElementById('stat2'), stats.stat2.value);
            }
            if (document.getElementById('stat3')) {
                animateCounter(document.getElementById('stat3'), stats.stat3.value);
            }
            if (document.getElementById('stat4')) {
                animateCounter(document.getElementById('stat4'), stats.stat4.value);
            }
        } else {
            // Fallback to default values if API fails
            console.warn('Failed to load stats from API, using defaults');
            animateCounter(document.getElementById('stat1'), 11078);
            animateCounter(document.getElementById('stat2'), 11050);
            animateCounter(document.getElementById('stat3'), 1956);
            animateCounter(document.getElementById('stat4'), 79);
        }
    } catch (error) {
        console.error('Error loading stats:', error);
        // Fallback to default values
        animateCounter(document.getElementById('stat1'), 11078);
        animateCounter(document.getElementById('stat2'), 11050);
        animateCounter(document.getElementById('stat3'), 1956);
        animateCounter(document.getElementById('stat4'), 79);
    }
}

if (statsSection) {
    statsObserver.observe(statsSection);
}

// Contact form handling
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', async event => {
        event.preventDefault();
        
        // Simple form validation
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const subject = document.getElementById('subject').value;
        const message = document.getElementById('message').value;
        
        if (!name || !email || !subject || !message) {
            alert('Vă rugăm să completați toate câmpurile obligatorii.');
            return;
        }
        
        // Show loading state
        const submitBtn = contactForm.querySelector('.submit-btn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Se trimite...';
        submitBtn.disabled = true;
        
        try {
            // Prepare form data
            const formData = new FormData(contactForm);
            
            // Submit form
            const response = await fetch('handlers/contact-form.php', {
                method: 'POST',
                body: formData
            });
            
            const result = await response.json();
            
            if (result.success) {
                alert(result.message);
                contactForm.reset();
            } else {
                alert('Eroare: ' + result.message);
            }
        } catch (error) {
            console.error('Error submitting form:', error);
            alert('A apărut o eroare la trimiterea mesajului. Vă rugăm să încercați din nou.');
        } finally {
            // Reset button state
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    });
}

// Add loading animation
window.addEventListener('load', () => {
    // Remove conflicting body opacity changes
    // Loading is handled by the loading overlay instead
});

// Hero Slideshow functionality
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');
const slideButtons = document.querySelectorAll('.slide-btn');
let slideInterval;

console.log('Slides found:', slides.length);
console.log('Slide buttons found:', slideButtons.length);

function showSlide(index) {
    slides.forEach(slide => slide.classList.remove('active'));
    slideButtons.forEach(btn => btn.classList.remove('active'));
    
    if (slides[index]) {
        slides[index].classList.add('active');
    }
    if (slideButtons[index]) {
        slideButtons[index].classList.add('active');
    }
    currentSlide = index;
}

function nextSlide() {
    currentSlide = (currentSlide + 1) % slides.length;
    showSlide(currentSlide);
}

function startSlideshow() {
    slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
}

function stopSlideshow() {
    clearInterval(slideInterval);
}

// Initialize hero slideshow
if (slides.length > 0) {
    slideButtons.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            showSlide(index);
            stopSlideshow();
            startSlideshow(); // Restart timer
        });
    });
    
    // Auto-start slideshow
    startSlideshow();
    
    // Pause on hover
    const heroSection = document.querySelector('.hero');
    heroSection.addEventListener('mouseenter', stopSlideshow);
    heroSection.addEventListener('mouseleave', startSlideshow);
    
    // Add touch/swipe support for mobile
    addHeroTouchSupport();
}

// Add touch/swipe support for hero slideshow
function addHeroTouchSupport() {
    const heroSlideshow = document.querySelector('.hero-slideshow');
    if (!heroSlideshow) return;
    
    let startX = 0;
    let endX = 0;
    let startTime = 0;
    let endTime = 0;
    
    heroSlideshow.addEventListener('touchstart', (e) => {
        startX = e.touches[0].clientX;
        startTime = Date.now();
    }, { passive: true });
    
    heroSlideshow.addEventListener('touchmove', (e) => {
        endX = e.touches[0].clientX;
    }, { passive: true });
    
    heroSlideshow.addEventListener('touchend', () => {
        endTime = Date.now();
        const threshold = 50; // Minimum swipe distance
        const timeThreshold = 300; // Maximum swipe time (ms)
        const distance = startX - endX;
        const timeElapsed = endTime - startTime;
        
        // Only process quick swipes
        if (Math.abs(distance) > threshold && timeElapsed < timeThreshold) {
            if (distance > 0) {
                // Swiped left - next slide
                nextSlide();
            } else {
                // Swiped right - previous slide
                const prevSlide = currentSlide === 0 ? slides.length - 1 : currentSlide - 1;
                showSlide(prevSlide);
            }
            stopSlideshow();
            startSlideshow(); // Restart timer
        }
    }, { passive: true });
}

// Programs slideshow functionality
let currentProgram = 0;
const programSlides = document.querySelectorAll('.program-slide');
const programButtons = document.querySelectorAll('.program-btn');

function showProgram(index) {
    programSlides.forEach(slide => slide.classList.remove('active'));
    programButtons.forEach(btn => btn.classList.remove('active'));
    
    programSlides[index].classList.add('active');
    programButtons[index].classList.add('active');
    currentProgram = index;
}

// Initialize programs slideshow
if (programButtons.length > 0) {
    programButtons.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            showProgram(index);
        });
    });
}

// Testimonials slideshow functionality
let currentTestimonial = 0;
const testimonialSlides = document.querySelectorAll('.testimonial-slide');
const testimonialButtons = document.querySelectorAll('.testimonial-btn');
let testimonialInterval;

function showTestimonial(index) {
    testimonialSlides.forEach(slide => slide.classList.remove('active'));
    testimonialButtons.forEach(btn => btn.classList.remove('active'));
    
    testimonialSlides[index].classList.add('active');
    testimonialButtons[index].classList.add('active');
    currentTestimonial = index;
}

function nextTestimonial() {
    currentTestimonial = (currentTestimonial + 1) % testimonialSlides.length;
    showTestimonial(currentTestimonial);
}

function startTestimonialSlideshow() {
    testimonialInterval = setInterval(nextTestimonial, 4000); // Change every 4 seconds
}

function stopTestimonialSlideshow() {
    clearInterval(testimonialInterval);
}

// Initialize testimonials slideshow
if (testimonialSlides.length > 0) {
    testimonialButtons.forEach((btn, index) => {
        btn.addEventListener('click', () => {
            showTestimonial(index);
            stopTestimonialSlideshow();
            startTestimonialSlideshow(); // Restart timer
        });
    });
    
    // Auto-start testimonials slideshow
    startTestimonialSlideshow();
    
    // Pause on hover
    const testimonialsSection = document.querySelector('.testimonials');
    if (testimonialsSection) {
        testimonialsSection.addEventListener('mouseenter', stopTestimonialSlideshow);
        testimonialsSection.addEventListener('mouseleave', startTestimonialSlideshow);
    }
}

// Enhanced smooth scrolling with offset for fixed header
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            const offsetTop = target.offsetTop - 80; // Account for header height
            window.scrollTo({
                top: offsetTop,
                behavior: 'smooth'
            });
            // Close mobile menu if open
            navMenu.classList.remove('active');
        }
    });
});

// Add scroll-triggered animations for new sections
const observeOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const sectionObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            
            // Start testimonials slideshow when section becomes visible
            if (entry.target.classList.contains('testimonials') && testimonialSlides.length > 0) {
                startTestimonialSlideshow();
            }
        }
    });
}, observeOptions);

// Observe all fade-in elements
document.querySelectorAll('.fade-in').forEach(el => {
    sectionObserver.observe(el);
});

// Add loading animation for new content
window.addEventListener('load', () => {
    // Animate resource cards on load
    const resourceCards = document.querySelectorAll('.resource-card');
    resourceCards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'opacity 0.6s, transform 0.6s';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        }, index * 200);
    });
});

// Image loading effects
function addImageLoadingEffects() {
    const images = document.querySelectorAll('img[loading="lazy"]');
    
    images.forEach(img => {
        img.style.opacity = '0';
        img.style.transition = 'opacity 0.5s ease';
        
        if (img.complete) {
            img.style.opacity = '1';
        } else {
            img.addEventListener('load', () => {
                img.style.opacity = '1';
            });
        }
    });
}

// Initialize image effects
addImageLoadingEffects();

// Loading overlay management
function hideLoadingOverlay() {
    const loadingOverlay = document.getElementById('loadingOverlay');
    if (loadingOverlay) {
        loadingOverlay.classList.add('hidden');
    }
}

// Multiple event listeners to ensure loading overlay is hidden
document.addEventListener('DOMContentLoaded', hideLoadingOverlay);
window.addEventListener('load', hideLoadingOverlay);

// Immediate hide for subpages (fallback)
setTimeout(hideLoadingOverlay, 100);

// Performance optimization for images
document.addEventListener('DOMContentLoaded', () => {
    // Preload critical images
    const criticalImages = [
        'https://images.unsplash.com/photo-1544027993-37dbfe43562a?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
        'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80',
        'https://images.unsplash.com/photo-1559827260-dc66d52bef19?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80'
    ];
    
    criticalImages.forEach(src => {
        const img = new Image();
        img.src = src;
    });
});

// Enhanced accessibility and user experience features
document.addEventListener('DOMContentLoaded', function() {
    // Add ARIA labels for better accessibility
    const slideButtons = document.querySelectorAll('.slide-btn');
    slideButtons.forEach((btn, index) => {
        btn.setAttribute('aria-label', `Du-te la diapozitivul ${index + 1}`);
        btn.setAttribute('role', 'button');
    });
    
    const programButtons = document.querySelectorAll('.program-btn');
    programButtons.forEach((btn, index) => {
        btn.setAttribute('aria-label', `Vezi programul ${btn.textContent}`);
    });
    
    const testimonialButtons = document.querySelectorAll('.testimonial-btn');
    testimonialButtons.forEach((btn, index) => {
        btn.setAttribute('aria-label', `Citește testimonialul ${index + 1}`);
        btn.setAttribute('role', 'button');
    });
    
    // Enhanced form validation with better user feedback
    const form = document.getElementById('contactForm');
    const formInputs = form.querySelectorAll('input, textarea, select');
    
    formInputs.forEach(input => {
        input.addEventListener('blur', validateField);
        input.addEventListener('input', clearError);
        input.addEventListener('change', clearError); // For select elements
    });
    
    function validateField(e) {
        const field = e.target;
        const value = field.value.trim();
        
        // Remove existing error styling
        field.classList.remove('error');
        
        if (field.required && !value) {
            showFieldError(field, 'Acest câmp este obligatoriu');
        } else if (field.type === 'email' && value && !isValidEmail(value)) {
            showFieldError(field, 'Vă rugăm să introduceți o adresă de email validă');
        } else if (field.type === 'tel' && value && !isValidPhone(value)) {
            showFieldError(field, 'Vă rugăm să introduceți un număr de telefon valid');
        }
    }
    
    function clearError(e) {
        const field = e.target;
        field.classList.remove('error');
        const errorMsg = field.parentNode.querySelector('.error-message');
        if (errorMsg) {
            errorMsg.remove();
        }
    }
    
    function showFieldError(field, message) {
        field.classList.add('error');
        
        // Remove existing error message
        const existingError = field.parentNode.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }
        
        // Add new error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message';
        errorDiv.textContent = message;
        errorDiv.style.color = '#ff6b6b';
        errorDiv.style.fontSize = '0.9rem';
        errorDiv.style.marginTop = '0.25rem';
        field.parentNode.appendChild(errorDiv);
    }
    
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    function isValidPhone(phone) {
        const phoneRegex = /^[\+]?[1-9][\d]{0,15}$/;
        const cleanPhone = phone.replace(/[\s\-\(\)]/g, '');
        return phoneRegex.test(cleanPhone);
    }
    
    // Keyboard navigation for slideshows
    document.addEventListener('keydown', function(e) {
        if (e.target.closest('.hero')) {
            if (e.key === 'ArrowLeft') {
                const prevSlide = currentSlide === 0 ? slides.length - 1 : currentSlide - 1;
                showSlide(prevSlide);
                stopSlideshow();
                startSlideshow();
            } else if (e.key === 'ArrowRight') {
                nextSlide();
                stopSlideshow();
                startSlideshow();
            }
        }
    });
    
    // Intersection observer for performance optimization
    const lazyElements = document.querySelectorAll('.fade-in');
    const lazyObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                lazyObserver.unobserve(entry.target);
            }
        });
    }, {
        rootMargin: '50px'
    });
    
    lazyElements.forEach(el => {
        lazyObserver.observe(el);
    });
    
    // Add smooth transitions for focus states
    const focusableElements = document.querySelectorAll('a, button, input, textarea');
    focusableElements.forEach(el => {
        el.addEventListener('focus', function() {
            this.style.outline = '2px solid #4a90e2';
            this.style.outlineOffset = '2px';
        });
        
        el.addEventListener('blur', function() {
            this.style.outline = '';
            this.style.outlineOffset = '';
        });
    });
});

// Performance monitoring
window.addEventListener('load', function() {
    // Simple performance logging
    if (window.performance && window.performance.timing) {
        const loadTime = window.performance.timing.loadEventEnd - window.performance.timing.navigationStart;
        console.log(`Page loaded in ${loadTime}ms`);
    }
    
    // Initialize all animations and slideshows after load
    setTimeout(() => {
        document.body.classList.add('loaded');
    }, 100);
});

// Parallax effect for hero section (temporarily disabled for debugging)
function addParallaxEffect() {
    // const hero = document.querySelector('.hero');
    // if (!hero) return;
    
    // window.addEventListener('scroll', () => {
    //     const scrolled = window.pageYOffset;
    //     const rate = scrolled * -0.5;
        
    //     if (scrolled < window.innerHeight) {
    //         hero.style.transform = `translateY(${rate}px)`;
    //     }
    // });
}

// Initialize parallax effect
addParallaxEffect();

// Add intersection observer for fade-in animations
function initializeIntersectionObserver() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    // Observe all elements with fade-in class
    document.querySelectorAll('.fade-in').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
}

// Initialize intersection observer
initializeIntersectionObserver();

// Gallery functionality
class Gallery {
    constructor() {
        console.log('Gallery class initialized');
        this.filterBtns = document.querySelectorAll('.filter-btn');
        this.galleryItems = document.querySelectorAll('.gallery-item');
        console.log('Found filter buttons:', this.filterBtns.length);
        console.log('Found gallery items:', this.galleryItems.length);
        this.modal = document.getElementById('galleryModal');
        this.modalImage = document.getElementById('modalImage');
        this.modalVideo = document.getElementById('modalVideo');
        this.modalTitle = document.getElementById('modalTitle');
        this.modalDescription = document.getElementById('modalDescription');
        this.modalClose = document.getElementById('modalClose');
        this.modalPrev = document.getElementById('modalPrev');
        this.modalNext = document.getElementById('modalNext');
        this.currentImageIndex = 0;
        this.filteredItems = Array.from(this.galleryItems);
        
        this.init();
    }
    
    init() {
        this.bindEvents();
        this.setInitialState();
    }
    
    bindEvents() {
        // Filter buttons
        this.filterBtns.forEach(btn => {
            btn.addEventListener('click', (e) => this.handleFilter(e));
        });
        
        // Gallery items
        this.galleryItems.forEach((item, index) => {
            item.addEventListener('click', () => this.openModal(index));
            
            // Add video preview on hover
            const video = item.querySelector('video');
            if (video) {
                item.addEventListener('mouseenter', () => {
                    video.play().catch(() => {
                        // Handle play promise rejection silently
                    });
                });
                
                item.addEventListener('mouseleave', () => {
                    video.pause();
                    video.currentTime = 0; // Reset to beginning
                });
            }
        });
        
        // Modal controls
        this.modalClose.addEventListener('click', () => this.closeModal());
        this.modalPrev.addEventListener('click', () => this.prevImage());
        this.modalNext.addEventListener('click', () => this.nextImage());
        
        // Modal backdrop click to close
        this.modal.querySelector('.modal-backdrop').addEventListener('click', () => this.closeModal());
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => this.handleKeyboard(e));
    }
    
    setInitialState() {
        // Set all items as initially visible
        this.filteredItems = Array.from(this.galleryItems);
    }
    
    handleFilter(e) {
        const filter = e.target.dataset.filter;
        console.log('Filter clicked:', filter);
        
        // Update active button
        this.filterBtns.forEach(btn => btn.classList.remove('active'));
        e.target.classList.add('active');
        
        // Filter items
        this.filteredItems = [];
        this.galleryItems.forEach((item, index) => {
            const category = item.dataset.category;
            const type = item.dataset.type;
            let shouldShow = false;
            
            if (filter === 'all') {
                shouldShow = true;
            } else if (filter === 'videos') {
                shouldShow = type === 'video';
            } else {
                shouldShow = category === filter;
            }
            
            console.log(`Item ${index}: category=${category}, type=${type}, shouldShow=${shouldShow}`);
            
            if (shouldShow) {
                item.style.display = 'block';
                item.style.animation = 'fadeInUp 0.5s ease forwards';
                this.filteredItems.push(item);
            } else {
                item.style.animation = 'fadeOut 0.3s ease forwards';
                setTimeout(() => {
                    item.style.display = 'none';
                }, 300);
            }
        });
        
        console.log('Filtered items count:', this.filteredItems.length);
        // Update indices for filtered items
        this.updateFilteredIndices();
    }
    
    updateFilteredIndices() {
        this.filteredItems.forEach((item, index) => {
            item.dataset.filteredIndex = index;
        });
    }
    
    openModal(index) {
        // Find the correct filtered index
        const clickedItem = this.galleryItems[index];
        const filteredIndex = this.filteredItems.indexOf(clickedItem);
        
        if (filteredIndex === -1) return;
        
        this.currentImageIndex = filteredIndex;
        this.updateModalContent();
        this.modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }
    
    closeModal() {
        this.modal.classList.remove('active');
        document.body.style.overflow = '';
        
        // Pause video if it's playing
        if (this.modalVideo && !this.modalVideo.paused) {
            this.modalVideo.pause();
        }
    }
    
    prevImage() {
        this.currentImageIndex = (this.currentImageIndex - 1 + this.filteredItems.length) % this.filteredItems.length;
        this.updateModalContent();
    }
    
    nextImage() {
        this.currentImageIndex = (this.currentImageIndex + 1) % this.filteredItems.length;
        this.updateModalContent();
    }
    
    updateModalContent() {
        const currentItem = this.filteredItems[this.currentImageIndex];
        const img = currentItem.querySelector('img');
        const video = currentItem.querySelector('video');
        const title = currentItem.querySelector('h3').textContent;
        const description = currentItem.querySelector('p').textContent;
        
        // Update title and description
        this.modalTitle.textContent = title;
        this.modalDescription.textContent = description;
        
        if (video) {
            // Show video, hide image
            this.modalVideo.style.display = 'block';
            this.modalImage.style.display = 'none';
            
            // Set video source
            const source = this.modalVideo.querySelector('source');
            source.src = video.src;
            this.modalVideo.load(); // Reload video with new source
            
            // Add loading state for video
            this.modalVideo.style.opacity = '0';
            this.modalVideo.addEventListener('loadedmetadata', () => {
                this.modalVideo.style.opacity = '1';
            }, { once: true });
        } else if (img) {
            // Show image, hide video
            this.modalImage.style.display = 'block';
            this.modalVideo.style.display = 'none';
            
            // Pause video if it was playing
            this.modalVideo.pause();
            
            this.modalImage.src = img.src;
            this.modalImage.alt = img.alt;
            
            // Add loading state for image
            this.modalImage.style.opacity = '0';
            this.modalImage.onload = () => {
                this.modalImage.style.opacity = '1';
            };
        }
    }
    
    handleKeyboard(e) {
        if (!this.modal.classList.contains('active')) return;
        
        switch(e.key) {
            case 'Escape':
                this.closeModal();
                break;
            case 'ArrowLeft':
                this.prevImage();
                break;
            case 'ArrowRight':
                this.nextImage();
                break;
            case ' ':
            case 'k':
                // Spacebar or 'k' to play/pause video
                if (this.modalVideo.style.display !== 'none') {
                    e.preventDefault();
                    if (this.modalVideo.paused) {
                        this.modalVideo.play();
                    } else {
                        this.modalVideo.pause();
                    }
                }
                break;
            case 'f':
                // 'f' to toggle fullscreen for video
                if (this.modalVideo.style.display !== 'none') {
                    if (document.fullscreenElement) {
                        document.exitFullscreen();
                    } else {
                        this.modalVideo.requestFullscreen().catch(() => {
                            // Handle fullscreen request failure silently
                        });
                    }
                }
                break;
        }
    }
}

// Initialize gallery when DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.gallery')) {
        new Gallery();
    }
});

// Add CSS animations for gallery filtering
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: scale(1);
        }
        to {
            opacity: 0;
            transform: scale(0.8);
        }
    }
`;
document.head.appendChild(style);

// Gallery Preview Slideshow functionality
class GallerySlideshow {
    constructor() {
        this.gallerySlides = document.querySelectorAll('.gallery-slide');
        this.gallerySlideButtons = document.querySelectorAll('.gallery-slide-btn');
        this.currentGallerySlide = 0;
        this.gallerySlideInterval = null;
        
        if (this.gallerySlides.length > 0) {
            this.init();
        }
    }
    
    init() {
        this.bindEvents();
        this.startGallerySlideshow();
    }
    
    bindEvents() {
        // Gallery slide button clicks
        this.gallerySlideButtons.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                this.showGallerySlide(index);
                this.stopGallerySlideshow();
                this.startGallerySlideshow(); // Restart timer
            });
        });
        
        // Navigation button clicks
        const prevBtn = document.getElementById('galleryPrevBtn');
        const nextBtn = document.getElementById('galleryNextBtn');
        
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                this.prevGallerySlide();
                this.stopGallerySlideshow();
                this.startGallerySlideshow(); // Restart timer
            });
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                this.nextGallerySlide();
                this.stopGallerySlideshow();
                this.startGallerySlideshow(); // Restart timer
            });
        }
        
        // Pause on hover
        const gallerySlideshow = document.querySelector('.gallery-slideshow');
        if (gallerySlideshow) {
            gallerySlideshow.addEventListener('mouseenter', () => this.stopGallerySlideshow());
            gallerySlideshow.addEventListener('mouseleave', () => this.startGallerySlideshow());
        }
        
        // Touch/swipe support for mobile
        this.addTouchSupport();
        
        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.target.closest('.gallery-slideshow')) {
                if (e.key === 'ArrowLeft') {
                    this.prevGallerySlide();
                    this.stopGallerySlideshow();
                    this.startGallerySlideshow();
                } else if (e.key === 'ArrowRight') {
                    this.nextGallerySlide();
                    this.stopGallerySlideshow();
                    this.startGallerySlideshow();
                }
            }
        });
    }
    
    showGallerySlide(index) {
        // Remove active class from all slides and buttons
        this.gallerySlides.forEach(slide => slide.classList.remove('active'));
        this.gallerySlideButtons.forEach(btn => btn.classList.remove('active'));
        
        // Add active class to current slide and button
        if (this.gallerySlides[index]) {
            this.gallerySlides[index].classList.add('active');
        }
        if (this.gallerySlideButtons[index]) {
            this.gallerySlideButtons[index].classList.add('active');
        }
        
        this.currentGallerySlide = index;
    }
    
    nextGallerySlide() {
        this.currentGallerySlide = (this.currentGallerySlide + 1) % this.gallerySlides.length;
        this.showGallerySlide(this.currentGallerySlide);
    }
    
    prevGallerySlide() {
        this.currentGallerySlide = (this.currentGallerySlide - 1 + this.gallerySlides.length) % this.gallerySlides.length;
        this.showGallerySlide(this.currentGallerySlide);
    }
    
    startGallerySlideshow() {
        this.gallerySlideInterval = setInterval(() => {
            this.nextGallerySlide();
        }, 4000); // Change slide every 4 seconds
    }
    
    stopGallerySlideshow() {
        if (this.gallerySlideInterval) {
            clearInterval(this.gallerySlideInterval);
            this.gallerySlideInterval = null;
        }
    }
    
    addTouchSupport() {
        const gallerySlideshow = document.querySelector('.gallery-slideshow');
        if (!gallerySlideshow) return;
        
        let startX = 0;
        let endX = 0;
        
        gallerySlideshow.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
        });
        
        gallerySlideshow.addEventListener('touchmove', (e) => {
            endX = e.touches[0].clientX;
        });
        
        gallerySlideshow.addEventListener('touchend', () => {
            const threshold = 50; // Minimum swipe distance
            const distance = startX - endX;
            
            if (Math.abs(distance) > threshold) {
                if (distance > 0) {
                    // Swiped left - next slide
                    this.nextGallerySlide();
                } else {
                    // Swiped right - previous slide
                    this.prevGallerySlide();
                }
                this.stopGallerySlideshow();
                this.startGallerySlideshow();
            }
        });
    }
}

// Initialize gallery slideshow on DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    new GallerySlideshow();
});

// Header Audio Player Functionality
document.addEventListener('DOMContentLoaded', function() {
    const audioButtons = document.querySelectorAll('#audioBtn');
    const audioElement = document.getElementById('audioElement');
    const lyricsButtons = document.querySelectorAll('#lyricsBtn');
    const lyricsModal = document.getElementById('lyricsModal');
    const lyricsCloseButtons = document.querySelectorAll('#lyricsCloseBtn');

    // Return early if elements are not found
    if (audioButtons.length === 0 || !audioElement || lyricsButtons.length === 0 || !lyricsModal || lyricsCloseButtons.length === 0) {
        console.log('Audio player elements not found');
        return;
    }

    // Initialize audio state
    let isPlaying = false;

    // Set initial volume
    audioElement.volume = 0.7;

    // Function to update all audio buttons
    function updateAudioButtons(playing) {
        audioButtons.forEach(btn => {
            if (playing) {
                btn.innerHTML = '<i class="fas fa-pause"></i><span>Imn</span>';
            } else {
                btn.innerHTML = '<i class="fas fa-music"></i><span>Imn</span>';
            }
        });
    }

    // Add event listeners to all audio buttons
    audioButtons.forEach(audioBtn => {
        audioBtn.addEventListener('click', function() {
            if (isPlaying) {
                audioElement.pause();
            } else {
                audioElement.play();
            }
        });
    });

    // Update button state based on audio events
    audioElement.addEventListener('play', function() {
        isPlaying = true;
        updateAudioButtons(true);
    });

    audioElement.addEventListener('pause', function() {
        isPlaying = false;
        updateAudioButtons(false);
    });

    audioElement.addEventListener('ended', function() {
        isPlaying = false;
        updateAudioButtons(false);
    });

    // Add event listeners to all lyrics buttons
    lyricsButtons.forEach(lyricsBtn => {
        lyricsBtn.addEventListener('click', function() {
            lyricsModal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    // Add event listeners to all lyrics close buttons
    lyricsCloseButtons.forEach(lyricsCloseBtn => {
        lyricsCloseBtn.addEventListener('click', closeLyricsModal);
    });

    lyricsModal.addEventListener('click', function(e) {
        if (e.target === lyricsModal) {
            closeLyricsModal();
        }
    });

    function closeLyricsModal() {
        lyricsModal.classList.remove('active');
        document.body.style.overflow = '';
    }

    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Close lyrics modal with Escape key
        if (e.key === 'Escape' && lyricsModal.classList.contains('active')) {
            closeLyricsModal();
        }
        // Space bar to play/pause (only when not focused on input elements)
        if (e.code === 'Space' && !['INPUT', 'TEXTAREA', 'BUTTON'].includes(document.activeElement.tagName)) {
            e.preventDefault();
            audioBtn.click();
        }
    });

    // Handle audio loading errors
    audioElement.addEventListener('error', function() {
        console.error('Audio loading error:', audioElement.error);
        audioBtn.innerHTML = '<i class="fas fa-exclamation-triangle"></i><span>Eroare</span>';
        audioBtn.disabled = true;
        audioBtn.title = 'Eroare la încărcarea audio-ului';
    });
});

// Language Selector Functionality
document.addEventListener('DOMContentLoaded', function() {
    const languageSelectors = document.querySelectorAll('.language-selector');
    
    languageSelectors.forEach(languageSelector => {
        const languageToggle = languageSelector.querySelector('.language-toggle');
        const languageDropdown = languageSelector.querySelector('.language-dropdown');
        
        if (languageToggle && languageDropdown) {
            // Toggle language dropdown
            languageToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Close other open selectors
                languageSelectors.forEach(otherSelector => {
                    if (otherSelector !== languageSelector) {
                        otherSelector.classList.remove('active');
                    }
                });
                
                languageSelector.classList.toggle('active');
            });
            
            // Handle language option selection
            const languageOptions = languageDropdown.querySelectorAll('.language-option');
            languageOptions.forEach(option => {
                option.addEventListener('click', function(e) {
                    e.preventDefault();
                    const href = this.getAttribute('href');
                    if (href) {
                        // Add a subtle loading effect
                        this.style.opacity = '0.7';
                        setTimeout(() => {
                            window.location.href = href;
                        }, 150);
                    }
                });
            });
        }
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        languageSelectors.forEach(languageSelector => {
            if (!languageSelector.contains(e.target)) {
                languageSelector.classList.remove('active');
            }
        });
    });
    
    // Close dropdown when pressing escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            languageSelectors.forEach(languageSelector => {
                languageSelector.classList.remove('active');
            });
        }
    });
});

// Add slide-in animation keyframes via JavaScript (since we can't modify the CSS file structure)
// const style = document.createElement('style');
// style.textContent = `
//     @keyframes slideInFromRight {
//         from {
//             transform: translateX(100%);
//             opacity: 0;
//         }
//         to {
//             transform: translateX(0);
//             opacity: 1;
//         }
//     }
// `;
// document.head.appendChild(style);

// Organigrama functionality - Make image clickable for better viewing
document.addEventListener('DOMContentLoaded', function() {
    const organigramaImage = document.querySelector('.organigrama-image');
    
    if (organigramaImage) {
        // Add click handler to open image in modal
        organigramaImage.addEventListener('click', function() {
            openOrganigramaModal(this);
        });
        
        // Add keyboard support
        organigramaImage.setAttribute('tabindex', '0');
        organigramaImage.setAttribute('role', 'button');
        organigramaImage.setAttribute('aria-label', 'Deschide organigrama într-o fereastră mai mare');
        
        organigramaImage.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                openOrganigramaModal(this);
            }
        });
    }
});

// Function to open organigrama modal
function openOrganigramaModal(imageElement) {
    // Create modal if it doesn't exist
    let modal = document.getElementById('organigramaModal');
    if (!modal) {
        modal = createOrganigramaModal();
    }
    
    // Get image source and alt text
    const imageSrc = imageElement.src;
    const imageAlt = imageElement.alt;
    
    // Set modal image
    const modalImage = modal.querySelector('#organigramaModalImage');
    modalImage.src = imageSrc;
    modalImage.alt = imageAlt;
    
    // Show modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Focus on close button for accessibility
    setTimeout(() => {
        modal.querySelector('#organigramaModalClose').focus();
    }, 100);
}

// Function to create organigrama modal
function createOrganigramaModal() {
    const modal = document.createElement('div');
    modal.id = 'organigramaModal';
    modal.className = 'organigrama-modal';
    modal.innerHTML = `
        <div class="modal-backdrop"></div>
        <div class="organigrama-modal-content">
            <button class="modal-close" id="organigramaModalClose" aria-label="Închide organigrama">
                <i class="fas fa-times"></i>
            </button>
            <div class="organigrama-modal-header">
                <h3>Organigrama Instituției</h3>
            </div>
            <div class="organigrama-modal-image-container">
                <img id="organigramaModalImage" src="" alt="" loading="lazy">
            </div>
            <div class="organigrama-modal-footer">
                <p>Structura organizațională completă a Centrului de Plasament și Reabilitare pentru Copii de Vârstă Fragedă din municipiul Chișinău.</p>
            </div>
        </div>
    `;
    
    document.body.appendChild(modal);
    
    // Add event listeners
    const closeBtn = modal.querySelector('#organigramaModalClose');
    const backdrop = modal.querySelector('.modal-backdrop');
    
    closeBtn.addEventListener('click', closeOrganigramaModal);
    backdrop.addEventListener('click', closeOrganigramaModal);
    
    // Keyboard support
    document.addEventListener('keydown', function(e) {
        if (modal.classList.contains('active') && e.key === 'Escape') {
            closeOrganigramaModal();
        }
    });
    
    return modal;
}

// Function to close organigrama modal
function closeOrganigramaModal() {
    const modal = document.getElementById('organigramaModal');
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = '';
        
        // Return focus to the original image
        const organigramaImage = document.querySelector('.organigrama-image');
        if (organigramaImage) {
            organigramaImage.focus();
        }
    }
}

// Petition Form Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Entity type handling
    const entityTypeRadios = document.querySelectorAll('input[name="entity_type"]');
    const legalEntityFields = document.getElementById('legalEntityFields');
    const individualFields = document.getElementById('individualFields');
    
    if (entityTypeRadios.length > 0) {
        entityTypeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'legal') {
                    legalEntityFields.style.display = 'block';
                    individualFields.style.display = 'none';
                } else if (this.value === 'individual') {
                    legalEntityFields.style.display = 'none';
                    individualFields.style.display = 'block';
                }
            });
        });
    }
    
    // File upload handling
    const petitionFileInput = document.getElementById('petition_file');
    const additionalFilesInput = document.getElementById('additional_files');
    
    if (petitionFileInput) {
        petitionFileInput.addEventListener('change', function() {
            validatePetitionFile(this);
        });
    }
    
    if (additionalFilesInput) {
        additionalFilesInput.addEventListener('change', function() {
            validateAdditionalFiles(this);
        });
    }
    
    // Form validation
    const petitionForm = document.getElementById('petitionForm');
    if (petitionForm) {
        petitionForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            if (validateForm()) {
                // Show loading state
                const submitBtn = this.querySelector('.submit-btn');
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Se trimite...';
                submitBtn.disabled = true;
                
                try {
                    // Prepare form data
                    const formData = new FormData(this);
                    
                    // Submit form
                    const response = await fetch('handlers/petition-form.php', {
                        method: 'POST',
                        body: formData
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        showSubmissionMessage(result.message);
                    } else {
                        showErrorMessage('Eroare: ' + result.message);
                    }
                } catch (error) {
                    console.error('Error submitting petition:', error);
                    showErrorMessage('A apărut o eroare la trimiterea petiției. Vă rugăm să încercați din nou.');
                } finally {
                    // Reset button state
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            }
        });
    }
});

function validatePetitionFile(input) {
    const file = input.files[0];
    const maxSize = 15 * 1024 * 1024; // 15MB in bytes
    
    if (file) {
        // Check file type
        if (file.type !== 'application/pdf') {
            showErrorMessage('Fișierul petițiilor trebuie să fie în format PDF.');
            input.value = '';
            return false;
        }
        
        // Check file size
        if (file.size > maxSize) {
            showErrorMessage('Fișierul petițiilor nu poate depăși 15 MB.');
            input.value = '';
            return false;
        }
        
        updateFileUploadDisplay(input, file.name);
        return true;
    }
    
    return false;
}

function validateAdditionalFiles(input) {
    const files = Array.from(input.files);
    const maxFiles = 3;
    const maxSize = 10 * 1024 * 1024; // 10MB per file
    const allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip'];
    
    if (files.length > maxFiles) {
        showErrorMessage(`Puteți încărca maximum ${maxFiles} fișiere suplimentare.`);
        input.value = '';
        return false;
    }
    
    for (let file of files) {
        // Check file type
        if (!allowedTypes.includes(file.type)) {
            showErrorMessage('Fișierele suplimentare trebuie să fie în format PDF, DOC sau ZIP.');
            input.value = '';
            return false;
        }
        
        // Check file size
        if (file.size > maxSize) {
            showErrorMessage('Fiecare fișier suplimentar nu poate depăși 10 MB.');
            input.value = '';
            return false;
        }
    }
    
    if (files.length > 0) {
        const fileNames = files.map(f => f.name).join(', ');
        updateFileUploadDisplay(input, fileNames);
    }
    
    return true;
}

function updateFileUploadDisplay(input, fileName) {
    const wrapper = input.closest('.file-upload-wrapper');
    const info = wrapper.querySelector('.file-upload-info span');
    
    if (info) {
        info.textContent = fileName;
        wrapper.style.borderColor = '#4a90e2';
        wrapper.style.backgroundColor = 'rgba(74, 144, 226, 0.1)';
    }
}

function validateForm() {
    let isValid = true;
    const requiredFields = document.querySelectorAll('input[required], textarea[required]');
    
    // Check required fields
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            showFieldError(field, 'Acest câmp este obligatoriu.');
            isValid = false;
        } else {
            clearFieldError(field);
        }
    });
    
    // Check email format
    const emailField = document.getElementById('email');
    if (emailField && emailField.value) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(emailField.value)) {
            showFieldError(emailField, 'Introduceți o adresă de email validă.');
            isValid = false;
        }
    }
    
    // Check phone format
    const phoneField = document.getElementById('phone');
    if (phoneField && phoneField.value) {
        const phoneRegex = /^(\+373|373)?[0-9]{8}$/;
        if (!phoneRegex.test(phoneField.value.replace(/\s/g, ''))) {
            showFieldError(phoneField, 'Introduceți un număr de telefon valid.');
            isValid = false;
        }
    }
    
    // Check consent checkboxes
    const consentBoxes = document.querySelectorAll('input[type="checkbox"][required]');
    consentBoxes.forEach(checkbox => {
        if (!checkbox.checked) {
            showFieldError(checkbox, 'Acordul este obligatoriu.');
            isValid = false;
        }
    });
    
    return isValid;
}

function showFieldError(field, message) {
    clearFieldError(field);
    
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.textContent = message;
    errorDiv.style.color = '#ff6b6b';
    errorDiv.style.fontSize = '0.85rem';
    errorDiv.style.marginTop = '0.25rem';
    
    field.style.borderColor = '#ff6b6b';
    
    if (field.type === 'checkbox') {
        field.closest('.checkbox-option').appendChild(errorDiv);
    } else {
        field.parentNode.appendChild(errorDiv);
    }
}

function clearFieldError(field) {
    const existingError = field.parentNode.querySelector('.field-error') || 
                         field.closest('.checkbox-option')?.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
    field.style.borderColor = '';
}

function showErrorMessage(message) {
    // Create and show error notification
    const notification = createNotification(message, 'error');
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 5000);
}

function showSubmissionMessage(customMessage = null) {
    const message = customMessage || 'Petiția a fost trimisă cu succes! Veți primi o confirmare pe email în curând.';
    const notification = createNotification(message, 'success');
    document.body.appendChild(notification);
    
    // Reset form
    const form = document.getElementById('petitionForm');
    if (form) {
        form.reset();
    }
    
    // Hide conditional fields
    const legalEntityFields = document.getElementById('legalEntityFields');
    const individualFields = document.getElementById('individualFields');
    if (legalEntityFields) legalEntityFields.style.display = 'none';
    if (individualFields) individualFields.style.display = 'none';
    
    setTimeout(() => {
        notification.remove();
    }, 7000);
}

function createNotification(message, type) {
    const notification = document.createElement('div');
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        color: white;
        font-weight: 500;
        z-index: 10000;
        max-width: 400px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        animation: slideIn 0.3s ease-out;
    `;
    
    if (type === 'error') {
        notification.style.background = 'linear-gradient(135deg, #ff6b6b, #ff5252)';
    } else {
        notification.style.background = 'linear-gradient(135deg, #4a90e2, #357abd)';
    }
    
    notification.textContent = message;
    
    // Add slide-in animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideIn {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    `;
    document.head.appendChild(style);
    
    return notification;
}

// About Section Tab Functionality
document.addEventListener('DOMContentLoaded', function() {
    const aboutTabBtns = document.querySelectorAll('.about-tab-btn');
    const aboutTabContents = document.querySelectorAll('.about-tab-content');
    
    function switchAboutTab(targetTab) {
        // Remove active class from all buttons and content
        aboutTabBtns.forEach(btn => btn.classList.remove('active'));
        aboutTabContents.forEach(content => content.classList.remove('active'));
        
        // Add active class to clicked button and corresponding content
        const targetBtn = document.querySelector(`[data-tab="${targetTab}"]`);
        const targetContent = document.getElementById(targetTab);
        
        if (targetBtn && targetContent) {
            targetBtn.classList.add('active');
            targetContent.classList.add('active');
        }
    }
    
    // Add click event listeners to tab buttons
    aboutTabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            switchAboutTab(targetTab);
        });
    });
    
    // Initialize with first tab active
    if (aboutTabBtns.length > 0) {
        switchAboutTab('about-us');
    }
});