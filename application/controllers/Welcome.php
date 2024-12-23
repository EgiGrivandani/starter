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


	public function templates(){
		$data['title']      = 'Templates';
		$data['view_name']  	= 'content_t';
		$this->load->view('templates', $data);
	}


	//===============COMPRESS IMAGE=========================
	public function compressImage(){
		$data['title']      = 'Images';
		$data['view_name']  	= 'compressImage';
		$this->load->view('templates', $data);
	}

	public function compressImage_Ajax(){
		if (!$this->input->is_ajax_request()) {
			exit('No direct script access allowed');
		}
		$this->load->helper('image_helper');
		// Panggil fungsi helper dengan parameter
		$upload_result = upload_and_resize(
			'image',        // Nama field input file
			'images',       // Path folder upload (misalnya: upload/images/)
			400,            // Lebar gambar hasil resize
			400,            // Tinggi gambar hasil resize
			70              // Kualitas gambar hasil resize (opsional, default 60%)
		);

		// Kirim respons JSON ke AJAX
		echo json_encode($upload_result);
	}


	//===================DATA TABLER SERVER SIDE==============
	private function _get_datatables_query()
	{
		$column_order    = array('date_trx', 'type_trx', 'amount', 'description', 'person');
		$column_search   = array('date_trx', 'type_trx', 'amount', 'description', 'person');
		$order   = array('date_trx' => 'desc');
		$this->db->select('*');
		$this->db->from('record_trx');

		$i = 0;
		foreach ($column_search as $item) {
			if (@$_POST['search']['value']) {
				if ($i == 0) { // first loop
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				} else {
					$this->db->or_like($item, $_POST['search']['value']);
				}
				if (count($column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if (isset($_POST['order'])) { // here order processing
			$this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else{
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}
	function get_datatables()
	{
		$this->_get_datatables_query();
		if (@$_POST['length'] != -1)
			$this->db->limit(@$_POST['length'], @$_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}
	function count_all()
	{
		$this->db->from('record_trx');
		$query = $this->db->get()->result_array();
		$count = COUNT($query);
		return $count;
	}


	public function dtSideserver(){
		$list = $this->get_dataTables();
		$data = array();
		$no = @$_POST['start'];

		foreach ($list as $item) {
			$row  = array();

			$row[] = $item->date_trx;
			$row[] = $item->date_trx;
			$row[] = $item->description;
			$row[] = $item->person;

			$data[] = $row;
		}

		$output = array(
			"draw" => @$_POST['draw'],
			"recordsTotal" => $this->count_all(),
			"recordsFiltered" => $this->count_filtered(),
			"data" => $data,
		);
		echo json_encode($output);
	}
}
