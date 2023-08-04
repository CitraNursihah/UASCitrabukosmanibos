<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
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
        ];
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Beranda</li>
                            </ol>
                        </div>';
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Selamat Datang di Pelatihan Hadrah";
        $data['selamat_datang'] = "Semoga Bermanfaat";
        return view('template/content', $data);
    }
}
