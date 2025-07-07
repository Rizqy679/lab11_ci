<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar Artikel (Admin)</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f7f9fc;
      color: #333;
      padding: 20px;
    }

    table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      background-color: #ffffff;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      margin-top: 20px;
    }

    thead {
      background: #0066cc;
      color: #fff;
    }

    th, td {
      padding: 15px 20px;
      text-align: left;
    }

    tbody tr:nth-child(even) {
      background: #f1f5f9;
    }

    tbody tr:hover {
      background: #e0f2fe;
      cursor: pointer;
    }

    td p {
      margin: 5px 0 0 0;
      font-size: 14px;
      color: #555;
    }

    .btn {
      padding: 8px 14px;
      font-size: 14px;
      font-weight: 600;
      text-decoration: none;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background 0.2s ease;
      display: inline-block;
    }

    .btn-ubah,
    .btn-hapus {
      background-color: #38bdf8;
      color: white;
      margin-right: 5px;
    }

    .btn-ubah:hover,
    .btn-hapus:hover {
      background-color: #0ea5e9;
    }

    .pagination {
      display: flex;
      justify-content: center;
      gap: 6px;
      padding: 20px 0;
      flex-wrap: wrap;
    }

    .pagination .page-item {
      list-style: none;
    }

    .pagination .page-link {
      padding: 8px 14px;
      border-radius: 6px;
      text-decoration: none;
      background-color: #e5e7eb;
      color: #333;
      font-weight: 500;
      transition: all 0.2s ease;
    }

    .pagination .page-link:hover {
      background-color: #60a5fa;
      color: white;
    }

    .pagination .active .page-link {
      background-color: #2563eb;
      color: white;
    }

    form#search-form {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      align-items: center;
      margin-bottom: 20px;
    }

    form#search-form input[type="text"],
    form#search-form select {
      padding: 8px 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      min-width: 200px;
    }

    form#search-form input[type="submit"] {
      padding: 8px 14px;
      background-color: #2563eb;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
      transition: background 0.2s ease;
    }

    form#search-form input[type="submit"]:hover {
      background-color: #1e40af;
    }

    /* Spinner loader */
    #loading {
      display: none;
      margin-top: 20px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .spinner {
      width: 36px;
      height: 36px;
      border: 4px solid #cbd5e0;
      border-top: 4px solid #2563eb;
      border-radius: 50%;
      animation: spin 0.8s linear infinite;
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
  </style>
</head>
<body>

<?= $this->include('template/admin_header'); ?>

<div class="row mb-3">
  <div class="col-md-6">
    <form id="search-form" class="form-inline">
      <input type="text" name="q" id="search-box" value="<?= $q ?? '' ?>" placeholder="Cari judul artikel" class="form-control mr-2">
      <select name="kategori_id" id="category-filter" class="form-control mr-2">
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

<!-- 🔄 Spinner loading -->
<div id="loading"><div class="spinner"></div></div>

<div id="article-container"></div>
<div id="pagination-container"></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
  const articleContainer = $('#article-container');
  const paginationContainer = $('#pagination-container');
  const searchForm = $('#search-form');
  const searchBox = $('#search-box');
  const categoryFilter = $('#category-filter');

  let currentSortBy = 'id';
  let currentSortDir = 'asc';

  const fetchData = (url = '/admin/artikel') => {
    $('#loading').show();
    const q = searchBox.val();
    const kategori_id = categoryFilter.val();
    const fullUrl = `${url}?q=${q}&kategori_id=${kategori_id}&sort_by=${currentSortBy}&sort_dir=${currentSortDir}`;

    $.ajax({
      url: fullUrl,
      type: 'GET',
      dataType: 'json',
      headers: { 'X-Requested-With': 'XMLHttpRequest' },
      success: function(data) {
        renderArticles(data.artikel);
        renderPagination(data.pager, q, kategori_id);
      },
      complete: function() {
        $('#loading').fadeOut();
      }
    });
  };

  const renderArticles = (articles) => {
    let html = '<table class="table">';
    html += `
      <thead>
        <tr>
          <th data-sort="id" style="cursor:pointer;">ID</th>
          <th data-sort="judul" style="cursor:pointer;">Judul</th>
          <th data-sort="nama_kategori" style="cursor:pointer;">Kategori</th>
          <th data-sort="status" style="cursor:pointer;">Status</th>
          <th style="text-align: center;">Aksi</th>
        </tr>
      </thead>
      <tbody>
    `;
    if (articles.length > 0) {
      articles.forEach(article => {
        html += `
          <tr>
            <td>${article.id}</td>
            <td>
              <strong style="font-size: 16px;">${article.judul}</strong>
              <p style="margin: 4px 0; color: #666; font-size: 13px;">${article.isi.substring(0, 60)}...</p>
            </td>
            <td>${article.nama_kategori}</td>
            <td>${article.status}</td>
            <td style="text-align: center;">
              <a class="btn btn-ubah" href="/admin/artikel/edit/${article.id}">✏️ Ubah</a>
              <a class="btn btn-hapus" onclick="return confirm('Yakin menghapus data?');" href="/admin/artikel/delete/${article.id}">🗑️ Hapus</a>
            </td>
          </tr>`;
      });
    } else {
      html += '<tr><td colspan="5">Tidak ada data ditemukan.</td></tr>';
    }
    html += '</tbody></table>';
    articleContainer.html(html);
  };

  const renderPagination = (pager, q, kategori_id) => {
    let html = '<nav><ul class="pagination">';
    pager.links.forEach(link => {
      let url = link.url ? `${link.url}&q=${q}&kategori_id=${kategori_id}&sort_by=${currentSortBy}&sort_dir=${currentSortDir}` : '#';
      html += `<li class="page-item ${link.active ? 'active' : ''}">
        <a class="page-link" href="${url}">${link.title}</a>
      </li>`;
    });
    html += '</ul></nav>';
    paginationContainer.html(html);
  };

  // 🔁 Sorting saat klik header
  articleContainer.on('click', 'th[data-sort]', function () {
    const clickedSort = $(this).data('sort');
    if (currentSortBy === clickedSort) {
      currentSortDir = currentSortDir === 'asc' ? 'desc' : 'asc';
    } else {
      currentSortBy = clickedSort;
      currentSortDir = 'asc';
    }
    fetchData();
  });

  // 🔍 Pencarian
  searchForm.on('submit', function(e) {
    e.preventDefault();
    fetchData();
  });

  // 🎯 Filter kategori
  categoryFilter.on('change', function() {
    searchForm.trigger('submit');
  });

  // ⏩ Pagination
  paginationContainer.on('click', 'a.page-link', function(e) {
    e.preventDefault();
    const url = $(this).attr('href');
    fetchData(url);
  });

  // 🔃 Load pertama
  fetchData();
});
</script>


<?= $this->include('template/admin_footer'); ?>

</body>
</html>