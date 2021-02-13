<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Kriteriamodel;

class Kriteria extends BaseController
{

	protected $Kriteriamodel;
	
	public function __construct(){
		
		$this->Kriteriamodel = new Kriteriamodel();
		$pager = \Config\Services::pager();

	}

	public function index()
	{
		
		if (session()->get('username')=='') {
		
			session()->setFlashData('danger','MAAF AKSES DI TOLAK');
			return redirect()->to(base_url('login'));
		
		}

		$data=[
			'title' => 'Kriteria',
			'isi' => 'Kriteria',
			'iklim' => $this->Kriteriamodel->get_iklim(),
			'tanaman' => $this->Kriteriamodel->get_tanaman(),
			'avg_iklim' => $this->Kriteriamodel->avg_iklim(),
			'avg_tekanan' => $this->Kriteriamodel->avg_tekanan(),
			'avg_kecepatan' => $this->Kriteriamodel->avg_kecepatan()
		];
		echo view('layout/content',$data);

	}

	public function tambah_data_iklim()
	{
		$tahun = $this->request->getPost('tahun');
		$bulan = $this->request->getPost('bulan');
		$hari = '01';
		$tanggal = "$tahun-$bulan-$hari";
		$tgl = date('Y-m-d', strtotime($tanggal));
		$tekanan = $this->request->getPost('tekanan_udara');
		$kecepatan = $this->request->getPost('kecepatan_angin');
		$kelembaban = $this->request->getPost('kelembaban_udara');

		if(preg_match("/[a-z]/", $tekanan)){
			
			session()->setFlashdata('warning','maaf inputan tekanan harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $tekanan)) {
			
			session()->setFlashdata('warning','maaf inputan tekanan tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));
		
		}elseif (preg_match("/[a-z]/", $kecepatan)) {
			
			session()->setFlashdata('warning','maaf inputan kecepatan harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $kecepatan)) {
			
			session()->setFlashdata('warning','maaf inputan kecepatan tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/[a-z]/", $kelembaban)) {
			
			session()->setFlashdata('warning','maaf inputan kelembaban harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $kelembaban)) {
			
			session()->setFlashdata('warning','maaf inputan kelembaban tidak memenuhi format. penggunaan ( , ) tidak di perbolehka,n inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));

		}

		$data =
		[
			'date' => $tgl,
			'tekanan_udara' => $tekanan,
			'kecepatan_angin' => $kecepatan,
			'kelembaban_udara' => $kelembaban
		];

		$check = $this->Kriteriamodel->iklim($tgl);

		if (($check['date'] == $tgl)) {
			
			session()->setFlashdata('warning','bulan sudah ada');

			return redirect()->to(base_url('kriteria'));
		
		}elseif ($bulan == "-- Pilih Bulan --") {

			session()->setFlashdata('warning','tolong isi bulan dengan benar');

			return redirect()->to(base_url('kriteria'));

		}elseif ($data['kelembaban_udara'] > 100) {
			
			session()->setFlashdata('warning','kelembaban udara tidak boleh lebih dari 100');

			return redirect()->to(base_url('kriteria'));
		
		}elseif ($data['kelembaban_udara'] <= 0) {
			
			session()->setFlashdata('warning','kelembaban udara harus lebih dari 0');

			return redirect()->to(base_url('kriteria'));
		}else{

		$this->Kriteriamodel->insert_iklim($data);

		session()->setFlashdata('success','Data berhasil ditambahkan');

		return redirect()->to(base_url('kriteria'));

		}
	}

	public function edit_data_iklim($id_iklim)
	{
		$tekanan = $this->request->getPost('tekanan_udara');
		$kecepatan = $this->request->getPost('kecepatan_angin');
		$kelembaban = $this->request->getPost('kelembaban_udara');

		if(preg_match("/[a-z]/", $tekanan)){
			
			session()->setFlashdata('warning','maaf inputan tekanan harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $tekanan)) {
			
			session()->setFlashdata('warning','maaf inputan tekanan tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/[a-z]/", $kecepatan)) {
			
			session()->setFlashdata('warning','maaf inputan kecepatan harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $kecepatan)) {
			
			session()->setFlashdata('warning','maaf inputan kecepatan tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/[a-z]/", $kelembaban)) {
			
			session()->setFlashdata('warning','maaf inputan kelembaban harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $kelembaban)) {
			
			session()->setFlashdata('warning','maaf inputan kelembaban tidak memenuhi format. penggunaan ( , ) tidak di perbolehka,n inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));

		}

		$data =
		[
			'tekanan_udara' => $tekanan,
			'kecepatan_angin' => $kecepatan,
			'kelembaban_udara' => $kelembaban
		];

		$this->Kriteriamodel->edit_iklim($data, $id_iklim);

		session()->setFlashdata('success','Data berhasil diupdate');

		return redirect()->to(base_url('kriteria'));
	}

	public function delete_data_iklim($id_iklim)
	{

		$this->Kriteriamodel->delete_iklim($id_iklim);

		session()->setFlashdata('success','Data berhasil dihapus');

		return redirect()->to(base_url('kriteria'));
	
	}

	public function edit_data_tanaman($id_tnm){
		$data =
		[
			'nm_tnm' => $this->request->getPost('nm_tnm'),
			'suhu_tnm' => $this->request->getPost('suhu_tnm'),
			'kelembaban_tnm' => $this->request->getPost('kelembaban_tnm'),
			'curah_tnm' => $this->request->getPost('curah_tnm'),
			'ketinggian_tnm' => $this->request->getPost('ketinggian_tnm')
		];
		
		if(preg_match("/[a-z]/", $data['suhu_tnm'])){
			
			session()->setFlashdata('warning','maaf inputan suhu tanaman harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $data['suhu_tnm'])) {
			
			session()->setFlashdata('warning','maaf inputan suhu tanaman tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));

		}elseif ($data['suhu_tnm'] > 360) {
			
			session()->setFlashdata('warning','suhu tidak boleh lebih dari 360');

			return redirect()->to(base_url('kriteria'));

		}elseif ($data['suhu_tnm'] <= 0) {
			
			session()->setFlashdata('warning','suhu harus lebih dari 0');

			return redirect()->to(base_url('kriteria'));

		}elseif(preg_match("/[a-z]/", $data['kelembaban_tnm'])){
			
			session()->setFlashdata('warning','maaf inputan kelembaban tanaman harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $data['kelembaban_tnm'])) {
			
			session()->setFlashdata('warning','maaf inputan kelembaban tanaman tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));

		}elseif ($data['kelembaban_tnm'] > 100 ) {
			
			session()->setFlashdata('warning','kelembaban udara tidak boleh lebih dari 100');

			return redirect()->to(base_url('kriteria'));

		}elseif(preg_match("/[a-z]/", $data['curah_tnm'])){
			
			session()->setFlashdata('warning','maaf inputan curah tanaman harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $data['curah_tnm'])) {
			
			session()->setFlashdata('warning','maaf inputan curah tanaman tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));

		}elseif(preg_match("/[a-z]/", $data['ketinggian_tnm'])){
			
			session()->setFlashdata('warning','maaf inputan ketinggian tanaman harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $data['ketinggian_tnm'])) {
			
			session()->setFlashdata('warning','maaf inputan ketinggian tanaman tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));

		}

		$this->Kriteriamodel->edit_tanaman($data, $id_tnm);

		session()->setFlashdata('success','Data berhasil diupdate');

		return redirect()->to(base_url('kriteria'));
	}

	public function delete_data_tnm($id_tnm)
	{

		$this->Kriteriamodel->delete_tanaman($id_tnm);

		session()->setFlashdata('success','Data berhasil dihapus');

		return redirect()->to(base_url('kriteria'));
	
	}

	public function edit_data_bobot(){
		$data = 
		[	
			$this->request->getPost('ji'),
			$this->request->getPost('wa'),
			$this->request->getPost('lu'),
			$this->request->getPost('pat'),
			$this->request->getPost('ma'),
			$this->request->getPost('nam')
		];
		
		if(preg_match("/[a-z]/", $data[0])){
			
			session()->setFlashdata('warning','maaf inputan harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $data[0])) {
			
			session()->setFlashdata('warning','maaf inputan tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));
		
		}elseif(preg_match("/[a-z]/", $data[1])){
			
			session()->setFlashdata('warning','maaf inputan harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $data[1])) {
			
			session()->setFlashdata('warning','maaf inputan tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));
		
		}elseif(preg_match("/[a-z]/", $data[2])){
			
			session()->setFlashdata('warning','maaf inputan harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $data[2])) {
			
			session()->setFlashdata('warning','maaf inputan tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));
		
		}elseif(preg_match("/[a-z]/", $data[3])){
			
			session()->setFlashdata('warning','maaf inputan harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $data[3])) {
			
			session()->setFlashdata('warning','maaf inputan tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));
		
		}elseif(preg_match("/[a-z]/", $data[4])){
			
			session()->setFlashdata('warning','maaf inputan harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $data[4])) {
			
			session()->setFlashdata('warning','maaf inputan tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));
		
		}elseif(preg_match("/[a-z]/", $data[5])){
			
			session()->setFlashdata('warning','maaf inputan harus angka');

			return redirect()->to(base_url('kriteria'));

		}elseif (preg_match("/,/", $data[5])) {
			
			session()->setFlashdata('warning','maaf inputan tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('kriteria'));
		
		}

		$file = "jason/bobot.json";
		$getfile = file_get_contents($file);
		$bobot = json_decode($getfile, true);
		
		for ($i=0; $i <6 ; $i++) { 
			$bobot[$i] = $data[$i];
		}
		
		$anying = json_encode($bobot, JSON_PRETTY_PRINT);
		file_put_contents($file, $anying);

		return redirect()->to(base_url('kriteria'));


	}
}	