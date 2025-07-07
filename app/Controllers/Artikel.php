<?php

namespace App\Controllers;

use App\Models\ArtikelModel;
use App\Models\KategoriModel;

class Artikel extends BaseController
{
    public function index()
    {
        $pager = \Config\Services::pager();
        $keyword = $this->request->getVar('q');

        $db = \Config\Database::connect();
        $builder = $db->table('artikel');
        $builder->select('artikel.*, kategori.nama_kategori');
        $builder->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');

        if ($keyword) {
            $builder->like('artikel.judul', $keyword);
        }

        $builder->orderBy('artikel.id', 'DESC');

        $data = [
            'title'   => 'Daftar Artikel',
            'artikel' => $builder->get()->getResultArray(),
            'pager'   => $pager,
            'keyword' => $keyword
        ];

        return view('artikel/index', $data);
    }

    public function view($slug)
    {
        $model = new ArtikelModel();
        $artikel = $model->where(['slug' => $slug])->first();

        if (!$artikel) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('artikel/detail', [
            'title'   => $artikel['judul'],
            'artikel' => $artikel
        ]);
    }

    // ✅ Versi admin_index dengan AJAX + sorting support
    public function admin_index()
    {
        $title = 'Daftar Artikel (Admin)';
        $model = new ArtikelModel();

        $q = $this->request->getVar('q') ?? '';
        $kategori_id = $this->request->getVar('kategori_id') ?? '';
        $page = $this->request->getVar('page') ?? 1;
        $sort_by = $this->request->getVar('sort_by') ?? 'id';
        $sort_dir = strtolower($this->request->getVar('sort_dir') ?? 'asc');

        $allowedSort = ['id', 'judul', 'nama_kategori', 'status'];
        if (!in_array($sort_by, $allowedSort)) {
            $sort_by = 'id';
        }
        if (!in_array($sort_dir, ['asc', 'desc'])) {
            $sort_dir = 'asc';
        }

        $builder = $model->table('artikel')
            ->select('artikel.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id_kategori = artikel.id_kategori', 'left');

        if ($q != '') {
            $builder->like('artikel.judul', $q);
        }

        if ($kategori_id != '') {
            $builder->where('artikel.id_kategori', $kategori_id);
        }

        // Mapping alias kolom ke kolom database sebenarnya
        $sortColumnMap = [
            'id' => 'artikel.id',
            'judul' => 'artikel.judul',
            'nama_kategori' => 'kategori.nama_kategori',
            'status' => 'artikel.status'
        ];
        $builder->orderBy($sortColumnMap[$sort_by], $sort_dir);

        $artikel = $builder->paginate(10, 'default', $page);
        $pager = $model->pager;

        $data = [
            'title' => $title,
            'q' => $q,
            'kategori_id' => $kategori_id,
            'artikel' => $artikel,
            'pager' => $pager
        ];

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'artikel' => $artikel,
                'pager' => [
                    'links' => $this->generatePagerLinks($pager->links())
                ]
            ]);
        } else {
            $kategoriModel = new KategoriModel();
            $data['kategori'] = $kategoriModel->findAll();
            return view('artikel/admin_index', $data);
        }
    }

    private function generatePagerLinks($pagerHtml)
{
    $dom = new \DOMDocument();
    @$dom->loadHTML($pagerHtml);
    $links = [];

    $lis = $dom->getElementsByTagName('li');
    foreach ($lis as $li) {
        $classes = $li->getAttribute('class');
        $isActive = strpos($classes, 'active') !== false;

        $linkTag = $li->getElementsByTagName('a')->item(0);
        $spanTag = $li->getElementsByTagName('span')->item(0);

        if ($linkTag) {
            $links[] = [
                'url' => $linkTag->getAttribute('href'),
                'title' => $linkTag->textContent,
                'active' => $isActive
            ];
        } elseif ($spanTag) {
            $links[] = [
                'url' => null,
                'title' => $spanTag->textContent,
                'active' => $isActive
            ];
        }
    }

    return $links;
}


    public function add()
    {
        helper(['form']);
        $validation = \Config\Services::validation();
        $validation->setRules([
            'judul'  => 'required',
            'isi'    => 'required',
            'gambar' => 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,2048]'
        ]);

        $isDataValid = $validation->withRequest($this->request)->run();

        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();

        if ($isDataValid) {
            $file = $this->request->getFile('gambar');
            $filename = null;

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads', $filename);
            }

            $artikel = new ArtikelModel();
            $artikel->insert([
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'slug'        => url_title($this->request->getPost('judul'), '-', true),
                'gambar'      => $filename,
                'id_kategori' => $this->request->getPost('id_kategori')
            ]);

            return redirect()->to('/admin/artikel');
        }

        return view('artikel/form_add', [
            'title'     => 'Tambah Artikel',
            'validation'=> $validation,
            'kategori'  => $kategori
        ]);
    }

    public function edit($id)
    {
        helper(['form']);
        $artikel = new ArtikelModel();
        $dataLama = $artikel->find($id);

        if (!$dataLama) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $validation = \Config\Services::validation();
        $rules = [
            'judul' => 'required',
            'isi'   => 'required',
        ];

        $file = $this->request->getFile('gambar');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $rules['gambar'] = 'uploaded[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/png]|max_size[gambar,2048]';
        }

        $validation->setRules($rules);
        $kategoriModel = new KategoriModel();
        $kategori = $kategoriModel->findAll();

        $isDataValid = $validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $filename = $dataLama['gambar'];

            if ($file && $file->isValid() && !$file->hasMoved()) {
                $filename = $file->getRandomName();
                $file->move(ROOTPATH . 'public/uploads', $filename);

                if ($dataLama['gambar'] && file_exists(ROOTPATH . 'public/uploads/' . $dataLama['gambar'])) {
                    unlink(ROOTPATH . 'public/uploads/' . $dataLama['gambar']);
                }
            }

            $artikel->update($id, [
                'judul'       => $this->request->getPost('judul'),
                'isi'         => $this->request->getPost('isi'),
                'gambar'      => $filename,
                'id_kategori' => $this->request->getPost('id_kategori')
            ]);

            return redirect()->to('/admin/artikel');
        }

        return view('artikel/form_edit', [
            'title'      => 'Edit Artikel',
            'data'       => $dataLama,
            'validation' => $validation,
            'kategori'   => $kategori
        ]);
    }

    public function delete($id)
    {
        $artikel = new ArtikelModel();
        $artikel->delete($id);

        return redirect()->to('/admin/artikel');
    }
}