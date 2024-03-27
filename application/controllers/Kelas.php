<?php

class Kelas extends CI_Controller {
    public function index() {
        $this->load->model('Kelas_model');
        $data['kelas'] = $this->Kelas_model->get_kelas();

        $this->load->view('kelas_view', $data);
    }
}
