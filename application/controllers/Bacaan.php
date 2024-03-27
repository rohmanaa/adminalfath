<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bacaan extends CI_Controller {
    function __construct(){
        parent::__construct();
   
        if($this->session->userdata('status') != "login"){
            redirect(base_url("login"));
        }
        $this->load->model('Bacaan_model');
		 $this->load->model('Santri_model');
    }

	public function messageAlert($type, $title) {
    $messageAlert = "
    <script>
        Swal.fire({
            icon: '{$type}',
            title: '{$title}',
            showConfirmButton: false,
            timer: 3000 // Menutup pesan setelah 3 detik
        });
    </script>
    ";
    return $messageAlert;
	}


	public function index()
	{ 	$santri_data = $this->Santri_model->get_santri();
		$bacaan_data = $this->Bacaan_model->get_bacaan_data();
		
		$data = [
			"santri_data" => $santri_data,
			"bacaan_data" => $bacaan_data
		];

		$this->load->view('template/head', $data);
		$this->load->view('template/nav', $data);
		$this->load->view('template/chatbox', $data);
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('bacaan/bacaan', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}

public function tambah() {
    $id_capai = $this->input->post('id_capai', TRUE);
    $username = $this->input->post('username', TRUE);
    $tglbaca = $this->input->post('tglbaca', TRUE);
    $ketbaca = $this->input->post('ketbaca', TRUE);

    // Periksa apakah data yang diperlukan ada, Anda bisa menambahkan validasi lain sesuai kebutuhan

    $data = array(
        'username' => $username,
        'tglbaca' => $tglbaca,
        'ketbaca' => $ketbaca,
    );

    $result = $this->Bacaan_model->insert($data);

    // Menambahkan pesan Flashdata
    if ($result) {
        $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Data Tersimpan'));
        redirect('bacaan'); // Redirect to the profile page after successful update
    } else {
        $this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Gagal Simpan'));
        redirect('bacaan'); // Redirect to the profile page after successful update
    }
}



	
}
