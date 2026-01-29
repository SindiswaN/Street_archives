// main.js - Shared JavaScript functions
document.addEventListener('DOMContentLoaded', function() {
    console.log('main.js loaded');
    
    // ===== DEBUG: Check what elements exist =====
    console.log('=== DEBUG ELEMENT CHECK ===');
    console.log('theme-toggle element:', document.getElementById('theme-toggle'));
    console.log('aboutMenuToggle element:', document.getElementById('aboutMenuToggle'));
    console.log('=== END DEBUG ===');
    
    // ===== THEME TOGGLE - FIXED VERSION =====
    function initThemeToggle() {
        const themeToggle = document.getElementById('theme-toggle');
        
        if (!themeToggle) {
            console.warn('Theme toggle button not found');
            return;
        }
        
        console.log('Initializing theme toggle...');
        
        // Make sure it has the icon
        if (!themeToggle.querySelector('i')) {
            themeToggle.innerHTML = '<i class="bi bi-moon"></i>';
        }
        
        // Function to set theme
        function setTheme(isDark) {
            if (isDark) {
                document.body.classList.add('dark');
                const icon = themeToggle.querySelector('i');
                if (icon) {
                    icon.className = 'bi bi-sun';
                    themeToggle.setAttribute('aria-label', 'Switch to light mode');
                }
                console.log('Theme set to DARK');
            } else {
                document.body.classList.remove('dark');
                const icon = themeToggle.querySelector('i');
                if (icon) {
                    icon.className = 'bi bi-moon';
                    themeToggle.setAttribute('aria-label', 'Switch to dark mode');
                }
                console.log('Theme set to LIGHT');
            }
        }
        
        // Click handler - using stopImmediatePropagation to prevent interference
        themeToggle.addEventListener('click', function(e) {
            console.log('Theme toggle clicked - stopping all propagation');
            e.stopImmediatePropagation();
            e.preventDefault();
            
            const isDark = !document.body.classList.contains('dark');
            setTheme(isDark);
            localStorage.setItem('theme', isDark ? 'dark' : 'light');
        }, true); // Use capture phase to run FIRST
        
        // Load saved theme
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            setTheme(true);
        } else if (!savedTheme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            setTheme(true);
            localStorage.setItem('theme', 'dark');
        }
        
        console.log('Theme toggle initialized successfully');
    }
    
    // Initialize theme toggle FIRST (before anything else)
    initThemeToggle();
    
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
    
    // ===== MOBILE MENU =====
    function initMobileMenu() {
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileMenuOverlay = document.getElementById('mobileMenuOverlay');
        const mobileMenuClose = document.getElementById('mobileMenuClose');
        
        console.log('Mobile menu init - Hamburger:', hamburger);
        console.log('Mobile menu init - Mobile Menu:', mobileMenu);
        
        if (hamburger && mobileMenu) {
            console.log('Mobile menu elements found');
            
            function toggleMobileMenu() {
                console.log('toggleMobileMenu called');
                hamburger.classList.toggle('active');
                mobileMenu.classList.toggle('active');
                
                if (mobileMenuOverlay) {
                    mobileMenuOverlay.classList.toggle('active');
                }
                
                // Prevent body scroll when menu is open
                if (mobileMenu.classList.contains('active')) {
                    document.body.style.overflow = 'hidden';
                    document.body.style.position = 'fixed';
                    document.body.style.width = '100%';
                } else {
                    document.body.style.overflow = '';
                    document.body.style.position = '';
                    document.body.style.width = '';
                }
            }
            
            // Open menu with hamburger
            hamburger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log('Hamburger clicked!');
                toggleMobileMenu();
            });
            
            // Close menu with X button
            if (mobileMenuClose) {
                mobileMenuClose.addEventListener('click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    toggleMobileMenu();
                });
            }
            
            // Close menu with overlay click
            if (mobileMenuOverlay) {
                mobileMenuOverlay.addEventListener('click', function(e) {
                    e.preventDefault();
                    toggleMobileMenu();
                });
            }
            
            // Close menu when clicking links
            mobileMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function(e) {
                    if (!this.href.includes('cart.php')) {
                        setTimeout(() => {
                            toggleMobileMenu();
                        }, 300);
                    }
                });
            });
            
            // Close with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && mobileMenu.classList.contains('active')) {
                    toggleMobileMenu();
                }
            });
            
            console.log('Mobile menu initialized successfully');
        } else {
            console.warn('Mobile menu elements not found');
        }
    }
    
    // Initialize mobile menu
    initMobileMenu();
    
    // ===== ABOUT PAGE MENU =====
    function initAboutPageMenu() {
        const aboutMenuToggle = document.getElementById('aboutMenuToggle');
        const aboutPageMenu = document.getElementById('aboutPageMenu');
        
        console.log('About menu init - Toggle:', aboutMenuToggle);
        console.log('About menu init - Menu:', aboutPageMenu);
        
        if (aboutMenuToggle && aboutPageMenu) {
            console.log('About page menu elements found');
            
            function toggleAboutMenu() {
                console.log('toggleAboutMenu called');
                aboutMenuToggle.classList.toggle('active');
                aboutPageMenu.classList.toggle('active');
                
                // Close main mobile menu if it's open
                const mobileMenu = document.getElementById('mobileMenu');
                const hamburger = document.querySelector('.hamburger');
                if (mobileMenu && mobileMenu.classList.contains('active')) {
                    mobileMenu.classList.remove('active');
                    hamburger.classList.remove('active');
                    document.body.style.overflow = '';
                    document.body.style.position = '';
                    document.body.style.width = '';
                }
            }
            
            // Open/close about menu - IMPORTANT: Check this is NOT theme toggle
            aboutMenuToggle.addEventListener('click', function(e) {
                // CRITICAL: Make sure we're not clicking the theme toggle
                if (this.id === 'theme-toggle' || this.closest('#theme-toggle')) {
                    console.log('Skipping - this is theme toggle');
                    return; // Let theme toggle handle it
                }
                
                e.preventDefault();
                e.stopPropagation();
                console.log('About menu toggle clicked!');
                toggleAboutMenu();
            });
            
            // Close about menu when clicking on links
            aboutPageMenu.querySelectorAll('a').forEach(link => {
                link.addEventListener('click', function(e) {
                    console.log('About menu link clicked');
                    
                    // Smooth scroll to section
                    const href = this.getAttribute('href');
                    if (href && href.startsWith('#')) {
                        e.preventDefault();
                        const targetId = href.substring(1);
                        const targetElement = document.getElementById(targetId);
                        
                        if (targetElement) {
                            // Close menu first
                            toggleAboutMenu();
                            
                            // Then scroll
                            setTimeout(() => {
                                window.scrollTo({
                                    top: targetElement.offsetTop - 80,
                                    behavior: 'smooth'
                                });
                            }, 300);
                        }
                    }
                });
            });
            
            // Close about menu when clicking outside
            document.addEventListener('click', function(e) {
                if (aboutPageMenu.classList.contains('active') && 
                    !aboutPageMenu.contains(e.target) && 
                    !aboutMenuToggle.contains(e.target)) {
                    console.log('Clicked outside about menu');
                    toggleAboutMenu();
                }
            });
            
            // Close about menu with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && aboutPageMenu.classList.contains('active')) {
                    console.log('Escape key pressed - closing about menu');
                    toggleAboutMenu();
                }
            });
            
            console.log('About page menu initialized successfully');
        } else {
            console.warn('About page menu elements not found - check if on About page');
        }
    }
    
    // Initialize about page menu
    initAboutPageMenu();
    
    // ===== SCROLL PROGRESS BAR =====
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
    
    // ===== CURSOR FOLLOWER =====
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
    
    // ===== PRODUCT MODAL =====
    const closeModal = document.getElementById('closeModal');
    if (closeModal) {
        closeModal.addEventListener('click', () => {
            const modal = document.getElementById('productModal');
            if (modal) {
                modal.classList.remove('show');
            }
        });
    }
    
    // ===== PARALLAX EFFECT =====
    window.addEventListener('scroll', () => {
        const scrolled = window.scrollY;
        const heroCollage = document.querySelector('.hero-collage');
        if (heroCollage) {
            heroCollage.style.transform = `translateY(${scrolled * 0.3}px)`;
        }
    });
    
    // ===== FLOATING CONTACT FORM =====
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
    
    // ===== SMOOTH SCROLLING =====
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            if (href === '#') return;
            
            e.preventDefault();
            const target = document.querySelector(href);
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // ===== SEARCH FUNCTIONALITY =====
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                const query = searchInput.value.trim();
                if (query) {
                    alert(`Searching for: ${query}`);
                }
            }
        });
    }
    
    // ===== NEWSLETTER FORM =====
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
    
    // ===== TYPEWRITER EFFECT =====
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
    
    // ===== AUDIO PLAYER =====
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
    
    // ===== CATEGORY CLICK EFFECTS =====
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
    
    // ===== CAROUSEL ANIMATION =====
    const carouselTrack = document.querySelector('.carousel-track');
    if (carouselTrack) {
        carouselTrack.style.animation = 'slideImages 20s linear infinite';
    }
    
    // ===== PRODUCT MODAL CLICK =====
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
    
    // ===== REVEAL FOLDERS ON SCROLL =====
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
    
    // ===== PRELOAD CAROUSEL IMAGES =====
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

    
    console.log('All main.js functions initialized');
});