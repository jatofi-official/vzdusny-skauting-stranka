<?php
if (!isset($base_url)) {
    $base_url = '';
}
?>
<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Vzdušný Skauting'; ?></title>
    
    <!-- Brand Manual Font: Georama -->
    <link href="https://fonts.googleapis.com/css2?family=Georama:wght@400;600;800&display=swap" rel="stylesheet">
    <!-- Prepojíme externý CSS súbor. Použitá absolútna cesta, aby fungoval aj z priečinkov ako /program -->
    <link rel="stylesheet" href="<?= $base_url ?>/style.css">

    <!-- Podpora pre vlastné CSS špecifické pre podstránku -->
    <?php if (isset($custom_css) && is_array($custom_css)): ?>
        <?php foreach ($custom_css as $css): ?>
            <link rel="stylesheet" href="<?= $base_url ?><?= htmlspecialchars($css) ?>">
        <?php endforeach; ?>
    <?php elseif (isset($custom_css)): ?>
        <link rel="stylesheet" href="<?= $base_url ?><?= htmlspecialchars($custom_css) ?>">
    <?php endif; ?>
</head>
<body>