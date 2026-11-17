<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= htmlspecialchars($article['name']) ?></h1>
    <p><?= nl2br(htmlspecialchars($article['text'])) ?></p>
    <p><strong>Автор: <?= htmlspecialchars($author['nickname']) ?></strong></p>
<?php include __DIR__ . '/../footer.php'; ?>
