<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Globali extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
     }
     public function dataikan()
     {
          $key = $this->input->post('searchTerm');
          // $data = $this->db->query("SELECT b.id AS id, CONCAT('[ ',i.jenis_ikan,' ]','-','[ Rp. ',i.hargajl_ikan,' ]','-','[ Stok-segar: ',b.stok_in,' ]','-','[ Total-stok: ',i.stok_ikan,' ]','-','[ Tgl Masuk: ',b.tglbapb,' ] ') AS text, i.* FROM bapb b JOIN ikan i ON b.id_ikan=i.id WHERE i.id LIKE '%" . $key . "%' OR i.jenis_ikan LIKE '%" . $key . "%' OR i.hargajl_ikan LIKE '%" . $key . "%' GROUP BY i.id ORDER BY b.id DESC")->result();
          $data = $this->db->query("SELECT b.id AS id, CONCAT('[ ',i.jenis_ikan,' ]','-','[ Rp. ',i.hargajl_ikan,' ]','-','[ Stok-segar: ',b.stok_in,' ]','-','[ Total-stok: ',i.stok_ikan,' ]','-','[ Tgl Masuk: ',b.tglbapb,' ] ') AS text, i.* FROM bapb b JOIN ikan i ON b.id_ikan=i.id WHERE b.stok_in != 0 AND i.id LIKE '%" . $key . "%' OR i.jenis_ikan LIKE '%" . $key . "%' OR i.hargajl_ikan LIKE '%" . $key . "%' ORDER BY b.id DESC")->result();
          echo json_encode($data);
     }
     public function getinfoikan()
     {
          $kode = $this->input->get('kode');
          $data = $this->db->get_where('ikan', ['id' => $kode])->row_array();
          echo json_encode($data);
     }
     public function cekppn()
     {
          $data = $this->db->get_where('pajak', ['id' => 1])->row_array();
          echo json_encode($data);
     }
}
