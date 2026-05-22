<?php
require_once 'db.php';

// --- 1. Fetch Data ---
$stmt = $pdo->query("SELECT id, name, speciality, type FROM odborky ORDER BY speciality ASC");
$items = $stmt->fetchAll();

$stmt_vyzvy = $pdo->query("SELECT id, name FROM vyzvy ORDER BY name ASC");
$vyzvy = $stmt_vyzvy->fetchAll();
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odborky</title>
    <style>
        body { 
            font-family: "Open Sans", Arial, sans-serif; 
            background-color: #ffffff; 
            color: #444;
            margin: 0;
            padding: 50px 10px;
        }

        h1 { 
            text-align: center; 
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 50px; 
        }

        /* The Grid */
        .grid-container {

            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 30px;
            margin: 10em;
        }

        /* The Individual Card (Matches vc_column-inner) */
        .card {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Circle Image Wrapper (Matches vc_box_outline_circle) */
        .icon-wrapper {
            width: 160px;
            height: 160px;
            border: 2px solid #ebebeb; /* vc_box_border_grey */
            border-radius: 50%;        /* vc_box_outline_circle */
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color 0.3s ease;
            margin-bottom: 16px;       /* Matches tdi_664 space */
        }

        .icon-wrapper.no-border {
            border: 2px solid transparent;
            border-radius: 0;
            height: auto;
        }

        .icon-wrapper img {
            max-width: 95%;
            max-height: 95%;
            object-fit: contain;
            border-radius: 50%;
        }

        .icon-wrapper.no-border img {
            border-radius: 0;
            max-height: none;
        }

        /* Title Styling (Matches the <p><strong> Čitateľ ) */
        .title {
            font-size: 18px;
            color: #222;
            font-weight: 700;
            margin-top: 0;
            padding: 0 10px;
            line-height: 1.3;
        }

        /* Decoration line similar to the source spacing */
        .card::after {
            content: "";
            display: block;
            height: 26px; /* Matches tdi_666 space */
        }
    </style>
</head>
<body>

    <h1>Odborky</h1>

    <div class="grid-container">
        <?php foreach ($items as $item): 
            $cleanName = $item['name'];
            $fileNameBase = $item['name']; // Helpful for file system safety
            
            $green = "img/" . $fileNameBase . "_zelený.png";
            $red   = "img/" . $fileNameBase . "_červený.png";
            $placeholder = "img/placeholder/" . $item['type'] . ".png";
            

            if (file_exists($green)) {
                $imgPath = $green;
            } elseif (file_exists($red)) {
                $imgPath = $red;
            } else {
                $imgPath = $placeholder;
            }
        ?>
            <div class="card">
            	<a href="odborka.php?id=<?php echo $item['id']; ?>">
		        <div class="icon-wrapper">
		            <img src="<?= htmlspecialchars($imgPath) ?>" alt="<?= htmlspecialchars($cleanName) ?>" loading="lazy">
		        </div>
                </a>
                
                <div class="title">
                    <strong><?= htmlspecialchars($cleanName) ?></strong>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h1>Výzvy</h1>

    <div class="grid-container">
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
            <div class="card">
            	<a href="vyzva.php?id=<?php echo $item['id']; ?>">
		        <div class="icon-wrapper no-border">
		            <img src="<?= htmlspecialchars($imgPath) ?>" alt="<?= htmlspecialchars($cleanName) ?>" loading="lazy">
		        </div>
                </a>
                
                <div class="title">
                    <strong><?= htmlspecialchars($cleanName) ?></strong>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</body>
