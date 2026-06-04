<?php
require_once '../db.php';
require_once '../markdown.php';

// --- 1. Fetch Single Odborka ---
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM odborky WHERE id = ?");
$stmt->execute([$id]);
$odborka = $stmt->fetch();

if (!$odborka) {
    die("Odborka sa nenašla.");
}

// --- 3. Content Parsing Logic ---
$content = $odborka['description'];

function get_part($full_text, $header_pattern) {
    $parts = preg_split('/### (Zelený stupeň|Červený stupeň)/u', $full_text, -1, PREG_SPLIT_DELIM_CAPTURE);
    foreach ($parts as $key => $value) {
        if (trim($value) == $header_pattern) {
            return isset($parts[$key + 1]) ? trim($parts[$key + 1]) : '';
        }
    }
    return '';
}


$green_html = parse_markdown(get_part($content, 'Zelený stupeň'));
$red_html   = parse_markdown(get_part($content, 'Červený stupeň'));

$name = $odborka['name'];
$green_img = "img/odborky/" . $name . "_zelený.png";
$red_img   = "img/odborky/" . $name . "_červený.png";
$placeholder = "img/placeholder/" . $odborka['type'] . ".png";

$page_title = $name . " - Odborka";
$custom_css = ['/program/program.css'];
include '../header.php';
include '../navigation.php';
?>

<div class="detail-container">
    <h1 class="page-title"><?= htmlspecialchars($name) ?></h1>
	<div class="content-area">
	<p>Ak si splnil niektoré body v minulosti, nemusíš ich plniť znova, rátajú sa ti ako splnené. Môžeš si takto uznať najviac polovicu úloh, podľa tvojho výberu.</p>
	</div>
    <?php if ($green_html): ?>
    <div class="row">
        <div class="text-col">
            <h3>Zelený stupeň</h3>
            <div class="content-area">
                <?= $green_html ?>
            </div>
        </div>
        <div class="img-col">
            <?php if (file_exists($green_img)): ?>
                <img src="<?= htmlspecialchars($green_img) ?>" alt="Zelený stupeň">
            <?php else: ?>
                <img src="<?= htmlspecialchars($placeholder) ?>" alt="Zelený stupeň">
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if ($red_html): ?>
    <div class="row">
        <div class="text-col">
            <h3>Červený stupeň</h3>
            <div class="content-area">
                <?= $red_html ?>
            </div>
        </div>
        <div class="img-col">
            <?php if (file_exists($red_img)): ?>
                <img src="<?= htmlspecialchars($red_img) ?>" alt="Červený stupeň">
            <?php else: ?>
                <img src="<?= htmlspecialchars($placeholder) ?>" alt="Červený stupeň">
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
<h3>Prečo si nemôžem započítať všetky body z minulosti?</h3>
<p>Pravidlo o uznaní najviac polovice bodov z minulosti existuje z dôvodu, aby si pri každej odborke musel spraviť niečo extra, aby si ju získal. Body odborky sú preto navrhnuté spôsobom, kde väčšina úloh vyžaduje nejakú konkrétnu aktivitu na splnenie. Keď sa aj vyskytne úloha ohľadom nejakej znalosti, častokrát ju vyžaduje konkrétnym spôsobom preukázať, napríklad vysvetlením (družine, kamarátovi, správcovi výziev atď.) alebo inou formou. Predchádzajú sa tým situáciam, kde by si sa iba pozrel na odborku a zistil že si vlastne všetky body v minulosti splnil.</p>
<p>Na získanie odborky je potrebné dodržať toto pravidlo, nedá sa obísť. Je to na tvojej cti, že si ho dodržal.</p>
</div>

<?php include 'footer.php'; ?>
<?php include '../footer.php'; ?>

</body>
</html>
