<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hafalan extends CI_Controller {
    function __construct(){
        parent::__construct();
   
        if($this->session->userdata('status') != "login"){
            redirect(base_url("login"));
        }
        $this->load->model('Hafalan_model');
		$this->load->model('Kelas_model');
		$this->load->model('Santri_model');

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
		$this->load->view('hafalan/hafalan', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}

	public function detail_hafalan($id_kelas)
	{	
		// $kehadiran_data = $this->Kehadiran_model->get_kehadiran($id_kelas);
		$hafalan_data = $this->Hafalan_model->get_hafalan($id_kelas);
		$kelas_data = $this->Kelas_model->get_kelas();
		$kelas_data2 = $this->Kelas_model->get_kelas_id($id_kelas);
		$nama_lengkap = $this->Santri_model->get_nama_lengkap($id_kelas);

		
		$data = [
			"hafalan_data" => $hafalan_data,
			// "kehadiran_data" => $kehadiran_data,
			"kelas_data" => $kelas_data,
			"kelas_data2" => $kelas_data2,
			"nama_lengkap" => $nama_lengkap
		];

		$this->load->view('template/head', $data);
		$this->load->view('template/nav', $data);
		$this->load->view('template/chatbox', $data);
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('hafalan/detail_hafalan', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}

	public function hafal_santri($id_santri)
	{	
		$get_hafal = $this->Hafalan_model->get_hafal($id_santri);
		$santri_detail = $this->Santri_model->getSantriById($id_santri);
		$santri_data = $this->Santri_model->get_santri($id_santri);
		$bank_hafalan = $this->Hafalan_model->getBankHafalanNotInHafalLapor($id_santri);



		$data = [
		'get_hafal'=> $get_hafal,
		  "santri_data" => $santri_data,
		"santri_detail" => $santri_detail,
		"bank_hafalan " => $bank_hafalan 

		];

		$this->load->view('template/head', $data);
		$this->load->view('template/nav', $data);
		$this->load->view('template/chatbox', $data);
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('hafalan/hafal_santri', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}

}
