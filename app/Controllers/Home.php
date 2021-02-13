<?php namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Homemodel;

class Home extends BaseController
{

	public function index()
	{
		if (session()->get('username')=='') {
		
			session()->setFlashData('danger','MAAF AKSES DI TOLAK');
			return redirect()->to(base_url('login'));
		
		}

		$data=[
			'title'=> 'Home',
			'isi' => 'home'
		];
		echo view('layout/content',$data);
	}
	//--------------------------------------------------------------------

}