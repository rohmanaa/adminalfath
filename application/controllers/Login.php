<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Login_model');


    }
	public function index()
	{

		$this->load->view('login/login');
	}

    	public function messageAlert($type, $title) {
		$messageAlert = "
		const Toast = Swal.mixin({
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 5000
		});

		Toast.fire({
				type: '".$type."',
				title: '".$title."'
		});
		";
		return $messageAlert;
		}

	 public function aksi_login(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $where = array(
                'username' => $username,
                'password' => $password
            );
            
            // Cek apakah pengguna valid
            $cek = $this->Login_model->cek_login("tb_admin", $where)->num_rows();
            
            if ($cek > 0) {
                $data_session = array(
                    'username' => $username,
                    'status' => "login"
                );
            
                // Tambahkan cookie "remember me" jika kotak centang "Remember Me" dicentang
                if ($this->input->post('remember_me')) {
                    $this->create_remember_me_cookie($username);
                }
            
                $this->session->set_userdata($data_session);
                redirect(base_url("dashboard"));
            } else {
                $this->session->set_flashdata('messageAlert', $this->messageAlert('danger', 'Gagal Simpan'));
                redirect('login'); // Redirect to the editdata page if there's an error
            }
        }
    
        private function create_remember_me_cookie($username)
        {
            $token = bin2hex(random_bytes(32)); // Generate token acak
            $expire = time() + 60 * 60 * 24 * 30; // Cookie akan berlaku selama 30 hari (sesuaikan sesuai kebutuhan Anda)
            
            $this->load->helper('cookie');
            $cookie_data = array(
                'name' => 'remember_me',
                'value' => $username . ':' . $token,
                'expire' => $expire,
                'secure' => false
            );
            
            set_cookie($cookie_data);
        }
    
        public function logout()
        {
            // Hapus cookie "remember me"
            delete_cookie('remember_me');
            
            $this->session->sess_destroy();
            redirect(base_url('dashboard'));
        }
}
