<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ArtikelModel;

class Post extends ResourceController
{
    use ResponseTrait;

    // GET /post
    public function index()
    {
        $model = new ArtikelModel();
        $data = $model->orderBy('id', 'DESC')->findAll();
        return $this->respond(['artikel' => $data]);
    }

    // POST /post
    public function create()
    {
        $model = new ArtikelModel();
        $data = [
            'judul' => $this->request->getVar('judul'),
            'isi'   => $this->request->getVar('isi'),
        ];

        if ($model->insert($data)) {
            return $this->respondCreated([
                'messages' => ['success' => 'Data artikel berhasil ditambahkan.']
            ]);
        } else {
            return $this->failValidationErrors($model->errors());
        }
    }

    // GET /post/{id}
    public function show($id = null)
    {
        $model = new ArtikelModel();
        $data = $model->find($id);
        return $data
            ? $this->respond($data)
            : $this->failNotFound('Data tidak ditemukan.');
    }

    // PUT /post/{id}
    public function update($id = null)
    {
        $model = new ArtikelModel();
        $data = [
            'judul' => $this->request->getVar('judul'),
            'isi'   => $this->request->getVar('isi'),
        ];

        if ($model->update($id, $data)) {
            return $this->respond([
                'messages' => ['success' => 'Data artikel berhasil diubah.']
            ]);
        } else {
            return $this->failValidationErrors($model->errors());
        }
    }

    // DELETE /post/{id}
    public function delete($id = null)
    {
        $model = new ArtikelModel();

        if (!$model->find($id)) {
            return $this->failNotFound('Data tidak ditemukan.');
        }

        $model->delete($id);
        return $this->respondDeleted([
            'messages' => ['success' => 'Data artikel berhasil dihapus.']
        ]);
    }
}