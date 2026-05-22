<?php
require_once 'db.php';

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


function parse_markdown($text) {
    // 1. Basic Bold/Italic
    $text = preg_replace('/\*\*(.*?)\*\*/u', '<strong>$1</strong>', $text);
    $text = preg_replace('/\*([^\*]+)\*/u', '<em>$1</em>', $text);
    $text = preg_replace('/_([^_]+)_/u', '<em>$1</em>', $text);

    // 2. Handle Sub-points (lines starting with - or bullet)
    // We wrap them in a span or a sub-list style so they don't break the main list
    $text = preg_replace('/^\s*[\-\•]\s+(.*)$/m', '<li class="sub-item">$1</li>', $text);

    // 3. Handle Main Numbered Points (1., 2. etc)
    $text = preg_replace('/^\d+\.\s+(.*)$/m', '<li class="main-item">$1</li>', $text);

    // 4. Wrap the whole block in an ordered list if it contains list items
    if (strpos($text, '<li') !== false) {
        // We wrap the groups. To keep it simple and avoid the "one big list" bug:
        $text = "<ol class='badge-list'>" . $text . "</ol>";
    }

    // 5. CRITICAL: Remove extra whitespace between tags BEFORE nl2br
    // This removes the empty lines that usually sit between 1. and 2.
    $text = preg_replace('/>\s+<li/u', '><li', $text);
    $text = preg_replace('/<\/li>\s+<li/u', '</li><li', $text);

    // 6. Final newline conversion for the text that isn't in a list
    // $text = nl2br(trim($text));

    // 7. Cleanup: nl2br often puts <br> inside the list tags where they don't belong
    $text = str_replace(["<ol class='badge-list'><br />", "</li><br />"], ["<ol class='badge-list'>", "</li>"], $text);

    return $text;
}

$green_html = parse_markdown(get_part($content, 'Zelený stupeň'));
$red_html   = parse_markdown(get_part($content, 'Červený stupeň'));

$name = $odborka['name'];
$green_img = "img/" . $name . "_zelený.png";
$red_img   = "img/" . $name . "_červený.png";
$placeholder = "img/placeholder/" . $odborka['type'] . ".png";
?>

<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($name) ?> - Odborka</title>
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
            margin-bottom: 50px; 
            text-transform: uppercase;
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
        .img-col img { width: 100%; max-width: 200px; padding: 10px; }

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
	<div class=content-area">
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

</body>
</html>

