<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stok extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          if ($this->session->userdata('id_role') == 2) {
               redirect('Supplier');
          } else if ($this->session->userdata('id_role') == 3) {
               redirect('Kostumer');
          }
     }
     public function index()
     {
          $username = $this->session->userdata('username');
          $data = [
               'judul' => 'Daftar Ikan',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'stok' => $this->db->query('select i.*, (select sum(p.tersisa) from po p where p.id_ikan=i.id) as tersisa, (select sum(p.retur) from po p where p.id_ikan=i.id) as retur, (select sum(b.jmlbapb) from bapb b where b.id_ikan = i.id) as bapb, (if((SELECT sum(qty) from penjualan_detail WHERE jenis_ikan=i.jenis_ikan) is null, 0, (SELECT sum(qty) from penjualan_detail WHERE jenis_ikan=i.jenis_ikan)) + if((SELECT sum(qty) from order_detail WHERE status = 1 and jenis_ikan=i.jenis_ikan) is null, 0, (SELECT sum(qty) from order_detail WHERE status = 1 and jenis_ikan=i.jenis_ikan))) as terjual from ikan i order by i.stok_ikan desc')->result(),
          ];
          $this->template->load('Template/Template_home', 'Stok/Data', $data);
     }
}
