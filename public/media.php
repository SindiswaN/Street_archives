<?php
$pageTitle = 'Media';
require_once(__DIR__ . '/../app/config.php');
require_once(__DIR__ . '/../app/database.php');
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

/* Hamburger Animation */
.hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
.hamburger.active span:nth-child(2) { opacity: 0; }
.hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(7px, -6px); }

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
  animation: fadeInUp 2s ease-out;
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

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(50px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ---------- CAROUSEL ---------- */
.carousel {
  margin: 100px 0;
  overflow: hidden;
  white-space: nowrap;
  border-top: 1px solid #eee;
  border-bottom: 1px solid #eee;
  padding: 20px 0;
  transform: translateZ(0);
  -webkit-transform: translateZ(0);
  position: relative;
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

.carousel-track:hover { animation-play-state: paused; }

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

/* ---------- MEDIA PAGE SPECIFIC ---------- */
.media-hero {
    height: 70vh;
    background: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), url('images/image5.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    margin-bottom: 60px;
}

.media-hero h1 {
    font-size: 72px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -2px;
    margin-bottom: 20px;
}

.media-hero p {
    font-size: 14px;
    letter-spacing: 3px;
    text-transform: uppercase;
    opacity: 0.8;
}

.video-grid {
    width: 90%;
    max-width: 1400px;
    margin: 60px auto;
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 30px;
}

.video-card {
    position: relative;
    overflow: hidden;
    cursor: pointer;
    transition: transform 0.3s ease;
}

.video-card:hover {
    transform: translateY(-10px);
}

.video-thumbnail {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border: 2px solid var(--black);
    transition: 0.3s;
}

.video-card:hover .video-thumbnail {
    transform: scale(1.05);
}

.video-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0,0,0,0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: 0.3s;
}

.video-card:hover .video-overlay {
    opacity: 1;
}

.play-icon {
    font-size: 40px;
    color: white;
}

.video-info {
    padding: 15px;
    background: var(--offwhite);
    border: 2px solid var(--black);
    border-top: none;
}

.video-title {
    font-weight: 700;
    margin-bottom: 5px;
    text-transform: uppercase;
    font-size: 14px;
}

.video-date {
    font-size: 11px;
    color: #888;
    text-transform: uppercase;
}

.video-duration {
    font-size: 11px;
    color: var(--accent);
    font-weight: 600;
}

.documentary-section {
    width: 90%;
    max-width: 1200px;
    margin: 80px auto;
    text-align: center;
}

.documentary-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 40px;
    margin-top: 40px;
}

.documentary-card {
    background: var(--offwhite);
    border: 2px solid var(--black);
    padding: 30px;
    text-align: left;
    transition: 0.3s;
}

.documentary-card:hover {
    transform: translateY(-5px);
    box-shadow: 8px 8px 0px var(--black);
}

.documentary-card h3 {
    font-size: 20px;
    font-weight: 800;
    margin-bottom: 10px;
    text-transform: uppercase;
}

.documentary-card p {
    font-size: 14px;
    color: #666;
    margin-bottom: 15px;
    line-height: 1.6;
}

.documentary-stats {
    display: flex;
    gap: 15px;
    font-size: 11px;
    color: #888;
    text-transform: uppercase;
}

.media-links {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin-top: 40px;
    flex-wrap: wrap;
}

.media-link {
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

.media-link:hover {
    background: var(--accent);
    border-color: var(--accent);
}

.media-link.secondary {
    background: transparent;
    color: var(--black);
}

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

/* ---------- FLOATING CONTACT FORM ---------- */
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
    z-index: 9998;
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

/* Footer */
footer{
  background:#111; 
  color:white; 
  padding:50px 5%; 
  margin-top:60px; 
  text-align: center; 
  font-size: 13px; 
  text-transform: uppercase;
}

body.dark footer { background: #222; }

/* Responsive */
@media (max-width: 1024px) {
    .media-hero h1 {
        font-size: 60px;
    }
    
    .folder-content {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}

@media (max-width: 768px) {
    .media-hero {
        height: 60vh;
    }
    
    .media-hero h1 {
        font-size: 48px;
    }
    
    .documentary-grid {
        grid-template-columns: 1fr;
    }
    
    .video-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
    
    .floating-contact-container {
        bottom: 20px;
        right: 20px;
    }
    
    .contact-panel {
        width: calc(100vw - 40px);
        right: -15px;
        padding: 25px;
    }
    
    #back-to-top {
        bottom: 80px;
        right: 25px;
        width: 45px;
        height: 45px;
    }
}

@media (max-width: 480px) {
    .media-hero h1 {
        font-size: 36px;
    }
    
    .media-links {
        flex-direction: column;
        align-items: center;
    }
    
    .media-link {
        width: 100%;
        max-width: 250px;
        text-align: center;
    }
    
    .floating-contact-container {
        bottom: 15px;
        right: 15px;
    }
    
    .contact-toggle-btn {
        width: 50px;
        height: 50px;
        font-size: 20px;
    }
    
    #back-to-top {
        bottom: 70px;
        right: 20px;
        width: 40px;
        height: 40px;
        font-size: 1rem;
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
// Preloader
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

<?php require_once(__DIR__ . '/../includes/header.php'); ?>



<section class="media-hero">
  <div>
    <h1>VISUAL<br>MEDIA</h1>
    <p>Documentation of Street Culture</p>
  </div>
</section>

<section class="manifesto">
  <p>Raw, unfiltered visual records of urban culture in motion. Our media archive captures the essence of street life through editorials, short films, and documentary photography.</p>
  <p>No scripts. No sets. Just real moments captured in real places with real people.</p>
</section>

<div class="folder-section show">
  <div class="folder-tab"><span>RECENT_UPLOADS</span></div>
  <div class="folder-body">
    <div class="folder-content">
      <div class="folder-image">
        <video src="images/media.mp4" autoplay loop muted playsinline></video>
      </div>
      <div class="folder-text">
        <h3>STREET DOCUMENTATION</h3>
        <p>Latest visual records from the streets of South Africa. Each video captures authentic moments of urban culture, fashion, and community.</p>
        <a href="#videos" class="btn">Watch Latest</a>
      </div>
    </div>
  </div>
</div>

<section class="video-grid" id="videos">
  <div class="video-card" onclick="playVideo('JHB Street Style', 'A day in the life of Johannesburg street fashion')">
    <img src="images/image5.jpg" alt="JHB Street Style" class="video-thumbnail">
    <div class="video-overlay">
      <span class="play-icon">▶</span>
    </div>
    <div class="video-info">
      <div class="video-title">JHB STREET STYLE</div>
      <div class="video-date">December 2025</div>
      <div class="video-duration">12:45</div>
    </div>
  </div>
  
  <div class="video-card" onclick="playVideo('Cape Town Underground', 'Exploring the underground scene in Cape Town')">
    <img src="images/image7.jpg" alt="Cape Town Underground" class="video-thumbnail">
    <div class="video-overlay">
      <span class="play-icon">▶</span>
    </div>
    <div class="video-info">
      <div class="video-title">CAPE TOWN UNDERGROUND</div>
      <div class="video-date">November 2025</div>
      <div class="video-duration">18:20</div>
    </div>
  </div>
  
  <div class="video-card" onclick="playVideo('Durban Vintage Markets', 'Vintage hunting in Durban markets')">
    <img src="images/image1.jpg" alt="Durban Vintage Markets" class="video-thumbnail">
    <div class="video-overlay">
      <span class="play-icon">▶</span>
    </div>
    <div class="video-info">
      <div class="video-title">DURBAN VINTAGE MARKETS</div>
      <div class="video-date">October 2025</div>
      <div class="video-duration">24:10</div>
    </div>
  </div>
  
  <div class="video-card" onclick="playVideo('Pretoria Archive Dig', 'Finding vintage pieces in Pretoria')">
    <img src="images/image2.jpg" alt="Pretoria Archive Dig" class="video-thumbnail">
    <div class="video-overlay">
      <span class="play-icon">▶</span>
    </div>
    <div class="video-info">
      <div class="video-title">PRETORIA ARCHIVE DIG</div>
      <div class="video-date">September 2025</div>
      <div class="video-duration">15:30</div>
    </div>
  </div>
</section>

<section class="documentary-section">
  <h2 style="margin-bottom: 20px; text-transform: uppercase; font-weight: 800;">DOCUMENTARY SERIES</h2>
  <p style="margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto;">In-depth explorations of South African street culture through long-form documentaries.</p>
  
  <div class="documentary-grid">
    <div class="documentary-card">
      <h3>THE ARCHIVE PROCESS</h3>
      <p>Follow our team as we source, document, and preserve vintage pieces from across South Africa. See the behind-the-scenes of how archive pieces are recovered.</p>
      <div class="documentary-stats">
        <span>45:20</span>
        <span>4K RESOLUTION</span>
        <span>2025</span>
      </div>
    </div>
    
    <div class="documentary-card">
      <h3>STREET CULTURE EVOLUTION</h3>
      <p>Documenting the evolution of street fashion in South Africa from the 90s to present day. Interviews with pioneers and current influencers.</p>
      <div class="documentary-stats">
        <span>58:10</span>
        <span>DOCUMENTARY</span>
        <span>2025</span>
      </div>
    </div>
    
    <div class="documentary-card">
      <h3>SOUND OF THE STREETS</h3>
      <p>Exploring the connection between street fashion and underground music scenes in South Africa's major cities.</p>
      <div class="documentary-stats">
        <span>36:45</span>
        <span>MUSIC + FASHION</span>
        <span>2024</span>
      </div>
    </div>
  </div>
</section>

<section class="carousel">
  <div class="carousel-overlay">
    <p>BEHIND THE SCENES<br>PHOTO ARCHIVE</p>
  </div>
  <div class="carousel-track">
    <img src="images/image6.jpg" loading="eager" width="260" height="320" alt="BTS 1">
    <img src="images/image7.jpg" loading="eager" width="260" height="320" alt="BTS 2">
    <img src="images/image5.jpg" loading="eager" width="260" height="320" alt="BTS 3">
    <img src="images/image1.jpg" loading="eager" width="260" height="320" alt="BTS 4">
    <img src="images/image3.jpg" loading="eager" width="260" height="320" alt="BTS 5">
    <img src="images/image4.jpg" loading="eager" width="260" height="320" alt="BTS 6">
  </div>
</section>

<div class="media-links">
  <a href="https://youtube.com" target="_blank" class="media-link">VIEW ON YOUTUBE</a>
  <a href="https://vimeo.com" target="_blank" class="media-link secondary">VIEW ON VIMEO</a>
  <a href="https://instagram.com" target="_blank" class="media-link secondary">FOLLOW ON INSTAGRAM</a>
</div>

<footer>
  <p>STREETS ARCHIVES — SOUTH AFRICA<br>FASHION • SOUND • VISUAL RECORDS<br>EST. 2026</p>
  <p>Privacy • Shipping • Returns • Contact</p>
</footer>

<div id="progress"></div>
<div id="cursor"></div>
<div id="toast"></div>
<button id="back-to-top">
  <i class="bi bi-chevron-up"></i>
</button>


<!-- Media-specific JavaScript -->
<script>
// Video player function
function playVideo(title, description) {
    alert('Playing: ' + title + '\n' + description);
    // In a real application, this would open a video player modal
}
</script>

<!-- Include main.js - This handles hamburger menu and contact form -->
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