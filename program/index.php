<?php
require_once '../db.php';

// --- 1. Fetch Data ---
$stmt = $pdo->query("SELECT id, name, speciality, type FROM odborky ORDER BY speciality ASC");
$items = $stmt->fetchAll();

$stmt_vyzvy = $pdo->query("SELECT id, name FROM vyzvy ORDER BY name ASC");
$vyzvy = $stmt_vyzvy->fetchAll();

$page_title = "Program - Odborky a Výzvy";
$custom_css = ['/program/program.css'];
include '../header.php';
include '../navigation.php'; 

?>

    <h1 class="page-header">Odborky</h1>

    <div class="badge-grid-container">
        <?php foreach ($items as $item): 
            $cleanName = $item['name'];
            $fileNameBase = $item['name']; // Helpful for file system safety
            
            $green = "img/odborky/" . $fileNameBase . "_zelený.png";
            $red   = "img/odborky/" . $fileNameBase . "_červený.png";
            $placeholder = "img/placeholder/" . $item['type'] . ".png";
            

            if (file_exists($green)) {
                $imgPath = $green;
            } elseif (file_exists($red)) {
                $imgPath = $red;
            } else {
                $imgPath = $placeholder;
            }
        ?>
            <a href="odborka.php?id=<?php echo $item['id']; ?>" class="badge-card">
		        <div class="icon-wrapper">
		            <img src="<?= htmlspecialchars($imgPath) ?>" alt="<?= htmlspecialchars($cleanName) ?>" loading="lazy">
		        </div>
                
                <div class="title">
                    <strong><?= htmlspecialchars($cleanName) ?></strong>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <h1 class="page-header">Výzvy</h1>

    <div class="badge-grid-container">
        <?php foreach ($vyzvy as $item): 
            $cleanName = $item['name'];
            $fileNameBase = $item['name']; // Helpful for file system safety
            
            $image_path = "img/vyzvy/" . $fileNameBase . ".png";
            $placeholder = "img/placeholder/vyzva.png";
            
            if (file_exists($image_path)) {
                $imgPath = $image_path;
            } else {
                $imgPath = $placeholder;
            }
        ?>
            <a href="vyzva.php?id=<?php echo $item['id']; ?>" class="badge-card">
		        <div class="icon-wrapper no-border">
		            <img src="<?= htmlspecialchars($imgPath) ?>" alt="<?= htmlspecialchars($cleanName) ?>" loading="lazy">
		        </div>
                
                <div class="title">
                    <strong><?= htmlspecialchars($cleanName) ?></strong>
                </div>
            </a>
        <?php endforeach; ?>
    </div>

    <p style="text-align:center; margin-top: 30px;"><a href="todo.php">Čo sa pripravuje &rarr;</a></p>

    <?php include 'footer.php'; ?>
    <?php include '../footer.php'; ?>
