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

// Start counters when stats section is visible
const statsSection = document.querySelector('.stats');
const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            animateCounter(document.getElementById('stat1'), 1234);
            animateCounter(document.getElementById('stat2'), 1432);
            animateCounter(document.getElementById('stat3'), 876);
            animateCounter(document.getElementById('stat4'), 50);
            statsObserver.unobserve(entry.target);
        }
    });
});

if (statsSection) {
    statsObserver.observe(statsSection);
}

// Contact form handling
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', event => {
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
        const submitBtn = document.querySelector('.submit-btn');
        const originalText = submitBtn.innerHTML;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Se trimite...';
        submitBtn.disabled = true;
        
        // Simulate form submission with delay
        setTimeout(() => {
            alert('Mulțumim pentru mesajul dumneavoastră. Vă vom contacta în cel mult 24 de ore.');
            this.reset();
            
            // Reset button state
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }, 2000);
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
            const shouldShow = filter === 'all' || category === filter;
            console.log(`Item ${index}: category=${category}, shouldShow=${shouldShow}`);
            
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
        const title = currentItem.querySelector('h3').textContent;
        const description = currentItem.querySelector('p').textContent;
        
        this.modalImage.src = img.src;
        this.modalImage.alt = img.alt;
        this.modalTitle.textContent = title;
        this.modalDescription.textContent = description;
        
        // Add loading state
        this.modalImage.style.opacity = '0';
        this.modalImage.onload = () => {
            this.modalImage.style.opacity = '1';
        };
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
    const languageToggle = document.getElementById('languageToggle');
    const languageDropdown = document.getElementById('languageDropdown');
    const languageSelector = document.querySelector('.language-selector');
    
    if (languageToggle && languageDropdown && languageSelector) {
        // Toggle language dropdown
        languageToggle.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            languageSelector.classList.toggle('active');
        });
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(e) {
            if (!languageSelector.contains(e.target)) {
                languageSelector.classList.remove('active');
            }
        });
        
        // Close dropdown when pressing escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                languageSelector.classList.remove('active');
            }
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