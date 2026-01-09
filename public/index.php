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
}

/* ---------- TOP BAR ---------- */
.top-bar{background:var(--black); color:white; padding:10px 0; overflow:hidden;}
.top-bar p{animation: scrollText 8s linear infinite; font-size:14px; white-space: nowrap;}
@keyframes scrollText{ 0%{transform:translateX(100%);} 100%{transform:translateX(-100%);} }

/* ---------- 3D LOGO FIX ---------- */
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
  perspective: 1200px; /* Gives the 3D depth effect */
  width: 80px;
  height: 80px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.logo-3d {
  width: 100%;
  height: auto;
  /* Slower 10s rotation for a premium 'Cultish' feel */
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

/* ---------- HERO ---------- */
.hero{
  height:75vh;
  background:url('images/herobg2.jpeg') center/cover no-repeat;
  display:flex;
  align-items:center;
  justify-content:center;
}
.hero-content{background:rgba(255,255,255,.75); padding:32px 45px; text-align:center;}
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

.folder-section.show {
  opacity: 1;
  transform: translateY(0);
}

/* ---------- CATEGORIES & OTHERS ---------- */
.categories{ width:80%; margin:80px auto; display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.category{ background:#f2f2f2; padding:60px 20px; border:1px solid #ddd; text-align:center; font-weight:700; cursor: pointer; transition: .3s;}
.category:hover{background:#eee; border-color: #000;}

.products{width:80%;margin:80px auto;}
.grid{display:grid; grid-template-columns:repeat(4,1fr); gap:20px;}
.product{border:1px solid #ddd; padding:16px; transition: .3s;}
.product:hover {border-color: #000;}
.product img{width:100%; margin-bottom: 10px;}

.carousel{margin:100px 0; overflow:hidden; white-space:nowrap; border-top: 1px solid #eee; border-bottom: 1px solid #eee; padding: 20px 0;}
.carousel-track{display:inline-flex; animation: slideImages 28s linear infinite;}
.carousel img{width:260px; height:320px; object-fit:cover; margin-right:18px; filter: grayscale(100%); transition: .5s;}
.carousel img:hover {filter: grayscale(0%);}

@keyframes slideImages{ 0%{transform:translateX(0);} 100%{transform:translateX(-50%);} }

.newsletter{width:80%; margin:80px auto; padding:60px; background:var(--offwhite); text-align:center; border: 2px solid #000;}

footer{background:#111; color:white; padding:50px 5%; margin-top:60px; text-align: center; font-size: 13px; text-transform: uppercase; letter-spacing: 1px;}

/* Mobile Fix */
@media (max-width: 768px) {
  .folder-content { grid-template-columns: 1fr; }
  .categories { grid-template-columns: 1fr; }
  .grid { grid-template-columns: repeat(2, 1fr); }
  .folder-text { text-align: center; }
  .btn { align-self: center; }
}
</style>
</head>

<body>

<div class="top-bar">
  <p>Live free, Die with money ~ Live free, Die with money </p>
</div>

<header>
  <div class="logo-container">
    <img src="images/normallogo.jpeg" class="logo-3d" alt="Logo">
  </div>

  <nav>
    <ul>
      <li><a href="#">Shop</a></li>
      <li><a href="#">New Arrivals</a></li>
      <li><a href="#">Contact</a></li>
    </ul>
  </nav>

  <div class="cart">CART (0)</div>
</header>

<section class="hero">
  <div class="hero-content">
    <h1>YOUR BRAND — NEW SEASON</h1>
    <a href="#" class="btn">Shop Now</a>
  </div>
</section>

<div class="folder-section">
  <div class="folder-tab"><span>STORY.01</span></div>
  <div class="folder-body">
    <div class="folder-content">
      <div class="folder-image">
        <img src="images/banner2.jpeg" alt="About Image">
      </div>
      <div class="folder-text">
        <h3>About The Brand</h3>
        <p>Short intro about your brand here. We prioritize quality craftsmanship and sustainable practices in every piece we create.</p>
        <a href="#" class="btn">Read Our Story</a>
      </div>
    </div>
  </div>
</div>

<div class="folder-section">
  <div class="folder-tab"><span>CRAFT.02</span></div>
  <div class="folder-body">
    <div class="folder-content">
      <div class="folder-image">
        <img src="images/banner3.jpeg" alt="Craft Image">
      </div>
      <div class="folder-text">
        <h3>Quality & Craft</h3>
        <p>Explain what makes your products special. We use premium materials sourced locally to ensure the best durability.</p>
        <a href="#" class="btn">Explore Details</a>
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
  <h2 style="margin-bottom: 30px; text-transform: uppercase; font-weight: 900;">Featured</h2>
  <div class="grid">
    <div class="product">
      <img src="images/banner1.jpeg">
      <p>Product Name</p><strong>R 799</strong>
    </div>
    <div class="product">
      <img src="images/banner2.jpeg">
      <p>Product Name</p><strong>R 899</strong>
    </div>
    <div class="product">
      <img src="images/banner3.jpeg">
      <p>Product Name</p><strong>R 999</strong>
    </div>
    <div class="product">
      <img src="images/banner1.jpeg">
      <p>Product Name</p><strong>R 1099</strong>
    </div>
  </div>
</section>

<section class="carousel">
  <div class="carousel-track">
    <img src="images/banner2.jpeg">
    <img src="images/banner3.jpeg">
    <img src="images/banner1.jpeg">
    <img src="images/banner2.jpeg">
    <img src="images/banner3.jpeg">
    <img src="images/banner1.jpeg">
    <img src="images/banner2.jpeg">
    <img src="images/banner3.jpeg">
  </div>
</section>

<section class="newsletter">
  <h3 style="text-transform: uppercase; font-weight: 900; margin-bottom: 20px;">Join our newsletter</h3>
  <input type="email" placeholder="Enter your email" style="padding:15px; border:1px solid #000; width:280px; font-family: inherit;">
  <button class="btn" style="margin-top:0; margin-left: 10px; background: #000; color: #fff;">Subscribe</button>
</section>

<footer>
  <p>Privacy • Shipping • Returns • Contact</p>
  <p>©️ Your Brand 2024</p>
</footer>

<script>
// Logic for fading/sliding folders into view
const folderObserver = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add("show");
    }
  });
}, { 
  threshold: 0.15 
});

document.querySelectorAll(".folder-section").forEach(f => {
  folderObserver.observe(f);
});
</script>

</body>
</html>