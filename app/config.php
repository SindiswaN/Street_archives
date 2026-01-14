<?php
// config.php
session_start();

// Database configuration (optional - for future expansion)
define('DB_HOST', 'localhost');
define('DB_NAME', 'streets_archives');
define('DB_USER', 'root');
define('DB_PASS', '');

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

// Product data
$products = [
    '014' => [
        'id' => '014',
        'name' => 'ARCHIVE PIECE #014',
        'price' => 'R 799',
        'price_numeric' => 799,
        'location' => 'Johannesburg',
        'condition' => '8/10 - Excellent Vintage',
        'material' => '100% Cotton Denim',
        'description' => 'Found in a vintage shop in Johannesburg. This piece carries the energy of the city\'s underground scene. Original condition with minimal wear, perfect for collectors of authentic street culture.',
        'images' => ['image5.jpg', 'image2.jpg', 'image7.jpg', 'image1.jpg'],
        'category' => 'jackets',
        'type' => 'fashion'
    ],
    '027' => [
        'id' => '027',
        'name' => 'ARCHIVE PIECE #027',
        'price' => 'R 899',
        'price_numeric' => 899,
        'location' => 'Cape Town',
        'condition' => '9/10 - Near Mint',
        'material' => 'Vintage Poly-Cotton Blend',
        'description' => 'Recovered from a private collection in Cape Town. This item shows minimal signs of wear and maintains its original character. A true piece of South African street history.',
        'images' => ['image2.jpg', 'image5.jpg', 'image6.jpg', 'image3.jpg'],
        'category' => 'shirts',
        'type' => 'fashion'
    ],
    '089' => [
        'id' => '089',
        'name' => 'ARCHIVE PIECE #089',
        'price' => 'R 999',
        'price_numeric' => 999,
        'location' => 'Pretoria',
        'condition' => '7/10 - Good Vintage',
        'material' => 'Heavyweight Canvas',
        'description' => 'Discovered in Pretoria\'s vintage markets. This piece has character and tells a story of urban exploration. Unique detailing and authentic wear patterns.',
        'images' => ['image7.jpg', 'image1.jpg', 'image4.jpg', 'image5.jpg'],
        'category' => 'jackets',
        'type' => 'fashion'
    ],
    '156' => [
        'id' => '156',
        'name' => 'ARCHIVE PIECE #156',
        'price' => 'R 1099',
        'price_numeric' => 1099,
        'location' => 'Durban',
        'condition' => '8/10 - Excellent',
        'material' => 'Vintage Wool Blend',
        'description' => 'Sourced from Durban\'s coastal vintage scene. This piece has been carefully preserved and shows the unique style of coastal South African fashion.',
        'images' => ['image1.jpg', 'image7.jpg', 'image3.jpg', 'image6.jpg'],
        'category' => 'jackets',
        'type' => 'fashion'
    ],
    '201' => [
        'id' => '201',
        'name' => 'ARCHIVE PIECE #201',
        'price' => 'R 849',
        'price_numeric' => 849,
        'location' => 'Soweto',
        'condition' => '7/10 - Good',
        'material' => 'Cotton Blend',
        'description' => 'Found in Soweto markets. Authentic streetwear with urban heritage.',
        'images' => ['image6.jpg', 'image2.jpg', 'image4.jpg'],
        'category' => 'shirts',
        'type' => 'fashion'
    ],
    '045' => [
        'id' => '045',
        'name' => 'ARCHIVE PIECE #045',
        'price' => 'R 949',
        'price_numeric' => 949,
        'location' => 'Port Elizabeth',
        'condition' => '8/10 - Excellent',
        'material' => 'Denim',
        'description' => 'Coastal vintage find with unique fading patterns.',
        'images' => ['image3.jpg', 'image5.jpg', 'image7.jpg'],
        'category' => 'pants',
        'type' => 'fashion'
    ]
];

// Music products
$musicProducts = [
    'music001' => [
        'id' => 'music001',
        'name' => 'UNDERGROUND FREQUENCIES',
        'price' => 'R 150',
        'price_numeric' => 150,
        'description' => 'Mixed by Archive Crew • WAV + MP3 Download',
        'images' => ['image5.jpg'],
        'type' => 'music'
    ],
    'music002' => [
        'id' => 'music002',
        'name' => 'URBAN ECHOES',
        'price' => 'R 120',
        'price_numeric' => 120,
        'description' => 'Night Shift • WAV + MP3 Download',
        'images' => ['image7.jpg'],
        'type' => 'music'
    ],
    'music003' => [
        'id' => 'music003',
        'name' => 'COASTAL WAVES',
        'price' => 'R 100',
        'price_numeric' => 100,
        'description' => 'Coastal Frequencies • WAV + MP3 Download',
        'images' => ['image1.jpg'],
        'type' => 'music'
    ],
    'music004' => [
        'id' => 'music004',
        'name' => 'BASEMENT SESSIONS',
        'price' => 'R 180',
        'price_numeric' => 180,
        'description' => 'Various Artists • WAV + MP3 Download',
        'images' => ['image3.jpg'],
        'type' => 'music'
    ]
];

// Helper function to get product by ID
function getProductById($id) {
    global $products, $musicProducts;
    
    if (isset($products[$id])) {
        return $products[$id];
    } elseif (isset($musicProducts[$id])) {
        return $musicProducts[$id];
    }
    
    return null;
}

// Helper function to show cart count
function displayCartCount() {
    echo getCartCount();
}
?>