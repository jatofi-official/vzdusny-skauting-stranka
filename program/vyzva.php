<?php
require_once '../db.php';
require_once '../markdown.php';

// --- 1. Fetch Single Odborka ---
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$stmt = $pdo->prepare("SELECT * FROM vyzvy WHERE id = ?");
$stmt->execute([$id]);
$vyzva = $stmt->fetch();

if (!$vyzva) {
    die("Výzva sa nenašla.");
}

// --- 3. Content Parsing Logic ---
$content = $vyzva['description'];

$full_html = parse_markdown($content);

$name = $vyzva['name'];
$image_path = "img/vyzvy/" . $name . ".png";
$placeholder = "img/placeholder/vyzva.png";
$display_img = file_exists($image_path) ? $image_path : $placeholder;

$page_title = $name . " - Výzva";
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
</div>

<?php include 'footer.php'; ?>
<?php include '../footer.php'; ?>
