<?php
echo "<h2>Testing PDO Database Connection</h2>";

// Test 1: Check if PDO exists
if (class_exists('PDO')) {
    echo "✅ PDO class exists<br>";
} else {
    echo "❌ PDO class not found<br>";
    exit;
}

// Test 2: Try to include database.php
require_once 'C:/Users/ppeac/Desktop/Street_archives/app/database.php';
echo "✅ database.php loaded<br>";

// Test 3: Create database connection
try {
    $database = new Database();
    $db = $database->getConnection();
    echo "✅ Database connection successful<br>";
    
    // Test 4: Query products table
    $stmt = $db->query("SHOW TABLES LIKE 'products'");
    if ($stmt->rowCount() > 0) {
        echo "✅ 'products' table exists<br>";
    } else {
        echo "❌ 'products' table does NOT exist<br>";
    }
    
    // Test 5: Count products
    $stmt = $db->query("SELECT COUNT(*) as count FROM products");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "✅ Products in database: " . $row['count'] . "<br>";
    
} catch (PDOException $e) {
    echo "❌ Database error: " . $e->getMessage() . "<br>";
    
    // Show detailed error
    echo "<pre>";
    print_r($e);
    echo "</pre>";
}

echo '<hr>';
echo '<a href="product.php?id=1">Test product page with ID 1</a><br>';
echo '<a href="product.php">Test product page without ID</a>';
?>