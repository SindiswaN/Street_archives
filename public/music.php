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
/* ---------- ENHANCED MUSIC HERO ---------- */
.music-hero {
    height: 80vh;
    background: linear-gradient(rgba(0,0,0,0.85), rgba(0,0,0,0.85)), url('images/image1.jpg');
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

.music-hero::before {
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

.music-hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    padding: 0 20px;
}

.music-hero h1 {
    font-size: 6rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -3px;
    margin-bottom: 20px;
    line-height: 0.9;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.music-hero p {
    font-size: 1.2rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    opacity: 0.8;
    margin-bottom: 40px;
    font-weight: 300;
}

.music-hero-stats {
    display: flex;
    justify-content: center;
    gap: 40px;
    margin-top: 40px;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--accent);
    display: block;
    margin-bottom: 5px;
}

.stat-label {
    font-size: 0.8rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    opacity: 0.7;
}

/* ---------- MANIFESTO ---------- */
.manifesto {
    width: 85%;
    max-width: 1100px;
    margin: 80px auto;
    text-align: center;
    padding: 60px;
    background: var(--offwhite);
    border: 2px solid var(--black);
    border-radius: 12px;
    position: relative;
    box-shadow: 8px 8px 0px var(--black);
}

.manifesto::before {
    content: '〄';
    position: absolute;
    top: -25px;
    left: 50%;
    transform: translateX(-50%);
    background: var(--bg);
    color: var(--accent);
    font-size: 2rem;
    padding: 0 20px;
}

.manifesto p {
    font-size: 1.1rem;
    line-height: 1.8;
    margin-bottom: 20px;
    font-weight: 400;
}

/* Add to your CSS */
.release-artwork {
    width: 100%;
    height: 200px;
    object-fit: cover;
    margin-bottom: 20px;
    border-radius: 8px;
    border: 1px solid rgba(0,0,0,0.1);
    transition: transform 0.3s;
    background: linear-gradient(45deg, var(--black), var(--grey));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--accent);
    font-size: 2rem;
}

/* ---------- ENHANCED MUSIC PLAYER ---------- */
.music-player-large {
    background: #000;
    color: white;
    padding: 40px;
    border-radius: 12px;
    margin: 60px auto;
    width: 85%;
    max-width: 1100px;
    border: 2px solid var(--accent);
    position: relative;
    overflow: hidden;
}

.music-player-large::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--accent), #ff5c33, var(--accent));
    background-size: 200% 100%;
    animation: shimmer 2s linear infinite;
}

@keyframes shimmer {
    0% { background-position: -200% 0; }
    100% { background-position: 200% 0; }
}

.player-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid rgba(255,255,255,0.1);
}

.player-title {
    display: flex;
    align-items: center;
    gap: 15px;
    font-size: 1.5rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.player-title i {
    color: var(--accent);
    font-size: 2rem;
}

.player-status {
    font-size: 0.8rem;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 1px;
    background: rgba(255,255,255,0.1);
    padding: 5px 15px;
    border-radius: 20px;
}

.now-playing-info {
    margin: 30px 0;
    padding: 20px;
    background: rgba(255,255,255,0.05);
    border-radius: 8px;
}

.now-playing-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 5px;
    color: white;
}

.now-playing-artist {
    font-size: 1rem;
    color: #888;
    margin-bottom: 10px;
}

.now-playing-album {
    font-size: 0.9rem;
    color: var(--accent);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.player-controls-large {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-top: 30px;
}

.control-btn {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    color: white;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s;
    font-size: 1.2rem;
}

.control-btn:hover {
    background: var(--accent);
    transform: scale(1.1);
}

.play-btn-large {
    width: 70px;
    height: 70px;
    background: var(--accent);
    border: none;
}

.play-btn-large:hover {
    background: #ff5c33;
}

.progress-bar-large {
    flex-grow: 1;
    height: 6px;
    background: rgba(255,255,255,0.1);
    cursor: pointer;
    position: relative;
    border-radius: 3px;
    overflow: hidden;
}

.progress-fill-large {
    width: 0%;
    height: 100%;
    background: var(--accent);
    border-radius: 3px;
    transition: width 0.1s;
    position: relative;
}

.progress-fill-large::after {
    content: '';
    position: absolute;
    right: 0;
    top: -2px;
    width: 10px;
    height: 10px;
    background: white;
    border-radius: 50%;
    transform: translateX(50%);
}

.time-display {
    font-family: monospace;
    font-size: 0.9rem;
    color: #888;
    min-width: 100px;
    text-align: center;
}

.volume-control {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-left: 20px;
}

.volume-control i {
    color: #888;
    font-size: 1.2rem;
}

.volume-slider {
    width: 80px;
    height: 4px;
    background: rgba(255,255,255,0.1);
    border-radius: 2px;
    -webkit-appearance: none;
    appearance: none;
}

.volume-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 12px;
    height: 12px;
    background: var(--accent);
    border-radius: 50%;
    cursor: pointer;
}

/* ---------- TRACKS SECTION ---------- */
.tracks-section {
    width: 85%;
    max-width: 1100px;
    margin: 80px auto;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
}

.section-header h2 {
    font-size: 2rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -1px;
}

.filter-controls {
    display: flex;
    gap: 10px;
}

.filter-btn {
    padding: 8px 20px;
    border: 2px solid var(--black);
    background: transparent;
    color: var(--text);
    font-family: 'Poppins', sans-serif;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s;
    border-radius: 4px;
}

.filter-btn:hover, .filter-btn.active {
    background: var(--black);
    color: white;
}

.tracks-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 20px;
}

.track-card {
    background: var(--offwhite);
    padding: 20px;
    border: 2px solid var(--black);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 15px;
    position: relative;
    overflow: hidden;
}

.track-card::before {
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

.track-card:hover::before {
    transform: translateX(0);
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
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { box-shadow: 0 0 0 0 rgba(255, 60, 0, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(255, 60, 0, 0); }
    100% { box-shadow: 0 0 0 0 rgba(255, 60, 0, 0); }
}

.track-number {
    font-size: 1rem;
    font-weight: 700;
    color: #888;
    min-width: 40px;
    text-align: center;
    font-family: monospace;
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
    font-size: 1rem;
}

.track-artist {
    font-size: 0.9rem;
    color: #888;
    margin-bottom: 5px;
}

.track-card.playing .track-artist {
    color: rgba(255,255,255,0.8);
}

.track-meta {
    display: flex;
    gap: 15px;
    font-size: 0.8rem;
    color: #888;
}

.track-genre {
    background: rgba(255, 60, 0, 0.1);
    color: var(--accent);
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.track-duration {
    font-size: 0.9rem;
    color: #888;
    font-weight: 600;
    min-width: 50px;
    text-align: right;
}

/* ---------- DIGITAL RELEASES ---------- */
.releases-section {
    width: 85%;
    max-width: 1100px;
    margin: 80px auto;
    text-align: center;
}

.releases-section h2 {
    font-size: 2rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -1px;
    margin-bottom: 20px;
}

.releases-section p {
    margin-bottom: 40px;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    font-size: 1rem;
    line-height: 1.6;
}

.releases-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.release-card {
    background: var(--offwhite);
    border: 2px solid var(--black);
    border-radius: 12px;
    padding: 25px;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.release-card::before {
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

.release-card:hover::before {
    transform: translateY(0);
}

.release-card:hover {
    transform: translateY(-10px);
    box-shadow: 12px 12px 0px var(--black);
}

.release-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: var(--accent);
    color: white;
    font-size: 0.7rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    padding: 3px 10px;
    border-radius: 12px;
    z-index: 2;
}

.release-artwork {
    width: 100%;
    height: 200px;
    object-fit: cover;
    margin-bottom: 20px;
    border-radius: 8px;
    border: 1px solid rgba(0,0,0,0.1);
    transition: transform 0.3s;
}

.release-card:hover .release-artwork {
    transform: scale(1.05);
}

.release-title {
    font-weight: 800;
    margin-bottom: 5px;
    text-transform: uppercase;
    font-size: 1.1rem;
}

.release-artist {
    font-size: 0.9rem;
    color: #888;
    margin-bottom: 10px;
}

.release-price {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--accent);
    margin: 15px 0;
}

.release-date {
    font-size: 0.8rem;
    color: #888;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 20px;
}

.add-to-cart-btn {
    width: 100%;
    padding: 12px;
    background: var(--black);
    color: white;
    border: none;
    border-radius: 6px;
    font-family: 'Poppins', sans-serif;
    font-size: 0.9rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.add-to-cart-btn:hover {
    background: var(--accent);
    transform: translateY(-2px);
}

/* ---------- MUSIC STREAMING LINKS ---------- */
.music-links-section {
    width: 85%;
    max-width: 1100px;
    margin: 80px auto;
    text-align: center;
}

.music-links-section h2 {
    font-size: 2rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -1px;
    margin-bottom: 40px;
}

.music-links-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.music-link-card {
    background: var(--offwhite);
    border: 2px solid var(--black);
    border-radius: 12px;
    padding: 30px;
    text-align: center;
    transition: all 0.3s ease;
    text-decoration: none;
    color: var(--text);
}

.music-link-card:hover {
    transform: translateY(-5px);
    box-shadow: 8px 8px 0px var(--black);
    border-color: var(--accent);
}

.music-link-icon {
    font-size: 3rem;
    color: var(--accent);
    margin-bottom: 20px;
}

.music-link-card h3 {
    font-size: 1.2rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 10px;
}

.music-link-card p {
    font-size: 0.9rem;
    color: #888;
    margin-bottom: 20px;
}

.follow-btn {
    display: inline-block;
    padding: 8px 20px;
    background: var(--black);
    color: white;
    text-decoration: none;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 1px;
    border-radius: 4px;
    transition: all 0.3s;
}

.follow-btn:hover {
    background: var(--accent);
}

/* ---------- LIVE STREAM SECTION ---------- */
.live-stream-section {
    width: 85%;
    max-width: 1100px;
    margin: 80px auto;
}

.live-stream-card {
    background: #000;
    color: white;
    padding: 40px;
    border-radius: 12px;
    border: 2px solid var(--accent);
    position: relative;
    overflow: hidden;
}

.live-stream-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 80%, rgba(255, 60, 0, 0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 60, 0, 0.05) 0%, transparent 50%);
}

.stream-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
    position: relative;
    z-index: 2;
}

.stream-title {
    font-size: 1.8rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--accent);
}

.stream-status {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 0.9rem;
}

.status-indicator {
    width: 10px;
    height: 10px;
    background: #00ff00;
    border-radius: 50%;
    animation: pulse 2s infinite;
    box-shadow: 0 0 10px #00ff00;
}

.stream-details {
    font-family: monospace;
    font-size: 0.9rem;
    color: #888;
    line-height: 1.8;
    position: relative;
    z-index: 2;
    background: rgba(0,0,0,0.5);
    padding: 20px;
    border-radius: 8px;
    border: 1px solid rgba(255,255,255,0.1);
}

.stream-actions {
    display: flex;
    gap: 15px;
    margin-top: 30px;
    position: relative;
    z-index: 2;
}

.stream-btn {
    padding: 12px 30px;
    border: 2px solid var(--accent);
    background: var(--accent);
    color: white;
    text-decoration: none;
    font-weight: 700;
    text-transform: uppercase;
    font-size: 0.9rem;
    letter-spacing: 1px;
    border-radius: 6px;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    gap: 8px;
}

.stream-btn:hover {
    background: transparent;
    color: var(--accent);
    transform: translateY(-2px);
}

.stream-btn.secondary {
    background: transparent;
    color: var(--accent);
}

.stream-btn.secondary:hover {
    background: var(--accent);
    color: white;
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

/* ---------- RESPONSIVE DESIGN ---------- */
@media (max-width: 1024px) {
    .music-hero h1 {
        font-size: 4rem;
    }
    
    .tracks-grid,
    .releases-grid,
    .music-links-grid {
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    }
}

@media (max-width: 768px) {
    .music-hero {
        height: 60vh;
    }
    
    .music-hero h1 {
        font-size: 3rem;
    }
    
    .music-hero-stats {
        gap: 20px;
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .section-header {
        flex-direction: column;
        gap: 20px;
        align-items: flex-start;
    }
    
    .filter-controls {
        width: 100%;
        overflow-x: auto;
        padding-bottom: 10px;
    }
    
    .player-header {
        flex-direction: column;
        gap: 15px;
        align-items: flex-start;
    }
    
    .player-controls-large {
        flex-wrap: wrap;
    }
    
    .progress-bar-large {
        order: 3;
        width: 100%;
        margin-top: 10px;
    }
    
    .contact-panel {
        width: calc(100vw - 40px);
        right: -15px;
        padding: 25px;
    }
}

@media (max-width: 480px) {
    .music-hero h1 {
        font-size: 2.5rem;
    }
    
    .music-hero p {
        font-size: 1rem;
        letter-spacing: 2px;
    }
    
    .tracks-grid,
    .releases-grid,
    .music-links-grid {
        grid-template-columns: 1fr;
    }
    
    .track-card,
    .release-card,
    .music-link-card {
        padding: 15px;
    }
    
    .floating-contact-container {
        bottom: 20px;
        right: 20px;
    }
    
    .contact-toggle-btn {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
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

/* ---------- FOOTER ---------- */
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
</style>
</head>

<body>

<div id="preloader">
  <div class="loader"></div>
  <p>Loading Archive...</p>
</div>

<!-- Preloader hiding script -->
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

<section class="music-hero">
  <div class="music-hero-content">
    <h1>SOUND<br>ARCHIVE</h1>
    <p>Underground Frequencies • South Africa</p>
    <div class="music-hero-stats">
      <div class="stat-item">
        <span class="stat-number">247</span>
        <span class="stat-label">Live Listeners</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">3000+</span>
        <span class="stat-label">Tracks</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">24/7</span>
        <span class="stat-label">Live Stream</span>
      </div>
      <div class="stat-item">
        <span class="stat-number">AES-256</span>
        <span class="stat-label">Encryption</span>
      </div>
    </div>
  </div>
</section>

<section class="manifesto">
  <p>The sound of the underground, broadcast and preserved. Live sessions, collaborations, and cultural frequencies transmitted from our headquarters in South Africa.</p>
  <p>From Amapiano to Electronic, Jazz to Experimental—archive the frequencies that move you.</p>
</section>

<div class="music-player-large">
  <div class="player-header">
    <div class="player-title">
      <i class="bi bi-vinyl"></i>
      STREETS RADIO 3000
    </div>
    <div class="player-status">
      <i class="bi bi-circle-fill" style="color: #00ff00; font-size: 0.6rem;"></i>
      LIVE TRANSMISSION
    </div>
  </div>
  
  <div class="now-playing-info">
    <div class="now-playing-title" id="now-playing-title">UNDERGROUND FREQUENCIES VOL. 1</div>
    <div class="now-playing-artist" id="now-playing-artist">Mixed by Archive Crew</div>
    <div class="now-playing-album" id="now-playing-album">STREETS ARCHIVES • DEC 2025</div>
  </div>
  
  <div class="player-controls-large">
    <button class="control-btn" id="prev-btn">
      <i class="bi bi-skip-backward"></i>
    </button>
    <button class="control-btn play-btn-large" id="main-play-btn">
      <i class="bi bi-play-fill"></i>
    </button>
    <button class="control-btn" id="next-btn">
      <i class="bi bi-skip-forward"></i>
    </button>
    
    <div class="progress-bar-large" id="main-progress-container">
      <div class="progress-fill-large" id="main-progress-bar"></div>
    </div>
    
    <div class="time-display">
      <span id="current-time">0:00</span> / <span id="total-time">45:30</span>
    </div>
    
    <div class="volume-control">
      <i class="bi bi-volume-down"></i>
      <input type="range" class="volume-slider" id="volume-slider" min="0" max="100" value="70">
      <i class="bi bi-volume-up"></i>
    </div>
  </div>
  
  <audio id="main-audio" preload="metadata"></audio>
</div>

<div class="live-stream-section">
  <div class="live-stream-card">
    <div class="stream-header">
      <div class="stream-title">
        <i class="bi bi-broadcast"></i>
        LIVE STREAM
      </div>
      <div class="stream-status">
        <span class="status-indicator"></span>
        <span>LIVE NOW • 247 LISTENERS</span>
      </div>
    </div>
    
    <div class="stream-details">
      <div><strong>HOST:</strong> DJ ARCHIVE</div>
      <div><strong>SHOW:</strong> NIGHT SESSIONS</div>
      <div><strong>TIME:</strong> 22:00 - 04:00 (SAST)</div>
      <div><strong>GENRE:</strong> DOWNTEMPO • AMBIENT • EXPERIMENTAL</div>
      <div><strong>FREQUENCY:</strong> 3000 MHz</div>
      <div><strong>ENCRYPTION:</strong> AES-256</div>
    </div>
    
    <div class="stream-actions">
      <button class="stream-btn" id="listen-live-btn">
        <i class="bi bi-play-fill"></i>
        LISTEN LIVE
      </button>
      <a href="#tracks" class="stream-btn secondary">
        <i class="bi bi-music-note-list"></i>
        BROWSE ARCHIVE
      </a>
    </div>
  </div>
</div>

<section class="tracks-section" id="tracks">
  <div class="section-header">
    <h2>ARCHIVE TRACKS</h2>
    <div class="filter-controls">
      <button class="filter-btn active" data-filter="all">All</button>
      <button class="filter-btn" data-filter="electronic">Electronic</button>
      <button class="filter-btn" data-filter="amapiano">Amapiano</button>
      <button class="filter-btn" data-filter="experimental">Experimental</button>
      <button class="filter-btn" data-filter="jazz">Jazz</button>
    </div>
  </div>
  
  <div class="tracks-grid" id="tracks-container">
    <!-- Tracks will be loaded by JavaScript -->
  </div>
</section>

<section class="releases-section" id="releases">
  <h2>DIGITAL RELEASES</h2>
  <p>Purchase exclusive digital releases from the Streets Archives collective. All purchases include high-quality WAV files and exclusive artwork.</p>
  
  <div class="releases-grid" id="releases-container">
    <!-- Releases will be loaded by JavaScript -->
  </div>
</section>

<section class="music-links-section">
  <h2>STREAM EVERYWHERE</h2>
  <div class="music-links-grid">
    <a href="https://soundcloud.com" target="_blank" class="music-link-card">
      <div class="music-link-icon">
        <i class="bi bi-soundwave"></i>
      </div>
      <h3>SoundCloud</h3>
      <p>Exclusive mixes and premieres</p>
      <span class="follow-btn">Follow</span>
    </a>
    
    <a href="https://spotify.com" target="_blank" class="music-link-card">
      <div class="music-link-icon">
        <i class="bi bi-spotify"></i>
      </div>
      <h3>Spotify</h3>
      <p>Official releases and playlists</p>
      <span class="follow-btn">Follow</span>
    </a>
    
    <a href="https://bandcamp.com" target="_blank" class="music-link-card">
      <div class="music-link-icon">
        <i class="bi bi-music-note-beamed"></i>
      </div>
      <h3>Bandcamp</h3>
      <p>Direct support and exclusives</p>
      <span class="follow-btn">Follow</span>
    </a>
    
    <a href="https://mixcloud.com" target="_blank" class="music-link-card">
      <div class="music-link-icon">
        <i class="bi bi-cloud-upload"></i>
      </div>
      <h3>Mixcloud</h3>
      <p>Live sets and radio shows</p>
      <span class="follow-btn">Follow</span>
    </a>
  </div>
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
  <span>Item added to cart!</span>
</div>

<button id="back-to-top">
  <i class="bi bi-chevron-up"></i>
</button>

<script>
// Enhanced Music Player with Real Functionality
document.addEventListener('DOMContentLoaded', function() {
    // Real music data
    const musicTracks = [
        {
            id: 1,
            title: 'UNDERGROUND FREQUENCIES',
            artist: 'Archive Crew',
            album: 'Streets Archives Vol. 1',
            duration: '6:45',
            genre: 'electronic',
            file: 'music/underground_frequencies.mp3',
            price: 'R 49.99'
        },
        {
            id: 2,
            title: 'NIGHT DRIVE',
            artist: 'Night Shift',
            album: 'City Nights EP',
            duration: '5:20',
            genre: 'electronic',
            file: 'music/night_drive.mp3',
            price: 'R 39.99'
        },
        {
            id: 3,
            title: 'AMAPIANO VIBES',
            artist: 'SA Sessions',
            album: 'South African Sessions',
            duration: '7:15',
            genre: 'amapiano',
            file: 'music/amapiano_vibes.mp3',
            price: 'R 59.99'
        },
        {
            id: 4,
            title: 'URBAN ECHOES',
            artist: 'Street Sound Collective',
            album: 'Urban Echoes',
            duration: '4:55',
            genre: 'experimental',
            file: 'music/urban_echoes.mp3',
            price: 'R 44.99'
        },
        {
            id: 5,
            title: 'JAZZ FREQUENCIES',
            artist: 'Cape Town Jazz Quartet',
            album: 'Live at Archive',
            duration: '8:30',
            genre: 'jazz',
            file: 'music/jazz_frequencies.mp3',
            price: 'R 69.99'
        },
        {
            id: 6,
            title: 'DIGITAL DREAMS',
            artist: 'Digital Collective',
            album: 'Digital Dreams',
            duration: '6:10',
            genre: 'electronic',
            file: 'music/digital_dreams.mp3',
            price: 'R 54.99'
        },
        {
            id: 7,
            title: 'AFRO TECH',
            artist: 'African Technicians',
            album: 'Tech Waves',
            duration: '5:45',
            genre: 'experimental',
            file: 'music/afro_tech.mp3',
            price: 'R 49.99'
        },
        {
            id: 8,
            title: 'SOUL TRANSMISSION',
            artist: 'Soul Archive',
            album: 'Soul Sessions',
            duration: '7:25',
            genre: 'jazz',
            file: 'music/soul_transmission.mp3',
            price: 'R 59.99'
        }
    ];

    const musicReleases = [
    {
        id: 101,
        title: 'UNDERGROUND FREQUENCIES VOL. 1',
        artist: 'Various Artists',
        price: 'R 149.99',
        image: 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=400&q=80',
        date: 'DEC 2025',
        genre: 'Electronic',
        tracks: 12,
        format: 'WAV/MP3'
    },
    {
        id: 102,
        title: 'SOUTH AFRICAN SESSIONS',
        artist: 'SA Collective',
        price: 'R 129.99',
        image: 'https://images.unsplash.com/photo-1493225457124-a3eb161ffa5f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=400&q=80',
        date: 'NOV 2025',
        genre: 'Amapiano',
        tracks: 10,
        format: 'WAV/MP3'
    },
    {
        id: 103,
        title: 'EXPERIMENTAL ARCHIVES',
        artist: 'Archive Crew',
        price: 'R 179.99',
        image: 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=400&q=80',
        date: 'OCT 2025',
        genre: 'Experimental',
        tracks: 8,
        format: 'WAV/MP3'
    },
    {
        id: 104,
        title: 'JAZZ FROM THE ARCHIVE',
        artist: 'Archive Jazz Collective',
        price: 'R 199.99',
        image: 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&h=400&q=80',
        date: 'SEP 2025',
        genre: 'Jazz',
        tracks: 6,
        format: 'WAV/MP3'
    }
];

    // Music Player Elements
    const audioPlayer = document.getElementById('main-audio');
    const playBtn = document.getElementById('main-play-btn');
    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    const progressBar = document.getElementById('main-progress-bar');
    const progressContainer = document.getElementById('main-progress-container');
    const currentTimeDisplay = document.getElementById('current-time');
    const totalTimeDisplay = document.getElementById('total-time');
    const volumeSlider = document.getElementById('volume-slider');
    const nowPlayingTitle = document.getElementById('now-playing-title');
    const nowPlayingArtist = document.getElementById('now-playing-artist');
    const nowPlayingAlbum = document.getElementById('now-playing-album');
    
    // Tracks Container
    const tracksContainer = document.getElementById('tracks-container');
    const releasesContainer = document.getElementById('releases-container');
    
    let currentTrackIndex = 0;
    let isPlaying = false;
    let currentTime = 0;
    let totalTime = 0;

    // Format time function
    function formatTime(seconds) {
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs.toString().padStart(2, '0')}`;
    }

    // Load track
    function loadTrack(index) {
        if (index < 0 || index >= musicTracks.length) return;
        
        currentTrackIndex = index;
        const track = musicTracks[index];
        
        audioPlayer.src = track.file;
        nowPlayingTitle.textContent = track.title;
        nowPlayingArtist.textContent = track.artist;
        nowPlayingAlbum.textContent = track.album;
        
        // Update playlist UI
        updatePlaylistUI();
        
        // Load metadata
        audioPlayer.addEventListener('loadedmetadata', () => {
            totalTime = audioPlayer.duration;
            totalTimeDisplay.textContent = formatTime(totalTime);
        }, { once: true });
        
        // Auto play
        audioPlayer.play().catch(e => {
            console.log("Autoplay prevented:", e);
            playBtn.innerHTML = '<i class="bi bi-play-fill"></i>';
        });
        
        playBtn.innerHTML = '<i class="bi bi-pause-fill"></i>';
        isPlaying = true;
    }

    // Update playlist UI
    function updatePlaylistUI() {
        tracksContainer.innerHTML = '';
        
        musicTracks.forEach((track, index) => {
            const trackCard = document.createElement('div');
            trackCard.className = `track-card ${index === currentTrackIndex ? 'playing' : ''}`;
            trackCard.setAttribute('data-genre', track.genre);
            trackCard.innerHTML = `
                <div class="track-number">${String(index + 1).padStart(2, '0')}</div>
                <div class="track-info">
                    <div class="track-title">${track.title}</div>
                    <div class="track-artist">${track.artist}</div>
                    <div class="track-meta">
                        <span class="track-genre">${track.genre.toUpperCase()}</span>
                        <span class="track-album">${track.album}</span>
                    </div>
                </div>
                <div class="track-duration">${track.duration}</div>
            `;
            
            trackCard.addEventListener('click', () => {
                loadTrack(index);
            });
            
            tracksContainer.appendChild(trackCard);
        });
    }

    // Load releases
function loadReleases() {
    releasesContainer.innerHTML = '';
    
    musicReleases.forEach(release => {
        // Properly escape the title for the onclick
        const escapedTitle = release.title.replace(/'/g, "\\'");
        
        const releaseCard = document.createElement('div');
        releaseCard.className = 'release-card';
        releaseCard.innerHTML = `
            <div class="release-badge">${release.format}</div>
            <img src="${release.image}" alt="${release.title}" class="release-artwork" 
                 onerror="this.src='images/default-music.jpg'">
            <div class="release-title">${release.title}</div>
            <div class="release-artist">${release.artist}</div>
            <div class="release-date">${release.date} • ${release.tracks} TRACKS</div>
            <div class="release-price">${release.price}</div>
            <button class="add-to-cart-btn" data-release-id="${release.id}">
                <i class="bi bi-cart-plus"></i>
                ADD TO CART
            </button>
        `;
        
        // Add event listener directly instead of using onclick
        const addToCartBtn = releaseCard.querySelector('.add-to-cart-btn');
        addToCartBtn.addEventListener('click', () => {
            addToCart(
                release.id,
                release.title,
                release.price,
                release.image,
                'Digital',
                1,
                'music'
            );
        });
        
        releasesContainer.appendChild(releaseCard);
    });
}

    // Play/Pause
    playBtn.addEventListener('click', () => {
        if (audioPlayer.paused) {
            if (!audioPlayer.src) {
                loadTrack(0);
            } else {
                audioPlayer.play();
            }
            playBtn.innerHTML = '<i class="bi bi-pause-fill"></i>';
            isPlaying = true;
        } else {
            audioPlayer.pause();
            playBtn.innerHTML = '<i class="bi bi-play-fill"></i>';
            isPlaying = false;
        }
    });

    // Previous track
    prevBtn.addEventListener('click', () => {
        let newIndex = currentTrackIndex - 1;
        if (newIndex < 0) newIndex = musicTracks.length - 1;
        loadTrack(newIndex);
    });

    // Next track
    nextBtn.addEventListener('click', () => {
        let newIndex = currentTrackIndex + 1;
        if (newIndex >= musicTracks.length) newIndex = 0;
        loadTrack(newIndex);
    });

    // Volume control
    volumeSlider.addEventListener('input', () => {
        audioPlayer.volume = volumeSlider.value / 100;
    });

    // Progress bar
    audioPlayer.addEventListener('timeupdate', () => {
        if (audioPlayer.duration) {
            const percent = (audioPlayer.currentTime / audioPlayer.duration) * 100;
            progressBar.style.width = `${percent}%`;
            currentTimeDisplay.textContent = formatTime(audioPlayer.currentTime);
        }
    });

    // Click on progress bar to seek
    progressContainer.addEventListener('click', (e) => {
        if (audioPlayer.duration) {
            const rect = progressContainer.getBoundingClientRect();
            const pos = (e.clientX - rect.left) / rect.width;
            audioPlayer.currentTime = pos * audioPlayer.duration;
        }
    });

    // Auto play next track
    audioPlayer.addEventListener('ended', () => {
        let newIndex = currentTrackIndex + 1;
        if (newIndex >= musicTracks.length) newIndex = 0;
        loadTrack(newIndex);
    });

    // Filter tracks
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.getAttribute('data-filter');
            document.querySelectorAll('.track-card').forEach(card => {
                if (filter === 'all' || card.getAttribute('data-genre') === filter) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Live stream button
    document.getElementById('listen-live-btn').addEventListener('click', function() {
        const originalText = this.innerHTML;
        if (this.innerHTML.includes('LISTEN LIVE')) {
            this.innerHTML = '<i class="bi bi-pause-fill"></i> STOP STREAM';
            this.style.background = 'transparent';
            this.style.color = 'var(--accent)';
            
            // Simulate live stream (in a real app, this would connect to a real stream)
            const notification = document.getElementById('cartNotification');
            notification.innerHTML = '<i class="bi bi-broadcast"></i><span>Connecting to live stream...</span>';
            notification.style.display = 'block';
            
            setTimeout(() => {
                notification.innerHTML = '<i class="bi bi-check-circle"></i><span>Connected to Streets Radio 3000</span>';
                setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000);
            }, 1000);
        } else {
            this.innerHTML = '<i class="bi bi-play-fill"></i> LISTEN LIVE';
            this.style.background = '';
            this.style.color = '';
            
            const notification = document.getElementById('cartNotification');
            notification.innerHTML = '<i class="bi bi-broadcast"></i><span>Stream stopped</span>';
            notification.style.display = 'block';
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }
    });

    // Initialize
    updatePlaylistUI();
    loadReleases();
    loadTrack(0);

    // Scroll progress
    window.addEventListener('scroll', () => {
        const scrollPercent = (window.scrollY / (document.body.scrollHeight - window.innerHeight)) * 100;
        document.getElementById('progress').style.width = scrollPercent + '%';
        
        // Back to top button
        if (window.scrollY > 300) {
            document.getElementById('back-to-top').style.display = 'flex';
        } else {
            document.getElementById('back-to-top').style.display = 'none';
        }
    });

    // Back to top
    document.getElementById('back-to-top').addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId && targetId !== '#') {
                const target = document.querySelector(targetId);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
});

// Universal addToCart function for music page
function addToCart(productId, name, price, image, size = 'Digital', quantity = 1, type = 'music') {
    console.log('Adding to cart:', { productId, name, price, image, size, quantity, type });
    
    // Show immediate feedback
    const notification = document.getElementById('cartNotification');
    if (notification) {
        notification.innerHTML = `<i class="bi bi-cart-plus"></i><span>Adding "${name}" to cart...</span>`;
        notification.style.background = 'var(--accent)';
        notification.style.display = 'block';
        
        // Clear any existing timeout
        if (notification.timeoutId) {
            clearTimeout(notification.timeoutId);
        }
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
    
    // Send request to add_to_cart.php
    fetch('../app/add_to_cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        console.log('Add to cart response:', data);
        
        if (data.success) {
            // Update cart count in header
            updateCartCount(data.cartCount);
            
            // Show success notification
            if (notification) {
                notification.innerHTML = `<i class="bi bi-check-circle"></i><span>${name} added to cart!</span>`;
                notification.style.background = 'var(--black)';
                
                // Set timeout to hide notification
                notification.timeoutId = setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000);
            }
            
            // Add visual feedback to the button
            const event = window.event || {};
            const clickedBtn = event.target?.closest('.add-to-cart-btn') || event.target;
            if (clickedBtn) {
                const originalHTML = clickedBtn.innerHTML;
                clickedBtn.innerHTML = '<i class="bi bi-check2"></i> ADDED';
                clickedBtn.style.background = '#10b981';
                clickedBtn.disabled = true;
                
                // Revert button after 2 seconds
                setTimeout(() => {
                    clickedBtn.innerHTML = originalHTML;
                    clickedBtn.style.background = '';
                    clickedBtn.disabled = false;
                }, 2000);
            }
        } else {
            // Show error notification
            if (notification) {
                notification.innerHTML = `<i class="bi bi-x-circle"></i><span>Failed to add item</span>`;
                notification.style.background = '#dc3545';
                
                notification.timeoutId = setTimeout(() => {
                    notification.style.display = 'none';
                }, 3000);
            }
        }
    })
    .catch(error => {
        console.error('Error adding to cart:', error);
        
        // Show error notification
        if (notification) {
            notification.innerHTML = `<i class="bi bi-x-circle"></i><span>Network error. Please try again.</span>`;
            notification.style.background = '#dc3545';
            
            notification.timeoutId = setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);
        }
    });
}

// Function to update cart count in header
function updateCartCount(count) {
    // Update all cart elements
    document.querySelectorAll('.cart').forEach(cart => {
        cart.textContent = `CART (${count})`;
    });
    
    // Update cart count in the header if it exists
    const cartCountElement = document.querySelector('.cart-count');
    if (cartCountElement) {
        cartCountElement.innerHTML = `<i class="bi bi-archive"></i> ${count} ITEMS`;
    }
}

// Function to show notification with auto-hide
function showNotification(message, isError = false) {
    const notification = document.getElementById('cartNotification');
    if (!notification) return;
    
    // Clear any existing timeout
    if (notification.timeoutId) {
        clearTimeout(notification.timeoutId);
    }
    
    // Update notification content
    notification.innerHTML = `<i class="bi ${isError ? 'bi-x-circle' : 'bi-check-circle'}"></i><span>${message}</span>`;
    notification.style.background = isError ? '#dc3545' : 'var(--accent)';
    notification.style.display = 'block';
    
    // Set timeout to hide notification
    notification.timeoutId = setTimeout(() => {
        notification.style.display = 'none';
    }, 3000);
}

// Initialize cart count on page load
document.addEventListener('DOMContentLoaded', function() {
    // Get cart count from session on page load
    fetch('../app/get_cart_count.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updateCartCount(data.cartCount);
            }
        })
        .catch(error => {
            console.error('Error fetching cart count:', error);
        });
    
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
});

// Theme toggle (from header)
document.addEventListener('DOMContentLoaded', function() {
    const themeToggle = document.getElementById('theme-toggle');
    if (themeToggle) {
        themeToggle.addEventListener('click', () => {
            document.body.classList.toggle('dark');
            themeToggle.innerHTML = document.body.classList.contains('dark') 
                ? '<i class="bi bi-sun"></i>' 
                : '<i class="bi bi-moon"></i>';
        });
    }
});
</script>

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