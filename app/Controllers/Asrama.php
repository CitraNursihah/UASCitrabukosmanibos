<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KaryawanModel;

class Karyawan extends BaseController
{
    protected $km;
    private $menu;
    private $rules;
    public function __construct()
    {
        $this->sa = new SantriAktif();
        $this->menu
            =  [
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
            'kode_asrama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kode asrama tidak boleh kosong',
                ]
            ],
            'nama_asrama' =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama asrama tidak boleh kosong',
                ]
            ],
            'TTL'    =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tempat, Tanggal Lahir tidak boleh kosong',
                ]
            ],
            'alamat'    =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Alamat tidak boleh kosong',
                ]
            ],
            'jenis_kelamin'    =>
            [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis kelamin tidak boleh kosong',
                ]
            ],
        ];
    }
    public function index()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">pasien</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item active">pasien</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Data asrama';

        $query = $this->km->find();
        $data['data_asrama'] = $query;
        return view('asrama/content', $data);
    }
    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">asrama</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/asrama">asrama</a></li>
                            <li class="breadcrumb-item active">Input asrama</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Tambah asrama";
        $data['action'] = base_url() . '/asrama/simpan';
        return view('asrama/input', $data);
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
            $simpan = $this->km->insert($dt);
            return redirect()->to('asrama')->with('success', 'Data asrama Tersimpan');
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
            $this->km->delete($id);
            return redirect()->to('asrama')->with('success', 'Data asrama dengan kode ' . $id . ' berhasil di hapus');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            return redirect()->to('asrama')->with('error', $e->getMessage());
        }
    }
    public function edit($id)
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">nama</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="' . base_url() . '">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="' . base_url() . '/asrama">asrama</a></li>
                            <li class="breadcrumb-item active">Edit asrama</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Edit asrama";
        $data['action'] = base_url() . '/asrama/update';
        $data['edit_data'] = $this->km->find($id);
        return view('asrama/input', $data);
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
            $this->km->update($param, $dtEdit);
            return redirect()->to('asrama')->with('success', 'Data berhasil diperbarui');
        } catch (\CodeIgniter\Database\Exceptions\DatabaseException $e) {
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
