<?php
$pageTitle = 'Fashion';
require_once(__DIR__ . '/../app/config.php');
require_once(__DIR__ . '/../app/database.php');
$cartCount = getCartCount();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>STREETS ARCHIVES - <?php echo $pageTitle; ?></title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link href="menustyle.css" rel="stylesheet">
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
.top-bar {
  background: #111111; 
  color: #ffffff; 
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

/* ---------- MOBILE MENU ENHANCED ---------- */

/* Hamburger Button Styling */
.hamburger {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 30px;
  height: 24px;
  cursor: pointer;
  z-index: 1001;
  position: relative;
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.hamburger span {
  width: 100%;
  height: 2px;
  background-color: var(--text);
  transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
  transform-origin: left center;
}

.hamburger.active span:nth-child(1) {
  transform: rotate(45deg) translateY(-2px);
  background-color: var(--accent);
}

.hamburger.active span:nth-child(2) {
  opacity: 0;
  transform: translateX(-10px);
}

.hamburger.active span:nth-child(3) {
  transform: rotate(-45deg) translateY(2px);
  background-color: var(--accent);
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

/* ---------- FASHION HERO (Styled like Music page) ---------- */
.hero {
    height: 70vh;
    background: linear-gradient(rgba(0,0,0,0.85), rgba(0,0,0,0.85)), url('images/herobg1.jpeg');
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

.hero::before {
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

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    padding: 0 20px;
}

.hero-content h1 {
    font-size: 6rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -3px;
    margin-bottom: 20px;
    line-height: 0.9;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.hero-content .tagline {
    font-size: 1.2rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    opacity: 0.8;
    margin-bottom: 40px;
    font-weight: 300;
}

.terminal-data {
    position: absolute;
    top: 30px;
    left: 30px;
    font-family: 'Space Mono', monospace;
    font-size: 10px;
    color: rgba(255,255,255,0.7);
    z-index: 10;
    text-transform: uppercase;
    line-height: 1.6;
    letter-spacing: 1px;
    background: rgba(0, 0, 0, 0.3);
    padding: 15px;
    border-radius: 8px;
    backdrop-filter: blur(5px);
    border: 1px solid rgba(255,255,255,0.1);
}

.terminal-data span { 
    display: block; 
    transition: opacity 0.3s;
}

.terminal-data span:hover {
    opacity: 1;
    color: var(--accent);
}

.btn-hero {
    display: inline-block;
    padding: 14px 35px;
    border: 2px solid #fff;
    background: transparent;
    color: #fff;
    text-decoration: none;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 11px;
    letter-spacing: 2px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.btn-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: #fff;
    transition: left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: -1;
}

.btn-hero:hover {
    color: #000;
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.2);
}

.btn-hero:hover::before {
    left: 0;
}

/* Responsive adjustments */
@media (max-width: 1024px) {
    .hero-content h1 {
        font-size: 5rem;
    }
}

@media (max-width: 768px) {
    .hero {
        height: 70vh;
        background-attachment: scroll;
    }
    
    .hero-content h1 {
        font-size: 4rem;
        letter-spacing: -2px;
    }
    
    .hero-content .tagline {
        font-size: 1rem;
        letter-spacing: 3px;
    }
    
    .terminal-data {
        top: 20px;
        left: 20px;
        font-size: 9px;
        padding: 10px;
    }
}

@media (max-width: 480px) {
    .hero-content h1 {
        font-size: 3rem;
    }
    
    .hero-content .tagline {
        font-size: 0.9rem;
        letter-spacing: 2px;
    }
    
    .btn-hero {
        padding: 12px 25px;
        font-size: 10px;
    }
}
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
  max-width: 1100px;
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
  max-width: 1100px;
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

/* ---------- ENHANCED FLOATING CONTACT FORM ---------- */
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
    font-size: 24px;
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

/* FIXED: Contact panel positioned ABOVE the button */
.contact-panel {
    position: absolute;
    bottom: 70px; /* This positions it above the button */
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
    max-height: calc(100vh - 120px);
    overflow-y: auto;
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

/* Form Groups with Icons */
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

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(255, 60, 0, 0.1);
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

/* Dark mode adjustments */
body.dark .contact-panel {
    background: rgba(10, 10, 10, 0.95);
    border: 1px solid rgba(255, 255, 255, 0.08);
}

body.dark .form-group input,
body.dark .form-group textarea {
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
        width: calc(100vw - 40px);
        right: -15px;
        padding: 25px;
    }
    
    .contact-toggle-btn {
        width: 55px;
        height: 55px;
        font-size: 22px;
    }
    
    /* Adjust back-to-top button for mobile */
    #back-to-top {
        bottom: 90px;
        right: 20px;
        width: 45px;
        height: 45px;
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
    
    .grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 480px) {
    .grid {
        grid-template-columns: 1fr;
    }
    
    .hero {
        height: 70vh;
    }
    
    .hero-content h1 {
        font-size: clamp(30px, 8vw, 60px);
    }
}


/* FIX: Add proper animations for products */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.product:nth-child(1) { animation-delay: 0.1s; }
.product:nth-child(2) { animation-delay: 0.2s; }
.product:nth-child(3) { animation-delay: 0.3s; }
.product:nth-child(4) { animation-delay: 0.4s; }
.product:nth-child(5) { animation-delay: 0.5s; }
.product:nth-child(6) { animation-delay: 0.6s; }
.product:nth-child(7) { animation-delay: 0.7s; }
.product:nth-child(8) { animation-delay: 0.8s; }
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

<?php require_once(__DIR__ . "/../includes/header.php") ?>

<section class="hero">
  <div class="terminal-data">
    <span><i class="bi bi-check-circle"></i> STATUS: ACTIVE</span>
    <span><i class="bi bi-shield-lock"></i> ENCRYPTION: AES-256</span>
    <span><i class="bi bi-geo-alt"></i> LOC: SOUTH_AFRICA_HQ</span>
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
        <h3><i class="bi bi-jacket"></i> JACKETS ARCHIVE</h3>
        <p>Vintage and contemporary jackets from across South Africa. Denim, leather, and unique outerwear pieces.</p>
        <div class="category-count">24 ITEMS</div>
    </div>
    
    <div class="shop-category" onclick="filterCategory('shirts')">
        <h3><i class="bi bi-tshirt"></i> SHIRTS COLLECTION</h3>
        <p>T-shirts, button-ups, and unique tops with character and history from urban centers.</p>
        <div class="category-count">18 ITEMS</div>
    </div>
    
    <div class="shop-category" onclick="filterCategory('pants')">
        <h3><i class="bi bi-tags"></i> PANTS & DENIM</h3>
        <p>Curated selection of vintage pants, jeans, and trousers with authentic wear patterns.</p>
        <div class="category-count">16 ITEMS</div>
    </div>
    
    <div class="shop-category" onclick="filterCategory('accessories')">
        <h3><i class="bi bi-watch"></i> ACCESSORIES</h3>
        <p>Hats, bags, and unique accessories that complete the streetwear aesthetic.</p>
        <div class="category-count">12 ITEMS</div>
    </div>
</div>

<div class="filter-bar">
    <div class="filter-options">
        <button class="filter-btn active" data-filter="all"><i class="bi bi-grid"></i> All Items</button>
        <button class="filter-btn" data-filter="jackets"><i class="bi bi-jacket"></i> Jackets</button>
        <button class="filter-btn" data-filter="shirts"><i class="bi bi-tshirt"></i> Shirts</button>
        <button class="filter-btn" data-filter="pants"><i class="bi bi-tags"></i> Pants</button>
        <button class="filter-btn" data-filter="accessories"><i class="bi bi-watch"></i> Accessories</button>
    </div>
    
    <select class="sort-select" id="sortSelect">
        <option value="newest"><i class="bi bi-clock"></i> Newest First</option>
        <option value="price-low"><i class="bi bi-arrow-up"></i> Price: Low to High</option>
        <option value="price-high"><i class="bi bi-arrow-down"></i> Price: High to Low</option>
        <option value="name"><i class="bi bi-sort-alpha-down"></i> Name A-Z</option>
    </select>
</div>

<section class="products" id="collection">
  <h2 style="margin-bottom: 30px; text-transform: uppercase; font-weight: 800;">Complete Archive</h2>
  <div class="grid" id="products-grid">
    <!-- Products will be loaded here via JavaScript -->
    <div class="product" data-category="jackets">
        <button class="product-quick-add" onclick="addToCart('jacket-001', 'VINTAGE DENIM JACKET', 'R 899', 'images/image6.jpg', 'M', 1, 'fashion')">
            <i class="bi bi-plus"></i>
        </button>
        <img src="images/image6.jpg" loading="lazy" alt="Vintage Denim Jacket">
        <p>ARCHIVE PIECE #014<br>Found in Johannesburg<br>One of One</p>
        <strong>R 899</strong>
        <button class="add-to-cart-btn" onclick="addToCart('jacket-001', 'VINTAGE DENIM JACKET', 'R 899', 'images/image6.jpg', 'M', 1, 'fashion')">
            <i class="bi bi-cart-plus"></i> ADD TO CART
        </button>
    </div>
    
    <div class="product" data-category="shirts">
        <button class="product-quick-add" onclick="addToCart('shirt-001', 'GRAPHIC T-SHIRT', 'R 599', 'images/image5.jpg', 'L', 1, 'fashion')">
            <i class="bi bi-plus"></i>
        </button>
        <img src="images/image5.jpg" loading="lazy" alt="Graphic T-Shirt">
        <p>ARCHIVE PIECE #027<br>Found in Cape Town<br>One of One</p>
        <strong>R 599</strong>
        <button class="add-to-cart-btn" onclick="addToCart('shirt-001', 'GRAPHIC T-SHIRT', 'R 599', 'images/image5.jpg', 'L', 1, 'fashion')">
            <i class="bi bi-cart-plus"></i> ADD TO CART
        </button>
    </div>
    
    <div class="product" data-category="pants">
        <button class="product-quick-add" onclick="addToCart('pants-001', 'CARGO PANTS', 'R 799', 'images/image7.jpg', '32', 1, 'fashion')">
            <i class="bi bi-plus"></i>
        </button>
        <img src="images/image7.jpg" loading="lazy" alt="Cargo Pants">
        <p>ARCHIVE PIECE #089<br>Found in Pretoria<br>One of One</p>
        <strong>R 799</strong>
        <button class="add-to-cart-btn" onclick="addToCart('pants-001', 'CARGO PANTS', 'R 799', 'images/image7.jpg', '32', 1, 'fashion')">
            <i class="bi bi-cart-plus"></i> ADD TO CART
        </button>
    </div>
    
    <div class="product" data-category="jackets">
        <button class="product-quick-add" onclick="addToCart('jacket-002', 'LEATHER JACKET', 'R 1299', 'images/image1.jpg', 'L', 1, 'fashion')">
            <i class="bi bi-plus"></i>
        </button>
        <img src="images/image1.jpg" loading="lazy" alt="Leather Jacket">
        <p>ARCHIVE PIECE #156<br>Found in Durban<br>One of One</p>
        <strong>R 1299</strong>
        <button class="add-to-cart-btn" onclick="addToCart('jacket-002', 'LEATHER JACKET', 'R 1299', 'images/image1.jpg', 'L', 1, 'fashion')">
            <i class="bi bi-cart-plus"></i> ADD TO CART
        </button>
    </div>
    
    <div class="product" data-category="shirts">
        <button class="product-quick-add" onclick="addToCart('shirt-002', 'FLANNEL SHIRT', 'R 699', 'images/image2.jpg', 'M', 1, 'fashion')">
            <i class="bi bi-plus"></i>
        </button>
        <img src="images/image2.jpg" loading="lazy" alt="Flannel Shirt">
        <p>ARCHIVE PIECE #045<br>Found in Soweto<br>One of One</p>
        <strong>R 699</strong>
        <button class="add-to-cart-btn" onclick="addToCart('shirt-002', 'FLANNEL SHIRT', 'R 699', 'images/image2.jpg', 'M', 1, 'fashion')">
            <i class="bi bi-cart-plus"></i> ADD TO CART
        </button>
    </div>
    
    <div class="product" data-category="accessories">
        <button class="product-quick-add" onclick="addToCart('accessory-001', 'VINTAGE CAP', 'R 399', 'images/image3.jpg', 'One Size', 1, 'fashion')">
            <i class="bi bi-plus"></i>
        </button>
        <img src="images/image3.jpg" loading="lazy" alt="Vintage Cap">
        <p>ARCHIVE PIECE #112<br>Found in Port Elizabeth<br>One of One</p>
        <strong>R 399</strong>
        <button class="add-to-cart-btn" onclick="addToCart('accessory-001', 'VINTAGE CAP', 'R 399', 'images/image3.jpg', 'One Size', 1, 'fashion')">
            <i class="bi bi-cart-plus"></i> ADD TO CART
        </button>
    </div>
    
    <div class="product" data-category="pants">
        <button class="product-quick-add" onclick="addToCart('pants-002', 'VINTAGE JEANS', 'R 899', 'images/image4.jpg', '34', 1, 'fashion')">
            <i class="bi bi-plus"></i>
        </button>
        <img src="images/image4.jpg" loading="lazy" alt="Vintage Jeans">
        <p>ARCHIVE PIECE #078<br>Found in Bloemfontein<br>One of One</p>
        <strong>R 899</strong>
        <button class="add-to-cart-btn" onclick="addToCart('pants-002', 'VINTAGE JEANS', 'R 899', 'images/image4.jpg', '34', 1, 'fashion')">
            <i class="bi bi-cart-plus"></i> ADD TO CART
        </button>
    </div>
    
    <div class="product" data-category="accessories">
        <button class="product-quick-add" onclick="addToCart('accessory-002', 'LEATHER BELT', 'R 299', 'images/image8.jpg', 'One Size', 1, 'fashion')">
            <i class="bi bi-plus"></i>
        </button>
        <img src="images/image8.jpg" loading="lazy" alt="Leather Belt">
        <p>ARCHIVE PIECE #201<br>Found in Kimberley<br>One of One</p>
        <strong>R 299</strong>
        <button class="add-to-cart-btn" onclick="addToCart('accessory-002', 'LEATHER BELT', 'R 299', 'images/image8.jpg', 'One Size', 1, 'fashion')">
            <i class="bi bi-cart-plus"></i> ADD TO CART
        </button>
    </div>
  </div>
</section>

<section class="process">
  <h3><i class="bi bi-list-check"></i> Our Curatorial Process</h3>
  <ol>
    <li><strong><i class="bi bi-search"></i> Sourcing:</strong> Hunting for authentic pieces in markets, thrift stores, and private collections across South Africa.</li>
    <li><strong><i class="bi bi-shield-check"></i> Authentication:</strong> Verifying age, origin, and condition of each garment.</li>
    <li><strong><i class="bi bi-camera"></i> Documentation:</strong> Photographing, measuring, and recording the story of each piece.</li>
    <li><strong><i class="bi bi-brush"></i> Preservation:</strong> Professional cleaning and minimal restoration when necessary.</li>
    <li><strong><i class="bi bi-archive"></i> Archiving:</strong> Adding to the digital archive with complete transparency about condition and history.</li>
  </ol>
</section>

<section class="newsletter">
  <h3><i class="bi bi-envelope"></i> Join the Archive</h3>
  <p style="margin-bottom: 20px; font-size: 14px;">Receive new releases, broadcasts, and recovered pieces before they go public.</p>
  <input type="email" id="newsletter-email" placeholder="Enter your email" style="padding:15px; border:1px solid #000; width:250px;">
  <button class="btn" id="subscribe-btn" style="margin-top:0; margin-left: 10px; background: #000; color: #fff; border: none;">
    <i class="bi bi-send"></i> Subscribe to Archive
  </button>
</section>

<footer>
  <p><i class="bi bi-geo-alt"></i> STREETS ARCHIVES — SOUTH AFRICA</p>
  <p><i class="bi bi-collection"></i> FASHION • SOUND • VISUAL RECORDS</p>
  <p><i class="bi bi-calendar"></i> EST. 2026</p>
  <p><i class="bi bi-shield-check"></i> Privacy • Shipping • Returns • Contact</p>
</footer>

<div id="progress"></div>
<div id="cursor"></div>
<div id="toast"></div>
<div class="cart-notification" id="cartNotification">
  <i class="bi bi-check-circle"></i> <span>Item added to cart!</span>
</div>

<div class="modal" id="productModal">
  <div class="modal-content">
    <span class="close" id="closeModal">&times;</span>
    <img id="modalImg" src="" alt="Product">
    <h3 id="modalTitle">Product Title</h3>
    <p id="modalDesc">Product description here.</p>
    <strong id="modalPrice">R 799</strong>
  </div>
</div>

<button id="back-to-top"><i class="bi bi-chevron-up"></i></button>

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
            const priceElement = product.querySelector('strong');
            const priceText = priceElement ? priceElement.textContent : 'R 0';
            const price = parseInt(priceText.replace(/[^0-9]/g, ''));
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
            // Show success message
            const originalText = this.innerHTML;
            this.innerHTML = '<i class="bi bi-check"></i> Subscribed!';
            this.style.background = 'var(--accent)';
            
            setTimeout(() => {
                this.innerHTML = originalText;
                this.style.background = '#000';
                document.getElementById('newsletter-email').value = '';
            }, 2000);
        } else {
            alert('Please enter a valid email address.');
        }
    });
    
    // Search functionality
    const searchInput = document.getElementById('search');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
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
    }
    
    // Initialize product animations
    const productsElements = document.querySelectorAll('.product');
    productsElements.forEach((product, index) => {
        product.style.animationDelay = `${index * 0.1}s`;
    });
});

// Add to cart function - FIXED VERSION
function addToCart(productId, name, price, image, size, quantity, type) {
    console.log('Adding to cart:', productId, name);
    
    // Show loading notification
    const notification = document.getElementById('cartNotification');
    if (notification) {
        notification.innerHTML = '<i class="bi bi-hourglass"></i> Adding...';
        notification.style.display = 'block';
        notification.style.background = '#666';
    }
    
    // Create form data
    const formData = new FormData();
    formData.append('product_id', productId);
    formData.append('name', name);
    formData.append('price', price);
    formData.append('image', image);
    formData.append('size', size);
    formData.append('quantity', quantity);
    formData.append('type', type);
    
    // Try the most likely path FIRST
    fetch('add_to_cart.php', {
        method: 'POST',
        body: formData,
        credentials: 'same-origin'
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.text();
    })
    .then(text => {
        console.log('Raw response:', text);
        
        // Check if response is HTML (error)
        if (text.trim().startsWith('<')) {
            throw new Error('Server returned HTML instead of JSON');
        }
        
        // Parse JSON
        const data = JSON.parse(text);
        console.log('Parsed data:', data);
        
        if (data.success) {
            // Update cart count
            document.querySelectorAll('.cart').forEach(cart => {
                cart.textContent = `CART (${data.cartCount})`;
            });
            
            // Show success
            if (notification) {
                notification.innerHTML = `<i class="bi bi-check-circle"></i> ${name} added!`;
                notification.style.background = 'var(--accent)';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000);
            }
        } else {
            throw new Error(data.error || 'Server error');
        }
    })
    .catch(error => {
        console.error('Error adding to cart:', error);
        
        if (notification) {
            notification.innerHTML = `<i class="bi bi-exclamation-triangle"></i> Error: ${error.message}`;
            notification.style.background = '#dc3545';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }
    });
}

// Floating Contact Form
const contactToggle = document.getElementById('contactToggle');
const contactPanel = document.getElementById('contactPanel');
const contactClose = document.getElementById('contactClose');
const contactForm = document.getElementById('contactForm');

if (contactToggle && contactPanel) {
    // Replace emoji with Bootstrap icon
    contactToggle.innerHTML = '<i class="bi bi-chat-dots"></i>';
    
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
                
                submitBtn.innerHTML = '<i class="bi bi-arrow-repeat"></i> Sending...';
                
                setTimeout(() => {
                    submitBtn.innerHTML = '<i class="bi bi-check-circle"></i> Sent!';
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

// Back to Top functionality
window.addEventListener('scroll', () => {
    const scrollPercent = (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100;
    const progress = document.getElementById('progress');
    if (progress) {
        progress.style.width = scrollPercent + '%';
    }
    
    // Back to top button
    const backToTopBtn = document.getElementById('back-to-top');
    if (backToTopBtn) {
        if (window.scrollY > 300) {
            backToTopBtn.style.display = 'flex';
            backToTopBtn.style.alignItems = 'center';
            backToTopBtn.style.justifyContent = 'center';
        } else {
            backToTopBtn.style.display = 'none';
        }
    }
});

document.getElementById('back-to-top').addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

</script>

<!-- Include main.js - This will handle hamburger menu AND contact form -->
<script src="../js/main.js"></script>

<!-- Floating Contact Form -->
<div class="floating-contact-container">
    <button class="contact-toggle-btn" id="contactToggle" aria-label="Open contact form">
        <i class="bi bi-chat-dots"></i>
    </button>
    
    <div class="contact-panel" id="contactPanel">
        <button class="contact-close" id="contactClose">&times;</button>
        
        <div class="contact-header">
            <i class="bi bi-archive contact-icon"></i>
            <h3>CONTACT ARCHIVES</h3>
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

</body>
</html>