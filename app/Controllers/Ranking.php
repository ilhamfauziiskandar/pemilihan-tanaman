<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Rankingmodel;

class Ranking extends BaseController
{

	protected $Rankingmodel;
	
	public function __construct(){
		
		$this->Rankingmodel = new Rankingmodel();
	}

	public function index()
	{
		if (session()->get('username')=='') {
		
			session()->setFlashData('danger','MAAF AKSES DI TOLAK');
			return redirect()->to(base_url('login'));
		
		}
		$id_user = session()->get('id_user');

		if (session()->get('level')== '1') {
			$data=
			[
				'title'=> 'Ranking',
				'isi' => 'ranking',
				'get_nilai_parameter' => $this->Rankingmodel->get_nilai_parameter()

			];

		}else
			$data=
			[
				'title'=> 'Ranking',
				'isi' => 'ranking',
				'get_nilai_parameter' => $this->Rankingmodel->get_nilai_parameter1($id_user)

			];
		echo view('layout/content',$data);
	}

	public function tambah_data_nilai()
	{
		$suhu = $this->request->getPost('suhu');
		$tekanan = $this->request->getPost('tekanan_udara');
		$kecepatan = $this->request->getPost('kecepatan_angin');
		$kelembaban = $this->request->getPost('kelembaban_udara');
		$curah = $this->request->getPost('curah_hujan');
		$ketinggian = $this->request->getPost('ketinggian_tempat');

		if(preg_match("/[a-z]/", $suhu)){
			
			session()->setFlashdata('warning','maaf inputan suhu harus angka');

			return redirect()->to(base_url('ranking'));

		}elseif (preg_match("/,/", $suhu)) {
			
			session()->setFlashdata('warning','maaf inputan suhu tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('ranking'));

		}elseif(preg_match("/[a-z]/", $tekanan)){
			
			session()->setFlashdata('warning','maaf inputan tekanan harus angka');

			return redirect()->to(base_url('ranking'));

		}elseif (preg_match("/,/", $tekanan)) {
			
			session()->setFlashdata('warning','maaf inputan tekanan tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('ranking'));

		}elseif (preg_match("/[a-z]/", $kecepatan)) {
			
			session()->setFlashdata('warning','maaf inputan kecepatan harus angka');

			return redirect()->to(base_url('ranking'));

		}elseif (preg_match("/,/", $kecepatan)) {
			
			session()->setFlashdata('warning','maaf inputan kecepatan tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('ranking'));

		}elseif (preg_match("/[a-z]/", $kelembaban)) {
			
			session()->setFlashdata('warning','maaf inputan kelembaban harus angka');

			return redirect()->to(base_url('alternatif'));

		}elseif (preg_match("/,/", $kelembaban)) {
			
			session()->setFlashdata('warning','maaf inputan kelembaban tidak memenuhi format. penggunaan ( , ) tidak di perbolehka,n inputan harus ( . )');

			return redirect()->to(base_url('ranking'));

		}elseif(preg_match("/[a-z]/", $curah)){
			
			session()->setFlashdata('warning','maaf inputan curah harus angka');

			return redirect()->to(base_url('ranking'));

		}elseif (preg_match("/,/", $tekanan)) {
			
			session()->setFlashdata('warning','maaf inputan curah tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('ranking'));

		}elseif(preg_match("/[a-z]/", $ketinggian)){
			
			session()->setFlashdata('warning','maaf inputan ketinggian harus angka');

			return redirect()->to(base_url('ranking'));

		}elseif (preg_match("/,/", $tekanan)) {
			
			session()->setFlashdata('warning','maaf inputan ketinggian tidak memenuhi format. penggunaan ( , ) tidak di perbolehkan, inputan harus ( . )');

			return redirect()->to(base_url('ranking'));

		}

		$data =
		[	
			'tanggal' => $this->request->getPost('tanggal'),
			'suhu_param' => $suhu,
			'tekanan_param' => $tekanan,
			'kecepatan_param' => $kecepatan,
			'kelembaban_param' => $kelembaban,
			'curah_param' => $curah,
			'ketinggian_param' => $ketinggian
		];

		if ($data['suhu_param'] > 360) {
			
			session()->setFlashdata('warning','suhu tidak boleh lebih dari 360');

			return redirect()->to(base_url('ranking'));

		}elseif ($data['suhu_param'] <= 0) {
			
			session()->setFlashdata('warning','suhu harus lebih dari 0');

			return redirect()->to(base_url('ranking'));

		}elseif ($data['kelembaban_param'] > 100 ) {
			
			session()->setFlashdata('warning','kelembaban udara tidak boleh lebih dari 100');

			return redirect()->to(base_url('ranking'));
		}else{		

		$this->Rankingmodel->insert_nilai_parameter($data);

		session()->setFlashdata('success','Data berhasil ditambahkan');

		return redirect()->to(base_url('ranking'));

		}
	}

	public function delete_data_nilai($id_nilai){

		$this->Rankingmodel->delete_nilai_parameter($id_nilai);

		session()->setFlashdata('success','Data berhasil dihapus');

		return redirect()->to(base_url('ranking'));
	
	}

	public function nilai_bobot(){
		
		$bobot = array(
			array('-13563741600'),
			array('0'),
			array('5865264000'),
			array('-1.10912E+11'),
			array('-56263680000'),
			array('-617760000'),
			array('1.40897E+11'),
			array('-1.44369E+11')
		);
	
	}

	public function dataranking($id_nilai)
	{
		$data=
		[
			'title'=> 'Data Ranking',
			'isi' => 'dataranking',
			'parameter' => $this->Rankingmodel->get_parameter($id_nilai),
			'iklim' => $this->Rankingmodel->get_iklim(),
			'tanaman' => $this->Rankingmodel->get_tanaman(),
			'avg_iklim' => $this->Rankingmodel->avg_iklim(),
			'avg_tekanan' => $this->Rankingmodel->avg_tekanan(),
			'avg_kecepatan' => $this->Rankingmodel->avg_kecepatan()
		];

		$tanaman = $this->Rankingmodel->get_tanaman();
		$parameter = $this->Rankingmodel->get_parameter($id_nilai);
		$avg_tekanan = $this->Rankingmodel->avg_tekanan();
		$avg_kecepatan = $this->Rankingmodel->avg_kecepatan();

        
		echo view('layout/content',$data);
	}
	
	public function cetak($id_nilai)
	{
		$data=
		[
			'title'=> 'cetak',
			'isi' => 'cetak',
			'parameter' => $this->Rankingmodel->get_parameter($id_nilai),
			'iklim' => $this->Rankingmodel->get_iklim(),
			'tanaman' => $this->Rankingmodel->get_tanaman(),
			'avg_iklim' => $this->Rankingmodel->avg_iklim(),
			'avg_tekanan' => $this->Rankingmodel->avg_tekanan(),
			'avg_kecepatan' => $this->Rankingmodel->avg_kecepatan()
		];

		$tanaman = $this->Rankingmodel->get_tanaman();
		$parameter = $this->Rankingmodel->get_parameter($id_nilai);
		$avg_tekanan = $this->Rankingmodel->avg_tekanan();
		$avg_kecepatan = $this->Rankingmodel->avg_kecepatan();

        
		echo view('cetak',$data);
	}
}