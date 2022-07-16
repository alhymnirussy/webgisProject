<?php

namespace App\Controllers;

use App\Models\lokasiModels;
use CodeIgniter\HTTP\Request;

class Dasboard extends BaseController
{
    public function __construct()
    {
        $this->daftarLokasi = new lokasiModels();
        
    }

    public function home()
    {
        $lokasi = $this->daftarLokasi->getLokasi();
        $jumlahLokasiTotal = $this->daftarLokasi->hitungLokasiTotal();
        $jumlahLokasiMasjid = $this->daftarLokasi->hitungLokasiMasjid();
        $jumlahLokasiMusholla = $this->daftarLokasi->hitungLokasiMusholla();
        $jumlahLokasiGereja = $this->daftarLokasi->hitungLokasiGereja();
        $jumlahLokasiWihara = $this->daftarLokasi->hitungLokasiWihara();
        $data = [
            'title'=>'Home - View Map',
            'lokasi'=>  $lokasi,
            'totalLokasi'=> $jumlahLokasiTotal,
            'totalLokasiMasjid'=>$jumlahLokasiMasjid,
            'totalLokasiMusholla'=>$jumlahLokasiMusholla,
            'totalLokasiGereja'=>$jumlahLokasiGereja,
            'totalLokasiWihara'=>$jumlahLokasiWihara
        ];

        return view('halaman/home',$data);
    }
    public function cariNavigasi($id_lokasi){
        {
            $lokasiNavigasi = $this->daftarLokasi->find($id_lokasi);
            $lokasi = $this->daftarLokasi->getLokasi();
            $jumlahLokasiTotal = $this->daftarLokasi->hitungLokasiTotal();
            $jumlahLokasiMasjid = $this->daftarLokasi->hitungLokasiMasjid();
            $jumlahLokasiMusholla = $this->daftarLokasi->hitungLokasiMusholla();
            $jumlahLokasiGereja = $this->daftarLokasi->hitungLokasiGereja();
            $jumlahLokasiWihara = $this->daftarLokasi->hitungLokasiWihara();
            $data = [
                'title'=>'Home - View Map',
                'lokasi'=> $lokasi,
                'lokasiNavigasi'=>$lokasiNavigasi,
                'totalLokasi'=> $jumlahLokasiTotal,
                'totalLokasiMasjid'=>$jumlahLokasiMasjid,
                'totalLokasiMusholla'=>$jumlahLokasiMusholla,
                'totalLokasiGereja'=>$jumlahLokasiGereja,
                'totalLokasiWihara'=>$jumlahLokasiWihara
            ];
    
            return view('halaman/cariNavigasi',$data);
        }

    }
    public function daftarTempat()
    {
        $lokasi = $this->daftarLokasi->getLokasi();
        $data = [
            'title'=>'Daftar Tempat',
            'lokasi'=>  $lokasi,
        ];

        return view('halaman/daftarTempat',$data);
    }
    public function cari()
    {
        $lokasi = $this->daftarLokasi->getLokasi();
        $data = [
            'title'=>'Cari - View Map',
            'lokasi'=> $lokasi,
        ];

        return view('halaman/cari',$data);
    }
    public function rute()
    {
        $lokasi = $this->daftarLokasi->getLokasi();
        $data = [
            'title'=>'Rute',
            'lokasi'=> $lokasi,
        ];

        return view('halaman/rute',$data);
    }
    public function detail($id_lokasi){
        $lokasi = $this->daftarLokasi->find($id_lokasi);

        $data=[
            'title'=>'Halaman Detail',
            'lokasi'=>$lokasi
        ];

        return view('halaman/detail',$data);
    }
}
