<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title); ?></title>
    <style>
        input[type='text'], textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        input[type='file'] {
            margin-top: 5px;
            margin-bottom: 10px;
        }
        .btn {
            color: white;
            background-color: blue;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        img.preview {
            max-width: 300px;
            margin-top: 10px;
            display: block;
        }
    </style>
</head>
<body>

<?= $this->include('template/admin_header'); ?>

<h2><?= esc($title); ?></h2>

<?php if (!empty($validation)) : ?>
    <div class="error">
        <?= $validation->listErrors(); ?>
    </div>
<?php endif; ?>

<form method="post" enctype="multipart/form-data" action="<?= site_url('/admin/artikel/edit/' . $data['id']) ?>">

    <p>
        <label for="judul">Judul</label>
        <input type="text" name="judul" value="<?= old('judul', $data['judul']); ?>" required>
    </p>
    <p>
        <label for="isi">Isi</label>
        <textarea name="isi" cols="50" rows="10" required><?= old('isi', $data['isi']); ?></textarea>
    </p>
    <p>
        <label for="id_kategori">Kategori</label>
        <select name="id_kategori" id="id_kategori" required>
            <?php foreach ($kategori as $k): ?>
                <option value="<?= $k['id_kategori']; ?>" <?= ($data['id_kategori'] == $k['id_kategori']) ? 'selected' : ''; ?>>
                    <?= esc($k['nama_kategori']); ?>
                </option>
            <?php endforeach; ?>
        </select>
    </p>
    <p>
        <label for="gambar">Upload Gambar</label>
        <input type="file" name="gambar" id="gambar">
        <?php if (!empty($data['gambar'])): ?>
            <img src="<?= base_url('uploads/' . $data['gambar']); ?>" alt="Preview" class="preview">
        <?php endif; ?>
    </p>
    <p>
        <input type="submit" value="Kirim" class="btn">
    </p>
</form>

<?= $this->include('template/admin_footer'); ?>

</body>
</html>