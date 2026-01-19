<?php
$pageTitle = 'About';
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
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

<style>
/* ---------- GLOBAL ---------- */
*{margin:0;padding:0;box-sizing:border-box;}

:root{
  --black:#111111;
  --dark-grey:#1a1a1a;
  --grey:#e6e6e6;
  --offwhite:#f8f8f8;
  --accent: #ff3c00;
  --accent-light: #ff5c33;
  --bg: #ffffff;
  --text: #111111;
  --header-bg: rgba(255, 255, 255, 0.95);
  --transition: cubic-bezier(0.4, 0, 0.2, 1);
}

body{
  font-family:'Inter', sans-serif;
  background: var(--bg);
  color: var(--text);
  overflow-x: hidden;
  min-height: 100vh;
  position: relative;
}

/* Dark Mode */
body.dark {
  --black: #ffffff;
  --dark-grey: #f0f0f0;
  --grey: #333333;
  --offwhite: #1a1a1a;
  --accent: #ff5c33;
  --accent-light: #ff7d5c;
  --bg: #0a0a0a;
  --text: #ffffff;
  --header-bg: rgba(10, 10, 10, 0.95);
}

/* ---------- TOP BAR ---------- */
.top-bar{
  background: var(--black); 
  color: white; 
  padding: 12px 0; 
  overflow: hidden;
  position: relative;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.top-bar p{
  animation: scrollText 40s linear infinite; 
  font-size: 13px; 
  white-space: nowrap;
  font-weight: 500;
  letter-spacing: 0.5px;
  font-family: 'Space Mono', monospace;
  color: rgba(255, 255, 255, 0.9);
}

@keyframes scrollText{ 
  0%{ transform: translateX(100%); } 
  100%{ transform: translateX(-100%); } 
}

/* ---------- HEADER ---------- */
header{
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 20px 5%;
  border-bottom: 1px solid rgba(0, 0, 0, 0.08);
  background: var(--header-bg);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  position: sticky;
  top: 0;
  z-index: 1000;
  transition: all 0.3s var(--transition);
}

body.dark header {
  border-bottom: 1px solid rgba(255, 255, 255, 0.08);
}

.header-left { 
  display: flex; 
  align-items: center; 
  gap: 12px; 
  flex: 1;
}

.header-center { 
  display: flex; 
  justify-content: center; 
  flex: 1;
}

.header-right { 
  display: flex; 
  align-items: center; 
  gap: 12px; 
  flex: 1;
  justify-content: flex-end;
}

.logo-container {
  perspective: 1200px;
  width: 70px;
  height: 70px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: transform 0.3s var(--transition);
}

.logo-container:hover {
  transform: scale(1.05);
}

.logo-3d {
  width: 100%;
  height: auto;
  animation: rotate3D 15s linear infinite;
  transform-style: preserve-3d;
  filter: grayscale(100%) contrast(120%);
}

@keyframes rotate3D {
  0% { transform: rotateY(0deg); }
  100% { transform: rotateY(360deg); }
}

/* Search Bar */
#search {
    padding: 10px 15px;
    border: 1px solid var(--grey);
    border-radius: 8px;
    background: var(--bg);
    color: var(--text);
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    width: 200px;
    transition: all 0.3s var(--transition);
}

#search::placeholder {
    color: var(--grey);
    opacity: 0.7;
}

#search:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 2px rgba(255, 60, 0, 0.1);
    width: 250px;
}

body.dark #search {
    background: rgba(0, 0, 0, 0.3);
    border-color: rgba(255, 255, 255, 0.1);
    color: white;
}

body.dark #search::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

#theme-toggle {
    background: transparent;
    border: 1px solid var(--grey);
    border-radius: 50%;
    width: 40px;
    height: 40px;
    font-size: 18px;
    cursor: pointer;
    transition: all 0.3s var(--transition);
    color: var(--text);
    display: flex;
    align-items: center;
    justify-content: center;
}

#theme-toggle:hover { 
  transform: scale(1.1); 
  border-color: var(--accent);
  background: rgba(255, 60, 0, 0.1);
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

/* Hamburger Button */
.hamburger {
  display: flex;
  flex-direction: column;
  gap: 5px;
  cursor: pointer;
  z-index: 2000;
  padding: 10px;
  border-radius: 8px;
  transition: background 0.3s var(--transition);
}

.hamburger:hover {
  background: rgba(0, 0, 0, 0.05);
}

body.dark .hamburger:hover {
  background: rgba(255, 255, 255, 0.05);
}

.hamburger span {
  width: 24px;
  height: 2px;
  background-color: var(--text);
  transition: 0.3s var(--transition);
}

/* Mobile Menu Overlay */
.mobile-menu {
  position: fixed;
  top: 0;
  right: -100%;
  width: 100%;
  height: 100vh;
  background: var(--header-bg);
  backdrop-filter: blur(20px);
  -webkit-backdrop-filter: blur(20px);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 25px;
  transition: 0.5s var(--transition);
  z-index: 1500;
}

.mobile-menu.active { right: 0; }

.mobile-menu a {
  text-decoration: none;
  color: var(--text);
  font-size: 28px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 2px;
  transition: all 0.3s var(--transition);
  padding: 10px 20px;
  border-radius: 8px;
}

.mobile-menu a:hover {
  color: var(--accent);
  background: rgba(255, 60, 0, 0.1);
}

/* Hamburger Animation */
.hamburger.active span:nth-child(1) { 
  transform: rotate(45deg) translate(6px, 6px); 
}
.hamburger.active span:nth-child(2) { 
  opacity: 0; 
}
.hamburger.active span:nth-child(3) { 
  transform: rotate(-45deg) translate(6px, -6px); 
}

/* ---------- ABOUT HERO WITH VIDEO BACKGROUND ---------- */
.about-hero {
  height: 100vh;
  min-height: 800px;
  background: var(--black);
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  color: #fff;
  padding: 0 5%;
}

/* Video Background - FIXED */
.hero-video-background {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
  z-index: 1;
  filter: grayscale(100%) contrast(120%) brightness(0.4);
}

/* Video Overlay - Simplified */
.hero-video-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.6);
  z-index: 2;
}

/* Scanlines effect - optional, keeping it minimal */
.about-hero::after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(
    rgba(18, 16, 16, 0) 50%, 
    rgba(0, 0, 0, 0.25) 50%
  );
  background-size: 100% 4px;
  z-index: 3;
  pointer-events: none;
  opacity: 0.15;
}

.about-hero-content {
  position: relative;
  z-index: 10;
  text-align: center;
  max-width: 900px;
  padding: 40px;
}

.about-hero-content h1 {
  font-size: clamp(48px, 10vw, 96px);
  font-weight: 900;
  line-height: 0.9;
  text-transform: uppercase;
  letter-spacing: -3px;
  margin-bottom: 30px;
  background: linear-gradient(to right, #fff, #ccc);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
  background-clip: text;
  text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.about-hero-content p {
  font-size: 18px;
  line-height: 1.7;
  opacity: 0.9;
  max-width: 700px;
  margin: 0 auto 40px;
  font-weight: 400;
  letter-spacing: 0.3px;
  text-shadow: 0 1px 5px rgba(0, 0, 0, 0.5);
}

.hero-terminal {
  position: absolute;
  top: 40px;
  left: 40px;
  font-family: 'Space Mono', monospace;
  font-size: 11px;
  color: rgba(255, 255, 255, 0.7);
  z-index: 10;
  text-transform: uppercase;
  line-height: 1.8;
  letter-spacing: 1px;
  background: rgba(0, 0, 0, 0.3);
  padding: 15px;
  border-radius: 8px;
  backdrop-filter: blur(5px);
}

.hero-terminal span { 
  display: block; 
  transition: opacity 0.3s;
}

.hero-terminal span:hover {
  opacity: 1;
  color: var(--accent);
}

/* Video Controls */
.video-controls {
  position: absolute;
  bottom: 40px;
  right: 40px;
  z-index: 10;
  display: flex;
  gap: 10px;
}

.video-btn {
  background: rgba(0, 0, 0, 0.5);
  border: 1px solid rgba(255, 255, 255, 0.2);
  color: white;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s var(--transition);
  backdrop-filter: blur(5px);
}

.video-btn:hover {
  background: var(--accent);
  transform: scale(1.1);
}

/* ---------- MAIN CONTENT ---------- */
.main-content {
  width: 85%;
  max-width: 1200px;
  margin: 100px auto;
  position: relative;
  z-index: 2;
}

/* Vision & Mission Section */
.vision-mission {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 40px;
  margin-bottom: 100px;
}

.vision-card, .mission-card {
  background: var(--offwhite);
  border: 1px solid rgba(0, 0, 0, 0.1);
  padding: 50px;
  border-radius: 16px;
  position: relative;
  overflow: hidden;
  transition: transform 0.3s var(--transition), box-shadow 0.3s var(--transition);
  z-index: 1;
}

.vision-card:hover, .mission-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.vision-card::before, .mission-card::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: var(--accent);
  z-index: 1;
}

.vision-icon, .mission-icon {
  font-size: 48px;
  margin-bottom: 25px;
  display: inline-block;
  animation: float 3s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}

.vision-card h2, .mission-card h2 {
  font-size: 28px;
  font-weight: 800;
  margin-bottom: 20px;
  text-transform: uppercase;
  letter-spacing: 2px;
  position: relative;
  z-index: 1;
}

.vision-card p, .mission-card p {
  font-size: 16px;
  line-height: 1.8;
  opacity: 0.9;
  position: relative;
  z-index: 1;
}

/* Manifesto Section */
.manifesto-about {
  background: var(--offwhite);
  border: 1px solid rgba(0, 0, 0, 0.1);
  padding: 70px;
  margin-bottom: 100px;
  border-radius: 16px;
  transition: transform 0.3s var(--transition), box-shadow 0.3s var(--transition);
  z-index: 1;
}

.manifesto-about:hover {
  transform: translateY(-4px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.manifesto-about > * {
  position: relative;
  z-index: 1;
}

.manifesto-about h2 {
  font-size: 40px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 40px;
  letter-spacing: 3px;
  color: var(--black);
  position: relative;
  display: inline-block;
}

.manifesto-about h2::after {
  content: "";
  position: absolute;
  bottom: -10px;
  left: 0;
  width: 60px;
  height: 3px;
  background: var(--accent);
}

.manifesto-text {
  font-size: 18px;
  line-height: 1.9;
  font-weight: 400;
  margin-bottom: 50px;
  color: var(--text);
  opacity: 0.9;
}

.manifesto-highlight {
  font-size: 22px;
  font-weight: 700;
  line-height: 1.6;
  margin: 50px 0;
  padding: 30px;
  border-left: 4px solid var(--accent);
  background: linear-gradient(to right, rgba(255, 60, 0, 0.05), transparent);
  border-radius: 0 8px 8px 0;
  font-style: italic;
  color: var(--black);
  position: relative;
  z-index: 1;
}

.manifesto-image-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
  margin-top: 50px;
  position: relative;
  z-index: 1;
}

.manifesto-image {
  height: 300px;
  border-radius: 12px;
  overflow: hidden;
  position: relative;
}

.manifesto-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s var(--transition);
  filter: grayscale(100%) contrast(120%);
}

.manifesto-image:hover img {
  transform: scale(1.05);
  filter: grayscale(0%) contrast(100%);
}

.image-caption {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: rgba(0, 0, 0, 0.8);
  color: white;
  padding: 15px;
  font-size: 12px;
  text-transform: uppercase;
  letter-spacing: 1px;
  opacity: 0;
  transform: translateY(100%);
  transition: all 0.3s var(--transition);
}

.manifesto-image:hover .image-caption {
  opacity: 1;
  transform: translateY(0);
}

/* Founder Section */
.founder-section {
  margin: 100px 0;
  background: var(--offwhite);
  border-radius: 16px;
  overflow: hidden;
  border: 1px solid rgba(0, 0, 0, 0.1);
  z-index: 1;
}

.founder-content {
  display: grid;
  grid-template-columns: 300px 1fr;
  gap: 50px;
  padding: 50px;
  position: relative;
  z-index: 1;
}

.founder-image {
  position: relative;
  border-radius: 12px;
  overflow: hidden;
  height: 400px;
}

.founder-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: grayscale(100%) contrast(120%);
  transition: filter 0.3s var(--transition);
}

.founder-image:hover img {
  filter: grayscale(0%) contrast(100%);
}

.founder-info h2 {
  font-size: 32px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 20px;
  letter-spacing: 2px;
}

.founder-title {
  color: var(--accent);
  font-size: 14px;
  text-transform: uppercase;
  letter-spacing: 2px;
  margin-bottom: 20px;
  font-weight: 700;
}

.founder-quote {
  font-size: 20px;
  font-style: italic;
  line-height: 1.6;
  margin: 30px 0;
  padding-left: 20px;
  border-left: 3px solid var(--accent);
}

/* Timeline Section */
.timeline {
  margin: 100px 0;
  position: relative;
  z-index: 1;
}

.timeline h2 {
  font-size: 40px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 60px;
  text-align: center;
  color: var(--black);
}

.timeline-container {
  position: relative;
  max-width: 900px;
  margin: 0 auto;
  padding: 20px 0;
}

.timeline-container::before {
  content: '';
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  width: 2px;
  height: 100%;
  background: linear-gradient(to bottom, var(--accent), transparent);
  opacity: 0.3;
}

.timeline-item {
  position: relative;
  margin-bottom: 60px;
  width: calc(50% - 40px);
  padding: 30px;
  background: var(--offwhite);
  border-radius: 12px;
  border: 1px solid rgba(0, 0, 0, 0.1);
  transition: all 0.3s var(--transition);
  z-index: 1;
}

.timeline-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
  border-color: var(--accent);
}

.timeline-item:nth-child(odd) {
  left: 0;
  text-align: right;
}

.timeline-item:nth-child(even) {
  left: 50%;
  text-align: left;
}

.timeline-dot {
  position: absolute;
  width: 24px;
  height: 24px;
  background: var(--accent);
  border-radius: 50%;
  top: 40px;
  border: 4px solid var(--bg);
  box-shadow: 0 0 0 2px var(--accent);
  transition: all 0.3s var(--transition);
}

.timeline-item:nth-child(odd) .timeline-dot {
  right: -42px;
}

.timeline-item:nth-child(even) .timeline-dot {
  left: -42px;
}

.timeline-item:hover .timeline-dot {
  transform: scale(1.2);
  box-shadow: 0 0 0 4px var(--accent), 0 0 20px rgba(255, 60, 0, 0.3);
}

.timeline-year {
  font-size: 13px;
  font-weight: 700;
  color: var(--accent);
  margin-bottom: 10px;
  text-transform: uppercase;
  letter-spacing: 2px;
  font-family: 'Space Mono', monospace;
}

.timeline-title {
  font-size: 22px;
  font-weight: 700;
  margin-bottom: 15px;
  text-transform: uppercase;
  color: var(--black);
}

.timeline-desc {
  font-size: 15px;
  line-height: 1.7;
  opacity: 0.8;
}

.timeline-image {
  margin-top: 15px;
  border-radius: 8px;
  overflow: hidden;
  height: 200px;
}

.timeline-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s var(--transition);
  filter: grayscale(100%) contrast(120%);
}

.timeline-item:hover .timeline-image img {
  transform: scale(1.05);
  filter: grayscale(0%) contrast(100%);
}

/* Pillars Section */
.pillars-section {
  background: var(--offwhite);
  border: 1px solid rgba(0, 0, 0, 0.1);
  padding: 70px;
  margin: 100px 0;
  border-radius: 16px;
  z-index: 1;
}

.pillars-section > * {
  position: relative;
  z-index: 1;
}

.pillars-section h2 {
  font-size: 40px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 50px;
  text-align: center;
  color: var(--black);
}

.pillars-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 30px;
}

.pillar {
  background: var(--bg);
  border: 1px solid rgba(0, 0, 0, 0.1);
  padding: 40px 30px;
  border-radius: 12px;
  transition: all 0.3s var(--transition);
  position: relative;
  overflow: hidden;
  z-index: 1;
}

.pillar::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: var(--accent);
  transform: scaleX(0);
  transform-origin: left;
  transition: transform 0.3s var(--transition);
}

.pillar:hover {
  transform: translateY(-8px);
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
  border-color: var(--accent);
}

.pillar:hover::before {
  transform: scaleX(1);
}

.pillar-icon {
  font-size: 40px;
  margin-bottom: 25px;
  opacity: 0.9;
}

.pillar h3 {
  font-size: 20px;
  font-weight: 700;
  text-transform: uppercase;
  margin-bottom: 20px;
  letter-spacing: 1px;
  color: var(--black);
}

.pillar p {
  font-size: 15px;
  line-height: 1.7;
  opacity: 0.8;
}

/* Gallery Section */
.gallery-section {
  margin: 100px 0;
}

.gallery-section h2 {
  font-size: 40px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 50px;
  text-align: center;
  color: var(--black);
}

.gallery-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
}

.gallery-item {
  height: 400px;
  border-radius: 12px;
  overflow: hidden;
  position: relative;
  cursor: pointer;
  z-index: 1;
}

.gallery-item img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s var(--transition);
  filter: grayscale(100%) contrast(120%);
}

.gallery-item:hover img {
  transform: scale(1.05);
  filter: grayscale(0%) contrast(100%);
}

.gallery-overlay {
  position: absolute;
  bottom: 0;
  left: 0;
  right: 0;
  background: linear-gradient(to top, rgba(0, 0, 0, 0.8), transparent);
  color: white;
  padding: 30px 20px 20px;
  transform: translateY(100%);
  transition: transform 0.3s var(--transition);
}

.gallery-item:hover .gallery-overlay {
  transform: translateY(0);
}

.gallery-overlay h3 {
  font-size: 16px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 1px;
  margin-bottom: 5px;
}

.gallery-overlay p {
  font-size: 12px;
  opacity: 0.8;
}

/* Stats Section */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 30px;
  margin: 100px 0;
  padding: 60px;
  background: var(--offwhite);
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 16px;
  z-index: 1;
}

.stats-grid > * {
  position: relative;
  z-index: 1;
}

.stat-item {
  text-align: center;
  padding: 30px 20px;
  background: var(--bg);
  border-radius: 12px;
  border: 1px solid rgba(0, 0, 0, 0.1);
  transition: all 0.3s var(--transition);
}

.stat-item:hover {
  transform: translateY(-5px);
  border-color: var(--accent);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.stat-number {
  font-size: 56px;
  font-weight: 900;
  color: var(--accent);
  line-height: 1;
  margin-bottom: 15px;
  font-family: 'Space Mono', monospace;
}

.stat-label {
  font-size: 14px;
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 2px;
  color: var(--text);
  opacity: 0.8;
}

/* Scope of Work Section */
.scope-section {
  margin: 100px 0;
}

.scope-section h2 {
  font-size: 40px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 50px;
  text-align: center;
  color: var(--black);
}

.scope-content {
  background: var(--offwhite);
  border: 1px solid rgba(0, 0, 0, 0.1);
  padding: 60px;
  border-radius: 16px;
  position: relative;
  overflow: hidden;
  z-index: 1;
}

.scope-content > * {
  position: relative;
  z-index: 1;
}

.scope-tab {
  position: absolute;
  top: -20px;
  left: 40px;
  background: var(--accent);
  color: white;
  padding: 10px 25px;
  border-radius: 8px 8px 0 0;
  font-weight: 700;
  font-size: 13px;
  letter-spacing: 1px;
  text-transform: uppercase;
  font-family: 'Space Mono', monospace;
  z-index: 2;
}

.scope-list {
  list-style: none;
  padding: 0;
}

.scope-list li {
  margin-bottom: 25px;
  font-size: 17px;
  line-height: 1.8;
  position: relative;
  padding-left: 40px;
  opacity: 0.9;
}

.scope-list li::before {
  content: "→";
  position: absolute;
  left: 0;
  color: var(--accent);
  font-weight: 800;
  font-size: 20px;
  transition: transform 0.3s var(--transition);
}

.scope-list li:hover::before {
  transform: translateX(5px);
}

/* Newsletter */
.newsletter {
  width: 80%;
  max-width: 800px;
  margin: 100px auto;
  padding: 70px;
  background: var(--offwhite);
  text-align: center;
  border: 1px solid rgba(0, 0, 0, 0.1);
  border-radius: 16px;
  position: relative;
  overflow: hidden;
  z-index: 1;
}

.newsletter > * {
  position: relative;
  z-index: 1;
}

.newsletter h3 {
  font-size: 32px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 25px;
  color: var(--black);
}

.newsletter p {
  margin-bottom: 40px;
  font-size: 15px;
  opacity: 0.8;
  max-width: 500px;
  margin-left: auto;
  margin-right: auto;
}

.newsletter-form {
  display: flex;
  gap: 15px;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
}

.newsletter input {
  padding: 16px 25px;
  border: 1px solid rgba(0, 0, 0, 0.2);
  border-radius: 8px;
  width: 300px;
  background: var(--bg);
  color: var(--text);
  font-family: 'Inter', sans-serif;
  font-size: 15px;
  transition: all 0.3s var(--transition);
}

.newsletter input:focus {
  outline: none;
  border-color: var(--accent);
  box-shadow: 0 0 0 3px rgba(255, 60, 0, 0.1);
}

.newsletter .btn {
  margin: 0;
  background: var(--accent);
  color: white;
  border: none;
  padding: 16px 35px;
  font-weight: 700;
  transition: all 0.3s var(--transition);
}

.newsletter .btn:hover {
  background: var(--black);
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(255, 60, 0, 0.2);
}

/* Footer */
footer {
  background: var(--black);
  color: white;
  padding: 70px 5%;
  margin-top: 100px;
  text-align: center;
  font-size: 13px;
  text-transform: uppercase;
  letter-spacing: 1px;
  position: relative;
  overflow: hidden;
}

footer::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(to right, var(--accent), transparent);
}

footer p {
  margin: 15px 0;
  opacity: 0.9;
}

footer p:last-child {
  margin-top: 30px;
  font-size: 11px;
  opacity: 0.7;
  letter-spacing: 0.5px;
}

/* ---------- BUTTONS ---------- */
.btn {
  display: inline-block;
  padding: 16px 35px;
  border: 2px solid var(--black);
  border-radius: 8px;
  text-decoration: none;
  color: var(--black);
  font-weight: 700;
  font-size: 13px;
  letter-spacing: 1px;
  text-transform: uppercase;
  cursor: pointer;
  transition: all 0.3s var(--transition);
  position: relative;
  overflow: hidden;
  background: transparent;
}

.btn::before {
  content: "";
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: var(--black);
  transition: left 0.3s var(--transition);
  z-index: -1;
}

.btn:hover::before {
  left: 0;
}

.btn:hover {
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.btn-accent {
  background: var(--accent);
  border-color: var(--accent);
  color: #fff;
}

.btn-accent::before {
  background: var(--black);
}

.btn-accent:hover {
  background: transparent;
  color: var(--accent);
}

.btn-accent:hover::before {
  background: var(--accent);
}

/* ---------- UTILITY ---------- */
.text-center { text-align: center; }
.mt-40 { margin-top: 40px; }
.mb-40 { margin-bottom: 40px; }
.highlight { color: var(--accent); }

/* Back to Top Button */
#back-to-top {
  position: fixed;
  bottom: 40px;
  right: 40px;
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
  box-shadow: 0 8px 25px rgba(255, 60, 0, 0.3);
  transition: all 0.3s var(--transition);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
}

#back-to-top:hover {
  transform: translateY(-5px) scale(1.1);
  box-shadow: 0 12px 30px rgba(255, 60, 0, 0.4);
  background: var(--black);
}

/* Responsive */
@media (max-width: 1024px) {
  .main-content { width: 90%; }
  .manifesto-about, .pillars-section, .scope-content, .newsletter { padding: 50px; }
  
  .founder-content {
    grid-template-columns: 1fr;
    gap: 30px;
  }
  
  .founder-image {
    height: 300px;
  }
  
  .stats-grid { padding: 50px; }
}

@media (max-width: 768px) {
  .main-content { width: 95%; }
  .manifesto-about, .pillars-section, .scope-content, .newsletter { padding: 30px; }
  
  .timeline-container::before { left: 30px; }
  .timeline-item { 
    width: calc(100% - 80px); 
    left: 80px !important; 
    padding-left: 30px !important; 
    padding-right: 30px !important; 
    text-align: left !important; 
    margin-bottom: 40px;
  }
  
  .timeline-item:nth-child(odd) .timeline-dot, 
  .timeline-item:nth-child(even) .timeline-dot { 
    left: -40px; 
    top: 30px;
  }
  
  .pillars-grid { grid-template-columns: 1fr; }
  .stats-grid { 
    grid-template-columns: repeat(2, 1fr); 
    padding: 30px; 
    gap: 20px;
  }
  
  .gallery-grid {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  }
  
  .newsletter-form {
    flex-direction: column;
    align-items: stretch;
  }
  
  .newsletter input {
    width: 100%;
  }
  
  .about-hero-content h1 {
    font-size: clamp(36px, 12vw, 60px);
  }
  
  .manifesto-about h2,
  .timeline h2,
  .pillars-section h2,
  .scope-section h2 {
    font-size: 32px;
  }
  
  .video-controls {
    bottom: 20px;
    right: 20px;
  }
  
  .hero-terminal {
    top: 20px;
    left: 20px;
    padding: 10px;
  }
  
  /* Responsive header */
  header {
    flex-wrap: wrap;
  }
  
  .header-left, .header-center, .header-right {
    flex: none;
    width: 100%;
    justify-content: center;
    margin-bottom: 10px;
  }
  
  .header-left {
    order: 1;
  }
  
  .header-center {
    order: 2;
  }
  
  .header-right {
    order: 3;
    margin-bottom: 0;
  }
  
  #search {
    width: 100%;
    max-width: 300px;
  }
}

@media (max-width: 480px) {
  .stats-grid { grid-template-columns: 1fr; }
  
  .about-hero {
    height: 80vh;
    min-height: 500px;
    padding: 0 20px;
  }
  
  .about-hero-content {
    padding: 20px;
  }
  
  .hero-terminal {
    top: 15px;
    left: 15px;
    font-size: 10px;
  }
  
  .scope-tab {
    left: 20px;
    padding: 8px 15px;
    font-size: 11px;
  }
  
  .newsletter {
    padding: 40px 20px;
    width: 95%;
  }
  
  .gallery-item {
    height: 300px;
  }
  
  .vision-mission {
    grid-template-columns: 1fr;
  }
  
  .video-controls {
    display: none;
  }
  
  #search {
    max-width: 200px;
  }
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

<header>
  <div class="header-left">
    <!-- ADDED SEARCH BAR HERE -->
    <input type="text" id="search" placeholder="Search archives...">
    <button id="theme-toggle" aria-label="Toggle dark mode">🌑</button>
  </div>
  <div class="header-center">
    <div class="logo-container">
      <img src="images/NORMALLOGO.jpeg" class="logo-3d" alt="Streets Archives Logo">
    </div>
  </div>
  <div class="header-right">
    <div class="hamburger" id="hamburger" aria-label="Toggle menu">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <!-- FIXED CART LINK -->
    <div class="cart" onclick="window.location.href='cart.php'">CART (<?php echo $cartCount; ?>)</div>
  </div>
</header>

<div class="mobile-menu" id="mobileMenu">
  <a href="index.php">Home</a>
  <a href="#vision">Vision</a>
  <a href="#manifesto">Manifesto</a>
  <a href="#founder">Founder</a>
  <a href="#timeline">Timeline</a>
  <a href="#gallery">Gallery</a>
  <a href="#pillars">Pillars</a>
  <a href="#scope">Scope</a>
  <a href="cart.php">Cart (<?php echo $cartCount; ?>)</a>
</div>

<section class="about-hero">
  <!-- Video Background - SIMPLE PATH -->
  <video autoplay muted loop playsinline class="hero-video-background" id="heroVideo">
        <source src="images/about.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>
  
  <div class="hero-video-overlay"></div>
  
  <div class="hero-terminal">
    <span>ABOUT_ARCHIVE.EXE</span>
    <span>STATUS: ACTIVE</span>
    <span>ENCRYPTION: AES-256</span>
    <span>CULTURE OVER COMMODITY</span>
  </div>
  
  <div class="about-hero-content">
    <h1>STREETS<br>ARCHIVES</h1>
    <p>The fashion-forward division of Street Jewels Connections — a dynamic multimedia collective pushing the boundaries of creativity across music, fashion, film, media, and events.</p>
    <a href="#manifesto" class="btn btn-accent">Explore Our Story</a>
  </div>
</section>

<div class="main-content">
  <!-- Vision & Mission Section -->
  <section class="vision-mission" id="vision">
    <div class="vision-card">
      <div class="vision-icon"></div>
      <h2>OUR VISION</h2>
      <p>To become the definitive archive of street culture, preserving and amplifying authentic urban narratives through fashion, sound, and visual media for generations to come.</p>
    </div>
    
    <div class="mission-card">
      <div class="mission-icon"></div>
      <h2>OUR MISSION</h2>
      <p>To curate, document, and distribute the raw essence of street culture through sustainable fashion, underground media, and authentic storytelling that transcends trends.</p>
    </div>
  </section>

  <!-- Manifesto Section -->
  <section class="manifesto-about" id="manifesto">
    <h2>MANIFESTO</h2>
    <div class="manifesto-text">
      <p>Rooted in the vibrant streets and inspired by the raw energy of urban culture, Streets Archives curates and sells unique thrifted clothing that tells stories of individuality and expression.</p>
      
      <div class="manifesto-highlight">
        We believe in culture over commodity. We live by the code: LIVE FREE, DIE WITH MONEY. Every piece in our archive carries a story, a memory, a fragment of the streets that birthed it.
      </div>
      
      <p>Our mission is to preserve the authentic spirit of street culture through curated fashion, documented media, and archived sound. We're not just selling clothes — we're archiving moments, movements, and memories before they disappear into the digital ether.</p>
    </div>
    
    <!-- Image Grid -->
    <div class="manifesto-image-grid">
      <div class="manifesto-image">
        <img src="https://images.unsplash.com/photo-1496747611176-843222e1e57c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Street fashion collection">
        <div class="image-caption">VINTAGE CURATION</div>
      </div>
      <div class="manifesto-image">
        <img src="https://images.unsplash.com/photo-1514525253161-7a46d19cd819?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Recording session">
        <div class="image-caption">SOUND ARCHIVES</div>
      </div>
      <div class="manifesto-image">
        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Street photography">
        <div class="image-caption">VISUAL DOCUMENTATION</div>
      </div>
    </div>
  </section>

  <!-- Founder Section -->
  <section class="founder-section" id="founder">
    <div class="founder-content">
      <div class="founder-image">
        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Founder of Streets Archives">
      </div>
      <div class="founder-info">
        <h2>THE ARCHITECT</h2>
        <div class="founder-title">FOUNDER & CREATIVE DIRECTOR</div>
        <p>With a background in urban anthropology and a passion for authentic storytelling, our founder envisioned Streets Archives as a living museum of street culture. Starting from the pavements of Johannesburg to the underground scenes of Cape Town, the mission has always been clear: document the real before it's commercialized.</p>
        
        <div class="founder-quote">
          "We don't follow trends — we archive movements. Every piece we curate, every sound we capture, every moment we document is a timestamp of authentic street culture."
        </div>
        
        <p>Under this vision, Streets Archives has grown from a personal collection of vintage finds to a multimedia archive that collaborates with emerging artists, musicians, and designers across South Africa.</p>
      </div>
    </div>
  </section>

  <!-- Timeline Section -->
  <section class="timeline" id="timeline">
    <h2>OUR TIMELINE</h2>
    <div class="timeline-container">
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-year">2022</div>
        <div class="timeline-title">STREET JEWELS CONNECTIONS</div>
        <div class="timeline-desc">The multimedia collective is born, merging music, fashion, and visual media into a cohesive cultural force.</div>
        <div class="timeline-image">
          <img src="https://images.unsplash.com/photo-1516035069371-29a1b244cc32?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Early collective days">
        </div>
      </div>
      
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-year">2023</div>
        <div class="timeline-title">STREETS RADIO 3000</div>
        <div class="timeline-desc">Launch of the sonic platform amplifying underground sounds and emerging voices from South Africa's streets.</div>
        <div class="timeline-image">
          <img src="https://images.unsplash.com/photo-1511379938547-c1f69419868d?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Radio studio">
        </div>
      </div>
      
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-year">2024</div>
        <div class="timeline-title">FASHION DIVISION</div>
        <div class="timeline-desc">Streets Archives emerges as the fashion-forward arm, focusing on curated vintage and second-hand apparel.</div>
        <div class="timeline-image">
          <img src="https://images.unsplash.com/photo-1445205170230-053b83016050?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Fashion archive">
        </div>
      </div>
      
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-year">2025</div>
        <div class="timeline-title">MEDIA EXPANSION</div>
        <div class="timeline-desc">Expansion into digital media and content creation focusing on street culture documentation.</div>
        <div class="timeline-image">
          <img src="https://images.unsplash.com/photo-1551836026-d5c2a0e1b3c5?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Media production">
        </div>
      </div>
      
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-year">2026</div>
        <div class="timeline-title">ARCHIVE EXPANSION</div>
        <div class="timeline-desc">Official establishment of Streets Archives as a standalone brand within the collective.</div>
        <div class="timeline-image">
          <img src="https://images.unsplash.com/photo-1558769132-cb794e42fd54?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Expansion event">
        </div>
      </div>
    </div>
  </section>

  <!-- Pillars Section -->
  <section class="pillars-section" id="pillars">
    <h2>OUR PILLARS</h2>
    <div class="pillars-grid">
      <div class="pillar">
        <div class="pillar-icon">🧥</div>
        <h3>FASHION ARCHIVE</h3>
        <p>Curated vintage and second-hand garments pulled from real streets and private collections. Each piece carries time, movement, and memory.</p>
      </div>
      
      <div class="pillar">
        <div class="pillar-icon">🎥</div>
        <h3>VISUAL MEDIA</h3>
        <p>Cinematic documentation of street culture in motion. Editorials, short films, and visual records captured without performance or polish.</p>
      </div>
      
      <div class="pillar">
        <div class="pillar-icon">🎵</div>
        <h3>SOUND ARCHIVE</h3>
        <p>The sound of the underground, broadcast and preserved. Collaborations, live sessions, and cultural frequencies transmitted through Streets Radio 3000.</p>
      </div>
      
      <div class="pillar">
        <div class="pillar-icon">🌐</div>
        <h3>DIGITAL PRESENCE</h3>
        <p>Online platforms and digital archives that document and amplify street culture through web presence and social media.</p>
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  <section class="gallery-section" id="gallery">
    <h2>FROM THE ARCHIVE</h2>
    <div class="gallery-grid">
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1523381210434-271e8be1f52b?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Vintage denim collection">
        <div class="gallery-overlay">
          <h3>VINTAGE DENIM</h3>
          <p>90s era, hand-picked from Johannesburg markets</p>
        </div>
      </div>
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Recording studio session">
        <div class="gallery-overlay">
          <h3>STREETS RADIO 3000</h3>
          <p>Live session with emerging local artists</p>
        </div>
      </div>
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Street photography">
        <div class="gallery-overlay">
          <h3>URBAN DOCUMENTATION</h3>
          <p>Capturing authentic moments in Soweto</p>
        </div>
      </div>
      <div class="gallery-item">
        <img src="https://images.unsplash.com/photo-1545235617-9465d2a55698?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Fashion event">
        <div class="gallery-overlay">
          <h3>ARCHIVE POP-UP</h3>
          <p>Monthly curated vintage showcase in Cape Town</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="stats-grid">
    <div class="stat-item">
      <div class="stat-number">300+</div>
      <div class="stat-label">ARCHIVED PIECES</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">50+</div>
      <div class="stat-label">ARTIST COLLABS</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">12</div>
      <div class="stat-label">CITIES SCOUTED</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">∞</div>
      <div class="stat-label">CULTURAL IMPACT</div>
    </div>
  </section>

  <!-- Scope of Work Section -->
  <section class="scope-section" id="scope">
    <h2>SCOPE OF WORK</h2>
    <div class="scope-content">
      <div class="scope-tab">DIR_SCOPE.txt</div>
      <ul class="scope-list">
        <li>Currently, our primary focus is on fashion, delivering a curated selection of vintage and second-hand apparel that captures the essence of street style.</li>
        <li>Each piece in our collection is handpicked to reflect authenticity, attitude, and the ever-evolving spirit of the streets.</li>
        <li>Beyond fashion, Street Jewels Connections also powers Streets Radio 3000, a sonic platform that amplifies underground sounds and emerging voices.</li>
        <li>Creating a cultural synergy between style and sound that defines the contemporary African urban experience.</li>
        <li>We document the era before it disappears — preserving the raw, unfiltered energy of the streets through multiple creative disciplines.</li>
      </ul>
    </div>
  </section>

  <!-- Newsletter -->
  <section class="newsletter">
    <h3>Join the Archive</h3>
    <p>Receive new releases, broadcasts, and recovered pieces before they go public.</p>
    <div class="newsletter-form">
      <input type="email" placeholder="Enter your email">
      <button class="btn">Subscribe to Archive</button>
    </div>
  </section>
</div>

<footer>
  <p>STREETS ARCHIVES — SOUTH AFRICA</p>
  <p>FASHION • SOUND • VISUAL RECORDS</p>
  <p>EST. 2026</p>
  <p style="margin-top: 30px;">Privacy • Shipping • Returns • Contact</p>
  <p>A division of Street Jewels Connections</p>
</footer>

<button id="back-to-top" aria-label="Back to top">↑</button>

<script>
// Preloader
window.addEventListener('load', () => {
    const preloader = document.getElementById('preloader');
    preloader.style.opacity = '0';
    setTimeout(() => {
        preloader.style.display = 'none';
    }, 500);
});

// Toggle Mobile Menu
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');

function toggleMenu() {
  mobileMenu.classList.toggle('active');
  hamburger.classList.toggle('active');
  document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
}

if (hamburger) {
    hamburger.addEventListener('click', toggleMenu);
}

// Close mobile menu when clicking links
document.querySelectorAll('.mobile-menu a').forEach(link => {
    link.addEventListener('click', toggleMenu);
});

// Theme Toggle
const themeToggle = document.getElementById('theme-toggle');
if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        themeToggle.textContent = document.body.classList.contains('dark') ? '☀' : '🌑';
        themeToggle.setAttribute('aria-label', document.body.classList.contains('dark') ? 'Switch to light mode' : 'Switch to dark mode');
        
        // Save preference to localStorage
        localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
    });

    // Initialize theme
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark' || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches && !savedTheme)) {
        document.body.classList.add('dark');
        themeToggle.textContent = '☀';
        themeToggle.setAttribute('aria-label', 'Switch to light mode');
    }
}

// Back to Top Button
const backToTopBtn = document.getElementById('back-to-top');
window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        backToTopBtn.style.display = 'flex';
        backToTopBtn.style.alignItems = 'center';
        backToTopBtn.style.justifyContent = 'center';
    } else {
        backToTopBtn.style.display = 'none';
    }
});

if (backToTopBtn) {
    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// Search functionality
const searchInput = document.getElementById('search');
if (searchInput) {
    searchInput.addEventListener('input', function(e) {
        const query = e.target.value.toLowerCase();
        // Search logic - you can add specific search for About page
        console.log('Searching for:', query);
        
        // Example: Highlight matching text on page
        if (query.length > 2) {
            highlightSearch(query);
        } else {
            removeHighlight();
        }
    });
    
    // Add search on enter key
    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            performSearch(this.value);
        }
    });
}

function highlightSearch(query) {
    // Remove previous highlights
    removeHighlight();
    
    // Search in text content
    const walker = document.createTreeWalker(
        document.body,
        NodeFilter.SHOW_TEXT,
        null,
        false
    );
    
    let node;
    while (node = walker.nextNode()) {
        if (node.parentElement.tagName === 'SCRIPT' || 
            node.parentElement.tagName === 'STYLE' ||
            node.parentElement.classList.contains('no-search')) {
            continue;
        }
        
        const text = node.textContent;
        const regex = new RegExp(`(${query})`, 'gi');
        if (text.match(regex)) {
            const span = document.createElement('span');
            span.innerHTML = text.replace(regex, '<mark class="search-highlight">$1</mark>');
            span.classList.add('search-result');
            node.parentNode.replaceChild(span, node);
        }
    }
}

function removeHighlight() {
    document.querySelectorAll('.search-result').forEach(el => {
        const parent = el.parentNode;
        parent.replaceChild(document.createTextNode(el.textContent), el);
        parent.normalize();
    });
}

function performSearch(query) {
    if (query.trim() === '') return;
    
    // You can customize this search logic
    const searchableSections = [
        { id: 'vision', title: 'Vision & Mission' },
        { id: 'manifesto', title: 'Manifesto' },
        { id: 'founder', title: 'Founder' },
        { id: 'timeline', title: 'Timeline' },
        { id: 'pillars', title: 'Pillars' },
        { id: 'scope', title: 'Scope of Work' }
    ];
    
    // Simple search - scroll to first matching section
    for (const section of searchableSections) {
        const element = document.getElementById(section.id);
        if (element && element.textContent.toLowerCase().includes(query.toLowerCase())) {
            element.scrollIntoView({ behavior: 'smooth', block: 'start' });
            // Add visual feedback
            element.style.boxShadow = '0 0 0 3px var(--accent)';
            setTimeout(() => {
                element.style.boxShadow = '';
            }, 2000);
            return;
        }
    }
    
    // If no match found
    alert(`No results found for "${query}"`);
}

// Newsletter form submission
const newsletterInput = document.querySelector('.newsletter input');
const newsletterBtn = document.querySelector('.newsletter .btn');

if (newsletterBtn && newsletterInput) {
    newsletterBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (newsletterInput.value && newsletterInput.value.includes('@')) {
            newsletterInput.style.borderColor = 'var(--accent)';
            newsletterBtn.textContent = 'Subscribed ✓';
            newsletterBtn.style.background = 'var(--black)';
            setTimeout(() => {
                newsletterBtn.textContent = 'Subscribe to Archive';
                newsletterBtn.style.background = 'var(--accent)';
                newsletterInput.value = '';
                newsletterInput.style.borderColor = 'rgba(0, 0, 0, 0.2)';
            }, 2000);
        } else {
            newsletterInput.style.borderColor = '#ff3333';
            setTimeout(() => {
                newsletterInput.style.borderColor = 'rgba(0, 0, 0, 0.2)';
            }, 2000);
        }
    });

    // Add enter key support for newsletter
    newsletterInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            newsletterBtn.click();
        }
    });
}

// Intersection Observer for animations
const observerOptions = {
  threshold: 0.1,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('animated');
    }
  });
}, observerOptions);

// Observe elements for animation
document.querySelectorAll('.timeline-item, .pillar, .stat-item, .manifesto-about, .pillars-section, .scope-content, .gallery-item, .vision-card, .mission-card, .founder-section').forEach(el => {
    if (el) observer.observe(el);
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Header scroll effect
let lastScroll = 0;
window.addEventListener('scroll', () => {
    const currentScroll = window.pageYOffset;
    const header = document.querySelector('header');
    
    if (currentScroll > 100) {
        if (currentScroll > lastScroll && currentScroll > 200) {
            header.style.transform = 'translateY(-100%)';
        } else {
            header.style.transform = 'translateY(0)';
            header.style.backdropFilter = 'blur(20px)';
            header.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.1)';
        }
    } else {
        header.style.transform = 'translateY(0)';
        header.style.backdropFilter = 'blur(10px)';
        header.style.boxShadow = 'none';
    }
    
    lastScroll = currentScroll;
});

// Stats counter animation
const stats = document.querySelectorAll('.stat-number');
const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const stat = entry.target;
            const target = parseInt(stat.textContent);
            let count = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                count += increment;
                if (count >= target) {
                    count = target;
                    clearInterval(timer);
                }
                stat.textContent = Math.floor(count) + (stat.textContent.includes('+') ? '+' : '');
            }, 30);
            statsObserver.unobserve(stat);
        }
    });
}, { threshold: 0.5 });

stats.forEach(stat => {
    if (!stat.textContent.includes('∞')) {
        statsObserver.observe(stat);
    }
});

// Add search highlight style
const style = document.createElement('style');
style.textContent = `
    .search-highlight {
        background-color: rgba(255, 60, 0, 0.3);
        padding: 2px 4px;
        border-radius: 2px;
        font-weight: 600;
    }
`;
document.head.appendChild(style);
</script>

</body>
</html>