<?php
session_start();
require_once(__DIR__ . '/config.php');

header('Content-Type: application/json');

// Initialize cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $image = $_POST['image'] ?? '';
    $size = $_POST['size'] ?? 'One Size';
    $quantity = intval($_POST['quantity'] ?? 1);
    $type = $_POST['type'] ?? 'fashion';
    
    // Generate a unique item key
    $itemKey = $productId . '_' . $size . '_' . $type;
    
    // Check if item already exists in cart
    $itemExists = false;
    $itemIndex = -1;
    
    foreach ($_SESSION['cart'] as $index => $item) {
        $existingKey = $item['product_id'] . '_' . $item['size'] . '_' . $item['type'];
        if ($existingKey === $itemKey) {
            $itemExists = true;
            $itemIndex = $index;
            break;
        }
    }
    
    if ($itemExists) {
        // Update quantity if item exists
        $_SESSION['cart'][$itemIndex]['quantity'] += $quantity;
    } else {
        // Add new item
        $_SESSION['cart'][] = [
            'product_id' => $productId,
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'size' => $size,
            'quantity' => $quantity,
            'type' => $type
        ];
    }
    
    // Calculate total cart count
    $cartCount = 0;
    foreach ($_SESSION['cart'] as $item) {
        $cartCount += $item['quantity'];
    }
    
    echo json_encode([
        'success' => true,
        'cartCount' => $cartCount,
        'cartItems' => count($_SESSION['cart']),
        'message' => 'Item added to cart successfully'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method'
    ]);
}
?>