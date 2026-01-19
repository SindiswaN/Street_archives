<?php
$pageTitle = 'Music';
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
.music-hero {
    height: 70vh;
    background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('images/image1.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    margin-bottom: 60px;
}

.music-hero h1 {
    font-size: 72px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -2px;
    margin-bottom: 20px;
}

.music-hero p {
    font-size: 14px;
    letter-spacing: 3px;
    text-transform: uppercase;
    opacity: 0.8;
}

.music-player-large {
    background: #000;
    color: white;
    padding: 40px;
    border-radius: 8px;
    margin: 60px auto;
    width: 85%;
    max-width: 1100px;
}

.player-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.player-title {
    font-size: 24px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.player-status {
    font-size: 11px;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.player-controls-large {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-top: 30px;
}

.play-btn-large {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: white;
    color: black;
    border: none;
    font-size: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.3s;
}

.play-btn-large:hover {
    background: var(--accent);
    color: white;
}

.progress-bar-large {
    flex-grow: 1;
    height: 6px;
    background: #333;
    cursor: pointer;
    position: relative;
    border-radius: 3px;
}

.progress-fill-large {
    width: 0%;
    height: 100%;
    background: var(--accent);
    border-radius: 3px;
    transition: width 0.1s;
}

.time-display {
    font-family: monospace;
    font-size: 14px;
    color: #888;
    min-width: 100px;
    text-align: center;
}

.tracks-section {
    width: 85%;
    max-width: 1100px;
    margin: 80px auto;
}

.tracks-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 40px;
}

.track-card {
    background: var(--offwhite);
    padding: 20px;
    border: 2px solid var(--black);
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 15px;
}

.track-card:hover {
    transform: translateY(-5px);
    box-shadow: 8px 8px 0px var(--black);
    border-color: var(--accent);
}

.track-card.playing {
    background: var(--accent);
    color: white;
    border-color: var(--accent);
}

.track-number {
    font-size: 14px;
    font-weight: 700;
    color: #888;
    min-width: 30px;
}

.track-card.playing .track-number {
    color: rgba(255,255,255,0.8);
}

.track-info {
    flex-grow: 1;
}

.track-title {
    font-weight: 700;
    margin-bottom: 5px;
    text-transform: uppercase;
    font-size: 14px;
}

.track-artist {
    font-size: 12px;
    color: #888;
}

.track-card.playing .track-artist {
    color: rgba(255,255,255,0.8);
}

.track-duration {
    font-size: 12px;
    color: #888;
    font-weight: 600;
}

.live-stream {
    background: #000;
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin: 60px auto;
    width: 85%;
    max-width: 1100px;
    border: 2px solid var(--accent);
}

.stream-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.stream-title {
    font-size: 20px;
    font-weight: 800;
    text-transform: uppercase;
    color: var(--accent);
}

.stream-status {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 12px;
}

.status-indicator {
    width: 10px;
    height: 10px;
    background: #00ff00;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.stream-details {
    font-family: monospace;
    font-size: 12px;
    color: #888;
    line-height: 1.8;
}

.music-links {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 60px auto;
    flex-wrap: wrap;
}

.music-link {
    padding: 15px 30px;
    border: 2px solid var(--black);
    background: var(--black);
    color: white;
    text-decoration: none;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 1px;
    transition: 0.3s;
}

.music-link:hover {
    background: var(--accent);
    border-color: var(--accent);
}

.music-link.secondary {
    background: transparent;
    color: var(--black);
}

.releases-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.release-card {
    background: var(--offwhite);
    border: 2px solid var(--black);
    padding: 20px;
    text-align: center;
    transition: 0.3s;
}

.release-card:hover {
    transform: translateY(-5px);
    box-shadow: 8px 8px 0px var(--black);
}

.release-artwork {
    width: 100%;
    height: 200px;
    object-fit: cover;
    margin-bottom: 15px;
    border: 1px solid #ddd;
}

.release-title {
    font-weight: 700;
    margin-bottom: 5px;
    text-transform: uppercase;
    font-size: 14px;
}

.release-artist {
    font-size: 12px;
    color: #888;
    margin-bottom: 10px;
}

.release-date {
    font-size: 11px;
    color: var(--accent);
    font-weight: 600;
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
    <input type="text" id="search" placeholder="Search tracks...">
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
  <a href="about.php">About Us</a>
  <a href="fashion.php">Fashion</a>
  <a href="media.php">Media</a>
  <a href="cart.php">Cart (<?php echo $cartCount; ?>)</a>
</div>

<section class="music-hero">
  <div>
    <h1>SOUND<br>ARCHIVE</h1>
    <p>Underground Frequencies</p>
  </div>
</section>

<section class="manifesto">
  <p>The sound of the underground, broadcast and preserved. Live sessions, collaborations, and cultural frequencies transmitted from our headquarters in South Africa.</p>
  <p>Tune in to our live broadcasts or explore the archive of past transmissions.</p>
</section>

<div class="folder-section show">
  <div class="folder-tab"><span>STREETS_RADIO_3000</span></div>
  <div class="folder-body">
    <div class="folder-content">
      <div class="folder-text">
        <h3>LIVE TRANSMISSIONS</h3>
        <p>24/7 broadcast of underground sounds from South Africa and beyond. Curated mixes, live sessions, and exclusive premieres.</p>
        <div style="font-size: 11px; margin-top: 20px; color: #888; font-family: monospace;">
          <div>FREQUENCY: 3000 MHz</div>
          <div>STATUS: TRANSMITTING</div>
          <div>LISTENERS: 247 LIVE</div>
          <div>ENCRYPTION: AES-256</div>
        </div>
        <button class="btn" style="margin-top: 20px;" id="live-stream-toggle">▶ LISTEN LIVE</button>
      </div>
      <div class="folder-image">
        <video src="images/music.mov" autoplay loop muted playsinline></video>
      </div>
    </div>
  </div>
</div>

<div class="music-player-large">
  <div class="player-header">
    <div class="player-title">NOW PLAYING</div>
    <div class="player-status">STREETS RADIO 3000 • LIVE</div>
  </div>
  
  <div style="margin: 30px 0;">
    <div style="font-size: 18px; font-weight: 700; margin-bottom: 5px;" id="now-playing-title">UNDERGROUND FREQUENCIES VOL. 1</div>
    <div style="font-size: 14px; color: #888;" id="now-playing-artist">Mixed by Archive Crew • December 2025</div>
  </div>
  
  <div class="player-controls-large">
    <button class="play-btn-large" id="main-play-btn">▶</button>
    <div class="progress-bar-large" id="main-progress-container">
      <div class="progress-fill-large" id="main-progress-bar"></div>
    </div>
    <div class="time-display">
      <span id="current-time">0:00</span> / <span id="total-time">45:30</span>
    </div>
  </div>
  
  <div style="margin-top: 20px; font-size: 11px; color: #888; text-transform: uppercase; display: flex; gap: 20px;">
    <div>BITRATE: 320 KBPS</div>
    <div>FORMAT: LOSSLESS</div>
    <div>GENRE: ELECTRONIC / EXPERIMENTAL</div>
  </div>
</div>

<div class="live-stream">
  <div class="stream-info">
    <div class="stream-title">LIVE STREAM • STREETS RADIO</div>
    <div class="stream-status">
      <div class="status-indicator"></div>
      <span>LIVE NOW</span>
    </div>
  </div>
  <div class="stream-details">
    <div>HOST: DJ ARCHIVE</div>
    <div>SHOW: NIGHT SESSIONS</div>
    <div>TIME: 22:00 - 04:00 (SAST)</div>
    <div>GENRE: DOWNTEMPO • AMBIENT • EXPERIMENTAL</div>
  </div>
</div>

<section class="tracks-section">
  <h2 style="margin-bottom: 20px; text-transform: uppercase; font-weight: 800;">ARCHIVE TRACKS</h2>
  <p style="margin-bottom: 40px; max-width: 600px;">Browse our collection of recorded transmissions and exclusive releases.</p>
  
  <div class="tracks-grid" id="tracks-container">
    <!-- Tracks will be loaded by JavaScript -->
  </div>
</section>

<section class="releases-section">
  <div style="text-align: center; margin: 80px auto; width: 85%; max-width: 1100px;">
    <h2 style="margin-bottom: 20px; text-transform: uppercase; font-weight: 800;">DIGITAL RELEASES</h2>
    <p style="margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto;">Purchase digital releases from the Streets Archives collective.</p>
    
    <div class="grid">
      <?php if (isset($musicProducts)): ?>
      <?php foreach ($musicProducts as $music): ?>
      <div class="product">
        <img src="images/<?php echo $music['images'][0]; ?>" loading="lazy" alt="<?php echo $music['name']; ?>">
        <p><?php echo $music['name']; ?><br><?php echo $music['description']; ?></p>
        <strong><?php echo $music['price']; ?></strong>
        <button class="add-to-cart-btn" onclick="addToCart('<?php echo $music['id']; ?>', '<?php echo addslashes($music['name']); ?>', '<?php echo $music['price']; ?>', 'images/<?php echo $music['images'][0]; ?>', 'Digital', 1, 'music')">ADD TO CART</button>
      </div>
      <?php endforeach; ?>
      <?php else: ?>
      <p>No music products available.</p>
      <?php endif; ?>
    </div>
  </div>
</section>

<div class="music-links">
  <a href="https://soundcloud.com" target="_blank" class="music-link">FOLLOW ON SOUNDCLOUD</a>
  <a href="https://spotify.com" target="_blank" class="music-link secondary">FOLLOW ON SPOTIFY</a>
  <a href="https://bandcamp.com" target="_blank" class="music-link secondary">FOLLOW ON BANDCAMP</a>
  <a href="https://mixcloud.com" target="_blank" class="music-link secondary">FOLLOW ON MIXCLOUD</a>
</div>

<footer>
  <p>STREETS ARCHIVES — SOUTH AFRICA<br>FASHION • SOUND • VISUAL RECORDS<br>EST. 2026</p>
  <p>Privacy • Shipping • Returns • Contact</p>
</footer>

<div id="progress"></div>
<div id="cursor"></div>
<div id="toast"></div>
<div class="cart-notification" id="cartNotification">Item added to cart!</div>

<button id="back-to-top">↑</button>

<script>
// Music page specific JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const tracks = [
        { title: 'UNDERGROUND FREQUENCIES', artist: 'Archive Crew', duration: '6:45' },
        { title: 'NIGHT DRIVE', artist: 'Night Shift', duration: '5:20' },
        { title: 'COASTAL VIBES', artist: 'Coastal Frequencies', duration: '7:15' },
        { title: 'URBAN ECHOES', artist: 'Street Sound Collective', duration: '4:55' },
        { title: 'BASEMENT GROOVE', artist: 'DJ Archive', duration: '8:30' },
        { title: 'MIDNIGHT TRANSMISSION', artist: 'Archive Crew', duration: '6:10' },
        { title: 'CITY LIGHTS', artist: 'Urban Explorers', duration: '5:45' },
        { title: 'STREET FREQUENCIES', artist: 'Various Artists', duration: '7:25' }
    ];
    
    // Load tracks
    const tracksContainer = document.getElementById('tracks-container');
    tracks.forEach((track, index) => {
        const trackCard = document.createElement('div');
        trackCard.className = 'track-card';
        trackCard.innerHTML = `
            <div class="track-number">${String(index + 1).padStart(2, '0')}</div>
            <div class="track-info">
                <div class="track-title">${track.title}</div>
                <div class="track-artist">${track.artist}</div>
            </div>
            <div class="track-duration">${track.duration}</div>
        `;
        
        trackCard.addEventListener('click', () => {
            document.querySelectorAll('.track-card').forEach(t => t.classList.remove('playing'));
            trackCard.classList.add('playing');
            
            // Update player
            document.getElementById('now-playing-title').textContent = track.title;
            document.getElementById('now-playing-artist').textContent = track.artist;
            
            // Start playing
            playTrack();
        });
        
        tracksContainer.appendChild(trackCard);
    });
    
    // Music player functionality
    const playBtn = document.getElementById('main-play-btn');
    const progressBar = document.getElementById('main-progress-bar');
    const currentTimeDisplay = document.getElementById('current-time');
    const totalTimeDisplay = document.getElementById('total-time');
    
    let isPlaying = false;
    let currentTime = 0;
    let totalTime = 45 * 60; // 45 minutes in seconds
    
    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs.toString().padStart(2, '0')}`;
    }
    
    totalTimeDisplay.textContent = formatTime(totalTime);
    
    function playTrack() {
        isPlaying = true;
        playBtn.textContent = '⏸';
        playBtn.style.background = 'var(--accent)';
        playBtn.style.color = 'white';
        
        // Simulate playback
        const interval = setInterval(() => {
            if (isPlaying && currentTime < totalTime) {
                currentTime++;
                progressBar.style.width = (currentTime / totalTime * 100) + '%';
                currentTimeDisplay.textContent = formatTime(currentTime);
            } else {
                clearInterval(interval);
                isPlaying = false;
                playBtn.textContent = '▶';
                playBtn.style.background = '';
                playBtn.style.color = '';
            }
        }, 1000);
        
        // Update button click handler
        playBtn.onclick = () => {
            if (isPlaying) {
                isPlaying = false;
                playBtn.textContent = '▶';
                playBtn.style.background = '';
                playBtn.style.color = '';
            } else {
                playTrack();
            }
        };
    }
    
    playBtn.addEventListener('click', playTrack);
    
    // Progress bar click to seek
    document.getElementById('main-progress-container').addEventListener('click', (e) => {
        const rect = e.target.getBoundingClientRect();
        const percent = (e.clientX - rect.left) / rect.width;
        currentTime = Math.floor(percent * totalTime);
        progressBar.style.width = (currentTime / totalTime * 100) + '%';
        currentTimeDisplay.textContent = formatTime(currentTime);
    });
    
    // Live stream toggle
    document.getElementById('live-stream-toggle').addEventListener('click', function() {
        const originalText = this.textContent;
        if (originalText === '▶ LISTEN LIVE') {
            this.textContent = '⏸ STOP STREAM';
            this.style.background = 'var(--accent)';
            this.style.color = 'white';
            alert('Connecting to live stream... (Simulated)');
        } else {
            this.textContent = '▶ LISTEN LIVE';
            this.style.background = '';
            this.style.color = '';
            alert('Stream stopped');
        }
    });
});

// Add to cart function (same as shop.php)
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