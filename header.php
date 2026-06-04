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
    <?php
    $main_css_ver = file_exists(__DIR__ . '/style.css') ? filemtime(__DIR__ . '/style.css') : '1';
    ?>
    <link rel="stylesheet" href="<?= $base_url ?>/style.css?v=<?= $main_css_ver ?>">

    <!-- Podpora pre vlastné CSS špecifické pre podstránku -->
    <?php if (isset($custom_css) && is_array($custom_css)): ?>
        <?php foreach ($custom_css as $css): ?>
            <?php 
            $css_path = __DIR__ . '/' . ltrim($css, '/');
            $css_ver = file_exists($css_path) ? filemtime($css_path) : '1'; 
            ?>
            <link rel="stylesheet" href="<?= $base_url ?><?= htmlspecialchars($css) ?>?v=<?= $css_ver ?>">
        <?php endforeach; ?>
    <?php elseif (isset($custom_css)): ?>
        <?php 
        $css_path = __DIR__ . '/' . ltrim($custom_css, '/');
        $css_ver = file_exists($css_path) ? filemtime($css_path) : '1'; 
        ?>
        <link rel="stylesheet" href="<?= $base_url ?><?= htmlspecialchars($custom_css) ?>?v=<?= $css_ver ?>">
    <?php endif; ?>
</head>
<body>