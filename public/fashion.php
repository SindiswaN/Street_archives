<?php
$pageTitle = 'Fashion';
include 'main.php';
?>

<main>
    <section class="hero">
        <div class="hero-collage">
            <div class="stream s-fashion" style="background-image: url('images/image6.jpg'); flex: 1.4;"></div>
            <div class="stream s-media" style="background-image: url('images/image5.jpg');"></div>
            <div class="stream s-music" style="background-image: url('images/image1.jpg');"></div>
        </div>
        
        <div class="hero-content">
            <h1>FASHION<br>ARCHIVE</h1>
            <p class="tagline">Curated Vintage & Streetwear</p>
        </div>
    </section>
    
    <div class="folder-section show">
        <div class="folder-tab"><span>ARCHIVE_MANIFESTO</span></div>
        <div class="folder-body">
            <div class="folder-content">
                <div class="folder-text">
                    <h3>THE ARCHIVE PHILOSOPHY</h3>
                    <p>Every garment in our collection tells a story. We source from the streets, from private collections, and from forgotten corners of South Africa's urban landscape.</p>
                    <p>Our pieces are not just clothing—they're artifacts of culture, memory, and movement. Once a piece enters the archive, it's documented, preserved, and offered to those who understand its value.</p>
                    <p>No reproductions. No mass production. Each item is one-of-one, carrying the unique energy of its previous life while ready to write new chapters.</p>
                    <a href="/public/shop.php" class="btn">ENTER THE ARCHIVE</a>
                </div>
                <div class="folder-image">
                    <img src="images/image7.jpg" alt="Fashion Archive">
                </div>
            </div>
        </div>
    </div>
    
    <section class="process" style="margin-top: 0;">
        <h3>THE CURATORIAL PROCESS</h3>
        <ol>
            <li><strong>Sourcing:</strong> Hunting for authentic pieces in markets, thrift stores, and private collections across South Africa.</li>
            <li><strong>Authentication:</strong> Verifying age, origin, and condition of each garment.</li>
            <li><strong>Documentation:</strong> Photographing, measuring, and recording the story of each piece.</li>
            <li><strong>Preservation:</strong> Professional cleaning and minimal restoration when necessary.</li>
            <li><strong>Archiving:</strong> Adding to the digital archive with complete transparency about condition and history.</li>
        </ol>
    </section>
    
    <section class="products-grid">
        <div class="grid-header">
            <h2>CURRENT COLLECTION</h2>
        </div>
        
        <div class="products-grid-container">
            <!-- Same product grid as shop page -->
        </div>
        
        <div style="text-align: center; margin-top: 40px;">
            <a href="/public/shop.php" class="btn" style="padding: 15px 40px; font-size: 14px;">VIEW FULL ARCHIVE</a>
        </div>
    </section>
</main>

<script>
// Fashion page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Add any fashion-specific functionality here
});
</script>

<?php include 'footer.php'; ?>