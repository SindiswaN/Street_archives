<?php
// add_to_cart.php
session_start();
require_once(__DIR__ . '/../app/config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = $_POST['product_id'] ?? '';
    $name = $_POST['name'] ?? '';
    $price = $_POST['price'] ?? '';
    $image = $_POST['image'] ?? '';
    $size = $_POST['size'] ?? 'M';
    $quantity = intval($_POST['quantity'] ?? 1);
    $type = $_POST['type'] ?? 'fashion';
    
    // Add item to cart session
    $cartItem = [
        'id' => $productId,
        'name' => $name,
        'price' => $price,
        'image' => $image,
        'size' => $size,
        'quantity' => $quantity,
        'type' => $type
    ];
    
    $_SESSION['cart'][] = $cartItem;
    
    echo json_encode([
        'success' => true,
        'cartCount' => count($_SESSION['cart'] ?? [])
    ]);
}
?>