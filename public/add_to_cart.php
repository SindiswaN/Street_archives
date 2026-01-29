<?php
// app/add_to_cart.php - SIMPLE WORKING VERSION

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Set JSON header
header('Content-Type: application/json');

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Check if POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get POST data
        $productId = isset($_POST['product_id']) ? trim($_POST['product_id']) : '';
        $name = isset($_POST['name']) ? trim($_POST['name']) : '';
        $price = isset($_POST['price']) ? trim($_POST['price']) : '';
        $image = isset($_POST['image']) ? trim($_POST['image']) : '';
        $size = isset($_POST['size']) ? trim($_POST['size']) : 'One Size';
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
        $type = isset($_POST['type']) ? trim($_POST['type']) : 'fashion';
        
        // Validate required fields
        if (empty($productId) || empty($name) || empty($price)) {
            throw new Exception('Missing required fields');
        }
        
        // Create unique key
        $itemKey = $productId . '_' . $size . '_' . $type;
        
        // Check if item exists
        $itemFound = false;
        foreach ($_SESSION['cart'] as &$item) {
            $existingKey = $item['product_id'] . '_' . $item['size'] . '_' . $item['type'];
            if ($existingKey === $itemKey) {
                $item['quantity'] += $quantity;
                $itemFound = true;
                break;
            }
        }
        
        // Add new item if not found
        if (!$itemFound) {
            $_SESSION['cart'][] = [
                'product_id' => $productId,
                'name' => $name,
                'price' => $price,
                'image' => $image,
                'size' => $size,
                'quantity' => $quantity,
                'type' => $type,
                'added_at' => date('Y-m-d H:i:s')
            ];
        }
        
        // Calculate total items
        $cartCount = 0;
        foreach ($_SESSION['cart'] as $item) {
            $cartCount += $item['quantity'];
        }
        
        // Return success
        echo json_encode([
            'success' => true,
            'cartCount' => $cartCount,
            'cartItems' => count($_SESSION['cart']),
            'message' => 'Item added to cart'
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
        'error' => 'Invalid request method. Use POST.'
    ]);
}

exit;
?>