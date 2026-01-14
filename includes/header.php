<?php
session_start();

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get cart count
function getCartCount() {
    $count = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $count += $item['quantity'];
        }
    }
    return $count;
}

$cartCount = getCartCount();
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>STREETS ARCHIVES - <?php echo $pageTitle ?? 'Home'; ?></title>

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
.cart{font-weight:700; cursor: pointer;}
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
  padding: 10px 20px;
}

/* ---------- SHOP SPECIFIC STYLES ---------- */
.shop-categories {
    width: 90%;
    max-width: 1400px;
    margin: 60px auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
}

.shop-category {
    background: var(--offwhite);
    border: 2px solid var(--black);
    padding: 40px;
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.shop-category:hover {
    transform: translateY(-10px);
    box-shadow: 12px 12px 0px var(--black);
    border-color: var(--accent);
}

.shop-category h3 {
    font-size: 24px;
    font-weight: 800;
    text-transform: uppercase;
    margin-bottom: 15px;
}

.shop-category p {
    font-size: 14px;
    color: #666;
    margin-bottom: 20px;
    line-height: 1.6;
}

.category-count {
    font-size: 11px;
    color: var(--accent);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.filter-bar {
    width: 90%;
    max-width: 1400px;
    margin: 40px auto;
    padding: 20px;
    background: var(--offwhite);
    border: 2px solid var(--black);
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.filter-options {
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.filter-btn {
    padding: 10px 20px;
    border: 2px solid var(--black);
    background: transparent;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    text-transform: uppercase;
    cursor: pointer;
    transition: 0.3s;
    font-size: 12px;
    letter-spacing: 1px;
}

.filter-btn:hover,
.filter-btn.active {
    background: var(--black);
    color: white;
}

.sort-select {
    padding: 10px 15px;
    border: 2px solid var(--black);
    background: var(--bg);
    color: var(--text);
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    cursor: pointer;
}

/* ---------- PRODUCT GRID ---------- */
.products{width:90%;margin:80px auto;}
.grid{display:grid; grid-template-columns:repeat(4,1fr); gap:20px;}
.product{border:1px solid #ddd; padding:16px; opacity: 0; animation: fadeInUp 0.5s ease-out forwards; cursor: pointer;}
.product img{width:100%; margin-bottom: 10px; transition: transform 0.3s;}
.product:hover img { transform: scale(1.05); }

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ---------- PRODUCT DETAIL PAGE ---------- */
.product-detail-container {
    width: 90%;
    max-width: 1200px;
    margin: 100px auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: start;
}

.product-gallery {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.main-image {
    width: 100%;
    height: 500px;
    object-fit: cover;
    border: 2px solid var(--black);
}

.thumbnail-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
}

.thumbnail {
    width: 100%;
    height: 80px;
    object-fit: cover;
    cursor: pointer;
    border: 1px solid #ddd;
    transition: 0.3s;
}

.thumbnail:hover,
.thumbnail.active {
    border-color: var(--accent);
}

.product-info {
    padding: 20px 0;
}

.product-category {
    font-size: 11px;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #888;
    margin-bottom: 10px;
}

.product-name {
    font-size: 42px;
    font-weight: 800;
    text-transform: uppercase;
    margin-bottom: 20px;
    line-height: 1.1;
}

.product-price-large {
    font-size: 28px;
    font-weight: 800;
    color: var(--accent);
    margin-bottom: 20px;
}

.product-description-long {
    font-size: 15px;
    line-height: 1.7;
    margin-bottom: 30px;
    color: #444;
}

.product-attributes {
    margin-bottom: 30px;
}

.attribute {
    margin-bottom: 15px;
}

.attribute label {
    display: block;
    font-weight: 600;
    margin-bottom: 5px;
    font-size: 13px;
    text-transform: uppercase;
}

.size-options {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.size-option {
    width: 45px;
    height: 45px;
    border: 2px solid var(--black);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-weight: 700;
    transition: 0.3s;
}

.size-option:hover,
.size-option.selected {
    background: var(--black);
    color: white;
}

.size-option.disabled {
    opacity: 0.3;
    cursor: not-allowed;
}

.quantity-selector {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 30px;
}

.quantity-btn {
    width: 40px;
    height: 40px;
    border: 2px solid var(--black);
    background: none;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.quantity-input {
    width: 60px;
    height: 40px;
    border: 2px solid var(--black);
    text-align: center;
    font-size: 16px;
    font-weight: 700;
}

.action-buttons {
    display: flex;
    gap: 15px;
    margin-bottom: 30px;
}

.action-btn {
    padding: 15px 30px;
    border: 2px solid var(--black);
    background: var(--black);
    color: white;
    font-weight: 700;
    text-transform: uppercase;
    cursor: pointer;
    transition: 0.3s;
    font-size: 13px;
    letter-spacing: 1px;
    flex: 1;
}

.action-btn.secondary {
    background: transparent;
    color: var(--black);
}

.action-btn:hover {
    background: var(--accent);
    border-color: var(--accent);
    color: white;
}

.product-meta-info {
    border-top: 1px solid var(--grey);
    padding-top: 20px;
    font-size: 12px;
    color: #666;
}

.meta-item {
    margin-bottom: 10px;
    display: flex;
}

.meta-label {
    font-weight: 600;
    min-width: 120px;
}

.related-products {
    margin-top: 80px;
    padding-top: 60px;
    border-top: 2px solid var(--black);
}

/* ---------- MUSIC PAGE ---------- */
.music-hero {
    height: 70vh;
    background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('images/image1.jpg');
    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    margin-bottom: 60px;
}

.music-hero h1 {
    font-size: 72px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -2px;
    margin-bottom: 20px;
}

.music-hero p {
    font-size: 14px;
    letter-spacing: 3px;
    text-transform: uppercase;
    opacity: 0.8;
}

.music-player-large {
    background: #000;
    color: white;
    padding: 40px;
    border-radius: 8px;
    margin: 60px auto;
    width: 90%;
    max-width: 1200px;
}

.player-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 30px;
}

.player-title {
    font-size: 24px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.player-status {
    font-size: 11px;
    color: #888;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.player-controls-large {
    display: flex;
    align-items: center;
    gap: 20px;
    margin-top: 30px;
}

.play-btn-large {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: white;
    color: black;
    border: none;
    font-size: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: 0.3s;
}

.play-btn-large:hover {
    background: var(--accent);
    color: white;
}

.progress-bar-large {
    flex-grow: 1;
    height: 6px;
    background: #333;
    cursor: pointer;
    position: relative;
    border-radius: 3px;
}

.progress-fill-large {
    width: 0%;
    height: 100%;
    background: var(--accent);
    border-radius: 3px;
    transition: width 0.1s;
}

.time-display {
    font-family: monospace;
    font-size: 14px;
    color: #888;
    min-width: 100px;
    text-align: center;
}

.tracks-section {
    width: 90%;
    max-width: 1200px;
    margin: 80px auto;
}

.tracks-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 20px;
    margin-top: 40px;
}

.track-card {
    background: var(--offwhite);
    padding: 20px;
    border: 2px solid var(--black);
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 15px;
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
}

.track-number {
    font-size: 14px;
    font-weight: 700;
    color: #888;
    min-width: 30px;
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
    font-size: 14px;
}

.track-artist {
    font-size: 12px;
    color: #888;
}

.track-card.playing .track-artist {
    color: rgba(255,255,255,0.8);
}

.track-duration {
    font-size: 12px;
    color: #888;
    font-weight: 600;
}

.live-stream {
    background: #000;
    color: white;
    padding: 30px;
    border-radius: 8px;
    margin: 60px auto;
    width: 90%;
    max-width: 1200px;
    border: 2px solid var(--accent);
}

.stream-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.stream-title {
    font-size: 20px;
    font-weight: 800;
    text-transform: uppercase;
    color: var(--accent);
}

.stream-status {
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 12px;
}

.status-indicator {
    width: 10px;
    height: 10px;
    background: #00ff00;
    border-radius: 50%;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.stream-details {
    font-family: monospace;
    font-size: 12px;
    color: #888;
    line-height: 1.8;
}

.music-links {
    display: flex;
    justify-content: center;
    gap: 20px;
    margin: 60px auto;
    flex-wrap: wrap;
}

.music-link {
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

.music-link:hover {
    background: var(--accent);
    border-color: var(--accent);
}

.music-link.secondary {
    background: transparent;
    color: var(--black);
}

.releases-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.release-card {
    background: var(--offwhite);
    border: 2px solid var(--black);
    padding: 20px;
    text-align: center;
    transition: 0.3s;
}

.release-card:hover {
    transform: translateY(-5px);
    box-shadow: 8px 8px 0px var(--black);
}

.release-artwork {
    width: 100%;
    height: 200px;
    object-fit: cover;
    margin-bottom: 15px;
    border: 1px solid #ddd;
}

.release-title {
    font-weight: 700;
    margin-bottom: 5px;
    text-transform: uppercase;
    font-size: 14px;
}

.release-artist {
    font-size: 12px;
    color: #888;
    margin-bottom: 10px;
}

.release-date {
    font-size: 11px;
    color: var(--accent);
    font-weight: 600;
}

/* ---------- CART PAGE ---------- */
.cart-container {
    width: 90%;
    max-width: 1200px;
    margin: 100px auto;
}

.cart-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
}

.cart-items {
    margin-bottom: 40px;
}

.cart-item {
    display: grid;
    grid-template-columns: 100px 2fr 1fr 1fr 1fr;
    gap: 20px;
    align-items: center;
    padding: 20px 0;
    border-bottom: 1px solid var(--grey);
}

.cart-item-image img {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border: 1px solid #ddd;
}

.cart-item-details h4 {
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 5px;
}

.cart-item-details p {
    font-size: 12px;
    color: #888;
}

.cart-item-quantity {
    display: flex;
    align-items: center;
    gap: 10px;
}

.cart-item-quantity button {
    width: 30px;
    height: 30px;
    border: 1px solid var(--black);
    background: none;
    cursor: pointer;
}

.cart-item-quantity input {
    width: 40px;
    text-align: center;
    border: 1px solid var(--grey);
}

.cart-item-price {
    font-weight: 700;
    color: var(--accent);
}

.cart-item-remove {
    color: #ff4444;
    cursor: pointer;
    font-size: 12px;
    text-transform: uppercase;
    font-weight: 600;
}

.cart-summary {
    background: var(--offwhite);
    padding: 30px;
    border: 2px solid var(--black);
}

.summary-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-size: 14px;
}

.summary-row.total {
    font-size: 18px;
    font-weight: 700;
    border-top: 2px solid var(--black);
    padding-top: 15px;
    margin-top: 15px;
}

.checkout-btn {
    width: 100%;
    padding: 15px;
    background: var(--black);
    color: white;
    border: none;
    font-weight: 700;
    text-transform: uppercase;
    cursor: pointer;
    transition: 0.3s;
    margin-top: 20px;
}

.checkout-btn:hover {
    background: var(--accent);
}

/* ---------- FLOATING CONTACT FORM ---------- */
.floating-contact-container {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 10000 !important;
}

.contact-toggle-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--accent);
    color: white;
    border: none;
    font-size: 24px;
    cursor: pointer;
    box-shadow: 0 8px 30px rgba(255, 60, 0, 0.4);
    transition: all 0.3s var(--transition);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10001 !important;
    position: relative;
}

.contact-toggle-btn:hover {
    transform: scale(1.1);
    background: var(--black);
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
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 30px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    opacity: 0;
    visibility: hidden;
    transform: translateY(20px);
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    z-index: 10000 !important;
}

.contact-panel.active {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.contact-panel h3 {
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 20px;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: var(--accent);
}

.contact-panel p {
    font-size: 14px;
    opacity: 0.8;
    margin-bottom: 25px;
    line-height: 1.6;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    margin-bottom: 30px;
}

.contact-form input,
.contact-form textarea {
    padding: 14px;
    background: var(--bg);
    border: 1px solid var(--grey);
    border-radius: 8px;
    color: var(--text);
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    transition: all 0.3s var(--transition);
}

.contact-form input:focus,
.contact-form textarea:focus {
    outline: none;
    border-color: var(--accent);
    background: rgba(255, 60, 0, 0.05);
}

.contact-form textarea {
    min-height: 100px;
    resize: vertical;
}

.contact-form button {
    background: var(--accent);
    color: white;
    border: none;
    padding: 14px;
    border-radius: 8px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    cursor: pointer;
    transition: all 0.3s var(--transition);
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
}

.contact-form button:hover {
    background: var(--black);
    transform: translateY(-2px);
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 15px;
    margin-top: 25px;
    padding-top: 25px;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}

.social-link {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.05);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text);
    text-decoration: none;
    font-size: 18px;
    transition: all 0.3s var(--transition);
}

.social-link:hover {
    background: var(--accent);
    color: white;
    transform: translateY(-3px);
}

.contact-close {
    position: absolute;
    top: 15px;
    right: 15px;
    background: transparent;
    border: none;
    color: var(--text);
    font-size: 20px;
    cursor: pointer;
    opacity: 0.7;
    transition: all 0.3s var(--transition);
}

.contact-close:hover {
    opacity: 1;
    color: var(--accent);
    transform: rotate(90deg);
}

/* Common Elements */
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

.newsletter {
    width: 80%;
    margin: 80px auto;
    padding: 60px;
    background: var(--offwhite);
    text-align: center;
    border: 2px solid #000;
}

footer {
    background:#111;
    color:white;
    padding:50px 5%;
    margin-top:60px;
    text-align: center;
    font-size: 13px;
    text-transform: uppercase;
}

/* Utility */
.btn {
    display:inline-block;
    padding:12px 28px;
    border:2px solid var(--black);
    text-decoration:none;
    color:var(--black);
    font-weight:700;
    transition: .3s;
    text-transform: uppercase;
    font-size: 12px;
    cursor: pointer;
    background: transparent;
}
.btn:hover {
    background:var(--black);
    color:white;
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

/* Modal */
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

/* Responsive */
@media (max-width: 768px) {
    .grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .shop-categories {
        grid-template-columns: 1fr;
    }
    
    .filter-bar {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .product-detail-container {
        grid-template-columns: 1fr;
        gap: 30px;
    }
    
    .main-image {
        height: 300px;
    }
    
    .floating-contact-container {
        bottom: 20px;
        right: 20px;
    }
    
    .contact-panel {
        width: 320px;
        right: -10px;
    }
    
    .cart-item {
        grid-template-columns: 80px 1fr;
        grid-template-rows: auto auto auto;
        gap: 10px;
    }
    
    .cart-item-quantity,
    .cart-item-price,
    .cart-item-remove {
        grid-column: 2;
    }
    
    .music-hero h1 {
        font-size: 48px;
    }
    
    .player-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
    }
}

@media (max-width: 480px) {
    .grid {
        grid-template-columns: 1fr;
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
    
    .contact-panel {
        width: calc(100vw - 40px);
        right: -15px;
        padding: 25px;
    }
    
    .contact-panel h3 {
        font-size: 20px;
    }
    
    .product-name {
        font-size: 32px;
    }
    
    .action-buttons {
        flex-direction: column;
    }
}

/* Cart notification */
.cart-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: var(--accent);
    color: white;
    padding: 15px 25px;
    border-radius: 4px;
    display: none;
    z-index: 2000;
    animation: slideIn 0.3s ease-out;
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
    <input type="text" id="search" placeholder="Search products...">
    <button id="theme-toggle">🌑</button>
  </div>
  <div class="header-center">
    <a href="index.php">
      <div class="logo-container">
        <img src="images/NORMALLOGO.jpeg" class="logo-3d" alt="Logo">
      </div>
    </a>
  </div>
  <div class="header-right">
    <div class="hamburger" id="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div class="cart" onclick="window.location.href='shop.php'">CART (<?php echo $cartCount; ?>)</div>
  </div>
</header>

<div class="mobile-menu" id="mobileMenu">
  <a href="shop.php" onclick="toggleMenu()">Shop</a>
  <a href="media.php" onclick="toggleMenu()">Media</a>
  <a href="music.php" onclick="toggleMenu()">Music</a>
  <a href="cart.php" onclick="toggleMenu()">Cart (<?php echo $cartCount; ?>)</a>
</div>

<div id="progress"></div>
<div id="cursor"></div>
<div id="toast"></div>
<div id="back-to-top">↑</div>
<div class="cart-notification" id="cartNotification">Item added to cart!</div>