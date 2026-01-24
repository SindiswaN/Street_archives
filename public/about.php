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
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
#search::placeholder { color: var(--black); }

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


/* Hamburger Menu */
.hamburger {
  display: flex;
  flex-direction: column;
  gap: 6px;
  cursor: pointer;
  z-index: 2000;
  width: 25px;
  height: 20px;
  justify-content: space-between;
}

.hamburger span {
  width: 100%;
  height: 2px;
  background-color: var(--text);
  transition: all 0.3s var(--transition);
  transform-origin: left;
}

.hamburger.active span:nth-child(1) {
  transform: rotate(45deg) translateY(-2px);
}

.hamburger.active span:nth-child(2) {
  opacity: 0;
}

.hamburger.active span:nth-child(3) {
  transform: rotate(-45deg) translateY(2px);
}

/* Mobile Menu Overlay */
.mobile-menu {
  position: fixed;
  top: 0;
  right: -100%;
  width: 100%;
  height: 100vh;
  background: var(--bg);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 25px;
  transition: 0.5s cubic-bezier(0.22, 1, 0.36, 1);
  z-index: 1500;
  padding: 20px;
}

.mobile-menu.active { 
  right: 0; 
}

.mobile-menu a {
  text-decoration: none;
  color: var(--text);
  font-size: 22px;
  font-weight: 700;
  text-transform: uppercase;
  padding: 12px 0;
  width: 100%;
  text-align: center;
  border-bottom: 1px solid rgba(0,0,0,0.1);
  transition: all 0.3s ease;
}

.mobile-menu a:hover {
  color: var(--accent);
  transform: translateX(-10px);
}

body.dark .mobile-menu a {
  border-bottom: 1px solid rgba(255,255,255,0.1);
}

/* ---------- ABOUT HERO ---------- */
.about-hero {
  height: 90vh;
  min-height: 700px;
  background: var(--black);
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  color: #fff;
  padding: 0 5%;
}

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

.hero-video-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(45deg, rgba(0,0,0,0.8), rgba(0,0,0,0.4));
  z-index: 2;
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
  border: 1px solid rgba(255,255,255,0.1);
}

.hero-terminal span { 
  display: block; 
  transition: opacity 0.3s;
}

.hero-terminal span:hover {
  opacity: 1;
  color: var(--accent);
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
  color: var(--accent);
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

/* Pillars Section */
.pillars-section {
  background: var(--offwhite);
  border: 1px solid rgba(0, 0, 0, 0.1);
  padding: 70px;
  margin: 100px 0;
  border-radius: 16px;
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
  text-align: center;
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
  color: var(--accent);
  display: block;
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
  min-height: 44px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
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
  box-shadow: 0 8px 25px rgba(255, 60, 0, 0.3);
  transition: all 0.3s var(--transition);
  align-items: center;
  justify-content: center;
}

#back-to-top:hover {
  transform: translateY(-5px) scale(1.1);
  box-shadow: 0 12px 30px rgba(255, 60, 0, 0.4);
  background: var(--black);
}

/* ============================================
   MOBILE RESPONSIVE STYLES
   ============================================ */

@media (max-width: 1024px) {
  /* Tablet adjustments */
  .main-content { width: 90%; }
  .manifesto-about, .pillars-section, .scope-content, .newsletter { padding: 50px; }
  
  .founder-content {
    grid-template-columns: 1fr;
    gap: 30px;
  }
  
  .founder-image {
    height: 300px;
    max-width: 400px;
    margin: 0 auto;
  }
  
  .stats-grid { padding: 50px; }
  
  .gallery-grid {
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  }
}

@media (max-width: 768px) {
  /* Mobile adjustments */
  .main-content { width: 95%; }
  .manifesto-about, .pillars-section, .scope-content, .newsletter { padding: 30px; }
  
  /* Timeline Mobile Fix */
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
    grid-template-columns: 1fr;
  }
  
  .gallery-item {
    height: 350px;
  }
  
  .newsletter-form {
    flex-direction: column;
    align-items: stretch;
  }
  
  .newsletter input {
    width: 100%;
  }
  
  /* Hero Section Mobile */
  .about-hero {
    height: 80vh;
    min-height: 500px;
    padding: 0 20px;
  }
  
  .about-hero-content {
    padding: 20px;
  }
  
  .about-hero-content h1 {
    font-size: clamp(36px, 12vw, 60px);
  }
  
  .about-hero-content p {
    font-size: 16px;
  }
  
  .hero-terminal {
    top: 20px;
    left: 20px;
    padding: 10px;
    font-size: 10px;
  }
  
  /* Typography Mobile */
  .manifesto-about h2,
  .timeline h2,
  .pillars-section h2,
  .scope-section h2,
  .newsletter h3 {
    font-size: 32px;
  }
  
  .vision-card h2, 
  .mission-card h2 {
    font-size: 24px;
  }
  
  .founder-info h2 {
    font-size: 28px;
  }
  
  /* Cards and Sections Mobile */
  .vision-mission {
    grid-template-columns: 1fr;
    gap: 30px;
  }
  
  .vision-card, 
  .mission-card,
  .founder-section {
    padding: 30px;
  }
  
  .scope-tab {
    left: 20px;
    padding: 8px 15px;
    font-size: 11px;
  }
  
  /* Back to Top Button Mobile */
  #back-to-top {
    bottom: 20px;
    right: 20px;
    width: 45px;
    height: 45px;
    font-size: 18px;
  }
  
  /* Header Mobile */
  header {
    padding: 12px 4%;
    flex-wrap: wrap;
  }
  
  .logo-container {
    width: 60px;
    height: 60px;
  }
  
  /* Mobile Menu Fix */
  .mobile-menu a {
    font-size: 20px;
    padding: 15px 0;
  }
  
  /* Stats Mobile */
  .stat-number {
    font-size: 48px;
  }
  
  .stat-label {
    font-size: 12px;
  }
}

@media (max-width: 480px) {
  /* Small mobile adjustments */
  .stats-grid { 
    grid-template-columns: 1fr; 
    padding: 25px;
    gap: 15px;
  }
  
  .about-hero {
    height: 70vh;
    min-height: 400px;
  }
  
  .about-hero-content h1 {
    font-size: 32px;
    letter-spacing: -1px;
  }
  
  .about-hero-content p {
    font-size: 14px;
  }
  
  .hero-terminal {
    display: none; /* Hide terminal on very small screens */
  }
  
  .scope-content,
  .pillars-section,
  .manifesto-about {
    padding: 25px;
  }
  
  .newsletter {
    padding: 40px 20px;
    width: 95%;
  }
  
  .manifesto-highlight {
    font-size: 18px;
    padding: 20px;
    margin: 30px 0;
  }
  
  .founder-quote {
    font-size: 18px;
  }
  
  .gallery-item {
    height: 300px;
  }
  
  /* Button Mobile */
  .btn {
    padding: 14px 25px;
    font-size: 12px;
  }
  
  /* Typography Mobile Small */
  .manifesto-about h2,
  .timeline h2,
  .pillars-section h2,
  .scope-section h2,
  .newsletter h3 {
    font-size: 28px;
  }
  
  .vision-icon, 
  .mission-icon,
  .pillar-icon {
    font-size: 36px;
  }
  
  /* Footer Mobile */
  footer {
    padding: 50px 5%;
    font-size: 11px;
  }
}

@media (max-width: 360px) {
  /* Extra small devices */
  .about-hero-content h1 {
    font-size: 28px;
  }
  
  .about-hero-content p {
    font-size: 13px;
  }
  
  .btn {
    padding: 12px 20px;
    font-size: 11px;
  }
  
  .newsletter input {
    padding: 14px 20px;
  }
  
  .gallery-item {
    height: 250px;
  }
}

/* Mobile landscape orientation */
@media (max-height: 600px) and (orientation: landscape) {
  .about-hero {
    height: 100vh;
    min-height: auto;
  }
  
  .mobile-menu {
    overflow-y: auto;
    padding: 20px 0;
  }
  
  .mobile-menu a {
    font-size: 18px;
    padding: 10px 0;
  }
  
  .about-hero-content h1 {
    font-size: 42px;
  }
}

/* Prevent horizontal scroll on mobile */
html, body {
  max-width: 100%;
  overflow-x: hidden;
}

/* Improve touch targets */
button,
.btn,
.pillar,
.gallery-item,
.timeline-item,
.stat-item {
  min-height: 44px;
}

/* Ensure buttons are properly clickable on mobile */
button, 
.btn {
  cursor: pointer;
  -webkit-tap-highlight-color: transparent;
}

/* Adjust input font size for mobile to prevent zoom */
@media (max-width: 768px) {
  input[type="email"],
  input[type="text"],
  textarea {
    font-size: 16px !important;
  }
}

/* Smooth transitions for mobile performance */
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }
}

/* Loading state for images */
img {
  max-width: 100%;
  height: auto;
  display: block;
}

/* Video Controls for Mobile */
.video-controls {
  display: none; /* Hide on mobile for cleaner interface */
}

/* Manifesto Image Grid Mobile */
.manifesto-image-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 15px;
  margin-top: 30px;
}

.manifesto-image {
  height: 250px;
}

/* Dark mode adjustments */
body.dark .vision-card,
body.dark .mission-card,
body.dark .manifesto-about,
body.dark .pillars-section,
body.dark .scope-content,
body.dark .newsletter,
body.dark .founder-section,
body.dark .timeline-item,
body.dark .pillar,
body.dark .stat-item {
  background: var(--offwhite);
  border-color: rgba(255, 255, 255, 0.1);
}

body.dark .mobile-menu {
  background: var(--bg);
}

body.dark .newsletter input {
  background: rgba(255, 255, 255, 0.05);
  border-color: rgba(255, 255, 255, 0.2);
  color: white;
}

body.dark .newsletter input::placeholder {
  color: rgba(255, 255, 255, 0.5);
}

/* Animation for scroll reveal */
.fade-in {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.6s var(--transition), transform 0.6s var(--transition);
}

.fade-in.visible {
  opacity: 1;
  transform: translateY(0);
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

<?php require_once(__DIR__ . '/../includes/header.php'); ?>

<div class="mobile-menu" id="mobileMenu">
  <a href="index.php">Home</a>
  <a href="#vision">Vision</a>
  <a href="#manifesto">Manifesto</a>
  <a href="#founder">Founder</a>
  <a href="#timeline">Timeline</a>
  <a href="#pillars">Pillars</a>
  <a href="#scope">Scope</a>
  <a href="cart.php">Cart (<?php echo $cartCount; ?>)</a>
</div>

<section class="about-hero">
  <video autoplay muted loop playsinline class="hero-video-background" id="heroVideo">
    <source src="images/about.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>
  
  <div class="hero-video-overlay"></div>
  
  <div class="hero-terminal">
    <span><i class="bi bi-file-earmark-text"></i> ABOUT_ARCHIVE.EXE</span>
    <span><i class="bi bi-check-circle"></i> STATUS: ACTIVE</span>
    <span><i class="bi bi-shield-lock"></i> ENCRYPTION: AES-256</span>
    <span><i class="bi bi-heart-fill"></i> CULTURE OVER COMMODITY</span>
  </div>
  
  <div class="about-hero-content">
    <h1>STREETS<br>ARCHIVES</h1>
    <p>The fashion-forward division of Street Jewels Connections — a dynamic multimedia collective pushing the boundaries of creativity across music, fashion, film, media, and events.</p>
    <a href="#manifesto" class="btn btn-accent">Explore Our Story <i class="bi bi-arrow-down"></i></a>
  </div>
</section>

<div class="main-content">
  <!-- Vision & Mission Section -->
  <section class="vision-mission fade-in" id="vision">
    <div class="vision-card">
      <div class="vision-icon"><i class="bi bi-eye"></i></div>
      <h2>OUR VISION</h2>
      <p>To become the definitive archive of street culture, preserving and amplifying authentic urban narratives through fashion, sound, and visual media for generations to come.</p>
    </div>
    
    <div class="mission-card">
      <div class="mission-icon"><i class="bi bi-bullseye"></i></div>
      <h2>OUR MISSION</h2>
      <p>To curate, document, and distribute the raw essence of street culture through sustainable fashion, underground media, and authentic storytelling that transcends trends.</p>
    </div>
  </section>

  <!-- Manifesto Section -->
  <section class="manifesto-about fade-in" id="manifesto">
    <h2>MANIFESTO</h2>
    <div class="manifesto-text">
      <p>Rooted in the vibrant streets and inspired by the raw energy of urban culture, Streets Archives curates and sells unique thrifted clothing that tells stories of individuality and expression.</p>
      
      <div class="manifesto-highlight">
        <i class="bi bi-quote"></i> We believe in culture over commodity. We live by the code: LIVE FREE, DIE WITH MONEY. Every piece in our archive carries a story, a memory, a fragment of the streets that birthed it.
      </div>
      
      <p>Our mission is to preserve the authentic spirit of street culture through curated fashion, documented media, and archived sound. We're not just selling clothes — we're archiving moments, movements, and memories before they disappear into the digital ether.</p>
    </div>
  </section>

  <!-- Founder Section -->
  <section class="founder-section fade-in" id="founder">
    <div class="founder-content">
      <div class="founder-image">
        <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Founder of Streets Archives">
      </div>
      <div class="founder-info">
        <h2><i class="bi bi-person-badge"></i> THE ARCHITECT</h2>
        <div class="founder-title">FOUNDER & CREATIVE DIRECTOR</div>
        <p>With a background in urban anthropology and a passion for authentic storytelling, our founder envisioned Streets Archives as a living museum of street culture. Starting from the pavements of Johannesburg to the underground scenes of Cape Town, the mission has always been clear: document the real before it's commercialized.</p>
        
        <div class="founder-quote">
          <i class="bi bi-chat-quote"></i> "We don't follow trends — we archive movements. Every piece we curate, every sound we capture, every moment we document is a timestamp of authentic street culture."
        </div>
        
        <p>Under this vision, Streets Archives has grown from a personal collection of vintage finds to a multimedia archive that collaborates with emerging artists, musicians, and designers across South Africa.</p>
      </div>
    </div>
  </section>

  <!-- Timeline Section -->
  <section class="timeline fade-in" id="timeline">
    <h2><i class="bi bi-clock-history"></i> OUR TIMELINE</h2>
    <div class="timeline-container">
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-year">2022</div>
        <div class="timeline-title">STREET JEWELS CONNECTIONS</div>
        <div class="timeline-desc">The multimedia collective is born, merging music, fashion, and visual media into a cohesive cultural force.</div>
      </div>
      
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-year">2023</div>
        <div class="timeline-title">STREETS RADIO 3000</div>
        <div class="timeline-desc">Launch of the sonic platform amplifying underground sounds and emerging voices from South Africa's streets.</div>
      </div>
      
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-year">2024</div>
        <div class="timeline-title">FASHION DIVISION</div>
        <div class="timeline-desc">Streets Archives emerges as the fashion-forward arm, focusing on curated vintage and second-hand apparel.</div>
      </div>
      
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-year">2025</div>
        <div class="timeline-title">MEDIA EXPANSION</div>
        <div class="timeline-desc">Expansion into digital media and content creation focusing on street culture documentation.</div>
      </div>
      
      <div class="timeline-item">
        <div class="timeline-dot"></div>
        <div class="timeline-year">2026</div>
        <div class="timeline-title">ARCHIVE EXPANSION</div>
        <div class="timeline-desc">Official establishment of Streets Archives as a standalone brand within the collective.</div>
      </div>
    </div>
  </section>

  <!-- Pillars Section -->
  <section class="pillars-section fade-in" id="pillars">
    <h2><i class="bi bi-columns-gap"></i> OUR PILLARS</h2>
    <div class="pillars-grid">
      <div class="pillar">
        <div class="pillar-icon"><i class="bi bi-tshirt"></i></div>
        <h3>FASHION ARCHIVE</h3>
        <p>Curated vintage and second-hand garments pulled from real streets and private collections. Each piece carries time, movement, and memory.</p>
      </div>
      
      <div class="pillar">
        <div class="pillar-icon"><i class="bi bi-camera-video"></i></div>
        <h3>VISUAL MEDIA</h3>
        <p>Cinematic documentation of street culture in motion. Editorials, short films, and visual records captured without performance or polish.</p>
      </div>
      
      <div class="pillar">
        <div class="pillar-icon"><i class="bi bi-music-note-beamed"></i></div>
        <h3>SOUND ARCHIVE</h3>
        <p>The sound of the underground, broadcast and preserved. Collaborations, live sessions, and cultural frequencies transmitted through Streets Radio 3000.</p>
      </div>
      
      <div class="pillar">
        <div class="pillar-icon"><i class="bi bi-globe"></i></div>
        <h3>DIGITAL PRESENCE</h3>
        <p>Online platforms and digital archives that document and amplify street culture through web presence and social media.</p>
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  <section class="gallery-section fade-in" id="gallery">
    <h2><i class="bi bi-images"></i> FROM THE ARCHIVE</h2>
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
        <img src="https://images.unsplash.com/photo-1545235617-9465d2a55698?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Fashion event">
        <div class="gallery-overlay">
          <h3>ARCHIVE POP-UP</h3>
          <p>Monthly curated vintage showcase in Cape Town</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Stats Section -->
  <section class="stats-grid fade-in">
    <div class="stat-item">
      <div class="stat-number">300+</div>
      <div class="stat-label"><i class="bi bi-archive"></i> ARCHIVED PIECES</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">50+</div>
      <div class="stat-label"><i class="bi bi-people"></i> ARTIST COLLABS</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">12</div>
      <div class="stat-label"><i class="bi bi-geo-alt"></i> CITIES SCOUTED</div>
    </div>
    <div class="stat-item">
      <div class="stat-number">∞</div>
      <div class="stat-label"><i class="bi bi-heart"></i> CULTURAL IMPACT</div>
    </div>
  </section>

  <!-- Scope of Work Section -->
  <section class="scope-section fade-in" id="scope">
    <h2><i class="bi bi-briefcase"></i> SCOPE OF WORK</h2>
    <div class="scope-content">
      <div class="scope-tab"><i class="bi bi-file-text"></i> DIR_SCOPE.txt</div>
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
  <section class="newsletter fade-in">
    <h3><i class="bi bi-envelope"></i> Join the Archive</h3>
    <p>Receive new releases, broadcasts, and recovered pieces before they go public.</p>
    <div class="newsletter-form">
      <input type="email" placeholder="Enter your email">
      <button class="btn btn-accent">Subscribe to Archive <i class="bi bi-arrow-right"></i></button>
    </div>
  </section>
</div>

<footer>
  <p><i class="bi bi-geo-alt"></i> STREETS ARCHIVES — SOUTH AFRICA</p>
  <p><i class="bi bi-collection"></i> FASHION • SOUND • VISUAL RECORDS</p>
  <p><i class="bi bi-calendar"></i> EST. 2026</p>
  <p style="margin-top: 30px;"><i class="bi bi-shield-check"></i> Privacy • Shipping • Returns • Contact</p>
  <p>A division of Street Jewels Connections</p>
</footer>

<button id="back-to-top" aria-label="Back to top"><i class="bi bi-chevron-up"></i></button>

<script>
// Preloader
window.addEventListener('load', () => {
    const preloader = document.getElementById('preloader');
    preloader.style.transition = 'opacity 0.5s ease';
    preloader.style.opacity = '0';
    setTimeout(() => {
        preloader.style.display = 'none';
    }, 500);
    
    // Initialize animations
    initScrollAnimations();
});

// Toggle Mobile Menu
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');

function toggleMenu() {
    if (!hamburger || !mobileMenu) return;
    
    hamburger.classList.toggle('active');
    mobileMenu.classList.toggle('active');
    document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
}

if (hamburger) {
    hamburger.addEventListener('click', toggleMenu);
    hamburger.addEventListener('touchstart', toggleMenu);
}

// Close mobile menu when clicking links
document.querySelectorAll('.mobile-menu a').forEach(link => {
    link.addEventListener('click', toggleMenu);
});

// Close menu when clicking outside
document.addEventListener('click', (e) => {
    if (mobileMenu && mobileMenu.classList.contains('active') && 
        !mobileMenu.contains(e.target) && 
        hamburger && !hamburger.contains(e.target)) {
        toggleMenu();
    }
});

// Theme Toggle
const themeToggle = document.getElementById('theme-toggle');
if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        const icon = themeToggle.querySelector('i');
        if (document.body.classList.contains('dark')) {
            icon.className = 'bi bi-sun';
            themeToggle.setAttribute('aria-label', 'Switch to light mode');
        } else {
            icon.className = 'bi bi-moon';
            themeToggle.setAttribute('aria-label', 'Switch to dark mode');
        }
        
        // Save preference to localStorage
        localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
    });

    // Initialize theme
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark' || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches && !savedTheme)) {
        document.body.classList.add('dark');
        const icon = themeToggle.querySelector('i');
        if (icon) icon.className = 'bi bi-sun';
        themeToggle.setAttribute('aria-label', 'Switch to light mode');
    }
}

// Back to Top Button
const backToTopBtn = document.getElementById('back-to-top');
window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        backToTopBtn.style.display = 'flex';
    } else {
        backToTopBtn.style.display = 'none';
    }
});

if (backToTopBtn) {
    backToTopBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
    backToTopBtn.addEventListener('touchstart', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
}

// Scroll Animations
function initScrollAnimations() {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    document.querySelectorAll('.fade-in').forEach(el => {
        observer.observe(el);
    });
}

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const target = document.querySelector(targetId);
        if (target) {
            // Close mobile menu if open
            if (mobileMenu && mobileMenu.classList.contains('active')) {
                toggleMenu();
            }
            
            // Smooth scroll to target
            window.scrollTo({
                top: target.offsetTop - 80,
                behavior: 'smooth'
            });
        }
    });
});

// Newsletter form submission
const newsletterInput = document.querySelector('.newsletter input');
const newsletterBtn = document.querySelector('.newsletter .btn');

if (newsletterBtn && newsletterInput) {
    newsletterBtn.addEventListener('click', (e) => {
        e.preventDefault();
        if (newsletterInput.value && newsletterInput.value.includes('@')) {
            newsletterInput.style.borderColor = 'var(--accent)';
            const originalText = newsletterBtn.innerHTML;
            newsletterBtn.innerHTML = '<i class="bi bi-check"></i> Subscribed!';
            newsletterBtn.style.background = 'var(--black)';
            
            setTimeout(() => {
                newsletterBtn.innerHTML = originalText;
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

// Header scroll effect
let lastScroll = 0;
const header = document.querySelector('header');

if (header) {
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 100) {
            header.style.backdropFilter = 'blur(20px)';
            header.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.1)';
            
            if (currentScroll > lastScroll && currentScroll > 200) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }
        } else {
            header.style.transform = 'translateY(0)';
            header.style.backdropFilter = 'blur(10px)';
            header.style.boxShadow = 'none';
        }
        
        lastScroll = currentScroll;
    });
}

// Stats counter animation
const stats = document.querySelectorAll('.stat-number');
const statsObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const stat = entry.target;
            if (stat.textContent.includes('∞')) return;
            
            const target = parseInt(stat.textContent);
            let count = 0;
            const increment = target / 30;
            const timer = setInterval(() => {
                count += increment;
                if (count >= target) {
                    count = target;
                    clearInterval(timer);
                }
                stat.textContent = Math.floor(count) + (stat.textContent.includes('+') ? '+' : '');
            }, 50);
            statsObserver.unobserve(stat);
        }
    });
}, { threshold: 0.5 });

stats.forEach(stat => {
    statsObserver.observe(stat);
});

// Video autoplay for mobile
const heroVideo = document.getElementById('heroVideo');
if (heroVideo) {
    // Ensure video plays on mobile
    heroVideo.addEventListener('loadedmetadata', () => {
        heroVideo.muted = true;
        heroVideo.play().catch(e => {
            console.log("Video autoplay prevented:", e);
        });
    });
}

// Touch-friendly improvements
document.addEventListener('touchstart', () => {}, { passive: true });

// Prevent zoom on double-tap
let lastTouchEnd = 0;
document.addEventListener('touchend', (e) => {
    const now = Date.now();
    if (now - lastTouchEnd <= 300) {
        e.preventDefault();
    }
    lastTouchEnd = now;
}, { passive: false });
</script>

</body>
</html>