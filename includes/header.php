<?php
// 1. Load the files FIRST
require_once(__DIR__ . '/../app/config.php');
require_once(__DIR__ . '/../app/database.php');

// 2. NOW you can call the function
$cartCount = getCartCount(); 
?>

<header>
  <div class="header-left">
    <input type="text" id="search" placeholder="Search products...">
    <button id="theme-toggle"><i class="bi bi-moon"></i></button>
  </div>
  
  <div class="header-center">
    <div class="logo-container">
      <video 
        src="images/logo10.mp4" 
        class="logo-3d" 
        autoplay 
        loop 
        muted 
        playsinline>
      </video>
    </div>
  </div>

  <div class="header-right">
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="cart" onclick="window.location.href='cart.php'">
      CART (<span id="cart-count"><?php echo $cartCount; ?></span>)
    </div>
  </div>
</header>

<div class="mobile-menu-overlay" id="mobileMenuOverlay"></div>

<div class="mobile-menu" id="mobileMenu">
  <div class="mobile-menu-header">
    <h3>MENU</h3>
    <button class="mobile-menu-close" id="mobileMenuClose">
      <i class="bi bi-x"></i>
    </button>
  </div>
  
  <nav class="mobile-menu-nav">
    <a href="index.php"><i class="bi bi-house"></i> Home</a>
    <a href="about.php"><i class="bi bi-info-circle"></i> About</a>
    <a href="fashion.php"><i class="bi bi-tshirt"></i> Fashion</a>
    <a href="music.php"><i class="bi bi-music-note-beamed"></i> Music</a>
    <a href="media.php"><i class="bi bi-camera-video"></i> Media</a>
    <a href="cart.php">
      <i class="bi bi-cart"></i> Cart
      <span class="mobile-cart-badge" id="mobileCartCount"><?php echo $cartCount; ?></span>
    </a>
  </nav>
  
  <div class="mobile-menu-footer">
    <p>Follow Archives</p>
    <div class="mobile-social-links">
      <a href="https://instagram.com" target="_blank"><i class="bi bi-instagram"></i></a>
      <a href="https://twitter.com" target="_blank"><i class="bi bi-twitter-x"></i></a>
      <a href="https://soundcloud.com" target="_blank"><i class="bi bi-music-note-beamed"></i></a>
    </div>
  </div>
</div>