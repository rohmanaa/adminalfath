<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datasantri extends CI_Controller {
    function __construct(){
        parent::__construct();
   
        if($this->session->userdata('status') != "login"){
            redirect(base_url("login"));
        }
        $this->load->model('Santri_model');
		$this->load->model('Kelas_model');
		$this->load->model('Bacaan_model');
		$this->load->model('Koin_model');
		$this->load->model('Hafalan_model');
        $this->load->model('Prestasi_model');
        $this->load->model('Kehadiran_model');

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
		$santri_data = $this->Santri_model->get_santri();
		$kelas = $this->Kelas_model->get_kelas();
        


		$data = [
			"santri_data" => $santri_data,
			"kelas" => $kelas,
            
		];


		$this->load->view('template/head', $data);
		$this->load->view('template/nav', $data);
		$this->load->view('template/chatbox', $data);
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('santri/datasantri', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}

		public function detail_santri($id_santri)
	{
		$santri_detail = $this->Santri_model->getSantriById($id_santri);
		$bacaan_data = $this->Bacaan_model->getBacaan($id_santri);
		$koin_data = $this->Koin_model->getKoin($id_santri);
		$kelas = $this->Kelas_model->get_kelas();
		$total_id_hafal = $this->Hafalan_model->get_id_hafal_by_id_santri($id_santri);
        $santri_data = $this->Santri_model->get_santri();
        $prestasi = $this->Prestasi_model->data_prestasi($id_santri);
        $kehadiran = $this->Kehadiran_model->getCountByIdSantri($id_santri);

		$data = [
            "santri_data" => $santri_data,
			"santri_detail" => $santri_detail,
			"kelas" => $kelas,
			"bacaan_data" => $bacaan_data,
			"koin_data" => $koin_data,
			"total_id_hafal" => $total_id_hafal,
            "prestasi" => $prestasi,
            "kehadiran" =>  $kehadiran
		];


		$this->load->view('template/head', $data);
		$this->load->view('template/nav', $data);
		$this->load->view('template/chatbox', $data);
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('santri/detail_santri', $data);
		$this->load->view('template/footer', $data);
		$this->load->view('template/script', $data);
	}

	public function tambah()
    {
				$tahun_masuk = $this->input->post('tahun_masuk', TRUE);
				$kode_tahun_masuk = substr($tahun_masuk, -2);
				$tgl = 4;
				$pw = 3107;
				$last_number = $this->db->query("SELECT MAX(id_santri) AS last_number FROM santri")->row()->last_number;
				$next_number = $last_number + 1;
				$nilai = str_pad($next_number, 3, '0', STR_PAD_LEFT);

				$nourut = $kode_tahun_masuk . $tgl . $nilai;

				$data = array(
					'nama_lengkap' => ucwords($this->input->post('nama_lengkap', TRUE)),
					'username' => $nourut,
					'id_santri' => $this->input->post('id_santri', TRUE),
					'tahun_masuk' => $tahun_masuk,  // Simpan tahun_masuk asli
					'password' => $pw,
					'id_kelas' => $this->input->post('id_kelas', TRUE),
					'status_santri' => $this->input->post('status_santri', TRUE),
				);

				
				$result = $this->Santri_model->insert($data);
				// Selanjutnya, Anda dapat menggunakan $data dalam operasi yang sesuai.			
				if ($result) {
					$this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Data Tersimpan'));
					redirect('datasantri'); // Redirect to the profile page after successful update
				} else {
					$this->session->set_flashdata('messageAlert', $this->messageAlert('danger', 'Gagal Simpan'));
					redirect('datasantri'); // Redirect to the editdata page if there's an error
				}
			}
    

    function formatNbr($nbr)
    {
        if ($nbr == 0)
            return "001";
        else if ($nbr < 10)
            return "00" . $nbr;
        elseif ($nbr >= 10 && $nbr < 100)
            return "0" . $nbr;
        else
            return strval($nbr);
    }

	public function toggleStatus() {
        $id_santri = $this->input->post('id_santri');
        $status_santri = $this->input->post('status_santri');
        $result = $this->Santri_model->updateSantriStatus($id_santri, $status_santri);

        if ($result) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false));
        }
    }

    public function updatestatus($id_santri, $newStatus) {
        $this->Santri_model->updatestatus($id_santri, $newStatus);
        redirect('datasantri'); // Ganti 'halaman_utama' dengan URL yang sesuai
    }

        public function updatestatus_detail($id_santri, $newStatus) {
        $this->Santri_model->updatestatus($id_santri, $newStatus);
        redirect('datasantri/detail_santri/' . $id_santri); // Refresh the current page if there's an error
    }

	 public function save_profil() {
        $id_santri = $this->input->post('id_santri', TRUE);
        $nama_lengkap = $this->input->post('nama_lengkap', TRUE);
        $tempat_lahir = $this->input->post('tempat_lahir', TRUE);
        $tanggal_lahir = $this->input->post('tanggal_lahir', TRUE);
        $jenis_kelamin = $this->input->post('jenis_kelamin', TRUE);
		$nama_ayah = $this->input->post('nama_ayah', TRUE);
        $nama_ibu = $this->input->post('nama_ibu', TRUE);
		$no_wa = $this->input->post('no_wa', TRUE);
        $alamat = $this->input->post('alamat', TRUE);
		$kelas_sekolah = $this->input->post('kelas_sekolah', TRUE);
		$asal_sekolah = $this->input->post('asal_sekolah', TRUE);
        $password = $this->input->post('password', TRUE);
            
        // Periksa apakah data yang diperlukan ada, Anda bisa menambahkan validasi lain sesuai kebutuha
    
        $data = array(
            'nama_lengkap' => $nama_lengkap,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $jenis_kelamin,
            'alamat' => $alamat,
            'kelas_sekolah' => $kelas_sekolah,
            'password' => $password,
            'nama_ayah' => $nama_ayah,
            'nama_ibu' => $nama_ibu,
            'no_wa' => $no_wa,
			'kelas_sekolah' => $kelas_sekolah,
			'asal_sekolah' => $asal_sekolah,
            
        );
    
        $result = $this->Santri_model->update($id_santri, $data);
    
        if ($result) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Data Tersimpan'));
            redirect('datasantri'); // Redirect to the profile page after successful update
        } else {
			$this->session->set_flashdata('messageAlert', $this->messageAlert('danger', 'Gagal Simpan'));
			redirect('datasantri/detail_santri/' . $id_santri); // Refresh the current page if there's an error
		}
    }

    public function save_santri() {
        $id_santri = $this->input->post('id_santri', TRUE);
		$id_kelas = $this->input->post('id_kelas', TRUE);
		$id_quran= $this->input->post('id_quran', TRUE);
        $status_santri = $this->input->post('status_santri', TRUE);
            
        // Periksa apakah data yang diperlukan ada, Anda bisa menambahkan validasi lain sesuai kebutuha
    
        $data = array(
            
            'id_kelas' => $id_kelas,
			'id_quran' => $id_quran,
			'status_santri' => $status_santri,
            
        );
    
        $result = $this->Santri_model->update($id_santri, $data);
    
        if ($result) {
            $this->session->set_flashdata('messageAlert', $this->messageAlert('success', 'Data Tersimpan'));
            redirect('datasantri'); // Redirect to the profile page after successful update
        } else {
			$this->session->set_flashdata('messageAlert', $this->messageAlert('danger', 'Gagal Simpan'));
			redirect('datasantri/detail_santri/' . $id_santri); // Refresh the current page if there's an error
		}
    }

        public function delete($id_santri) {
            // Lakukan operasi penghapusan data dari database berdasarkan $id_santri
            $result = $this->Santri_model->deleteSantri($id_santri);

            if ($result) {
                // Jika penghapusan berhasil
                $this->session->set_flashdata('message', 'Data santri berhasil dihapus');
            } else {
                // Jika penghapusan gagal
                $this->session->set_flashdata('message', 'Terjadi kesalahan saat menghapus data santri');
            }

            // Redirect ke halaman utama atau halaman yang sesuai
            redirect('datasantri');
        }



}
