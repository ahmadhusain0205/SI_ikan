<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Role extends CI_Controller
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
               'judul' => 'Role',
               'user' => $this->db->get_where('user', ['username' => $username])->row_array(),
               'role' => $this->db->query('select * from user order by id_role, username asc')->result()
          ];
          $this->template->load('Template/Template_home', 'Role/Data', $data);
          $this->load->view('Modal/Role', $data);
          $this->load->view('Modal/Ubah', $data);
     }
     public function data()
     {
          $id = $this->input->get('id');
          $data = $this->db->get_where('user', ['id' => $id])->row_array();
          echo json_encode($data);
     }
     public function roling($username)
     {
          if ($username != null || $username != '') {
               echo json_encode(['status' => 1]);
          } else {

               echo json_encode(['status' => 2]);
          }
     }
     public function ubah_role($username)
     {
          if ($username != null || $username != '') {
               $role = $this->input->post('erole');
               $this->db->set('id_role', $role);
               $this->db->where('username', $username);
               $this->db->update('user');
               echo json_encode(['status' => 1]);
          } else {
               echo json_encode(['status' => 2]);
          }
     }
}
