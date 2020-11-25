<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Todolist extends CI_Controller
{
          public function __construct()
          {
                    parent::__construct();
                    $this->load->library('form_validation');
                    $this->load->library('session');
                    $this->load->model('Todolist_model');
          }
          public function index()
          {
                    $data['title'] = 'My To Do List';
                    $data['kegiatan'] = $this->db->get_where('kegiatan', ['status' => 1])->result_array();
                    $data['selesai'] = $this->db->get_where('kegiatan', ['status' => 0])->result_array();

                    $this->load->view('templates/header', $data);
                    $this->load->view('main_page/index', $data);
                    $this->load->view('templates/footer');
          }

          public function add()
          {
                    $this->form_validation->set_rules('kegiatan', 'Kegiatan', 'required|trim');
                    if (!$this->form_validation->run()) {
                              $data['kegiatan'] = $this->db->get_where('kegiatan', ['status' => 1])->result_array();
                              $data['selesai'] = $this->db->get_where('kegiatan', ['status' => 0])->result_array();

                              $data['title'] = 'My To Do List';
                              $this->load->view('templates/header', $data);
                              $this->load->view('main_page/index', $data);
                              $this->load->view('templates/footer');
                    } else {
                              $this->Todolist_model->addDataKegiatan();

                              $this->session->set_flashdata('messege', '<div class="alert alert-success mx-4 alert-dismissible fade show" role="alert">Kegiatan berhasil ditambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button></div>');
                              redirect('todolist');
                    }
          }

          public function getdata()
          {
                    echo $this->Todolist_model->getDataModel();
          }

          public function update()
          {
                    $data['title'] = 'My To Do List';
                    $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
                    $this->form_validation->set_rules('waktu', 'Waktu', 'required|trim');

                    if (!$this->form_validation->run()) {
                              $data['kegiatan'] = $this->db->get_where('kegiatan', ['status' => 1])->result_array();
                              $data['selesai'] = $this->db->get_where('kegiatan', ['status' => 0])->result_array();

                              $this->load->view('templates/header', $data);
                              $this->load->view('main_page/index', $data);
                              $this->load->view('templates/footer');
                    } else {
                              $this->Todolist_model->updateDataKegiatan();
                              $this->session->set_flashdata('messege', '<div class="alert alert-success mx-4 alert-dismissible fade show" role="alert">Kegiatan berhasil diperbarui! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button></div>');
                              redirect('todolist');
                    }
          }

          public function delete($id)
          {
                    $this->Todolist_model->deleteDataKegiatan($id);
                    $this->session->set_flashdata('messege', '<div class="alert alert-warning mx-4 alert-dismissible fade show" role="alert">Kegiatan berhasil dihapus! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button></div>');

                    redirect('todolist');
          }
}
