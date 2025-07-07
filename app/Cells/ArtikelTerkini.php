<?php

namespace App\Cells;

use CodeIgniter\View\Cells\Cell as BaseCell;
use App\Models\ArtikelModel;

/**
 * View Cell untuk menampilkan 5 artikel terbaru (opsional per-kategori)
 *
 * Cara pakai di view:
 *   <?= view_cell('App\\Cells\\ArtikelTerkini::render') ?>
 *   // atau jika mau filter kategori tertentu
 *   <?= view_cell('App\\Cells\\ArtikelTerkini::render', ['kategori' => 3]) ?>
 */
class ArtikelTerkini extends BaseCell
{
    /** @var int|string|null ID kategori (atau slug) yang akan difilter */
    protected $kategori = null;

    /**
     * Di-eksekusi otomatis ketika Cell dipanggil.
     *
     * @param int|string|null $kategori
     */
    public function mount($kategori = null): void
    {
        $this->kategori = $kategori;
    }

    /**
     * Method utama yang dipanggil oleh view_cell().
     * Harus bernama "render" agar CI4 menemukannya secara default.
     */
    public function render(): string
    {
        $model = new ArtikelModel();

        // Ambil query builder agar mudah menambah kondisi.
        $builder = $model->orderBy('created_at', 'DESC')
                          ->limit(5);

        // Filter kategori jika dikirim.
        if ($this->kategori !== null && $this->kategori !== '') {
            // Ganti 'id_kategori' dengan nama kolom Anda.
            $builder->where('id_kategori', $this->kategori);
        }

        $data['artikel'] = $builder->findAll();

        // View komponen berada di app/Views/components/artikel_terkini.php
        return view('components/artikel_terkini', $data)