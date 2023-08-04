<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class kategori extends BaseController
{
    protected $bm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->bm = new KategoriModel();
        $this->menu
            = [
                'beranda' => [
                    'title' => 'Beranda',
                    'link' => base_url(),
                    'icon' => 'fa-solid fa-house',
                    'aktif' => 'active'
                ],
                'Nama' => [
                    'title' => 'Nama',
                    'link' => base_url() . '/Nama',
                    'icon' => 'fa-solid fa-book',
                    'aktif' => ''
                ],
                'Asrama' => [
                    'title' => 'Asrama',
                    'link' => base_url() . '/Asrama',
                    'icon' => 'fa-solid fa-house-chimney',
                    'aktif' => ''
                ],
                'keterangan' => [
                    'title' => 'Keterangan',
                    'link' => base_url() . '/keterangan',
                    'icon' => 'fa-brands fa-laptop-medical',
                    'aktif' => ''
                ],
            ];
        $this->rules = [
            'jadwal_latihan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'jadwal latihan tidak boleh kosong',
                ]
            ],
            'nama_santri' =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama santri tidak boleh kosong',
                ]
            ],
            'keterangan' =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'keterangan tidak boleh kosong',
                ]
            ],
            'Rumus'    =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Rumus tidak boleh salah',
                ]
            ],
        ];
    }
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">keterangan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item active">keterangan</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Data keterangan';

        $query = $this->bm->find();
        $data['data_keterangan'] = $query;
        return view('keterangan/content', $data);
    }
    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">keterangan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/keterangan">keterangan</a></li>
                            <li class="breadcrumb-item active">Input keterangan</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Tambah keterangan";
        $data['action'] = base_url() . '/keterangan/simpan';
        return view('keterangan/input', $data);
    }

    public function simpan()
    {
        if (strtolower($this->request->getMethod()) !== 'post') {

            return redirect()->back()->withInput();
        }
        if (!$this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }
        $dt = $this->request->getPost();

        try {
            $simpan = $this->bm->insert($dt);
            return redirect()->to('keterangan')->with('success', 'Data keterangan Tersimpan');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {

            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function hapus($id)
    {
        if (empty($id)) {
            return redirect()->back()->with('error', 'Data gagal dihapus');
        }
        try {
            $this->bm->delete($id);
            return redirect()->to('keterangan')->with('success', 'Data keterangan dengan kode ' . $id . ' berhasil di hapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('keterangan')->with('error', $e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">keterangan</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/keterangan">keterangan</a></li>
                            <li class="breadcrumb-item active">Edit keterangan</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Edit keterangan";
        $data['action'] = base_url() . '/keterangan/update';
        $data['edit_data'] = $this->bm->find($id);
        return view('keterangan/input', $data);
    }

    public function update()
    {
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);
        unset($this->rules['keterangan']);

        if (!$this->validate($this->rules)) {
            return redirect()->back()->withInput();
        }

        if (empty($dtEdit['keterangan'])) {
            unset($dtEdit['keterangan']);
        }

        try {
            $this->bm->update($param, $dtEdit);
            return redirect()->to('keterangan')->with('success', 'Data berhasil diperbarui');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
