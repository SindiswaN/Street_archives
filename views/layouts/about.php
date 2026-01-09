<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Streets Archives — About</title>

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
body.dark .about-hero { background: #000; }
body.dark .timeline-item { border-color: #444; }
body.dark .pillars-section { background: #222; }
body.dark .stats-grid { background: #222; }

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

/* ---------- ABOUT HERO ---------- */
.about-hero {
  height: 60vh;
  background: #111;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  color: #fff;
  padding: 0 5%;
}

.hero-background {
  position: absolute;
  top: 0; left: 0; width: 100%; height: 100%;
  opacity: 0.2;
  background: url('images/banner2.jpeg') center/cover no-repeat;
  filter: grayscale(100%) contrast(1.2);
}

.about-hero::before {
  content: " ";
  position: absolute;
  top: 0; left: 0; width: 100%; height: 100%;
  background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.15) 50%),
              linear-gradient(90deg, rgba(255, 0, 0, 0.03), rgba(0, 255, 0, 0.01), rgba(0, 0, 255, 0.03));
  background-size: 100% 4px, 3px 100%;
  z-index: 2;
  pointer-events: none;
}

.hero-terminal {
  position: absolute;
  top: 30px;
  left: 30px;
  font-family: monospace;
  font-size: 10px;
  color: #fff;
  z-index: 3;
  text-transform: uppercase;
  line-height: 1.6;
  opacity: 0.6;
}
.hero-terminal span { display: block; }

.about-hero-content {
  position: relative;
  z-index: 10;
  text-align: center;
  max-width: 800px;
}

.about-hero-content h1 {
  font-size: clamp(40px, 8vw, 80px);
  font-weight: 800;
  line-height: 0.9;
  text-transform: uppercase;
  letter-spacing: -2px;
  margin-bottom: 20px;
}

.about-hero-content p {
  font-size: 14px;
  line-height: 1.6;
  opacity: 0.8;
  max-width: 600px;
  margin: 0 auto;
}

/* ---------- MAIN CONTENT ---------- */
.main-content {
  width: 85%;
  max-width: 1200px;
  margin: 80px auto;
}

/* Manifesto Section */
.manifesto-about {
  background: var(--offwhite);
  border: 2px solid var(--black);
  padding: 60px;
  margin-bottom: 80px;
  box-shadow: 12px 12px 0px var(--black);
  position: relative;
}

.manifesto-about h2 {
  font-size: 32px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 30px;
  letter-spacing: 2px;
}

.manifesto-text {
  font-size: 18px;
  line-height: 1.8;
  font-weight: 400;
  margin-bottom: 40px;
}

.manifesto-highlight {
  font-size: 22px;
  font-weight: 800;
  line-height: 1.4;
  text-transform: uppercase;
  margin: 40px 0;
  padding: 20px;
  border-left: 4px solid var(--accent);
  background: rgba(255, 60, 0, 0.05);
}

/* Timeline Section */
.timeline {
  margin: 80px 0;
}

.timeline h2 {
  font-size: 32px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 50px;
  text-align: center;
}

.timeline-container {
  position: relative;
  max-width: 800px;
  margin: 0 auto;
}

.timeline-container::before {
  content: '';
  position: absolute;
  left: 50%;
  transform: translateX(-50%);
  width: 2px;
  height: 100%;
  background: var(--accent);
}

.timeline-item {
  position: relative;
  margin-bottom: 50px;
  width: calc(50% - 30px);
}

.timeline-item:nth-child(odd) {
  left: 0;
  text-align: right;
  padding-right: 60px;
}

.timeline-item:nth-child(even) {
  left: 50%;
  padding-left: 60px;
}

.timeline-dot {
  position: absolute;
  width: 20px;
  height: 20px;
  background: var(--accent);
  border-radius: 50%;
  top: 10px;
}

.timeline-item:nth-child(odd) .timeline-dot {
  right: -10px;
}

.timeline-item:nth-child(even) .timeline-dot {
  left: -10px;
}

.timeline-year {
  font-size: 14px;
  font-weight: 800;
  color: var(--accent);
  margin-bottom: 10px;
  text-transform: uppercase;
  letter-spacing: 2px;
}

.timeline-title {
  font-size: 20px;
  font-weight: 800;
  margin-bottom: 10px;
  text-transform: uppercase;
}

.timeline-desc {
  font-size: 14px;
  line-height: 1.6;
  opacity: 0.8;
}

/* Pillars Section */
.pillars-section {
  background: var(--offwhite);
  border: 2px solid var(--black);
  padding: 60px;
  margin: 80px 0;
  box-shadow: 12px 12px 0px var(--black);
}

.pillars-section h2 {
  font-size: 32px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 40px;
  text-align: center;
}

.pillars-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 30px;
}

.pillar {
  background: var(--bg);
  border: 1px solid var(--black);
  padding: 30px;
  transition: all 0.3s ease;
}

.pillar:hover {
  transform: translateY(-5px);
  box-shadow: 6px 6px 0px var(--black);
}

.pillar-icon {
  font-size: 32px;
  margin-bottom: 20px;
}

.pillar h3 {
  font-size: 18px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 15px;
  letter-spacing: 1px;
}

.pillar p {
  font-size: 14px;
  line-height: 1.6;
  opacity: 0.8;
}

/* Stats Section */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
  gap: 20px;
  margin: 80px 0;
  padding: 40px;
  background: var(--offwhite);
  border: 2px solid var(--black);
}

.stat-item {
  text-align: center;
  padding: 20px;
}

.stat-number {
  font-size: 48px;
  font-weight: 800;
  color: var(--accent);
  line-height: 1;
  margin-bottom: 10px;
}

.stat-label {
  font-size: 14px;
  text-transform: uppercase;
  font-weight: 600;
  letter-spacing: 1px;
}

/* Scope of Work Section */
.scope-section {
  margin: 80px 0;
}

.scope-section h2 {
  font-size: 32px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 40px;
  text-align: center;
}

.scope-content {
  background: var(--offwhite);
  border: 2px solid var(--black);
  padding: 50px;
  box-shadow: 12px 12px 0px var(--black);
  position: relative;
}

.scope-tab {
  width: 200px;
  height: 40px;
  background: var(--offwhite);
  border: 2px solid var(--black);
  border-bottom: none;
  border-radius: 12px 12px 0 0;
  position: absolute;
  top: -40px;
  left: 20px;
  display: flex;
  align-items: center;
  padding-left: 20px;
  font-weight: 800;
  font-size: 12px;
  letter-spacing: 1px;
  z-index: 2;
}

.scope-list {
  list-style: none;
  padding: 0;
}

.scope-list li {
  margin-bottom: 25px;
  font-size: 16px;
  line-height: 1.6;
  position: relative;
  padding-left: 40px;
}

.scope-list li::before {
  content: "→";
  position: absolute;
  left: 0;
  color: var(--accent);
  font-weight: 800;
  font-size: 20px;
}

/* GirlsGoneBoss Section */
.ggb-section {
  background: var(--black);
  color: #fff;
  padding: 80px 5%;
  margin: 80px 0;
  text-align: center;
}

.ggb-content h2 {
  font-size: 32px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 30px;
  letter-spacing: 2px;
}

.ggb-content p {
  font-size: 18px;
  line-height: 1.8;
  max-width: 800px;
  margin: 0 auto 40px;
  opacity: 0.9;
}

.ggb-tagline {
  font-size: 24px;
  font-weight: 800;
  color: var(--accent);
  text-transform: uppercase;
  margin-top: 40px;
  letter-spacing: 3px;
}

/* Newsletter */
.newsletter {
  width: 80%;
  margin: 80px auto;
  padding: 60px;
  background: var(--offwhite);
  text-align: center;
  border: 2px solid var(--black);
}
.newsletter h3 {
  font-size: 24px;
  font-weight: 800;
  text-transform: uppercase;
  margin-bottom: 20px;
}
.newsletter p {
  margin-bottom: 20px;
  font-size: 14px;
}
.newsletter input {
  padding: 15px;
  border: 1px solid var(--black);
  width: 250px;
  background: var(--bg);
  color: var(--text);
}
.newsletter .btn {
  margin-top: 0;
  margin-left: 10px;
  background: var(--black);
  color: #fff;
  border: none;
}

/* Footer */
footer {
  background: #111;
  color: white;
  padding: 50px 5%;
  margin-top: 60px;
  text-align: center;
  font-size: 13px;
  text-transform: uppercase;
}

/* ---------- BUTTONS ---------- */
.btn {
  display: inline-block;
  margin-top: 15px;
  padding: 12px 28px;
  border: 2px solid var(--black);
  text-decoration: none;
  color: var(--black);
  font-weight: 700;
  transition: .3s;
  text-transform: uppercase;
  font-size: 12px;
  cursor: pointer;
}
.btn:hover {
  background: var(--black);
  color: white;
}
.btn-accent {
  background: var(--accent);
  border-color: var(--accent);
  color: #fff;
}
.btn-accent:hover {
  background: transparent;
  color: var(--accent);
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
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  transition: all 0.3s ease;
}
#back-to-top:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 16px rgba(0,0,0,0.3);
}

/* Hamburger Animation */
.hamburger.active span:nth-child(1) { transform: rotate(45deg) translate(5px, 5px); }
.hamburger.active span:nth-child(2) { opacity: 0; }
.hamburger.active span:nth-child(3) { transform: rotate(-45deg) translate(7px, -6px); }

/* Responsive */
@media (max-width: 768px) {
  .main-content { width: 95%; }
  .manifesto-about, .pillars-section, .scope-content, .newsletter { padding: 30px; }
  
  .timeline-container::before { left: 30px; }
  .timeline-item { width: calc(100% - 80px); left: 80px !important; padding-left: 30px !important; padding-right: 0 !important; text-align: left !important; }
  .timeline-item:nth-child(odd) .timeline-dot, 
  .timeline-item:nth-child(even) .timeline-dot { left: -40px; }
  
  .pillars-grid { grid-template-columns: 1fr; }
  .stats-grid { grid-template-columns: repeat(2, 1fr); }
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
    <button id="theme-toggle">🌑</button>
  </div>
  <div class="header-center">
    <div class="logo-container">
      <img src="images/NORMALLOGO.jpeg" class="logo-3d" alt="Streets Archives Logo">
    </div>
  </div>
  <div class="header-right">
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="cart">ABOUT</div>
  </div>
</header>

<div class="mobile-menu" id="mobileMenu">
  <a href="index.html">Home</a>
  <a href="#manifesto">Manifesto</a>
  <a href="#timeline">Timeline</a>
  <a href="#pillars">Pillars</a>
  <a href="#scope">Scope</a>
</div>

<section class="about-hero">
  <div class="hero-background"></div>
  <div class="hero-terminal">
    <span>ABOUT_ARCHIVE.EXE</span>
    <span>STATUS: ACTIVE</span>
    <span>ENCRYPTION: AES-256</span>
  </div>
  <div class="about-hero-content">
    <h1>STREETS<br>ARCHIVES</h1>
    <p>The fashion-forward division of Street Jewels Connections — a dynamic multimedia collective pushing the boundaries of creativity across music, fashion, film, media, and events.</p>
  </div>
</section>

<div class="main-content">
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
    
    <div class="text-center">
      <a href="index.html" class="btn btn-accent">Explore the Archive</a>
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
        <div class="timeline-title">GIRLSGONE BOSS TALK SHOW</div>
        <div class="timeline-desc">Expansion into media with entrepreneurial-focused content celebrating women in street culture.</div>
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
        <div class="pillar-icon">🎤</div>
        <h3>MEDIA & EVENTS</h3>
        <p>From the GirlsGone Boss Talk Show to immersive cultural experiences, we create platforms for authentic expression and entrepreneurial spirit.</p>
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

  <!-- GirlsGoneBoss Section -->
  <section class="ggb-section">
    <div class="ggb-content">
      <h2>GIRLSGONE BOSS TALK SHOW</h2>
      <p>An extension of our media pillar, GirlsGone Boss is a platform celebrating female entrepreneurship and creative leadership within street culture. We amplify voices, share stories of hustle, and document the journey of building empires from the ground up.</p>
      <p>Live free, die with money isn't just a tagline — it's a philosophy we embody through every conversation, every collaboration, every piece we archive.</p>
      <div class="ggb-tagline">LIVE FREE, DIE WITH MONEY</div>
    </div>
  </section>

  <!-- Newsletter -->
  <section class="newsletter">
    <h3>Join the Archive</h3>
    <p>Receive new releases, broadcasts, and recovered pieces before they go public.</p>
    <input type="email" placeholder="Enter your email">
    <button class="btn">Subscribe to Archive</button>
  </section>
</div>

<footer>
  <p>STREETS ARCHIVES — SOUTH AFRICA<br>FASHION • SOUND • VISUAL RECORDS<br>EST. 2026</p>
  <p>Privacy • Shipping • Returns • Contact</p>
  <p style="margin-top: 20px; font-size: 11px; opacity: 0.7;">A division of Street Jewels Connections</p>
</footer>

<button id="back-to-top">↑</button>

<script>
// Preloader
window.addEventListener('load', () => {
    document.getElementById('preloader').style.display = 'none';
});

// Toggle Mobile Menu
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');

function toggleMenu() {
  mobileMenu.classList.toggle('active');
  hamburger.classList.toggle('active');
}

hamburger.addEventListener('click', toggleMenu);

// Close mobile menu when clicking outside
document.addEventListener('click', (e) => {
  if (!mobileMenu.contains(e.target) && !hamburger.contains(e.target) && mobileMenu.classList.contains('active')) {
    toggleMenu();
  }
});

// Close menu when clicking links
document.querySelectorAll('.mobile-menu a').forEach(link => {
  link.addEventListener('click', toggleMenu);
});

// Theme Toggle
const themeToggle = document.getElementById('theme-toggle');
themeToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark');
    themeToggle.textContent = document.body.classList.contains('dark') ? '☀' : '🌑';
    
    // Save preference to localStorage
    localStorage.setItem('theme', document.body.classList.contains('dark') ? 'dark' : 'light');
});

// Initialize theme
const savedTheme = localStorage.getItem('theme');
if (savedTheme === 'dark' || (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches && !savedTheme)) {
    document.body.classList.add('dark');
    themeToggle.textContent = '☀';
}

// Back to Top Button
const backToTopBtn = document.getElementById('back-to-top');
window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        backToTopBtn.style.display = 'block';
    } else {
        backToTopBtn.style.display = 'none';
    }
});
backToTopBtn.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Newsletter form submission
const newsletterForm = document.querySelector('.newsletter');
const newsletterInput = newsletterForm.querySelector('input');
const newsletterBtn = newsletterForm.querySelector('.btn');

newsletterBtn.addEventListener('click', (e) => {
    e.preventDefault();
    if (newsletterInput.value && newsletterInput.value.includes('@')) {
        alert('Thank you for joining the Streets Archives. Welcome to the collective.');
        newsletterInput.value = '';
    } else {
        alert('Please enter a valid email address.');
    }
});

// Add enter key support for newsletter
newsletterInput.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') {
        newsletterBtn.click();
    }
});

// Animate timeline items on scroll
const observerOptions = {
  threshold: 0.2,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.style.opacity = '1';
      entry.target.style.transform = 'translateY(0)';
    }
  });
}, observerOptions);

// Apply animation to timeline items
document.querySelectorAll('.timeline-item').forEach((item, index) => {
  item.style.opacity = '0';
  item.style.transform = 'translateY(20px)';
  item.style.transition = `opacity 0.5s ease ${index * 0.2}s, transform 0.5s ease ${index * 0.2}s`;
  observer.observe(item);
});

// Animate pillars on scroll
document.querySelectorAll('.pillar').forEach((pillar, index) => {
  pillar.style.opacity = '0';
  pillar.style.transform = 'translateY(20px)';
  pillar.style.transition = `opacity 0.5s ease ${index * 0.1}s, transform 0.5s ease ${index * 0.1}s`;
  
  const pillarObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.opacity = '1';
        entry.target.style.transform = 'translateY(0)';
      }
    });
  }, { threshold: 0.1 });
  
  pillarObserver.observe(pillar);
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth'
            });
        }
    });
});
</script>

</body>
</html>