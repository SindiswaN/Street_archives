<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Your Brand — Home</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
/* ---------- GLOBAL ---------- */
*{margin:0;padding:0;box-sizing:border-box;}

body{
  font-family:'Poppins', sans-serif;
  background:#ffffff;
  color:#111;
  overflow-x: hidden;
}

:root{
  --black:#111;
  --grey:#e6e6e6;
  --offwhite:#f8f8f8;
  --accent: #ff3c00;
}

/* ---------- TOP BAR ---------- */
.top-bar{background:var(--black); color:white; padding:10px 0; overflow:hidden;}
.top-bar p{animation: scrollText 8s linear infinite; font-size:14px; white-space: nowrap;}
@keyframes scrollText{ 0%{transform:translateX(100%);} 100%{transform:translateX(-100%);} }

/* ---------- HEADER & HAMBURGER ---------- */
header{
  display:flex; 
  align-items:center; 
  justify-content:space-between; 
  padding:15px 5%; 
  border-bottom:1px solid #ddd;
  background: #fff;
  position: sticky;
  top: 0;
  z-index: 1000;
}

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

nav ul{list-style:none; display:flex; gap:28px;}
nav a{text-decoration:none; color:#111; font-weight:600; text-transform: uppercase; font-size: 13px;}
.cart{font-weight:700;}

/* Hamburger Button */
.hamburger {
  display: none;
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

.s-fashion { background-image: url('images/banner2.jpeg'); }
.s-media { background-image: url('images/banner3.jpeg'); }
.s-music { background-image: url('images/banner1.jpeg'); }

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
.product{border:1px solid #ddd; padding:16px;}
.product img{width:100%; margin-bottom: 10px;}

.carousel{margin:100px 0; overflow:hidden; white-space:nowrap; border-top: 1px solid #eee; border-bottom: 1px solid #eee; padding: 20px 0;}
.carousel-track{display:inline-flex; animation: slideImages 28s linear infinite;}
.carousel img{width:260px; height:320px; object-fit:cover; margin-right:18px;}
@keyframes slideImages{ 0%{transform:translateX(0);} 100%{transform:translateX(-50%);} }

.newsletter{width:80%; margin:80px auto; padding:60px; background:var(--offwhite); text-align:center; border: 2px solid #000;}
footer{background:#111; color:white; padding:50px 5%; margin-top:60px; text-align: center; font-size: 13px; text-transform: uppercase;}

/* Mobile Fix */
@media (max-width: 768px) {
  nav { display: none; }
  .hamburger { display: flex; }
  .folder-content { grid-template-columns: 1fr; }
  .categories { grid-template-columns: 1fr; }
  .grid { grid-template-columns: repeat(2, 1fr); }
  .terminal-data { display: none; }
}
</style>
</head>

<body>

<div class="top-bar">
  <p>Live free, Die with money ~ Live free, Die with money — Fashion, Media, Music Archive</p>
</div>

<header>
  <div class="logo-container">
    <img src="images/lg.jpeg" class="logo-3d" alt="Logo">
  </div>
  
  <nav>
    <ul>
      <li><a href="#fashion">Shop</a></li>
      <li><a href="#media">Media</a></li>
      <li><a href="#music">Music</a></li>
    </ul>
  </nav>

  <div class="hamburger" id="hamburger">
    <span></span>
    <span></span>
    <span></span>
  </div>

  <div class="cart">CART (0)</div>
</header>

<div class="mobile-menu" id="mobileMenu">
  <a href="#fashion" onclick="toggleMenu()">Shop</a>
  <a href="#media" onclick="toggleMenu()">Media</a>
  <a href="#music" onclick="toggleMenu()">Music</a>
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
    <h1>TOTALITY<br>ARCHIVE</h1>
    <p class="tagline">Fashion / Media / Sound Archive</p>
    <a href="#fashion" class="btn-hero">Initialize Explorer</a>
  </div>
</section>

<div class="folder-section" id="fashion">
  <div class="folder-tab"><span>DIR_FASHION</span></div>
  <div class="folder-body">
    <div class="folder-content">
      <div class="folder-image"><img src="images/banner2.jpeg" alt="Fashion"></div>
      <div class="folder-text">
        <h3>Fashion Archive</h3>
        <p>Explore our premium silhouettes and industrial textiles. Sustainable quality for the modern culture.</p>
        <a href="#" class="btn">Shop Collection</a>
      </div>
    </div>
  </div>
</div>

<div class="folder-section" id="media">
  <div class="folder-tab"><span>DIR_MEDIA</span></div>
  <div class="folder-body">
    <div class="folder-content">
      <div class="folder-image"><img src="images/banner3.jpeg" alt="Media"></div>
      <div class="folder-text">
        <h3>Visual Media</h3>
        <p>Cinematic documentation and editorial photography. View our latest visual projects.</p>
        <a href="#" class="btn">View Gallery</a>
      </div>
    </div>
  </div>
</div>

<div class="folder-section" id="music">
  <div class="folder-tab"><span>DIR_MUSIC</span></div>
  <div class="folder-body">
    <div class="folder-content">
      <div class="folder-image"><img src="images/banner1.jpeg" alt="Music"></div>
      <div class="folder-text">
        <h3>Audio Archive</h3>
        <p>The soundscape of the brand. Listen to our latest collaborative audio releases below.</p>
        
        <div class="audio-player">
          <p style="font-size: 10px; font-weight: 800; color: #888;">NOW PLAYING: BRAND_TRACK_V1.MP3</p>
          <div class="player-controls">
            <button class="play-btn" id="master-play">▶</button>
            <div class="progress-bar" id="progress-container">
                <div class="progress-fill" id="progress-bar"></div>
            </div>
          </div>
          <audio id="main-audio" src="music/brand_track.mp3"></audio>
        </div>

        <a href="#" class="btn">Listen Now</a>
      </div>
    </div>
  </div>
</div>

<section class="categories">
  <div class="category">MEN</div>
  <div class="category">WOMEN</div>
  <div class="category">NEW ARRIVALS</div>
</section>

<section class="products">
  <h2 style="margin-bottom: 30px; text-transform: uppercase; font-weight: 800;">Featured</h2>
  <div class="grid">
    <div class="product"><img src="images/banner1.jpeg"><p>Product Name</p><strong>R 799</strong></div>
    <div class="product"><img src="images/banner2.jpeg"><p>Product Name</p><strong>R 899</strong></div>
    <div class="product"><img src="images/banner3.jpeg"><p>Product Name</p><strong>R 999</strong></div>
    <div class="product"><img src="images/banner1.jpeg"><p>Product Name</p><strong>R 1099</strong></div>
  </div>
</section>

<section class="carousel">
  <div class="carousel-track">
    <img src="images/banner2.jpeg"><img src="images/banner3.jpeg"><img src="images/banner1.jpeg">
    <img src="images/banner2.jpeg"><img src="images/banner3.jpeg"><img src="images/banner1.jpeg">
  </div>
</section>

<section class="newsletter">
  <h3>Join our newsletter</h3>
  <input type="email" placeholder="Enter your email" style="padding:15px; border:1px solid #000; width:250px;">
  <button class="btn" style="margin-top:0; margin-left: 10px; background: #000; color: #fff; border: none;">Subscribe</button>
</section>

<footer>
  <p>Privacy • Shipping • Returns • Contact</p>
  <p>©️ Your Brand 2026</p>
</footer>

<script>
// Toggle Mobile Menu
const hamburger = document.getElementById('hamburger');
const mobileMenu = document.getElementById('mobileMenu');

function toggleMenu() {
  mobileMenu.classList.toggle('active');
}

hamburger.addEventListener('click', toggleMenu);

// Reveal Folders on Scroll
const folderObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) { entry.target.classList.add("show"); }
  });
}, { threshold: 0.15 });
document.querySelectorAll(".folder-section").forEach(f => folderObserver.observe(f));

// Audio Player functionality
const audio = document.getElementById('main-audio');
const playBtn = document.getElementById('master-play');
const progressFill = document.getElementById('progress-bar');
const progressContainer = document.getElementById('progress-container');

playBtn.addEventListener('click', () => {
    if (audio.paused) { audio.play(); playBtn.innerText = 'II'; } 
    else { audio.pause(); playBtn.innerText = '▶'; }
});

audio.addEventListener('timeupdate', () => {
    const percent = (audio.currentTime / audio.duration) * 100;
    progressFill.style.width = percent + '%';
});

progressContainer.addEventListener('click', (e) => {
    const width = progressContainer.clientWidth;
    const clickX = e.offsetX;
    audio.currentTime = (clickX / width) * audio.duration;
});
</script>

</body>
</html>