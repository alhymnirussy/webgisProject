<?php 

namespace App\Models;

use CodeIgniter\Model;

class lokasiModels extends Model{
    protected $table = 'lokasi';
    protected $allowedFields = ['id_lokasi','kota','kecamatan','nama_tempat','jenis'];
    protected $useTimestamps = false;
    protected $primaryKey = 'id_lokasi';

    public function getLokasi(){
        $data = $this->findAll();

        return $data;
    }
    public function hitungLokasiTotal(){

        $query = $this->db->query('SELECT * FROM lokasi');
        $total = $query->getNumRows();
        
        if($total > 0){
            return $total;
        }
        else{
            return 0;
        }
    }
    public function hitungLokasiMasjid(){

        $query = $this->db->query("SELECT * FROM lokasi WHERE jenis = 'Masjid'");
        $total = $query->getNumRows();

        if($total > 0){
            return $total;
        }
        else{
            return 0;
        }
    }
    public function hitungLokasiMusholla(){

        $query = $this->db->query("SELECT * FROM lokasi WHERE jenis = 'Musholla'");
        $total = $query->getNumRows();

        if($total > 0){
            return $total;
        }
        else{
            return 0;
        }
    }
    public function hitungLokasiGereja(){

        $query = $this->db->query("SELECT * FROM lokasi WHERE jenis = 'Gereja'");
        $total = $query->getNumRows();

        if($total > 0){
            return $total;
        }
        else{
            return 0;
        }
    }
    public function hitungLokasiWihara(){

        $query = $this->db->query("SELECT * FROM lokasi WHERE jenis = 'Wihara'");
        $total = $query->getNumRows();

        if($total > 0){
            return $total;
        }
        else{
            return 0;
        }
    }
}

?>