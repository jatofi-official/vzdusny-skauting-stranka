<?php
if (file_exists('../../db.php')) {
    require_once '../../db.php';
}
$page_title = "Meshcore skupiny - Vzdušný Skauting";
include '../../header.php';
include '../../navigation.php';
?>

<div class="hero-bg-band" style="padding-bottom: 20px;">
    <div class="hero-container">
        <div class="hero-content" style="text-align: left; padding: 20px 0; max-width: 800px; margin: 0 auto;">
            <span class="overline">Náš projekt</span>
            <h1 style="font-size: 2.5rem;">Skautská Meshcore skupina</h1>
        </div>
    </div>
</div>

<div style="max-width: 800px; margin: 0 auto; padding: 0 20px 50px 20px;">

    <h2>Čo je Meshcore</h2>
    <p>Meshcore je open-source protokol pre diaľkovú komunikáciu postavený na LoRa (Long Range) rádiových sieťach, určený predovšetkým na spoľahlivú textovú komunikáciu bez internetu a mobilnej siete. Beží vo voľnom ISM pásme, takže na jeho prevádzku nie je potrebný amatérsky rádiový preukaz ani licencia. Na rozdiel od podobných systémov (napr. Meshtastic), kde správu ďalej prenáša každé zariadenie v dosahu, Meshcore rozlišuje role zariadení: bežné (companion) zariadenia správy iba odosielajú a prijímajú, kým ich prenos medzi vzdialenejšími bodmi zabezpečujú dedikované repeatre. Trasu k cieľu si sieť navyše zapamätá po prvom úspešnom doručení, takže ďalšie správy sa už neposielajú plošne všetkými smermi, ale efektívne po overenej ceste - vďaka tomu je sieť menej zaťažená a dosah sa dá rozširovať pridávaním repeatrov aj tam, kde bežný mobilný signál nedosiahne.</p>

    <h2>Aktuálne nastavenie na Slovensku</h2>
    <p>Slovenskú Meshcore sieť prevádzkuje a koordinuje komunita okolo stránky <a href="https://mesh.om3kff.sk/">mesh.om3kff.sk</a>, kde sú zverejnené aktuálne nastavenia či odporúčaný hardvér. Od 8. augusta 2026 sieť beží na preddefinovanom profile "Slovakia" s týmito parametrami:</p>
    <ul>
        <li>Frekvencia: <strong>869,618 MHz</strong></li>
        <li>Šírka pásma: <strong>62,5 kHz</strong></li>
        <li>Spreading Factor: <strong>7</strong></li>
        <li>Coding Rate: <strong>5</strong></li>
    </ul>
    <p>Aby zariadenie fungovalo správne s ostatnými na Slovensku, musí mať zhodné nastavenie. Zariadenie sa nakonfiguruje cez <a href="https://flasher.meshcore.io">MeshCore Flasher</a> (firmvér "Companion radio Bluetooth") a následne sa ovláda cez mobilnú aplikáciu MeshCore (Android/iOS).</p>

    <h2>Náš kanál</h2>
    <p>Vzdušný skauting používa na Meshcore vlastný hashtag kanál <strong>#skauting</strong>, určený na komunikáciu naprieč celým Slovenskom - napríklad počas výprav, táborov alebo vo voľnom čase.</p>

    <p>Kanál sa pridáva priamo v aplikácii MeshCore:</p>
    <ol>
        <li>V aplikácii otvoriť menu (ikona ⋮).</li>
        <li>Vybrať možnosť <strong>Add Channel</strong>.</li>
        <li>Zvoliť <strong>Join Hashtag Channel</strong>.</li>
        <li>Zadať názov kanála <strong>skauting</strong> a potvrdiť.</li>
    </ol>

    <p>Aby správy zbytočne nezaťažovali celú sieť (vrátane susedných krajín) a doručovali sa spoľahlivejšie, odporúča sa pre kanál nastaviť aj <strong>Region scope</strong> na <strong>sk</strong>:</p>
    <ol>
        <li>V menu kanála zvoliť <strong>Set Region Scope</strong>.</li>
        <li>Kliknúť na (+).</li>
        <li>Zadať región <strong>sk</strong> a potvrdiť.</li>
    </ol>

    <p>Aktivitu na kanáli #skauting, podobne ako celú Meshcore sieť, je možné sledovať na živej mape <a href="https://map.meshcore.hu/#/home">map.meshcore.hu</a>.</p>

</div>

<?php include '../../footer.php'; ?>
