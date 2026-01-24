<?php
$pageTitle = 'Home';
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

/* FIX: Ensure text is visible in dark mode */
body.dark .folder-section .folder-body,
body.dark .folder-section .folder-tab,
body.dark .manifesto,
body.dark .process,
body.dark .categories .category,
body.dark .products .product,
body.dark .newsletter {
    background: var(--offwhite);
    color: var(--text);
}

body.dark .btn {
    color: var(--text);
    border-color: var(--text);
}

body.dark .btn:hover {
    background: var(--text);
    color: var(--bg);
}

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

.s-media { background-image: url('images/mediaa (2).jpg'); }
.s-fashion { background-image: url('images/fashion.jpg'); }
.s-music { background-image: url('images/music.jpg'); }

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
  border: 1px solid #000000;
  background: transparent;
  color: #000000;
  text-decoration: none;
  font-weight: 700;
  text-transform: uppercase;
  font-size: 11px;
  letter-spacing: 2px;
  transition: 0.3s;
}
.btn-hero:hover { 
  background: #000000; 
  color: #ffffff; 
}

/* Dark mode override */
body.dark .btn-hero {
  border-color: #ffffff;
  color: #ffffff;
}

body.dark .btn-hero:hover {
  background: #ffffff;
  color: #000000;
}

.hero .btn-hero {
  color: #ffffff;
  border-color: #ffffff;
}

.hero .btn-hero:hover {
  background: #ffffff;
  color: #000000;
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
/* Enhanced Audio Player */
.enhanced-audio-player {
  background: #000;
  color: #fff;
  padding: 20px;
  border-radius: 8px;
  margin-top: 20px;
  border: 1px solid #333;
}

.player-header {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 15px;
  font-size: 12px;
}

.player-header i {
  color: var(--accent);
  font-size: 16px;
}

.station-name {
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.frequency {
  color: #888;
  margin-left: auto;
}

.status-indicator {
  display: flex;
  align-items: center;
  gap: 5px;
  color: #4CAF50;
}

.status-indicator .dot {
  width: 8px;
  height: 8px;
  background: #4CAF50;
  border-radius: 50%;
  animation: pulse 2s infinite;
}

.now-playing {
  background: rgba(255, 255, 255, 0.05);
  padding: 15px;
  border-radius: 6px;
  margin-bottom: 20px;
}

.track-info {
  margin-bottom: 10px;
}

.track-title {
  font-size: 14px;
  font-weight: 600;
  margin-bottom: 5px;
}

.track-artist {
  font-size: 12px;
  color: #888;
}

.signal-strength {
  display: flex;
  gap: 3px;
  align-items: flex-end;
  height: 20px;
}

.signal-bar {
  width: 4px;
  background: #444;
  border-radius: 2px;
}

.signal-bar.active {
  background: var(--accent);
}

.signal-bar:nth-child(1) { height: 6px; }
.signal-bar:nth-child(2) { height: 9px; }
.signal-bar:nth-child(3) { height: 12px; }
.signal-bar:nth-child(4) { height: 15px; }
.signal-bar:nth-child(5) { height: 18px; }

.player-controls {
  display: flex;
  align-items: center;
  gap: 15px;
  margin-bottom: 15px;
}

.control-btn {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.1);
  border: 1px solid rgba(255, 255, 255, 0.2);
  color: #fff;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.3s;
}

.control-btn:hover {
  background: var(--accent);
  transform: scale(1.05);
}

.play-btn {
  width: 50px;
  height: 50px;
  background: var(--accent);
}

.play-btn:hover {
  background: #ff5c33;
}

.volume-control {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-left: auto;
}

.volume-control input[type="range"] {
  width: 80px;
  height: 4px;
  background: #444;
  border-radius: 2px;
  outline: none;
}

.volume-control input[type="range"]::-webkit-slider-thumb {
  width: 12px;
  height: 12px;
  background: var(--accent);
  border-radius: 50%;
  cursor: pointer;
}

.progress-container {
  margin-top: 10px;
}

.progress-bar {
  width: 100%;
  height: 4px;
  background: #333;
  border-radius: 2px;
  cursor: pointer;
  position: relative;
}

.progress-fill {
  height: 100%;
  background: var(--accent);
  border-radius: 2px;
  width: 0%;
}

.time-display {
  display: flex;
  justify-content: space-between;
  font-size: 11px;
  color: #888;
  margin-top: 5px;
}

/* Playlist */
.playlist {
  margin-top: 20px;
  background: rgba(0, 0, 0, 0.3);
  border-radius: 8px;
  overflow: hidden;
}

.playlist-header {
  background: rgba(0, 0, 0, 0.5);
  padding: 12px 15px;
  display: flex;
  align-items: center;
  gap: 10px;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 1px;
}

.track-count {
  margin-left: auto;
  color: #888;
}

.playlist-tracks {
  max-height: 200px;
  overflow-y: auto;
}

.track-item {
  display: flex;
  align-items: center;
  padding: 10px 15px;
  border-bottom: 1px solid rgba(255, 255, 255, 0.05);
  cursor: pointer;
  transition: all 0.3s;
}

.track-item:hover {
  background: rgba(255, 255, 255, 0.05);
}

.track-item.playing {
  background: rgba(255, 60, 0, 0.1);
  border-left: 3px solid var(--accent);
}

.track-number {
  width: 25px;
  color: #888;
  font-size: 12px;
}

.track-info-small {
  flex: 1;
}

.track-title-small {
  font-size: 13px;
  margin-bottom: 2px;
}

.track-artist-small {
  font-size: 11px;
  color: #888;
}

.track-duration {
  font-size: 11px;
  color: #888;
}

/* Dark mode adjustments */
body.dark .enhanced-audio-player {
  background: #222;
}

body.dark .playlist {
  background: rgba(0, 0, 0, 0.2);
}

/* ---------- CATEGORIES SECTION ---------- */
.categories {
    width: 85%;
    max-width: 1100px;
    margin: 80px auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.category {
    background: var(--offwhite);
    border: 2px solid var(--black);
    border-radius: 8px;
    padding: 30px 20px;
    text-align: center;
    font-weight: 800;
    text-transform: uppercase;
    font-size: 1.2rem;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.category::before {
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

.category:hover::before {
    transform: translateX(0);
}

.category:hover {
    transform: translateY(-5px);
    box-shadow: 8px 8px 0px var(--black);
    border-color: var(--accent);
}

/* ---------- PRODUCTS SECTION ---------- */
.products {
    width: 85%;
    max-width: 1100px;
    margin: 80px auto;
}

.products h2 {
    font-size: 2rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -1px;
    margin-bottom: 40px;
    text-align: center;
}

.grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 30px;
}

.product {
    background: var(--offwhite);
    border: 2px solid var(--black);
    border-radius: 12px;
    padding: 20px;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    opacity: 0;
    transform: translateY(20px);
    animation: fadeInUp 0.5s ease forwards;
}

@keyframes fadeInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.product::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--accent);
    transform: translateY(-100%);
    transition: transform 0.3s;
}

.product:hover::before {
    transform: translateY(0);
}

.product:hover {
    transform: translateY(-10px);
    box-shadow: 12px 12px 0px var(--black);
}

.product img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
    margin-bottom: 15px;
    border: 1px solid rgba(0,0,0,0.1);
    transition: transform 0.3s;
}

.product:hover img {
    transform: scale(1.05);
}

.product p {
    font-size: 0.9rem;
    line-height: 1.6;
    margin-bottom: 10px;
    color: var(--text);
}

.product strong {
    font-size: 1.2rem;
    color: var(--accent);
    display: block;
    margin-top: 10px;
    font-weight: 800;
}

/* ---------- DARK MODE ADJUSTMENTS ---------- */
body.dark .category {
    background: #222;
    color: #fff;
    border-color: #444;
}

body.dark .product {
    background: #222;
    border-color: #444;
}

body.dark .product p {
    color: #fff;
}

body.dark .product img {
    border-color: #444;
}

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
    z-index: 9998;
}

/* Cursor Follower */
#cursor {
    position: fixed;
    width: 20px;
    height: 20px;
    background: var(--accent);
    border-radius: 50%;
    pointer-events: none;
    z-index: 9997;
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
    z-index: 9999;
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

/* Back to Top Button - FIXED POSITION */
#back-to-top {
  position: fixed;
  bottom: 100px; /* Moved above contact button */
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
  z-index: 9995; /* Below contact form */
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: center;
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

/* ---------- ENHANCED FLOATING CONTACT FORM ---------- */
.floating-contact-container {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 10000; /* Highest z-index */
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

.form-group input:valid,
.form-group textarea:valid {
    border-color: #10b981;
}

.form-group input:invalid:focus,
.form-group textarea:invalid:focus {
    border-color: #ef4444;
}

.form-group input:focus + i,
.form-group textarea:focus + i {
    color: var(--accent);
    animation: bounce 0.5s ease;
}

@keyframes bounce {
    0%, 100% { transform: translateY(-50%); }
    50% { transform: translateY(-60%); }
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

.submit-btn:active {
    transform: translateY(0);
    box-shadow: none;
}

.submit-btn.sending {
    background: var(--grey);
    pointer-events: none;
}

.submit-btn.sending i {
    animation: spin 1s linear infinite;
}

/* Transmission Status */
.transmission-status {
    margin: 25px 0;
    padding: 15px;
    background: rgba(255, 60, 0, 0.05);
    border-radius: 8px;
    border: 1px solid rgba(255, 60, 0, 0.1);
}

.status-indicator {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
    margin-bottom: 5px;
}

.status-dot {
    width: 8px;
    height: 8px;
    background: var(--accent);
    border-radius: 50%;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.3; }
}

.response-time {
    font-size: 10px;
    opacity: 0.7;
    text-align: center;
    margin: 0;
}

/* Social Links */
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
    background: rgba(17, 17, 17, 0.95);
    border: 2px solid rgba(255, 255, 255, 0.1);
    box-shadow: 12px 12px 0px rgba(255, 255, 255, 0.1);
}

body.dark .form-group input,
body.dark .form-group textarea {
    background: rgba(0, 0, 0, 0.2);
    border-color: rgba(255, 255, 255, 0.1);
    color: white;
}

body.dark .social-link {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(255, 255, 255, 0.1);
    color: white;
}

body.dark .transmission-status {
    background: rgba(255, 60, 0, 0.1);
    border-color: rgba(255, 60, 0, 0.2);
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
    
    .contact-panel {
        width: calc(100vw - 40px);
        right: -15px;
        padding: 25px;
    }
    
    #back-to-top {
        bottom: 80px;
        right: 15px;
        width: 40px;
        height: 40px;
        font-size: 18px;
    }
}

/* FIX: Music Player Container in Dark Mode */
body.dark .audio-player {
    background: #222;
    color: #fff;
}

body.dark .player-controls .progress-bar {
    background: #444;
}

body.dark .play-btn {
    background: #fff;
    color: #000;
}
</style>
</head>

<body>

<div id="preloader">
  <div class="loader"></div>
  <p>Loading Archive...</p>
</div>

<div class="top-bar">
  <p>CULTURE OVER COMMODITY ~ LIVE FREE, DIE WITH MONEY ~ FASHION • MEDIA • SOUND ARCHIVE ~ CULTURE OVER COMMODITY ~ LIVE FREE, DIE WITH MONEY ~ FASHION • MEDIA • SOUND ARCHIVE</p>
</div>

<!-- Include Header -->
<?php require_once(__DIR__ . '/../includes/header.php'); ?>

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
    <h1 id="typewriter"></h1>
    <p class="tagline">Fashion / Media / Sound Archive</p>
    <a href="#fashion" class="btn-hero">Initialize Explorer</a>
  </div>
</section>

<section class="manifesto">
  <p>Discover unique streetwear and vintage fashion pieces curated from the heart of urban culture. Each item tells a story of style, individuality, and raw expression. Shop our collection of one-of-a-kind garments that blend fashion, media, and music influences.</p><br>
  <a href="about.php" class="btn-hero">About Us</a>
</section>

<div class="folder-section" id="fashion">
  <div class="folder-tab"><span>DIR_FASHION</span></div>
  <div class="folder-body">
    <div class="folder-content">
      <div class="folder-image"><img src="images/image5.jpg" alt="Fashion"></div>
      <div class="folder-text">
        <h3>Fashion Archive</h3>
        <p>Curated vintage and second-hand garments pulled from real streets and private collections. Each piece carries time, movement, and memory. Once released, it never returns.</p>
        <a href="fashion.php" class="btn-hero">Enter Archive</a>
      </div>
    </div>
  </div>
</div>

<div class="folder-section" id="media">
  <div class="folder-tab"><span>DIR_MEDIA</span></div>
  <div class="folder-body">
    <div class="folder-content">
      <div class="folder-image"><video src="images/media.mp4" autoplay loop muted playsinline></video></div>
      <div class="folder-text">
        <h3>Visual Media</h3>
        <p>Cinematic documentation of street culture in motion. Editorials, short films, and visual records captured without performance or polish. Raw, intentional, honest.</p>
        <a href="#" class="btn">Open Visual Log</a>
      </div>
    </div>
  </div>
</div>

<div class="folder-section" id="music">
  <div class="folder-tab"><span>DIR_MUSIC</span></div>
  <div class="folder-body">
    <div class="folder-content">
      <div class="folder-image"><video src="images/music.mov" autoplay loop muted playsinline></video></div>
      <div class="folder-text">
        <h3>Audio Archive</h3>
        <p>The sound of the underground, broadcast and preserved. Collaborations, live sessions, and cultural frequencies transmitted through Streets Radio 3000.</p>
       
        <!-- Enhanced Music Player -->
        <div class="enhanced-audio-player">
          <div class="player-header">
            <i class="bi bi-vinyl"></i>
            <span class="station-name">STREETS RADIO 3000</span>
            <span class="frequency">FREQ: 3000Hz</span>
            <span class="status-indicator" id="status-indicator">
              <span class="dot"></span>
              LIVE
            </span>
          </div>
          
          <div class="now-playing" id="now-playing">
            <div class="track-info">
              <div class="track-title" id="current-track-title">Loading transmission...</div>
              <div class="track-artist" id="current-track-artist">Streets Archives</div>
            </div>
            <div class="signal-strength">
              <div class="signal-bar active"></div>
              <div class="signal-bar active"></div>
              <div class="signal-bar active"></div>
              <div class="signal-bar"></div>
              <div class="signal-bar"></div>
            </div>
          </div>
          
          <div class="player-controls">
            <button class="control-btn" id="prev-btn" title="Previous">
              <i class="bi bi-skip-backward"></i>
            </button>
            <button class="control-btn play-btn" id="play-pause-btn" title="Play/Pause">
              <i class="bi bi-play-fill" id="play-icon"></i>
            </button>
            <button class="control-btn" id="next-btn" title="Next">
              <i class="bi bi-skip-forward"></i>
            </button>
            
            <div class="volume-control">
              <i class="bi bi-volume-down"></i>
              <input type="range" id="volume-slider" min="0" max="100" value="70" title="Volume">
              <i class="bi bi-volume-up"></i>
            </div>
          </div>
          
          <div class="progress-container">
            <div class="progress-bar" id="audio-progress-bar">
              <div class="progress-fill" id="audio-progress-fill"></div>
            </div>
            <div class="time-display">
              <span id="audio-current-time">0:00</span>
              <span id="audio-total-time">0:00</span>
            </div>
          </div>
          
          <!-- Audio element -->
          <audio id="main-audio-player" preload="metadata"></audio>
        </div>
        
        <!-- Playlist -->
        <div class="playlist">
          <div class="playlist-header">
            <i class="bi bi-music-note-list"></i>
            <span>TRANSMISSION ARCHIVE</span>
            <span class="track-count" id="track-count">0 tracks</span>
          </div>
          <div class="playlist-tracks" id="playlist-tracks">
            <!-- Tracks will be loaded here -->
          </div>
        </div>

        <a href="#" class="btn">View Full Archive</a>
      </div>
    </div>
  </div>
</div>

<section class="categories">
  <div class="category">MENS ARCHIVE</div>
  <div class="category">WOMENS ARCHIVE</div>
  <div class="category">RECENTLY RECOVERED</div>
</section>

<section class="products">
  <h2 style="margin-bottom: 30px; text-transform: uppercase; font-weight: 800;">Featured</h2>
  <div class="grid">
    <div class="product"><img src="images/image5.jpg" loading="lazy"><p>ARCHIVE PIECE #014<br>Found in Johannesburg<br>One of One</p><strong>R 799</strong></div>
    <div class="product"><img src="images/image2.jpg" loading="lazy"><p>ARCHIVE PIECE #027<br>Found in Cape Town<br>One of One</p><strong>R 899</strong></div>
    <div class="product"><img src="images/image7.jpg" loading="lazy"><p>ARCHIVE PIECE #089<br>Found in Pretoria<br>One of One</p><strong>R 999</strong></div>
    <div class="product"><img src="images/image1.jpg" loading="lazy"><p>ARCHIVE PIECE #156<br>Found in Durban<br>One of One</p><strong>R 1099</strong></div>
  </div>
</section>

<section class="carousel">
  <div class="carousel-overlay">
    <p>NEW ARRIVALS<br>SHOP NOW</p>
  </div>
  <div class="carousel-track">
    <img src="images/image6.jpg" loading="eager" width="260" height="320" alt="Fashion">
    <img src="images/image7.jpg" loading="eager" width="260" height="320" alt="Media">
    <img src="images/image5.jpg" loading="eager" width="260" height="320" alt="Music">
    <img src="images/image1.jpg" loading="eager" width="260" height="320" alt="Fashion">
    <img src="images/image3.jpg" loading="eager" width="260" height="320" alt="Media">
    <img src="images/image4.jpg" loading="eager" width="260" height="320" alt="Music">
  </div>
</section>

<section class="process">
  <h3>Our Curatorial Process</h3>
  <ol>
    <li>Sourcing authentic streetwear and vintage pieces from urban collections.</li>
    <li>Carefully selecting items that embody unique style and cultural significance.</li>
    <li>Documenting each piece's story through photos and media.</li>
    <li>Making them available in our online archive for fashion enthusiasts.</li>
  </ol>
</section>

<section class="newsletter">
  <h3>Join the Archive</h3>
  <p style="margin-bottom: 20px; font-size: 14px;">Receive new releases, broadcasts, and recovered pieces before they go public.</p>
  <input type="email" placeholder="Enter your email" style="padding:15px; border:1px solid #000; width:250px;">
  <button class="btn" style="margin-top:0; margin-left: 10px; background: #000; color: #fff; border: none;">Subscribe to Archive</button>
</section>

<footer>
  <p>STREETS ARCHIVES — SOUTH AFRICA<br>FASHION • SOUND • VISUAL RECORDS<br>EST. 2026</p>
  <p>Privacy • Shipping • Returns • Contact</p>
</footer>

<div id="progress"></div>
<div id="cursor"></div>
<div id="toast">Theme Changed!</div>

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
        
        <div class="transmission-status">
            <div class="status-indicator">
                <span class="status-dot"></span>
                <span>LIVE TRANSMISSION</span>
            </div>
            <p class="response-time">Response within 24-48 hours</p>
        </div>
        
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
// Preloader with error handling
function hidePreloader() {
    const preloader = document.getElementById('preloader');
    if (preloader) {
        preloader.style.display = 'none';
    }
}

// Set a timeout to hide preloader even if there are errors
setTimeout(hidePreloader, 3000); // 3 second fallback

// Main initialization when page loads
window.addEventListener('load', function() {
    hidePreloader();
    preloadCarouselImages();
    
    // Stagger Products
    document.querySelectorAll('.product').forEach((el, i) => {
        el.style.animationDelay = (i * 0.1) + 's';
    });
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

// Toggle Mobile Menu
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');

function toggleMenu() {
  if (mobileMenu) {
    mobileMenu.classList.toggle('active');
  }
}

if (hamburger) {
  hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('active');
      toggleMenu();
  });
}

// Close mobile menu when clicking outside
document.addEventListener('click', (e) => {
  if (mobileMenu && hamburger && mobileMenu.classList.contains('active')) {
    if (!mobileMenu.contains(e.target) && !hamburger.contains(e.target)) {
      hamburger.classList.remove('active');
      mobileMenu.classList.remove('active');
    }
  }
});

// Reveal Folders on Scroll
const folderObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) { entry.target.classList.add("show"); }
  });
}, { threshold: 0.15 });

document.querySelectorAll(".folder-section").forEach(f => folderObserver.observe(f));

// Typewriter Effect
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

// Smooth Scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        if (targetId && targetId !== '#') {
            const target = document.querySelector(targetId);
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
        }
    });
});

// Back to Top Button
const backToTopBtn = document.getElementById('back-to-top');
if (backToTopBtn) {
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTopBtn.style.display = 'flex';
        } else {
            backToTopBtn.style.display = 'none';
        }
    });
    
    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// Theme Toggle
const themeToggle = document.getElementById('theme-toggle');
if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        
        // Update icon
        if (document.body.classList.contains('dark')) {
            themeToggle.innerHTML = '<i class="bi bi-sun"></i>';
        } else {
            themeToggle.innerHTML = '<i class="bi bi-moon"></i>';
        }
        
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
        themeToggle.innerHTML = '<i class="bi bi-sun"></i>';
    }
}

// Product Modal
document.querySelectorAll('.product').forEach(product => {
    product.addEventListener('click', () => {
        const img = product.querySelector('img').src;
        const title = product.querySelector('p').textContent;
        const price = product.querySelector('strong').textContent;
        
        const modalImg = document.getElementById('modalImg');
        const modalTitle = document.getElementById('modalTitle');
        const modalPrice = document.getElementById('modalPrice');
        const modalDesc = document.getElementById('modalDesc');
        const productModal = document.getElementById('productModal');
        
        if (modalImg && modalTitle && modalPrice && modalDesc && productModal) {
            modalImg.src = img;
            modalTitle.textContent = title;
            modalPrice.textContent = price;
            modalDesc.textContent = 'Detailed description of ' + title + '. High-quality fashion item from our archive.';
            productModal.classList.add('show');
        }
    });
});

const closeModal = document.getElementById('closeModal');
if (closeModal) {
    closeModal.addEventListener('click', () => {
        const productModal = document.getElementById('productModal');
        if (productModal) {
            productModal.classList.remove('show');
        }
    });
}

// Search Functionality
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

// Parallax Effect
window.addEventListener('scroll', () => {
    const scrolled = window.scrollY;
    const heroCollage = document.querySelector('.hero-collage');
    if (heroCollage) {
        heroCollage.style.transform = `translateY(${scrolled * 0.3}px)`;
    }
    // Scroll Progress
    const scrollPercent = (scrolled / (document.body.scrollHeight - window.innerHeight)) * 100;
    const progress = document.getElementById('progress');
    if (progress) {
        progress.style.width = scrollPercent + '%';
    }
});

// Newsletter form submission
const newsletterForm = document.querySelector('.newsletter');
if (newsletterForm) {
    const newsletterInput = newsletterForm.querySelector('input');
    const newsletterBtn = newsletterForm.querySelector('.btn');
    
    if (newsletterBtn) {
        newsletterBtn.addEventListener('click', (e) => {
            e.preventDefault();
            if (newsletterInput && newsletterInput.value && newsletterInput.value.includes('@')) {
                alert('Thank you for subscribing to our newsletter!');
                newsletterInput.value = '';
            } else {
                alert('Please enter a valid email address.');
            }
        });
    }
    
    if (newsletterInput) {
        newsletterInput.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                if (newsletterBtn) newsletterBtn.click();
            }
        });
    }
}

// Initialize carousel animation
const carouselTrack = document.querySelector('.carousel-track');
if (carouselTrack) {
    carouselTrack.style.animation = 'slideImages 20s linear infinite';
}

// ===== ENHANCED MUSIC PLAYER =====
function initializeMusicPlayer() {
    const audioPlayer = document.getElementById('main-audio-player');
    const playPauseBtn = document.getElementById('play-pause-btn');
    const playIcon = document.getElementById('play-icon');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const volumeSlider = document.getElementById('volume-slider');
    const audioProgressBar = document.getElementById('audio-progress-bar');
    const audioProgressFill = document.getElementById('audio-progress-fill');
    const audioCurrentTime = document.getElementById('audio-current-time');
    const audioTotalTime = document.getElementById('audio-total-time');
    const currentTrackTitle = document.getElementById('current-track-title');
    const currentTrackArtist = document.getElementById('current-track-artist');
    const playlistTracks = document.getElementById('playlist-tracks');
    const trackCount = document.getElementById('track-count');

    // Check if all music player elements exist
    if (!audioPlayer || !playPauseBtn || !playIcon) {
        console.log("Music player elements not found, skipping player setup");
        return;
    }

    // Playlist - Updated with your actual songs
    const playlist = [
        {
            title: "Aye",
            artist: "Davido",
            file: "music/Aye.mp3",
            duration: "3:45"
        },
        {
            title: "Abantwana-Bakho",
            artist: "Kbza De Small",
            file: "music/Abantwana-Bakho.mp3",
            duration: "4:20"
        },
        {
            title: "Bengicela",
            artist: "Mawhoo",
            file: "music/Bengicela.mp3",
            duration: "3:15"
        },
        {
            title: "Blessings",
            artist: "Joeboy",
            file: "music/Blessings.mp3",
            duration: "5:10"
        }
    ];

    let currentTrackIndex = 0;

    // Format time function
    function formatTime(seconds) {
        if (isNaN(seconds)) return "0:00";
        const minutes = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
    }

    // Load track
    function loadTrack(index) {
        if (index < 0 || index >= playlist.length) return;
        
        currentTrackIndex = index;
        const track = playlist[index];
        
        audioPlayer.src = track.file;
        if (currentTrackTitle) currentTrackTitle.textContent = track.title;
        if (currentTrackArtist) currentTrackArtist.textContent = track.artist;
        
        // Update playlist UI
        updatePlaylistUI();
        
        // Load metadata
        audioPlayer.addEventListener('loadedmetadata', () => {
            if (audioTotalTime) {
                audioTotalTime.textContent = formatTime(audioPlayer.duration);
            }
        }, { once: true });
        
        // Auto play
        audioPlayer.play().catch(e => {
            console.log("Autoplay prevented:", e);
            if (playIcon) playIcon.className = 'bi bi-play-fill';
        });
        
        if (playIcon) playIcon.className = 'bi bi-pause-fill';
    }

    // Update playlist UI
    function updatePlaylistUI() {
        if (!playlistTracks) return;
        
        playlistTracks.innerHTML = '';
        
        playlist.forEach((track, index) => {
            const trackElement = document.createElement('div');
            trackElement.className = `track-item ${index === currentTrackIndex ? 'playing' : ''}`;
            trackElement.innerHTML = `
                <div class="track-number">${index + 1}</div>
                <div class="track-info-small">
                    <div class="track-title-small">${track.title}</div>
                    <div class="track-artist-small">${track.artist}</div>
                </div>
                <div class="track-duration">${track.duration}</div>
            `;
            
            trackElement.addEventListener('click', () => {
                loadTrack(index);
            });
            
            playlistTracks.appendChild(trackElement);
        });
        
        if (trackCount) {
            trackCount.textContent = `${playlist.length} tracks`;
        }
    }

    // Play/Pause
    playPauseBtn.addEventListener('click', () => {
        if (audioPlayer.paused) {
            if (!audioPlayer.src) {
                loadTrack(0);
            } else {
                audioPlayer.play();
            }
            playIcon.className = 'bi bi-pause-fill';
        } else {
            audioPlayer.pause();
            playIcon.className = 'bi bi-play-fill';
        }
    });

    // Previous track
    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            let newIndex = currentTrackIndex - 1;
            if (newIndex < 0) newIndex = playlist.length - 1;
            loadTrack(newIndex);
        });
    }

    // Next track
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            let newIndex = currentTrackIndex + 1;
            if (newIndex >= playlist.length) newIndex = 0;
            loadTrack(newIndex);
        });
    }

    // Volume control
    if (volumeSlider) {
        volumeSlider.addEventListener('input', () => {
            audioPlayer.volume = volumeSlider.value / 100;
        });
    }

    // Progress bar
    audioPlayer.addEventListener('timeupdate', () => {
        if (audioPlayer.duration && !isNaN(audioPlayer.duration)) {
            const percent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
            if (audioProgressFill) {
                audioProgressFill.style.width = `${percent}%`;
            }
            if (audioCurrentTime) {
                audioCurrentTime.textContent = formatTime(audioPlayer.currentTime);
            }
        }
    });

    // Click on progress bar to seek
    if (audioProgressBar) {
        audioProgressBar.addEventListener('click', (e) => {
            if (audioPlayer.duration && !isNaN(audioPlayer.duration)) {
                const rect = audioProgressBar.getBoundingClientRect();
                const pos = (e.clientX - rect.left) / rect.width;
                audioPlayer.currentTime = pos * audioPlayer.duration;
            }
        });
    }

    // Auto play next track
    audioPlayer.addEventListener('ended', () => {
        let newIndex = currentTrackIndex + 1;
        if (newIndex >= playlist.length) newIndex = 0;
        loadTrack(newIndex);
    });

    // Initialize playlist
    updatePlaylistUI();

    // Load first track on page load
    setTimeout(() => {
        loadTrack(0);
    }, 1000);
}

// Initialize music player after page loads
window.addEventListener('load', function() {
    setTimeout(initializeMusicPlayer, 500);
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
    
    // Prevent clicks inside panel from closing it
    contactPanel.addEventListener('click', (e) => {
        e.stopPropagation();
    });
    
    // Form submission
    if (contactForm) {
        contactForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const formData = new FormData(contactForm);
            const data = Object.fromEntries(formData);

            if (data.email && data.message) {
                const submitBtn = contactForm.querySelector('button[type="submit"]');
                const originalHTML = submitBtn.innerHTML;

                // Show sending state
                submitBtn.classList.add('sending');
                submitBtn.innerHTML = '<i class="bi bi-arrow-repeat"></i><span>TRANSMITTING...</span>';

                // Simulate API call
                setTimeout(() => {
                    // Show success state
                    submitBtn.classList.remove('sending');
                    submitBtn.innerHTML = '<i class="bi bi-check-circle"></i><span>TRANSMISSION SENT</span>';
                    submitBtn.style.background = '#10b981';
                    
                    contactForm.reset();

                    // Close panel after success
                    setTimeout(() => {
                        contactToggle.classList.remove('active');
                        contactPanel.classList.remove('active');
                        
                        // Reset button after delay
                        setTimeout(() => {
                            submitBtn.innerHTML = originalHTML;
                            submitBtn.style.background = 'var(--accent)';
                        }, 1000);
                    }, 1500);
                }, 1500);
            }
        });
    }

    // Prevent panel from closing when form is clicked
    if (contactForm) {
        contactForm.addEventListener('click', (e) => {
            e.stopPropagation();
        });
    }
}
</script>
</body>
</html>