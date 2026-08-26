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
        <a href="<?= $base_url ?>/pridat">Ako sa pridať</a>
        <!-- <a href="<?= $base_url ?>/pre-skautov">Skauti</a> -->
        <div class="nav-dropdown">
            <a href="#" class="nav-dropdown-toggle">Naše projekty</a>
            <div class="nav-dropdown-menu">
                <a href="https://minecraft.mustangy.sk/">MustangSMP</a>
                <a href="https://spevnik.mustangy.sk/">Spevník</a>
                <a href="<?= $base_url ?>/projekty/meshcore">Meshcore skupiny</a>
            </div>
        </div>
        <a href="<?= $base_url ?>/kontakt">Kontakt</a>
    </nav>
</header>

<script>
    // Skript pre otváranie a zatváranie mobilného menu
    document.getElementById('mobile-menu').addEventListener('click', function() {
        this.classList.toggle('is-active');
        document.getElementById('nav-menu').classList.toggle('active');
    });

    // Skript pre rozbalenie dropdown menu na mobile (na desktope funguje cez hover)
    document.querySelectorAll('.nav-dropdown-toggle').forEach(function(toggle) {
        toggle.addEventListener('click', function(e) {
            if (window.matchMedia('(max-width: 768px)').matches) {
                e.preventDefault();
                this.closest('.nav-dropdown').classList.toggle('open');
            }
        });
    });
</script>