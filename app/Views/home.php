<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<h1><?= $title; ?></h1>
<hr>
<p><?= $content; ?></p>
<h2>Artikel Terbaru</h2>
<?= view_cell('App\Cells\ArtikelTerkini::render', ['kategori' => 'Umum']) ?>

<?= $this->endSection() ?>
