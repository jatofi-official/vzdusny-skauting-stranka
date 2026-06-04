<?php
if (file_exists('../db.php')) {
    require_once '../db.php';
}
$page_title = "Ako sa pridať - Vzdušný Skauting";
include '../header.php';
include '../navigation.php';
?>

<div class="hero-bg-band" style="padding-bottom: 20px;">
    <section class="hero-container" style="min-height: auto; padding-top: 40px;">
        <div class="hero-content" style="padding: 40px 20px; color: white;">
            <h1 style="color: var(--slsk-yellow); text-transform: uppercase; font-weight: 800; font-size: 3rem; margin-bottom: 20px; line-height: 1.1;">Ako sa pridať?</h1>
            <p style="font-size: 1.2rem; max-width: 800px; margin: 0 auto; line-height: 1.6;">Láka ťa svet techniky, letectva a dobrodružstva? Vzdušným skautom sa môžeš stať bez ohľadu na to, či si v skautingu vyrastal, alebo o ňom počuješ prvýkrát.</p>
        </div>
    </section>
</div>

<section class="about-section">
    <div class="about-grid">
        
        <!-- Sekcia: Už som skaut -->
        <div style="background: var(--bg-light); padding: 40px; border-radius: 16px;">
            <h2>Už som skaut</h2>
            <p>Ak ťa to čo robíme zaujalo, si už automaticky tak na 80% vzdušný skaut. Nemusíš meniť zbor, prestupovať, ani nič zložito riešiť. Vzdušný skauting funguje ako programová nadstavba, môžeš sa stať vzdušným skautom priamo vo svojom vlastnom zbore.</p>
            
            <h3 style="color: var(--slsk-light-blue); margin-top: 30px; font-weight: 700; text-transform: uppercase; font-size: 1.2rem;">Čo z toho máš?</h3>
            <ul style="padding-left: 20px; margin-top: 10px; color: var(--text-dark);">
                <li style="margin-bottom: 10px;">Máš možnosť plniť naše odborky, výzvy a voľné programové moduly, ktoré nájdeš na <a href = "<?= $base_url ?>/program">tomto webe</a>.</li>
                <li style="margin-bottom: 10px;">Máme fancy <strong>zelenú</strong> rovnošatu, ktorá stojí zlomok klasickej.</li>
                <li style="margin-bottom: 10px;">Organizujeme <strong>akcie a stretnutia</strong>, kde sa vieš stretnúť s podobne zameranými skautami.</li>
                <li style="margin-bottom: 10px;">Uprimne? Masívnu auru.</li>
            </ul>
            
            <h3 style="color: var(--slsk-light-blue); margin-top: 30px; font-weight: 700; text-transform: uppercase; font-size: 1.2rem;">Aký je postup?</h3>
            <p>Jednoducho sa pridaj do nášho discordu. Tam sa dozvieš viac informácií, čo robíme, kde si môžeš kúpiť rovnošatu a podobne.</p>
            <a href="https://discord.gg/EGw9fns67v" class="btn" style="margin-top: 20px; font-size: 0.9rem; padding: 12px 25px;">Náš discord</a>
        </div>

        <!-- Sekcia: Ešte nie som skaut -->
        <div style="background: var(--bg-light); padding: 40px; border-radius: 16px;">
            <h2>Ešte nie som skaut</h2>
            <p>Ak ťa baví technika, drony, vesmír alebo letectvo a v skautingu si nikdy nebol, toto je tvoja brána dnu. Spájame technológie s partiou a skautskými hodnotami. Zameriavame sa hlavne na mladých v skautskom a rangerskom veku (tj. 13-17), pre mladšie deti zatiaľ, žiaľ, nemáme kapacitu.</p>
            
            <h3 style="color: var(--slsk-light-blue); margin-top: 30px; font-weight: 700; text-transform: uppercase; font-size: 1.2rem;">Ako to funguje?</h3>
            <p>Aby si sa stal skautom, musíš sa pridať do existujúceho zboru. Skautských zborov je na slovensku množstvo, no iba niektoré majú vzdušných skautov. Aktuálne otvárame v sepembri vzdušnoskautskú družinu v <strong>Bratislave</strong> - na Bilgyme.</p>
            
            <h3 style="color: var(--slsk-light-blue); margin-top: 30px; font-weight: 700; text-transform: uppercase; font-size: 1.2rem;">Aký je postup?</h3>
            <p>Kontaktuj nás. Prihoď info o tom, odkiaľ si, koľko máš rokov a čo ťa z nášho programu najviac chytilo. Ďalej ťa nasmerujeme. Keď sa chceš pridať do novej družiny v sepembri, napíš <strong>Bruttovi</strong>. Ak to nie je to, čo hľadáš, nezúfaj, napíš <strong>Jakovi</strong> a niečo ti možno vieme nájsť.</p>
            <a href="<?= $base_url ?>/kontakt" class="btn" style="margin-top: 20px; font-size: 0.9rem; padding: 12px 25px;">Kontakt</a>
        </div>

    </div>
</section>

    <?php include '../footer.php'; ?>