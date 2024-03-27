<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    function __construct(){
        parent::__construct();
   
        // if($this->session->userdata('status') != "login"){
        //     redirect(base_url("login"));
        // }
        // $this->load->model('Home_model');
        // $this->load->model('Presensi_model');
        // $this->load->model('Hafalan_model');
        // $this->load->model('Datasantri_model');
    }
	public function index()
	{
		$data = [
            "title" => "Dashboard",
        ];
           
		$this->load->view('template/header/header', $data);
        $this->load->view('template/color/color', $data);
        $this->load->view('template/sidebar/sidebar', $data);
		$this->load->view('template/nav/nav-home', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('template/footer/footer', $data);
		$this->load->view('template/js/js', $data);
	}
}
