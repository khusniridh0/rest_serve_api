<?php

defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Karyawan extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kry_model');
        $this->methods['index_get']['limit'] = 3;
    }

    public function index_get() {
        $id = $this->get('id');
        if ($id === null) {
            $mhs = $this->Kry_model->getMhs();
        } else {
            $mhs = $this->Kry_model->getMhs($id);
        }

        if (!empty($mhs)) {
            $this->response(
                [
                    'status' => TRUE,
                    'data' => $mhs
                ],
                REST_Controller::HTTP_OK
            );
        } else {
            $this->response(
                [
                    'status' => FALSE,
                    'data' => 'Karyawan tidak di temukan'
                ],
                REST_Controller::HTTP_NOT_FOUND
            );
        }
    }

    public function index_delete() {
        $this->load->model('Kry_model');
        $id = $this->delete('id');

        if ($id === null) {
            $this->response(
                [
                    'status' => FALSE,
                    'data' => 'Gunakan id sebagai key dan kirimkan id pengguna'
                ],
                REST_Controller::HTTP_BAD_REQUEST
            );
        } else {
            if ($this->Kry_model->delteMhs($id) > 0) {
                $this->response(
                    [
                        'status' => TRUE,
                        'data' => 'Berhasi menghapus satu karyawan'
                    ],
                    REST_Controller::HTTP_NO_CONTENT
                );
            } else {
                $this->response(
                    [
                        'status' => FALSE,
                        'data' => 'Karyawan tidak di temukan'
                    ],
                    REST_Controller::HTTP_BAD_REQUEST
                );
            }
        }
    }

    public function index_post() {
        $this->load->model('Kry_model');
        $data = [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan')
        ];

        if (!empty($data['nrp']) && !empty($data['nama']) && !empty($data['email']) && !empty($data['jurusan'])) {
            if ($this->Kry_model->addMhs($data) > 0) {
                $this->response(
                    [
                        'status' => TRUE,
                        'data' => 'Berhasil menambah satu karyawan'
                    ],
                    REST_Controller::HTTP_CREATED
                );
            } else {
                $this->response(
                    [
                        'status' => FALSE,
                        'data' => 'Gagal menambah karyawan baru'
                    ],
                    REST_Controller::HTTP_BAD_REQUEST
                );
            }
        } else {
            $this->response(
                [
                    'status' => FALSE,
                    'data' => 'Masukan permintaan yang tepat'
                ],
                REST_Controller::HTTP_BAD_REQUEST
            );
        }
    }

    public function index_put() {
        $this->load->model('Kry_model');
        $id = $this->put('id');
        $data = [
            'nrp' => $this->put('nrp'),
            'nama' => $this->put('nama'),
            'email' => $this->put('email'),
            'jurusan' => $this->put('jurusan')
        ];

        if (!empty($id) && !empty($data['nrp']) && !empty($data['nama']) && !empty($data['email']) && !empty($data['jurusan'])) {
            if ($this->Kry_model->updateMhs($data, $id) > 0) {
                $this->response(
                    [
                        'status' => TRUE,
                        'data' => 'Berhasil mengubah satu karyawan'
                    ],
                    REST_Controller::HTTP_NO_CONTENT
                );
            } else {
                $this->response(
                    [
                        'status' => FALSE,
                        'data' => 'Gagal mengubah satu karyawan'
                    ],
                    REST_Controller::HTTP_BAD_REQUEST
                );
            }
        } else {
            $this->response(
                [
                    'status' => FALSE,
                    'data' => 'Masukan permintaan yang tepat'
                ],
                REST_Controller::HTTP_BAD_REQUEST
            );
        }
    }
}

/* End of file: karyawan.php */
