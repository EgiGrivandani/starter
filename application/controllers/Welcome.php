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


	//OPTION RELATION
	private function _sampleCategoriesDB(){
		$categories = [
			['id_kategori' => 1, 'name_kategori' => 'Income', 'type_kategori' => 'I'],
			['id_kategori' => 2, 'name_kategori' => 'Expenses', 'type_kategori' => 'E'],
			['id_kategori' => 3, 'name_kategori' => 'Assets', 'type_kategori' => 'A'],
			['id_kategori' => 4, 'name_kategori' => 'Liabilities', 'type_kategori' => 'L'],
			['id_kategori' => 5, 'name_kategori' => 'Equity', 'type_kategori' => 'E'],
		];
		return $categories;
	}

	public function _sampleAccountDB($category){
		$account_code = [
			['id_code' => 1, 'id_kategori' => 1, 'code' => 401, 'name_code' => 'Pendapatan Penjualan Produk'],
			['id_code' => 2, 'id_kategori' => 1, 'code' => 402, 'name_code' => 'Pendapatan Jasa'],
			['id_code' => 3, 'id_kategori' => 1, 'code' => 403, 'name_code' => 'Pendapatan Langganan (Subscription)'],
			['id_code' => 4, 'id_kategori' => 1, 'code' => 404, 'name_code' => 'Pendapatan Servis'],
			['id_code' => 5, 'id_kategori' => 1, 'code' => 405, 'name_code' => 'Pendapatan Penjualan Produk Tambahan'],
			['id_code' => 6, 'id_kategori' => 1, 'code' => 411, 'name_code' => 'Pendapatan Sewa Gedung'],
			['id_code' => 7, 'id_kategori' => 1, 'code' => 412, 'name_code' => 'Pendapatan Sewa Peralatan'],
			['id_code' => 8, 'id_kategori' => 1, 'code' => 413, 'name_code' => 'Pendapatan Komisi'],
			['id_code' => 9, 'id_kategori' => 1, 'code' => 414, 'name_code' => 'Pendapatan Denda Pelanggan'],
			['id_code' => 10, 'id_kategori' => 1, 'code' => 415, 'name_code' => 'Pendapatan Royalti'],
			['id_code' => 11, 'id_kategori' => 1, 'code' => 416, 'name_code' => 'Pendapatan Investasi'],
			['id_code' => 12, 'id_kategori' => 1, 'code' => 421, 'name_code' => 'Keuntungan Penjualan Aset Tetap'],
			['id_code' => 13, 'id_kategori' => 1, 'code' => 422, 'name_code' => 'Pendapatan Hibah/Donasi'],
			['id_code' => 14, 'id_kategori' => 1, 'code' => 423, 'name_code' => 'Pendapatan dari Selisih Kurs Mata Uang'],
			['id_code' => 15, 'id_kategori' => 1, 'code' => 424, 'name_code' => 'Pendapatan Lain yang Tidak Terduga'],
			['id_code' => 16, 'id_kategori' => 1, 'code' => 431, 'name_code' => 'Pelunasan Piutang Jasa'],
			['id_code' => 17, 'id_kategori' => 1, 'code' => 432, 'name_code' => 'Pelunasan Piutang Penjualan'],
			['id_code' => 18, 'id_kategori' => 2, 'code' => 501, 'name_code' => 'Biaya Produksi Bahan Baku'],
			['id_code' => 19, 'id_kategori' => 2, 'code' => 502, 'name_code' => 'Biaya Produksi Tenaga Kerja'],
			['id_code' => 20, 'id_kategori' => 2, 'code' => 503, 'name_code' => 'Biaya Overhead Produksi'],
			['id_code' => 21, 'id_kategori' => 2, 'code' => 504, 'name_code' => 'Biaya Packing dan Pengiriman'],
			['id_code' => 22, 'id_kategori' => 2, 'code' => 511, 'name_code' => 'Biaya Gaji dan Tunjangan'],
			['id_code' => 23, 'id_kategori' => 2, 'code' => 512, 'name_code' => 'Biaya Listrik dan Air'],
			['id_code' => 24, 'id_kategori' => 2, 'code' => 513, 'name_code' => 'Biaya Internet dan Telepon'],
			['id_code' => 25, 'id_kategori' => 2, 'code' => 514, 'name_code' => 'Biaya Sewa Gedung'],
			['id_code' => 26, 'id_kategori' => 2, 'code' => 515, 'name_code' => 'Biaya Transportasi dan Perjalanan Dinas'],
			['id_code' => 27, 'id_kategori' => 2, 'code' => 516, 'name_code' => 'Biaya Marketing dan Iklan'],
			['id_code' => 28, 'id_kategori' => 2, 'code' => 517, 'name_code' => 'Biaya Pemeliharaan dan Perbaikan'],
			['id_code' => 29, 'id_kategori' => 2, 'code' => 518, 'name_code' => 'Biaya ATK (Alat Tulis Kantor)'],
			['id_code' => 30, 'id_kategori' => 2, 'code' => 521, 'name_code' => 'Biaya Bunga Pinjaman'],
			['id_code' => 31, 'id_kategori' => 2, 'code' => 522, 'name_code' => 'Biaya Penyusutan Aset Tetap'],
			['id_code' => 32, 'id_kategori' => 2, 'code' => 523, 'name_code' => 'Biaya Pajak dan Retribusi'],
			['id_code' => 33, 'id_kategori' => 2, 'code' => 524, 'name_code' => 'Biaya Hukum dan Konsultan'],
			['id_code' => 34, 'id_kategori' => 2, 'code' => 525, 'name_code' => 'Biaya Lain yang Tidak Terduga'],
			['id_code' => 35, 'id_kategori' => 2, 'code' => 531, 'name_code' => 'Biaya Denda'],
			['id_code' => 36, 'id_kategori' => 2, 'code' => 532, 'name_code' => 'Biaya Keanggotaan/Subscription'],
			['id_code' => 37, 'id_kategori' => 2, 'code' => 533, 'name_code' => 'Biaya CSR (Corporate Social Responsibility)'],
			['id_code' => 38, 'id_kategori' => 3, 'code' => 101, 'name_code' => 'Kas dan Bank'],
			['id_code' => 39, 'id_kategori' => 3, 'code' => 102, 'name_code' => 'Piutang Usaha'],
			['id_code' => 40, 'id_kategori' => 3, 'code' => 103, 'name_code' => 'Persediaan Barang'],
			['id_code' => 41, 'id_kategori' => 3, 'code' => 104, 'name_code' => 'Aset Tetap - Bangunan'],
			['id_code' => 42, 'id_kategori' => 3, 'code' => 105, 'name_code' => 'Aset Tetap - Kendaraan'],
			['id_code' => 43, 'id_kategori' => 3, 'code' => 106, 'name_code' => 'Aset Tetap - Peralatan'],
			['id_code' => 44, 'id_kategori' => 3, 'code' => 107, 'name_code' => 'Investasi Jangka Panjang'],
			['id_code' => 45, 'id_kategori' => 4, 'code' => 201, 'name_code' => 'Hutang Usaha'],
			['id_code' => 46, 'id_kategori' => 4, 'code' => 202, 'name_code' => 'Hutang Bank'],
			['id_code' => 47, 'id_kategori' => 4, 'code' => 203, 'name_code' => 'Hutang Pajak'],
			['id_code' => 48, 'id_kategori' => 4, 'code' => 204, 'name_code' => 'Hutang Gaji'],
			['id_code' => 49, 'id_kategori' => 4, 'code' => 205, 'name_code' => 'Uang Muka dari Pelanggan'],
			['id_code' => 50, 'id_kategori' => 4, 'code' => 206, 'name_code' => 'Hutang Jangka Panjang'],
			['id_code' => 51, 'id_kategori' => 5, 'code' => 301, 'name_code' => 'Modal Disetor'],
			['id_code' => 52, 'id_kategori' => 5, 'code' => 302, 'name_code' => 'Laba Ditahan'],
			['id_code' => 53, 'id_kategori' => 5, 'code' => 303, 'name_code' => 'Laba Tahun Berjalan']
		];

		$filtered = array_filter($account_code, fn($code) => $code['id_kategori'] == $category);
		return array_values($filtered);

	}

	public function option(){

		$data['title']	= 'Options';
		$data['ctg']	= $this->_sampleCategoriesDB(); //ganti dengan query ke db
		$data['view_name']  = 'optionRelation';
		$this->load->view('templates', $data);

	}

	public function option_acc(){
		$id = $this->input->post('category_id', true);
		$query = $this->_sampleAccountDB($id);  //ganti dengan query ke database
		if(empty($query)){
			echo json_encode([
				'status' => false,
				'message' => 'Data tidak ditemukan'
			]);
			return false;
		}

		echo json_encode([
			'status' => true,
			'data' => $query
		]);
	}
}
