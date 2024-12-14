<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {



	public function index()
	{
		$this->load->view('formwithjquery');
	}

	public function submitWithAjax()
	{
		// Mencegah request selain ajax
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}

		//bisa juga menggunakan form validasi
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[20]',[
			'required' => 'Username is required.',
			'min_length' => 'Username is too short.',
			'max_length' => 'Username is too long.'
		]);
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|max_length[20]',[
			'required' => 'Password is required.',
			'min_length' => 'Password is too short.',
			'max_length' => 'Password is too long.'
		]);

		//mengecek validasi form
		if(!$this->form_validation->run()){
			echo json_encode([
				'status' => false,
				'message' => validation_errors()
			]);
			return false;
		}
		
		//mengambil name dari isi form yang dikirim
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);

		//mengembalikan nilai atauu hasil ke ajax menggunakan json
		echo json_encode([
			'status' => true,
			'message' => $username.' '.$password
		]);

	}
}
