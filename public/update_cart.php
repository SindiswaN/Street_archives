<?php
// update_cart.php
require_once(__DIR__ . '/../app/config.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = intval($_POST['index'] ?? -1);
    $quantity = intval($_POST['quantity'] ?? 1);
    
    if (isset($_SESSION['cart'][$index]) && $quantity > 0) {
        $_SESSION['cart'][$index]['quantity'] = $quantity;
        
        echo json_encode([
            'success' => true
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Invalid item or quantity'
        ]);
    }
}
?>