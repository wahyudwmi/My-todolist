<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Todolist extends CI_Controller
{
          public function __construct()
          {
                    parent::__construct();
                    $this->load->library('form_validation');
                    $this->load->library('session');
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
                              $data = $this->input->post('kegiatan');
                              $waktu = time();
                              $status = 1;
                              $this->db->insert('kegiatan', [
                                        'nama' => $data,
                                        'waktu' => $waktu,
                                        'status' => $status
                              ]);

                              $this->session->set_flashdata('messege', '<div class="alert alert-success mx-4 alert-dismissible fade show" role="alert">Kegiatan berhasil ditambahkan! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button></div>');
                              redirect('todolist');
                    }
          }

          public function getdata()
          {
                    echo json_encode($this->db->get_where('kegiatan', ['id' => $this->input->post('id')])->row_array());
          }

          public function update()
          {
                    $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
                    $this->form_validation->set_rules('waktu', 'Waktu', 'required|trim');

                    if (!$this->form_validation->run()) {
                              $data['kegiatan'] = $this->db->get_where('kegiatan', ['status' => 1])->result_array();
                              $data['selesai'] = $this->db->get_where('kegiatan', ['status' => 0])->result_array();
                              $data['title'] = 'My To Do List';

                              $this->load->view('templates/header', $data);
                              $this->load->view('main_page/index', $data);
                              $this->load->view('templates/footer');
                    } else {
                              $id = $this->input->post('id');
                              $kegiatan = [
                                        'nama' => $this->input->post('nama'),
                                        'status' => $this->input->post('status'),
                                        'deskripsi' => $this->input->post('deskripsi')
                              ];


                              $this->db->set($kegiatan);
                              $this->db->where('id', $id);
                              $this->db->update('kegiatan');

                              $this->session->set_flashdata('messege', '<div class="alert alert-success mx-4 alert-dismissible fade show" role="alert">Kegiatan berhasil diperbarui! <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span></button></div>');
                              redirect('todolist');
                    }
          }

          public function delete()
          {
                    $this->db->where('id', $this->input->post('id'));
                    $this->db->delete('kegiatan');
                    $data['status'] = 'success';
                    $this->output->set_content_type('application/json');
                    $this->output->set_output(json_encode($data));
                    $string = $this->output->get_output();
                    echo $string;
                    exit();
          }
}
