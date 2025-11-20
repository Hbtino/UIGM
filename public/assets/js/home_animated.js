/**
 * HOME ANIMATED JAVASCRIPT
 * Animasi interaktif untuk Landing Page GreenMetric
 */

// Initialize animations when DOM is loaded
document.addEventListener('DOMContentLoaded', function () {

    // Create particles
    createParticles();

    // Create falling leaves
    createFallingLeaves();

    // Animate elements on scroll
    animateOnScroll();

    // Add hover effects
    addHoverEffects();

    // Counter animation
    animateCounters();
});

/**
 * Create floating particles in hero section
 */
function createParticles() {
    const heroSection = document.querySelector('.hero-section');
    if (!heroSection) return;

    const particlesContainer = document.createElement('div');
    particlesContainer.className = 'particles';

    for (let i = 0; i < 5; i++) {
        const particle = document.createElement('div');
        particle.className = 'particle';
        particlesContainer.appendChild(particle);
    }

    heroSection.appendChild(particlesContainer);
}

/**
 * Create falling leaves animation
 */
function createFallingLeaves() {
    const heroSection = document.querySelector('.hero-section');
    if (!heroSection) return;

    const leafContainer = document.createElement('div');
    leafContainer.className = 'leaf-container';

    const leafIcons = ['🍃', '🌿', '🍀', '🌱'];

    for (let i = 0; i < 6; i++) {
        const leaf = document.createElement('div');
        leaf.className = 'leaf';
        leaf.textContent = leafIcons[Math.floor(Math.random() * leafIcons.length)];
        leafContainer.appendChild(leaf);
    }

    heroSection.appendChild(leafContainer);
}

/**
 * Animate elements when they come into view
 */
function animateOnScroll() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('fade-in-up');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all content sections
    document.querySelectorAll('.content-section').forEach(section => {
        observer.observe(section);
    });

    // Observe cards and boxes
    document.querySelectorAll('.content-placeholder, .ui-greenmetric-box').forEach(element => {
        observer.observe(element);
    });
}

/**
 * Add hover effects to interactive elements
 */
function addHoverEffects() {
    // Add pulse effect to icons
    document.querySelectorAll('.fas, .fab').forEach(icon => {
        icon.addEventListener('mouseenter', function () {
            this.classList.add('pulse-icon');
        });

        icon.addEventListener('animationend', function () {
            this.classList.remove('pulse-icon');
        });
    });

    // Add shake effect to buttons (except login button)
    document.querySelectorAll('.btn:not(.btn-login)').forEach(button => {
        button.addEventListener('mouseenter', function () {
            this.classList.add('shake');
        });

        button.addEventListener('animationend', function () {
            this.classList.remove('shake');
        });
    });
}

/**
 * Animate number counters
 */
function animateCounters() {
    const counters = document.querySelectorAll('[data-count]');

    counters.forEach(counter => {
        const target = parseInt(counter.getAttribute('data-count'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;

        const updateCounter = () => {
            current += increment;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };

        // Start animation when element is in view
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCounter();
                    observer.unobserve(entry.target);
                }
            });
        });

        observer.observe(counter);
    });
}

/**
 * Parallax effect on scroll
 */
window.addEventListener('scroll', function () {
    const scrolled = window.pageYOffset;
    const parallaxElements = document.querySelectorAll('[data-parallax]');

    parallaxElements.forEach(element => {
        const speed = element.getAttribute('data-parallax') || 0.5;
        element.style.transform = `translateY(${scrolled * speed}px)`;
    });
});

/**
 * Add ripple effect to buttons (except login button)
 */
document.querySelectorAll('.btn:not(.btn-login)').forEach(button => {
    button.addEventListener('click', function (e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;

        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');

        this.appendChild(ripple);

        setTimeout(() => ripple.remove(), 600);
    });
});

/**
 * Smooth reveal animation for images
 */
document.querySelectorAll('img').forEach(img => {
    img.addEventListener('load', function () {
        this.classList.add('fade-in');
    });
});

/**
 * Add typing effect to specific elements
 */
function typeWriter(element, text, speed = 50) {
    let i = 0;
    element.textContent = '';

    function type() {
        if (i < text.length) {
            element.textContent += text.charAt(i);
            i++;
            setTimeout(type, speed);
        }
    }

    type();
}

// Apply typing effect to hero title
const heroTitle = document.querySelector('.hero-section h1');
if (heroTitle) {
    const originalText = heroTitle.textContent;
    heroTitle.textContent = '';
    setTimeout(() => typeWriter(heroTitle, originalText, 50), 500);
}

/**
 * Add glow effect on hover to specific elements
 */
document.querySelectorAll('.ui-greenmetric-box, .section-title').forEach(element => {
    element.addEventListener('mouseenter', function () {
        this.classList.add('glow');
    });

    element.addEventListener('mouseleave', function () {
        this.classList.remove('glow');
    });
});

/**
 * Create floating action button animation
 */
const scrollTopBtn = document.getElementById('scrollTop');
if (scrollTopBtn) {
    scrollTopBtn.addEventListener('click', function () {
        this.classList.add('bounce');
        setTimeout(() => this.classList.remove('bounce'), 1000);
    });
}

/**
 * Add wave animation to nav menu items
 */
document.querySelectorAll('.nav-menu li a').forEach((link, index) => {
    link.style.animationDelay = `${index * 0.1}s`;
    link.classList.add('fade-in-down');
});

/**
 * Lazy load images
 */
const lazyImages = document.querySelectorAll('img[data-src]');
const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const img = entry.target;
            img.src = img.dataset.src;
            img.classList.add('fade-in');
            observer.unobserve(img);
        }
    });
});

lazyImages.forEach(img => imageObserver.observe(img));

console.log('🌿 GreenMetric Animations Loaded Successfully!');
