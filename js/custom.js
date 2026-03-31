/* 
    VIVA ENGINEERING - Centralized JavaScript Engine
    Standardizing animations and interactions
*/

document.addEventListener('DOMContentLoaded', function() {
    initLenis();
    initAOS();
    initGSAP();
    initBackToTop();
    initMicroInteractions();
    
    // Page Specific Initializations
    if (document.querySelector('.hero-section')) {
        initIndexAnimations();
    }
    
    if (document.querySelector('.globe-container')) {
        initAboutPageAnimations();
    }

    if (document.getElementById('main-image')) {
        initProductDetail();
    }

    if (document.getElementById('contact-form')) {
        initContactForm();
    }
    
    if (document.querySelector('.faq-question')) {
        initFAQs();
    }

    if (document.querySelector('.filter-btn') || document.querySelector('.gallery-item')) {
        initGallery();
    }
});

/**
 * Initialize Lenis Smooth Scroll
 */
function initLenis() {
    if (typeof Lenis !== 'undefined') {
        const lenis = new Lenis({
            duration: 1.2,
            easing: (t) => Math.min(1, 1.001 - Math.pow(2, -10 * t)),
            smoothWheel: true
        });

        function raf(time) {
            lenis.raf(time);
            requestAnimationFrame(raf);
        }
        requestAnimationFrame(raf);
    }
}

/**
 * Initialize AOS (Animate On Scroll)
 */
function initAOS() {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            once: true,
            offset: 100,
            easing: 'ease-out-cubic'
        });
    }
}

/**
 * Initialize GSAP Animations
 */
function initGSAP() {
    if (typeof gsap !== 'undefined') {
        gsap.registerPlugin(ScrollTrigger);
        
        // Horizontal reveal animation for sections
        gsap.utils.toArray('.reveal-x').forEach(elem => {
            gsap.from(elem, {
                x: -50,
                opacity: 0,
                duration: 1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: elem,
                    start: 'top 85%'
                }
            });
        });

        // Vertical reveal animation for elements
        gsap.utils.toArray('.reveal-y').forEach(elem => {
            gsap.from(elem, {
                y: 50,
                opacity: 0,
                duration: 1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: elem,
                    start: 'top 85%'
                }
            });
        });
    }
}

/**
 * Back to Top Button Logic
 */
function initBackToTop() {
    const backToTopBtn = document.getElementById('back-to-top');
    if (backToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopBtn.classList.remove('opacity-0', 'invisible');
                backToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                backToTopBtn.classList.remove('opacity-100', 'visible');
                backToTopBtn.classList.add('opacity-0', 'invisible');
            }
        });

        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
}

/**
 * Micro-interactions and effects
 */
function initMicroInteractions() {
    // Ripple effect on premium buttons
    document.querySelectorAll('.btn-premium').forEach(button => {
        button.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.3);
                transform: scale(0);
                animation: ripple 0.6s linear;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                pointer-events: none;
            `;
            
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });
}

// Navbar scroll effect: Gracefully shrink header on scroll
window.addEventListener('scroll', () => {
    const navInner = document.getElementById('navbar-inner');
    if (navInner) {
        if (window.scrollY > 50) {
            navInner.classList.replace('py-4', 'py-1');
        } else {
            navInner.classList.replace('py-1', 'py-4');
        }
    }
});

/**
 * Index Page Animations
 */
function initIndexAnimations() {
    if (typeof gsap !== 'undefined') {
        const tl = gsap.timeline();

        // Hero Reveal
        tl.to('.hero-section', { opacity: 1, duration: 1 })
          .from('.hero-badge', { y: 30, opacity: 0, duration: 0.6 }, "-=0.5")
          .from('.hero-heading span', { y: 50, opacity: 0, duration: 0.8, stagger: 0.2 }, "-=0.4")
          .from('.hero-description', { y: 30, opacity: 0, duration: 0.6 }, "-=0.4")
          .from('.hero-cta', { y: 30, opacity: 0, duration: 0.6 }, "-=0.4")
          .from('.stats-vertical', { x: 50, opacity: 0, duration: 0.8 }, "-=0.6");

        // Stat Counter Initialization
        const statItems = document.querySelectorAll('.stat-number');
        statItems.forEach(stat => {
            const target = parseInt(stat.getAttribute('data-value') || stat.getAttribute('data-target'));
            gsap.to(stat, {
                innerText: target,
                duration: 2,
                snap: { innerText: 1 },
                scrollTrigger: {
                    trigger: stat,
                    start: 'top 90%'
                }
            });
        });

        // About Image Parallax Logic
        gsap.to('.about-image img', {
            y: -50,
            scrollTrigger: {
                trigger: '.about-image',
                scrub: true
            }
        });
    }
}

/**
 * Product Detail Interactions
 */
function initProductDetail() {
    const mainImage = document.getElementById('main-image');
    const thumbnails = document.querySelectorAll('.thumbnail-item');
    
    if (!mainImage) return;

    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            const newSrc = this.dataset.image;
            
            // Animation for main image change
            gsap.to(mainImage, {
                opacity: 0,
                scale: 0.95,
                duration: 0.3,
                onComplete: () => {
                    mainImage.src = newSrc;
                    gsap.to(mainImage, {
                        opacity: 1,
                        scale: 1,
                        duration: 0.4
                    });
                }
            });
            
            // Update active thumbnail
            thumbnails.forEach(t => t.classList.remove('border-orange-600', 'animate-pulse-glow'));
            this.classList.add('border-orange-600', 'animate-pulse-glow');
        });
    });
}

/**
 * FAQ Toggles
 */
function initFAQs() {
    document.querySelectorAll('.faq-question').forEach(btn => {
        btn.addEventListener('click', () => {
            const answer = btn.nextElementSibling;
            const icon = btn.querySelector('i');
            
            // Toggle active class
            answer.classList.toggle('active');
            
            // Rotate icon
            if (answer.classList.contains('active')) {
                gsap.to(icon, { rotation: 180, duration: 0.3 });
                answer.classList.remove('hidden');
            } else {
                gsap.to(icon, { rotation: 0, duration: 0.3 });
            }
        });
    });
}

/**
 * Contact Form Handling
 */
function initContactForm() {
    const form = document.getElementById('contact-form');
    const successModal = document.getElementById('success-modal');
    const closeModal = document.getElementById('close-success-modal');
    
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const submitBtn = form.querySelector('button[type="submit"]');
        const originalContent = submitBtn.innerHTML;
        
        // Disable & Show Loading
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Sending...';
        
        // Send AJAX Request
        const formData = new FormData(form);
        
        fetch('admin/api/contact.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                form.reset();
                // Show Success Modal
                if (successModal) {
                    successModal.classList.remove('hidden');
                    gsap.from(successModal.querySelector('.bg-gray-950'), {
                        scale: 0.8,
                        opacity: 0,
                        duration: 0.5,
                        ease: 'back.out(1.7)'
                    });
                }
            } else {
                alert(data.message || 'An error occurred. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('A network error occurred. Please try again later.');
        })
        .finally(() => {
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalContent;
        });
    });
    
    if (closeModal) {
        closeModal.addEventListener('click', () => {
            successModal.classList.add('hidden');
        });
    }
}

/**
 * Gallery Filtering and Lightbox
 */
function initGallery() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const items = Array.from(document.querySelectorAll('.gallery-item'));
    const lightbox = document.getElementById('lightbox-modal');
    const lightboxImg = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDesc = document.getElementById('lightbox-desc');
    const lightboxCounter = document.getElementById('lightbox-counter');
    const closeBtn = document.getElementById('close-lightbox');
    const prevBtn = document.getElementById('prev-lightbox');
    const nextBtn = document.getElementById('next-lightbox');
    
    let currentIndex = 0;
    let visibleItems = items;

    // Filtering Logic
    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;
            filterBtns.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            
            // Filter logic with GSAP
            items.forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    gsap.to(item, { scale: 1, opacity: 1, duration: 0.4, display: 'block', ease: 'power2.out' });
                } else {
                    gsap.to(item, { scale: 0.8, opacity: 0, duration: 0.3, display: 'none', ease: 'power2.in' });
                }
            });

            // Update visibleItems for navigation
            setTimeout(() => {
                visibleItems = items.filter(item => item.style.display !== 'none');
            }, 500);
        });
    });

    /**
     * Update Lightbox content with animation
     */
    const updateLightbox = (index, direction = 'next') => {
        if (!visibleItems[index]) return;
        currentIndex = index;
        
        const item = visibleItems[index];
        const img = item.querySelector('img');
        const title = item.querySelector('h3').textContent;
        const desc = item.querySelector('p').textContent;

        const xMove = direction === 'next' ? 50 : -50;

        // Transition animation
        const tl = gsap.timeline();
        tl.to([lightboxImg, lightboxTitle, lightboxDesc], {
            x: -xMove,
            opacity: 0,
            duration: 0.2,
            onComplete: () => {
                lightboxImg.src = img.src;
                lightboxTitle.textContent = title;
                lightboxDesc.textContent = desc;
                lightboxCounter.textContent = `${currentIndex + 1} / ${visibleItems.length}`;
            }
        })
        .fromTo([lightboxImg, lightboxTitle, lightboxDesc], 
            { x: xMove, opacity: 0 }, 
            { x: 0, opacity: 1, duration: 0.4, ease: 'power2.out' }
        );
    };

    /**
     * Navigation functions
     */
    const nextImage = () => {
        let nextIndex = (currentIndex + 1) % visibleItems.length;
        updateLightbox(nextIndex, 'next');
    };

    const prevImage = () => {
        let prevIndex = (currentIndex - 1 + visibleItems.length) % visibleItems.length;
        updateLightbox(prevIndex, 'prev');
    };

    // Lightbox Logic
    if (lightbox && lightboxImg) {
        items.forEach(item => {
            item.addEventListener('click', () => {
                // Determine current visible list and index of clicked item
                visibleItems = items.filter(i => i.style.display !== 'none');
                const idx = visibleItems.indexOf(item);
                
                currentIndex = idx;
                const img = item.querySelector('img');
                const title = item.querySelector('h3').textContent;
                const desc = item.querySelector('p').textContent;

                lightboxImg.src = img.src;
                lightboxTitle.textContent = title;
                lightboxDesc.textContent = desc;
                lightboxCounter.textContent = `${currentIndex + 1} / ${visibleItems.length}`;
                
                lightbox.classList.remove('hidden');
                lightbox.classList.add('flex');
                
                const modalContent = lightbox.querySelector('.relative');
                gsap.set(modalContent, { scale: 0.9, opacity: 0 });
                gsap.to(modalContent, { scale: 1, opacity: 1, duration: 0.4, ease: 'back.out(1.7)' });
            });
        });

        const closeFunc = () => {
            gsap.to(lightbox.querySelector('.relative'), {
                scale: 0.9, opacity: 0, duration: 0.3,
                onComplete: () => {
                    lightbox.classList.add('hidden');
                    lightbox.classList.remove('flex');
                }
            });
        };

        // Event Listeners
        if (closeBtn) closeBtn.addEventListener('click', closeFunc);
        if (prevBtn) prevBtn.addEventListener('click', (e) => { e.stopPropagation(); prevImage(); });
        if (nextBtn) nextBtn.addEventListener('click', (e) => { e.stopPropagation(); nextImage(); });
        
        const lbBg = document.getElementById('lightbox-background');
        if (lbBg) lbBg.addEventListener('click', closeFunc);

        // Keyboard Navigation
        document.addEventListener('keydown', (e) => {
            if (lightbox.classList.contains('hidden')) return;
            
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'ArrowLeft') prevImage();
            if (e.key === 'Escape') closeFunc();
        });
    }
}

// Global generic observer to catch all Tailwind animated elements that weren't specifically handled by GSAP
document.addEventListener('DOMContentLoaded', () => {
    const fallbackObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const el = entry.target;
                const delay = parseInt(el.getAttribute('data-delay')) || 0;
                setTimeout(() => {
                    el.classList.remove('opacity-0', 'translate-y-10', '-translate-x-10', 'translate-x-10', 'scale-95');
                    el.classList.add('opacity-100', 'translate-y-0', 'translate-x-0', 'scale-100');
                    observer.unobserve(el);
                }, delay);
            }
        });
    }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

    // Find all elements with these animation utility classes
    document.querySelectorAll('.animate-on-scroll, .opacity-0.transform').forEach(el => {
        if (!el.classList.contains('duration-700') && !el.classList.contains('duration-1000') && !el.classList.contains('duration-500')) {
            el.classList.add('duration-700', 'transition-all', 'ease-out');
        } else {
            el.classList.add('transition-all', 'ease-out');
        }
        fallbackObserver.observe(el);
    });
});