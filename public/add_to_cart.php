<?php
// add_to_cart.php
require_once(__DIR__ . '/../app/config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $image = $_POST['image'] ?? '';
    $size = $_POST['size'] ?? 'M';
    $quantity = intval($_POST['quantity'] ?? 1);
    $type = $_POST['type'] ?? 'fashion';
    
    // Check if item already exists in cart
    $item_exists = false;
    foreach ($_SESSION['cart'] as &$item) {
        if ($item['product_id'] === $product_id && $item['size'] === $size) {
            $item['quantity'] += $quantity;
            $item_exists = true;
            break;
        }
    }
    
    // Add new item if not exists
    if (!$item_exists) {
        $_SESSION['cart'][] = [
            'product_id' => $product_id,
            'name' => $name,
            'price' => $price,
            'image' => $image,
            'size' => $size,
            'quantity' => $quantity,
            'type' => $type
        ];
    }
    
    // Calculate total cart count
    $cart_count = getCartCount();
    
    echo json_encode([
        'success' => true,
        'cartCount' => $cart_count,
        'message' => 'Item added to cart'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method'
    ]);
}
?>