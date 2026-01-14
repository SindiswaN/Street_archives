<footer>
  <p>STREETS ARCHIVES — SOUTH AFRICA<br>FASHION • SOUND • VISUAL RECORDS<br>EST. 2026</p>
  <p>
    <a href="privacy.php" style="color: white; text-decoration: none;">Privacy</a> • 
    <a href="shipping.php" style="color: white; text-decoration: none;">Shipping</a> • 
    <a href="returns.php" style="color: white; text-decoration: none;">Returns</a> • 
    <a href="contact.php" style="color: white; text-decoration: none;">Contact</a>
  </p>
</footer>

<div class="modal" id="productModal">
  <div class="modal-content">
    <span class="close" id="closeModal">&times;</span>
    <img id="modalImg" src="" alt="Product">
    <h3 id="modalTitle">Product Title</h3>
    <p id="modalDesc">Product description here.</p>
    <strong id="modalPrice">R 799</strong>
  </div>
</div>

<script>
// Shared JavaScript functionality
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
    
    if (hamburger) {
        hamburger.addEventListener('click', (e) => {
            e.stopPropagation();
            hamburger.classList.toggle('active');
            mobileMenu.classList.toggle('active');
        });
    }
    
    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
        if (mobileMenu && hamburger && !mobileMenu.contains(e.target) && !hamburger.contains(e.target) && mobileMenu.classList.contains('active')) {
            hamburger.classList.remove('active');
            mobileMenu.classList.remove('active');
        }
    });
    
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
        const scrollPercent = (scrolled / totalHeight) * 100;
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
        const interactiveElements = document.querySelectorAll('a, button, .category, .product, .shop-category, .filter-btn, .track-card');
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
            document.getElementById('productModal').classList.remove('show');
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
    
    // Add to cart notification
    const cartNotification = document.getElementById('cartNotification');
    if (cartNotification) {
        // Listen for custom cart update events
        document.addEventListener('cartUpdated', (e) => {
            cartNotification.textContent = e.detail.message;
            cartNotification.style.display = 'block';
            
            setTimeout(() => {
                cartNotification.style.display = 'none';
            }, 3000);
        });
    }
    
    // Cart count update
    function updateCartCount(count) {
        const cartElement = document.querySelector('.cart');
        if (cartElement) {
            cartElement.textContent = `CART (${count})`;
            const mobileCart = document.querySelector('.mobile-menu .cart');
            if (mobileCart) {
                mobileCart.textContent = `CART (${count})`;
            }
        }
    }
    
    // Expose updateCartCount globally
    window.updateCartCount = updateCartCount;
});
</script>
</body>
</html>