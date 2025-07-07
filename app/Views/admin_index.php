<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
<style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: rgb(0, 149, 255);
            font-weight: bold;
        }

        td p {
            margin: 5px 0 0 0;
            font-size: 14px;
            color: #666;
        }

        .btn {
            display: inline-block;
            padding: 10px 15px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            border-radius: 5px;
            transition: background 0.3s ease, transform 0.2s ease;
            text-align: center;
            border: 1px solid transparent;
        }

        .btn-ubah {
            background-color: rgb(0, 132, 255);
            color: black;
            border: 8px solid rgb(0, 132, 255);
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }

        .btn-hapus {
            background-color: #6c757d;
            color: white;
            border: 8px solid #545b62;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<?= $this->include('template/admin_header'); ?>
<div class="row mb-3">
    <div class="col-md-6">
        <form method="get" class="form-inline">
            <input type="text" name="q" value="<?= $keyword; ?>" placeholder="Cari judul artikel" class="form-control mr-2">
            <select name="kategori_id" class="form-control mr-2">
                <option value="">Semua Kategori</option>
                <?php foreach ($kategori as $k): ?>
                    <option value="<?= $k['id_kategori']; ?>" <?= ($kategori_id == $k['id_kategori']) ? 'selected' : ''; ?>>
                        <?= $k['nama_kategori']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Cari" class="btn btn-primary">
        </form> 
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>kategori</th>
            <th>Gambar</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>

    <?php if($artikel): foreach($artikel as $row): ?>
    <tr>
        <td><?= $row['id']; ?></td>
        <td>
            <b><?= esc($row['judul']); ?></b>
            <p><small><?= esc(substr($row['isi'], 0, 50)); ?></small></p>
        </td>
        <td>
            <?php if (!empty($row['gambar'])): ?>
                <img src="<?= base_url('uploads/' . $row['gambar']) ?>" alt="Gambar" width="100">
            <?php else: ?>
                <span>Tidak ada gambar</span>
            <?php endif; ?>
        </td>
        <td><?= esc($row['status']); ?></td>
        <td>
            <a class="btn" href="<?= base_url('/admin/artikel/edit/' . $row['id']); ?>">Ubah</a>
            <a class="btn btn-danger" onclick="return confirm('Yakin menghapus data?');" href="<?= base_url('/admin/artikel/delete/' . $row['id']); ?>">Hapus</a>
        </td>
        <td><?= esc($row['nama_kategori']); ?></td>
    </tr>
    <?php endforeach; else: ?>
    <tr>
        <td colspan="5">Belum ada data.</td>
    </tr>
    <?php endif; ?>

    </tbody>
    <tfoot>
    <tr>
        <th>ID</th>
        <th>Judul</th>
        <th>kategori</th>
        <th>Gambar</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>
    </tfoot>
</table>

<?= $this->include('template/admin_footer'); ?>