<?php
// config.php
session_start();

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'streets_archives');
define('DB_USER', 'root');
define('DB_PASS', '');

// Include database connection
require_once 'database.php';

// Initialize database connection
$database = new Database();
$db = $database->getConnection();

// Initialize cart if not exists
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Get cart count
function getCartCount() {
    $count = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $count += $item['quantity'];
        }
    }
    return $count;
}

// Helper function to display cart count
function displayCartCount() {
    echo getCartCount();
}

// Get products from database (Fashion items)
function getFashionProducts() {
    global $db;
    
    $query = "SELECT 
                p.*, 
                c.name as category_name,
                pi.image_url
              FROM products p
              LEFT JOIN categories c ON p.category_id = c.id
              LEFT JOIN product_images pi ON p.id = pi.product_id AND pi.is_primary = 1
              WHERE p.is_digital = 0 AND p.is_active = 1
              ORDER BY p.created_at DESC";
    
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get music products from database
function getMusicProducts() {
    global $db;
    
    $query = "SELECT * FROM music_tracks WHERE is_active = 1 ORDER BY created_at DESC";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get categories from database
function getCategories() {
    global $db;
    
    $query = "SELECT * FROM categories WHERE is_active = 1 ORDER BY display_order";
    $stmt = $db->prepare($query);
    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Get product by ID from database
function getProductById($id) {
    global $db;
    
    $query = "SELECT 
                p.*, 
                c.name as category_name,
                GROUP_CONCAT(pi.image_url) as all_images,
                GROUP_CONCAT(ps.size_label) as available_sizes
              FROM products p
              LEFT JOIN categories c ON p.category_id = c.id
              LEFT JOIN product_images pi ON p.id = pi.product_id
              LEFT JOIN product_sizes ps ON p.id = ps.product_id AND ps.stock_quantity > 0
              WHERE p.id = :id AND p.is_active = 1
              GROUP BY p.id";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Add sample products to database if needed
function initializeSampleProducts() {
    global $db;
    
    // Check if products table is empty
    $query = "SELECT COUNT(*) as count FROM products";
    $stmt = $db->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['count'] == 0) {
        // Add your sample products here
        // You can copy from your old $products array
    }
}
?>