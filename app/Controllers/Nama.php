<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\BukuModel;

class Buku extends BaseController
{
    protected $bm;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->bm = new BukuModel();
        $this->menu
            = [
                    $menu = [
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
                    ]
                    ];
            
            $this->rules = [
                'kode_santri' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Kode santri tidak boleh kosong',
                    ]
                ],
                'nama_santri' =>
                [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Nama santri tidak boleh kosong',
                    ]
                ],
                'asrama'    =>
                [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'asrama tidak boleh kosong',
                    ]
                ],
                'alamat'    =>
                [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'alamat tidak boleh kosong',
                    ]
                ],
                'jenis_kelamin'    =>
                [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'Jenis_kelamin tidak boleh kosong',
                    ]
                ],
            ];
        }
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">nama</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item active">nama</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Data nama';

        $query = $this->bm->find();
        $data['data_nama'] = $query;
        return view('nama/content', $data);
    }
    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">nama</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/nama">nama</a></li>
                            <li class="breadcrumb-item active">Input nama</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Tambah nama";
        $data['action'] = base_url() . '/nama/simpan';
        return view('nama/input', $data);
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
            return redirect()->to('nama')->with('success', 'Data nama Tersimpan');
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
            return redirect()->to('nama')->with('success', 'Data nama dengan kode ' . $id . ' berhasil di hapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('nama')->with('error', $e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">obat</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/nama">nama</a></li>
                            <li class="breadcrumb-item active">Edit nama</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Edit nama";
        $data['action'] = base_url() . '/nama/update';
        $data['edit_data'] = $this->bm->find($id);
        return view('nama/input', $data);
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
            return redirect()->to('nama')->with('success', 'Data berhasil diperbarui');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
