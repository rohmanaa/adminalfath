<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kehadiran extends CI_Controller {
    function __construct(){
        parent::__construct();
   
        if($this->session->userdata('status') != "login"){
            redirect(base_url("login"));
        }
        $this->load->model('Santri_model');
		$this->load->model('Kelas_model');
    }

	public function messageAlert($type, $title)
    {
        $messageAlert = "
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 5000
      });
      Toast.fire({
          type: '" . $type . "',
          title: '" . $title . "'
      });
      ";
        return $messageAlert;
    }

	
	public function index()
	{	
		
		$kelas_data = $this->Kelas_model->get_kelas();
		
		$data = [
			"kelas_data" => $kelas_data
		];

		$this->load->view('template/head', $data);
		$this->load->view('template/nav', $data);
		$this->load->view('template/chatbox', $data);
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('kehadiran/kehadiran', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}


	public function detail_kehadiran($id_kelas)
	{	
		$kehadiran_data = $this->Kehadiran_model->get_kehadiran($id_kelas);
		$kelas_data = $this->Kelas_model->get_kelas();
		$kelas_data2 = $this->Kelas_model->get_kelas_id($id_kelas);
		$nama_lengkap = $this->Santri_model->get_nama_lengkap($id_kelas);

		
		$data = [
			"kehadiran_data" => $kehadiran_data,
			"kelas_data" => $kelas_data,
			"kelas_data2" => $kelas_data2,
			"nama_lengkap" => $nama_lengkap
		];

		$this->load->view('template/head', $data);
		$this->load->view('template/nav', $data);
		$this->load->view('template/chatbox', $data);
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('kehadiran/detail_kehadiran', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}

	public function manualabsen() 
	{
		$id_absen = $this->input->post('id_absen', TRUE);
		$id_khd = $this->input->post('id_khd', TRUE);
		$username = $this->input->post('username', TRUE);
		$tgl = date('Y-m-d');
		$id_status = $this->input->post('id_status', TRUE);

		$data = array(
			'id_khd' => $id_khd,
			'username' => $username,
			'tgl' => $tgl,
			'id_status' => $id_status,
		);

		$result = $this->Kehadiran_model->insert($data);

		// Menambahkan pesan Flashdata
		if ($result) {
			$this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Data Tersimpan'));
			redirect('detail_kehadiran/' . $id_kelas); // Redirect to the profile page after successful update
		} else {
			$this->session->set_flashdata('messageAlert', $this->messageAlert('error', 'Gagal Simpan'));
			redirect('detail_kehadiran/' . $id_kelas); // Redirect to the profile page after successful update
		}
    }

}
