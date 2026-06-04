<header>
    <a href="<?= $base_url ?>/index.php" class="logo" style="text-decoration: none;">
        <img src="<?= $base_url ?>/logo.svg" alt="Vzdušný Skauting Logo">
        <div class="logo-text">Vzdušný skauting</div>
    </a>
    
    <!-- Hamburger ikona pre mobilné zariadenia -->
    <div class="menu-toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>

    <nav id="nav-menu">
        <a href="<?= $base_url ?>/program/index.php">Program</a>
        <a href="<?= $base_url ?>/ako-sa-pridat.php">Ako sa pridať</a>
        <a href="<?= $base_url ?>/pre-skautov.php">Skauti</a>
        <a href="<?= $base_url ?>/kontakt.php">Kontakt</a>
    </nav>
</header>

<script>
    // Skript pre otváranie a zatváranie mobilného menu
    document.getElementById('mobile-menu').addEventListener('click', function() {
        this.classList.toggle('is-active');
        document.getElementById('nav-menu').classList.toggle('active');
    });
</script>