<?php
if (file_exists('../db.php')) {
    require_once '../db.php';
}
$page_title = "Kontakt - Vzdušný Skauting";
$custom_css = ['/kontakt/kontakt.css'];
include '../header.php';
include '../navigation.php';
?>

<div class="kontakt-container">
    <h1 style="text-align: center; color: var(--slsk-dark-blue); margin-top: 20px; text-transform: uppercase; font-weight: 800; font-size: 2.5rem;">Náš Tím</h1>

    <!-- Grid s profilmi -->
    <div class="team-grid">
        
        <div class="team-card">
            <img src="https://picsum.photos/300/300?random=3" alt="Profilová fotka" class="profile-img">
            <h3 class="name">Išmael</h3>
            <h4 class="full-name">Samuel Štaudt</h4>
            <p class="role">Zakladateľ</p>
        </div>
        
        <div class="team-card">
            <img src="https://picsum.photos/300/300?random=1" alt="Profilová fotka" class="profile-img">
            <h3 class="name">Jakoo</h3>
            <h4 class="full-name">Jakub Hlavatý</h4>
            <p class="role">Vedúci programovej rady<br>Komunikácia</p>

            <div class="contact-info">
                <a href="mailto:email1@skauting.sk">jakubo.hlavaty@gmail.com</a>
            </div>
        </div>
        
    </div>

</div>

<section class="about-section">
    <div class="about-grid">
        <div>
            <h2>Viac o nás</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <p>Phasellus egestas tellus rutrum tellus pellentesque eu tincidunt tortor. Amet nisl suscipit adipiscing bibendum est ultricies integer. In tellus integer feugiat scelerisque varius morbi enim. Ornare quam viverra orci sagittis eu. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus ornare.</p>
        </div>
    </div>
</section>

<?php include '../footer.php'; ?>

</body>
</html>