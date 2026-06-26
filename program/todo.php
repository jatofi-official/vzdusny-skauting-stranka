<?php
session_start();
require_once '../db.php';

// --- 1. Anonymous visitor token (cookie), used to stop duplicate likes ---
if (!isset($_COOKIE['visitor_token'])) {
    $visitor_token = bin2hex(random_bytes(16));
    setcookie('visitor_token', $visitor_token, time() + 5 * 365 * 24 * 60 * 60, '/');
} else {
    $visitor_token = $_COOKIE['visitor_token'];
}

// --- 2. Handle like / unlike submission (POST -> redirect, avoids resubmission on refresh) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['like_id'])) {
    $like_id = (int)$_POST['like_id'];
    $stmt = $pdo->prepare("SELECT id FROM todo_likes WHERE todo_item_id = ? AND user_token = ?");
    $stmt->execute([$like_id, $visitor_token]);
    if ($stmt->fetch()) {
        $stmt = $pdo->prepare("DELETE FROM todo_likes WHERE todo_item_id = ? AND user_token = ?");
        $stmt->execute([$like_id, $visitor_token]);
    } else {
        $stmt = $pdo->prepare("INSERT IGNORE INTO todo_likes (todo_item_id, user_token) VALUES (?, ?)");
        $stmt->execute([$like_id, $visitor_token]);
    }
    header('Location: todo.php#item-' . $like_id);
    exit;
}

// --- 2b. Handle new programme suggestion (capped at 50 submissions per session) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['suggestion'])) {
    if (!isset($_SESSION['suggestion_count'])) {
        $_SESSION['suggestion_count'] = 0;
    }
    $suggestion_text = trim($_POST['suggestion']);
    if ($suggestion_text !== '' && $_SESSION['suggestion_count'] < 50) {
        $stmt = $pdo->prepare("INSERT INTO programme_suggestions (suggestion) VALUES (?)");
        $stmt->execute([$suggestion_text]);
        $_SESSION['suggestion_count']++;
        $_SESSION['suggestion_message'] = 'Ďakujeme za tvoj návrh!';
    } elseif ($_SESSION['suggestion_count'] >= 50) {
        $_SESSION['suggestion_message'] = 'Dosiahol si limit 50 návrhov za jedno sedenie.';
    }
    header('Location: todo.php#suggest');
    exit;
}

$suggestion_message = $_SESSION['suggestion_message'] ?? null;
unset($_SESSION['suggestion_message']);
$suggestion_limit_reached = ($_SESSION['suggestion_count'] ?? 0) >= 50;

// --- 3. Fetch data ---
$stmt = $pdo->query("
    SELECT
        ti.id, ti.type, ti.name, ti.speciality_id, ti.status, ti.graphics_status,
        s.full_name AS speciality_name,
        COUNT(tl.id) AS like_count,
        MAX(CASE WHEN tl.user_token = " . $pdo->quote($visitor_token) . " THEN 1 ELSE 0 END) AS liked_by_me
    FROM todo_items ti
    LEFT JOIN specialities s ON s.id = ti.speciality_id
    LEFT JOIN todo_likes tl ON tl.todo_item_id = ti.id
    GROUP BY ti.id
    ORDER BY ti.name ASC
");
$all_items = $stmt->fetchAll();

$odborky_items = array_values(array_filter($all_items, fn($i) => $i['type'] === 'odborka'));
$vyzvy_items   = array_values(array_filter($all_items, fn($i) => $i['type'] === 'vyzva'));
$moduly_items  = array_values(array_filter($all_items, fn($i) => $i['type'] === 'modul'));

function status_class($status) {
    $map = [
        'nezačaté'     => 'status-none',
        'čiastočne'    => 'status-partial',
        'bez nášivky'  => 'status-nopatch',
        'hotové'       => 'status-done',
    ];
    return $map[$status] ?? 'status-none';
}

function render_section($title, $items) {
    ?>
    <h2 class="todo-section-title"><?= htmlspecialchars($title) ?></h2>
    <?php if (!$items): ?>
        <p class="content-area" style="text-align:center;">Momentálne sa na ničom nepracuje.</p>
        <?php return; ?>
    <?php endif; ?>
    <div class="todo-list">
        <div class="todo-row todo-row-header">
            <div class="todo-col-name">Názov</div>
            <div class="todo-col-speciality">Špecializácia</div>
            <div class="todo-col-status">Obsah</div>
            <div class="todo-col-status">Grafika</div>
            <div class="todo-col-like"></div>
        </div>
        <?php foreach ($items as $item): ?>
            <div class="todo-row" id="item-<?= (int)$item['id'] ?>">
                <div class="todo-col-name todo-item-name"><?= htmlspecialchars($item['name']) ?></div>
                <div class="todo-col-speciality">
                    <?php if (!empty($item['speciality_name'])): ?>
                        <span class="todo-speciality"><?= htmlspecialchars($item['speciality_name']) ?></span>
                    <?php endif; ?>
                </div>
                <div class="todo-col-status" data-label="Obsah">
                    <span class="todo-status-badge <?= status_class($item['status']) ?>"><?= htmlspecialchars($item['status']) ?></span>
                </div>
                <div class="todo-col-status" data-label="Grafika">
                    <span class="todo-status-badge <?= status_class($item['graphics_status']) ?>"><?= htmlspecialchars($item['graphics_status']) ?></span>
                </div>
                <div class="todo-col-like">
                    <form method="post" class="todo-like-form">
                        <input type="hidden" name="like_id" value="<?= (int)$item['id'] ?>">
                        <button type="submit" class="todo-like-btn <?= $item['liked_by_me'] ? 'liked' : '' ?>" title="<?= $item['liked_by_me'] ? 'Zrušiť like' : 'Páči sa mi to' ?>">
                            <?= $item['liked_by_me'] ? '❤' : '♡' ?> <?= (int)$item['like_count'] ?>
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}

$page_title = "Čo sa pripravuje - Program";
$custom_css = ['/program/program.css'];
include '../header.php';
include '../navigation.php';
?>

<div class="detail-container">
    <p class="todo-back-link"><a href="index.php">&larr; Späť na zoznam odboriek a výziev</a></p>
    <h1 class="page-title">Čo sa pripravuje</h1>
    <div class="content-area">
        <p>Tu nájdeš zoznam odboriek, výziev a voľných programových modulov, na ktorých sa momentálne pracuje, a v akom sú stave.</p>
    </div>

    <?php render_section('Odborky', $odborky_items); ?>
    <?php render_section('Výzvy', $vyzvy_items); ?>
    <?php render_section('Voľné programové moduly', $moduly_items); ?>

    <div class="todo-suggest" id="suggest">
        <h2 class="todo-section-title">Navrhni nový program</h2>
        <div class="content-area">
            <p>Máš nápad na novú odborku, výzvu alebo programový modul? Napíš nám ho.</p>
        </div>
        <?php if ($suggestion_message): ?>
            <p class="todo-suggest-message"><?= htmlspecialchars($suggestion_message) ?></p>
        <?php endif; ?>
        <?php if (!$suggestion_limit_reached): ?>
            <form method="post" class="todo-suggest-form">
                <textarea name="suggestion" maxlength="500" rows="3" placeholder="Tvoj návrh..." required></textarea>
                <button type="submit">Odoslať návrh</button>
            </form>
        <?php else: ?>
            <p class="todo-suggest-message">Dosiahol si limit 50 návrhov za jedno sedenie.</p>
        <?php endif; ?>
    </div>
</div>

<?php include 'footer.php'; ?>
<?php include '../footer.php'; ?>
