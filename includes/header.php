<?php
$cartCount = getCartCount(); // Make sure this function is available
?>

<!-- Header Component -->
<header>
  <div class="header-left">
    <input type="text" id="search" placeholder="Search products...">
    <button id="theme-toggle"><i class="bi bi-moon"></i></button>
  </div>
  <div class="header-center">
    <div class="logo-container">
      <img src="images/salmon.png" class="logo-3d" alt="Logo">
    </div>
  </div>
  <div class="header-right">
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="cart" onclick="window.location.href='cart.php'">CART (<span id="cart-count"><?php echo $cartCount; ?></span>)</div>
  </div>
</header>

<!-- Mobile Menu -->
<div class="mobile-menu" id="mobileMenu">
  <a href="about.php" onclick="toggleMenu()">About Us</a>
  <a href="fashion.php" onclick="toggleMenu()">Fashion</a>
  <a href="media.php" onclick="toggleMenu()">Media</a>
  <a href="music.php" onclick="toggleMenu()">Music</a>
  <a href="cart.php" onclick="toggleMenu()">Cart (<span id="mobile-cart-count"><?php echo $cartCount; ?></span>)</a>
</div>