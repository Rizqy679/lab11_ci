<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h3>Artikel Terkini</h3>
<ul>
    <?php if (!empty($artikel)): ?>
        <?php foreach ($artikel as $item): ?>
            <li><a href="<?= base_url('artikel/' . $item['id']) ?>"><?= esc($item['judul']) ?></a></li>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Tidak ada artikel dalam kategori ini.</p>
    <?php endif; ?>
</ul>

</body>
</html>

