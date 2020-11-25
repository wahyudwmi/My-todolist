<?php

class Todolist_model extends CI_Model
{
          public function deleteDataKegiatan($id)
          {
                    $this->db->where('id', $id);
                    $this->db->delete('kegiatan');
          }

          public function updateDataKegiatan()
          {
                    $id = $this->input->post('id');
                    $kegiatan = [
                              'nama' => $this->input->post('nama'),
                              'status' => $this->input->post('status'),
                              'deskripsi' => $this->input->post('deskripsi')
                    ];


                    $this->db->set($kegiatan);
                    $this->db->where('id', $id);
                    $this->db->update('kegiatan');
          }

          public function getDataModel()
          {
                    return json_encode($this->db->get_where('kegiatan', ['id' => $this->input->post('id')])->row_array());
          }

          public function addDataKegiatan()
          {
                    $data = $this->input->post('kegiatan');
                    $waktu = time();
                    $status = 1;
                    $this->db->insert('kegiatan', [
                              'nama' => $data,
                              'waktu' => $waktu,
                              'status' => $status
                    ]);
          }
}
