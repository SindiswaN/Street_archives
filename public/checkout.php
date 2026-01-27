<?php
$pageTitle = 'Checkout';
require_once(__DIR__ . '/../app/config.php');
require_once(__DIR__ . '/../app/database.php');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Redirect if cart is empty
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}

// Calculate totals
$subtotal = 0;
$shipping = 0;
$tax = 0;
$total = 0;

foreach ($_SESSION['cart'] as $item) {
    $price_numeric = 0;
    if (is_numeric($item['price'])) {
        $price_numeric = floatval($item['price']);
    } else {
        preg_match('/[\d\.]+/', $item['price'], $matches);
        $price_numeric = isset($matches[0]) ? floatval($matches[0]) : 0;
    }
    $subtotal += $price_numeric * $item['quantity'];
}

$shipping = 0; // Free shipping
$tax = $subtotal * 0.15; // 15% VAT
$total = $subtotal + $shipping + $tax;

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstName = trim($_POST['first_name'] ?? '');
    $lastName = trim($_POST['last_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $postalCode = trim($_POST['postal_code'] ?? '');
    $country = trim($_POST['country'] ?? 'ZA');
    $paymentMethod = $_POST['payment_method'] ?? 'card';
    
    // Validate required fields
    $errors = [];
    
    if (empty($firstName)) $errors[] = 'First name is required';
    if (empty($lastName)) $errors[] = 'Last name is required';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
    if (empty($phone)) $errors[] = 'Phone number is required';
    if (empty($address)) $errors[] = 'Address is required';
    if (empty($city)) $errors[] = 'City is required';
    if (empty($postalCode)) $errors[] = 'Postal code is required';
    
    if (empty($errors)) {
        // Save order to database
        try {
            // FIXED: Use the correct database connection method
            $database = new Database();
            $conn = $database->getConnection();
            
            // Start transaction
            $conn->beginTransaction();
            
            // Insert order
            $stmt = $conn->prepare("
                INSERT INTO orders (
                    order_number, first_name, last_name, email, phone, 
                    address, city, postal_code, country, payment_method,
                    subtotal, shipping, tax, total, status
                ) VALUES (
                    :order_number, :first_name, :last_name, :email, :phone,
                    :address, :city, :postal_code, :country, :payment_method,
                    :subtotal, :shipping, :tax, :total, 'pending'
                )
            ");
            
            $orderNumber = 'SA' . date('Ymd') . strtoupper(uniqid());
            
            $stmt->execute([
                ':order_number' => $orderNumber,
                ':first_name' => $firstName,
                ':last_name' => $lastName,
                ':email' => $email,
                ':phone' => $phone,
                ':address' => $address,
                ':city' => $city,
                ':postal_code' => $postalCode,
                ':country' => $country,
                ':payment_method' => $paymentMethod,
                ':subtotal' => $subtotal,
                ':shipping' => $shipping,
                ':tax' => $tax,
                ':total' => $total
            ]);
            
            $orderId = $conn->lastInsertId();
            
            // Insert order items
            $stmt = $conn->prepare("
                INSERT INTO order_items (
                    order_id, product_name, product_type, product_size, 
                    quantity, price, image_url
                ) VALUES (
                    :order_id, :product_name, :product_type, :product_size,
                    :quantity, :price, :image_url
                )
            ");
            
            foreach ($_SESSION['cart'] as $item) {
                $price_numeric = 0;
                if (is_numeric($item['price'])) {
                    $price_numeric = floatval($item['price']);
                } else {
                    preg_match('/[\d\.]+/', $item['price'], $matches);
                    $price_numeric = isset($matches[0]) ? floatval($matches[0]) : 0;
                }
                
                $stmt->execute([
                    ':order_id' => $orderId,
                    ':product_name' => $item['name'],
                    ':product_type' => $item['type'],
                    ':product_size' => $item['size'],
                    ':quantity' => $item['quantity'],
                    ':price' => $price_numeric,
                    ':image_url' => $item['image']
                ]);
            }
            
            $conn->commit();
            
            // Clear cart
            $_SESSION['cart'] = [];
            
            // Redirect to confirmation page
            header("Location: order-confirmation.php?order=$orderNumber");
            exit();
            
        } catch (PDOException $e) {
            if ($conn->inTransaction()) {
                $conn->rollBack();
            }
            $errors[] = 'Database error: ' . $e->getMessage();
        }
    }
}
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

/* ---------- DARK MODE ---------- */
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
body.dark .checkout-hero { background: #000; }
body.dark .order-summary { background: #222; }
body.dark footer { background: #222; }

/* ---------- CHECKOUT HERO ---------- */
.checkout-hero {
    height: 50vh;
    background: linear-gradient(rgba(0,0,0,0.85), rgba(0,0,0,0.85)), url('../images/checkout-bg.jpg');
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

.checkout-hero::before {
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

.checkout-hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    padding: 0 20px;
}

.checkout-hero h1 {
    font-size: 5rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -3px;
    margin-bottom: 20px;
    line-height: 0.9;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.checkout-hero p {
    font-size: 1.2rem;
    letter-spacing: 4px;
    text-transform: uppercase;
    opacity: 0.8;
    font-weight: 300;
}

/* ---------- CHECKOUT CONTAINER ---------- */
.checkout-container {
    width: 85%;
    max-width: 1100px;
    margin: 0 auto 100px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
}

.checkout-header {
    grid-column: 1 / -1;
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 2px solid var(--black);
}

.checkout-header h1 {
    font-size: 2rem;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: -1px;
}

.checkout-step {
    margin-bottom: 40px;
    position: relative;
    padding-left: 30px;
}

.checkout-step::before {
    content: '';
    position: absolute;
    left: 0;
    top: 10px;
    width: 12px;
    height: 12px;
    border: 2px solid var(--accent);
    border-radius: 50%;
    background: var(--bg);
}

.checkout-step.current::before {
    background: var(--accent);
}

.checkout-step h3 {
    font-size: 1.1rem;
    font-weight: 700;
    margin-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* ---------- FORM STYLES ---------- */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
    color: var(--text);
    opacity: 0.8;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 14px;
    background: var(--bg);
    border: 2px solid var(--grey);
    border-radius: 8px;
    color: var(--text);
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    transition: all 0.3s var(--transition);
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--accent);
    box-shadow: 0 0 0 3px rgba(255, 60, 0, 0.1);
}

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

/* Payment Methods */
.payment-methods {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 15px;
    margin-bottom: 30px;
}

.payment-option {
    position: relative;
}

.payment-option input[type="radio"] {
    position: absolute;
    opacity: 0;
}

.payment-option label {
    display: flex;
    align-items: center;
    padding: 15px;
    border: 2px solid var(--grey);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s var(--transition);
    background: var(--bg);
}

.payment-option label i {
    margin-right: 10px;
    font-size: 1.2rem;
    color: var(--accent);
}

.payment-option input[type="radio"]:checked + label {
    border-color: var(--accent);
    background: rgba(255, 60, 0, 0.05);
}

.payment-option input[type="radio"]:checked + label::after {
    content: '✓';
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--accent);
    font-weight: bold;
}

/* Card Details */
.card-details {
    background: var(--offwhite);
    padding: 25px;
    border-radius: 8px;
    margin-top: 20px;
    display: none;
}

.card-details.active {
    display: block;
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.card-row {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 20px;
}

.card-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--accent);
    font-size: 1.2rem;
}

/* ---------- ORDER SUMMARY ---------- */
.order-summary {
    background: var(--offwhite);
    padding: 40px;
    border: 2px solid var(--black);
    border-radius: 12px;
    box-shadow: 8px 8px 0px var(--black);
    position: sticky;
    top: 120px;
    height: fit-content;
}

.order-summary h3 {
    font-size: 1.3rem;
    font-weight: 800;
    margin-bottom: 30px;
    text-transform: uppercase;
    letter-spacing: -1px;
    padding-bottom: 15px;
    border-bottom: 2px solid var(--black);
}

.order-items {
    margin-bottom: 30px;
}

.order-item {
    display: grid;
    grid-template-columns: 60px 1fr auto;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid var(--grey);
}

.order-item:last-child {
    border-bottom: none;
}

.order-item-image img {
    width: 60px;
    height: 60px;
    object-fit: cover;
    border-radius: 4px;
    border: 1px solid var(--grey);
}

.order-item-details h5 {
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 5px;
    text-transform: uppercase;
}

.order-item-details p {
    font-size: 0.8rem;
    color: #888;
    margin-bottom: 3px;
}

.order-item-price {
    font-weight: 700;
    color: var(--accent);
    text-align: right;
}

.order-totals {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid var(--grey);
}

.total-row {
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
    font-size: 0.9rem;
}

.total-row.grand-total {
    font-size: 1.2rem;
    font-weight: 800;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid var(--black);
}

/* ---------- CHECKOUT BUTTON ---------- */
.checkout-btn {
    width: 100%;
    padding: 18px;
    background: var(--black);
    color: white;
    border: none;
    font-weight: 800;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s;
    margin-top: 30px;
    letter-spacing: 1px;
    font-size: 14px;
    border-radius: 8px;
    font-family: 'Poppins', sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    position: relative;
    overflow: hidden;
}

.checkout-btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.checkout-btn:hover::before {
    width: 300px;
    height: 300px;
}

.checkout-btn:hover {
    background: var(--accent);
    transform: translateY(-2px);
    box-shadow: 0 6px 0px var(--black);
}

.checkout-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

/* ---------- ERROR MESSAGES ---------- */
.error-messages {
    background: rgba(220, 53, 69, 0.1);
    border: 2px solid #dc3545;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 30px;
    grid-column: 1 / -1;
}

.error-messages h4 {
    color: #dc3545;
    font-size: 1rem;
    margin-bottom: 10px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.error-messages ul {
    list-style: none;
    padding-left: 0;
}

.error-messages li {
    color: #dc3545;
    font-size: 0.9rem;
    margin-bottom: 5px;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* ---------- SECURITY BADGE ---------- */
.security-badge {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid var(--grey);
    font-size: 0.8rem;
    color: #666;
}

.security-badge i {
    color: #10b981;
    font-size: 1.2rem;
}

/* ---------- MOBILE VIEW ---------- */
@media (max-width: 768px) {
    .checkout-container {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .checkout-hero h1 {
        font-size: 3rem;
    }
    
    .order-summary {
        position: static;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .payment-methods {
        grid-template-columns: 1fr;
    }
    
    .card-row {
        grid-template-columns: 1fr;
    }
}

/* ---------- ANIMATIONS ---------- */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.pulse {
    animation: pulse 2s infinite;
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
</style>
</head>

<body>

<div id="preloader">
  <div class="loader"></div>
  <p>Loading Checkout...</p>
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

<!-- Include Header -->
<?php require_once(__DIR__ . '/../includes/header.php'); ?>

<section class="checkout-hero">
  <div class="checkout-hero-content">
    <h1>SECURE<br>CHECKOUT</h1>
    <p>FINALIZE YOUR ARCHIVE</p>
  </div>
</section>

<section class="checkout-container">
    <?php if (!empty($errors)): ?>
    <div class="error-messages">
        <h4><i class="bi bi-exclamation-triangle"></i> Please fix the following errors:</h4>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    
    <div class="checkout-form">
        <div class="checkout-header">
            <h1>ARCHIVE INFORMATION</h1>
        </div>
        
        <form method="POST" id="checkoutForm">
            <!-- Step 1: Shipping Information -->
            <div class="checkout-step current">
                <h3><i class="bi bi-truck"></i> SHIPPING DETAILS</h3>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name *</label>
                        <input type="text" id="first_name" name="first_name" required 
                               value="<?php echo htmlspecialchars($_POST['first_name'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="last_name">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" required
                               value="<?php echo htmlspecialchars($_POST['last_name'] ?? ''); ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required
                           value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone Number *</label>
                    <input type="tel" id="phone" name="phone" required
                           value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                </div>
                
                <div class="form-group">
                    <label for="address">Street Address *</label>
                    <textarea id="address" name="address" rows="2" required><?php echo htmlspecialchars($_POST['address'] ?? ''); ?></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="city">City *</label>
                        <input type="text" id="city" name="city" required
                               value="<?php echo htmlspecialchars($_POST['city'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="postal_code">Postal Code *</label>
                        <input type="text" id="postal_code" name="postal_code" required
                               value="<?php echo htmlspecialchars($_POST['postal_code'] ?? ''); ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="country">Country</label>
                    <select id="country" name="country">
                        <option value="ZA" <?php echo ($_POST['country'] ?? 'ZA') === 'ZA' ? 'selected' : ''; ?>>South Africa</option>
                        <option value="US" <?php echo ($_POST['country'] ?? '') === 'US' ? 'selected' : ''; ?>>United States</option>
                        <option value="GB" <?php echo ($_POST['country'] ?? '') === 'GB' ? 'selected' : ''; ?>>United Kingdom</option>
                        <option value="AU" <?php echo ($_POST['country'] ?? '') === 'AU' ? 'selected' : ''; ?>>Australia</option>
                        <option value="DE" <?php echo ($_POST['country'] ?? '') === 'DE' ? 'selected' : ''; ?>>Germany</option>
                        <option value="FR" <?php echo ($_POST['country'] ?? '') === 'FR' ? 'selected' : ''; ?>>France</option>
                    </select>
                </div>
            </div>
            
            <!-- Step 2: Payment Method -->
            <div class="checkout-step">
                <h3><i class="bi bi-credit-card"></i> PAYMENT METHOD</h3>
                
                <div class="payment-methods">
                    <div class="payment-option">
                        <input type="radio" id="card" name="payment_method" value="card" checked 
                               <?php echo ($_POST['payment_method'] ?? 'card') === 'card' ? 'checked' : ''; ?>>
                        <label for="card">
                            <i class="bi bi-credit-card"></i>
                            Credit Card
                        </label>
                    </div>
                    
                    <div class="payment-option">
                        <input type="radio" id="paypal" name="payment_method" value="paypal"
                               <?php echo ($_POST['payment_method'] ?? '') === 'paypal' ? 'checked' : ''; ?>>
                        <label for="paypal">
                            <i class="bi bi-paypal"></i>
                            PayPal
                        </label>
                    </div>
                    
                    <div class="payment-option">
                        <input type="radio" id="eft" name="payment_method" value="eft"
                               <?php echo ($_POST['payment_method'] ?? '') === 'eft' ? 'checked' : ''; ?>>
                        <label for="eft">
                            <i class="bi bi-bank"></i>
                            Bank Transfer
                        </label>
                    </div>
                </div>
                
                <!-- Card Details (shown when credit card is selected) -->
                <div class="card-details active" id="cardDetails">
                    <div class="form-group">
                        <label for="card_number">Card Number</label>
                        <div style="position: relative;">
                            <input type="text" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" 
                                   pattern="[\d\s]{13,19}" maxlength="19">
                            <i class="bi bi-credit-card card-icon"></i>
                        </div>
                    </div>
                    
                    <div class="card-row">
                        <div class="form-group">
                            <label for="expiry">Expiry Date</label>
                            <input type="text" id="expiry" name="expiry" placeholder="MM/YY" 
                                   pattern="(0[1-9]|1[0-2])\/\d{2}">
                        </div>
                        
                        <div class="form-group">
                            <label for="cvc">CVC</label>
                            <input type="text" id="cvc" name="cvc" placeholder="123" 
                                   pattern="\d{3,4}" maxlength="4">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="card_name">Name on Card</label>
                        <input type="text" id="card_name" name="card_name" 
                               placeholder="As shown on card">
                    </div>
                </div>
            </div>
            
            <!-- Terms & Conditions -->
            <div class="form-group">
                <label style="display: flex; align-items: flex-start; gap: 10px; cursor: pointer;">
                    <input type="checkbox" required style="margin-top: 4px;">
                    <span style="font-size: 0.8rem;">
                        I agree to the <a href="terms.php" style="color: var(--accent);">Terms & Conditions</a> and 
                        <a href="privacy.php" style="color: var(--accent);">Privacy Policy</a>. 
                        I understand that all archive items are final sale and cannot be returned.
                    </span>
                </label>
            </div>
            
            <button type="submit" class="checkout-btn" id="submitBtn">
                <i class="bi bi-lock-fill"></i>
                <span>COMPLETE ARCHIVE PURCHASE</span>
                <span style="margin-left: 10px;">R <?php echo number_format($total, 2); ?></span>
            </button>
            
            <div class="security-badge">
                <i class="bi bi-shield-check"></i>
                <span>256-bit SSL Encrypted • Your information is secure</span>
            </div>
        </form>
    </div>
    
    <!-- Order Summary -->
    <div class="order-summary">
        <h3>YOUR ARCHIVE</h3>
        
        <div class="order-items">
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <div class="order-item">
                    <div class="order-item-image">
                        <img src="../<?php echo htmlspecialchars($item['image']); ?>" 
                             alt="<?php echo htmlspecialchars($item['name']); ?>"
                             onerror="this.onerror=null; this.src='../images/default-product.jpg'">
                    </div>
                    <div class="order-item-details">
                        <h5><?php echo htmlspecialchars($item['name']); ?></h5>
                        <p><?php echo htmlspecialchars(ucfirst($item['type'])); ?> • Size: <?php echo htmlspecialchars($item['size']); ?></p>
                        <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
                    </div>
                    <div class="order-item-price">
                        R <?php 
                            $price_numeric = 0;
                            if (is_numeric($item['price'])) {
                                $price_numeric = floatval($item['price']);
                            } else {
                                preg_match('/[\d\.]+/', $item['price'], $matches);
                                $price_numeric = isset($matches[0]) ? floatval($matches[0]) : 0;
                            }
                            echo number_format($price_numeric * $item['quantity'], 2);
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="order-totals">
            <div class="total-row">
                <span>Subtotal</span>
                <span>R <?php echo number_format($subtotal, 2); ?></span>
            </div>
            
            <div class="total-row">
                <span>Shipping</span>
                <span>FREE</span>
            </div>
            
            <div class="total-row">
                <span>VAT (15%)</span>
                <span>R <?php echo number_format($tax, 2); ?></span>
            </div>
            
            <div class="total-row grand-total">
                <span>TOTAL</span>
                <span>R <?php echo number_format($total, 2); ?></span>
            </div>
        </div>
        
        <a href="cart.php" class="continue-shopping" style="display: inline-flex; align-items: center; justify-content: center; margin-top: 20px; width: 100%; padding: 12px; border: 2px solid var(--black); background: transparent; color: var(--black); text-decoration: none; font-weight: 800; text-transform: uppercase; transition: all 0.3s; font-size: 12px; letter-spacing: 1px; border-radius: 6px; gap: 8px;">
            <i class="bi bi-arrow-left"></i>
            RETURN TO CART
        </a>
    </div>
</section>

<footer>
  <p>STREETS ARCHIVES — SOUTH AFRICA</p>
  <p>FASHION • SOUND • VISUAL RECORDS</p>
  <p>EST. 2026</p>
  <p><a href="privacy.php">Privacy</a> • <a href="shipping.php">Shipping</a> • <a href="returns.php">Returns</a> • <a href="contact.php">Contact</a></p>
</footer>

<button id="back-to-top">
  <i class="bi bi-chevron-up"></i>
</button>

<script>
// Payment method toggle
document.querySelectorAll('input[name="payment_method"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const cardDetails = document.getElementById('cardDetails');
        if (this.value === 'card') {
            cardDetails.style.display = 'block';
            setTimeout(() => cardDetails.classList.add('active'), 10);
        } else {
            cardDetails.classList.remove('active');
            setTimeout(() => {
                cardDetails.style.display = 'none';
            }, 300);
        }
    });
});

// Format card number
document.getElementById('card_number')?.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
    let formatted = value.replace(/(\d{4})/g, '$1 ').trim();
    e.target.value = formatted;
});

// Format expiry date
document.getElementById('expiry')?.addEventListener('input', function(e) {
    let value = e.target.value.replace(/\//g, '');
    if (value.length >= 2) {
        value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
    e.target.value = value;
});

// Form validation
document.getElementById('checkoutForm')?.addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="bi bi-arrow-repeat spin"></i> PROCESSING PAYMENT...';
    
    // Validate card details if paying by card
    const paymentMethod = document.querySelector('input[name="payment_method"]:checked')?.value;
    
    if (paymentMethod === 'card') {
        const cardNumber = document.getElementById('card_number').value.replace(/\s+/g, '');
        const expiry = document.getElementById('expiry').value;
        const cvc = document.getElementById('cvc').value;
        
        if (cardNumber.length < 13 || cardNumber.length > 19) {
            e.preventDefault();
            alert('Please enter a valid card number (13-19 digits)');
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
            return;
        }
        
        if (!/^(0[1-9]|1[0-2])\/\d{2}$/.test(expiry)) {
            e.preventDefault();
            alert('Please enter a valid expiry date (MM/YY)');
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
            return;
        }
        
        if (!/^\d{3,4}$/.test(cvc)) {
            e.preventDefault();
            alert('Please enter a valid CVC (3-4 digits)');
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalText;
            return;
        }
    }
    
    // Allow form submission
    return true;
});

// Back to top button
window.addEventListener('scroll', function() {
    const backToTop = document.getElementById('back-to-top');
    if (window.scrollY > 300) {
        backToTop.style.display = 'flex';
    } else {
        backToTop.style.display = 'none';
    }
});

document.getElementById('back-to-top')?.addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});

// Auto-save form data
const formFields = ['first_name', 'last_name', 'email', 'phone', 'address', 'city', 'postal_code'];
formFields.forEach(field => {
    const element = document.getElementById(field);
    if (element) {
        // Load saved data
        const saved = localStorage.getItem(`checkout_${field}`);
        if (saved && !element.value) {
            element.value = saved;
        }
        
        // Save on change
        element.addEventListener('input', function() {
            localStorage.setItem(`checkout_${field}`, this.value);
        });
    }
});

// Add spin animation
const style = document.createElement('style');
style.textContent = `
    .spin {
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
`;
document.head.appendChild(style);
</script>

<!-- Include main.js for hamburger menu -->
<script src="../js/main.js"></script>

</body>
</html>