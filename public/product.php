<?php
// ================== DEBUG (REMOVE LATER) ==================
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// ==========================================================

// Page title
$pageTitle = 'Product';

// Includes
require_once(__DIR__ . '/../app/config.php');
require_once(__DIR__ . '/../app/database.php');

// Database connection
$db = (new Database())->getConnection();



// Get product ID
$productId = $_GET['id'] ?? '014';

// Fetch product
$stmt = $db->prepare("SELECT * FROM products WHERE id = :id");
$stmt->execute(['id' => $productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    header('Location: fashion.php');
    exit;
}

// Decode images JSON
$product['images'] = json_decode($product['images'], true);

// Fetch related products (same category, exclude current)
$stmt = $db->prepare("
    SELECT * FROM products 
    WHERE category = :category AND id != :id 
    LIMIT 4
");
$stmt->execute([
    'category' => $product['category'],
    'id' => $product['id']
]);
$relatedProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<!-- ================= PRELOADER ================= -->
<div id="preloader">
    <div class="loader"></div>
    <p>Loading Archive...</p>
</div>

<!-- ================= HEADER ================= -->
<header class="site-header">
    <a href="shop.php" class="logo">STREETS ARCHIVES</a>
</header>

<!-- ================= PRODUCT SECTION ================= -->
<main class="product-page">

    <section class="product-gallery">
        <img 
            id="mainImage"
            src="images/<?= htmlspecialchars($product['images'][0]) ?>"
            alt="<?= htmlspecialchars($product['name']) ?>"
        >

        <div class="thumbnail-row">
            <?php foreach ($product['images'] as $img): ?>
                <img 
                    src="images/<?= htmlspecialchars($img) ?>"
                    onclick="changeImage(this.src)"
                    alt="Thumbnail"
                >
            <?php endforeach; ?>
        </div>
    </section>

    <section class="product-info">
        <h1><?= htmlspecialchars($product['name']) ?></h1>
        <p class="price"><?= htmlspecialchars($product['price_display']) ?></p>

        <ul class="details">
            <li><strong>Location:</strong> <?= htmlspecialchars($product['location']) ?></li>
            <li><strong>Condition:</strong> <?= htmlspecialchars($product['condition']) ?></li>
            <li><strong>Material:</strong> <?= htmlspecialchars($product['material']) ?></li>
        </ul>

        <p class="description">
            <?= nl2br(htmlspecialchars($product['description'])) ?>
        </p>

        <button class="add-to-cart">Add to Cart</button>
    </section>

</main>

<!-- ================= RELATED PRODUCTS ================= -->
<?php if (!empty($relatedProducts)): ?>
<section class="related-products">
    <h2>Related Pieces</h2>

    <div class="product-grid">
        <?php foreach ($relatedProducts as $rp): 
            $imgs = json_decode($rp['images'], true);
        ?>
            <a href="product.php?id=<?= $rp['id'] ?>" class="product-card">
                <img src="images/<?= htmlspecialchars($imgs[0]) ?>" alt="">
                <h3><?= htmlspecialchars($rp['name']) ?></h3>
                <p><?= htmlspecialchars($rp['price_display']) ?></p>
            </a>
        <?php endforeach; ?>
    </div>
</section>
<?php endif; ?>

<!-- ================= FOOTER ================= -->
<footer class="site-footer">
    <p>&copy; <?= date('Y') ?> Streets Archives</p>
</footer>

<!-- ================= SCRIPTS ================= -->
<script>
function changeImage(src) {
    document.getElementById('mainImage').src = src;
}

// Hide preloader when page fully loads
window.addEventListener('load', function () {
    const preloader = document.getElementById('preloader');
    if (preloader) {
        preloader.style.opacity = '0';
        setTimeout(() => preloader.style.display = 'none', 500);
    }
});
</script>

</body>
</html>
