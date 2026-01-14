// main.js - Shared JavaScript functions
document.addEventListener('DOMContentLoaded', function() {
    // Preloader
    window.addEventListener('load', () => {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            setTimeout(() => {
                preloader.style.opacity = '0';
                setTimeout(() => {
                    preloader.style.display = 'none';
                }, 500);
            }, 1000);
        }
        
        // Stagger Products
        document.querySelectorAll('.product').forEach((el, i) => {
            el.style.animationDelay = (i * 0.1) + 's';
        });
    });
    
    // Mobile Menu
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
    
    if (hamburger && mobileMenu) {
        hamburger.addEventListener('click', (e) => {
            e.stopPropagation();
            hamburger.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!mobileMenu.contains(e.target) && !hamburger.contains(e.target) && mobileMenu.classList.contains('active')) {
                hamburger.classList.remove('active');
                mobileMenu.classList.remove('active');
            }
        });
    }
    
    // Theme Toggle
    const themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark');
            themeToggle.textContent = document.body.classList.contains('dark') ? '☀' : '🌑';
            
            // Show toast
            const toast = document.getElementById('toast');
            if (toast) {
                toast.textContent = document.body.classList.contains('dark') ? 'Dark Mode Activated' : 'Light Mode Activated';
                toast.classList.add('show');
                setTimeout(() => toast.classList.remove('show'), 2000);
            }
        });
        
        // Initialize theme based on system preference
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.body.classList.add('dark');
            themeToggle.textContent = '☀';
        }
    }
    
    // Scroll Progress Bar
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY;
        const totalHeight = document.body.scrollHeight - window.innerHeight;
        const scrollPercent = totalHeight > 0 ? (scrolled / totalHeight) * 100 : 0;
        const progress = document.getElementById('progress');
        if (progress) {
            progress.style.width = scrollPercent + '%';
        }
        
        // Back to Top Button
        const backToTopBtn = document.getElementById('back-to-top');
        if (backToTopBtn) {
            if (scrolled > 300) {
                backToTopBtn.style.display = 'block';
            } else {
                backToTopBtn.style.display = 'none';
            }
        }
    });
    
    // Back to Top Button
    const backToTopBtn = document.getElementById('back-to-top');
    if (backToTopBtn) {
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
    
    // Cursor Follower
    const cursor = document.getElementById('cursor');
    if (cursor) {
        document.addEventListener('mousemove', (e) => {
            cursor.style.left = e.clientX - 10 + 'px';
            cursor.style.top = e.clientY - 10 + 'px';
        });
        
        // Add cursor effects on interactive elements
        const interactiveElements = document.querySelectorAll('a, button, .category, .product, .shop-category, .filter-btn, .track-card, .add-to-cart-btn');
        interactiveElements.forEach(el => {
            el.addEventListener('mouseenter', () => {
                cursor.style.transform = 'scale(1.5)';
                cursor.style.background = '#fff';
            });
            el.addEventListener('mouseleave', () => {
                cursor.style.transform = 'scale(1)';
                cursor.style.background = 'var(--accent)';
            });
        });
    }
    
    // Product Modal
    const closeModal = document.getElementById('closeModal');
    if (closeModal) {
        closeModal.addEventListener('click', () => {
            const modal = document.getElementById('productModal');
            if (modal) {
                modal.classList.remove('show');
            }
        });
    }
    
    // Parallax Effect
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY;
        const heroCollage = document.querySelector('.hero-collage');
        if (heroCollage) {
            heroCollage.style.transform = `translateY(${scrolled * 0.3}px)`;
        }
    });
    
    // Floating Contact Form
    const contactToggle = document.getElementById('contactToggle');
    const contactPanel = document.getElementById('contactPanel');
    const contactClose = document.getElementById('contactClose');
    const contactForm = document.getElementById('contactForm');
    
    if (contactToggle && contactPanel) {
        // Toggle contact panel
        contactToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            contactToggle.classList.toggle('active');
            contactPanel.classList.toggle('active');
        });
        
        // Close panel with X button
        if (contactClose) {
            contactClose.addEventListener('click', (e) => {
                e.stopPropagation();
                contactToggle.classList.remove('active');
                contactPanel.classList.remove('active');
            });
        }
        
        // Close panel when clicking outside
        document.addEventListener('click', (e) => {
            if (!contactPanel.contains(e.target) && !contactToggle.contains(e.target)) {
                contactToggle.classList.remove('active');
                contactPanel.classList.remove('active');
            }
        });
        
        // Form submission
        if (contactForm) {
            contactForm.addEventListener('submit', (e) => {
                e.preventDefault();
                
                const formData = new FormData(contactForm);
                const data = Object.fromEntries(formData);
                
                if (data.email && data.message) {
                    const submitBtn = contactForm.querySelector('button[type="submit"]');
                    const originalText = submitBtn.textContent;
                    
                    submitBtn.textContent = 'SENT ✓';
                    submitBtn.style.background = 'var(--black)';
                    
                    contactForm.reset();
                    
                    setTimeout(() => {
                        contactToggle.classList.remove('active');
                        contactPanel.classList.remove('active');
                        
                        setTimeout(() => {
                            submitBtn.textContent = originalText;
                            submitBtn.style.background = 'var(--accent)';
                        }, 1000);
                    }, 1500);
                }
            });
        }
    }
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth'
                });
                // Close mobile menu if open
                if (mobileMenu && mobileMenu.classList.contains('active')) {
                    hamburger.classList.remove('active');
                    mobileMenu.classList.remove('active');
                }
            }
        });
    });
    
    // Search functionality
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                const query = searchInput.value.trim();
                if (query) {
                    // In a real application, this would redirect to a search results page
                    alert(`Searching for: ${query}`);
                }
            }
        });
    }
    
    // Newsletter form submission
    const newsletterBtn = document.getElementById('subscribe-btn');
    const newsletterEmail = document.getElementById('newsletter-email');
    
    if (newsletterBtn && newsletterEmail) {
        newsletterBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (newsletterEmail.value && newsletterEmail.value.includes('@')) {
                alert('Thank you for subscribing to our newsletter!');
                newsletterEmail.value = '';
            } else {
                alert('Please enter a valid email address.');
            }
        });
        
        // Add enter key support for newsletter
        newsletterEmail.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                newsletterBtn.click();
            }
        });
    }
    
    // Typewriter Effect (for home page)
    const typewriter = document.getElementById('typewriter');
    if (typewriter) {
        const lines = ["ARCHIVE THE STREETS", "CULTURE HAS A MEMORY"];
        let lineIndex = 0;
        let charIndex = 0;

        function typeWriter() {
            if (lineIndex < lines.length) {
                if (charIndex < lines[lineIndex].length) {
                    typewriter.innerHTML += lines[lineIndex].charAt(charIndex);
                    charIndex++;
                    setTimeout(typeWriter, 100);
                } else {
                    typewriter.innerHTML += '<br>';
                    lineIndex++;
                    charIndex = 0;
                    setTimeout(typeWriter, 500);
                }
            }
        }
        typeWriter();
    }
    
    // Audio Player functionality (for home page)
    const audio = document.getElementById('main-audio');
    const playBtn = document.getElementById('master-play');
    const progressFill = document.getElementById('progress-bar');
    const progressContainer = document.getElementById('progress-container');
    
    if (audio && playBtn && progressFill && progressContainer) {
        playBtn.addEventListener('click', () => {
            if (audio.paused) { 
                audio.play(); 
                playBtn.innerText = 'II'; 
                playBtn.style.background = '#ff3c00';
                playBtn.style.color = '#fff';
            }
            else { 
                audio.pause(); 
                playBtn.innerText = '▶️'; 
                playBtn.style.background = '#fff';
                playBtn.style.color = '#000';
            }
        });
        
        audio.addEventListener('timeupdate', () => {
            const percent = (audio.currentTime / audio.duration) * 100;
            progressFill.style.width = percent + '%';
        });
        
        progressContainer.addEventListener('click', (e) => {
            const width = progressContainer.clientWidth;
            const clickX = e.offsetX;
            audio.currentTime = (clickX / width) * audio.duration;
        });
    }
    
    // Category click effects
    document.querySelectorAll('.category').forEach(category => {
        category.addEventListener('click', () => {
            category.style.background = 'var(--accent)';
            category.style.color = '#fff';
            category.style.borderColor = 'var(--accent)';
            setTimeout(() => {
                category.style.background = '';
                category.style.color = '';
                category.style.borderColor = '';
            }, 300);
        });
    });
    
    // Initialize carousel animation
    const carouselTrack = document.querySelector('.carousel-track');
    if (carouselTrack) {
        carouselTrack.style.animation = 'slideImages 20s linear infinite';
    }
    
    // Product click for modal
    document.querySelectorAll('.product').forEach(product => {
        product.addEventListener('click', (e) => {
            // Don't trigger modal if clicking on add to cart button
            if (e.target.classList.contains('add-to-cart-btn') || 
                e.target.classList.contains('product-quick-add')) {
                return;
            }
            
            const img = product.querySelector('img').src;
            const title = product.querySelector('p').textContent;
            const price = product.querySelector('strong').textContent;
            
            const modalImg = document.getElementById('modalImg');
            const modalTitle = document.getElementById('modalTitle');
            const modalPrice = document.getElementById('modalPrice');
            const modalDesc = document.getElementById('modalDesc');
            const modal = document.getElementById('productModal');
            
            if (modalImg && modalTitle && modalPrice && modalDesc && modal) {
                modalImg.src = img;
                modalTitle.textContent = title;
                modalPrice.textContent = price;
                modalDesc.textContent = 'Detailed description of ' + title + '. High-quality fashion item from our archive.';
                modal.classList.add('show');
            }
        });
    });
    
    // Reveal Folders on Scroll
    const folderObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) { 
                entry.target.classList.add("show"); 
            }
        });
    }, { threshold: 0.15 });
    
    document.querySelectorAll(".folder-section").forEach(f => {
        folderObserver.observe(f);
    });
    
    // Preload carousel images to prevent delay
    function preloadCarouselImages() {
        const carouselImages = [
            'images/banner1.jpeg',
            'images/banner2.jpeg', 
            'images/banner3.jpeg'
        ];
        
        carouselImages.forEach(src => {
            const img = new Image();
            img.src = src;
        });
    }
    
    // Call preload on load
    window.addEventListener('load', preloadCarouselImages);
});