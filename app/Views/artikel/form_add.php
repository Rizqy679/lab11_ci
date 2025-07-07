<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?></title>
    <style>
        input[type='text'], input[type='file'], textarea, select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 10px;
        }
        .btn {
            background-color: blue;
            color: white;
            padding: 8px 20px;
            border: none;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<?= $this->include('template/admin_header'); ?>

    <h2><?= esc($title); ?></h2>

    <?php if (!empty($validation)): ?>
        <div class="error">
            <?= $validation->listErrors(); ?>
        </div>
    <?php endif; ?>

    <form action="<?= site_url('/admin/artikel/add') ?>" method="post" enctype="multipart/form-data">
        <p>
            <label for="judul">Judul</label>
            <input type="text" name="judul" value="<?= old('judul') ?>" required>
        </p>
        <p>
            <label for="isi">Isi</label>
            <textarea name="isi" cols="50" rows="10"><?= old('isi') ?></textarea>
        </p>
        <p>
            <label for="id_kategori">Kategori</label>
            <select name="id_kategori" id="id_kategori" required>
                <?php foreach($kategori as $kat): ?>
                    <option value="<?= $kat['id_kategori']; ?>" <?= old('id_kategori') == $kat['id_kategori'] ? 'selected' : '' ?>>
                        <?= esc($kat['nama_kategori']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </p>
        <p>
            <label for="gambar">Upload Gambar</label>
            <input type="file" name="gambar">
        </p>
        <p><input type="submit" value="Kirim" class="btn btn-large"></p>
    </form>

<?= $this->include('template/admin_footer'); ?>

</body>
</html>