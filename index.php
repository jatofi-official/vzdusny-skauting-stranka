<?php
if (file_exists('db.php')) {
    require_once 'db.php';
}
$page_title = "Vzdušný Skauting - Hlavná stránka";
include 'header.php';
include 'navigation.php';
?>

    <div class="hero-bg-band">
        <section class="hero-container">
            <div class="hero-arch">
                <div class="hero-content">
                    <span class="overline">Vzdušní skauti</span>
                    <h1>Nebojíme sa techniky</h1>
                    <a href="<?= $base_url ?>/pridat" class="btn">Pridaj sa k nám</a>
                </div>
            </div>
        </section>
    </div>
        
    <section class="our-program-section">
        <h2>Náš program</h2>
        <div class="program-grid">
            <div class="program-card">
                <h3>Letecký program</h3>
                <p>Letectvo, letecké simulátory, rádio-komunikácia a základy meteorológie, spotting.</p>
            </div>
            <div class="program-card">
                <h3>RC & Modelárstvo</h3>
                <p>Lietanie dronov, modelárskych lietadiel, FPV, spájkovanie, simulátory RC lietania.</p>
            </div>
            <div class="program-card">
                <h3>Vesmírny program</h3>
                <p>Hvezdárstvo a astrofotografia, odpaľovanie rakiet, astrofyzika, simulovanie vesmírnych misií.</p>
            </div>
            <div class="program-card">
                <h3>STEM program</h3>
                <p>3D modelovanie a 3D tlač, elektronika, mikrokontroléry a družinové hackathony.</p>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="about-grid">
            <div>
                <h2>O skautingu</h2>
                <p>Skauting je dobrovoľné, nepolitické, výchovné hnutie pre mladých ľudí ktoré funguje od roku 1907. Naším cieľom je pomôcť mladým ľuďom dosiahnuť ich plný fyzický, intelektuálny, sociálny a duchovný potenciál.</p>
            </div>
            <div>
                <h2>Vzdušný skauting</h2>
                <p>Vzdušný skauting pridáva k tračinému skautingu moderný program, zameraný na techniku a vzdušné či vesmírne aktivity. Patria medzi nás piloti vetroňov, dronov, modelárskych lietadiel, ale rovnako aj makeri, a skauti, ktorí sa neboja moderných technológií.</p>
            </div>
        </div>
    </section>

    <main class="container">
        <!-- Card 1: Program (Links to your existing index.php) -->
        <div class="card">
            <img src="images/bsd-1.jpg" alt="Skautský program" loading="lazy">
            <div class="card-body">
                <h3>Program</h3>
                <p>Prehľad všetkých našich skautských výziev, odboriek a voľných programových modulov.</p>
                <a href="<?= $base_url ?>/program/index.php" class="link-btn">Program</a>
            </div>
        </div>

        <!-- Card 2: Ako sa pridať -->
        <div class="card">
            <img src="images/mapi-aura.jpg" alt="Ako sa pridať k skautom" loading="lazy">
            <div class="card-body">
                <h3>Ako sa pridať</h3>
                <p>Zaujíma ťa program, ktorý ponúkame? Môžeš sa stať vzdušným skautom aj vo vlastnom zbore.</p>
                <a href="<?= $base_url ?>/pridat" class="link-btn">Zisti viac</a>
            </div>
        </div>

        <!-- Card 3: Pre skautov -->
        <div class="card">
            <img src="images/papagaje-crazy.jpg" alt="Informácie pre skautov" loading="lazy">
            <div class="card-body">
                <h3>Pre vzdušných skautov</h3>
                <p>Materiály, aktuality a praktické informácie pre našich členov.</p>
                <!-- <a href="<?= $base_url ?>/pre-skautov.php" class="link-btn">Zóna</a> -->
            </div>
        </div>
    </main>

    <section class="stats-section">
        <div class="stat-box">
            <div class="stat-number">15+</div>
            <div class="stat-label">Vzdušných skautov</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">3</div>
            <div class="stat-label">zbory s vzdušnými skautmi</div>
        </div>
    </section>

    <?php include 'footer.php'; ?>