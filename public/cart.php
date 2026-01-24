<?php
$pageTitle = 'Cart';
require_once(__DIR__ . '/../app/config.php');
require_once(__DIR__ . '/../app/database.php');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$cartCount = count($_SESSION['cart']);
?>

<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>STREETS ARCHIVES - <?php echo $pageTitle; ?></title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>
/* ---------- GLOBAL ---------- */
*{margin:0;padding:0;box-sizing:border-box;}

body{
  font-family:'Poppins', sans-serif;
  background: var(--bg);
  color: var(--text);
  overflow-x: hidden;
  min-height: 100vh;
}

:root{
  --black:#111;
  --grey:#e6e6e6;
  --offwhite:#f8f8f8;
  --accent: #ff3c00;
  --bg: #ffffff;
  --text: #111;
  --header-bg: #fff;
  --transition: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Preloader - Same as music page */
#preloader {
    position: fixed;
    top: 0; left: 0; width: 100%; height: 100%;
    background: var(--black);
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 9999;
    font-family: 'Poppins', sans-serif;
    transition: opacity 0.5s ease;
}
.loader {
    width: 50px;
    height: 50px;
    border: 4px solid var(--accent);
    border-top: 4px solid transparent;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}
@keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

/* ---------- TOP BAR ---------- */
.top-bar {
  background: var(--black); 
  color: var(--bg); 
  padding: 10px 0; 
  overflow: hidden;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.top-bar p {
  animation: scrollText 35s linear infinite; 
  font-size: 14px; 
  white-space: nowrap;
  font-weight: 500;
  letter-spacing: 0.5px;
  font-family: 'Space Mono', monospace;
  color: inherit; 
}

@keyframes scrollText { 
  0% { transform: translateX(100%); } 
  100% { transform: translateX(-100%); } 
}

.top-bar {
  background: #111111; 
  color: #ffffff; 
  padding: 10px 0; 
  overflow: hidden;
}

.top-bar {
  background: #111111; 
  color: #ffffff; 
  padding: 10px 0; 
  overflow: hidden;
}

body.dark .top-bar {
  background: #ffffff; 
  color: #111111; 
}

/* ---------- HEADER & HAMBURGER ---------- */
header{
  display:flex;
  align-items:center;
  justify-content:space-between;
  padding:15px 5%;
  border-bottom:1px solid #ddd;
  background: var(--header-bg);
  position: sticky;
  top: 0;
  z-index: 1000;
}

.header-left { display: flex; align-items: center; gap: 10px; }
.header-center { flex: 1; display: flex; justify-content: center; }
.header-right { display: flex; align-items: center; gap: 10px; }

.logo-container {
  perspective: 1200px;
  width: 80px;
  height: 80px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.logo-3d {
  width: 100%;
  height: auto;
  animation: rotate3D 10s linear infinite;
  transform-style: preserve-3d;
}

@keyframes rotate3D {
  0% { transform: rotateY(0deg); }
  100% { transform: rotateY(360deg); }
}

nav ul{list-style:none; display:none; gap:28px;}
nav a{text-decoration:none; color:#111; font-weight:600; text-transform: uppercase; font-size: 13px;}
.cart{font-weight:700;}
#theme-toggle {
    background: transparent;
    border: none;
    font-size: 20px;
    cursor: pointer;
    transition: 0.3s;
    color: var(--text);
}
#theme-toggle:hover { transform: scale(1.1); }

#search {
    padding: 8px 12px;
    border: 1px solid var(--black);
    border-radius: 4px;
    background: var(--bg);
    color: var(--text);
    font-size: 14px;
}
#search::placeholder { color: var(--grey); }

/* Hamburger Button */
.hamburger {
  display: flex;
  flex-direction: column;
  gap: 6px;
  cursor: pointer;
  z-index: 2000;
}
.hamburger span {
  width: 25px;
  height: 2px;
  background-color: var(--black);
  transition: 0.3s;
}

/* Mobile Menu Overlay */
.mobile-menu {
  position: fixed;
  top: 0;
  right: -100%;
  width: 100%;
  height: 100vh;
  background: #fff;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 30px;
  transition: 0.5s cubic-bezier(0.22, 1, 0.36, 1);
  z-index: 1500;
}
.mobile-menu.active { right: 0; }
.mobile-menu a {
  text-decoration: none;
  color: var(--black);
  font-size: 24px;
  font-weight: 800;
  text-transform: uppercase;
}

.cart {
    font-weight: 700;
    font-size: 13px;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--accent);
    cursor: pointer;
    transition: all 0.3s var(--transition);
    padding: 8px 12px;
    border-radius: 6px;
}

.cart:hover {
    background: rgba(255, 60, 0, 0.1);
    transform: translateY(-2px);
}

/* ---------- DARK MODE (From Music Page) ---------- */
body.dark {
    --black: #fff;
    --grey: #333;
    --offwhite: #222;
    --accent: #ff3c00;
    --bg: #111;
    --text: #fff;
    --header-bg: #111;
}

body.dark .hero { background: #000; color: #fff; }
body.dark .top-bar { background: #fff; color: #111; }
body.dark .mobile-menu { background: #222; }
body.dark .audio-player { background: #222; }
body.dark .newsletter { background: #222; border-color: #fff; }
body.dark .newsletter input { border-color: #fff; color: #fff; background: #333; }
body.dark footer { background: #222; }

/* ---------- CART HERO ---------- */
.cart-hero {
    height: 50vh;
    background: linear-gradient(rgba(0,0,0,0.85), rgba(0,0,0,0.85)), url('../images/image1.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    margin-bottom: 60px;
    position: relative;
    overflow: hidden;
}

.cart-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 30%, rgba(255, 60, 0, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 70%, rgba(255, 60, 0, 0.05) 0%, transparent 50%);
    pointer-events: none;
}

.cart-hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    padding: 0 20px;
}

.cart-hero h1 {
    font-size: 5rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -3px;
    margin-bottom: 20px;
    line-height: 0.9;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.cart-hero p {
    font-size: 1.2rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    opacity: 0.8;
    font-weight: 300;
}

/* ---------- CART CONTAINER ---------- */
.cart-container {
    width: 85%;
    max-width: 1100px;
    margin: 0 auto 100px;
}

.cart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    padding-bottom: 20px;
    border-bottom: 2px solid var(--black);
}

.cart-header h1 {
    font-size: 2rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -1px;
}

.cart-count {
    font-size: 14px;
    font-weight: 700;
    color: var(--accent);
    text-transform: uppercase;
    letter-spacing: 1px;
    background: rgba(255, 60, 0, 0.1);
    padding: 8px 20px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Cart Items */
.cart-items {
    margin-bottom: 40px;
}

.cart-item {
    display: grid;
    grid-template-columns: 120px 2fr 1fr 1fr 1fr;
    gap: 20px;
    align-items: center;
    padding: 30px 0;
    border-bottom: 1px solid var(--grey);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.cart-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--accent);
    transform: translateX(-100%);
    transition: transform 0.3s;
}

.cart-item:hover::before {
    transform: translateX(0);
}

.cart-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.1);
}

.cart-item-image img {
    width: 100px;
    height: 100px;
    object-fit: cover;
    border-radius: 8px;
    border: 2px solid var(--black);
    transition: transform 0.3s;
}

.cart-item:hover .cart-item-image img {
    transform: scale(1.05);
}

.cart-item-details h4 {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 8px;
    text-transform: uppercase;
}

.cart-item-details p {
    font-size: 12px;
    color: #888;
    text-transform: uppercase;
    margin-bottom: 3px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.cart-item-price {
    font-weight: 800;
    color: var(--accent);
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    gap: 5px;
}

.cart-item-quantity {
    display: flex;
    align-items: center;
    gap: 10px;
}

.cart-item-quantity button {
    width: 35px;
    height: 35px;
    border: 2px solid var(--black);
    background: none;
    cursor: pointer;
    font-weight: 800;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 4px;
    transition: all 0.3s;
}

.cart-item-quantity button:hover {
    background: var(--black);
    color: white;
}

.cart-item-quantity input {
    width: 60px;
    height: 35px;
    text-align: center;
    border: 2px solid var(--grey);
    font-weight: 700;
    border-radius: 4px;
    font-family: 'Poppins', sans-serif;
}

.cart-item-remove {
    color: #ff4444;
    cursor: pointer;
    font-size: 11px;
    text-transform: uppercase;
    font-weight: 700;
    letter-spacing: 1px;
    transition: all 0.3s;
    padding: 8px 15px;
    border-radius: 6px;
    border: 2px solid transparent;
    display: flex;
    align-items: center;
    gap: 5px;
}

.cart-item-remove:hover {
    background: rgba(255, 68, 68, 0.1);
    border-color: #ff4444;
}

/* Empty Cart */
.cart-empty {
    text-align: center;
    padding: 100px 0;
}

.cart-empty h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 20px;
    color: #888;
}

.cart-empty p {
    margin-bottom: 30px;
    color: #888;
    font-size: 1rem;
}

/* Cart Summary */
.cart-summary {
    background: var(--offwhite);
    padding: 40px;
    border: 2px solid var(--black);
    border-radius: 12px;
    margin-top: 40px;
    box-shadow: 8px 8px 0px var(--black);
    position: relative;
    overflow: hidden;
}

.cart-summary::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--accent);
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 14px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.summary-row.total {
    font-size: 1.2rem;
    font-weight: 800;
    border-top: 2px solid var(--black);
    padding-top: 20px;
    margin-top: 20px;
}

.checkout-btn {
    width: 100%;
    padding: 18px;
    background: var(--black);
    color: white;
    border: none;
    font-weight: 800;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s;
    margin-top: 30px;
    letter-spacing: 1px;
    font-size: 14px;
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.checkout-btn:hover {
    background: var(--accent);
    transform: translateY(-2px);
    box-shadow: 0 6px 0px var(--black);
}

.continue-shopping {
    display: inline-block;
    margin-top: 20px;
    padding: 14px 28px;
    border: 2px solid var(--black);
    background: transparent;
    color: var(--black);
    text-decoration: none;
    font-weight: 800;
    text-transform: uppercase;
    transition: all 0.3s;
    font-size: 12px;
    letter-spacing: 1px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.continue-shopping:hover {
    background: var(--black);
    color: white;
    transform: translateY(-2px);
}

/* Dark mode adjustments */
body.dark .cart-summary {
    background: #222;
    border-color: #333;
}

body.dark .cart-item {
    border-bottom-color: #333;
}

body.dark .cart-item-quantity button {
    border-color: #444;
}

body.dark .cart-item-quantity button:hover {
    background: #444;
}

body.dark .continue-shopping {
    border-color: #fff;
    color: #fff;
}

body.dark .continue-shopping:hover {
    background: #fff;
    color: #111;
}

/* Responsive cart */
@media (max-width: 768px) {
    .cart-hero h1 {
        font-size: 3rem;
    }
    
    .cart-item {
        grid-template-columns: 80px 1fr;
        grid-template-rows: auto auto auto auto;
        gap: 15px;
        padding: 20px 0;
    }
    
    .cart-item-image {
        grid-row: 1 / span 2;
    }
    
    .cart-item-details {
        grid-column: 2;
    }
    
    .cart-item-price,
    .cart-item-quantity,
    .cart-item-remove {
        grid-column: 1 / span 2;
    }
    
    .cart-item-quantity {
        justify-content: flex-start;
    }
    
    .cart-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 15px;
    }
    
    .cart-header h1 {
        font-size: 24px;
    }
}

/* ---------- SCROLL PROGRESS ---------- */
#progress {
    position: fixed;
    top: 0;
    left: 0;
    width: 0%;
    height: 4px;
    background: var(--accent);
    z-index: 9998;
}

/* ---------- BACK TO TOP ---------- */
#back-to-top {
    position: fixed;
    bottom: 100px;
    right: 30px;
    width: 50px;
    height: 50px;
    background: var(--accent);
    color: white;
    border: none;
    border-radius: 50%;
    font-size: 1.2rem;
    cursor: pointer;
    display: none;
    z-index: 9995;
    box-shadow: 0 4px 12px rgba(0,0,0,0.2);
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

#back-to-top:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.3);
    background: var(--black);
}

/* ---------- CART NOTIFICATION ---------- */
.cart-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: var(--accent);
    color: white;
    padding: 15px 25px;
    border-radius: 8px;
    display: none;
    z-index: 2000;
    animation: slideIn 0.3s ease-out;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 1px;
    box-shadow: 0 4px 15px rgba(255, 60, 0, 0.3);
    border: 2px solid white;
    display: flex;
    align-items: center;
    gap: 10px;
}

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

/* ---------- FLOATING CONTACT FORM (From Music Page) ---------- */
.floating-contact-container {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 10000;
}

.contact-toggle-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent), #ff5c33);
    color: white;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
    box-shadow: 0 8px 30px rgba(255, 60, 0, 0.4);
    transition: all 0.3s var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10001;
    position: relative;
}

.contact-toggle-btn:hover {
    transform: scale(1.1) rotate(90deg);
    background: linear-gradient(135deg, var(--black), #333);
    box-shadow: 0 12px 40px rgba(255, 60, 0, 0.6);
}

.contact-toggle-btn.active {
    transform: rotate(45deg);
    background: var(--black);
}

.contact-panel {
    position: absolute;
    bottom: 70px;
    right: 0;
    width: 380px;
    background: var(--header-bg);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 2px solid var(--black);
    border-radius: 12px;
    padding: 30px;
    box-shadow: 12px 12px 0px var(--black);
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px) scale(0.95);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    z-index: 10000;
}

.contact-panel.active {
    opacity: 1;
    visibility: visible;
    transform: translateY(0) scale(1);
}

.contact-header {
    text-align: center;
    margin-bottom: 30px;
}

.contact-icon {
    font-size: 40px;
    color: var(--accent);
    margin-bottom: 15px;
    display: block;
}

.contact-panel h3 {
    font-size: 18px;
    font-weight: 800;
    margin-bottom: 8px;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--text);
}

.contact-subtitle {
    font-size: 11px;
    opacity: 0.7;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0;
}

.form-group {
    position: relative;
    margin-bottom: 20px;
}

.form-group i {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--accent);
    font-size: 16px;
    z-index: 2;
    transition: color 0.3s ease;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 14px 14px 14px 45px;
    background: var(--bg);
    border: 2px solid var(--grey);
    border-radius: 8px;
    color: var(--text);
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
    transition: all 0.3s var(--transition);
}

.form-group textarea {
    min-height: 120px;
    resize: vertical;
}

.submit-btn {
    width: 100%;
    background: var(--accent);
    color: white;
    border: 2px solid var(--accent);
    padding: 14px;
    border-radius: 8px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s var(--transition);
    font-family: 'Poppins', sans-serif;
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.submit-btn:hover {
    background: var(--black);
    border-color: var(--black);
    transform: translateY(-2px);
    box-shadow: 0 6px 0px var(--black);
}

.social-links {
    margin-top: 25px;
    padding-top: 25px;
    border-top: 2px solid var(--grey);
}

.connect-title {
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 15px;
    text-align: center;
    opacity: 0.7;
    font-weight: 600;
}

.social-icons {
    display: flex;
    justify-content: center;
    gap: 12px;
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--offwhite);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text);
    text-decoration: none;
    font-size: 16px;
    transition: all 0.3s var(--transition);
    border: 1px solid var(--grey);
}

.social-link:hover {
    background: var(--accent);
    color: white;
    transform: translateY(-3px);
    border-color: var(--accent);
}

.contact-close {
    position: absolute;
    top: 15px;
    right: 15px;
    background: transparent;
    border: none;
    color: var(--text);
    font-size: 24px;
    cursor: pointer;
    opacity: 0.5;
    transition: all 0.3s var(--transition);
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
}

.contact-close:hover {
    opacity: 1;
    background: rgba(0, 0, 0, 0.1);
    color: var(--accent);
    transform: rotate(90deg);
}

/* Footer */
footer {
    background: #111;
    color: white;
    padding: 60px 5%;
    margin-top: 100px;
    text-align: center;
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 1px;
}

footer p {
    margin: 10px 0;
    opacity: 0.8;
}

footer a {
    color: var(--accent);
    text-decoration: none;
    transition: opacity 0.3s;
}

footer a:hover {
    opacity: 0.8;
}

/* Responsive */
@media (max-width: 1024px) {
    .cart-hero h1 {
        font-size: 4rem;
    }
}

@media (max-width: 768px) {
    .cart-hero {
        height: 40vh;
    }
    
    .cart-hero h1 {
        font-size: 3rem;
    }
    
    .cart-hero p {
        font-size: 1rem;
        letter-spacing: 2px;
    }
    
    .contact-panel {
        width: calc(100vw - 40px);
        right: -15px;
        padding: 25px;
    }
}

@media (max-width: 480px) {
    .cart-hero h1 {
        font-size: 2.5rem;
    }
    
    .contact-toggle-btn {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
}
</style>
</head>

<body>

<div id="preloader">
  <div class="loader"></div>
  <p>Loading Archive...</p>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(function() {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            preloader.style.opacity = '0';
            setTimeout(() => {
                preloader.style.display = 'none';
            }, 500);
        }
    }, 1000);
});
</script>

<div class="top-bar">
  <p>CULTURE OVER COMMODITY ~ LIVE FREE, DIE WITH MONEY ~ FASHION • MEDIA • SOUND ARCHIVE ~ CULTURE OVER COMMODITY ~ LIVE FREE, DIE WITH MONEY ~ FASHION • MEDIA • SOUND ARCHIVE</p>
</div>

<!-- Include Header -->
<?php require_once(__DIR__ . '/../includes/header.php'); ?>

<section class="cart-hero">
  <div class="cart-hero-content">
    <h1>CART<br>ARCHIVE</h1>
    <p>YOUR COLLECTED PIECES</p>
  </div>
</section>

<section class="cart-container">
    <div class="cart-header">
        <h1>YOUR ARCHIVE CART</h1>
        <div class="cart-count">
            <i class="bi bi-archive"></i>
            <?php echo $cartCount; ?> ITEMS
        </div>
    </div>
    
    <?php if (empty($_SESSION['cart'])): ?>
    <div class="cart-empty">
        <h2>YOUR ARCHIVE CART IS EMPTY</h2>
        <p>Browse our collections and add items to preserve in your archive.</p>
        <a href="fashion.php" class="continue-shopping">
            <i class="bi bi-arrow-left"></i>
            BROWSE ARCHIVE
        </a>
    </div>
    <?php else: ?>
    <div class="cart-items">
        <?php 
        $subtotal = 0;
        foreach ($_SESSION['cart'] as $index => $item): 
            // Extract numeric price
            $price_numeric = 0;
            if (is_numeric($item['price'])) {
                $price_numeric = floatval($item['price']);
            } else {
                preg_match('/[\d\.]+/', $item['price'], $matches);
                $price_numeric = isset($matches[0]) ? floatval($matches[0]) : 0;
            }
            
            $item_total = $price_numeric * $item['quantity'];
            $subtotal += $item_total;
        ?>
        <div class="cart-item" id="cart-item-<?php echo $index; ?>">
            <div class="cart-item-image">
                <img src="../<?php echo htmlspecialchars($item['image']); ?>" 
                     alt="<?php echo htmlspecialchars($item['name']); ?>"
                     onerror="this.onerror=null; this.src='../images/default-product.jpg'">
            </div>
            <div class="cart-item-details">
                <h4><?php echo htmlspecialchars($item['name']); ?></h4>
                <p><i class="bi bi-tag"></i> <?php echo htmlspecialchars(ucfirst($item['type'])); ?></p>
                <p><i class="bi bi-rulers"></i> Size: <?php echo htmlspecialchars($item['size']); ?></p>
            </div>
            <div class="cart-item-price">
                <i class="bi bi-currency-rand"></i>
                <?php echo htmlspecialchars($item['price']); ?>
            </div>
            <div class="cart-item-quantity">
                <button onclick="updateQuantity(<?php echo $index; ?>, -1)">
                    <i class="bi bi-dash"></i>
                </button>
                <input type="number" id="quantity-<?php echo $index; ?>" 
                       value="<?php echo $item['quantity']; ?>" min="1" 
                       onchange="updateQuantity(<?php echo $index; ?>, 0, this.value)">
                <button onclick="updateQuantity(<?php echo $index; ?>, 1)">
                    <i class="bi bi-plus"></i>
                </button>
            </div>
            <div class="cart-item-remove" onclick="removeItem(<?php echo $index; ?>)">
                <i class="bi bi-trash"></i>
                REMOVE
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="cart-summary">
        <div class="summary-row">
            <span>Subtotal</span>
            <span>R <?php echo number_format($subtotal, 2); ?></span>
        </div>
        <div class="summary-row">
            <span>Shipping</span>
            <span>FREE</span>
        </div>
        <div class="summary-row">
            <span>Archive Preservation Fee</span>
            <span>R 0.00</span>
        </div>
        <div class="summary-row total">
            <span>TOTAL ARCHIVE VALUE</span>
            <span>R <?php echo number_format($subtotal, 2); ?></span>
        </div>
        <button class="checkout-btn" onclick="checkout()">
            <i class="bi bi-lock-fill"></i>
            PROCEED TO SECURE CHECKOUT
        </button>
        <div style="text-align: center; margin-top: 20px;">
            <a href="fashion.php" class="continue-shopping">
                <i class="bi bi-arrow-left"></i>
                CONTINUE SHOPPING
            </a>
        </div>
    </div>
    <?php endif; ?>
</section>

<footer>
  <p>STREETS ARCHIVES — SOUTH AFRICA</p>
  <p>FASHION • SOUND • VISUAL RECORDS</p>
  <p>EST. 2026</p>
  <p><a href="privacy.php">Privacy</a> • <a href="shipping.php">Shipping</a> • <a href="returns.php">Returns</a> • <a href="contact.php">Contact</a></p>
</footer>

<div id="progress"></div>
<div class="cart-notification" id="cartNotification">
  <i class="bi bi-check-circle"></i>
  <span>Cart updated!</span>
</div>

<button id="back-to-top">
  <i class="bi bi-chevron-up"></i>
</button>

<!-- Floating Contact Form -->
<div class="floating-contact-container">
    <button class="contact-toggle-btn" id="contactToggle" aria-label="Open contact form">
        <i class="bi bi-chat-dots"></i>
    </button>
    
    <div class="contact-panel" id="contactPanel">
        <button class="contact-close" id="contactClose">&times;</button>
        
        <div class="contact-header">
            <i class="bi bi-archive contact-icon"></i>
            <h3>ARCHIVE TRANSMISSION</h3>
            <p class="contact-subtitle">Send encrypted message to HQ</p>
        </div>
        
        <form class="contact-form" id="contactForm">
            <div class="form-group">
                <i class="bi bi-person"></i>
                <input type="text" placeholder="CALLSIGN" required>
            </div>
            
            <div class="form-group">
                <i class="bi bi-envelope"></i>
                <input type="email" placeholder="FREQUENCY (EMAIL)" required>
            </div>
            
            <div class="form-group">
                <i class="bi bi-chat-text"></i>
                <textarea placeholder="ENCRYPTED MESSAGE..." rows="4" required></textarea>
            </div>
            
            <button type="submit" class="submit-btn">
                <i class="bi bi-send"></i>
                <span>TRANSMIT MESSAGE</span>
            </button>
        </form>
        
        <div class="social-links">
            <p class="connect-title">ALTERNATIVE FREQUENCIES</p>
            <div class="social-icons">
                <a href="https://instagram.com" class="social-link" target="_blank" aria-label="Instagram">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="https://twitter.com" class="social-link" target="_blank" aria-label="Twitter">
                    <i class="bi bi-twitter-x"></i>
                </a>
                <a href="https://soundcloud.com" class="social-link" target="_blank" aria-label="SoundCloud">
                    <i class="bi bi-music-note-beamed"></i>
                </a>
                <a href="https://youtube.com" class="social-link" target="_blank" aria-label="YouTube">
                    <i class="bi bi-youtube"></i>
                </a>
                <a href="mailto:contact@streetsarchives.com" class="social-link" aria-label="Email">
                    <i class="bi bi-envelope-paper"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// Cart Functions - UPDATED VERSION
function updateQuantity(index, change, newValue = null) {
    let quantity;
    if (newValue !== null) {
        quantity = parseInt(newValue);
        if (quantity < 1) quantity = 1;
    } else {
        const currentInput = document.querySelector(`#quantity-${index}`);
        quantity = parseInt(currentInput.value) + change;
        if (quantity < 1) quantity = 1;
    }
    
    // Update immediately for better UX
    const currentInput = document.querySelector(`#quantity-${index}`);
    if (currentInput) {
        currentInput.value = quantity;
    }
    
    fetch('update_cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `index=${index}&quantity=${quantity}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Quantity updated!');
            // Update cart count in header
            updateCartCount(data.cartCount);
            // Update cart count display on page
            const cartCountElement = document.querySelector('.cart-count');
            if (cartCountElement) {
                cartCountElement.innerHTML = `<i class="bi bi-archive"></i> ${data.cartCount} ITEMS`;
            }
            // Update price totals
            updateTotal();
        } else {
            showNotification('Failed to update quantity', true);
            // Revert input value on error
            if (currentInput) {
                currentInput.value = quantity - change;
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Network error', true);
        // Revert input value on error
        if (currentInput) {
            currentInput.value = quantity - change;
        }
    });
}

function removeItem(index) {
    if (confirm('Remove this item from your archive?')) {
        fetch('remove_from_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `index=${index}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification('Item removed');
                // Remove item from DOM
                const itemElement = document.getElementById(`cart-item-${index}`);
                if (itemElement) {
                    itemElement.style.opacity = '0';
                    itemElement.style.transform = 'translateX(100px)';
                    setTimeout(() => {
                        itemElement.remove();
                        // Re-index all remaining items after removal
                        reindexCartItems();
                    }, 300);
                }
                // Update cart count
                updateCartCount(data.cartCount);
                // Update cart count display
                const cartCountElement = document.querySelector('.cart-count');
                if (cartCountElement) {
                    if (data.cartItems === 0) {
                        cartCountElement.innerHTML = `<i class="bi bi-archive"></i> 0 ITEMS`;
                    } else {
                        cartCountElement.innerHTML = `<i class="bi bi-archive"></i> ${data.cartCount} ITEMS`;
                    }
                }
                // Update total
                updateTotal();
                // Reload if cart is empty
                if (data.cartItems === 0) {
                    setTimeout(() => {
                        location.reload();
                    }, 1500);
                }
            } else {
                showNotification('Failed to remove item', true);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Network error', true);
        });
    }
}

function updateCartCount(count) {
    // Update all cart count elements
    const cartElements = document.querySelectorAll('.cart');
    cartElements.forEach(cart => {
        cart.textContent = `CART (${count})`;
    });
}

function updateTotal() {
    // Calculate new total
    let subtotal = 0;
    document.querySelectorAll('.cart-item').forEach(item => {
        const priceElement = item.querySelector('.cart-item-price');
        const quantityInput = item.querySelector('input[type="number"]');
        
        if (priceElement && quantityInput) {
            const priceText = priceElement.textContent;
            const price = parseFloat(priceText.replace(/[^0-9.]/g, ''));
            const quantity = parseInt(quantityInput.value);
            
            if (!isNaN(price) && !isNaN(quantity)) {
                subtotal += price * quantity;
            }
        }
    });
    
    // Update subtotal display
    const subtotalElements = document.querySelectorAll('.summary-row span');
    if (subtotalElements.length >= 2) {
        subtotalElements[1].textContent = `R ${subtotal.toFixed(2)}`;
        subtotalElements[3].textContent = `R ${subtotal.toFixed(2)}`;
    }
}

function reindexCartItems() {
    // Re-index all cart items in the DOM
    const cartItems = document.querySelectorAll('.cart-item');
    cartItems.forEach((item, newIndex) => {
        // Update the id
        item.id = `cart-item-${newIndex}`;
        
        // Update quantity input id and event handlers
        const quantityInput = item.querySelector('input[type="number"]');
        if (quantityInput) {
            quantityInput.id = `quantity-${newIndex}`;
            // Remove old event listeners
            quantityInput.replaceWith(quantityInput.cloneNode(true));
            
            // Add new event listener to the cloned input
            const newInput = item.querySelector(`#quantity-${newIndex}`);
            newInput.addEventListener('change', (e) => {
                updateQuantity(newIndex, 0, e.target.value);
            });
        }
        
        // Update button event handlers
        const buttons = item.querySelectorAll('button');
        buttons.forEach(button => {
            // Remove old event listeners by cloning
            button.replaceWith(button.cloneNode(true));
        });
        
        // Add new event listeners to buttons
        const decButton = item.querySelector('button:first-child');
        const incButton = item.querySelector('button:last-child');
        const removeButton = item.querySelector('.cart-item-remove');
        
        if (decButton) {
            decButton.onclick = () => updateQuantity(newIndex, -1);
        }
        if (incButton) {
            incButton.onclick = () => updateQuantity(newIndex, 1);
        }
        if (removeButton) {
            removeButton.onclick = () => removeItem(newIndex);
        }
    });
}

function showNotification(message, isError = false) {
    const notification = document.getElementById('cartNotification');
    if (notification) {
        notification.innerHTML = `<i class="bi ${isError ? 'bi-x-circle' : 'bi-check-circle'}"></i><span>${message}</span>`;
        notification.style.background = isError ? '#dc3545' : 'var(--accent)';
        notification.style.display = 'flex';
        notification.style.opacity = '1';
        
        // Auto-hide after 3 seconds
        clearTimeout(window.notificationTimeout);
        window.notificationTimeout = setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 300);
        }, 3000);
    }
}

function checkout() {
    showNotification('Proceeding to checkout...');
    setTimeout(() => {
        window.location.href = 'checkout.php';
    }, 1000);
}

// Initialize event listeners on page load
document.addEventListener('DOMContentLoaded', function() {
    // Initialize quantity inputs
    document.querySelectorAll('input[type="number"]').forEach((input, index) => {
        input.addEventListener('change', (e) => {
            updateQuantity(index, 0, e.target.value);
        });
    });
    
    // Ensure notification starts hidden
    const notification = document.getElementById('cartNotification');
    if (notification) {
        notification.style.display = 'none';
        notification.style.opacity = '0';
    }
});

// Back to Top
window.addEventListener('scroll', () => {
    const scrollPercent = (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100;
    const progress = document.getElementById('progress');
    if (progress) {
        progress.style.width = scrollPercent + '%';
    }
    
    // Back to top button
    if (window.scrollY > 300) {
        document.getElementById('back-to-top').style.display = 'flex';
    } else {
        document.getElementById('back-to-top').style.display = 'none';
    }
});

document.getElementById('back-to-top').addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Floating Contact Form
const contactToggle = document.getElementById('contactToggle');
const contactPanel = document.getElementById('contactPanel');
const contactClose = document.getElementById('contactClose');
const contactForm = document.getElementById('contactForm');

if (contactToggle && contactPanel) {
    contactToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        contactToggle.classList.toggle('active');
        contactPanel.classList.toggle('active');
    });
    
    if (contactClose) {
        contactClose.addEventListener('click', (e) => {
            e.stopPropagation();
            contactToggle.classList.remove('active');
            contactPanel.classList.remove('active');
        });
    }
    
    document.addEventListener('click', (e) => {
        if (!contactPanel.contains(e.target) && !contactToggle.contains(e.target)) {
            contactToggle.classList.remove('active');
            contactPanel.classList.remove('active');
        }
    });
    
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const formData = new FormData(contactForm);
            const data = Object.fromEntries(formData);
            
            if (data.email && data.message) {
                const submitBtn = contactForm.querySelector('button[type="submit"]');
                const originalHTML = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<i class="bi bi-arrow-repeat"></i><span>TRANSMITTING...</span>';
                
                setTimeout(() => {
                    submitBtn.innerHTML = '<i class="bi bi-check-circle"></i><span>TRANSMISSION SENT</span>';
                    submitBtn.style.background = '#10b981';
                    
                    contactForm.reset();
                    
                    setTimeout(() => {
                        contactToggle.classList.remove('active');
                        contactPanel.classList.remove('active');
                        
                        setTimeout(() => {
                            submitBtn.innerHTML = originalHTML;
                            submitBtn.style.background = 'var(--accent)';
                        }, 1000);
                    }, 1500);
                }, 1500);
            }
        });
    }
}

// Theme toggle functionality
const themeToggle = document.getElementById('theme-toggle');
if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
        themeToggle.innerHTML = document.body.classList.contains('dark') 
            ? '<i class="bi bi-sun"></i>' 
            : '<i class="bi bi-moon"></i>';
    });
    
    // Load saved theme
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark');
        themeToggle.innerHTML = '<i class="bi bi-sun"></i>';
    }
}

// Ensure header search works
const searchInput = document.getElementById('search');
if (searchInput) {
    searchInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter' && searchInput.value.trim()) {
            window.location.href = `fashion.php?search=${encodeURIComponent(searchInput.value)}`;
        }
    });
}
</script>
</body>
</html>