<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {
	public function __construct()
	{
		parent::__construct();
	}

	public function index(){
		//basic data harus di panggil pertama sebelum array $data[] lain
		$data 	=  $this->_basicData();

		$data['title']      = 'Log Action';
		$data['view_name']  = 'content_t';
		$this->load->view('templates', $data);
	}
}
