<?php
// remove_from_cart.php
require_once 'config.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = intval($_POST['index'] ?? -1);
    
    if (isset($_SESSION['cart'][$index])) {
        array_splice($_SESSION['cart'], $index, 1);
        
        echo json_encode([
            'success' => true
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => 'Item not found in cart'
        ]);
    }
}
?>