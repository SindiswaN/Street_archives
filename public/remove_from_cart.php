<?php
// remove_from_cart.php - FIXED VERSION
session_start();

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json; charset=utf-8');

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get the index
        $index = isset($_POST['index']) ? intval($_POST['index']) : -1;
        
        // Initialize cart if not exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        
        // Check if index exists
        if ($index < 0 || $index >= count($_SESSION['cart'])) {
            throw new Exception('Item not found in cart');
        }
        
        // Remove item from cart
        array_splice($_SESSION['cart'], $index, 1);
        
        // Calculate total cart count
        $cartCount = 0;
        $subtotal = 0;
        foreach ($_SESSION['cart'] as $item) {
            $cartCount += $item['quantity'];
            // Calculate subtotal if price is in format "R 999"
            $price = preg_replace('/[^0-9]/', '', $item['price']);
            $subtotal += intval($price) * $item['quantity'];
        }
        
        // Return success
        echo json_encode([
            'success' => true,
            'cartCount' => $cartCount,
            'cartItems' => count($_SESSION['cart']),
            'subtotal' => 'R ' . $subtotal,
            'message' => 'Item removed from cart'
        ]);
        
    } catch (Exception $e) {
        // Return error
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    }
} else {
    // Not a POST request
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method'
    ]);
}

exit;
?>