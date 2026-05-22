<?php
require_once 'db.php';

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

function parse_markdown($text) {
    // 1. Basic Bold/Italic
    $text = preg_replace('/\*\*(.*?)\*\*/u', '<strong>$1</strong>', $text);
    $text = preg_replace('/\*([^\*]+)\*/u', '<em>$1</em>', $text);
    $text = preg_replace('/_([^_]+)_/u', '<em>$1</em>', $text);

    // 2. Headers
    $text = preg_replace('/^### (.*)$/m', '<h3>$1</h3>', $text);

    // 3. Handle Lists
    $text = preg_replace('/^\s*[\-\•]\s+(.*)$/m', '<li class="sub-item">$1</li>', $text);
    $text = preg_replace('/^\d+\.\s+(.*)$/m', '<li class="main-item">$1</li>', $text);

    // 4. Wrap List items in <ol>
    $text = preg_replace('/((?:<li.*?>.*?<\/li>\s*)+)/s', '<ol class="badge-list">$1</ol>', $text);

    // 5. Paragraph Handling - Split by double newlines
    $parts = explode("\n\n", $text);
    foreach ($parts as &$part) {
        $part = trim($part);
        // If it's not a block element, wrap in <p>
        if (!preg_match('/^<(h3|ol|li|ul)/', $part) && strlen($part) > 0) {
            $part = '<p>' . nl2br($part) . '</p>';
        }
    }
    $text = implode("\n", $parts);

    return $text;
}

$full_html = parse_markdown($content);

$name = $vyzva['name'];
$image_path = "img/vyzvy/" . $name . ".png";
$placeholder = "img/placeholder/vyzva.png";
$display_img = file_exists($image_path) ? $image_path : $placeholder;
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($name) ?> - Výzva</title>
    <link href="https://fonts.googleapis.com/css2?family=Georama:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
    <style>
        /* Base styles */
        body, p, li {
            font-family: 'Georama', sans-serif;
            font-size: 14px;
            line-height: 21px;
            font-weight: normal;
            color: #000000;
        }

        body { background: #fff; margin: 0; padding: 40px 10px; }
        .container { max-width: 1000px; margin: 0 auto; }
        
        /* Main Name Heading */
        h1.page-title { 
            font-family: 'Georama', 'TheSans', 'Roboto', sans-serif !important;
            font-weight: 600;
            color: #00b5e2 !important;
            text-align: left; 
            font-size: 32px; 
            margin-bottom: 20px;
        }

        /* Subheadings (### parts) */
        h3 { 
            font-family: 'Georama', 'TheSans', 'Roboto', sans-serif !important;
            font-weight: 600;
            color: #00b5e2 !important;
            font-size: 24px; 
            margin-top: 0; 
        }

        .row { display: flex; flex-wrap: wrap; margin-bottom: 0px; align-items: flex-start; }
        .text-col { flex: 0 0 70%; max-width: 70%; padding-right: 30px; box-sizing: border-box; }
        .img-col { flex: 0 0 30%; max-width: 30%; text-align: center; }
        .img-col img { width: 100%; max-width: 150px; padding: 10px; }

        .content-area { text-align: justify; }
        .content-area ol, .content-area ul { padding-left: 25px; margin-top: 10px; }
        .content-area li { margin-bottom: 2px; }
        
        /* Markdown Italics (em) styling */
        em { 
            color: #666; 
            font-style: italic; 
            display: block;      /* Allows the margin to push elements below it */
            margin-bottom: 10px; /* The 20px gap you requested */
        }

        .img-placeholder { width: 200px; height: 200px; background: #f9f9f9; display: inline-flex; align-items: center; justify-content: center; font-size: 11px; color: #ccc; border: 1px dashed #ddd; }
        
        @media (max-width: 768px) {
            .text-col, .img-col { flex: 0 0 100%; max-width: 100%; padding-right: 0; }
            .img-col { order: -1; margin-bottom: 20px; }
        }

/* Reset list defaults */
.badge-list {
    padding-left: 20px;
    list-style: none; /* We handle numbering/bullets manually for better control */
    counter-reset: item;
}

/* Style for 1. 2. 3. */
.main-item {
    counter-increment: item;
    position: relative;

    margin-top: 2px; /* Space between main points */
}
.main-item::before {
    content: counter(item) ". ";
    position: absolute;
    left: -20px;
}

/* Style for - sub points*/
.sub-item {
    margin-left: 20px;
    margin-top: 2px;
    font-weight: normal;
    display: flex;          
    align-items: flex-start; /* Keeps bullet at the top of the first line */
}

.sub-item::before {
    content: "• ";
    color: #00b5e2;
    padding-right: 8px;
    flex-shrink: 0;         /* Prevents the bullet from squishing */
}


    </style>
</head>
<body>

<div class="container">
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
</body>

</body>
</html>

