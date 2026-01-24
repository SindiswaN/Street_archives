<?php
// update_cart.php
session_start();
require_once(__DIR__ . '/../app/config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_POST['index'] ?? '';
    $quantity = intval($_POST['quantity'] ?? 1);
    
    if (!isset($_SESSION['cart']) || !isset($_SESSION['cart'][$index])) {
        echo json_encode(['success' => false, 'error' => 'Item not found in cart']);
        exit;
    }
    
    if ($quantity < 1) $quantity = 1;
    
    // Update the quantity
    $_SESSION['cart'][$index]['quantity'] = $quantity;
    
    // Calculate total cart count
    $cartCount = 0;
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
    }
    
    echo json_encode([
        'success' => true,
        'cartCount' => $cartCount
    ]);
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid request method']);
}
?>