<?php
// remove_from_cart.php
session_start();
require_once(__DIR__ . '/../app/config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_POST['index'] ?? '';
    
    if (!isset($_SESSION['cart']) || !isset($_SESSION['cart'][$index])) {
        echo json_encode(['success' => false, 'error' => 'Item not found in cart']);
        exit;
    }
    
    // Remove item from cart
    array_splice($_SESSION['cart'], $index, 1);
    
    // Re-index the array to prevent gaps
    $_SESSION['cart'] = array_values($_SESSION['cart']);
    
    // Calculate total cart count
    $cartCount = 0;
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
    }
    
    echo json_encode([
        'success' => true,
        'cartCount' => $cartCount,
        'cartItems' => count($_SESSION['cart'])
    ]);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>