<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\ArtikelModel;

class AjaxController extends Controller
{
    public function index()
    {
        return view('ajax/index');
    }

    public function getData()
    {
        $model = new ArtikelModel();
        $data = $model->findAll();

        // Kirim data dalam format JSON
        return $this->response->setJSON($data);
    }

    public function delete($id)
    {
        $model = new ArtikelModel();
        $model->delete($id);

        // Kirim respons status dalam format JSON
        return $this->response->setJSON([
            'status' => 'OK'
        ]);
    }
}