<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Retur extends CI_Controller
{

     public function __construct()
     {
          parent::__construct();
          if ($this->session->userdata('id_role') == 2) {
               redirect('Supplier');
          } else if ($this->session->userdata('id_role') == 3) {
               redirect('Kostumer');
          }
          $this->load->model('M_invoice');
     }
     public function index()
     {
          $username = $this->session->userdata('username');
          $data = [
               'judul' => 'Retur',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'inv_bapb' => $this->M_invoice->invoice_bapb(),
               'retur' => $this->db->query('select b.*, (select jenis_ikan from ikan where id=b.id_ikan) as jenis_ikan from bapb b order by b.id desc')->result(),
          ];
          $this->template->load('Template/Template_home', 'Retur/BAPB', $data);
     }
     public function data()
     {
          $id = $this->input->get('id');
          $data = $this->db->query('select b.*, (select jenis_ikan from ikan where id=b.id_ikan) as jenis_ikan from bapb b where b.id = "' . $id . '"')->row_array();
          echo json_encode($data);
     }
     public function batal_proses()
     {
          $id = $this->input->get('id');
          if ($id != '' || $id != null) {
               $bapb = $this->db->get_where('bapb', ['id' => $id])->row_array();
               $jmlbapb = $bapb['jmlbapb'];
               $inv_po = $bapb['inv_po'];
               $po = $this->db->get_where('po', ['inv_po' => $inv_po])->row_array();
               $tersisa = $po['tersisa'];
               $retur = $po['retur'];
               $terkirim = $po['terkirim'];
               $id_ikan = $po['id_ikan'];
               $ikan = $this->db->get_where('ikan', ['id' => $id_ikan])->row_array();
               $stok = $ikan['stok_ikan'];

               // aritmatika
               $saldopo = (int)$tersisa + (int)$jmlbapb;
               $saldopox = (int)$terkirim - (int)$jmlbapb;
               $returx = (int)$retur + (int)$jmlbapb;
               $this->db->set('terkirim', $saldopox);
               $this->db->set('tersisa', $saldopo);
               $this->db->set('retur', $returx);
               $this->db->where('inv_po', $inv_po);
               $this->db->update('po');

               $saldo = (int)$stok - (int)$jmlbapb;
               $this->db->set('stok_ikan', $saldo);
               $this->db->where('id', $ikan['id']);
               $this->db->update('ikan');


               $this->db->where('id', $id);
               $this->db->delete('bapb');

               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
}
