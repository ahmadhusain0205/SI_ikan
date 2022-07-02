<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BAPB extends CI_Controller
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
               'judul' => 'BAPB',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'inv_bapb' => $this->M_invoice->invoice_bapb(),
               'bapb' => $this->db->query('select b.*, (select jenis_ikan from ikan where id=b.id_ikan) as jenis_ikan, p.* from bapb b join po p on b.inv_po=p.inv_po order by b.id desc')->result(),
          ];
          $this->template->load('Template/Template_home', 'BAPB/Data', $data);
     }

     public function bapb()
     {
          $username = $this->session->userdata('username');
          $data = [
               'judul' => 'BAPB',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'inv_bapb' => $this->M_invoice->invoice_bapb(),
               'po' => $this->db->query('select po.*, (select jenis_ikan from ikan where id = po.id_ikan) as jenis_ikan from po where tersisa != 0 order by inv_po desc')->result(),
          ];
          $this->template->load('Template/Template_home', 'BAPB/Get', $data);
     }
     public function getdatapo()
     {
          $inv_po = $this->input->get('po');
          $data = $this->db->query('select po.*, (select jenis_ikan from ikan where id = po.id_ikan) as jenis_ikan from po where inv_po = "' . $inv_po . '" and po.tersisa != 0 order by inv_po desc')->row_array();
          echo json_encode($data);
     }

     public function tambah()
     {
          $inv_bapb = $this->input->post('inv_bapb');
          $tglbapb = $this->input->post('tglbapb');
          $jmlbapb = $this->input->post('jmlbapb');
          $po = $this->input->post('po');
          $user = $this->input->get('user');
          $pemasok = $this->input->get('pemasok');
          $id_ikan = $this->input->get('id_ikan');
          $data = [
               'inv_bapb' => $inv_bapb,
               'tglbapb' => $tglbapb,
               'jmlbapb' => $jmlbapb,
               'stok_in' => $jmlbapb,
               'inv_po' => $po,
               'user' => $user,
               'pemasok' => $pemasok,
               'id_ikan' => $id_ikan,
          ];
          if ($inv_bapb != '' && $tglbapb != '' && $jmlbapb != '' && $po != '' && $user != '' && $pemasok != '' && $id_ikan != '') {
               $this->db->insert('bapb', $data);
               $data_po = $this->db->get_where('po', ['inv_po' => $po])->row_array();
               $tersisa = $data_po['tersisa'];
               $qty = (int)$tersisa - (int)$jmlbapb;
               $this->db->set('tersisa', $qty);
               $this->db->set('terkirim', $jmlbapb);
               $this->db->where('inv_po', $po);
               $this->db->update('po');
               $data_ikan = $this->db->get_where('ikan', ['id' => $id_ikan])->row_array();
               $saldoakhir = (int)$data_ikan['stok_ikan'] + (int)$jmlbapb;
               $this->db->set('stok_ikan', $saldoakhir);
               $this->db->where('id', $id_ikan);
               $this->db->update('ikan');
               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
}
