<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mhs_model extends CI_Model {

    public function getMhs($id = null) {

        if ($id === null) {
            return $this->db->get('mahasiswa')->result_array();
        } else {
            return $this->db->get_where('mahasiswa', ['id' => $id])->result_array();
        }
    }

    public function delteMhs($id) {
        $this->db->delete('mahasiswa', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function addMhs($data) {
        $this->db->insert('mahasiswa', $data);
        return $this->db->affected_rows();
    }

    public function updateMhs($data, $id) {
        $this->db->update('mahasiswa', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
}

/* End of file: Mhs_model.php */
