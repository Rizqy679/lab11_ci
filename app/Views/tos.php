<!-- resources/views/about.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet"  href="{{ asset('style.css') }}">
</head>
<body>
    <?= $this->include('template/header'); ?>
        <h1><?= $title ?></h1>
        <hr>
        <p><?= $content ?></p>
        <?= $this->include('template/footer'); ?>
</body>
</html>
