<?php
require_once '../db.php';
require_once '../markdown.php';

// --- 1. Fetch Single VPM ---
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM vpm WHERE id = ?");
$stmt->execute([$id]);
$vpm = $stmt->fetch();

if (!$vpm) {
    die("VPM sa nenašlo.");
}

// --- 3. Content Parsing Logic ---
$content = $vpm['description'];

$full_html = parse_markdown($content);

$commentary_html = !empty($vpm['commentary']) ? parse_markdown($vpm['commentary']) : '';

$name = $vpm['name'];
$image_path = "img/vpm/" . $name . ".png";
$placeholder = "img/placeholder/vpm.png";
$display_img = file_exists($image_path) ? $image_path : $placeholder;

$page_title = $name . " - VPM";
$custom_css = ['/program/program.css'];
include '../header.php';
include '../navigation.php';
?>

<div class="detail-container">
    <h1 class="page-title"><?= htmlspecialchars($name) ?></h1>

    <div class="row">
        <div class="text-col">
            <div class="content-area">
                <?= $full_html ?>
            </div>
        </div>

        <div class="img-col">
            <img src="<?= htmlspecialchars($display_img) ?>" alt="<?= htmlspecialchars($name) ?>">
        </div>
    </div>

    <?php if ($commentary_html): ?>
    <details class="commentary">
        <summary>Autorský komentár</summary>
        <div class="content-area">
            <?= $commentary_html ?>
        </div>
    </details>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
<?php include '../footer.php'; ?>
