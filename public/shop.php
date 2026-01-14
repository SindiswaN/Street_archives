<?php
$pageTitle = 'Shop';
require_once(__DIR__ . '/../app/config.php');
$cartCount = getCartCount();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>STREETS ARCHIVES - <?php echo $pageTitle; ?></title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
/* ---------- GLOBAL ---------- */
*{margin:0;padding:0;box-sizing:border-box;}

body{
  font-family:'Poppins', sans-serif;
  background: var(--bg);
  color: var(--text);
  overflow-x: hidden;
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

/* Preloader */
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

/* Dark Mode */
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

/* ---------- TOP BAR ---------- */
.top-bar{background:var(--black); color:white; padding:10px 0; overflow:hidden;}
.top-bar p{animation: scrollText 35s linear infinite; font-size:14px; white-space: nowrap;}
@keyframes scrollText{ 0%{transform:translateX(100%);} 100%{transform:translateX(-100%);} }

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

/* ---------- NEW MULTIDISCIPLINARY HERO ---------- */
.hero {
  height: 85vh;
  background: #000;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  color: #fff;
}

.hero-collage {
  position: absolute;
  top: 0; left: 0; width: 100%; height: 100%;
  display: flex;
  opacity: 0.5;
  filter: grayscale(100%) contrast(1.1);
  z-index: 1;
  will-change: transform;
}

.stream {
  flex: 1;
  height: 100%;
  background-size: cover;
  background-position: center;
  border-right: 1px solid rgba(255,255,255,0.1);
  transition: flex 0.7s cubic-bezier(0.22, 1, 0.36, 1);
}
.stream:hover { flex: 1.4; filter: grayscale(0%); opacity: 0.9; }

.s-fashion { background-image: url('images/image6.jpg'); }
.s-media { background-image: url('images/image5.jpg'); }
.s-music { background-image: url('images/image1.jpg'); }

.hero::before {
  content: " ";
  position: absolute;
  top: 0; left: 0; width: 100%; height: 100%;
  background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.15) 50%),
              linear-gradient(90deg, rgba(255, 0, 0, 0.03), rgba(0, 255, 0, 0.01), rgba(0, 0, 255, 0.03));
  background-size: 100% 4px, 3px 100%;
  z-index: 3;
  pointer-events: none;
}

.hero-content {
  position: relative;
  z-index: 10;
  text-align: center;
  mix-blend-mode: difference;
}

.hero-content h1 {
  font-size: clamp(40px, 10vw, 90px);
  font-weight: 800;
  line-height: 0.85;
  text-transform: uppercase;
  letter-spacing: -2px;
}

.hero-content p.tagline {
  font-size: 11px;
  letter-spacing: 5px;
  margin-top: 20px;
  text-transform: uppercase;
  opacity: 0.8;
}

.terminal-data {
  position: absolute;
  top: 30px;
  left: 30px;
  font-family: monospace;
  font-size: 10px;
  color: #fff;
  z-index: 10;
  text-transform: uppercase;
  line-height: 1.6;
  opacity: 0.6;
}
.terminal-data span { display: block; }

.btn-hero {
  display: inline-block;
  margin-top: 35px;
  padding: 14px 35px;
  border: 1px solid #fff;
  background: transparent;
  color: #fff;
  text-decoration: none;
  font-weight: 700;
  text-transform: uppercase;
  font-size: 11px;
  letter-spacing: 2px;
  transition: 0.3s;
}
.btn-hero:hover { background: #fff; color: #000; }

/* ---------- FOLDER BLOCKS ---------- */
.folder-section {
  width: 85%;
  max-width: 1100px;
  margin: 120px auto;
  position: relative;
  opacity: 0;
  transform: translateY(80px);
  transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);
}

.folder-tab {
  width: 180px;
  height: 35px;
  background: var(--offwhite);
  border: 2px solid var(--black);
  border-bottom: none;
  border-radius: 12px 12px 0 0;
  position: relative;
  z-index: 2;
  display: flex;
  align-items: center;
  padding-left: 20px;
  font-weight: 800;
  font-size: 11px;
  letter-spacing: 1px;
}

.folder-body {
  background: var(--offwhite);
  border: 2px solid var(--black);
  border-radius: 0 15px 15px 15px;
  padding: 40px;
  box-shadow: 12px 12px 0px var(--black);
  margin-top: -2px;
  position: relative;
  z-index: 1;
  transition: all 0.4s ease;
}

.folder-section:hover .folder-body {
  transform: translate(-5px, -5px);
  box-shadow: 20px 20px 0px var(--black);
}

.folder-content {
  display: grid;
  grid-template-columns: 1fr 1.2fr;
  gap: 40px;
  align-items: center;
}

.folder-image img {
  width: 100%;
  height: auto;
  border-radius: 4px;
  display: block;
  border: 1px solid #ddd;
}

.folder-image video {
  width: 100%;
  height: auto;
  border-radius: 4px;
  display: block;
  border: 1px solid #ddd;
}

.folder-text h3 {
    font-size: 32px;
    font-weight: 800;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.folder-section.show { opacity: 1; transform: translateY(0); }

/* RESTORED ORIGINAL BUTTONS */
.btn{
  display:inline-block;
  margin-top:15px;
  padding:12px 28px;
  border:2px solid var(--black);
  text-decoration:none;
  color:var(--black);
  font-weight:700;
  transition: .3s;
  text-transform: uppercase;
  font-size: 12px;
}
.btn:hover{background:var(--black); color:white;}

/* ---------- MUSIC PLAYER ---------- */
.audio-player {
  background: #000;
  color: #fff;
  padding: 15px;
  margin-top: 20px;
  border-radius: 4px;
}
.player-controls { display: flex; align-items: center; gap: 10px; margin-top: 5px; }
.play-btn { background: #fff; border: none; padding: 5px 12px; cursor: pointer; font-weight: 800; border-radius: 2px; }
.progress-bar { flex-grow: 1; height: 4px; background: #333; cursor: pointer; position: relative; }
.progress-fill { width: 0%; height: 100%; background: var(--accent); }

/* ---------- CATEGORIES, PRODUCTS, CAROUSEL ---------- */
.categories{ width:80%; margin:80px auto; display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.category{ background:#f2f2f2; padding:60px 20px; border:1px solid #ddd; text-align:center; font-weight:700; cursor: pointer; transition: .3s;}
.category:hover{background:#eee; border-color: #000;}

.products{width:80%;margin:80px auto;}
.grid{display:grid; grid-template-columns:repeat(4,1fr); gap:20px;}
.product{border:1px solid #ddd; padding:16px; opacity: 0; animation: fadeInUp 0.5s ease-out forwards;}
.product img{width:100%; margin-bottom: 10px; transition: transform 0.3s;}
.product:hover img { transform: scale(1.05); }

/* FIXED CAROUSEL - NO DELAY */
.carousel {
  margin: 100px 0;
  overflow: hidden;
  white-space: nowrap;
  border-top: 1px solid #eee;
  border-bottom: 1px solid #eee;
  padding: 20px 0;
  transform: translateZ(0);
  -webkit-transform: translateZ(0);
}

.carousel-track {
  display: inline-flex;
  animation: slideImages 20s linear infinite;
  transform: translate3d(0, 0, 0);
  -webkit-transform: translate3d(0, 0, 0);
  will-change: transform;
  backface-visibility: hidden;
}

.carousel img {
  width: 260px;
  height: 320px;
  object-fit: cover;
  margin-right: 18px;
  display: block;
  opacity: 1 !important;
  visibility: visible !important;
  flex-shrink: 0;
}

@keyframes slideImages {
  0% { transform: translate3d(0, 0, 0); }
  100% { transform: translate3d(-50%, 0, 0); }
}

.newsletter{width:80%; margin:80px auto; padding:60px; background:var(--offwhite); text-align:center; border: 2px solid #000;}
footer{background:#111; color:white; padding:50px 5%; margin-top:60px; text-align: center; font-size: 13px; text-transform: uppercase;}

/* Scroll Progress Bar */
#progress {
    position: fixed;
    top: 0;
    left: 0;
    width: 0%;
    height: 4px;
    background: var(--accent);
    z-index: 1000;
}

/* Cursor Follower */
#cursor {
    position: fixed;
    width: 20px;
    height: 20px;
    background: var(--accent);
    border-radius: 50%;
    pointer-events: none;
    z-index: 9999;
    transition: transform 0.1s ease-out;
}

/* Product Modal */
.modal {
    display: none;
    position: fixed;
    top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.8);
    z-index: 2000;
    align-items: center;
    justify-content: center;
}
.modal.show { display: flex; }
.modal-content {
    background: var(--bg);
    padding: 20px;
    border-radius: 8px;
    max-width: 500px;
    text-align: center;
}
.modal img { width: 100%; max-height: 300px; object-fit: cover; }
.close { float: right; font-size: 28px; cursor: pointer; }

/* Toast Notification */
#toast {
    position: fixed;
    bottom: 80px;
    right: 20px;
    background: var(--accent);
    color: white;
    padding: 10px 20px;
    border-radius: 4px;
    opacity: 0;
    transform: translateY(100px);
    transition: all 0.3s;
    z-index: 1500;
}
#toast.show {
    opacity: 1;
    transform: translateY(0);
}

/* Hero Content Animation */
.hero-content { animation: fadeInUp 2s ease-out; }
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(50px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Carousel Pause on Hover */
.carousel-track:hover { animation-play-state: paused; }

/* Hamburger Animation */
.hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
.hamburger.active span:nth-child(2) { opacity: 0; }
.hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(7px, -6px); }

/* Back to Top Button */
#back-to-top {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 50px;
  height: 50px;
  background: var(--accent);
  color: white;
  border: none;
  border-radius: 50%;
  font-size: 20px;
  cursor: pointer;
  display: none;
  z-index: 100;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  transition: all 0.3s ease;
}
#back-to-top:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 16px rgba(0,0,0,0.3);
}

/* Manifesto Section */
.manifesto {
  width: 80%;
  margin: 80px auto;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 18px;
  line-height: 1.6;
  font-weight: 400;
  color: var(--text);
  background: var(--offwhite);
  padding: 40px;
  border: 2px solid var(--black);
  box-shadow: 8px 8px 0px var(--black);
}

/* Process Section */
.process {
  width: 80%;
  margin: 80px auto;
  text-align: center;
  font-family: 'Poppins', sans-serif;
  font-size: 16px;
  line-height: 1.6;
  font-weight: 400;
  color: var(--text);
  border: 2px solid var(--black);
  padding: 40px;
  background: var(--offwhite);
  box-shadow: 8px 8px 0px var(--black);
}
.process h3 {
  margin-bottom: 20px;
  font-weight: 600;
  font-size: 20px;
}
.process ol {
  list-style: none;
  padding: 0;
  counter-reset: step-counter;
}
.process li {
  margin-bottom: 10px;
  font-weight: 400;
  position: relative;
  padding-left: 30px;
  text-align: left;
  display: block;
  margin-left: auto;
  margin-right: auto;
  max-width: 400px;
}
.process li::before {
  content: counter(step-counter) ". ";
  counter-increment: step-counter;
  position: absolute;
  left: 0;
  font-weight: 600;
  color: var(--accent);
}

/* Carousel Overlay */
.carousel {
  position: relative;
}
.carousel-overlay {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: #fff;
  font-family: 'Poppins', sans-serif;
  font-size: 24px;
  font-weight: 600;
  text-align: center;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
  z-index: 10;
  pointer-events: none;
  letter-spacing: 1px;
  line-height: 1.4;
  background: rgba(0,0,0,0.4);
  padding: 15px;
  border-radius: 6px;
}
.carousel-overlay p {
  margin: 0;
}

/* ---------- FLOATING CONTACT FORM ---------- */
.floating-contact-container {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 10000 !important; /* Increased z-index */
}

.contact-toggle-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--accent);
    color: white;
    border: none;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 8px 30px rgba(255, 60, 0, 0.4);
    transition: all 0.3s var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10001 !important; /* Increased z-index */
    position: relative;
}

.contact-toggle-btn:hover {
    transform: scale(1.1);
    background: var(--black);
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
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    z-index: 10000 !important; /* Increased z-index */
}

.contact-panel.active {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.contact-panel h3 {
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--accent);
}

.contact-panel p {
    font-size: 14px;
    opacity: 0.8;
    margin-bottom: 25px;
    line-height: 1.6;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 30px;
}

.contact-form input,
.contact-form textarea {
    padding: 14px;
    background: white;
    border: 1px solid #ddd;
    border-radius: 8px;
    color: var(--text);
    font-family: 'Poppins', sans-serif; /* Changed from 'Inter' */
    font-size: 14px;
    transition: all 0.3s var(--transition);
}

.contact-form input:focus,
.contact-form textarea:focus {
    outline: none;
    border-color: var(--accent);
    background: rgba(255, 60, 0, 0.05);
}

.contact-form textarea {
    min-height: 100px;
    resize: vertical;
}

.contact-form button {
    background: var(--accent);
    color: white;
    border: none;
    padding: 14px;
    border-radius: 8px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s var(--transition);
    font-family: 'Poppins', sans-serif; /* Changed from 'Inter' */
    font-size: 13px;
}

.contact-form button:hover {
    background: var(--black);
    transform: translateY(-2px);
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 25px;
    padding-top: 25px;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.05);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text);
    text-decoration: none;
    font-size: 18px;
    transition: all 0.3s var(--transition);
}

.social-link:hover {
    background: var(--accent);
    color: white;
    transform: translateY(-3px);
}

.contact-close {
    position: absolute;
    top: 15px;
    right: 15px;
    background: transparent;
    border: none;
    color: var(--text);
    font-size: 20px;
    cursor: pointer;
    opacity: 0.7;
    transition: all 0.3s var(--transition);
}

.contact-close:hover {
    opacity: 1;
    color: var(--accent);
    transform: rotate(90deg);
}

/* Dark mode adjustments */
body.dark .contact-panel {
    background: rgba(10, 10, 10, 0.95);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

body.dark .contact-form input,
body.dark .contact-form textarea {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.08);
    color: white;
}

body.dark .social-link {
    background: rgba(255, 255, 255, 0.1);
    color: white;
}

/* Responsive */
@media (max-width: 768px) {
    .floating-contact-container {
        bottom: 20px;
        right: 20px;
    }
    
    .contact-panel {
        width: 320px;
        right: -10px;
    }
}

@media (max-width: 480px) {
    .floating-contact-container {
        bottom: 15px;
        right: 15px;
    }
    
    .contact-toggle-btn {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    
    .contact-panel {
        width: calc(100vw - 40px);
        right: -15px;
        padding: 25px;
    }
    
    .contact-panel h3 {
        font-size: 20px;
    }
}
/* Shop Categories */
.shop-categories {
    width: 85%;
    max-width: 1100px;
    margin: 60px auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.shop-category {
    background: var(--offwhite);
    border: 2px solid var(--black);
    padding: 30px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.shop-category:hover {
    transform: translateY(-5px);
    box-shadow: 12px 12px 0px var(--black);
    border-color: var(--accent);
}

.shop-category h3 {
    font-size: 20px;
    font-weight: 800;
    text-transform: uppercase;
    margin-bottom: 10px;
}

.shop-category p {
    font-size: 13px;
    color: #666;
    margin-bottom: 15px;
    line-height: 1.6;
}

.category-count {
    font-size: 11px;
    color: var(--accent);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Filter Bar */
.filter-bar {
    width: 85%;
    max-width: 1100px;
    margin: 40px auto;
    padding: 20px;
    background: var(--offwhite);
    border: 2px solid var(--black);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.filter-options {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 8px 16px;
    border: 2px solid var(--black);
    background: transparent;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    text-transform: uppercase;
    cursor: pointer;
    transition: 0.3s;
    font-size: 11px;
    letter-spacing: 1px;
}

.filter-btn:hover,
.filter-btn.active {
    background: var(--black);
    color: white;
}

.sort-select {
    padding: 8px 12px;
    border: 2px solid var(--black);
    background: var(--bg);
    color: var(--text);
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    cursor: pointer;
    font-size: 12px;
}

/* Dark mode adjustments for shop */
body.dark .shop-category {
    background: #222;
    border-color: #333;
}

body.dark .filter-bar {
    background: #222;
    border-color: #333;
}

body.dark .filter-btn {
    border-color: #333;
}

body.dark .filter-btn:hover,
body.dark .filter-btn.active {
    background: #fff;
    color: #111;
}

body.dark .sort-select {
    background: #222;
    border-color: #333;
    color: white;
}

/* Cart notification */
.cart-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: var(--accent);
    color: white;
    padding: 15px 25px;
    border-radius: 4px;
    display: none;
    z-index: 2000;
    animation: slideIn 0.3s ease-out;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 12px;
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

/* Add to cart button on products */
.add-to-cart-btn {
    margin-top: 10px;
    padding: 8px 16px;
    border: 2px solid var(--black);
    background: transparent;
    color: var(--black);
    font-weight: 700;
    text-transform: uppercase;
    font-size: 11px;
    cursor: pointer;
    transition: 0.3s;
    width: 100%;
}

.add-to-cart-btn:hover {
    background: var(--black);
    color: white;
}

.product {
    position: relative;
}

.product-quick-add {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 30px;
    height: 30px;
    background: var(--accent);
    color: white;
    border: none;
    border-radius: 50%;
    font-size: 16px;
    cursor: pointer;
    display: none;
    align-items: center;
    justify-content: center;
    transition: 0.3s;
    z-index: 10;
}

.product:hover .product-quick-add {
    display: flex;
}

.product-quick-add:hover {
    background: var(--black);
    transform: scale(1.1);
}

/* Responsive shop */
@media (max-width: 768px) {
    .shop-categories {
        grid-template-columns: 1fr;
    }
    
    .filter-bar {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .filter-options {
        width: 100%;
        justify-content: center;
    }
}
</style>
</head>

<body>

<div id="preloader">
  <div class="loader"></div>
  <p>Loading Archive...</p>
</div>

<!-- Preloader hiding script -->
<script>
window.addEventListener('load', function() {
    const preloader = document.getElementById('preloader');
    if (preloader) {
        preloader.style.opacity = '0';
        setTimeout(() => {
            preloader.style.display = 'none';
        }, 500);
    }
});

if (document.readyState === 'complete') {
    document.getElementById('preloader').style.display = 'none';
}
</script>

<div class="top-bar">
  <p>CULTURE OVER COMMODITY ~ LIVE FREE, DIE WITH MONEY ~ FASHION • MEDIA • SOUND ARCHIVE ~ CULTURE OVER COMMODITY ~ LIVE FREE, DIE WITH MONEY ~ FASHION • MEDIA • SOUND ARCHIVE</p>
</div>

<header>
  <div class="header-left">
    <input type="text" id="search" placeholder="Search products...">
    <button id="theme-toggle">🌑</button>
  </div>
  <div class="header-center">
    <a href="index.php">
      <div class="logo-container">
        <img src="images/NORMALLOGO.jpeg" class="logo-3d" alt="Logo">
      </div>
    </a>
  </div>
  <div class="header-right">
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="cart" onclick="window.location.href='cart.php'">CART (<?php echo $cartCount; ?>)</div>
  </div>
</header>

<div class="mobile-menu" id="mobileMenu">
  <a href="index.php">Home</a>
  <a href="shop.php">Shop</a>
  <a href="music.php">Music</a>
  <a href="cart.php">Cart (<?php echo $cartCount; ?>)</a>
</div>

<section class="hero">
  <div class="hero-collage">
    <div class="stream s-fashion"></div>
    <div class="stream s-media"></div>
    <div class="stream s-music"></div>
  </div>

  <div class="terminal-data">
    <span>STATUS: ACTIVE</span>
    <span>ENCRYPTION: AES-256</span>
    <span>LOC: SOUTH_AFRICA_HQ</span>
  </div>

  <div class="hero-content">
    <h1>FASHION<br>ARCHIVE</h1>
    <p class="tagline">Curated Vintage & Streetwear</p>
    <a href="#collection" class="btn-hero">Browse Collection</a>
  </div>
</section>

<section class="manifesto">
  <p>Every garment in our collection tells a story. We source from the streets, from private collections, and from forgotten corners of South Africa's urban landscape. Each piece is one-of-one, carrying the unique energy of its previous life.</p>
</section>

<div class="shop-categories">
    <div class="shop-category" onclick="filterCategory('jackets')">
        <h3>JACKETS ARCHIVE</h3>
        <p>Vintage and contemporary jackets from across South Africa. Denim, leather, and unique outerwear pieces.</p>
        <div class="category-count">24 ITEMS</div>
    </div>
    
    <div class="shop-category" onclick="filterCategory('shirts')">
        <h3>SHIRTS COLLECTION</h3>
        <p>T-shirts, button-ups, and unique tops with character and history from urban centers.</p>
        <div class="category-count">18 ITEMS</div>
    </div>
    
    <div class="shop-category" onclick="filterCategory('pants')">
        <h3>PANTS & DENIM</h3>
        <p>Curated selection of vintage pants, jeans, and trousers with authentic wear patterns.</p>
        <div class="category-count">16 ITEMS</div>
    </div>
    
    <div class="shop-category" onclick="filterCategory('accessories')">
        <h3>ACCESSORIES</h3>
        <p>Hats, bags, and unique accessories that complete the streetwear aesthetic.</p>
        <div class="category-count">12 ITEMS</div>
    </div>
</div>

<div class="filter-bar">
    <div class="filter-options">
        <button class="filter-btn active" data-filter="all">All Items</button>
        <button class="filter-btn" data-filter="jackets">Jackets</button>
        <button class="filter-btn" data-filter="shirts">Shirts</button>
        <button class="filter-btn" data-filter="pants">Pants</button>
        <button class="filter-btn" data-filter="accessories">Accessories</button>
    </div>
    
    <select class="sort-select" id="sortSelect">
        <option value="newest">Newest First</option>
        <option value="price-low">Price: Low to High</option>
        <option value="price-high">Price: High to Low</option>
        <option value="name">Name A-Z</option>
    </select>
</div>

<section class="products" id="collection">
  <h2 style="margin-bottom: 30px; text-transform: uppercase; font-weight: 800;">Complete Archive</h2>
  <div class="grid" id="products-grid">
    <?php if (isset($products)): ?>
    <?php foreach ($products as $product): ?>
    <div class="product" data-category="<?php echo $product['category']; ?>">
        <button class="product-quick-add" onclick="addToCart('<?php echo $product['id']; ?>', '<?php echo addslashes($product['name']); ?>', '<?php echo $product['price']; ?>', 'images/<?php echo $product['images'][0]; ?>', 'M', 1, 'fashion')">+</button>
        <img src="images/<?php echo $product['images'][0]; ?>" loading="lazy" alt="<?php echo $product['name']; ?>">
        <p><?php echo $product['name']; ?><br>Found in <?php echo $product['location']; ?><br>One of One</p>
        <strong><?php echo $product['price']; ?></strong>
        <button class="add-to-cart-btn" onclick="addToCart('<?php echo $product['id']; ?>', '<?php echo addslashes($product['name']); ?>', '<?php echo $product['price']; ?>', 'images/<?php echo $product['images'][0]; ?>', 'M', 1, 'fashion')">ADD TO CART</button>
    </div>
    <?php endforeach; ?>
    <?php else: ?>
    <p>No products available.</p>
    <?php endif; ?>
  </div>
</section>

<section class="process">
  <h3>Our Curatorial Process</h3>
  <ol>
    <li><strong>Sourcing:</strong> Hunting for authentic pieces in markets, thrift stores, and private collections across South Africa.</li>
    <li><strong>Authentication:</strong> Verifying age, origin, and condition of each garment.</li>
    <li><strong>Documentation:</strong> Photographing, measuring, and recording the story of each piece.</li>
    <li><strong>Preservation:</strong> Professional cleaning and minimal restoration when necessary.</li>
    <li><strong>Archiving:</strong> Adding to the digital archive with complete transparency about condition and history.</li>
  </ol>
</section>

<section class="newsletter">
  <h3>Join the Archive</h3>
  <p style="margin-bottom: 20px; font-size: 14px;">Receive new releases, broadcasts, and recovered pieces before they go public.</p>
  <input type="email" id="newsletter-email" placeholder="Enter your email" style="padding:15px; border:1px solid #000; width:250px;">
  <button class="btn" id="subscribe-btn" style="margin-top:0; margin-left: 10px; background: #000; color: #fff; border: none;">Subscribe to Archive</button>
</section>

<footer>
  <p>STREETS ARCHIVES — SOUTH AFRICA<br>FASHION • SOUND • VISUAL RECORDS<br>EST. 2026</p>
  <p>Privacy • Shipping • Returns • Contact</p>
</footer>

<div id="progress"></div>
<div id="cursor"></div>
<div id="toast"></div>
<div class="cart-notification" id="cartNotification">Item added to cart!</div>

<div class="modal" id="productModal">
  <div class="modal-content">
    <span class="close" id="closeModal">&times;</span>
    <img id="modalImg" src="" alt="Product">
    <h3 id="modalTitle">Product Title</h3>
    <p id="modalDesc">Product description here.</p>
    <strong id="modalPrice">R 799</strong>
  </div>
</div>

<button id="back-to-top">↑</button>

<script>
// Shop page specific JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Filter functionality
    const filterButtons = document.querySelectorAll('.filter-btn');
    const sortSelect = document.getElementById('sortSelect');
    const productsGrid = document.getElementById('products-grid');
    const products = Array.from(productsGrid.children);
    
    // Filter buttons
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class from all buttons
            filterButtons.forEach(btn => btn.classList.remove('active'));
            // Add active class to clicked button
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            filterProducts(filter);
        });
    });
    
    // Sort select
    sortSelect.addEventListener('change', function() {
        const filter = document.querySelector('.filter-btn.active').getAttribute('data-filter');
        filterProducts(filter);
    });
    
    // Category buttons
    document.querySelectorAll('.shop-category').forEach(category => {
        category.addEventListener('click', function() {
            const categoryName = this.querySelector('h3').textContent;
            let filter = 'all';
            
            if (categoryName.includes('JACKETS')) filter = 'jackets';
            else if (categoryName.includes('SHIRTS')) filter = 'shirts';
            else if (categoryName.includes('PANTS')) filter = 'pants';
            else if (categoryName.includes('ACCESSORIES')) filter = 'accessories';
            
            // Update filter buttons
            filterButtons.forEach(btn => {
                if (btn.getAttribute('data-filter') === filter) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
            
            filterProducts(filter);
        });
    });
    
    function filterProducts(filter) {
        const sortValue = sortSelect.value;
        
        // Create array of products with their data
        const productData = products.map(product => {
            const price = parseInt(product.querySelector('strong').textContent.replace('R ', ''));
            const name = product.querySelector('p').textContent;
            const category = product.getAttribute('data-category') || '';
            return { element: product, price, name, category };
        });
        
        // Sort based on selection
        if (sortValue === 'price-low') {
            productData.sort((a, b) => a.price - b.price);
        } else if (sortValue === 'price-high') {
            productData.sort((a, b) => b.price - a.price);
        } else if (sortValue === 'name') {
            productData.sort((a, b) => a.name.localeCompare(b.name));
        }
        // 'newest' keeps original order
        
        // Clear grid and append sorted products
        productsGrid.innerHTML = '';
        productData.forEach(item => {
            // Show all products or filtered ones
            if (filter === 'all' || item.category === filter) {
                productsGrid.appendChild(item.element);
            }
        });
    }
    
    function filterCategory(category) {
        // Scroll to products section
        document.getElementById('collection').scrollIntoView({ behavior: 'smooth' });
        
        // Update active filter button based on category
        filterButtons.forEach(btn => {
            if (btn.getAttribute('data-filter') === category) {
                btn.click();
            }
        });
    }
    
    // Newsletter subscription
    document.getElementById('subscribe-btn').addEventListener('click', function() {
        const email = document.getElementById('newsletter-email').value;
        if (email && email.includes('@')) {
            alert('Thank you for subscribing to our newsletter!');
            document.getElementById('newsletter-email').value = '';
        } else {
            alert('Please enter a valid email address.');
        }
    });
    
    // Search functionality
    document.getElementById('search').addEventListener('input', (e) => {
        const query = e.target.value.toLowerCase();
        document.querySelectorAll('.product').forEach(product => {
            const title = product.querySelector('p').textContent.toLowerCase();
            if (title.includes(query)) {
                product.style.display = 'block';
            } else {
                product.style.display = 'none';
            }
        });
    });
});

// Add to cart function
function addToCart(productId, name, price, image, size, quantity, type) {
    // Create form data
    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('name', name);
    formData.append('price', price);
    formData.append('image', image);
    formData.append('size', size);
    formData.append('quantity', quantity);
    formData.append('type', type);
    
    // Send AJAX request
    fetch('add_to_cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update cart count
            document.querySelectorAll('.cart').forEach(cart => {
                cart.textContent = `CART (${data.cartCount})`;
            });
            
            // Show notification
            const notification = document.getElementById('cartNotification');
            notification.textContent = `${name} added to cart!`;
            notification.style.display = 'block';
            
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
</script>

<!-- Floating Contact Form -->
<div class="floating-contact-container">
    <button class="contact-toggle-btn" id="contactToggle" aria-label="Open contact form">
        ✉️
    </button>
    
    <div class="contact-panel" id="contactPanel">
        <button class="contact-close" id="contactClose">&times;</button>
        
        <h3>CONTACT ARCHIVES</h3>
        <p>Send us a message directly or connect through our social channels.</p>
        
        <form class="contact-form" id="contactForm">
            <input type="text" placeholder="Your Name" required>
            <input type="email" placeholder="Email Address" required>
            <textarea placeholder="Your Message..." required></textarea>
            <button type="submit">Send Message</button>
        </form>
        
        <div class="social-links">
            <a href="https://instagram.com" class="social-link" target="_blank" aria-label="Instagram">
                📸
            </a>
            <a href="https://twitter.com" class="social-link" target="_blank" aria-label="Twitter">
                𝕏
            </a>
            <a href="https://soundcloud.com" class="social-link" target="_blank" aria-label="SoundCloud">
                🎵
            </a>
            <a href="https://youtube.com" class="social-link" target="_blank" aria-label="YouTube">
                ▶️
            </a>
            <a href="mailto:contact@streetsarchives.com" class="social-link" aria-label="Email">
                ✉️
            </a>
        </div>
    </div>
</div>

<script src="../js/main.js"></script>
</body>
</html>