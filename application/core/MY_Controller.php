<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	// =========== variable global
	protected $idUSER   = '';
	protected $roleUSER = '';
	protected $arrUSER  = '';

	public function __construct()
	{
		parent::__construct();
		//load segala kebutuhan yang sering digunakan
		$id  = nuil ;//ambil dari session
		$current = null ;// query ke table admin mencari berdasarkan id
		if (!$current) {
			redirect('Admin'); // lempar ke login dan destroy session
		}

		$this->idUSER   = $current->id_user;  //data id hasil query
		$this->roleUSER = $current->role_user; //data role hasil query
		$this->arrUSER  = $current;
	}


	public function _ONLY_SU()
	{
		if ($this->roleUSER == 1) {
			return true;
		} else {
			redirect('Admin'); // lempar ke login dan destroy session
		}
	}

	public function _ONLYSELECTED($arr)
	{

		if (in_array($this->roleUSER, $arr)) {
			return true;
		} else {
			redirect('Admin'); // lempar ke login dan destroy session
		}
	}

	public function _isAjax()
	{
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
	}

	public function _basicData()
	{
		$data['idUser']     = $this->idUSER;
		$data['user']       = $this->arrUSER;
		$data['role']       = $this->roleUSER;
		return $data;
	}
}
