<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>
<!-- konten -->
 <article class="bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4"><?= esc($artikel['judul']); ?></h2>

    <?php if ($artikel['gambar']): ?>
        <img src="<?= base_url('uploads/' . $artikel['gambar']) ?>" width="400" height="250" alt="<?= esc($artikel['judul']); ?>" class="mb-4 rounded">
    <?php endif; ?>

    <p class="text-gray-700 leading-relaxed"><?= esc($artikel['isi']); ?></p>
</article>
<?= $this->endSection() ?>